<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
<body class="hold-transition skin-blue sidebar-mini fix-padding-scrollbar">
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
                            <?php
                            if ( isset($id_paquete_tmo) ) { ?>
                                <input type="hidden" name="id_paquete_tmo" value="<?php echo $id_paquete_tmo; ?>">
                            <?php } ?>
                            <div class="box-body">
                                <?php
                                if (!$existePaqueteTMO) { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <h4><i class="icon fa fa-ban"></i> No existe el Paquete!</h4>
                                        Lo sentimos el Paquete que desea editar no existe.<br>
                                        <strong>No intente modificar la direccion url :D</strong>
                                    </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label for="txtNombre">Nombre</label>
                                    <?php
                                    if ($existePaqueteTMO) { ?>
                                        <input type="text" class="form-control" id="txtNombre" name="txtNombre" maxlength="50" value="<?php echo $dataPaqueteTMO->nombre_paquete; ?>" data-parsley-required data-parsley-required-message="Ingrese nombre del paquete.">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtNombre" name="txtNombre" maxlength="50" data-parsley-required data-parsley-required-message="Ingrese nombre del paquete.">
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="txtDescripcion">Descripcion</label>
                                    <?php
                                    if ($existePaqueteTMO) { ?>
                                        <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" maxlength="150" value="<?php echo $dataPaqueteTMO->descripcion_paquete; ?>">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" maxlength="150">
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalTiendas">Total Tiendas</label>
                                    <?php
                                    if ($existePaqueteTMO) { ?>
                                        <input type="text" class="form-control" id="txtTotalTiendas" name="txtTotalTiendas" maxlength="5" value="<?php echo $dataPaqueteTMO->total_store; ?>" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de tiendas del paquete." data-parsley-type-message=" El total de tiendas solo debe ser numeros.">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtTotalTiendas" name="txtTotalTiendas" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de tiendas del paquete." data-parsley-type-message=" El total de tiendas solo debe ser numeros.">
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalProductos">Total Productos</label>
                                    <?php
                                    if ($existePaqueteTMO) { ?>
                                        <input type="text" class="form-control" id="txtTotalProductos" name="txtTotalProductos" maxlength="5" value="<?php echo $dataPaqueteTMO->total_products; ?>" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de productos del paquete." data-parsley-type-message=" El total de productos solo debe ser numeros.">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtTotalProductos" name="txtTotalProductos" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de productos del paquete." data-parsley-type-message=" El total de productos solo debe ser numeros.">
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalUsuarios">Total Usuarios</label>
                                    <?php
                                    if ($existePaqueteTMO) { ?>
                                        <input type="text" class="form-control" id="txtTotalUsuarios" name="txtTotalUsuarios" maxlength="5" value="<?php echo $dataPaqueteTMO->total_users; ?>" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de usuarios del paquete." data-parsley-type-message=" El total de usuarios solo debe ser numeros.">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtTotalUsuarios" name="txtTotalUsuarios" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de usuarios del paquete." data-parsley-type-message=" El total de usuarios solo debe ser numeros.">
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalCategorias">Total Categorias</label>
                                    <?php
                                    if ($existePaqueteTMO) { ?>
                                        <input type="text" class="form-control" id="txtTotalCategorias" name="txtTotalCategorias" maxlength="5" value="<?php echo $dataPaqueteTMO->total_categorias; ?>" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de categorias del paquete." data-parsley-type-message=" El total de categorias solo debe ser numeros.">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtTotalCategorias" name="txtTotalCategorias" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese total de categorias del paquete." data-parsley-type-message=" El total de categorias solo debe ser numeros.">
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="txtTiempoSuscripcion">Tiempo Suscripción (Meses)</label>
                                    <?php
                                    if ($existePaqueteTMO) { ?>
                                        <input type="text" class="form-control" id="txtTiempoSuscripcion" name="txtTiempoSuscripcion" maxlength="5" value="<?php echo $dataPaqueteTMO->tiempo_meses_paquete; ?>" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese tiempo de suscripción del paquete." data-parsley-type-message=" El tiempo de suscripcion solo debe ser numeros.">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtTiempoSuscripcion" name="txtTiempoSuscripcion" maxlength="5" data-parsley-required data-parsley-type="number" data-parsley-required-message="Ingrese tiempo de suscripción del paquete." data-parsley-type-message=" El tiempo de suscripcion solo debe ser numeros.">
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="txtPrecio">Precio</label>
                                    <?php
                                    if ($existePaqueteTMO) { ?>
                                        <input type="text" class="form-control" id="txtPrecio" name="txtPrecio" maxlength="5" value="<?php echo $dataPaqueteTMO->precio_paquete; ?>" data-parsley-required data-parsley-required-message="Ingrese precio del paquete.">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtPrecio" name="txtPrecio" maxlength="5" data-parsley-required data-parsley-required-message="Ingrese precio del paquete.">
                                    <?php } ?>
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
        var baseUrl     = "<?php echo base_url(); ?>";
        var urlApi      = "<?php echo base_url(); ?>" + "admin/paquetes-tmo/editar";

        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {

                waitingDialog.show('Cargando...');

                var request = $.ajax({
                    url: urlApi,
                    method: "POST",
                    data: $("#formPaqueteTMO").serialize(),
                    dataType: "json"
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

    });

</script>
</body>
</html>