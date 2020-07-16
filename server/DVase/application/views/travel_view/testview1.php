
<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

		<script>
			function go(){
				$.post(
					"http://travel-plus.co.kr/testtest/process_post_data",
					{IdCheck: document.getElementById("IdInput").value},
					function( data ) {
						alert( data );
					}
				);
			}
		</script>
	</head>

	<body>
		
		<form>
		
			<input type="text" name="IdInput" id="IdInput">
		
	
			<button type="button" onclick="go();">중복확인</button>
			
		</form>
	</body>
</html>
