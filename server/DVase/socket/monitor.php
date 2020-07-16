<html>
<head>
	<title>Chat</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
	* {margin:0;padding:0;box-sizing:border-box;font-family:arial,sans-serif;resize:none;}
	html,body {width:100%;height:100%;}
	#wrapper {position:relative;margin:auto;max-width:1000px;height:100%;}
	#chat_output {position:absolute;top:0;left:0;padding:20px;width:100%;height:calc(100% - 100px);}
	#chat_input {position:absolute;bottom:0;left:0;padding:10px;width:100%;height:100px;border:1px solid #ccc;}
	</style>
</head>
<body>
	<div id="wrapper">
		<div id="chat_output"></div>
		<textarea id="chat_input" placeholder="메시지 입력..."></textarea>
		<script>
			conn = new WebSocket( "wss://ws.travel-plus.co.kr/wss2/" );

			conn.onopen = function( e ){
				console.log( e );
				console.log( "websocket connected" );

				var json = { event: "greeting", msg: "hello" }

				conn.send( JSON.stringify( json ) );
			}

			conn.onclose = function( e ){
				console.log( e );
				console.log( "websocket disconnected" );
			}

			conn.onmessage = function( e ) {
				var json = JSON.parse( e.data );

				switch ( json["event"] ){
					case "notificate" :
						console.log( json["name"] );
					break;
				}
			}
		</script>
	</body>
</html>