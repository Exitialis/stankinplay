<!DOCTYPE html>
<html>
<head>
	
	<title></title>
</head>
<body>
	<h1>Тест</h1>
	<ul>
		
	</ul>

	<button type="submit" onclick="startBot(event)">
		Запустить бота
	</button>
	<button type="submit" onclick="stopBot(event)">
		Остановить бота
	</button>

	<form onsubmit="addFriend(event)">
		<input type="text" name="steamID">
		<button type="submit">
			Добавить в друзья
		</button>
	</form>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.8/socket.io.min.js"></script>
	<script type="text/javascript">
		var socket = io.connect('http://localhost:3033');
		var list = document.getElementsByTagName('ul');
		socket.on('log', function(data) {
			console.log(data.date + ' : ' + data.data);
			var li = document.createElement('li');
			li.innerText = data.date + ' : ' + data.data;

			list[0].appendChild(li);
		});

		function startBot(e) {
			e.preventDefault();
			socket.emit('start');
		}

		function stopBot(e) {
			e.preventDefault();
			socket.emit('stop');
		}

		function addFriend(e) {
			e.preventDefault();
			console.log(e);
			//socket.emit('addFriend', )
		}
	</script>
</body>
</html>