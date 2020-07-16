<html>
	<head>
		<title> 명지대학교 LMS </title>
		<link href="https://fonts.googleapis.com/css?family=Do+Hyeon&display=swap" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
		<style>
			body {
				background-color: #D9E5FF;
				color: 000000;
			}

			.div_position {
				width: 100%;
				height: 400px;
				position: absolute;/* body */
				top: 40%;
				margin-top: -225px;
				text-align: center;
			}

			.div_login {
				width: 300px;
			}

			.img_symbol {
				width: 100%;
			}

			#form_login > * {
				width: 100%;
				height: 50px;
			}

			#form_login > input {
				background-color: #D9E5FF;
				color: FFFFFF;
				border: 0px;
				border-bottom: 1px solid FFFFFF;
			}

			#form_login > button {
				background-color: FFFFFF;
				color: #D9E5FF;
				border: 0px;
			}
			
			#login_btn{
				font-size : 24px;
			}

			hr {
				max-width: 750px;
				height: 4px;
			}
		</style>
		
		<script>
			function login_check(){
				$.post(
					"http://localhost/lms/login_check",
					{ID: document.getElementById("ID").value,
						PW: document.getElementById("PW").value},
					function (data){
						if(!data){
							alert("회원정보가 틀렸습니다.");
						}else{
							document.getElementById("main").innerHTML = data;
						}
					}
				);
			}
		</script>
	</head>
	
	<body id="main">
		<div class="div_position">
			<div class="d-inline-block div_login">
				<img class="img_symbol" src="http://127.0.0.1/img/mju.jpg">

				<div class="mt-4">
                    <input type="text" class="px-2" ID="ID" placeholder="아이디">

					<input type="password" class="mt-2 px-2" ID="PW" placeholder="비밀번호" required>

					<button type="button" id="login_btn" class="btn btn-primary btn-lg mt-4" onclick="login_check();">로그인</button>
				</div>
			</div>

			<hr class="mt-5 d-none d-sm-block" color="#D9E5FF">
			
			<div class="mt-3">
				명지대학교 수강신청 프로그램
			</div>
		</div>

	</body>
</html>