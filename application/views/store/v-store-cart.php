<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Swiper demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <base href="<?php echo base_url();?>">
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/main.css" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/swiper.min.css" />
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
<!-- <div id="panelCartEmpty">
<div class="content-message">YOUR CART IS EMPTY</div>
</div>
<div id="panelBtnBottom">
<button class="btn-black">CONTINUE SHOPPING</button>
</div> -->
<div id="panelCart">
    <div class="shipping-information">
        <span>Shipping Information</span><br>
        <span>Shipping Option.</span><span> Standard U.S.Shipping</span>
    </div>
    <div class="container-products">
        <ul data-role="listview" id="list" class="ui-listview">
            <li>
					<span class="delete">
						<p class="btn">
                            Delete
                        </p>
					</span>
                <a href="#" draggable="false">
                    <div class="content-product">
                        <div class="image-product">
                            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/image-category-3.jpg">
                        </div>
                        <div class="detail-product">
                            <div class="head-detail">
                                <span>Women Jacket</span>
                                <span>$50.00</span>
                            </div>
                            <div class="more-detail">
                                <span>Quantity: 1</span><br>
                                <span>Color: White</span><br>
                                <span>Size: M</span><br>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li>
					<span class="delete">
						<p class="btn">
                            Delete
                        </p>
					</span>
                <a href="#" draggable="false">
                    <div class="content-product">
                        <div class="image-product">
                            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/image-category-3.jpg">
                        </div>
                        <div class="detail-product">
                            <div class="head-detail">
                                <span>Women Jacket</span>
                                <span>$50.00</span>
                            </div>
                            <div class="more-detail">
                                <span>Quantity: 1</span><br>
                                <span>Color: White</span><br>
                                <span>Size: M</span><br>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="container-shipping-detail">
        <span class="bold">Orden Summary</span><br>
        <div class="item">
            <span>Items:</span>
            <span>$50.00</span>
        </div>
        <div class="item">
            <span>Shipping & Handling:</span>
            <span>$3.99</span>
        </div>
        <div class="item">
            <span>Promotion Applied:</span>
            <span>-$3.99</span>
        </div>
        <div class="item item-last">
            <span class="bold">Order Total:</span>
            <span class="bold">$53.99</span>
        </div>
    </div>
</div>
<div id="panelBtnBottom">
    <button class="btn-green">PLACE ORDER</button>
</div>
<div id="menuApp">
    <div id="changeStyleProduct" class="menu-item">
        <ahref="<?php echo $modulo->base_url_store; ?>">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_products.png">
            <div>PRODUCTS</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/promotions">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_promotion.png">
            <div>PROMOTION</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/search">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_search.png">
            <div>SEARCH</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/account">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_account.png">
            <div>ACCOUNT</div>
        </a>
    </div>
    <div class="menu-item">
        <a class="active" href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/hammer.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.hammer.js"></script>
<!-- Swiper JS -->
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/swiper.min.js"></script>

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
            listview.listview("refresh");
            $(".ui-content").removeAttr("style");
        });
    });
</script>
</body>
</html>