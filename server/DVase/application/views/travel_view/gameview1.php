<html>
	<head> 
	
		<title> 초성게임 </title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
		<script>
		
			function go(){
				
			}
		
		</script>
		
		<style type="text/css">
		
		p{
			font-family: "Arial Black", sans-serif;
			font-size: 36px;
			font-weight: bold;
			color: #0100FF;
			text-align: center;
			text-shadow: 2px 4px 2px gray;
		}
		.out {
			width: 100%;
			text-align: center;
			
		}
		.in {
			
			display: inline-block;
		}
		.button {
			background-color: #4CAF50; /* Green */
			border: none;
			color: white;
			padding: 16px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			-webkit-transition-duration: 0.4s; /* Safari */
			transition-duration: 0.4s;
			cursor: pointer;
		}
		.button2 {
			background-color: white; 
			color: black; 
			border: 2px solid #ffffff;
		}

		.button2:hover {
			background-color: #008CBA;
			color: white;
		}
		
		</style>
	</head>
	
	<body>
		<div class="out" id="out">
		
			<div id="layer1" class="in" id="in">
				<p class="s1"> 초성게임 </p>
				<button class="button button1" type="button" onclick="go('http://travel-plus.co.kr/game/initial');">시작</button>
			</div>
		</div>
		

	</body>
	
</html>