const socketPort = 7000;
const {
	Server
} = require("socket.io");
const express = require('express');
const app = express();
const server = require("http").createServer(app);
const io = new Server().listen(server, {
	cors: {
		origin: "*",
		methods: ["GET", "POST"],
		credentials: true
	}
});

io.on('connection', (socket) => {
	try {
		socket.on("sendChat", function (data) {
			console.log("sendChat   =>   ", data);
			io.sockets.emit("sendChat", {
				msg: data.msg,
				from: data.from
			});
		});



	} catch (socketException) {
		console.log("Socket exception: " + new Date() + ":", socketException);
	}
});







server.listen(socketPort, () => {
	console.log(`Socket.IO server running at http://localhost:${socketPort}/`);
});
