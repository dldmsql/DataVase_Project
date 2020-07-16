<!-- 마방진 만들기 -->

<html>
	<head> 
		<title> 0124-5 </title>
	</head>
	
	<body>
	
	<?
	
		$max = $_POST["max"];
		
		for( $x = 0; $x < $max; $x++ ){
			for( $y = 0; $y < $max; $y++ ){
				$arr[$x][$y] = "";
			}
		}
		
		$max_value = $max * $max;
		
		$x = 0;
		$y = (int) ( $max / 2 );
		
		$arr[$x][$y] = 1;
		
		for( $p = 2; $p <= $max_value; $p++ ){
			$x = $x - 1;
			$y = $y + 1;
			
			if( ( $y >= $max ) && ( $x < 0 ) ){
				$y = $y - 1;
				$x = $x + 2;
			}
			
			if ( $x < 0 ){
				$x = $max - 1;
			}	
			
			if ( $y >= $max ){
				$y = 0;
			}
			
			if ( $arr[$x][$y] != "" ){
				$x = $x + 2;
				$y = $y - 1;
			}
			
			$arr[$x][$y] = $p;
		}
		
		echo "<table border='1'>";

		for( $x = 0; $x < $max; $x++ ){
			echo "<tr>";

			for ( $y = 0; $y < $max; $y++ ){
				echo "<td align='center'>".$arr[$x][$y]."</td>";
			}

			echo"</tr>";
		}
		echo "</table>";
	
	?>
	</body>
</html>