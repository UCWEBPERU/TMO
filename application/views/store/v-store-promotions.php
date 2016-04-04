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
<header>
    <div id="title">
        <h2>Promotions</h2>
    </div>
</header>

<!-- Content -->
<content>
    <div class="col-xs-12">
        <div class="row">
            <div>
                <?php foreach ($modulo->data_productos as $producto) { ?>
                    <div class="col-xs-6 products" >
                        <a href="<?php echo $modulo->base_url_store."/promotions/".intval($producto->id_producto); ?>" ><img src="<?php echo $producto->galeria_producto[0]->url_archivo; ?>" class="images" alt="" /></a>
                        <h2><a href="<?php echo $modulo->base_url_store."/promotions/".intval($producto->id_producto); ?>" ><?php echo $producto->nombre_producto; ?></a></h2>
                        <h3><a href="<?php echo $modulo->base_url_store."/promotions/".intval($producto->id_producto); ?>" >$<?php echo $producto->precio_oferta; ?></a></h3><h4><strike></strike></h4>
                        <h4>$<del><?php echo $producto->precio_producto; ?></del></h4>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row" style="height: 50px;"></div>

    </div>

</content>
<footer>
    <div id="footer">
        <div class="boximage">
            <a href="<?php echo $modulo->base_url_store; ?>"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/home.png" class="images" alt="" /></a>
            <h2><a href="<?php echo $modulo->base_url_store; ?>" onclick="">Products</a></h2>
        </div>
        <div class="boximage">
            <a href="<?php echo $modulo->base_url_store; ?>/promotions"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/sale.png" class="images" alt="" /></a>
            <h1><a href="<?php echo $modulo->base_url_store; ?>/promotions" onclick="">Promotions</a></h1>
        </div>
        <div class="boximage">
            <a href="<?php echo $modulo->base_url_store; ?>/search"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/tool.png" class="images" alt="" /></a>
            <h1><a href="<?php echo $modulo->base_url_store; ?>/search" onclick="">Search</a></h1>
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