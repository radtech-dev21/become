require('dotenv').config({path: '../.env'});
var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var mysql = require('mysql');
var database = require('./services/Database');
var moment = require('moment');
const helperFunctions = require('./helpers/functions');
const {isEmpty} = require('./helpers/functions');
const setupBuyerSellerChat = require('./sockets/chat');


const successResponse = helperFunctions.successResponse;
const errorResponse = helperFunctions.errorResponse;

var port_number = process.env.SOCKET_IO_PORT || 3001;

const BUCKET_URL = process.env.IMAGES_URL;

// Start listening for client connections
server.listen(port_number, function () {
    console.log('Listening to incoming client connections on port ' + port_number)
});

// Register buyer seller chat
setupBuyerSellerChat(io, '/');
