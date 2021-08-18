var mysql = require('mysql');
var moment = require('moment');
var moment_timezone = require('moment-timezone');
var database = require('../services/Database');

module.exports.findProduct = async function(id) {
    return await database.query(`SELECT * FROM products WHERE id='${id}'`)
        .then((results, fields) => {
    
            if (!results.length) {
                throw new Error("Product not found");
            }
            
            return results[0];
        });
}

module.exports.findUser = async function(user_id) {
    return await database.query(`SELECT * FROM users WHERE id='${user_id}'`)
        .then((results, fields) => {

        if (!results.length) {
            throw new Error("User not found");
        }

            user_id = results[0].id;
        })
};

module.exports.setUserOnline = async function(user_id) {
    return database.query(`UPDATE users SET online_status = 1 WHERE id = ${user_id}`)
}

module.exports.getChatConversation = async function(user_1, user_2) {
    return database.query(`SELECT * from chat_conversations WHERE user_1 in (${user_1}, ${user_2}) and user_2 in (${user_1}, ${user_2})`)
        .then((results, fields) => {
            if (results.length) {
                return results[0].id;
            }

            return null;
        });
}

module.exports.getChatConversationById = async function(chatConversationId) {
    return await database.query(`SELECT * FROM chat_conversations WHERE id = '${chatConversationId}'`);
}

module.exports.storeConversationMessage = async function(messageData) {
    return await database.query(`INSERT INTO chat_messages SET ?`, {
        ...messageData,
        created_at: moment().utc().format("YYYY-MM-DD HH:mm:ss"),
        updated_at: moment().utc().format("YYYY-MM-DD HH:mm:ss")
    })
}
module.exports.storeRequestConversationMessage = async function(messageData) {
    return await database.query(`INSERT INTO chat_request_messages SET ?`, {
        ...messageData,
        created_at: moment().utc().format("YYYY-MM-DD HH:mm:ss"),
        updated_at: moment().utc().format("YYYY-MM-DD HH:mm:ss")
    })
}

module.exports.getConversationMessageById = async function(messageId) {
    return database.query(`SELECT * FROM chat_messages WHERE id = ${messageId} limit 1`)
        .then((results, fields) => results[0]);
}
module.exports.getRequestConversationMessageById = async function(messageId) {
    return database.query(`SELECT * FROM chat_request_messages WHERE id = ${messageId} limit 1`)
        .then((results, fields) => results[0]);
}