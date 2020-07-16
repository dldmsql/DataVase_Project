<? if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Library_lms {

	private $CI;

	public function __construct()
	{
		$this->CI = & get_instance();
	}

	public function return_true()
	{
		$data_json = array(
			KEY_POST_RETURN => VAL_POST_RETURN_TRUE
		);

		print ( json_encode( $data_json ) );
	}

	public function error_msg( $msg )
	{
	    if ( $msg == ERRORMSG_WRONGTOKEN ){
            if ( !( isset( $_POST ) && sizeof( $_POST ) > 0 ) || $this->CI->input->post( "is_new_window" ) == "true" ){
                echo "<p>이미 다른 기기에서 접속 중인 계정입니다.</p>";

                return false;
            }
        }

	    if ( ( isset( $_POST ) && sizeof( $_POST ) > 0 ) && $this->CI->input->post( "is_new_window" ) != "true" ){
            $data_json = array(
                KEY_POST_RETURN => VAL_POST_RETURN_FALSE,
                KEY_POST_MSG    => $msg
            );

            print ( json_encode( $data_json ) );
        }
        else echo $msg;

		return false;
	}

}
?>