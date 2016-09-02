<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Socket io App</title>
</head>
<body>

    <ul id="chat">
        @foreach($messages as $message)
        <li>
            <b>{{ $message->author }}</b>
            <p>{{ $message->content }}</p>
        </li>
        @endforeach
    </ul>
    <hr>
    <form action="/chat/message" method="POST">
        {{ csrf_field() }}
        <input type="text" name="author">
        <br>
        <textarea name="content" id="texto"></textarea>
        <br>
        <input type="submit" value="Enviar">
    </form>

    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <script>
        var socket = io(':6001');

        function render(data){
            var html = `<li>
                            <b>${ data.author }</b>:
                            <p>${ data.content }</p>
                        </li>`;

            var chat = document.getElementById('chat');
            chat.innerHTML += html;
        }

        /*function addMessage(e){
            var payload = {
                text: document.getElementById('texto').value
            };
            socket.emit('new-message', payload);            
            return false;
        }*/

        socket.on('chat:message', function(data){
            render(data);
        });
    </script>
</body>
</html>