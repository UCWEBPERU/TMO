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
            <a href="<?php echo $modulo->base_url_store; ?>" ><img src="<?php echo PATH_RESOURCE_STORE; ?>images/left-arrow.png" class="images" alt="" /></a>

            <h2>Cart</h2>
        </div>
    </header>

    <!-- Content -->
    <content>


        <div class="col-xs-12" >

            <div class="row" >
                <div>
                    <div class="col-xs-12 cartinformation" >
                        <h2>Shipping Information</h2>

                    </div>


                </div>

            </div>
            <div class="row" >
                <div>

                    <div class="col-xs-5 list"  id="cartitem" >
                        <a href="item.html" ><img src="images/pic00.png" id="images" alt=""  /></a>
                        <a class="btn">Edit</a>
                    </div>

                    <div class="col-xs-7 list" id="cartitem" >
                        <h3>Fashionable Women's Jacket Classic</h3>
                        <h4>$58.50</h4>
                        <h5>Quantity : 1</h5>
                        <h5>Color : White</h5>
                        <h5>Size : M</h5>
                        <h6>Ready-to-Ship Item</h6>
                        <h5>Estimated Delivery:
                            Feb 26, 2015 to Feb-28,2015</h5>
                        <h6>Returnable</h6>
                        <h5>Gift Options: None Selected</h5>
                    </div>
                </div>

            </div>
            <div class="row" >
                <div>


                    <div class="col-xs-9 list" id="cartitem2" >
                        <h3>Order summary</h3>
                        <h5>Items:</h5>
                        <h5>Shipping & Handling:</h5>
                        <h5>Promotion Applied:</h5>
                        <h6>Total Before Tax:</h6>
                        <h6>Estimated Tax:</h6>
                        <h3>Order Total</h3>
                    </div>
                    <div class="col-xs-3 list" id="cartitem2" >
                        <h3>$</h3>
                        <h5>$58.50</h5>
                        <h5> $3.99</h5>
                        <h5> -$3.99</h5>
                        <h6>$58.50</h6>
                        <h6>$8.00</h6>
                        <h3>$66.50</h3>

                    </div>

                </div>

            </div>


            <div class="row" style="height:120px; background:#FFF;">

            </div>






        </div>

    </content>

    <footer>
        <div id="cart">
            <button id="placeorder"><h2>Place Order</h2></button>
        </div>
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
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel-viewport.min.js"></script>
    <!--    <script src="--><?php //echo PATH_RESOURCE_STORE; ?><!--js/util.js"></script>-->
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/respond.min.js"></script><![endif]-->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.scrolly.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.placeholder.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/main.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/bootstrap.min.js"></script>

</body>
</html>