<!DOCTYPE HTML>
<html>
<head>
    <title>TMO</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Path -->
    <base href="<?php echo base_url();?>">
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>/js/ie/html5shiv.js"></script><![endif]-->
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
            <a href="<?php echo $modulo->base_url_store; ?>" ><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/left-arrow.png" class="images" alt="" /></a>
            <a href="<?php echo $modulo->url_button_back; ?>" >Back</a>
            <h2>Details</h2>
        </div>
    </header>

    <!-- Content -->
    <content>

        <div class="col-xs-12" >
            <div class="row" id="contenedordetail">
                <div>
                    <div id="contenedorCarousel">
                        <div id="myCarousel" class="carousel slide">
                            <?php if (sizeof($modulo->data_productos) > 0) { ?>
                                <?php $galeriaProducto = $modulo->data_productos[0]->galeria_producto; ?>
                                <ol class="carousel-indicators">
                                    <?php for ($c = 0; $c < sizeof($galeriaProducto); $c++) { ?>
                                        <?php if ($c == 0) { ?>
                                            <li data-target="#myCarousel" data-slide-to="<?php echo $c; ?>" class="active"></li>
                                        <?php } else { ?>
                                            <li data-target="#myCarousel" data-slide-to="<?php echo $c; ?>"></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ol>
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <?php for ($c = 0; $c < sizeof($galeriaProducto); $c++) { ?>
                                        <?php if ($c == 0) { ?>
                                            <div class="active item"><img  src="<?php echo $galeriaProducto[$c]->url_archivo; ?>" alt="banner1" /></div>
                                        <?php } else { ?>
                                            <div class="item"><img src="<?php echo $galeriaProducto[$c]->url_archivo; ?>" alt="banner2" /></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-12 detail" id="titledetail">
                        <?php if (sizeof($modulo->data_productos) > 0) { ?>
                            <h2><?php echo $modulo->data_productos[0]->nombre_producto; ?></h2>
                            <h3>$<?php echo $modulo->data_productos[0]->precio_producto; ?></h3><h4><strike></strike></h4>
                        <?php } ?>
                    </div>
                    <div class="col-xs-12 detail" id="color">
                        <h2>Color: Green</h2>
                        <button></button>
                        <button style="background: #2958B0;"></button>
                    </div>
                    <div class="col-xs-12 detail" >
                        <h2>Please select a size:</h2>
                        <button>X-Small</button>
                        <button> Small</button>
                        <button> Large</button>
                        <a href="#" ><h5>Size Chart</h5></a>
                    </div>
<!--                    <div class="col-xs-12 detail" >-->
<!--                        <h3>$5.95 Flat-Rate Standard Shipping</h3>-->
<!--                    </div>-->
<!--                    <div class="col-xs-12 detail" >-->
<!--                        <h4>Ready-to-Ship Item</h4>-->
<!--                        <a href="#" ><h6>Learn More</h6></a>-->
<!--                        <h3>Usually ships in 1-2 days</h3>-->
<!--                    </div>-->
                    <div class="col-xs-12 detail" >
                        <h4>Description</h4>
                        <?php if (sizeof($modulo->data_productos) > 0) { ?>
                            <h3><?php echo $modulo->data_productos[0]->descripcion_producto; ?></h3>
                        <?php } ?>
<!--                        <h3>Draped neck knit dress with 3/4 sleeves, seaming detail and a flared skirt</h3>-->
<!--                        <ul>-->
<!---->
<!--                            <li>Model's measurements: Height 5'9", Bust 33", Waist 25", Hips 35#, wearing a size Small</li>-->
<!--                            <li>Care instrucions: Machine wash</li>-->
<!--                            <li>Measurements: shoulder to hemline 39", sleeve length 18", taken from size M.</li>-->
<!--                            <li>Country of origin: United States</li>-->
<!---->
<!--                        </ul>-->
                    </div>
                    <div class="col-xs-12 detail" style="height: 110px;"></div>
                </div>
            </div>

        </div>

    </content>
    <footer>
        <div id="cart">
            <button><h2>Add to Cart</h2></button>
        </div>
        <div id="footer">
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>"><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/homes.png" class="images" alt="" /></a>
                <h2><a href="#" onclick="">Home</a></h2>
            </div>
            <div class="boximage">
                <a href="find.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/tool.png" class="images" alt="" /></a>
                <h1><a href="#" onclick="">Find</a></h1>
            </div>
            <div class="boximage">
                <a href="cart.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/cart.png" class="images" alt="" /></a>
                <h1><a href="#" onclick="">Cart</a></h1>
            </div>
            <div class="boximage">
                <a href="account.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/setting.png" class="images" alt="" /></a>
                <h1><a href="#" onclick="">Account</a></h1>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>/js/jquery.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>/js/skel.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>/js/skel-viewport.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>/js/util.js"></script>
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>/js/ie/respond.min.js"></script><![endif]-->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>/js/main.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>/js/bootstrap.min.js"></script>

</body>
</html>