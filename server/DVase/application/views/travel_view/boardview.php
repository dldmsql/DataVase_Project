<html>

	<head> 

		<title> 게시판 </title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
		<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
		

		<script>
			
			function golist( k ){
				location.replace( k );
				/*$('#boardcontent').load("http://52.78.83.148/board/content");*/
			}
			
			function pgmove( a ){
				$.post(
					"http://52.78.83.148/board/pgmove",
					{pageNumber: a},
					function (data){
						document.getElementById("boardlist").innerHTML = data;
					}
				);
			}
			
			function wir(){
				$('#boardcontent').load("http://52.78.83.148/board/write");
			}
						
			function ins( k ){
				$.post(
					"http://52.78.83.148/board/boinsert",
					{titleInsert: document.getElementById("Inserttitle").value, 
						contentInsert: document.getElementById("Insertcontent").value,
						nameInsert: document.getElementById("Insertname").value,
						passwordInsert: document.getElementById("Insertpassword").value},
					function (data){
						location.replace( k );
					}
				);
			}
			
			/*function ncheck(){
				$.post(
					"http://52.78.83.148/board/nselect",
					{nameCheck: document.getElementById("Checkname").value}, 
					function( data ) {
						document.getElementById("boardlist").innerHTML = data;
					}
				);
			}
			function tcheck(){
				$.post(
					"http://52.78.83.148/board/tselect",
					{titleCheck: document.getElementById("Checktitle").value}, 
					function( data ) {
						document.getElementById("boardlist").innerHTML = data;
					}
				);
			}*/
			function actiont(){
				document.getElementById("Searchtype").value = "제목";
				document.getElementById("selcategory").innerHTML = "제목";
				/*$("#Searchtype").val = "제목";*/
			}
			
			function actionn(){
				document.getElementById("Searchtype").value = "이름";
				document.getElementById("selcategory").innerHTML = "이름";
			}
			
			function check(){
				$.post(
					"http://52.78.83.148/board/select",
					{searchType: document.getElementById("Searchtype").value,
						checkThing: document.getElementById("Checkthing").value},
					function( data ){
						document.getElementById("boardlist").innerHTML = data;
					}
				);
			}		

			function lok( a ){
				$.post(
					"http://52.78.83.148/board/conlok",
					{lookValue: a},
					function( data ){
						document.getElementById("boardcontent").innerHTML = data;
					}
				);			
			}
			
			function rep( a ){
					$.post(
						"http://52.78.83.148/board/repp",
						{repValue:a},
					function (data){
						document.getElementById("boardcontent").innerHTML = data;
					}
				);
			}
			
			function com(){
				$.post(
					"http://52.78.83.148/board/reply",
					{contentReply: document.getElementById("Replycontent").value,
						nameReply: document.getElementById("Replyname").value,
						valueReply: document.getElementById("Replyvalue").value},
					function (data){
						document.getElementById("boardcontent").innerHTML = data;
					}
				);
			}
			
			function gorew( d ){
				$.post(
					"http://52.78.83.148/board/actionpass",
					function (data){	
						document.getElementById("boardbutcon").innerHTML = data;
						document.getElementById("Hidden").value = d;
						document.getElementById("Action").value = 2;
						
						console.log(document.getElementById("Hidden").value);
						console.log(document.getElementById("Action").value);
					}
				);
			}
			
			function godel( d ){
				$.post(
					"http://52.78.83.148/board/actionpass",
					function (data){
						document.getElementById("boardbutcon").innerHTML = data;
						document.getElementById("Hidden").value = d;
						document.getElementById("Action").value = 1;
						/*$('#boardcon').load("http://52.78.83.148/board/actionpass");
						$("#Hidden").val = d;
						$("#Action").val = 1;*/
						console.log(document.getElementById("Hidden").value);
						console.log(document.getElementById("Action").value);
					}
				);
			}
			
			function pwcheck(){
				var b = document.getElementById("Action").value;
				
				$.post(
					"http://52.78.83.148/board/pwcheck",
					{passwordCheck: document.getElementById("Checkpw").value,
						lookValue: document.getElementById("Hidden").value},
					function (data){
						var a = data;						
						if ( a >= 0 ){	
							if ( b=="1" ){
								$.post(
									"http://52.78.83.148/board/de",
									{delValue: a},
									function( data ) {
										document.getElementById("boardcontent").innerHTML = data;
									}
								);
							}
							else if ( b==2 ){
								$.post(
								"http://52.78.83.148/board/rere",
								{recheckValue: a},
								function (data){
									document.getElementById("boardcontent").innerHTML = data;
									}
								);
							}
							else{
								alert("작동이 안됩니다!!");
							}
						}
						else{
							alert( a + "!!!!" );
						}
					}	
				);		
			}
			
			function go(k){
				$.post(
					"http://52.78.83.148/board/rewrite",
					{titleRe: document.getElementById("Retitle").value, 
						contentRe: document.getElementById("Recontent").value,
						nameRe: document.getElementById("Rename").value,
						passwordRe: document.getElementById("Repassword").value,
						valueRe: document.getElementById("Revalue").value},
					function (data){
						location.replace( k );
					}
				);
			}
			/*function pwcheck(){
				$.post(
					"http://52.78.83.148/board/pw",
					{passwordCheck: document.getElementById("Checkpw").value,
						lookValue: document.getElementById("Hidden").value}, 
					function (data){
						var a = data;
						if ( a >= 0 ){
							$.post(
								"http://52.78.83.148/board/rere",
								{recheckValue: a},
								function (data){
									document.getElementById("body").innerHTML = data;
								}
							);
						}
						else{
							alert( a + "!!!!" );
						}
					}						
					function( data ) {
						document.getElementById("boardcontent").innerHTML = data;
					}
				);
			}*/
			function bold(obj){
				$( ".fonttype" ).removeClass( "fonttype" );
				$( ".fonttype2" ).removeClass( "fonttype2" );
				$( ".cursor" ).removeClass( "fonttype" );
				$( obj ).addClass( "fonttype" );
			}
			/*function re( a ){
				document.getElementById("Hidden").value = a;			
				obj=document.getElementById("Checkpassword"); 
				if(obj.style.display == "none") {
					obj.style.display="inline"; 
				}
				else{ 
					obj.style.display="inline";
				}
			}*/
			
			/*function naver(){
				 window.open("https://www.naver.net", "네이버새창", "width=800, height=700, toolbar=no, menubar=no, scrollbars=no, resizable=yes" );  
			}*/  
			
		</script>
		
		<style>
		
			.div1 {
				display: inline-block;
				border: 2px solid black; 
				padding: 5px 15px; 
				font-weight: bold; 
				letter-spacing: 3px; 
				font-size: 1.2em; 
				margin-top: 200px; 
				margin-left:20px; 
				margin-bottom: 100px;
				margin-right: 100px;
				background-color: white;
			}
			
			.div2 {
				display: inline-block;
				
				background-color: yellow;
			}
			.div3{
				display: inline-block;
				
			}
			.div4{
				display: flex;
				justify-content: around;
				
			}
			.h-board{
				
			}
			.font1{
				font-weight: bold;
				
			}
			.fonttype{
				font-weight: bold;
			}
			
			.fonttype2{
				font-weight: bold;
				color: #FF0000;
			}
			
			.cursor{
				color: black;
			
			}
			.cursor:hover{
				color: red;
				cursor: pointer;
			}
			
			.table {
				color:#616971;
				font-size:15px;
				border-spacing:0;
				font-family:맑은고딕;
			}
			
			.th {
				background:#D5D5D5;
			}
			.btn1{
				border-radius: 8px;

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

			.list{
				
			}
			
			.search{
				 display: inline-block;
			}
			
			.divcon{
				width: 100%;
				height: 50%;
				border-top:2px solid black; 
				border-bottom:2px solid black; 
				border-left:2px solid black; 
				border-right:2px solid black;
			}
			
			<!--list {
				float:left;
			
			}
			
			password {
			password {
				display:none;
				float:left;
			}
			
			app {
				display: float;
			}-->
		</style>
		
		
	</head>

	<body id="body">
	
	
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<a class="text-dark ml-5 mr-3" href=""> <h1 style="font-family: 나눔고딕 EXTRABOLD;"> 여행 Plus </h1> </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							여행지 추천
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="">국내</a>
							<a class="dropdown-item" href="">해외</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="">계절별</a>
						</div>
					</li>
					
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							여행 상품
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="">국내</a>
							<a class="dropdown-item" href="">해외</a>
					</li>
					
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							자유게시판
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="">여행후기</a>
							<a class="dropdown-item" href="">추천사이트</a>
							<a class="dropdown-item" href="http://52.78.83.148/board/in">자유게시판</a>
						</div>
					</li>
					
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							마이페이지
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="">마이페이지</a>
						</div>
					</li>
					
				</ul>
				
				
				<form class="form-inline my-2 my-lg-0" action="travel-search.html">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0 mr-auto" type="submit">검색</button>
				</form>
			</div>
		</nav>
		
	<div class="div4">	
	
			
		
		<!--<div class="div1">
		
			
			<br>
			
			
			<ul class="nav flex-column" >
				<li class=""> 
					<a class="nav-link active" href=""><font class="text-primary"> 여행지 추천</font></a>
						<ul type="circle">
							<li class="text-black"> <h6 class="cursor" onclick="bold(this);">   국내 <h6></li>
							<li class="text-black"> <h6 class="cursor"onclick="bold(this);">  해외 </h6> </li>
							<li class="text-black">  <h6 class="cursor" onclick="bold(this);">  계절별 </h6> </li>
						</ul>
				</li>
				
				<br>
				
				<li class="">
					<a class="nav-link" href=""><font class="text-primary">  여행상품</font></a>
						<ul type="circle">
							<li class="text-black">  <h6 class="cursor" onclick="bold(this);">  국내 </h6> </li>
							<li class="text-black"> <h6 class="cursor" onclick="bold(this);">  해외 </h6>  </li>
						</ul>
				</li>
				
				<br>
				
				<li class="">
					<a class="nav-link" href=""><font class="text-primary"> 자유게시판</font></a>
						<ul type="circle">
							<li class="text-black"> <h6 class="cursor" onclick="bold(this);">   여행후기 </h6>  </li>
							<li class="text-black">  <h6 class="cursor" onclick="bold(this);">  추천사이트 </h6> </li>
							<li class="text-black">  <h6 class="cursor" onclick="bold(this);">  자유게시판 </h6> </li>
						</ul>
				</li>
				
				<br>
				
				<li class="">
					<a class="nav-link" href=""><font class="text-primary"> 마이페이지</font></a>
						<ul type="circle">
							<li class="text-black">  <h6 class="cursor" onclick="bold(this);">  마이페이지 </h6> </li>
						</ul>
				</li>
				
				<br>
			
			</ul>
		
		</div>-->
		
		
		
		<div class="div3">
		
			<div class="h-board">
				<h1> 게시판 </h1><img src="http://52.78.83.148/htdocs/image/spring.jpg">
			</div>
				
						
			<!--<div id="boardcontent"  style="border-top:2px solid green; border-bottom:2px solid green; border-left:5px solid green; border-right:2px solid green;width:35%;">
					
			</div>
			
			<div id="Checkpassword" class="password" style="border-top:2px solid red; border-bottom:2px solid red; border-left:5px solid red; border-right:2px solid red;width:35%; display:none;">
		
				<font color="red"> 비밀번호를 입력하세요. </font>
				
				<p></p>
				
				<input type="password" id="Checkpw" placeholder="비밀번호" maxlength="4" size="20%">
				
				<input type="hidden" id="Hidden">
				
				<button type="button" onclick="pwcheck();"> 확인 </button>
			
			
			</div>-->
			
			
			<p></p>
		
						
			<p></p>
			
			
		
			<div id="boardcontent" class="container">
				
				
		
			<div id="boardlist" class="list" style="margin-top:30px;">
			
			
			
				<table class="table table-hover">
					<thead class="thead-dark">
					<tr> <th scope="col"> 번호 </th> <th scope="col"> 제목 </th> <th scope="col">작성자</th> <th scope="col"> 작성일 </th>
					<th><button type="button" onclick="wir();" class="myButton"> 작성하기 </button></th></tr>
					</thead>
					<tbody>
				
					<?php
					
					$i =1;
					
					foreach ( $result->result_array() as $row ){
					
						echo "<tr><th scope='row'>No.".$i." </th><td> ".$row["title"]." </td><td> ".$row["name"]."</td><td> ".substr($row["Registered"],0,10)."</td><td><button id='contentlook' onclick=\"lok('".$row["Value"]."');\" class='myButton-con'><font class='font1'>내용보기</font></button></td>
						</tr>";
					$i++;

					}?>
				
				</tbody>
				</table>
				
				</div>
				
				<nav aria-label="Page navigation example" class="align-middle">
				
				<ul class="pagination">
					<li class="page-item">
						<a class="page-link" href="#" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						</a>
					</li>
					<li class="page-item"><button class="page-link" onclick="pgmove(1);">1</button></li>
					<li class="page-item"><button class="page-link" onclick="pgmove(2);">2</button></li>
					<li class="page-item"><button class="page-link" onclick="pgmove(3);">3</button></li>
					<li class="page-item"><button class="page-link" onclick="pgmove(4);">4</button></li>
					<li class="page-item"><button class="page-link" onclick="pgmove(5);">5</li>
					<li class="page-item">
						<a class="page-link" href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						</a>
					</li>
				</ul>
			</nav>
				
				<input type="hidden" id="chValue">
				
				
			<div id="boardsearch">
				<div class="dropdown search">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span id="selcategory">전체</span>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="javascript:actiont();">제목</a>
					<a class="dropdown-item" href="javascript:actionn();">이름</a>
				</div>
			</div>
				<input type="hidden" id="Searchtype">
				
				<input type="text" id="Checkthing" size="20%">
				<button type="button" onclick="check();" style="margin-left:30px;"> 검색 </button>
					
					
			</div>
			
			
			
			
			
			
			
			
			
<p></p>
			
			<!------------------------------------------<br>
			<input type="text" id="Checkname" placeholder="이름" size="20%" > 
			<button type="button" onclick="ncheck();" style="margin-left:30px;"> 이름검색 </button>
			
			<p></p>
			----------------------------------------<br>
			<input type="text" id="Checktitle" placeholder="제목" size="20%"> 
			<button type="button" onclick="tcheck();" style="margin-left:30px;"> 제목검색 </button>
			
			<p></p>
			
			</div>
			
			<!--
			foreach ( $result->result_array() as $row ){
						echo "<tr><th scope='row'>No.".$i." </th><td> ".$row["title"]." </td><td> ".$row["name"]."</td><td> ".$row["Registered"]."</td><td><button id='contentlook' onclick=\"lok('".$row["Value"]."');\" class='btn btn-outline-primary'><font class='font1'>내용보기</font></button></td>
						<td><button onclick='rep(".$row["Value"].");' style=''>답변달기</button></td><td><button id='contentrewrite' onclick=\"re('".$row["Value"]."');\" style=''>수정하기</button></td><td><button onclick='del(".$row["Value"].");' style=''>삭제하기</button></td></tr>";
					
			<button type="button" onclick="wir('http://52.78.83.148/board/write');" class="myButton"> 작성하기 </button>
			
			<button type="button" onclick="naver();"> 네이버 </button>-->

		</div>
	</div>
	</body>	
		
</html>