	
<html>
	<head>
		<title>
			폼 전송 쇼핑몰 실습
		</title>
	</head>
	
	</body>
	
	<?
		echo "회원가입 성공!!";
		
		echo "<br>";
		
		echo $_POST["first_text"];
		echo $_POST["my_radio"];
		
		echo "<br>";
		
		echo "생년월일: ";
		echo $_POST["년"];
		echo "년 ";
		echo $_POST["월"];
		echo $_POST["일"];
		echo "일 ";
		
		echo "<br>";
	?>
	
	<p>
		관심사 :
		<?
			for($i = 0; $i < sizeof(
		$_POST["my_checkbox"]); $i++){
			if ($i == 0) echo
		$_POST["my_checkbox"][$i];
			else echo ",".$_POST["my_checkbox"][$i];
		}
		?>
	</p>
	</body>
</html>

