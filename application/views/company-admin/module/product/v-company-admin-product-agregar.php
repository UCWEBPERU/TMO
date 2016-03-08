<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
<body class="hold-transition skin-blue fixed sidebar-mini fix-padding-scrollbar">
<div class="wrapper">

    <?php
    $data["modulo"] = $modulo;
    $this->load->view('template/main-panel/header', $data); ?>

    <?php
    $data["menu"]     = $modulo->menu["menu"];
    $data["submenu"]  = $modulo->menu["submenu"];
    $this->load->view('company-admin/v-company-admin-menu', $data); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Agregar Producto
                <small><a href="<?php echo $modulo->url_module_panel; ?>">Regresar</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo $modulo->url_module_panel; ?>"> Productos</a></li>
                <li> Agregar</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Producto</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" id="frmDatosCategoria">
                            <div class="box-body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="txtNombreProducto">Nombre</label>
                                            <input type="text" class="form-control" id="txtNombreProducto" name="txtNombreProducto" data-parsley-required data-parsley-required-message="Ingrese el nombre del producto.">
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="txtDescripcionProducto">Descripcion</label>
                                            <input type="text" class="form-control" id="txtDescripcionProducto" name="txtDescripcionProducto" data-parsley-required data-parsley-required-message="Ingrese la descripcion del producto.">
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="txtPrecioProducto">Precio</label>
                                            <input type="text" class="form-control" id="txtPrecioProducto" name="txtPrecioProducto" data-parsley-required data-parsley-required-message="Ingrese el precio del producto.">
                                        </div><!-- /.form-group -->

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="cboTienda">Tienda</label>
                                            <select class="form-control select2" style="width: 100%;" id="cboTienda" name="cboTienda" multiple="multiple" data-parsley-required data-parsley-required-message="Seleccione una tienda.">
                                                <?php foreach($modulo->data_tiendas as $tienda): ?>
                                                    <option value="<?php echo $tienda->id_tienda; ?>"><?php echo $tienda->nombre_tienda; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="txtStockProducto">Stock</label>
                                            <input type="text" class="form-control" id="txtStockProducto" name="txtStockProducto" data-parsley-required data-parsley-required-message="Ingrese el stock del producto.">
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="cboCategoria">Categoria</label>
                                            <select class="form-control select2" style="width: 100%;" id="cboCategoria" name="cboCategoria" data-parsley-required data-parsley-required-message="Seleccione una categoria.">
                                                <option selected="selected" value="">Seleccione</option>
                                                <?php foreach($modulo->data_categorias as $categoria): ?>
                                                    <option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div><!-- /.form-group -->

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="txtStockProducto">Modificadores</label>
                                            <table class="table table-bordered table-modifiers">
                                                <tbody>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Tipo</th>
                                                    <th>Nombre</th>
                                                    <th>Costo</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-chevron-right"></i></td>
                                                    <td><a href="#" id="btnAddMoficador"><span class="label label-primary">Agregar modificador</span></a></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div><!-- /.form-group -->
                                    </div>

                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="button-effect-1" id="btnAgregar" >Agregar</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.col -->

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Galeria Producto</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box-galery-products">
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="btn button-effect-1 btn-file">
                                <i class="fa fa-photo"></i> Upload new image
                                <input type="file" id="btnAddImage" accept="image/*">
                            </div>
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->

            </div><!-- /.row -->

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <?php $this->load->view('template/main-panel/footer'); ?>
</div><!-- ./wrapper -->
<?php $this->load->view('template/main-panel/modal-admin'); ?>
<?php $this->load->view('template/main-panel/scripts-footer'); ?>
<!-- Parsley -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
<!-- Handle File -->
<script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/HandleFile.js"></script>
<!-- Sweet Alert -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.min.js"></script>
<!-- Validate Input Form With Parsley -->
<script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/ValidateInputFormWithParsley.js"></script>
<script>

    $(function () {

        //Initialize Select2 Elements
        $(".select2").select2();

        GenericModal.config("#genericModal", "");

        var selectorInputsForm = ["#txtNombreProducto", "#txtDescripcionProducto", "#txtStockProducto", "#txtPrecioProducto", "#cboCategoria", "#cboTienda"];
        var listFileImageProducts = [];
        var listModifiers = [];
        var formDataProduct = new FormData();
        var objFile = {};
        var objModifier = {};
        var contadorImagenes = 0;
        var contadorModificadores = 0;

        function handlerDeleteImageProduct(btn) {
            if ($(btn).attr("data-action-delete") == "delete-data") {
                $(btn).parent().parent().hide();
                for (var c = 0; c < listFileImageProducts.length; c++) {
                    if ( listFileImageProducts[c].id == $(btn).attr("data-id-img") ) {
                        listFileImageProducts.splice(c,1);
                        break;
                    }
                }
                console.log(listFileImageProducts);
            }
        }

        function handlerDeleteModifier(btn) {
            if ($(btn).attr("data-action-delete") == "delete-data") {
                $(btn).parent().parent().hide(function(){
                    $(btn).parent().parent().remove();
                    var newIndex = 1;
                    $(".table-modifiers tbody tr").each(function(index) {
                        if ($(this).attr("data-modifier-type")) {
                            console.log($(this).children().first());
                            $(this).children().first().html("" + newIndex);
                            newIndex++;
                        }
                    });
                });
                for (var c = 0; c < listModifiers.length; c++) {
                    if ( listModifiers[c].id == $(btn).attr("data-id-modifier") ) {
                        listModifiers.splice(c,1);
                        break;
                    }
                }
                console.log(listFileImageProducts);
            }
        }

        function loadImagesProduct() {
            for (var c = 0; c < listFileImageProducts.length; c++) {
                formDataProduct.append("file_" + c, listFileImageProducts[c].file);
                console.log("Nombre File" + "file_" + c);
            }
        }

        function loadModifier() {
            for (var c = 0; c < listModifiers.length; c++) {
                formDataProduct.append("modifier_" + c + "_type", listModifiers[c].type);
                formDataProduct.append("modifier_" + c + "_name", listModifiers[c].name);
                formDataProduct.append("modifier_" + c + "_cost", (listModifiers[c].cost) ? listModifiers[c].cost : 0);
            }
        }

        $("#btnAgregar").on("click", function(evt) {
            evt.preventDefault();

            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {
                waitingDialog.show('Guardando Producto...');

                formDataProduct.append("txtNombreProducto",      $("#txtNombreProducto").val());
                formDataProduct.append("txtDescripcionProducto", $("#txtDescripcionProducto").val());
                formDataProduct.append("txtStockProducto",       $("#txtStockProducto").val());
                formDataProduct.append("txtPrecioProducto",      $("#txtPrecioProducto").val());
                formDataProduct.append("cboCategoria",           $("#cboCategoria").val());
                formDataProduct.append("cboTienda",              $("#cboTienda").val());
                formDataProduct.append("totalImages",            listFileImageProducts.length);
                formDataProduct.append("totalModifiers",         contadorModificadores);
                loadImagesProduct();
                loadModifier();

                var request = $.ajax({
                    url: "<?php echo $modulo->url_module_panel."/ajax/addProduct"; ?>",
                    method: "POST",
                    data: formDataProduct,
                    dataType: "json",
                    processData: false,
                    contentType: false
                });

                request.done(function( response ) {
                    waitingDialog.hide();
                    listFileImageProducts = [];
                    listModifiers = [];
                    formDataProduct = new FormData();
                    objFile = {};
                    objModifier = {};
                    contadorImagenes = 0;
                    contadorModificadores = 0;
                    if (response.status) {
                        GenericModal.show("default", "<p>" + response.message + "</p>");
                    } else {
                        GenericModal.show("danger", "<p>" + response.message + "</p>");
                    }
                });

                request.fail(function( jqXHR, textStatus ) {
                    waitingDialog.hide();
                    listFileImageProducts = [];
                    listModifiers = [];
                    formDataProduct = new FormData();
                    objFile = {};
                    objModifier = {};
                    contadorImagenes = 0;
                    contadorModificadores = 0;
                    GenericModal.show("danger", "<p>" + textStatus + "</p>");
                });
            }
        });

        var objHandleFile = new HandleFile("#btnAddImage");
        objHandleFile.onSelect(
            function(file) {
                objFile = {
                    "id": contadorImagenes,
                    "file": file
                }
                listFileImageProducts.push(objFile);
                console.log(listFileImageProducts);
            },
            function(readResult) {
                var html = '<div class="box-image-product" style="background-image:url(&quot;' + readResult + '&quot;);">' +
                    '<div class="box-action-button">' +
                    '<button class="btn-img-product btn-delete" data-action-delete="delete-data" data-id-img="' + contadorImagenes + '" title="Eliminar">' +
                    '<i class="fa fa-remove"></i> </button> </div> </div>';

                html = $(html);

                html.find(".btn-img-product").on("click", function(){
                    handlerDeleteImageProduct(this);
                });

                $(".box-galery-products").append(html);
                contadorImagenes++;
            }
        );

        $("#btnAddMoficador").on("click", function(event) {
            event.preventDefault();
            swal({
                    title: "Agregar un Modificador",
                    text: "Ingrese el tipo del modificador",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top"
                },
                function(tipoModificador) {
                    if (tipoModificador === false) return false;
                    if (tipoModificador === "") {
                        swal.showInputError("Ingrese el tipo del modificador");
                        return false;
                    }
                    swal({
                            title: "Agregar un Modificador",
                            text: "Ingrese el nombre del modificador",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            animation: "slide-from-top"
                        },
                        function(nombreModificador) {
                            if (nombreModificador === false) return false;
                            if (nombreModificador === "") {
                                swal.showInputError("Ingrese el nombre del modificador");
                                return false;
                            }
                            swal({
                                    title: "Agregar un Modificador",
                                    text: "Ingrese el costo del modificador",
                                    type: "input",
                                    showCancelButton: true,
                                    closeOnConfirm: false,
                                    animation: "slide-from-top"
                                },
                                function(costoModificador) {
                                    console.log(typeof costoModificador + "");
                                    var indexRow = $(".table-modifiers tbody tr").length - 2 + 1;

                                    swal("Modificador agregado!", tipoModificador + ": " + nombreModificador, "success");

                                    var html = "<tr data-modifier-type='" + tipoModificador + "' data-modifier-name='" + nombreModificador + "' " +
                                        "data-modifier-cost='" + costoModificador + "'><td>" + indexRow + "</td><td>" + tipoModificador +
                                        "</td><td>" + nombreModificador + "</td><td>" + ((costoModificador) ? costoModificador : 0) + "</td>" +
                                        "<td><button class='btn-modifier-product btn-delete' data-action-delete='delete-data' data-id-modifier='" + contadorModificadores + "'><i class='fa fa-remove'></i></button></td> </tr>";

                                    html = $(html);

                                    html.find(".btn-modifier-product").on("click", function(event) {
                                        event.preventDefault();
                                        handlerDeleteModifier(this);
                                    });

                                    $(".table-modifiers tbody tr").last().before(html);

                                    objModifier = {
                                        "id":   contadorModificadores,
                                        "type": tipoModificador,
                                        "name": nombreModificador,
                                        "cost": (costoModificador) ? costoModificador : 0
                                    }
                                    listModifiers.push(objModifier);

                                    contadorModificadores++;
                                    console.log(formDataProduct);
                                }
                            );
                        }
                    );
                }
            );
        });
    });
</script>
</body>
</html>