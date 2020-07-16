<html>
	<head> 
		<title> 회원가입용 </title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
		<style>
			.appear{
				color: black;
			}
			
			.errornormal{
				color: white;
			}
			
			input:invalid {
				border: 1.5px dashed red;
				}

			input:valid {
				border: 2px solid black;
				}
		</style>
		
		<script>
				/*
				var a = document.getElementById( "sPasswdInput" ).value;
				var b = document.getElementById( "sPasswdConfirmInput" ).value;
				
				/*if( a.length )
				
				
				if ( a == "" ){
					alert ("비밀번호는 필수입력사항입니다.");
					
					return;
				}
				else if ( b == "" ){
					alert ("비밀번호 확인은 필수입력사항입니다.");
					
					return;
				}

				
				else if ( a == b ){ 
					$( "#passworderror" ).removeClass("appear");
					}
				}
				
				else if ( a !== b ){
					$( "#passworderror" ).addClass("appear");
					
				}
				
			
			}*/
			
			function go(){
				
				var form = document.getElementById("ValidationCheck");
			
				if ( !form.checkValidity() ){
					form.reportValidity();
				
					return false;
					
				}
				
				$.post(
					"new2.php",
					{nameCheck: document.getElementById("nameInput").value, 
						idCheck: document.getElementById("IdInput").value, 
						passwdCheck: document.getElementById("sPasswdInput").value, 
						phoneCheck: document.getElementById("PhoneInput").value},
					function( data ) {
						alert( data );
					}
				);
			}
				
				
		</script>
	</head>
	
	<body>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		
		
		<form id="ValidationCheck">
			
			<div class="col-lg-8 col-md-12">
			<table border="1" class="table">
				<tr>
					<td class="bg-light"> <h6 class="ml-3 mr-3 text-left font-weight-bold "> 아이디 <font color="red">*</font> </h6> </td> 
					<td> <input class="form-control mr-3" type="text" name="IdInput" id="IdInput" maxlength="12" size="20%" required pattern="[a-z][a-z0-9_-]{3,11}">
						<font class="mr-1" size="2"> 아이디를 </font> 
						<font class="mr-1" size="2"> 입력해 </font> 
						<font class="mr-1" size="2"> 주십시오. </font> 
						<font class="mr-1" size="2">(영소문자/숫자, </font> 
						<font class="mr-1" size="2"> 12자 </font> 
						<font class="mr-1" size="2"> 이내) </font> 
					</td>
				</tr>
				<tr>
					<td class="bg-light"> <h6 class="ml-3 mr-3 text-left font-weight-bold"> 비밀번호 <font color="red">*</font> </h6> </td>
					<td> <input class="form-control mr-3" type="password" name="sPasswdInput" id="sPasswdInput" maxlength="20" size="20%" required pattern="[A-Za-z0-9-_]{8,16}"> 
						<font class="mr-1" size="2"> 영문 </font> 
						<font class="mr-1" size="2">대소문자/숫자 </font> 
						<font class="mr-1" size="2"> 조합, </font> 
						<font class="mr-1" size="2"> 8~16자 </font> 
						<font class="ml-5 mr-5"> </font> 
						<font class="ml-5 mr-5"> </font> 
					</td>
				</tr>
				<tr>
					<td class="bg-light"> <h6 class="ml-3 mr-3 text-left font-weight-bold"> 비밀번호 확인 <font color="red">*</font> </h6> </td>
					<td> <input class="form-control mr-3" type="password" name="sPasswdConfirmInput" id="sPasswdConfirmInput" maxlength="20" size="20%"> 
						<font class="mr-1 errornormal" size="2" id="passworderror"> 비밀번호가 </font> 
						<font class="mr-1 errornormal" size="2" id="passworderror"> 일치하지 </font> 
						<font class="mr-1 errornormal" size="2" id="passworderror"> 않습니다. </font> 
					</td>
				</tr>
				<tr>
					<td class="bg-light"> <h6 class="ml-3 mr-3 text-left font-weight-bold"> 이름 <font color="red">*</font> </h6> </td> 
					<td> <input class="form-control mr-3" type="text" name="nameInput" id="nameInput" maxlength="5" size="20%" required pattern="[가-힣]{2,5}"> </td>
				</tr>
				<tr>
					<td class="bg-light"> <h6 class="ml-3 mr-3 text-left font-weight-bold"> 휴대전화 <font color="red">*</font> </h6> </td> 
					<td> <input class="mt-2" type="tel" name="PhoneInput" id="PhoneInput" size="16%" required pattern="\d{11}">
							<font class="mr-1" size="2"> 01012345678와 </font>					
							<font class="mr-1" size="2"> 같은 </font>	
							<font class="mr-1" size="2"> 형식으로 </font>		
							<font class="mr-1" size="2"> 입력하십시오. </font>		
					</td> 
				</tr>
				<tr>
					<td class="bg-light mt-2"> <h6 class="ml-3 mr-3 text-left font-weight-bold"> SNS 수신 여부 <font color="red">*</font> </h6> </td> 
					<td> <input class="ml-3 mr-1" type="checkbox" name="SNScheck"> 
						<font class="mr-1" size="2,"> 동의함 </font><br> 
						<font class="mr-1 ml-3 mb-1" size="2"> 사이트에서 </font>
						<font class="mr-1" size="2"> 제공하는 </font> 
						<font class="mr-1" size="2"> 유익한 </font> 
						<font class="mr-1" size="2"> 소식을 </font> 
						<font class="mr-1" size="2"> SNS로 </font> 
						<font class="mr-1" size="2"> 받으실 </font> 
						<font class="mr-1" size="2"> 수 </font> 
						<font class="mr-1" size="2"> 있습니다. </font> <br>
					</td>
					
				</tr>
				<tr>
					<td class="bg-light"> <h6 class="ml-3 mr-3 text-left font-weight-bold"> 이메일 <font color="red">*</font> </h6> </td> 
					<td> <input class="ml-3 mr-1" type="text" name="e-mailInput1" id="e-mailInput1" size="20%" > 
						<font class="" size="2,"> @ </font> 
						<input class="ml-1" type="text" name="e-mailInput2" id="e-mailInput2" size="20%"> 
						<select class="ml-3"> 
							<option> naver.com </option> 
							<option> daum.net </option> 
							<option> nate.com </option> 
							<option> hotmail.com </option> 
							<option> yahoo.com </option> 
							<option> korea.com </option> 
							<option> google.com </option> 
							<option> 직접입력 </option> 
						</select> 
					</td>
				</tr>
				<tr>
					<td class="bg-light mt-2"> <h6 class="ml-3 mr-3 text-left font-weight-bold"> 약관동의 <font color="red">*</font> </h6> </td> 
					<td> <input class="ml-3 mr-1" type="checkbox" name="agreecheck"> <font class="mr-1" size="2,"> 동의함 </font><br>
					</td>
				</tr>

			</table>
			</div>
			
			<button type="button" onclick="go();"> 회원가입 </button>
			
			
		
		</form>
	
	</body>
	
</html>