<?

    $command = escapeshellcmd( "sudo python /var/www/html/dvaseFolder/testPython.py" );
    $output = shell_exec( $command );

    echo $output;

?>
