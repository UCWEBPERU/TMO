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




                    <table id="table" border="0" cellpadding="5px" cellspacing="1px">
                        <?php
                        // All values of cart store in "$cart".
                        if ($cart = $this->cart->contents()): ?>
                        <tr id= "main_heading">
                            <td>Serial</td>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Qty</td>
                            <td>Amount</td>
                            <td>Cancel Product</td>
                        </tr>
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
                                <tr>
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo $item['name']; ?>
                                </td>
                                <td>
                                    $ <?php echo number_format($item['price'], 2); ?>
                                </td>
                                <td>
                                    <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                                </td>
                                <?php $grand_total = $grand_total + $item['subtotal']; ?>
                                <td>
                                    $ <?php echo number_format($item['subtotal'], 2) ?>
                                </td>
                                <td>

                                    <?php
                                    // cancle image.
                                    $path = "<img src='http://localhost/codeigniter_cart/images/cart_cross.jpg' width='25px' height='20px'>";
                                    echo anchor('shopping/remove/' . $item['rowid'], $path); ?>
                                </td>
                            <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td><b>Order Total: $<?php

                                        //Grand Total.
                                        echo number_format($grand_total, 2); ?></b></td>

                                <?php // "clear cart" button call javascript confirmation message ?>
                                <td colspan="5" align="right"><input  class ='fg-button teal' type="button" value="Clear Cart" onclick="clear_cart()">

                                    <?php //submit button. ?>
                                    <input class ='fg-button teal'  type="submit" value="Update Cart">
                                    <?php echo form_close(); ?>

                                    <!-- "Place order button" on click send "billing" controller -->
                                    <input class ='fg-button teal' type="button" value="Place Order" onclick="window.location = 'shopping/billing_view'"></td>
                            </tr>
                        <?php endif; ?>
                    </table>







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