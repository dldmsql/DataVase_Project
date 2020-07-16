<form class="form-inline my-2 my-lg-0">
	<div class="ml-auto mr-auto div_dropdown">
		<select class="form-control" id="campus" placeholder="캠퍼스" onchange="categoryChange('campus',this);">
				<? 
					foreach( $campus->result_array() as $row ){
						echo "<option value=".$row["ID"].">".$row["name"]."</option>";
						}
				?>
		<select>
		<select class="form-control" id="college" onchange="categoryChange('college',this);">
			<option value="" selected>교양</option>
		<select>
		<select class="form-control" id="department" >
			<option value="" selected>영어교양</option>
		<select>
		<button class="btn btn-secondary my-2 my-sm-0" type="button" onclick="lecturesearch();">강의검색</button>
	</div>
</form>