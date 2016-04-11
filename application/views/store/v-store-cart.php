<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TMO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <base href="<?php echo base_url();?>">
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/main.css" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/swiper.min.css" />
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.css">
</head>
<body>
<div id="mainHeader">
    <div class="btn-Left">
        <a href="<?php echo $modulo->base_url_store; ?>">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow_back.png">
        </a>
    </div>
    <div class="title-header">PLACE ORDER</div>
    <div class="btn-right"></div>
</div>
<?php if ($modulo->has_user_session) { ?>

<?php $cart_check = $this->cart->contents();
    // If cart is empty, this will show below message.
    if(empty($cart_check)) : ?>
    <div id="panelCartEmpty">
        <div class="content-message">YOUR CART IS EMPTY</div>
    </div>
    <div id="panelBtnBottom">
        <a class="btn-black" href="<?php echo $modulo->base_url_store; ?>">CONTINUE SHOPPING</a>
    </div>
<?php endif; ?>
<?php
// All values of cart store in "$cart".
if ($cart = $this->cart->contents()): ?>
<div id="panelCart">
    <div class="shipping-information">
        <span>Shipping Information</span><br>
        <span>Shipping Option.</span><span> Standard U.S.Shipping</span>
    </div>
    <div class="container-products">
        <ul data-role="listview" id="list" class="ui-listview">
            <?php
            $grand_total = 0;
            $num = 1;
            $totaladditional = 0;
            foreach ($cart as $item): ?>
                <li>
					<span class="delete">
						<p class="btn" onclick="deleteItem('<?php echo $item['rowid'] ?>')">
                            Delete
                        </p>
					</span>
                    <a  draggable="false">
                        <div class="content-product">
                            <div class="image-product">
                                <img src="<?php $options = $this->cart->product_options($item['rowid']); echo $options['url_image'] ?>">
                            </div>

                            <div class="detail-product">
                                <div class="head-detail">
                                    <span><?php echo $item['name']; ?></span>
                                    <span>$ <?php echo number_format($item['price'], 2); ?></span>
                                </div>
                                <div class="more-detail">
                                    <span>Quantity: <?php echo $item['qty']; ?></span><br>
                                    <?php
                                    $modifiers = $this->cart->product_options($item['rowid']);
                                    $addtional = 0;
                                    $addtionals = 0;
                                    foreach ($modifiers as $modifier):
                                        if($modifier[0] == "modifier"){ ?>
                                            <span><?php echo $modifier[1]; ?>: <?php echo $modifier[2]; if ($modifier[3] != "0.00"){ echo " - ( $ " . $modifier[3]." )"; }?> </span><br>
                                        <?php } ?>

                                        <?php   $addtional += $modifier[3];

                                    endforeach;
                                    $addtionals = $addtional  * $item['qty'];?>
                                    <?php if($modulo->id_tipo_empresa == 2 ){
                                        if($options['notes'] != ""){?>
                                        <span>Notes: <?php echo $options['notes']; ?></span><br>
                                    <?php } }?>
                                    <span>Subtotal :$ <?php echo number_format($item['subtotal'], 2) + $addtionals ?></span><br>
                                    <?php $grand_total +=  $item['subtotal'];
                                    $totaladditional += $addtionals;
                                    ?>

                                </div>
                            </div>
                        </div>
                    </a>
                </li>


            <?php endforeach; ?>


        </ul>
    </div>
    <div class="container-shipping-detail">
        <span class="bold">Orden Summary</span><br>
        <div class="item">
            <span>Items:</span>
            <span>$<?php echo number_format($grand_total, 2); ?></span>
        </div>
        <!--<div class="item">
            <span>Shipping & Handling:</span>
            <span>$<?php /*echo number_format($totaladditional, 2); */?></span>
        </div>-->
        <div class="item">
            <span>Additional Cost:</span>
            <span>$<?php echo number_format($totaladditional, 2); ?></span>
        </div>
        <div class="item item-last">
            <span class="bold">Order Total:</span>
            <span class="bold">$<?php echo number_format($grand_total, 2) + number_format($totaladditional, 2); ?></span>
        </div>
    </div>
    <?php endif; ?>
    <?php } else { ?>
        <div id="panelCartEmpty">
            <div class="content-message">SIGN IN TO VIEW YOUR CART</div>
        </div>
        <div id="panelBtnBottom">
            <a class="btn-black" href="<?php echo $modulo->base_url_store; ?>/signin">SIGN IN</a>
        </div>
    <?php } ?>

</div>
<?php if ($modulo->has_user_session && $this->cart->contents()) { ?>
    <div id="panelBtnBottom">
        <a class="btn-green" href="<?php echo $modulo->base_url_store; ?>/cart/payment-method?amount=<?php echo number_format($grand_total, 2) + number_format($totaladditional, 2); ?>">PLACE ORDER</a>
    </div>
<?php } ?>
<div id="menuApp">
    <div id="changeStyleProduct" class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_products.png">
            <div>PRODUCTS</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/promotions">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_promotion.png">
            <div>PROMOTION</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/search">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_search.png">
            <div>SEARCH</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/account">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_account.png">
            <div>ACCOUNT</div>
        </a>
    </div>
    <div class="menu-item">
        <a class="active" href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_active_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/hammer.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.hammer.js"></script>
<!-- Swiper JS -->
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/swiper.min.js"></script>
<!-- Sweet Alert -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.min.js"></script>

<!-- Initialize Swiper -->
<script>
    $("#btnChangeViewProduct").on("click", function() {
        if ( $(this).attr("data-current-view") == "row" ) {
            $(".item-product-row").addClass("item-product-block");
            $(".item-product-row").removeClass("item-product-row");
            $(this).attr("data-current-view", "block");
            $(this).children("img").attr("src", "icon_lineview.png");
        } else if ( $(this).attr("data-current-view") == "block" ) {
            $(".item-product-block").addClass("item-product-row");
            $(".item-product-block").removeClass("item-product-block");
            $(this).attr("data-current-view", "row");
            $(this).children("img").attr("src", "icon_tableview.png");
        }

    });
    $("ul li a").hammer().bind("swipeleft", function(event){
        $("ul li a").each(function() {
            $(this).prevAll("span").removeClass("show");
            $(this).css({
                transform: "translateX(0)"
            }).blur();
        });
        $(this).prevAll("span").addClass("show");
        $(this).off("click").blur();
        $(this).css({
            transform: "translateX(-300px)"
        }).one("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd", function () {
            $("ul li a").one("swiperight", function () {
                $(this).prevAll("span").removeClass("show");
                $(this).css({
                    transform: "translateX(0)"
                }).blur();
            });
        });
    });
    $("ul li, ul li a").hammer().bind("tap", function(event){
        $("ul li a").each(function() {
            $(this).prevAll("span").removeClass("show");
            $(this).css({
                transform: "translateX(0)"
            }).blur();
        });
    });
    $("ul li span.delete").on("click", function () {
        var listview = $(this).closest("ul");
        $(".ui-content").css({
            overflow: "hidden"
        });
        $(this).parent().css({
            display: "block"
        }).animate({
            opacity: 0
        }, {
            duration: 250,
            queue: false
        }).animate({
            height: 0
        }, 300, function () {
            $(this).remove();
            $(".ui-content").removeAttr("style");
        });
    });

    function deleteItem(item) {
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

                swal({
                        title: "Delete Item",
                        text: response.message,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                        closeOnConfirm: true },
                    function(){
                        location.reload(); }
                );


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