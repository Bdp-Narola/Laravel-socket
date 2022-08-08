<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socket IO</title>
    <script src="{{ url('node_modules/socket.io-client/dist/socket.io.js') }}"></script>
</head>
<body>
    <h6>Socket.IO</h6>
    <ul id="messages"></ul>
	<form id="form" action="">
		<input id="input" autocomplete="off" />
		<button>Send</button>
	</form>
    <script>
		let form = document.getElementById('form');
		let input = document.getElementById('input');
		let messages = document.getElementById('messages');

		const socketPort = 7000;
		const protocol = (window.location.protocol === "https:" ? "https://" : "http://");
		const socket = io.connect(protocol + window.location.hostname + ':' + socketPort, {
			secure: true,
			rejectUnauthorized: false
		});

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			if (input.value) {
				socket.emit('sendChat', {
					msg: input.value,
					from: "app.blade"
				});
				input.value = '';
			}
		});

		socket.on('sendChat', function(msg) {
			let item = document.createElement('li');
			item.textContent = `${msg.msg}  ====   ${msg.from}`;
			messages.appendChild(item);
			window.scrollTo(0, document.body.scrollHeight);
		});


	</script>
</body>
</html>