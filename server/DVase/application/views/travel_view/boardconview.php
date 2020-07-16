<div style="margin-top:30px; margin-left:30px;" id="contentlook"> 
			
			<?php
				foreach ( $result->result_array() as $row ){
					echo"<div class='d-inline p-2 bg-light text-black'> 제목 : ".$row["title"]."</div>
						<div class='d-inline p-2 bg-light text-black' > 작성일 : ".substr($row["Registered"],0,10)."</div><p></p>
						<div id='boardbutcon'><div id='boardcon' class='divcon' style='background-color:#f0f0f0 border-top:2px solid black; border-bottom:2px solid black; border-left:5px solid black; border-right:2px solid black;'>".$row["content"]."</div>
						<button onclick=\"rep('".$row["Value"]."');\" class='myButton-con'><font class='font1'>답변달기</font></button>
						<button onclick=\"godel('".$row["Value"]."');\" class='myButton-con'><font class='font1'>삭제하기</font></button>
						<button onclick=\"gorew('".$row["Value"]."');\" class='myButton-con'><font class='font1'>수정하기</font></button>
						</div><button onclick=\"golist('https://travel-plus.co.kr/board/in');\" class='myButton-go'><font class='font1'>전체목록</font></button>
						";
					
				}
				
				
			?>
			
			
</div>
		