import io from 'socket.io-client';
import Mustache from 'mustache';
import Axios from 'axios';
import moment from 'moment';

import 'simplebar';
import 'simplebar/dist/simplebar.css';
var typing = false;
var timeout = undefined;
var isOtherUserTyping = false;
const socket = io(`${SOCKET_URL}?admin=1&user_id=`+user);
const SOCKET_SEND_TYPING = "typing";
const SOCKET_SEND_MESSAGE = "sendMessage";
const SOCKET_EVENT_MESSAGE_READ = "message-read";
const SOCKET_EVENT_ONLINE_STATUS = "online-status";
var messageTemplate = document.getElementById('msg-template').innerHTML;
var UserListTemplate = document.getElementById('user-list-template').innerHTML;
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {
    console.log('testing error')
}
socket.on('connect', function() {

})
socket.on('disconnect', function() {
    setOnlineStatus(false);
})
socket.on(SOCKET_SEND_MESSAGE, function(data) {
    renderMessage(data.message, data.created_at, data.is_sender_admin);
});
socket.on(SOCKET_SEND_TYPING, function(data) {
    setOtherUserTyping(data.is_typing);
});
socket.on(SOCKET_EVENT_ONLINE_STATUS, function(data) {
    console.log(data);
})
scrollToLastMessage();
$(document).ready(function() {
    $('#user_inbox a:first-child').trigger('click');
    $("#msg-text").keypress(function(e) {
        if (e.keyCode == 13) {
            sendMessage($('#msg-text').val());
        }
    })
    $('#send_message_btn').on('click', function() {
        sendMessage($('#msg-text').val());
    });
    if (selectedConversationUser) {
        getUserList($('.search-bar').val());
        selectUserConversation(selectedConversation, selectedConversationUser)
    }
    $(document).on('click', '.chat_list', function(event){
        if ($(this).data('user')) {
            selectUserConversation($(this).data('user'));
        }
    });
    $(document).on('keypress', '#search_box', function(event){
        getUserList($(this).val());
    });
    setTimeout(function(){ 
        $('#search_box').trigger('keypress');
    }, 500);
});
function sendMessage(message) {
    if (!message) {
        console.log('sendMessage: message not found');
        return;
    }
    // if (!selectedConversationUser) {
    //     console.log('selectedConversationUser: message not found');
    //     return;
    // }
    socket.emit(SOCKET_SEND_MESSAGE, {
        admin: true,
        type: "text",
        message: message,
        receiver_id: $('#selectedConversation_name').data('user_id'),
    }, (data) => {
        renderMessage(data.data.message, moment().format("HH:mm"), data.data.is_sender_admin, $('#selectedConversation_name').data('user_name'));
        $('#msg-text').val("");
    });
}
function setTyping(isTyping) {
    if (!selectedConversationUser) {
        return;
    }
    typing = isTyping;
    socket.emit(SOCKET_SEND_TYPING, {user_id: selectedConversationUser, is_typing: isTyping});
}
function setOtherUserTyping(isTyping) {
    isOtherUserTyping = isTyping;
    if (isTyping) {
        $('#typing-indicator').removeClass('d-none')
    } else {
        $('#typing-indicator').addClass('d-none')
    }
}
function setOnlineStatus(isOnline) {
    socket.emit(SOCKET_EVENT_ONLINE_STATUS, {user_id: user, online_status: isOnline});
}
function scrollToLastMessage(){
    var chatMessageListEl = $("#chat-messages-list")[0];
    chatMessageListEl.scrollTop = chatMessageListEl.scrollHeight;
}
function renderUserList(user_name, user_id, last_message, last_message_time) {
    var rendered = Mustache.render(UserListTemplate, { user_name:user_name, user_id: user_id,  last_message:last_message, last_message_time:last_message_time});
    document.getElementById('user_inbox').innerHTML += rendered;
    scrollToLastMessage();
}
function renderMessage (message, created_at, isSent, sender_name) {
    var rendered = Mustache.render(messageTemplate, { message: message, created_at: created_at, isSent, sender_name});
    console.log(rendered);
    $('#chat-messages-list .simplebar-content').append(rendered);
    scrollToLastMessage();
}
function selectUserConversation(user_id){
    var url = base_url+'/support/chat/messages';
    Axios.post(url, {user_id: user_id}).then(res => res.data).then(res => {
        $('#chat-messages-list .simplebar-content').html('');
        $('#selectedConversation_name').html(res.selected_user.name);
        $('#selectedConversation_name').data('user_id', res.selected_user.id);
        res.messages.map(function(message) {
           renderMessage(message.message, message.created_date, message.is_sender_admin, message.sender.name);
        });
        scrollToLastMessage();
        socket.emit(SOCKET_EVENT_MESSAGE_READ, {user_id: user_id });
        $('#unread_dot_'+user_id).remove();
    }).catch(err => {

    });
    $(`.chat_list[data-user="${user_id}"]`).addClass("active_chat");
}
function getUserList(search_by_name){
    var role = $('#role').val()
    var url = base_url+'/chats/users/list';
    Axios.post(url, {search_by_name:search_by_name, role:role}).then(res => res.data).then(res => {
        document.getElementById("user_inbox").innerHTML = "";
        res.users.map(function(user) {
            renderUserList(user.name, user.id, user.last_message, user.created_date);
        })
        $('#user_inbox a:first-child').trigger('click');
    }).catch(err => {

    });
}