<html lang="ko">

<head>

    <meta charset="euc-kr"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>

    <script>
function myAlertTop(){
  $(".myAlert-top").show();
  setTimeout(function(){
    $(".myAlert-top").hide(); 
  }, 2000);
}

function myAlertBottom(){
  $(".myAlert-bottom").show();
  setTimeout(function(){
    $(".myAlert-bottom").hide(); 
  }, 2000);
}
    </script>

	<style>
	.myAlert-top{
    position: fixed;
    top: 5px; 
    left:2%;
    width: 96%;
}

.myAlert-bottom{
    position: fixed;
    bottom: 5px;
    left:2%;
    width: 96%;
}

div.fullscreen {
  position: absolute;
  width:100%; 
  height:960px; 
  top: 0; 
  left: 0; 
  background-color: lightblue;
}

.alert{
    display: none;
}
</style>
	
</head>

<body>

   <div class="fullscreen">
  <div class="col-sm-6">
    <button class="form-control" onclick="myAlertTop()">show alert top</button>
  </div>
  <div class="col-sm-6">
    <button class="form-control" onclick="myAlertBottom()">show alert bottom</button>
  </div>
</div>
<div class="myAlert-top alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Indicates a successful or positive action.
</div>
<div class="myAlert-bottom alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.
</div>

</body>

</html>
