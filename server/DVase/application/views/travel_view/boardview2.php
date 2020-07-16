<?php
	echo"<table class='table'>
					<thead class='thead-dark'>
					<tr> <th scope='col'> 번호 </th> <th scope='col'> 제목 </th> <th scope='col'>작성자</th> <th scope='col'> 작성일 </th>
					<th><button type='button' onclick='wir(\"https://travel-plus.co.kr/board/write\");' class='myButton'> 작성하기 </button></th></tr>
					</thead>
					<tbody>";
	$i =1;
					
	foreach ( $result->result_array() as $row ){
		

		echo "<tr><th scope='row'>No.".$i." </th><td> ".$row["title"]." </td><td> ".$row["name"]."</td><td> ".substr($row["Registered"],0,10)."</td><td><button id='contentlook' onclick=\"lok('".$row["Value"]."');\" class='btn btn-outline-primary'><font class='font1'>내용보기</font></button></td></tr>";
					
	$i++;
					}
	echo "</tbody>
				</table>";
	
?>
