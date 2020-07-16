<?php
	foreach ( $result->result_array() as $row ){
		echo $row["name"]." ".$row["color"]." ".$row["number"]."개 ".$row["Registered"]."&nbsp id: ".$row["Value"]."<button onclick='del(".$row["Value"].");' style='margin-left:50px;'>삭제하기</button><br>";
	}
	
?>
