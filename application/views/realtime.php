<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
        var socket = new WebSocket('ws://localhost:8080');

        socket.onopen = function(e) {
            console.log("Connected!");
        };
        socket.onopen = () => {
            setInterval(function() {
                socket.send('{"action":"update"}');
            },500);
        }

        socket.onmessage = function(e) {
            console.log(e.data);
            let arr = JSON.parse(e.data);
            $("p.bid > b").text(arr['Bid']);
            $("p.ask > b").text(arr['Ask']);
            $("p.last > b").text(arr['Last']);
        };
    </script>
    <?= $namsinh ?>
    <h1>views/realtime.php</h1>
    <button id="open">Open server</button>
    <button id="close">Close server</button>
    <p class="bid">Bid: <b></b></p>
    <p class="ask">Ask: <b></b></p>
    <p class="last">last: <b></b></p>
    <script>
        $("#open").click(function(){
            $.ajax({
                url:"<?= baseUrl ?>/socket/open",
                timeout: 1000
            });
            location.reload();
        });

        $("#close").click(function(){
            $.ajax({
                url:"<?= baseUrl ?>/socket/close",
                timeout: 1000
            });
            location.reload();
        });
    </script>
</body>
</html>