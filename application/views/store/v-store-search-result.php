<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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
<script>
    jssor_1_slider_init = function() {

        var jssor_1_options = {
            //$AutoPlay: true,
            $Idle: 0,
            //$AutoPlaySteps: 4,
            $SlideDuration: 1600,
            $SlideEasing: $Jease$.$Linear,
            $PauseOnHover: 4,
            $SlideWidth: 300,
            $Cols: 7

        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizing
        function ScaleSlider() {
            var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 809);
                jssor_1_slider.$ScaleWidth(refSize);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }
        ScaleSlider();
        $Jssor$.$AddEvent(window, "load", ScaleSlider);
        $Jssor$.$AddEvent(window, "resize", ScaleSlider);
        $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        //responsive code end
    };
</script>

<header>
    <!--	<div id="title">-->
    <!--		<h2>Fashion Store</h2>-->
    <!--	</div>-->
    <!-- Slider -->
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
    <?php if (sizeof($modulo->data_productos) > 0) { ?>
        <section id="toplist">
            <h2> Results for "<?php echo $modulo->keyrwords_search; ?>" </h2>
        </section>
    <?php } ?>

    <div class="col-xs-12">
        <div class="row">
            <div>
                <?php foreach ($modulo->data_productos as $producto) { ?>
                    <div class="col-xs-6 products" >
                        <a href="<?php echo $modulo->base_url_store."/products/".intval($producto->id_producto); ?>" ><img src="<?php echo $producto->galeria_producto[0]->url_archivo; ?>" class="images" alt="" /></a>
                        <h2><a href="<?php echo $modulo->base_url_store."/products/".intval($producto->id_producto); ?>" ><?php echo $producto->nombre_producto; ?></a></h2>
                        <h3><a href="<?php echo $modulo->base_url_store."/products/".intval($producto->id_producto); ?>" >$<?php echo $producto->precio_producto; ?></a></h3><h4><strike></strike></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php if (sizeof($modulo->data_productos) == 0) { ?>
            <div class="row">
                <div id="contenedor">
                    <div class="col-xs-10 findcategories" >
                        <h2>Your search "<?php echo $modulo->keyrwords_search; ?>" did not match any products.</h2>
                    </div>
                    <div class="col-xs-2 findcategories">
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
            <a href="cart.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/cart.png" class="images" alt="" /></a>
            <h1><a href="#" onclick="">Cart</a></h1>
        </div>
        <div class="boximage">
            <a href="account.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/setting.png" class="images" alt="" /></a>
            <h1><a href="#" onclick="">Account</a></h1>
        </div>
    </div>
</footer>

<script>
    jssor_1_slider_init();
</script>

<!-- Scripts -->
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel-viewport.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/util.js"></script>
<!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/respond.min.js"></script><![endif]-->
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/main.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/bootstrap.min.js"></script>

</body>
</html>