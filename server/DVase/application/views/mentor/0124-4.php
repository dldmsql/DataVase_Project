<html>
	<head> 
		<title> 0124-4 </title>
	</head>
	
	<body>
		<form action="15.164.251.97/mentor/mabangjin2" method="post">
			<select name="max">
			<?
				for( $i = 1; $i <= 99; $i+=2 ){
					echo "<option value='".$i."'>".$i."*".$i."</option>";
				}
			?>
			</select>

			<input type="submit" value="make">
		</form>
	</body>
</html>