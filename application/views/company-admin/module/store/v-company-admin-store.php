<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
<body class="hold-transition skin-blue sidebar-mini">
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $modulo->titulo; ?>
                <small><a href="<?php echo base_url().$modulo->base_url; ?>agregar">Agregar</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <?php foreach ($modulo->navegacion as $navegacion) {
                    if ($navegacion["activo"]) { ?>
                        <li class="active"><?php echo $navegacion["nombre"]; ?></li>
                    <?php } else {
                        if (strlen($navegacion["url"]) > 0) { ?>
                            <li><a href="<?php echo base_url().$navegacion["url"]; ?>"><?php echo $navegacion["nombre"]; ?></a></li>
                        <?php } else { ?>
                            <li><?php echo $navegacion["nombre"]; ?></li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo $modulo->titulo_registro; ?></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>

                                    <?php foreach ($modulo->cabecera_registro as $nombreCabecera) { ?>
                                        <th><?php echo $nombreCabecera; ?></th>
                                    <?php } ?>

                                    <th></th>
                                </tr>
                                <?php
                                $registros["registros"] = $modulo->registros;
                                $registros["moduloNombre"] = $modulo->nombre;
                                $this->load->view($modulo->ruta_plantilla_registro, $registros); ?>

                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <!-- Show pagination links -->
                                <?php
                                foreach ($modulo->links as $link) {
                                    echo "<li>". $link."</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="overlay hide" >
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div><!-- /.box -->

                </div>
            </div>
        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

    <?php $this->load->view('template/main-panel/footer'); ?>

</div><!-- ./wrapper -->
<?php $this->load->view('template/main-panel/scripts-footer'); ?>
<!-- Sweet Alert -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.min.js"></script>
<script>
    $(function () {
        var baseUrl   = "<?php echo base_url(); ?>";
        var urlApi    = "";
        var formData  = new FormData();

        $(".btnActionRow").on("click", function(evt){

            var self = this;

            if ( $(this).attr("data-row-action") == "delete") {
                evt.preventDefault();
                urlApi = baseUrl + "<?php echo $modulo->base_url; ?>delete";
                formData.append("id_empresa", $(this).attr("data-row-id"));

                swal({
                        title: "Eliminar Empresa",
                        text: "¿Seguro que desea eliminar la empresa?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#fc0836",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                    function() {
                        var request = $.ajax({
                            url: urlApi,
                            method: "POST",
                            data: formData,
                            dataType: "json",
                            processData: false,
                            contentType: false
                        });

                        request.done(function( response ) {
                            waitingDialog.hide();
                            if (response.status) {
                                swal("Eliminado!", response.message, "success");
                                $(self).parent().parent().hide("slow", function(){
                                    $(self).parent().parent().remove();
                                });
                            } else {
                                swal("Error", response.message, "error");
                            }
                        });

                        request.fail(function( jqXHR, textStatus ) {
                            waitingDialog.hide();
                            swal("Error", textStatus, "error");
                        });
                    }
                );

            }

        });

    });
</script>
</body>
</html>