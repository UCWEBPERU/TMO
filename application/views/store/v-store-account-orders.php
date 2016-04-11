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

    <?php foreach ($modulo->data_orders as $order) { ?>
        <?php $date = new DateTime($order->fecha_venta); ?>
        <div class="item-order">
            <div class="date-order"><?php echo strtoupper(date_format($date, "D")).". ".date_format($date, "d/m/Y"); ?></div>

            <?php foreach ($order->detalle_productos as $detalle) { ?>
            <div class="content-order">
                <div>
                    <div class="name-product"><?php echo $detalle->nombre_producto; ?></div>
                    <div class="price-product">
                        <?php
                        echo "$".$detalle->precio;
                        if (intval($detalle->total_modifiers) != 0) {
                            echo "+$".$detalle->precio;
                        }
                        ?>
                    </div>
                </div>
                <div>
                    <span>Options: <?php echo $detalle->modifiers; ?></span><br>
                    <span>Amount: <?php echo $detalle->cantidad; ?></span>
                </div>
            </div>
            <?php } ?>

            <div class="total-order">TOTAL: $<?php echo $order->total; ?></div>
        </div>
    <?php } ?>

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
</body>
</html>