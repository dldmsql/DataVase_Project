<html>
	<head>
		<title> 공부 </title>
		
		<script src="http://travel-plus.co.kr:3000/socket.io/socket.io.js"></script>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
	
		<style>
		
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
.inform{
	background-color:#D4F4FA;
}
.studing{
	background-color:#FFD9EC;
}

			
		</style>
	<head>
	
	<body>
		<div id="student_name" class="inform">
			
		</div>
		<div id="study" class="studing">
			<div>
				<input type="hidden"  autocomplete="off" id="study_start" value="수업" />
				<button type="button" class="myButton"> 수업  </button>
			</div>
			<div>
				<input type="hidden"  autocomplete="off" id="question" value="질문하기" />
				<button type="button" class="myButton"> 질문하기  </button>
			</div>
			<div>
				<input type="hidden" autocomplete="off" id="study_again" value="복습하기" />
				<button type="button" class="myButton"> 복습하기  </button>
			</div>
			<div>
				<input type="hidden" autocomplete="off" id="study_send" value="수업종료" />
				<button type="button" class="myButton"> 수업 종료  </button>
			</div>
			<div>
				<input type="hidden" autocomplete="off" id="study_memo" value="학습장" />
				<button type="button" class="myButton"> 학습장  </button>
			</div>
		
		</div>
		
		<script>
		$(function () {
			var socket = io.connect('http://travel-plus.co.kr:3000');
			socket.on('student_name',function(msg){
			$('#student_name').append($('<p>'+msg+'</p>)'));
			});
			return false;
		});
		$(function () {
			var socket = io.connect('http://travel-plus.co.kr:3000');
		
			$('#study_start').submit(function(e){
				e.preventDefault(); // prevents page reloading
				var start = $('#stdy_start').val(); 
				socket.emit('state',start);
			});
			return false;
		});
		$(function () {
			var socket = io.connect('http://travel-plus.co.kr:3000');
		
			$('#question').submit(function(e){
				e.preventDefault(); // prevents page reloading
				var question = $('#question').val(); 
				socket.emit('state',question);
			});
			return false;
		});
				 
				var again = $('#study_again').val(); 
				var end = $('#stdy_end').val(); 
				var memo = $('#stdy_memo').val();
	  
		</script>
	</body>
</html>