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
    <div class="btn-Left">
        <a href="<?php echo $modulo->base_url_store; ?>/account">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow_back.png">
        </a>
    </div>
    <div class="title-header">EMAIL SETTINGS</div>
    <div class="btn-right"></div>
</div>
<div id="panelEmailSettings">
    <div class="text-info">
        <p>NAME</p>
        <p>JAMES GREEN</p>
    </div>
    <div class="text-info">
        <p>EMAIL</p>
        <p>JAMES@YAHOO.COM</p>
    </div>
    <div class="text-info">
        <p>PHONE</p>
        <p>+ 1 444 333 44 55</p>
    </div>
    <div class="container-button">
        <a href="<?php echo $modulo->base_url_store; ?>">
            <div class="text-button">CHANGE PASSWORD</div>
            <div class="arrow-button">
                <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
            </div>
        </a>
    </div>
</div>
<div id="menuApp">
    <div id="changeStyleProduct" class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>">
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
        <a class="active" href="<?php echo $modulo->base_url_store; ?>/account">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_account.png">
            <div>ACCOUNT</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</body>
</html>