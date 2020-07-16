<nav class="navbar navbar-expand-lg navbar-info bg-info">
	<img src="http://127.0.0.1/img/mju.jpg" width="30" height="30" class="d-inline-block align-top" alt="">   
	<a class="navbar-brand text-white" href="#">
		      LMS 
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon text-danger"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto ml-auto">
			<li class="nav-item">
				<a class="nav-link text-white" href="javascript:actionlecture('<?$member["ID"]?>');">강의찾기</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="javascript:actionbasket('<?$member["ID"]?>');">책가방</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="javascript:actioninfor('<?$member["ID"]?>');">회원정보</a>
			</li>
		</ul>
	
		<form class="form-inline my-2 my-lg-0">
			<div class="col-auto">
				<select class="form-control" id="searchtype">
					<option> 강의명 </option>
					<option> 교수명 </option>
				<select>
			</div>
			<input class="form-control mr-sm-2" type="search" id="search">
			<button class="btn btn-outline-light my-2 my-sm-0" type="button" onclick="btnsearch();">검색</button>
		</form>
	</div>
</nav>

<div id="div_main">

</div>

<!--<div class="text-black text-right bg-dark text-white mb-0">
	<h4 class="mr-1"> Email : kyuri99@naver.com Call : 010 - 5018 - 0816 </h4>
</div>-->

	
	