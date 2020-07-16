<html>

<head> 메일 보내기 </head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
<script>

public function send_mail( $data )
   {
       
      $from = "no-reply@travel-plus.co.kr";

      if ( isset( $data["to"] ) ) $to = $data["to"];
      else $to = "kyuri99@naver.com";

      $content = "";
      if ( isset( $data["content"] ) ) $content = $data["content"];

      $header = "From: ".$from."\nContent-Type: text/html";

      return mail( $to, $data["subject"], $content, $header );
   }
   </script>
   
   <body>
   
   <button type="button" onclick('mail')> 메일 보내기 </button>
  
  </body>
  
 </html>