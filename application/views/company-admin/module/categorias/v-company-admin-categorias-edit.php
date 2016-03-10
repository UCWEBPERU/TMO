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
                Editar Categoria
                <small><a href="<?php echo $modulo->url_module_panel; ?>">Regresar</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo $modulo->url_module_panel; ?>"> Categorias</a></li>
                <li> Editar</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Categoria</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" id="frmDatosCategoria">
                            <div class="box-body">
                                <?php if (sizeof($modulo->data_categoria) == 0) { ?>
                                    <div class="callout callout-danger">
                                        <h4>No existe la categoria!</h4>
                                        <p>Lo sentimos la categoria que intenta editar no existe.</p>
                                    </div>
                                <?php } else { ?>
                                    <input type="hidden" class="form-control" name="id_categoria" value="<?php echo $modulo->data_categoria[0]->id_categoria; ?>">
                                <?php } ?>
                                <div class="form-group">
                                    <label for="txtNombreCategoria">Nombre Categoria</label>
                                    <?php if (sizeof($modulo->data_categoria) > 0) { ?>
                                        <input type="text" class="form-control" id="txtNombreCategoria" name="txtNombreCategoria" value="<?php echo $modulo->data_categoria[0]->nombre_categoria; ?>" data-parsley-required data-parsley-required-message="Ingrese el nombre de la categoria.">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="txtNombreCategoria" name="txtNombreCategoria" data-parsley-required data-parsley-required-message="Ingrese el nombre de la categoria.">
                                    <?php } ?>
                                </div><!-- /.form-group -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="button-effect-1" id="btnEditar" >Guardar</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Imagen Categoria</h3>
                        </div>
                        <div class="box-logo-store">
                            <div class="logo-store-inner" style="background-image:url(&quot;<?php echo $modulo->imagen_categoria; ?>&quot;);">
                                <div class="logo-store-hint">Cambiar Imagen Categoria</div>
                                <input type="file" id="imgCategory" name="imgCategory" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <?php $this->load->view('template/main-panel/footer'); ?>
</div><!-- ./wrapper -->
<?php $this->load->view('template/main-panel/modal-admin'); ?>
<?php $this->load->view('template/main-panel/scripts-footer'); ?>
<!-- Parsley -->
<!--<script src="http://parsleyjs.org/dist/parsley.min.js" type="text/javascript" ></script>-->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
<!-- Validate Input Form With Parsley -->
<script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/ValidateInputFormWithParsley.js"></script>
<script>

    GenericModal.config("#genericModal", "");

    $(function () {
        var selectorInputsForm  = ["#txtNombreCategoria"];
        var formData            = new FormData();

        $("#btnEditar").on("click", function(evt){
            evt.preventDefault();

            if (validateInputsForm(selectorInputsForm)) {
                waitingDialog.show('Guardando Categoria...');
                var request = $.ajax({
                    url: "<?php echo $modulo->url_module_panel."/ajax/editCategory"; ?>",
                    method: "POST",
                    data: $("#frmDatosCategoria").serialize(),
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

        var objHandleFile = new HandleFile("#imgCategory");
        objHandleFile.onSelect(
            function(file) {
                formData = new FormData();
                formData.append("imgCategory", file);
            },
            function(readResult) {
                swal({
                        title: "Imagen Categoria",
                        text: "¿Seguro que desea cambiar la imagen de la categoria?",
                        imageUrl: readResult,
                        showCancelButton: true,
                        confirmButtonColor: "#fc0836",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                    function() {
                        var request = $.ajax({
                            url: <?php echo $modulo->url_module_panel; ?> + "/ajax/updateImageCategory",
                            method: "POST",
                            data: formData,
                            dataType: "json",
                            processData: false,
                            contentType: false
                        });

                        request.done(function( response ) {
                            waitingDialog.hide();
                            if (response.status) {
                                swal("Actualizado!", response.message, "success");
                                $(".logo-store-inner").attr("style", "background-image: url('" + readResult + "');");
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
        );

    });

</script>
</body>
</html>