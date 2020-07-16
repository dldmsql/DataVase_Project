<html>
	<head> 
		<title>노인반려로봇? </title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
		<!--<script src="/socket.io/socket.io.js"></script>
		<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
		

		<script>
	
	
	
		</script>
		
		<style >
			.div{
				background-color: #EAEAEA;
				text-align: center;
				display: flex;
				justify-content: around;
			}
			
			.div_first{
				border: 2px solid #ABF200;
				display: inline-block; 
				width: 100%;
				height: 100%;
			}
			.div_second{
				border: 2px solid #B2EBF4;
				display: inline-block; 
				width: 0%;
				height: 100%;
			}
			.div_third{
				border: 2px solid #000000;
				border-radius: 10px;
				width: 30%;
				margin: 0 auto;
				
				text-align: center;
			}
			.text{
				font-family: "맑은고딕";
				font-weight: bold;
				font-size: 1.5em;
			}
			
			<!-- * { margin: 0; padding: 0; box-sizing: border-box; }
      body { font: 13px Helvetica, Arial; }
      form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
      form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
      form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
      #messages { list-style-type: none; margin: 0; padding: 0; }
      #messages li { padding: 5px 10px; }
      #messages li:nth-child(odd) { background: #eee; }
		-->
		
		</style>
		
	
	</head>

	<body>
		
		<div class="div_third">
				<p class="text">노인반려로봇</p>
		</div>
		
		<div class="div">
			<ul id="messages"></ul>
		
			<div class="div_first">
				<!--<form action="">
					<input id="m" autocomplete="off" /><button>Send</button>

				</form>-->
			
			</div>
			
			<div class="div_second">
			
			
			</div>
			
			
	
		</div>
	
	<!--<script>
$(function () {
    var socket = io();
    $('form').submit(function(e){
      e.preventDefault(); // prevents page reloading
      socket.emit('sensor_01', $('#m').val());
      $('#m').val('');
      return false;
    });
	socket.on('sensor_01', function(msg){
		$('#messages').append($('<li>').text(msg));
	});
  });
</script>-->
	</body>



</html>