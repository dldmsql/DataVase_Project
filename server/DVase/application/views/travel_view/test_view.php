<html>
	<head>
		<title>View Test</title>
	</head>
	
	<body>
		<?php
			foreach ( $result->result_array() as $row ){
				echo $row["name"]." ".$row["id"]." ".$row["password"]." ".$row["nickname"]." ".$row["phone"]." ".$row["e-mail"]." ".$row["birthday"]."<br>";
			}
	
		?>
	</body>
</html>