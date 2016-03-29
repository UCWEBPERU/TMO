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
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.css">
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

            <?php if ($modulo->has_user_session) { ?>
            <div class="row">
                <?php $cart_check = $this->cart->contents();

                // If cart is empty, this will show below message.
                if(empty($cart_check)) { ?>

                    <div class="col-xs-12 titlecart" style="background: #FFFFFF" >
                        <h2>To add products to your shopping cart click on "Add to Cart" Button</h2>
                    </div>
                    <div class="col-xs-12 detail" style="height: 150px;background: #FFFFFF"></div>

                <?php } ?>
            </div>
            <?php
            // All values of cart store in "$cart".
            if ($cart = $this->cart->contents()): ?>
                <div class="row" >
                    <div>
                        <div class="col-xs-12 cartinformation" >
                            <h2>Shipping Information</h2>

                        </div>


                    </div>

                </div>
            <?php
            // Create form and send all values in "shopping/update_cart" function.
            echo form_open("<?php echo $modulo->base_url_store".'/ajax/shopping/update');
                $grand_total = 0;
                $num = 1;
                $totaladditional = 0;

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
                            <a class="btn" onclick="deleteItem(this, '<?php echo $item['rowid'] ?>')" >Delete</a>
                        </div>
                        <div class="col-xs-7 list" id="cartitem" >
                            <h3><?php echo $item['name']; ?></h3>
                            <h4>$ <?php echo number_format($item['price'], 2); ?></h4>
                            <h5>Quantity : <?php echo $item['qty']; ?></h5>
                            <?php
                            $modifiers = $this->cart->product_options($item['rowid']);
                            $addtional = 0;
                            foreach ($modifiers as $modifier):
                                    if($modifier[0] == "modifier"){ ?>
                                    <h5><?php echo $modifier[1]; ?> : <?php echo $modifier[2]; ?> - ( $ <?php echo $modifier[3]; ?> ) </h5>
                                <?php } ?>

                            <?php   $addtional += $modifier[3];
                                    $addtionals = $addtional  * $item['qty'];

                            endforeach; ?>
                            <h5>Subtotal : $ <?php echo number_format($item['subtotal'], 2) + $addtionals ?></h5>
                            <!--?php $num = $num + $item['qty'] ?-->
                            <?php $grand_total += + $item['subtotal'];
                            $totaladditional += $addtionals;?>

                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
                <div class="row" >
                    <div>


                        <div class="col-xs-9 list" id="cartitem2" >
                            <h3>Order summary</h3>
                            <h5>Items:</h5>
                            <h5>Additional Cost:</h5>
                            <!--h6>Total Before Tax:</h6>
                            <h6>Estimated Tax:</h6-->
                            <h3>Order Total</h3>
                        </div>
                        <div class="col-xs-3 list" id="cartitem2" >
                            <h3 style="visibility: hidden">$</h3>
                            <h5>$<?php echo number_format($grand_total, 2); ?></h5>
                            <h5>$<?php echo number_format($totaladditional, 2); ?></h5>
                            <!--h6>$<?php echo number_format($grand_total, 2) + number_format($totaladditional, 2); ?></h6>
                            <h6>$8.00</h6!-->
                            <h3>$<?php echo number_format($grand_total, 2) + number_format($totaladditional, 2); ?></h3>


                        </div>

                    </div>

                </div>


            <?php endif; ?>


            <div class="row" style="height:120px; background:#FFF;">

            </div>
            <?php } else { ?>
                <div class="row">


                    <div class="col-xs-12 titlecart" style="background: #FFFFFF" >
                        <h2>Sign in to view your cart</h2>
                    </div>
                    <div class="col-xs-12 titlecart" style="background: #FFFFFF" >
                        <a class="btn" id="signin" onclick="redireccionar()" style="margin-bottom: 5px">Sign In</a>
                    </div>
                    <div class="col-xs-12 detail" style="height: 50px;background: #FFFFFF"></div>


                </div>
            <?php } ?>





        </div>

    </content>


    <footer>
        <?php if ($modulo->has_user_session) { ?>
        <div id="cart">
            <button id="placeorder"><h2>Place Order</h2></button>
        </div>
        <?php } ?>
        <div id="footer">
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/home.png" class="images" alt="" /></a>
                <h2><a href="<?php echo $modulo->base_url_store; ?>" onclick="">Products</a></h2>
            </div>

            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/search"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/sale.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/search" onclick="">Promotions</a></h1>
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
    <!--    <script src="--><?php //echo PATH_RESOURCE_STORE; ?><!--js/util.js"></script>-->
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/respond.min.js"></script><![endif]-->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.scrolly.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.placeholder.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/main.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/bootstrap.min.js"></script>
    <!-- Sweet Alert -->
    <script src="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.min.js"></script>
    <script>

           function redireccionar(){
               redirect("<?php echo "/company/".$this->CI->uri->segment(2)."/store/".$this->CI->uri->segment(4)."/signin" ?>");
           }

            function deleteItem(btn, item) {

                var formData = new FormData();
                formData.append("id_producto", item);

                var request = $.ajax({
                    url: "<?php echo $modulo->base_url_store."/ajax/shopping/delete"; ?>",
                    method: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                });

                request.done(function( response ) {

                    if (response.status) {


                        //$(btn).parent().parent().parent().hide(function () {
                            //$(btn).parent().parent().parent().remove();
                        //});
                        swal("Delete Item", response.message, "success");

                        location.reload();

                    } else {
                        swal("Delete Item", response.message, "danger");

                    }
                });

                request.fail(function( jqXHR, textStatus ) {
                    swal("Delete Item", textStatus, "danger");

                });
            }
            



    </script>

</body>
</html>