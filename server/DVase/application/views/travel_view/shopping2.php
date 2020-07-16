<?php
	foreach ( $result->result_array() as $row ){
		echo $row["name"]." ".$row["adress"]." ".$row["color"]." ".$row["number"]." ".$row["Registered"]."<br>";
	}
	
?>
