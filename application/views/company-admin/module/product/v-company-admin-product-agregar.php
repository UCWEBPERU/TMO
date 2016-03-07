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
                                            <label>Tienda</label>
                                            <select class="form-control select2" style="width: 100%;" id="" name="" multiple="multiple">
                                                <?php foreach($modulo->data_tiendas as $tienda): ?>
                                                    <option value="<?php echo $tienda->id_tienda; ?>"><?php echo $tienda->nombre_tienda; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="txtStockProducto">Stock</label>
                                            <input type="text" class="form-control" id="txtStockProducto" name="txtStockProducto" data-parsley-required data-parsley-required-message="Ingrese el stock del producto.">
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
                                                        <th style="width: 40px">Costo</th>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-chevron-right"></i></td>
                                                        <td><a href="#" id="btnAddMoficador"><span class="label label-primary">Agregar modificador</span></a></td>
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
                            <div class="box-image-product" style="background-image:url(&quot;<?php echo $modulo->icono_empresa; ?>&quot;);">
                                <div class="box-action-button">
                                    <button class="btn-img-product btn-delete" data-action-delete="delete-data" data-id-img="1" title="Eliminar">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-image-product" style="background-image:url(&quot;<?php echo $modulo->icono_empresa; ?>&quot;);">
                                <div class="box-action-button">
                                    <button class="btn-img-product btn-delete" data-action-delete="delete-data" title="Eliminar">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-image-product" style="background-image:url(&quot;<?php echo $modulo->icono_empresa; ?>&quot;);">
                                <div class="box-image-product-hint">Cambiar Logo Empresa</div>
                                <input type="file" id="imgLogoStore" name="imgLogoStore" accept="image/*">
                            </div>
                            <div class="box-image-product" style="background-image:url(&quot;<?php echo $modulo->icono_empresa; ?>&quot;);">
                                <div class="box-image-product-hint">Cambiar Logo Empresa</div>
                                <input type="file" id="imgLogoStore" name="imgLogoStore" accept="image/*">
                            </div>
                            <div class="box-image-product" style="background-image:url(&quot;<?php echo $modulo->icono_empresa; ?>&quot;);">
                                <div class="box-image-product-hint">Cambiar Logo Empresa</div>
                                <input type="file" id="imgLogoStore" name="imgLogoStore" accept="image/*">
                            </div>
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
<script>
    //Initialize Select2 Elements
    $(".select2").select2();

    GenericModal.config("#genericModal", "");

    var selectorInputsForm = ["#txtNombreProducto", "#txtDescripcionProducto", "#txtStockProducto", "#txtPrecioProducto", "#cboSubCategorias"];
    var contadorImagenes = 0;
    var formDataProduct = new FormData();
    var listFileImageProducts = [];
    var objFile = {};

    function validateInputsForm(selectorInputsForm) {
        var messagesError = "";
        for (var i = 0; i < selectorInputsForm.length; i++) {
            if ($(selectorInputsForm[i]).parsley().isValid()) {
                $(selectorInputsForm[i]).parent().removeClass("has-error");
            } else {
                $(selectorInputsForm[i]).parent().addClass("has-error");
                messagesError += "<li>" + ParsleyUI.getErrorsMessages($(selectorInputsForm[i]).parsley()) + "</li>";
            }
        }
        if (messagesError.length > 0) {
            GenericModal.show("danger", "<ul>" + messagesError + "</ul>");
            return false;
        }
        return true;
    }

    function handlerDeleteImageProduct(btn) {
        if ($(btn).attr("data-action-delete") == "delete-data") {
            $(btn).parent().parent().hide("slow");
            for (var c = 0; c < listFileImageProducts.length; c++) {
                if ( listFileImageProducts[c].id == $(btn).attr("data-id-img") ) {
                    listFileImageProducts.splice(c,1);
                    break;
                }
            }
            console.log(listFileImageProducts);
        }
    }

    $(function () {

        var indexModifier = 0;

        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

            if (validateInputsForm(selectorInputsForm)) {
                waitingDialog.show('Guardando Producto...');

                formDataProduct.append("txtNombreProducto", $("#txtNombreProducto").val());
                formDataProduct.append("txtDescripcionProducto", $("#txtDescripcionProducto").val());
                formDataProduct.append("txtStockProducto", $("#txtStockProducto").val());
                formDataProduct.append("txtPrecioProducto", $("#txtPrecioProducto").val());
                formDataProduct.append("cboSubCategorias", $("#cboSubCategorias").val());
                formDataProduct.append("totalImages", contadorImagenes);

                var request = $.ajax({
                    url: "<?php echo $modulo->url_main_panel."/products/ajax/addProduct"; ?>",
                    method: "POST",
                    data: formDataProduct,
                    dataType: "json",
                    processData: false,
                    contentType: false
                });

                request.done(function( response ) {
                    waitingDialog.hide();
                    if (response.status) {
                        GenericModal.show("default", "<p>" + response.message + "</p>");
                    } else {
                        GenericModal.show("danger", "<p>" + response.message + "</p>");
                    }
                });

                request.fail(function( jqXHR, textStatus ) {
                    waitingDialog.hide();
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

        $(".btn-img-product").on("click", function(){
            handlerDeleteImageProduct(this);
        });

        $("#cboCategorias").on("select2:select", function (event) {
            var formDataCategory = new FormData();

            formDataCategory.append("id_categoria", event.params.data.id);
            var request = $.ajax({
                url: "<?php echo $modulo->url_main_panel."/products/ajax/getSubCategorys"; ?>",
                method: "POST",
                data: formDataCategory,
                dataType: "json",
                processData: false,
                contentType: false
            });

            request.done(function( response ) {
                waitingDialog.hide();
                $("#cboSubCategorias").empty();
                // $("#cboSubCategorias").val("").trigger("change");
                var html = "<option selected='selected' value=''>Seleccione</option>";
                if (response.status) {
                    for (var i=0; i < response.data.length; i++) {
                        html += "<option value='" + response.data[i].id_categoria + "'>" + response.data[i].nombre_categoria + "</option>";
                    }
                }
                $("#cboSubCategorias").append(html);
            });

            request.fail(function( jqXHR, textStatus ) {
                waitingDialog.hide();
                GenericModal.show("danger", "<p>" + textStatus + "</p>");
            });
        });

        $("#cboSubCategorias").on("select2:select", function (event) {
            // alert($(this).val() + " " + event.params.data.id);
        });

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
                                    indexModifier = $(".table-modifiers tbody tr").length - 2 + 1;

                                    swal("Modificador agregado!", tipoModificador + ": " + nombreModificador, "success");

                                    var html = "<tr data-modifier-type='" + tipoModificador + "' data-modifier-name='" + nombreModificador + "' " +
                                        "data-modifier-cost='" + costoModificador + "'><td>" + indexModifier + ".</td><td>" + tipoModificador +
                                        "</td><td>" + nombreModificador + "</td><td>" + ((costoModificador) ? costoModificador : 0) + "</td></tr>";

                                    $(".table-modifiers tbody tr").last().before(html);

                                    formDataProduct.append("modifier_" + indexModifier + "_type", tipoModificador);
                                    formDataProduct.append("modifier_" + indexModifier + "_name", nombreModificador);
                                    formDataProduct.append("modifier_" + indexModifier + "_cost", (costoModificador) ? costoModificador : 0);

                                    console.log(formDataProduct);
                                    console.log($(".table-modifiers tbody tr").last());
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