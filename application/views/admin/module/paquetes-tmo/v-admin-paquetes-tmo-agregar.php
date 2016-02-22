<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php
    $data["modulo"] = $modulo;
    $this->load->view('template/main-panel/header', $data); ?>

    <?php
    $data["menu"]     = $modulo->menu["menu"];
    $data["submenu"]  = $modulo->menu["submenu"];
    $this->load->view('admin/v-admin-menu', $data); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $modulo->titulo; ?>
                <small><a href="<?php echo base_url().$modulo->base_url; ?>">Regresar</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>admin/paquetes-tmo"> Paquetes TMO</a> </li>
                <li><?php echo strtolower($modulo->nombreSeccion); ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $modulo->nombreSeccion; ?> Paquete TMO</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="formPaqueteTMO" role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="txtNombre">Nombre</label>
                                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" maxlength="50" data-parsley-required data-parsley-required-message="Ingrese nombre del paquete.">
                                </div>

                                <div class="form-group">
                                    <label for="txtDescripcion">Descripcion</label>
                                    <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" maxlength="150">
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalTiendas">Total Tiendas</label>
                                    <input type="text" class="form-control" id="txtTotalTiendas" name="txtTotalTiendas" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de tiendas del paquete." data-parsley-required-type=" El total de tiendas solo debe ser numeros.">
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalProductos">Total Productos</label>
                                    <input type="text" class="form-control" id="txtTotalProductos" name="txtTotalProductos" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de productos del paquete." data-parsley-required-type=" El total de productos solo debe ser numeros.">
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalUsuarios">Total Usuarios</label>
                                    <input type="text" class="form-control" id="txtTotalUsuarios" name="txtTotalUsuarios" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de usuarios del paquete." data-parsley-required-type=" El total de usuarios solo debe ser numeros.">
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalCategorias">Total Categorias</label>
                                    <input type="text" class="form-control" id="txtTotalCategorias" name="txtTotalCategorias" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de categorias del paquete." data-parsley-required-type=" El total de categorias solo debe ser numeros.">
                                </div>

                                <div class="form-group">
                                    <label for="txtTiempoSuscripcion">Tiempo Suscripción (Meses)</label>
                                    <input type="text" class="form-control" id="txtTiempoSuscripcion" name="txtTiempoSuscripcion" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese tiempo de suscripción del paquete." data-parsley-required-type=" El tiempo de suscripcion solo debe ser numeros.">
                                </div>

                                <div class="form-group">
                                    <label for="txtPrecio">Precio</label>
                                    <input type="text" class="form-control" id="txtPrecio" name="txtPrecio" maxlength="5" data-parsley-required data-parsley-required-message="Ingrese precio del paquete.">
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="btnAgregar" type="submit" class="btn btn-primary"><?php echo $modulo->nombreSeccion; ?></button>
                            </div>
                        </form>
                        <div class="overlay hide" >
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div><!-- /.box -->
                </div><!--/.col (left) -->

            </div>   <!-- /.row -->
        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

    <?php $this->load->view('template/main-panel/footer'); ?>

</div><!-- ./wrapper -->
<?php $this->load->view('template/main-panel/scripts-footer'); ?>
<?php $this->load->view('template/main-panel/modal-admin'); ?>
<!-- Parsley -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
<!-- Validate Input Form With Parsley -->
<script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/ValidateInputFormWithParsley.js"></script>
<script>
    $(function () {
        GenericModal.config("#genericModal", "");
        var selectorInputsForm = ["#txtNombre", "#txtDescripcion", "#txtTotalTiendas", "#txtTotalProductos",
            "#txtTotalUsuarios", "#txtTotalCategorias", "#txtTiempoSuscripcion", "#txtPrecio"];
        var baseUrl   = "<?php echo base_url(); ?>";

        var formData  = new FormData();

        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

            var urlApi = "<?php echo base_url(); ?>" + "admin/paquetes-tmo/crear";

            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {

                waitingDialog.show('Cargando...');

                formData.append("#txtNombre",               $("#txtNombre").val());
                formData.append("#txtDescripcion",          $("#txtDescripcion").val());
                formData.append("#txtTotalTiendas",         $("#txtTotalTiendas").val());
                formData.append("#txtTotalProductos",       $("#txtTotalProductos").val());
                formData.append("#txtTotalUsuarios",        $("#txtTotalUsuarios").val());
                formData.append("#txtTotalCategorias",      $("#txtTotalCategorias").val());
                formData.append("#txtTiempoSuscripcion",    $("#txtTiempoSuscripcion").val());
                formData.append("#txtPrecio",               $("#txtPrecio").val());

                var request = $.ajax({
                    url: urlApi,
                    method: "POST",
                    data: $("#formPaqueteTMO").serialize(),
                    dataType: "json"
                });

                request.done(function( response ) {

                    waitingDialog.hide();
                    formData = new FormData();
                    if (response.status) {
                        GenericModal.show("default", "<p>" + response.message + "</p>");
                        if (response.action == "insert") {
                            $("#txtNombre").val();
                            $("#txtDescripcion").val();
                            $("#txtTotalTiendas").val();
                            $("#txtTotalProductos").val();
                            $("#txtTotalUsuarios").val();
                            $("#txtTotalCategorias").val();
                            $("#txtTiempoSuscripcion").val();
                            $("#txtPrecio").val();
                        }

                    } else {
                        GenericModal.show("danger", "<p>" + response.message + "</p>");
                    }

                });

                request.fail(function( jqXHR, textStatus ) {
                    waitingDialog.hide();
                    $(".overlay").addClass("hide");
                    GenericModal.show("danger", "<p>" + textStatus + "</p>");
                });

            }

        });

    });

</script>
</body>
</html>