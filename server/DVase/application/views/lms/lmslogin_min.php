<html>
	<head>
		<title> 명지대학교 LMS </title>
		<link href="https://fonts.googleapis.com/css?family=Do+Hyeon&display=swap" rel="stylesheet">
		
		<link rel="stylesheet" href="<?=SITE_URL?>/include/css/glyphicons.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
		<style>
			body {
				background-color: #EBF7FF;
				color: 000000;
			}
			.div_dropdown{
				margin-top: 50px;
				text-align: center;
				position: relative;
			}

			.div_position {
				width: 100%;
				height: 400px;
				position: absolute;/* body */
				top: 40%;
				margin-top: -200px;
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
				background-color: #EBF7FF;
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
				font-size : 12px;
			}

			hr {
				max-width: 750px;
				height: 4px;
			}
		</style>
		
		<script>
			function login_check(){
				
				alert(Date());
				$.post(
					"<?=SITE_URL?>/lms/logincheck",
					{ ID: document.getElementById( "ID" ).value, PW: document.getElementById( "PW" ).value },
					function ( data ){						
						if(!data){
							alert("회원정보가 틀렸습니다.");
							document.getElementById("ID").value = "";
							document.getElementById("PW").value = "";
						}else{
							alert("환영합니다.");
							document.getElementById("main").innerHTML = data;
						}
					}
				);
			}
			
			function keyevent(){
				 if(event.keyCode == 13){
					 login_check();
				 }
			}
			
			function modalshow (type){
				if(type == "new"){
					$( "#modal_new" ).modal("show");
				}else if(type == "ID"){
					$( "#modal_findID" ).modal("show");
				}else{
					$( "#modal_findPW" ).modal("show");
				}
			}
			
			function btnsearch(){
				
			}
			
			function actionlecture(member_ID){
				$.post(
				"<?=SITE_URL?>/lms/lecture",
					{},
					function (data){
						document.getElementById("div_main").innerHTML = data;
					}
				);
			}
			
			function actionbasket(member_ID){
				
			}
			
			function signup_new(){
				$.post(
					"<?=SITE_URL?>/lms/signupcheck",
					{id: document.getElementById("signup_id").value,
						password: document.getElementById("signup_password").value,
						name: document.getElementById("signup_name").value,
						birthday: document.getElementById("signup_birthday").value,
						number: document.getElementById("signup_number").value,
						phone: document.getElementById("signup_phone").value,
						campus:document.getElementById("campus").value,
						college: document.getElementById("college").value,
						department: document.getElementById("department").value},
						
					function (data){
						var json = JSON.parse( data );
						
						if(  json["<?=KEY_POST_RETURN?>"] == "<?=VAL_POST_RETURN_TRUE?>" ){
							alert("회원가입에 실패했습니다. 관리자에게 문의해주세요.");
							document.getElementById("new_form").reset();
						}else{
							alert("회원가입에 성공했습니다. 로그인해주세요.");
							document.getElementById("new_form").reset();
						}
					}
				);
			}
			
			function categoryChange(type, e){
				var id = e.value;
				
				if(type == "campus"){
					var target = document.getElementById("college");
					target.options.length = 0;
					
					<?
						foreach( $college->result_array() as $row){
					?>
							var campus_ID = "<?=$row["campus_ID"] ?>";
							var college_ID = "<?=$row["ID"] ?>";
							var campus_name = "<?=$row["name"]?>";
							if( id == campus_ID ){
								var opt = document.createElement("option");
								opt.value = college_ID;
								opt.innerHTML = campus_name;
								target.appendChild(opt);
							}
					<?		
						}
					?>
				}else if(type == "college"){
					var target = document.getElementById("department");
					target.options.length = 0;
					<?
						foreach( $department->result_array() as $row){
					?>
							var college_ID = "<?=$row["college_ID"] ?>";
							var department_ID = "<?=$row["ID"] ?>";
							var college_name = "<?=$row["name"]?>";
							if( id == college_ID ){
								var opt = document.createElement("option");
								opt.value = department_ID;
								opt.innerHTML = college_name;
								target.appendChild(opt);
							}
					<?		
						}
					?>
				}
			}
		</script>
	</head>
	
	<body id="main">
		<div class="div_position">
			<div class="d-inline-block div_login">
				<img class="img_symbol" src="<?=SITE_URL?>/img/mju.jpg">

				<div class="mt-4 div_infor">
					<div>
						<span class="glyphicons glyphicons-user"></span> <input type="text" class="px-2" ID="ID" placeholder="아이디">
						
						<br>

						<span class="mt-2  glyphicons glyphicons-lock"></span> <input type="password" class="mt-2 px-2" ID="PW" placeholder="비밀번호"  onkeyup="keyevent(this);"  required >
					</div>
					<div>

						<button type="button" id="login_btn" class="btn btn-primary btn-lg mt-4" onclick="login_check();">로그인</button>
						<button type="button" id="login_btn" class="btn btn-primary btn-lg mt-4" onclick="modalshow('new');">회원가입</button>
					</div>
				</div>
				<div class="mt-3">
					<a href="javascript:modalshow('ID');"> ID 찾기  </a>
					&nbsp; &nbsp;
					<a href="javascript:modalshow('PW');"> PW 찾기 </a>
				</div>
			</div>

			<hr class="mt-4 d-none d-sm-block" color="#D9E5FF">
			
			<div class="mt-3">
				명지대학교 수강신청 프로그램
			</div>
		</div>
		
		<div class="modal fade" id="modal_new">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
						<h4><strong>회원가입</strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body">
						<form class="form-horizontal" role="form" onsubmit="return false;" id="new_form">
							<div class="form-group">
								<label class="control-label">아이디*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_id" placeholder="아이디" maxlength="5" required>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">비밀번호*</label>

								<div class="">
									<input type="password" class="form-control" id="signup_password" placeholder="비밀번호" maxlength="15" required>
								</div>
							</div>

							<div class="form-group">
								<label class=" control-label">이름*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_name" placeholder="이름" maxlength="10">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label">캠퍼스*</label>

								<select class="form-control" onchange="categoryChange('campus', this);" id="campus">
									<option value="" selected> </option>
									<? 
										foreach( $campus->result_array() as $row ){
											echo "<option value=".$row["ID"].">".$row["name"]."</option>";
											}
									?>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label">단과대학*</label>
								
								<select class="form-control" onchange="categoryChange('college', this);" id="college">
									<option value="" selected> </option>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label">학과*</label>

								<select class="form-control" id="department">
									<option value="" selected> </option>
								</select>
							</div>
							
							<div class="form-group">
								<label class=" control-label">학번*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_number" placeholder="학번">
								</div>
							</div>

							<div class="form-group">
								<label class=" control-label">생년월일*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_birthday" placeholder="생년월일">
								</div>
							</div>
							
							<div class="form-group">
								<label class=" control-label">전화번호*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_phone" placeholder="전화번호">
								</div>
							</div>
						</form>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" onclick = "signup_new();" data-dismiss="modal">회원가입</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
					</div>
                </div>
            </div>
        </div>
		
		<div class="modal fade" id="modal_findID">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
						<h4><strong>ID 찾기</strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body">
						<form class="form-horizontal" role="form" onsubmit="return false;" id="findID_form">
							<div class="form-group">
								<label class=" control-label">이름*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_name" placeholder="이름" maxlength="10">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label">캠퍼스*</label>

								<select class="form-control" onchange="categoryChange('campus', this);" id="campus">
									<option value="" selected> </option>
									<? 
										foreach( $campus->result_array() as $row ){
											echo "<option value=".$row["ID"].">".$row["name"]."</option>";
											}
									?>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label">단과대학*</label>
								
								<select class="form-control" onchange="categoryChange('college', this);" id="college">
									<option value="" selected> </option>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label">학과*</label>

								<select class="form-control" id="department">
									<option value="" selected> </option>
								</select>
							</div>
							
							<div class="form-group">
								<label class=" control-label">학번*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_number" placeholder="학번">
								</div>
							</div>

							<div class="form-group">
								<label class=" control-label">생년월일*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_birthday" placeholder="생년월일">
								</div>
							</div>
							
							<div class="form-group">
								<label class=" control-label">전화번호*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_phone" placeholder="전화번호">
								</div>
							</div>
						</form>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" onclick = "signup_new();" data-dismiss="modal">회원가입</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
					</div>
                </div>
            </div>
        </div>
		
		<div class="modal fade" id="modal_findPW">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
						<h4><strong>회원가입</strong></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body">
						<form class="form-horizontal" role="form" onsubmit="return false;" id="new_form">
							<div class="form-group">
								<label class="control-label">아이디*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_id" placeholder="아이디" maxlength="5">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">비밀번호*</label>

								<div class="">
									<input type="password" class="form-control" id="signup_password" placeholder="비밀번호" maxlength="15">
								</div>
							</div>

							<div class="form-group">
								<label class=" control-label">이름*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_name" placeholder="이름" maxlength="10">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label">캠퍼스*</label>

								<select class="form-control" onchange="categoryChange('campus', this);" id="campus">
									<option value="" selected> </option>
									<?foreach($campus->result_array()as $row){echo"<option value=".$row["ID"].">".$row["name"]."</option>";}?>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label">단과대학*</label>
								
								<select class="form-control" onchange="categoryChange('college', this);" id="college">
									<option value="" selected> </option>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label">학과*</label>

								<select class="form-control" id="department">
									<option value="" selected> </option>
								</select>
							</div>
							
							<div class="form-group">
								<label class=" control-label">학번*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_number" placeholder="학번">
								</div>
							</div>

							<div class="form-group">
								<label class=" control-label">생년월일*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_birthday" placeholder="생년월일">
								</div>
							</div>
							
							<div class="form-group">
								<label class=" control-label">전화번호*</label>

								<div class="">
									<input type="text" class="form-control" id="signup_phone" placeholder="전화번호">
								</div>
							</div>
						</form>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" onclick = "signup_new();" data-dismiss="modal">회원가입</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
					</div>
                </div>
            </div>
        </div>
	</body>
</html>