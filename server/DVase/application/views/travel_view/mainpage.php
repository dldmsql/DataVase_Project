<html>
	<head>
		<title> travel </title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				
	</head>
	
	<body>

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<div class="text-right " style="background-color: #e3f2fd;">
			<a class="mr-3 text-primary" href="http://52.78.83.148/homepage/mp"> 홈 </a>
			<a class="mr-3 text-primary" href=""> 로그인 </a>
			<a class="mr-5 text-primary" href=""> 회원가입 </a>
			
		</div>
		
		
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<a class="navbar-brand text-dark ml-5 mr-3" href="http://52.78.83.148/homepage/mp"> <h1 style="font-family: 나눔고딕 EXTRABOLD;"> 여행 Plus </h1> </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="http://52.78.83.148/homepage/travela/travelrecommand" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							여행지 추천
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="http://52.78.83.148/homepage/travela/korearecommand">국내</a>
							<a class="dropdown-item" href="http://52.78.83.148/homepage/travela/abroadrecommand">해외</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="http://52.78.83.148/homepage/travela/seasonrecommand">계절별</a>
						</div>
					</li>
					
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="http://52.78.83.148/homepage/travela/travelproduct" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							여행 상품
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="http://52.78.83.148/homepage/travela/koreaproduct">국내</a>
							<a class="dropdown-item" href="http://52.78.83.148/homepage/travela/abroadproduct">해외</a>
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
						<a class="nav-link dropdown-toggle" href="http://52.78.83.148/homepage/travela/mynewpage" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							마이페이지
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="http://52.78.83.148/homepage/travela/mypage">마이페이지</a>
						</div>
					</li>
					
				</ul>
				
				
				<form class="form-inline my-2 my-lg-0" action="travel-search.html">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0 mr-auto" type="submit">검색</button>
				</form>
			</div>
		</nav>
		
		<p></p>
		
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="http://52.78.83.148/htdocs/image/spring" alt="First slide" width="50%" height="76%">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="http://52.78.83.148/htdocs/image/summer" alt="Second slide" width="50%" height="76%">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="http://52.78.83.148/htdocs/image/fall" alt="Third slide" width="50%" height="76%">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="http://52.78.83.148/htdocs/image/winter" alt="Forth slide" width="50%" height="76%">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		
		<!-- 쓸모없는 글들 -->
		
		
		<p></p>
		
		
		<div class="text-black text-right bg-dark text-white mt-0">
			<h4 class="mr-1"> Email : kyuri99@naver.com Call : 010 - 5018 - 0816 </h4>
		</div>
		
	</body>
</html>