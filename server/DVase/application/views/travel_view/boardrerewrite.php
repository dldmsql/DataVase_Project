
		
		<div id="nonelook" style="margin-top:30px, margin-left:30px "> 
			
			<?php
				foreach ( $result->result_array() as $row ){
					echo "<input type='text' id='Retitle' style='background-color:#f0f0f0;' maxlength='30' size='50%' value='".$row["title"]."'><p></p>
						<textarea id='Recontent' cols='50' rows='20'>".$row["content"]."</textarea><p></p>
						<input type='text' id='Rename' maxlength='5' size='20%' value='".$row["name"]."'><P></P>
						<input type='password' id='Repassword' maxlength='4' size='20%' value='".$row["password"]."'> <font color='red'>비밀번호는 숫자만 입력해주세요.</font>
						<input type='hidden' id='Revalue' value='".$row["Value"]."'>";
				
				}
	
			?>
			
			<button type="button" onclick="go('https://travel-plus.co.kr/board/in');" style="margin-left:30px;"> 수정하기 </button>
				
	
		
		
		</div>

		