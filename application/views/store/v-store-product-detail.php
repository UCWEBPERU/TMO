<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TMO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <base href="<?php echo base_url();?>">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/swiper.min.css" />
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/main.css" />

</head>
<body>
<div id="mainHeader">
    <div class="btn-Left">
        <a href=""><img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow_back.png"></a>
    </div>
    <div class="title-header">DETAIL</div>
    <div id="btnChangeViewProduct" class="btn-right" data-current-view="row">
        <!--img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_tableview.png"-->
    </div>
</div>
<div id="panelProductDetail">
    <div>
        <?php if (sizeof($modulo->data_productos) > 0) { ?>
            <div class="name-product"><?php echo $modulo->data_productos[0]->nombre_producto; ?></div>
            <div class="price-product">$<?php echo $modulo->data_productos[0]->precio_producto; ?></div>
        <?php } ?>
    </div>
    <?php if (sizeof($modulo->data_productos) > 0) { ?>
        <div id="swGalleryProduct" class="swiper-container">
            <div class="swiper-wrapper">

                <?php $galeriaProducto = $modulo->data_productos[0]->galeria_producto; ?>
                <?php for ($c = 0; $c < sizeof($galeriaProducto); $c++) { ?>
                    <div class="swiper-slide">
                        <img src="<?php echo $galeriaProducto[$c]->url_archivo; ?>">
                    </div>

                <?php } ?>


            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    <?php } ?>
    <div class="description-product">
        <?php echo $modulo->data_productos[0]->descripcion_producto; ?>
    </div>
    <div class="box-modifier">
    <?php if(sizeof($modulo->data_modifiers) != 0){ ?>
        <div class="name-modifier">SELECT COLOR</div>
        <div class="content-modifier">
            <?php
            foreach ($modulo->data_modifiers as $modifier) { ?>
                <?php if (trim(strtolower($modifier->tipo_modificador)) == "color") { ?>
                    <?php if (isset($modifier->color_rgb)) { ?>
                        <div class="item-modifier btnAddModifier" style="background: <?php echo $modifier->color_rgb; ?>;" data-id-modifier="<?php echo ucwords($modifier->id_modificador_productos); ?>" data-type-modifier="<?php echo ucwords($modifier->tipo_modificador); ?>"></div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>


    </div>

    <div class="box-modifier">

        <div class="content-modifier">
        <?php
        $tipoModificadorAnterior = "";
        for ($c = 0; $c < sizeof($modulo->data_modifiers); $c++) {
            $tipoModificadorActual = trim(strtolower($modulo->data_modifiers[$c]->tipo_modificador));
            if ($c + 1 > sizeof($modulo->data_modifiers) - 1)  {
                $tipoModificadorSiguiente = "";
            } else {
                $tipoModificadorSiguiente = trim(strtolower($modulo->data_modifiers[$c + 1]->tipo_modificador));
            }
            ?>
            <?php if ($tipoModificadorActual != "color") { ?>
                <?php if ($tipoModificadorAnterior != $tipoModificadorActual) {
                    $tipoModificadorAnterior = $tipoModificadorActual; ?>
                    <div class="name-modifier"><?php echo ucwords($modulo->data_modifiers[$c]->tipo_modificador); ?></div>

                <?php } ?>
                    <div class="item-modifier btnAddModifier" style="background: <?php echo $modifier->color_rgb; ?>;" data-id-modifier="<?php echo ucwords($modulo->data_modifiers[$c]->id_modificador_productos); ?>" data-type-modifier="<?php echo ucwords($modulo->data_modifiers[$c]->tipo_modificador); ?>"></div>

                
            <?php } ?>
        <?php } ?>


            <div class="item-modifier">2T</div>

        </div>
    </div>

</div>

<div id="panelAddCart">
    <button>ADD TO CART</button>
</div>
<div id="menuApp">
    <div id="changeStyleProduct" class="menu-item">
        <a class="active" href="<?php echo $modulo->base_url_store; ?>">
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
        <a href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<!-- Swiper JS -->
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/swiper.min.js"></script>


<!-- Initialize Swiper -->
<script>
    var swGalleryProduct = new Swiper('#swGalleryProduct', {
        pagination: '.swiper-pagination',
        grabCursor: true,
        paginationClickable: true,
        centeredSlides: true,
        spaceBetween: 160,
        slidesPerView: 3,
        loop: true
    });
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
</script>
</body>
</html>