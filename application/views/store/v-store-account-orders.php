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
    <div class="title-header">MY ORDERS</div>
    <div class="btn-right"></div>
</div>
<div id="panelOrders">
    <div class="item-order">
        <div class="date-order">MON. 12/06/2015</div>
        <div class="content-order">
            <div>
                <div class="name-product">CRABSBURGER</div>
                <div class="price-product">$9.99+$3.00</div>
            </div>
            <div>
                <span>Options: Ketchup, Tomato, Onions, Double Cheese, Beef, Parrot, Green Salad, Soult, Peper</span><br>
                <span>Amount: 1</span>
            </div>
        </div>
        <div class="content-order">
            <div>
                <div class="name-product">CRABSBURGER</div>
                <div class="price-product">$9.99+$3.00</div>
            </div>
            <div>
                <span>Options: Ketchup, Tomato, Onions, Double Cheese, Beef, Parrot, Green Salad, Soult, Peper</span><br>
                <span>Amount: 1</span>
            </div>
        </div>
        <div class="content-order">
            <div>
                <div class="name-product">CRABSBURGER</div>
                <div class="price-product">$9.99+$3.00</div>
            </div>
            <div>
                <span>Options: Ketchup, Tomato, Onions, Double Cheese, Beef, Parrot, Green Salad, Soult, Peper</span><br>
                <span>Amount: 1</span>
            </div>
        </div>
        <div class="total-order">TOTAL: $19.98</div>
    </div>
    <div class="item-order">
        <div class="date-order">MON. 12/06/2015</div>
        <div class="content-order">
            <div>
                <div class="name-product">CRABSBURGER</div>
                <div class="price-product">$9.99+$3.00</div>
            </div>
            <div>
                <span>Options: Ketchup, Tomato, Onions, Double Cheese, Beef, Parrot, Green Salad, Soult, Peper</span><br>
                <span>Amount: 1</span>
            </div>
        </div>
        <div class="content-order">
            <div>
                <div class="name-product">CRABSBURGER</div>
                <div class="price-product">$9.99+$3.00</div>
            </div>
            <div>
                <span>Options: Ketchup, Tomato, Onions, Double Cheese, Beef, Parrot, Green Salad, Soult, Peper</span><br>
                <span>Amount: 1</span>
            </div>
        </div>
        <div class="content-order">
            <div>
                <div class="name-product">CRABSBURGER</div>
                <div class="price-product">$9.99+$3.00</div>
            </div>
            <div>
                <span>Options: Ketchup, Tomato, Onions, Double Cheese, Beef, Parrot, Green Salad, Soult, Peper</span><br>
                <span>Amount: 1</span>
            </div>
        </div>
        <div class="total-order">TOTAL: $19.98</div>
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