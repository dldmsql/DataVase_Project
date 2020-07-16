<html>
	<head> 
		<title> 0124-4 </title>
	</head>
	
	<body>
		<form action="0124-5.php" method="post">
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