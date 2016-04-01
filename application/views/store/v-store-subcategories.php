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
        <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow_back.png">
    </div>


    <?php if (sizeof($modulo->data_navegacion_sub_categorias) > 1) { ?>

        <?php for ($c = 0; $c < sizeof($modulo->data_navegacion_sub_categorias); $c++) { ?>
            <?php if ($c == sizeof($modulo->data_navegacion_sub_categorias) - 1) { ?>
                <div class="title-header"><?php echo $modulo->data_navegacion_sub_categorias[$c]->nombre_categoria; ?></div>
            <?php } ?>
        <?php } ?>

    <?php } ?>
    <div id="btnChangeViewProduct" class="btn-right" data-current-view="row">
        <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_tableview.png">
    </div>
</div>

<div id="panelResultProduct">
    <div class="item-list">
        <a href="holi.html">
            <div class="image-list">
                <img src="<?php echo PATH_RESOURCE_STORE; ?>img/image-category-1.jpg">
            </div>
            <div class="text-list">
                CLOTING
            </div>
            <div class="arrow-list">
                <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
            </div>
        </a>
    </div>
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