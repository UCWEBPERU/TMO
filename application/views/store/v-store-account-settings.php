<!DOCTYPE HTML>
<html>
<head>
    <title>TMO</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Path -->
    <base href="<?php echo base_url();?>">
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie9.css" /><![endif]-->
</head>
<body>

<div>
    <!-- Header -->
    <header>
        <div id="title">
            <a href="<?php echo $modulo->base_url_store; ?>/account" >< Back</a>
            <h2>Account</h2>
        </div>
    </header>

    <!-- Content -->
    <content>

        <div class="col-xs-12" >
            <?php if ($modulo->has_user_session) { ?>
                <div class="row" id="contenedordetail">
                    <div>
                        <div class="col-xs-12 sign">
                             <div class="logo-company" style="background-image: url('<?php echo $modulo->icono_empresa; ?>');"  title="Logo Company"></div>
                            <h2 style="padding: 10px;">Change Name, E-mail or Password</h2>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
            <?php } ?>

            <div class="row">
                <div id="contenedorc">
                    <div class="col-xs-10 findcategories" >
                        <a href="item.html" ><h2>Name: <strong><?php echo $modulo->data_usuario->nombres_persona; ?></strong></h2></a>
                    </div>
                    <div class="col-xs-2 findcategories"  >
                        <a href="item.html" ><img src="<?php echo PATH_RESOURCE_STORE; ?>images/right-arrow.png" /></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="contenedorc">
                    <div class="col-xs-10 findcategories" >
                        <a href="<?php echo $modulo->base_url_store; ?>/account/account-settings"><h2>E-mail: <strong><?php echo $modulo->data_usuario->email_usuario; ?></strong></h2></a>
                    </div>
                    <div class="col-xs-2 findcategories"  >
                        <a href="<?php echo $modulo->base_url_store; ?>/account/account-settings"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/right-arrow.png" /></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="contenedorc">
                    <div class="col-xs-10 findcategories" >
                        <a href="item.html" ><h2>Password: <strong>**********</strong></h2></a>
                    </div>
                    <div class="col-xs-2 findcategories"  >
                        <a href="item.html" ><img src="<?php echo PATH_RESOURCE_STORE; ?>images/right-arrow.png" /></a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 detail" style="height: 200px;"></div>
        </div>

    </content>
    <footer>
        <div id="footer">
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/homes.png" class="images" alt="" /></a>
                <h2><a href="<?php echo $modulo->base_url_store; ?>" onclick="">Home</a></h2>
            </div>
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/search"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/tool.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/search" onclick="">Find</a></h1>
            </div>
            <div class="boximage">
                <a href="cart.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/cart.png" class="images" alt="" /></a>
                <h1><a href="#" onclick="">Cart</a></h1>
            </div>
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/account"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/setting.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/account" onclick="">Account</a></h1>
            </div>
        </div>
    </footer>
    <div class="fakeloader"></div>
    <!-- Scripts -->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel-viewport.min.js"></script>
    <!--<script src="--><?php //echo PATH_RESOURCE_STORE; ?><!--js/util.js"></script>-->
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/respond.min.js"></script><![endif]-->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.scrolly.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.placeholder.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/main.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/bootstrap.min.js"></script>
</body>
</html>