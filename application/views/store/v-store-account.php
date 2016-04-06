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
</head>
<body>
<div id="mainHeader">
    <div class="btn-Left"></div>
    <div class="title-header">ACCOUNT</div>
    <div class="btn-right"></div>
</div>
<div id="panelAccount">
    <?php if ($modulo->has_user_session) { ?>
        <div class="text-welcome">WELCOME, <?php echo $modulo->data_usuario->nombres_persona." ".$modulo->data_usuario->apellidos_persona; ?></div>
        <div class="container-button">
            <button id="btnSignOut" class="btn">SIGN OUT</button>
        </div>
    <?php } else { ?>
        <div class="container-button">
            <button id="btnSignIn" class="btn" style="margin-top: 10px;">SIGN IN</button>
        </div>
    <?php } ?>
    <div class="item-menu-account">
        <a href="<?php echo $modulo->base_url_store; ?>/account/orders">
            <div class="text-menu">MY ORDERS</div>
            <div class="arrow-menu">
                <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
            </div>
        </a>
    </div>
    <div class="item-menu-account">
        <a href="<?php echo $modulo->base_url_store; ?>/account/account-settings">
            <div class="text-menu">MY EMAIL SETTINGS</div>
            <div class="arrow-menu">
                <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
            </div>
        </a>
    </div>
    <div class="item-menu-account">
        <a href="<?php echo $modulo->base_url_store; ?>">
            <div class="text-menu">LEGAL INFORMATION</div>
            <div class="arrow-menu">
                <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
            </div>
        </a>
    </div>
    <div class="item-menu-account">
        <a href="<?php echo $modulo->base_url_store; ?>">
            <div class="text-menu">HELP</div>
            <div class="arrow-menu">
                <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
            </div>
        </a>
    </div>
    <div class="item-menu-account">
        <a href="<?php echo $modulo->base_url_store; ?>/account/contact-us">
            <div class="text-menu">CONTACT US</div>
            <div class="arrow-menu">
                <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
            </div>
        </a>
    </div>
</div>
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
        <a class="active" href="<?php echo $modulo->base_url_store; ?>/account">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_active_account.png">
            <div>ACCOUNT</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<!-- Swiper JS -->
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swMainMenu = new Swiper('#swMainMenu', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 0,
        loop: true,
        slideToClickedSlide: true,
        onSlideChangeEnd: function(swiper){
            for (var c = 0; c < swiper.slides.length; c++) {
                $(swiper.slides[c]).css({"color": "#959595"});
            }
            $(swiper.slides[swiper.activeIndex]).css({"color": "#FFFFFF"});
        }
    });

    var swMainPanel = new Swiper('#swMainPanel', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 0,
        loop: true,
        longSwipes: false
    });

    swMainMenu.params.control = swMainPanel;
    swMainPanel.params.control = swMainMenu;

    $("#btnSignIn").on("click", function(event) {
        event.preventDefault();
        $(location).attr("href", "<?php echo $modulo->base_url_store; ?>/signin");
    });

    $("#btnSignOut").on("click", function(event) {
        event.preventDefault();
        $(location).attr("href", "<?php echo $modulo->base_url_store; ?>/signout");
    });
</script>
</body>
</html>