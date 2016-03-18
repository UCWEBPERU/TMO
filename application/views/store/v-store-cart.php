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
            <div class="row" id="contenedordetail">
                <div>
                    <div >
                        <?php $cart_check = $this->cart->contents();

                        // If cart is empty, this will show below message.
                        if(empty($cart_check)) { ?>

                            <div class="col-xs-12 titlecart" >
                                <h2>To add products to your shopping cart click on "Add to Cart" Button</h2>
                            </div>
                            <div class="col-xs-12 detail" style="height: 150px;"></div>

                        <?php } ?>
                    </div>


                    <?php
                    // All values of cart store in "$cart".
                    if ($cart = $this->cart->contents()): ?>
                        <?php
// Create form and send all values in "shopping/update_cart" function.
                        echo form_open('shopping/update');
                        $grand_total = 0;
                        $i = 1;

                        foreach ($cart as $item):
                            // echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                            // Will produce the following output.
                            // <input type="hidden" name="cart[1][id]" value="1" />

                            echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                            echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                            echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                            echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                            echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                            ?>
                        <div class="row" >

                            <div>

                                <div class="col-xs-5 list"  id="cartitem" >
                                    <a ><img src="<?php $options = $this->cart->product_options($item['rowid']); echo $options['url_image'] ?>" id="images" alt=""  /></a>
                                    <!--a class="btn">Edit</a-->
                                </div>
                                <div class="col-xs-7 list" id="cartitem" >
                                    <h3><?php echo $item['name']; ?></h3>
                                    <h4>$ <?php echo number_format($item['price'], 2); ?></h4>
                                    <h5>Quantity : <?php echo $item['qty']; ?></h5>
                                    <h5><?php $grand_total = $grand_total + $item['subtotal']; ?></h5>

                                </div>
                            </div>

                        </div>
                        <?php endforeach; ?>
                        $<?php

                        //Grand Total.
                        echo number_format($grand_total, 2); ?>
                    <?php endif; ?>











                </div>
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