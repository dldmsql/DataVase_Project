<html id="boardall">

	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
			
	<meta chatset="utf-8">
	
		<script src="http://travel-plus.co.kr:3000/socket.io/socket.io.js"></script>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
	
	<script>
			var number=0;

			var socket = io.connect('http://travel-plus.co.kr:3000');

			socket.on('student_name',function(msg){
				var data = JSON.parse(msg);
				var student = data['student'];
				number = data['cnt'];
				console.log(number);
			});
	
		
		function study_korean(){
			var eJson = {"study":$('#study_korean').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function study_math(){
			var eJson = {"study":$('#study_math').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function study_society(){
			var eJson = {"study":$('#study_society').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function study_science(){
			var eJson = {"study":$('#study_science').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function study_english(){
			var eJson = {"study":$('#study_english').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function study_again(){
			var eJson = {"study":$('#study_again').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function tool_word(){
			var eJson = {"study":$('#tool_word').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function tool_english(){
			var eJson = {"study":$('#tool_english').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function tool_translation(){
			var eJson = {"study":$('#tool_translation').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function tool_sentence(){
			var eJson = {"study":$('#tool_sentence').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function tool_korean(){
			var eJson = {"study":$('#tool_korean').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function tool_memo(){
			 var eJson = {"study":$('#tool_memo').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}function question(){
			var eJson = {"study":$('#question').val(), "number":number}; var send = JSON.stringify(eJson); 	socket.emit('study',send);
		}
		
		function go(){
			
				var name = $('#name').val(); 
				var password = $('#password').val();
	  
				var aJson = {"name":name, "passwd":password};
				
				var send = JSON.stringify(aJson);
			
				socket.emit('login', send);
			
		$.post(
					"http://travel-plus.co.kr/board/socket",
					{a:3},
					function( data ){
						document.getElementById("socket_environ").innerHTML = data;
					}
				);	
				$('#student_name').html($('<p>'+name+'</p>)'));
			}			
	</script>
		<style>
			form { background: #000; padding: 3px; position: fixed; center: 0; width: 100%; }
			form input { border: 1; padding: 10px; width: 90%; margin-right: .5%; }
			form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
		.inform{
			text-align:center;
			font-weight: bold;
				font-family:맑은고딕;
	background-color:#D4F4FA;
}
.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #f6f6f6));
	background:-moz-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-webkit-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-o-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-ms-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:linear-gradient(to bottom, #ffffff 5%, #f6f6f6 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0);
	background-color:#ffffff;
	-moz-border-radius:8px;
	-webkit-border-radius:8px;
	border-radius:8px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#666666;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
	padding:5px 10px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f6f6f6), color-stop(1, #ffffff));
	background:-moz-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-webkit-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-o-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-ms-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:linear-gradient(to bottom, #f6f6f6 5%, #ffffff 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6f6f6', endColorstr='#ffffff',GradientType=0);
	background-color:#f6f6f6;
}
.myButton:active {
	position:relative;
	top:1px;
}
.myButton-con {
	-moz-box-shadow:inset 0px 0px 0px 0px #bbdaf7;
	-webkit-box-shadow:inset 0px 0px 0px 0px #bbdaf7;
	box-shadow:inset 0px 0px 0px 0px #bbdaf7;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5));
	background:-moz-linear-gradient(top, #79bbff 5%, #378de5 100%);
	background:-webkit-linear-gradient(top, #79bbff 5%, #378de5 100%);
	background:-o-linear-gradient(top, #79bbff 5%, #378de5 100%);
	background:-ms-linear-gradient(top, #79bbff 5%, #378de5 100%);
	background:linear-gradient(to bottom, #79bbff 5%, #378de5 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5',GradientType=0);
	background-color:#79bbff;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #84bbf3;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
	padding:5px 10px;
	text-decoration:none;
	text-shadow:0px 1px 0px #528ecc;
}
.myButton-con:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff));
	background:-moz-linear-gradient(top, #378de5 5%, #79bbff 100%);
	background:-webkit-linear-gradient(top, #378de5 5%, #79bbff 100%);
	background:-o-linear-gradient(top, #378de5 5%, #79bbff 100%);
	background:-ms-linear-gradient(top, #378de5 5%, #79bbff 100%);
	background:linear-gradient(to bottom, #378de5 5%, #79bbff 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff',GradientType=0);
	background-color:#378de5;
}

.myButton-go {
	-moz-box-shadow:inset 0px 0px 0px 0px #F6F6F6;
	-webkit-box-shadow:inset 0px 0px 0px 0px #F6F6F6;
	box-shadow:inset 0px 0px 0px 0px #F6F6F6;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #EAEAEA), color-stop(1, #D5D5D5));
	background:-moz-linear-gradient(top, #EAEAEA 5%, #D5D5D5 100%);
	background:-webkit-linear-gradient(top, #EAEAEA 5%, #D5D5D5 100%);
	background:-o-linear-gradient(top, #EAEAEA 5%, #D5D5D5 100%);
	background:-ms-linear-gradient(top, #EAEAEA 5%, #D5D5D5 100%);
	background:linear-gradient(to bottom, #EAEAEA 5%, #D5D5D5 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#EAEAEA', endColorstr='#D5D5D5',GradientType=0);
	background-color:#EAEAEA;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #BDBDBD;
	display:inline-block;
	cursor:pointer;
	color:#000000;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
	padding:5px 10px;
	text-decoration:none;
	text-shadow:0px 1px 0px #A6A6A6;
}
.myButton-go:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #D5D5D5), color-stop(1, #EAEAEA));
	background:-moz-linear-gradient(top, #D5D5D5 5%, #EAEAEA 100%);
	background:-webkit-linear-gradient(top, #D5D5D5 5%, #EAEAEA 100%);
	background:-o-linear-gradient(top, #D5D5D5 5%, #EAEAEA 100%);
	background:-ms-linear-gradient(top, #D5D5D5 5%, #EAEAEA 100%);
	background:linear-gradient(to bottom, #D5D5D5 5%, #EAEAEA 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#D5D5D5', endColorstr='#EAEAEA',GradientType=0);
	background-color:#D5D5D5;
}
.myButton-go:active {
	position:relative;
	top:1px;
}

.studing{
	background-color:#FFD9EC;
}
		</style>
	
	</head>
	
	<body>
	
		<div id="socket_environ">
		<form id="login">
			<input id="name" autocomplete="off" placeholder="이름" />
			<input id="password" type="password" autocomplete="off" placeholder="비밀번호" />
			<button type="button" onclick="go();">로그인</button>
		</form>
		<div id="image_korean">
		</div>
	
	</div>
	</body>
	
</html>