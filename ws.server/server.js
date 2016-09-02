var io = require('socket.io')(6001);
var Redis = require('ioredis');
var	redis = new Redis();

redis.psubscribe('*', function(error, count){
	// ...
});

redis.on('pmessage', function(pattern, channel, message){

	message = JSON.parse(message);
	io.emit(channel + ':' + message.event, message.data.message);
});






/*var io = require('socket.io')(6001);


var messages = [{
	id: 1,
	text: "Hola soy un mensaje",
}];


io.on('connection', function(socket){
	console.log('New connection', socket.id);

	//Send Message
	//socket.send('Message from server');

	//Fire event
	//socket.emit('server-info', {version: .1});

	//socket.broadcast.send('New User');

	socket.emit('messages', messages);

	socket.on('new-message', function(data){
		messages.push(data);
		socket.broadcast.send(data);
		io.sockets.emit('messages', messages);
	});

	//Join to room
	//socket.join('vip', function(error){
	//	console.log(socket.rooms);
	//});
});*/