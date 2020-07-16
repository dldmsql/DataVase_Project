<html>
	<head>
		웹소켓 테스트
	</head>

    <body>
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
					case "reply" :
						console.log( json["msg"] );
					break;
				}
			}
		</script>
	</body>
</html>