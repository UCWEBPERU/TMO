<!DOCTYPE HTML>
<html>
<head>
    <title>TMO</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Path -->
    <base href="<?php echo base_url();?>">
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie9.css" /><![endif]-->
</head>
<body>

<div>
    <!-- Header -->
    <header>
        <div id="title">
            <a href="<?php echo $modulo->base_url_store; ?>" ><img src="<?php echo PATH_RESOURCE_STORE; ?>images/left-arrow.png" class="images" alt="" /></a>
            <a href="<?php echo $modulo->url_button_back; ?>" >Back</a>
            <h2>Details</h2>
        </div>
    </header>

    <!-- Content -->
    <content>

        <div class="col-xs-12" >
            <div class="row" id="contenedordetail">
                <div>
                    <div id="contenedorCarousel">
                        <div id="myCarousel" class="carousel slide">
                            <?php if (sizeof($modulo->data_productos) > 0) { ?>
                                <?php $galeriaProducto = $modulo->data_productos[0]->galeria_producto; ?>
                                <ol class="carousel-indicators">
                                    <?php for ($c = 0; $c < sizeof($galeriaProducto); $c++) { ?>
                                        <?php if ($c == 0) { ?>
                                            <li data-target="#myCarousel" data-slide-to="<?php echo $c; ?>" class="active"></li>
                                        <?php } else { ?>
                                            <li data-target="#myCarousel" data-slide-to="<?php echo $c; ?>"></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ol>
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <?php for ($c = 0; $c < sizeof($galeriaProducto); $c++) { ?>
                                        <?php if ($c == 0) { ?>
                                            <div class="active item"><img  src="<?php echo $galeriaProducto[$c]->url_archivo; ?>" alt="banner1" /></div>
                                        <?php } else { ?>
                                            <div class="item"><img src="<?php echo $galeriaProducto[$c]->url_archivo; ?>" alt="banner2" /></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-12 detail" id="titledetail">
                        <?php if (sizeof($modulo->data_productos) > 0) { ?>
                            <h2><?php echo $modulo->data_productos[0]->nombre_producto; ?></h2>
                            <h3>$<?php echo $modulo->data_productos[0]->precio_producto; ?></h3><h4><strike></strike></h4>
                        <?php } ?>
                    </div>
                    <div class="col-xs-12 detail" id="color">
                        <?php
                        $contador = 1;
                        foreach ($modulo->data_modifiers as $modifier) { ?>
                            <?php if (trim(strtolower($modifier->tipo_modificador)) == "color") { ?>
                                <?php if (isset($modifier->color_rgb)) {

                                    if ($contador == 1) { $contador++; ?>
                                        <h2>Color</h2>
                                    <?php } ?>
                                    <button style="background: <?php echo $modifier->color_rgb; ?>;" class="btnAddModifier" data-id-modifier="<?php echo ucwords($modifier->id_modificador_productos); ?>" data-type-modifier="<?php echo ucwords($modifier->tipo_modificador); ?>"></button>
                                <?php } ?>
                            <?php } ?>

                        <?php } ?>
                    </div>
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
                                <div class="col-xs-12 detail" >
                                <h2>Please select a <?php echo ucwords($modulo->data_modifiers[$c]->tipo_modificador); ?>:</h2>
                            <?php } ?>
                            <button class="btnAddModifier" data-id-modifier="<?php echo ucwords($modulo->data_modifiers[$c]->id_modificador_productos); ?>" data-type-modifier="<?php echo ucwords($modulo->data_modifiers[$c]->tipo_modificador); ?>"> <?php echo $modulo->data_modifiers[$c]->descripcion_modificador; ?></button>
                            <?php if ($tipoModificadorActual != $tipoModificadorSiguiente) { ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                    <!--                    <div class="col-xs-12 detail" >-->
                    <!--                        <h2>Please select a size:</h2>-->
                    <!--                        <button>X-Small</button>-->
                    <!--                        <button> Small</button>-->
                    <!--                        <button> Large</button>-->
                    <!--                        <a href="#" ><h5>Size Chart</h5></a>-->
                    <!--                    </div>-->

                    <!--                    <div class="col-xs-12 detail" >-->
                    <!--                        <h3>$5.95 Flat-Rate Standard Shipping</h3>-->
                    <!--                    </div>-->
                    <!--                    <div class="col-xs-12 detail" >-->
                    <!--                        <h4>Ready-to-Ship Item</h4>-->
                    <!--                        <a href="#" ><h6>Learn More</h6></a>-->
                    <!--                        <h3>Usually ships in 1-2 days</h3>-->
                    <!--                    </div>-->
                    <div class="col-xs-12 detail" >
                        <h4>Description</h4>
                        <?php if (sizeof($modulo->data_productos) > 0) { ?>
                            <h3><?php echo $modulo->data_productos[0]->descripcion_producto; ?></h3>
                        <?php } ?>
                        <!--                        <h3>Draped neck knit dress with 3/4 sleeves, seaming detail and a flared skirt</h3>-->
                        <!--                        <ul>-->
                        <!---->
                        <!--                            <li>Model's measurements: Height 5'9", Bust 33", Waist 25", Hips 35#, wearing a size Small</li>-->
                        <!--                            <li>Care instrucions: Machine wash</li>-->
                        <!--                            <li>Measurements: shoulder to hemline 39", sleeve length 18", taken from size M.</li>-->
                        <!--                            <li>Country of origin: United States</li>-->
                        <!---->
                        <!--                        </ul>-->
                    </div>
                    <div class="col-xs-12 detail" style="height: 110px;"></div>





                </div>
            </div>

        </div>

    </content>
    <footer>
        <div id="cart">
            <button id="shoppingcart"><h2>Add to Cart</h2></button>
        </div>
        <div id="footer">
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/home.png" class="images" alt="" /></a>
                <h2><a href="<?php echo $modulo->base_url_store; ?>" onclick="">Products</a></h2>
            </div>

            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/search"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/sale.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/search" onclick="">Promotions</a></h1>
            </div>
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/search"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/tool.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/search" onclick="">Search</a></h1>
            </div>
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/cart"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/cart.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/cart" onclick="">Cart</a></h1>
            </div>
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/account"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/setting.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/account" onclick="">Account</a></h1>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel-viewport.min.js"></script>
    <!--    <script src="--><?php //echo PATH_RESOURCE_STORE; ?><!--js/util.js"></script>-->
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/respond.min.js"></script><![endif]-->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.scrolly.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.placeholder.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/main.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/bootstrap.min.js"></script>

    <script>

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
            } else {
                datosModificador = {
                    "id"    : idModifier,
                    "tipo"  : tipoModifier
                }
                listaModificadoresSeleccionados.push(datosModificador);
            }
            console.log(listaModificadoresSeleccionados);
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

        $(function () {

            $(".btnAddModifier").on("click", function (e){
                e.preventDefault();
                addModifier($(this).attr("data-id-modifier"), $(this).attr("data-type-modifier"));
                $(this).style.color = "BLACK";
            });

            $("#shoppingcart").on("click", function(evt){
                evt.preventDefault();
                var id_producto  = "<?php echo $modulo->data_productos[0]->id_producto; ?>";
                var nombre_producto  = "<?php echo $modulo->data_productos[0]->nombre_producto; ?>";
                var precio_producto  = "<?php echo $modulo->data_productos[0]->precio_producto; ?>";
                var formData = new FormData();
                formData.append("id_producto", id_producto);
                formData.append("nombre_producto", nombre_producto);
                formData.append("precio_producto", precio_producto);
                for(var i = 0 ; i< listaModificadoresSeleccionados.length; i++){
                    var m = "modificador".concat(i);
                    formData.append("modificador", listaModificadoresSeleccionados[i].id);

                }
                //formData.append("modificadores_producto", listaModificadoresSeleccionados);


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
                        alert(response.message);

                    } else {
                        alert(response.message);
                    }
                });

                request.fail(function( jqXHR, textStatus ) {
                    alert(textStatus);
                });



            });

        });
    </script>

</body>
</html>