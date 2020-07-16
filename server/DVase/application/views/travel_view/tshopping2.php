<?php
	foreach ( $result->result_array() as $row ){
		echo $row["name"]." ".$row["color"]." ".$row["number"]."개 ".$row["Registered"]."&nbsp id: ".$row["Value"]."<br>";
	}
	
?>
