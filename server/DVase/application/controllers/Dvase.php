<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dvase extends CI_Controller{

    public function index(){
        $a = 1;

        $b = $a + 2;

        if ( $b > 3 ) echo $c;

        echo $b;
        echo "DVase222dd";
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

        if ( $this->upload->do_upload() ) echo "uploaded";
        else echo "failed";
        // }
    }

    public function workPythonFile(){
        $command = escapeshellcmd( "python /var/www/html/dvaseFolder/testPython.py" );

        echo "Start";
        echo date( "h:i:s" );
        $output = shell_exec( $command );

        echo "Running";

        echo $output;

        echo "Finishing";
        echo date( "h:i:s" );
    }

    public function garden(){
        $this->load->view( "dvase/garden_list" );
    }

    public function removeFile(){
        unlink( "./dvaseFolder/uploads/testPicture.jpg" );

    }

    public function renameFile(){
        echo rename( "./img/test.jpg", "./img/mju.jpg" );
    }

    public function uploadFileManaging(){
        $file_path = "uploads/";
        $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);

        if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
            rename( $file_path, "./uploads/identified.jpg" );
            echo "업로드에 성공했습니다.";
        }
        else{
            echo "알 수 없는 이유로 업로드에 실패했습니다.";
        }
    }

    public function identifyPlant(){
        $command = escapeshellcmd( "python /var/www/html/dvaseFolder/testPython.py" );

        $output = shell_exec( $command );

        unlink( "./dvaseFolder/uploads/identified.jpg" );
        unlink( "./dvaseFolder/uploads/identified2.jpg" );

        echo $output;
    }

}
?>