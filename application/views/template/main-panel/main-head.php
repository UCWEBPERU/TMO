<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $modulo->titulo_pagina; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Path -->
    <base href="<?php echo base_url();?>">
    <!-- Icon Page -->
    <link rel="icon" href="<?php echo $modulo->icono_empresa; ?>" type="image/png">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_BOOTSTRAP; ?>css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_DIST; ?>css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_DIST; ?>css/skins/skin-blue.min.css">
    <!-- My Theme style -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_ADMIN; ?>css/style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta property="og:url"                content="http://www.uc-web.mobi/TMO/store/12/admin" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?php echo $modulo->titulo_pagina; ?>" />
    <meta property="og:description"        content="<?php echo $modulo->titulo_pagina; ?>" />
    <meta property="og:image"              content="http://www.uc-web.mobi/TMO//uploads/store/12/logo/logo.png" />
  </head>