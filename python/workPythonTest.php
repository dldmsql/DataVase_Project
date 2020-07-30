<?

	$command = escapeshellcmd( "python 파일경로" );
	$output = shell_exec( $command );
	
	echo $output;

?>