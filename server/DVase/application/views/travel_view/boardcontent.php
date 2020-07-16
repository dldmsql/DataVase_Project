
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
					
			<button type="button" onclick="wir('https://travel-plus.co.kr/board/write');" class="myButton"> 작성하기 </button>
			
			<button type="button" onclick="naver();"> 네이버 </button>-->
