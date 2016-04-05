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
    <!-- FancyBox -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_PLUGINS; ?>fancybox/jquery.fancybox.css?v=2.1.5" media="screen">
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_PLUGINS; ?>fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" media="screen">

</head>
<body>
<div id="mainHeader">
    <div class="btn-Left">
        <a href="<?php echo $modulo->url_button_back; ?>"><img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow_back.png"></a>
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
                        <a class="fancybox" rel="fancybox-thumb" href="<?php echo $galeriaProducto[$c]->url_archivo; ?>">
                            <img src="<?php echo $galeriaProducto[$c]->url_archivo; ?>">
                        </a>
                    </div>


                <?php } ?>


            </div>

        </div>
    <?php } ?>

    <div class="description-product">
        <?php echo $modulo->data_productos[0]->descripcion_producto; ?>
    </div>

    <?php if(sizeof($modulo->data_modifiers) != 0){ ?>
        <div class="box-modifier">

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
                        <div class="item-modifier btnAddModifier" data-id-modifier="<?php echo ucwords($modulo->data_modifiers[$c]->id_modificador_productos); ?>" data-type-modifier="<?php echo ucwords($modulo->data_modifiers[$c]->tipo_modificador); ?>"><?php echo $modulo->data_modifiers[$c]->descripcion_modificador; ?></div>
                <?php } ?>
            <?php } ?>

            </div>
        </div>
    <?php } ?>

</div>

<div id="panelBtnBottom">
    <button id="shoppingcart" class="btn-green">ADD TO CART</button>
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
<!-- Sweet Alert -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.min.js"></script>
<!-- FancyBox -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>fancybox/mousewheel-3.0.6.pack.js"></script>
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>


<!-- Initialize Swiper -->
<script>

    $(document).ready(function() {
        $('.fancybox').fancybox({
            padding         : 0,
            margin          : 0,
            openEffect      : 'fade',
            openSpeed       : 150,
            closeEffect     : 'fade',
            closeBtn		: false,
            prevEffect		: 'none',
            nextEffect		: 'none',
            closeSpeed      : 150,
            closeClick      : true,
            helpers	        : {
                thumbs	: {
                    width	: 50,
                    height	: 50
                }
            }

        });
    });
    var swGalleryProduct = new Swiper('#swGalleryProduct', {
        pagination: '.swiper-pagination',
        grabCursor: true,
        centeredSlides: true,
        spaceBetween: 0,
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


    var listaModificadoresSeleccionados = [];
    var datosModificador = {
        "id"    : 0,
        "tipo"  : ""
    }

    function addModifier(idModifier, tipoModifier) {
        var indiceModificador = validarModificadorEnLista(tipoModifier);
        if ( indiceModificador != -1 ) {
            listaModificadoresSeleccionados[indiceModificador].id = idModifier;
            listaModificadoresSeleccionados[indiceModificador].tipo = tipoModifier;
            return false;
        } else {
            datosModificador = {
                "id"    : idModifier,
                "tipo"  : tipoModifier
            }
            listaModificadoresSeleccionados.push(datosModificador);
            return true;
        }
        //console.log(listaModificadoresSeleccionados);
    }

    function validarModificadorEnLista(tipoModifier) {
        var indiceModificador = -1;
        for (var c = 0; c < listaModificadoresSeleccionados.length; c++) {

            if (listaModificadoresSeleccionados[c].tipo == tipoModifier) {
                indiceModificador = c;
                break;
            }
        }
        return indiceModificador;
    }



    $(".btnAddModifier").on("click", function (e){
        e.preventDefault();
        $(".item-modifier").css("border-color", "none" );
        if(addModifier( $(this).attr("data-id-modifier"), $(this).attr("data-type-modifier"))){
            addModifier( $(this).attr("data-id-modifier"), $(this).attr("data-type-modifier"))
            $(this).css("border-color", "black" );
        }

    });

    $("#shoppingcart").on("click", function(evt){
        evt.preventDefault();
        var session = "<?php echo $modulo->has_user_session; ?>";
        if(session){
            var id_producto  = "<?php echo $modulo->data_productos[0]->id_producto; ?>";
            var nombre_producto  = "<?php echo $modulo->data_productos[0]->nombre_producto; ?>";
            var precio_producto  = "<?php echo $modulo->data_productos[0]->precio_producto; ?>";
            var formData = new FormData();
            formData.append("id_producto", id_producto);
            formData.append("nombre_producto", nombre_producto);
            formData.append("precio_producto", precio_producto);
            for (var c = 0; c < listaModificadoresSeleccionados.length; c++) {
                formData.append("modifiers[]", listaModificadoresSeleccionados[c].id  );

            }


            var request = $.ajax({
                url: "<?php echo $modulo->base_url_store."/ajax/shopping/add"; ?>",
                method: "POST",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
            });

            request.done(function( response ) {

                if (response.status) {
                    swal("Add Item", response.message, "success");
                    listaModificadoresSeleccionados = [];
                } else {
                    swal("Add Item", response.message, "danger");
                }
            });

            request.fail(function( jqXHR, textStatus ) {
                swal("Add Item", textStatus, "danger");
            });

        }else{
            $(location).attr("href", "<?php echo $modulo->base_url_store; ?>/signin");
        }




    });


</script>
</body>
</html>