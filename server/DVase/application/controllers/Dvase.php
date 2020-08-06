<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dvase extends CI_Controller{

    public function index(){
        $a = 1;
        $b = $a + 5;
        $c = 1;

        echo $a;
        echo "DVase222";
    }

<<<<<<< HEAD
    public function identifyPlants(){
        $command = escapeshellcmd( "python /var/www/html/dvaseFolder/testPython.py" );
        $output = shell_exec( $command );

        echo $output;
    }
    
=======
>>>>>>> 657417fd66e9561ebb48dac62946f2f3a50fe77a
    public function file_upload()
    {
        echo "hi";

        $this->load->library( "upload" );
        // $this->load->library( "image_lib" );

        $config = array(
            "upload_path"   => "/var/www/html/img",
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

<<<<<<< HEAD
        if ( $this->upload->do_upload() ) echo "uploaded";
        else echo "failed";
        // }
=======
        if ( $this->upload->do_upload() ) $result = array( "result" => "success" );
        else $result  = array( "result" => "error" );

        print( json_encode( $result ) );
        // }


        //$file_path = "";
        //$file_path = $file_path . basename($_FILES['uploaded_file']['name']);
        //if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        //    // 동일한 파일명이면 덮어쓰기를 한다.
        //    $result = array("result" => "success");
        //} else {
        //    $result = array("result" => "error");
        //}
        //echo json_encode($result);
>>>>>>> 657417fd66e9561ebb48dac62946f2f3a50fe77a
    }
}
?>