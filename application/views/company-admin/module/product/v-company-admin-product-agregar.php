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

                                            <table class="table table-bordered">
                                                <tbody><tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Task</th>
                                                    <th>Progress</th>
                                                    <th style="width: 40px">Label</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Update software</td>
                                                    <td>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-red">55%</span></td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Clean database</td>
                                                    <td>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-yellow">70%</span></td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>Cron job running</td>
                                                    <td>
                                                        <div class="progress progress-xs progress-striped active">
                                                            <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-light-blue">30%</span></td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>Fix and squish bugs</td>
                                                    <td>
                                                        <div class="progress progress-xs progress-striped active">
                                                            <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-green">90%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-chevron-right"></i></td>
                                                    <td><a href="#" class="btnAddMoficador"><span class="label label-primary">Agregar modificador</span></a></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                </tbody></table>
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
<script>
    //Initialize Select2 Elements
    $(".select2").select2();

    GenericModal.config("#genericModal", "");

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

    $(function () {
        var selectorInputsForm = ["#txtNombreProducto", "#txtDescripcionProducto", "#txtStockProducto", "#txtPrecioProducto", "#cboSubCategorias"];
        var contadorImagenes = 1;
        var formDataProduct = new FormData();

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
                formDataProduct.append("file_" + contadorImagenes, file);
                console.log("Nombre File" + "file_" + contadorImagenes);
                contadorImagenes++;
            },
            function(readResult) {
                var html = "<div class='col-md-4 col-sm-4 col-xs-12'>" +
                    "<img id='' class='' src='" + readResult + "' alt='Image Product' title='Image Product'>" +
                    "</div>";
                $(".box-galery-products").append(html);
                // $("#logoStore").attr("src", readResult);
            }
        );

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
                            text: "Ingrese el valor del modificador",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            animation: "slide-from-top"
                        },
                        function(valorModificador) {
                            if (valorModificador === false) return false;
                            if (valorModificador === "") {
                                swal.showInputError("Ingrese el valor del modificador");
                                return false;
                            }
                            swal("Modificador agregado!", nombreModificador + ": " + valorModificador, "success");
                            var html = "<a href='' data-modifier-name='" + nombreModificador + "' data-modifier-value='" + valorModificador + "'><span class='label label-primary'>" + nombreModificador + ": " + valorModificador + "</span></a>";
                            $(".form-group-modifiers .form-control").append(html);
                        }
                    );
                }
            );
        });
    });
</script>
</body>
</html>