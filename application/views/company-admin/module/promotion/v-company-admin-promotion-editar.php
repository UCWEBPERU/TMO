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
                Editar Promocion
                <small><a href="<?php echo $modulo->url_module_panel; ?>">Regresar</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo $modulo->url_module_panel; ?>"> Promociones</a></li>
                <li> Editar</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Promocion</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" id="frmDatosCategoria">
                            <?php if ($modulo->existe_promocion) { ?>
                                <input type="hidden" id="id_oferta" name="id_oferta" value="<?php echo $modulo->data_promocion->id_oferta; ?>">
                            <?php } ?>
                            <div class="box-body">
                                <?php if (!$modulo->existe_promocion) { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <h4><i class="icon fa fa-ban"></i> No existe la promocion!</h4>
                                        Lo sentimos la promocion que desea editar no existe.<br>
                                        <strong>No intente modificar la direccion url :D</strong>
                                    </div>
                                <?php } ?>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cboProducto">Producto</label>
                                            <select class="form-control select2" style="width: 100%;" id="cboProducto" name="cboProducto" data-parsley-required data-parsley-required-message="Seleccione un producto." disabled>
                                                <?php if ($modulo->existe_promocion) { ?>
                                                    <?php foreach($modulo->data_productos as $producto): ?>
                                                        <?php if ($modulo->data_promocion->id_producto == $producto->id_producto) { ?>
                                                            <option value="<?php echo $producto->id_producto; ?>" selected="selected"><?php echo $producto->nombre_producto; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $producto->id_producto; ?>"><?php echo $producto->nombre_producto; ?></option>
                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                                <?php } else { ?>
                                                    <option selected="selected" value="">Seleccione</option>
                                                    <?php foreach($modulo->data_productos as $producto): ?>
                                                        <option value="<?php echo $producto->id_producto; ?>"><?php echo $producto->nombre_producto; ?></option>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            </select>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="txtPrecioPromocion">Precio</label>
                                            <?php if ($modulo->existe_promocion) { ?>
                                                <input type="text" class="form-control" id="txtPrecioPromocion" name="txtPrecioPromocion" value="<?php echo $modulo->data_promocion->precio_oferta; ?>" data-parsley-required data-parsley-required-message="Ingrese el precio de promocion.">
                                            <?php } else { ?>
                                                <input type="text" class="form-control" id="txtPrecioPromocion" name="txtPrecioPromocion" data-parsley-required data-parsley-required-message="Ingrese el precio de promocion.">
                                            <?php } ?>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="txtDescripcionPromocion">Descripcion</label>
                                            <?php if ($modulo->existe_promocion) { ?>
                                                <textarea class="form-control" id="txtDescripcionPromocion" name="txtDescripcionPromocion" cols="30" rows="5" data-parsley-required-message="Ingrese la descripcion de la promocion."><?php echo $modulo->data_promocion->descripcion_oferta; ?></textarea>
                                            <?php } else { ?>
                                                <textarea class="form-control" id="txtDescripcionPromocion" name="txtDescripcionPromocion" cols="30" rows="5" data-parsley-required-message="Ingrese la descripcion de la promocion."></textarea>
                                            <?php } ?>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="txtFechaInicio">Fecha Inicio</label>
                                            <?php if ($modulo->existe_promocion) { ?>
                                                <input type="text" class="form-control datepicker" id="txtFechaInicio" name="txtFechaInicio" value="<?php $date = new DateTime($modulo->data_promocion->fecha_inicio); echo date_format($date, "Y-m-d"); ?>" data-parsley-required data-parsley-required-message="Ingrese fecha de inicio de la promocion.">
                                            <?php } else { ?>
                                                <input type="text" class="form-control datepicker" id="txtFechaInicio" name="txtFechaInicio" data-parsley-required data-parsley-required-message="Ingrese fecha de inicio de la promocion.">
                                            <?php } ?>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="txtFechaFin">Fecha Fin</label>
                                            <?php if ($modulo->existe_promocion) { ?>
                                                <input type="text" class="form-control datepicker" id="txtFechaFin" name="txtFechaFin" value="<?php $date = new DateTime($modulo->data_promocion->fecha_fin); echo date_format($date, "Y-m-d"); ?>" data-parsley-required data-parsley-required-message="Ingrese fecha de fin de la promocion.">
                                            <?php } else { ?>
                                                <input type="text" class="form-control datepicker" id="txtFechaFin" name="txtFechaFin" data-parsley-required data-parsley-required-message="Ingrese fecha de fin de la promocion.">
                                            <?php } ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="button-effect-1" id="btnGuardar" >Guardar</button>
                            </div>
                        </form>
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
<!-- bootstrap datepicker -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>datepicker/bootstrap-datepicker.js"></script>
<script>
    $(function () {

        //Initialize Select2 Elements
        $(".select2").select2();

        GenericModal.config("#genericModal", "");

        var selectorInputsForm = ["#cboProducto", "#txtPrecioPromocion", "#txtDescripcionPromocion", "#txtFechaInicio", "#txtFechaFin"];
        var formData = new FormData();

        $("#btnGuardar").on("click", function(evt) {
            evt.preventDefault();

            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {
                waitingDialog.show('Guardando Promocion...');

                formData.append("id_oferta",                $("#id_oferta").val());
                formData.append("cboProducto",              $("#cboProducto").val());
                formData.append("txtPrecioPromocion",       $("#txtPrecioPromocion").val());
                formData.append("txtDescripcionPromocion",  $("#txtDescripcionPromocion").val());
                formData.append("txtFechaInicio",           $("#txtFechaInicio").val());
                formData.append("txtFechaFin",              $("#txtFechaFin").val());

                var request = $.ajax({
                    url: "<?php echo $modulo->url_module_panel."/ajax/addPromotion"; ?>",
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false
                });

                request.done(function( response ) {
                    waitingDialog.hide();
                    formData = new FormData();
                    if (response.status) {
                        GenericModal.show("default", "<p>" + response.message + "</p>");
                    } else {
                        GenericModal.show("danger", "<p>" + response.message + "</p>");
                    }
                });

                request.fail(function( jqXHR, textStatus ) {
                    formData = new FormData();
                    GenericModal.show("danger", "<p>" + textStatus + "</p>");
                });
            }
        });

        //Date picker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('.datepicker').on("keypress", function(event){
            event.preventDefault();
        });

    });
</script>
</body>
</html>