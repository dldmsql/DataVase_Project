<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dvase extends CI_Controller{

    public function index(){
        echo "DVase222";
    }

    public function identifyPlants(){
        $command = escapeshellcmd( "python /var/www/html/dvaseFolder/testPython.py" );
        $output = shell_exec( $command );

        echo $output;
    }
    
    public function file_upload()
    {
        $this->load->library( "upload" );
        // $this->load->library( "image_lib" );

        $config = array(
            "upload_path"   => "/var/www/html/img/dvase",
            "allowed_types" => "*",
            "max_size"      => 102400,
            "overwrite"     => true
        );

        $this->upload->initialize( $config );

        $FILES = $_FILES;

        /*for ( $i = 0; $i < sizeof( $FILES["userfile"]["name"] ); $i++ ){
           $_FILES["userfile"]["name"] = $FILES["userfile"]["name"][$i];
           $_FILES["userfile"]["type"] = $FILES["userfile"]["type"][$i];
           $_FILES["userfile"]["tmp_name"] = $FILES["userfile"]["tmp_name"][$i];
           $_FILES["userfile"]["error"] = $FILES["userfile"]["error"][$i];
           $_FILES["userfile"]["size"] = $FILES["userfile"]["size"][$i];*/

        if ( $this->upload->do_upload() ) echo "uploaded";
        else echo "failed";
        // }
    }
}
?>