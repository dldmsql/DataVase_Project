<html>
	<head> 
		<title> form1 </title>
	</head>
	
	<body>
		<form action="form2.php" method="post">
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