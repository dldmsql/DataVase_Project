<div style="margin-top:30px, margin-left:30px"> 

			<textarea id="Replycontent" cols="50" rows="20" placeholder="내용을 입력하시오."></textarea>
			
			<p></p>
			
			<input type="text" id="Replyname" placeholder="작성자 이름" maxlength="5" size="20%"> 
			
			<input type='hidden' id='Replyvalue' value=" <?php foreach ( $result->result_array() as $row ) echo $row['Value'] ?>" >
			
			<P></P> 
			
			<button type="button" onclick="com();" style="margin-left:30px;"> 답변달기 </button>   
			
			<p></p>

		</div>