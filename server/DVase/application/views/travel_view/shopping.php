<html>

	<head> 

		<title> 쇼핑몰 </title>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		
		<script>
		
	
			function go(){
			
				/*var form = document.getElementById("ValidationCheck");
			
				if ( !form.checkValidity() ){
					form.reportValidity();
				
					return false;
					
				}*/
				
				$.post(
					"http://travel-plus.co.kr/order/mdtools",
					{nameOrder: document.getElementById("orderName").value, 
						adressOrder: document.getElementById("orderAdress").value,
						shirtOrder: document.getElementById("shirt").value,
						numberOrder: document.getElementById("number").value},
					function( data ) {
						document.getElementById("shoppingresult").innerHTML = data;
						
					}
				);
			}
			
			
		</script>
	
	</head>
	
	<body>
		<form id="ValidationCheck" style="margin-top:10px">
			
			<p style="margin-left:10px">
			<table border="1" class="table" width="80%" >
				<tr>
					<td>
						<image src="http://travel-plus.co.kr/htdocs/image/blackt" height="20%"> <br> <h3 align="center">검정</h3>
					</td>
					<td>
						<image src="http://travel-plus.co.kr/htdocs/image/oranget" height="20%">
					</td>
					<td>
						<image src="http://travel-plus.co.kr/htdocs/image/stripet" height="20%">
					</td>
				</tr>
			</table></p>
			
			<select id="shirt">
				<option id="black"> 검정 </option>
				<option id="orange"> 주황 </option>
				<option id="stripe"> 줄무늬 </option>
			</select>
			<select id="number">
				<option id="one"> 1개 </option>
				<option id="two"> 2개 </option>
				<option id="three"> 3개 </option>
				<option id="four"> 4개 </option>
				<option id="five"> 5개 </option>
			</select>
			
				<p><p><p> <br> &nbsp &nbsp <strong> <mark> 주문자 정보 </mark> </strong>
				<p style="margin-left:10px"> 
				<input type="text" name="orderName" id="orderName" placeholder="이름">
				<br>
				<input type="text" name="orderAdress" id="orderAdress" placeholder="주소"> </p>
				
				<button type="button" onclick="go();"> 전송 </button>
		</form>
		
		
		
		<div id="shoppingresult"  style="border-top:2px solid blue; border-bottom:2px solid blue; border-left:5px solid blue; border-right:2px solid blue; padding:10px;">
		</div>
	</body>
	
</html>