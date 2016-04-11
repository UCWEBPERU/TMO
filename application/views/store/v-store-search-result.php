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
        <a href="<?php echo $modulo->base_url_store; ?>/search">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow_back.png">
        </a>
    </div>
    <div class="title-header">RESULTS</div>
    <div id="btnChangeViewProduct" class="btn-right" data-current-view="row">
        <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_tableview.png">
    </div>
</div>
<div id="panelResultProduct">
    <div class="text-result"><?php echo sizeof($modulo->data_productos) ?> RESULTS FOR '<?php echo strtoupper($modulo->keyrwords_search) ?>'</div>
    <?php foreach ($modulo->data_productos as $producto) { ?>
        <div class="item-product-row">
            <a href="<?php echo $modulo->base_url_store."/products/".intval($producto->id_producto); ?>">
                <div>
                    <div class="image-product">
                        <img src="<?php echo $producto->galeria_producto[0]->url_archivo; ?>">
                    </div>
                    <div class="content-product">
                        <div>
                            <div class="name-product">
                                <?php echo $producto->nombre_producto; ?>
                            </div>
                            <div class="price-product">
                                $<?php echo $producto->precio_producto; ?>
                            </div>
                        </div>
                        <div class="description-product">
                            <?php echo $producto->descripcion_producto; ?>
                        </div>
                    </div>
                    <div class="arrow-product">
                        <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
                    </div>
                </div>
            </a>
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
        <a class="active" href="<?php echo $modulo->base_url_store; ?>/search">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_active_search.png">
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
        <a href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<!-- Swiper JS -->
<script src="swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
    $("#btnChangeViewProduct").on("click", function() {
        if ( $(this).attr("data-current-view") == "row" ) {
            $(".item-product-row").addClass("item-product-block");
            $(".item-product-row").removeClass("item-product-row");
            $(this).attr("data-current-view", "block");
            $(this).children("img").attr("src","<?php echo PATH_RESOURCE_STORE; ?>img/icon_lineview.png" );
        } else if ( $(this).attr("data-current-view") == "block" ) {
            $(".item-product-block").addClass("item-product-row");
            $(".item-product-block").removeClass("item-product-block");
            $(this).attr("data-current-view", "row");
            $(this).children("img").attr("src", "<?php echo PATH_RESOURCE_STORE; ?>img/icon_tableview.png");
        }
    });
</script>
</body>
</html>