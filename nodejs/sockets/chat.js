var mysql = require('mysql');
var moment = require('moment');
var tz = require('moment-timezone');
var database = require('../services/Database');
const {isEmpty} = require('../helpers/functions');
const helperFunctions = require('../helpers/functions');

var connectedUsers = {};
var connectedAdmin = {};
const SOCKET_EVENT_TYPING = "typing";
const BUCKET_URL = process.env.IMAGES_URL;
const SOCKET_EVENT_GET_MESSAGE = "message-get";
const SOCKET_EVENT_SEND_MESSAGE = "sendMessage";
const SOCKET_EVENT_MESSAGE_READ = "message-read";
const SOCKET_EVENT_ONLINE_STATUS = "online-status";
const errorResponse = helperFunctions.errorResponse;
const successResponse = helperFunctions.successResponse;
const SOCKET_EVENT_CONNECTION_SUCCESS = 'connection-success';
const SOCKET_EVENT_ADMIN_ONLINE_STATUS = "admin-online-status";

module.exports = (io, namespace) => {

io.of(namespace).on('connect', function (socket) {
    var isAdmin = false;
    var user_id = undefined;
    var handshake = socket.handshake;
    console.log(handshake);
    if (handshake.query !== undefined && (!isEmpty(handshake.query.EIO) || !isEmpty(handshake.query.admin))) {
        user_id = !isEmpty(handshake.query.user_id) ? handshake.query.user_id : 1;
        isAdmin = !isEmpty(handshake.query.admin) ? true : false;
        console.log('user_id: ' + user_id);
        console.log("isAdmin: " + isAdmin);
        console.log('conected', user_id);
        const sessionID = socket.id;
        if (!isEmpty(user_id) && !isAdmin) {
            database.query(`SELECT * FROM users WHERE id='${user_id}'`)
                .then((results, fields) => {
                if (!results.length) {
                    throw new Error("User not found");
                }
                user_id = results[0].id;
                return database.query(`UPDATE users SET online_status = 1 WHERE id = ${user_id}`);
            }).then((results, fields) => {
                connectedUsers[user_id] = {
                    socket: socket
                };
                socket.emit(SOCKET_EVENT_CONNECTION_SUCCESS, {'message': 'connected'});
                socket.broadcast.emit(SOCKET_EVENT_ONLINE_STATUS, {
                    user_id: user_id,
                    online_status: 1
                });
            }).catch(err => {
                console.log(err);
            });
        } else if (isAdmin) {
            // user_id = 1;
            connectedAdmin = {
                socket: socket
            };
            socket.emit(SOCKET_EVENT_CONNECTION_SUCCESS, {'message': 'connected'});
            socket.broadcast.emit(SOCKET_EVENT_ADMIN_ONLINE_STATUS, {
                online_status: 1
            });
        }

        socket.on(SOCKET_EVENT_SEND_MESSAGE, (data, callback) => {
            if (isEmpty(data.receiver_id) && !isEmpty(data.admin)) {
                if (!isEmpty(callback)) {
                    return callback(errorResponse("Invalid receiver"));
                }
                return;
            }
            if (isEmpty(data.type)) {
                if (!isEmpty(callback)) {
                    return callback(errorResponse("The type field is required"));
                }

                return;
            }
            const TYPE_TEXT = "text";
            const TYPE_IMAGE = "image";
            const types = [TYPE_IMAGE, TYPE_TEXT];
            if (!types.includes(data.type)) {
                if (!isEmpty(callback)) {
                    return callback(errorResponse("The type field value is invalid"));
                }
                return;
            }
            var responseData = {};
            var sender_id = user_id;
            var conversationId = undefined;
            var receiver_id = data.receiver_id;
            database.query(`SELECT * from chat_conversations WHERE user_1 = ${receiver_id} OR user_2 = ${receiver_id}`)
                .then((results, fields) => {
                    if (results.length) {
                        return new Promise((resolve, reject) => resolve({insertId: results[0].id}));
                    }
                    return database.query("INSERT INTO chat_conversations SET ?", {
                        user_2: sender_id,
                        user_1: receiver_id,
                        created_at: moment().utc().format("YYYY-MM-DD HH:mm:ss"),
                        updated_at: moment().utc().format("YYYY-MM-DD HH:mm:ss")
                    });
                }).then((results, fields) => {
                    conversationId = results.insertId;
                    return database.query(`SELECT * FROM chat_conversations WHERE id = '${conversationId}'`);
                }).then((results, fields) => {
                    let message = data.message;
                    let file_name = null;
                    if (data.type == TYPE_IMAGE) {
                        const messages = data.message.split(',');
                        message = messages[0];
                        file_name = !isEmpty(messages[1]) ? messages[1] : ""
                    }
                    return database.query(`INSERT INTO chat_messages SET ?`, {
                        chat_conversation_id: conversationId,
                        sender_id: sender_id,
                        receiver_id: receiver_id,
                        message: message,
                        type: data.type,
                        filename: file_name,
                        created_at: moment().utc().format("YYYY-MM-DD HH:mm:ss"),
                        updated_at: moment().utc().format("YYYY-MM-DD HH:mm:ss")
                    })
                })
                .then((results, fields) => {
                    return database.query(`SELECT * FROM chat_messages WHERE id = ${results.insertId} limit 1`);
                }).then(function(results, fields) {
                    responseData = results[0];
                    if (responseData['type'] == TYPE_IMAGE) {
                        responseData['message'] = BUCKET_URL + responseData['message'];
                    }
                    if (!isEmpty(connectedUsers[receiver_id]) && !isEmpty(data.admin)) {
                        connectedUsers[receiver_id].socket.emit(SOCKET_EVENT_SEND_MESSAGE, responseData);
                    } else if (isEmpty(data.admin)) {
                        if (!isEmpty(connectedAdmin) && !isEmpty(connectedAdmin.socket)) {
                            connectedAdmin.socket.emit(SOCKET_EVENT_SEND_MESSAGE, responseData);
                        }
                    }
                    if (!isEmpty(callback)) {
                        return callback(successResponse("Message sent successfully!", responseData));
                    }
                })
                .catch(err => {
                    console.log(err);
                    if (!isEmpty(callback)) {
                        callback(errorResponse(err.message));
                    }
                });
        });
        socket.on(SOCKET_EVENT_TYPING, function (data, callback) {
            var receiver_id = data.user_id;
            if (!isEmpty(connectedUsers[receiver_id])) {
                connectedUsers[receiver_id].socket.emit(SOCKET_EVENT_TYPING, {
                    user_id: receiver_id,
                    is_typing: data.is_typing
                });
            }

            if (!isEmpty(callback)) {
                callback(successResponse("Message sent successfully!"));
            }
        });

        socket.on(SOCKET_EVENT_MESSAGE_READ, function (data, callback) {
            receiver_id = data.user_id;
            database.query(`UPDATE chat_messages SET read_at = ? WHERE read_at IS NULL and sender_id = ${receiver_id} and receiver_id = '${user_id}'`, moment().format("YYYY-MM-DD HH:mm:ss"))
            .then((results, fields) => {
                if (!isEmpty(connectedUsers[receiver_id])) {
                    connectedUsers[receiver_id].socket.emit(SOCKET_EVENT_MESSAGE_READ, {
                        is_read: true
                    });
                }
                if (!isEmpty(callback)) {
                    callback(successResponse("Message sent successfully!"));
                }
            }).catch(err => {
                if (!isEmpty(callback)) {
                    callback(errorResponse(err.message));
                }
            })
        });

        socket.on(SOCKET_EVENT_ONLINE_STATUS, function (data, callback) {

            console.log('online_status: change')
            console.log(data);

            if (isEmpty(data.user_id) || isEmpty(data.online_status)) {
                if (!isEmpty(callback)) {
                    return callback(errorResponse("Invalid data"));
                }

                return;
            }

            database.query(`UPDATE users SET online_status = ${data.online_status} WHERE id = ${data.user_id}`)
                .then(function(results, fields) {
                    socket.broadcast.emit(SOCKET_EVENT_ONLINE_STATUS, {
                        user_id: data.user_id,
                        online_status: data.online_status
                    });

                    if (!isEmpty(callback)) {
                        callback(successResponse("Successful", {
                            user_id: data.user_id,
                            online_status: data.online_status
                        }))
                    }
                })
                .catch(function(err) {
                    if (typeof callback != 'undefined') {
                        callback(errorResponse(err.message));
                    } else {
                        console.log("callback not found");
                    }
                });
        });

        socket.on('disconnect', function (error) {
            database.query(`UPDATE users SET online_status = ${0}, updated_at=${Date.now()} WHERE id = ${user_id}`)
                .then((results, fields) => {
                    socket.broadcast.emit(SOCKET_EVENT_ONLINE_STATUS, {
                        user_id: user_id,
                        online_status: false
                    });

                    if (!isEmpty(callback)) {
                        callback(successResponse("Successful", {
                            user_id: user_id,
                            online_status: false
                        }))
                    }
                })
                .catch(err => {
                    
                });

            console.log("disconnect", error);
            console.log('error', error);
        });
    } else {
        console.log("invalid data");
        console.log(handshake.query);
    }
});
}