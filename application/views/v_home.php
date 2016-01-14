<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TMO | Iniciar sesion</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<base href="<?php echo base_url();?>">
	<link rel="icon" href="<?php echo PATH_RESOURCE_ADMIN; ?>img/icon/icon_app.png" type="image/png">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="<?php echo PATH_RESOURCE_BOOTSTRAP; ?>css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo PATH_RESOURCE_DIST; ?>css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo PATH_RESOURCE_PLUGINS; ?>iCheck/square/blue.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition ">
	<!-- <body class="hold-transition" style="background: #4CAF50;"> -->
	<div class="login-box">
		<div class="login-logo">
			<div class="row">
				
				<img src="<?php echo PATH_RESOURCE_ADMIN; ?>img/icon/tmo_adminapp.png" height="400" width="400" alt="TMO"  align="center" style="max-width:400px; min-width:200px;" > 
				

			</div>
			<br/>
			<div class="row">
				
				<button id="btnAdmin" type="button" class="btn btn-primary btn-block btn-flat">Administrator</button>
				<button id="btnStore" type="button" class="btn btn-success btn-block btn-flat">Store</button>
				
				
			</div>
			
			
		</div><!-- /.login-logo -->
		

		</div><!-- /.login-box-body -->
	</div><!-- /.login-box -->

	

		<!-- jQuery 2.1.4 -->
		<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo PATH_RESOURCE_BOOTSTRAP; ?>js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>iCheck/icheck.min.js"></script>
		<script>
			$(function () {
				$("#btnAdmin").on("click", function(evt){
					evt.preventDefault();
					$(location).attr("href", "<?php echo base_url().'admin/login'; ?>");
					
				});
				$("#btnStore").on("click", function(evt){
					evt.preventDefault();
					$(location).attr("href", "<?php echo base_url().'admin'; ?>");
					
				});

			});
		</script>
		
</body>
</html>
