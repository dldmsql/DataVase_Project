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
					"http://travel-plus.co.kr/torder/mdtools",
					{nameOrder: document.getElementById("orderName").value, 
						adressOrder: document.getElementById("orderAdress").value,
						colorOrder: document.getElementById("orderColor").value,
						numberOrder: document.getElementById("orderNumber").value},
					function( data ) {
						document.getElementById("shoppingcheck").innerHTML = data;
						
					}
				);
			}
			
			function check(){
				$.post(
					"http://travel-plus.co.kr/torder/mdcheck",
					{nameCheck: document.getElementById("checkName").value}, 
					function( data ) {
						document.getElementById("shoppingcheck").innerHTML = data;
						
					}
				);
			}
			
			function del( d ){
				
				$.post(
					"http://travel-plus.co.kr/torder/de",
					{delValue: d},
					function( data ) {
						
						document.getElementById("shoppingcheck").innerHTML = data;
						
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
						<image src="http://52.78.83.148/htdocs/image/blackt" height="20%"> <br> <h3 align="center">검정</h3>
					</td>
					<td>
						<image src="http://52.78.83.148/htdocs/image/oranget" height="20%"> <br> <h3 align="center">오렌지</h3>
					</td>
					<td>
						<image src="http://52.78.83.148/htdocs/image/stripet" height="25%"> <br> <h3 align="center">줄무늬</h3>
					</td>
				</tr>
			</table></p>
			
				<p><p><p> <br> &nbsp &nbsp <strong> <mark> 주문 내역서 </mark> </strong> &nbsp &nbsp <strong style="margin-left:150px;"> <mark> 주문확인 </mark> </strong>
				<p style="margin-left:10px"> 
				<input type="text" name="orderColor" id="orderColor" placeholder="T-shirt 이름"> <input type="text" id="checkName" placeholder="주문자 이름" style="margin-left:100px;"> 
				<br>
				<input type="text" name="orderNumber" id="orderNumber" placeholder="수량"> 
				<br>
				<input type="text" name="orderName" id="orderName" placeholder="이름"> <button type="button" onclick="check();" style="margin-left:150px;"> 전송 </button>
				<br> 
				<input type="text" name="orderAdress" id="orderAdress" placeholder="주소"> </p>
				
				<button type="button" onclick="go();" style="margin-left:50px; margin-right:100px;"> 전송 </button>   

				
		</form>
		
		
		
		<div id="shoppingcheck"  style="border-top:2px solid green; border-bottom:2px solid green; border-left:5px solid green; border-right:2px solid green; padding:10px; width:35%;">
			
					<?php foreach ( $result->result_array() as $row ){
						echo $row["name"]." ".$row["color"]." ".$row["number"]."개 ".$row["Registered"]."&nbsp id:  ".$row["Value"]."<br>";
							}?>
					
		</div>
	</body>
	
</html>