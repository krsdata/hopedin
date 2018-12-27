<?php 
include 'functions.php';
$db=new functions();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hopedin</title>

    <!-- Bootstrap -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link rel="stylesheet" href="build/css/intlTelInput.css">
    <link rel="stylesheet" href="build/css/demo.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	<script src="https://use.fontawesome.com/a832a5b49f.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/custom.js?time=<?php echo time(); ?>"></script> 
  </head>
  <style>
  .margin-top
  {
	  margin-top: 10px;
  }
  .intl-tel-input.separate-dial-code .selected-dial-code
  {
	 padding-left: 13px !important;
  }
  </style>