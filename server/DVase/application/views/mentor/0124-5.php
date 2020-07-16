<html>
	<head> 
		<title> 0124-5 </title>
	</head>
	
	<body>
	<?
		$max = $_POST["max"];

		for ( $i = 0; $i < $max; $i++ ){
			for ( $j = 0; $j < $max; $j++ ){
				$arr[$i][$j] = "";
			}
		}

		$max_value = $max * $max;

		$i = 0;

		$j = (int)( $max / 2 );

		$arr[$i][$j] = 1;

		for ( $p = 2; $p <= $max_value; $p++ ){
			$i = $i - 1;
			$j = $j + 1;

			if ( ( $i < 0 ) && ( $j >= $max ) ){
				$i = $i + 2;
				$j = $j - 1;
			}

			if ( $i < 0 ){
				$i = $max - 1;
			}

			if ( $j >= $max ){
				$j = 0;
			}

			if ( $arr[$i][$j] != "" ){
				$i = $i + 2;
				$j = $j - 1;
			}

			$arr[$i][$j] = $p;
		}

		echo "<table border='1'>";

		for( $i = 0; $i < $max; $i++ ){
			echo "<tr>";

			for ( $j = 0; $j < $max; $j++ ){
				echo "<td align='center'>".$arr[$i][$j]."</td>";
			}

			echo"</tr>";
		}
		echo "</table>";
	?>
	</body>
</html>