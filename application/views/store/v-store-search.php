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
    <script type="text/javascript" src="<?php echo PATH_RESOURCE_STORE; ?>js/jssor.slider.min.js"></script>
    <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie9.css" /><![endif]-->
</head>
<body>
<header>
    <!-- Nav lbslider -->
    <div id="jssor_1" style="position: relative; left: 0px; width: 980px; height: 100px; ">
        <!-- Loading Screen -->
        <div data-u="slides" id="slide" >
            <?php for ( $c = 0; $c < sizeof($modulo->data_categorias); $c++) { ?>
                <div>
                    <a href="<?php echo $modulo->base_url_store."/categories/".intval($modulo->data_categorias[$c]->id_categoria); ?>">
                        <p><?php echo strtoupper($modulo->data_categorias[$c]->nombre_categoria); ?></p>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</header>

<!-- Content -->
<content>

    <div class="col-xs-12" >
        <div class="row">
            <div class="col-xs-12" id="find">
                <form action="<?php echo $modulo->base_url_store."/search"; ?>" method="GET">
                    <input type="text" name="s" placeholder="Search <?php echo strtoupper($modulo->data_empresa->organization); ?>">
                </form>
            </div>
        </div>
        <div class="row">
            <div id="contenedor">
                <div class="col-xs-9 titlefind" >
                    <h2>BROWSE BY CATEGORY</h2>
                </div>
                <div class="col-xs-3 titlefind"  >
<!--                    <img src="--><?php //echo PATH_RESOURCE_STORE; ?><!--images/pic00.png" />-->
                </div>
            </div>
        </div>
        <?php foreach ($modulo->data_sub_categorias as $sub_categoria) { ?>
            <div class="row">
                <div id="contenedor">
                    <div class="col-xs-10 findcategories" >
                        <a href="<?php echo $sub_categoria->url_categoria; ?>" ><h2><?php echo strtoupper($sub_categoria->nombre_categoria); ?></h2></a>
                    </div>
                    <div class="col-xs-2 findcategories"  >
                        <a href="<?php echo $sub_categoria->url_categoria; ?>" ><img src="<?php echo PATH_RESOURCE_STORE; ?>images/right-arrow.png" /></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row" style="height: 50px;"></div>
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
            <a href="<?php echo $modulo->base_url_store; ?>/cart"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/cart.png" class="images" alt="" /></a>
            <h1><a href="<?php echo $modulo->base_url_store; ?>/cart" onclick="">Cart</a></h1>
        </div>
        <div class="boximage">
            <a href="<?php echo $modulo->base_url_store; ?>/account"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/setting.png" class="images" alt="" /></a>
            <h1><a href="<?php echo $modulo->base_url_store; ?>/account" onclick="">Account</a></h1>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script type="text/javascript" src="<?php echo PATH_RESOURCE_STORE; ?>js/handler-slider-menu.js"></script>
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