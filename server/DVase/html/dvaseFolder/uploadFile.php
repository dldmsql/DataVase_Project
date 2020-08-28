<?php

	if(  file_exists( "./uploads/identified2.jpg" ) ){
		unlink( "./uploads/identified2.jpg" );
	}
	if( file_exists( "./uploads/identified.jpg" ) ) {
		unlink( "./uploads/identified.jpg" );
	}

	$file_path = "uploads/";
	$file_path = $file_path . basename( $_FILES['uploaded_file']['name']);

	if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
		rename( $file_path, "./uploads/identified2.jpg" );
		echo "업로드에 성공했습니다.";
	}
	else{
		echo "알 수 없는 이유로 업로드에 실패했습니다.";
	}

?>
