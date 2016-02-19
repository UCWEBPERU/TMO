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
                <li class="active"><a href="<?php echo base_url(); ?>admin/empresa">Empresa</a> </li>
                <li><?php echo strtolower($modulo->nombreSeccion); ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $modulo->nombreSeccion; ?> Empresa</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-group">
                                <!-- Panel Empresa-->
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a class="">
                                                Datos de Empresa
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="box-body">
                                        <!-- form start -->
                                        <form id="formEmpresa" role="form"  enctype="multipart/form-data">
                                            <div class="col-md-4">

                                                <?php
                                                if ( isset($idEmpresa) ) { ?>
                                                    <input type="hidden" name="id_empresa" value="<?php echo $idEmpresa; ?>">
                                                <?php } ?>
                                                <?php
                                                if (isset($existeEmpresa) && !$existeEmpresa ) { ?>
                                                    <div class="alert alert-danger alert-dismissible">
                                                        <h4><i class="icon fa fa-ban"></i> No existe el cliente!</h4>
                                                        Lo sentimos el cliente que desea editar no existe.<br>
                                                        <strong>No intente modificar la direccion url :D</strong>
                                                    </div>
                                                <?php } ?>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre_empresa">First Names</label>
                                                            <?php
                                                            if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                            <?php } else { ?>
                                                                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre_empresa">Last Name</label>
                                                            <?php
                                                            if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                            <?php } else { ?>
                                                                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre_empresa">Organization</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_tipo_empresa">Business Type</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>

                                                        <select id="id_tipo_empresa"  name="id_tipo_empresa" value="<?php echo $dataEmpresa->id_tipo_empresa; ?>" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">

                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <?php if($dataEmpresa->id_tipo_empresa == $tipo->id_tipo_empresa ){?>
                                                                    <option selected="selected" value="<?php echo $tipo->id_tipo_empresa;?>"> <?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>

                                                        </select>
                                                    <?php } else { ?>
                                                        <select id="id_tipo_empresa"  name="id_tipo_empresa"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                            <option value="0" selected="selected">Seleccione un Tipo de Empresa</option>
                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>
                                                <div>inside</div>
                                                <div class="form-group">
                                                    <label for="nombre_empresa">Email</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                    <?php } ?>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="nombre_empresa">Mobile Phone</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre_empresa">Home Phone</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre_empresa">Work Phone</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre_empresa">Fax Phone</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                    <?php } ?>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="id_tipo_empresa">Country</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>

                                                        <select id="id_tipo_empresa"  name="id_tipo_empresa" value="<?php echo $dataEmpresa->id_tipo_empresa; ?>" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">

                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <?php if($dataEmpresa->id_tipo_empresa == $tipo->id_tipo_empresa ){?>
                                                                    <option selected="selected" value="<?php echo $tipo->id_tipo_empresa;?>"> <?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>

                                                        </select>
                                                    <?php } else { ?>
                                                        <select id="id_tipo_empresa"  name="id_tipo_empresa"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                            <option value="0" selected="selected">Seleccione un Tipo de Empresa</option>
                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_tipo_empresa">State</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>

                                                        <select id="id_tipo_empresa"  name="id_tipo_empresa" value="<?php echo $dataEmpresa->id_tipo_empresa; ?>" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">

                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <?php if($dataEmpresa->id_tipo_empresa == $tipo->id_tipo_empresa ){?>
                                                                    <option selected="selected" value="<?php echo $tipo->id_tipo_empresa;?>"> <?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>

                                                        </select>
                                                    <?php } else { ?>
                                                        <select id="id_tipo_empresa"  name="id_tipo_empresa"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                            <option value="0" selected="selected">Seleccione un Tipo de Empresa</option>
                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_tipo_empresa">City</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>

                                                        <select id="id_tipo_empresa"  name="id_tipo_empresa" value="<?php echo $dataEmpresa->id_tipo_empresa; ?>" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">

                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <?php if($dataEmpresa->id_tipo_empresa == $tipo->id_tipo_empresa ){?>
                                                                    <option selected="selected" value="<?php echo $tipo->id_tipo_empresa;?>"> <?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>

                                                        </select>
                                                    <?php } else { ?>
                                                        <select id="id_tipo_empresa"  name="id_tipo_empresa"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                            <option value="0" selected="selected">Seleccione un Tipo de Empresa</option>
                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre_empresa">Address</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre_empresa">Address 2</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                                    <?php } ?>
                                                </div>



                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="box-group">
                                <!-- Panel Empresa-->
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a class="">
                                                Logo Institucional
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="box-body">

                                        <?php
                                        if ( isset($idArchivo) ) { ?>
                                            <input type="hidden" name="id_usuario" value="<?php echo $idArchivo; ?>">
                                        <?php } ?>
                                        <?php
                                        if (isset($existeArchivo) && !$existeArchivo ) { ?>
                                            <div class="alert alert-danger alert-dismissible">
                                                <h4><i class="icon fa fa-ban"></i> No existe el cliente!</h4>
                                                Lo sentimos el cliente que desea editar no existe.<br>
                                                <strong>No intente modificar la direccion url :D</strong>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label for="logo_empresa">Añadir Logo</label>
                                            <?php
                                            if (isset($existeArchivo) && $existeArchivo ) { ?>
                                                <input type="file" class="form-control" id="logo_empresa" name="logo_empresa" maxlength="" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                            <?php } else { ?>
                                                <input type="file" class="form-control" id="logo_empresa" name="logo_empresa">

                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button id="btnAgregar" type="submit" class="btn btn-primary"><?php echo $modulo->nombreSeccion; ?></button>
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

<script>
    $(function () {

        var formData  = new FormData();

        function handleFileSelect(evt) {
            var files = evt.target.files; // FileList object

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

                // Only process image files.
                if (!f.type.match('image.*')) {
                    continue;
                }

                formData.append("logo_empresa", f);

                var reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {

                        // $("#imagenProducto").attr("src", e.target.result);

                    };
                })(f);

                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }
        }

        function mostrarErrorInputText(id) {
            if ( $(id).val().length == 0) {
                $(id).parent().addClass("has-error");
            } else {
                $(id).parent().removeClass("has-error");
            }
        }


        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

            var baseUrl   = "<?php echo $modulo->base_url; ?>";
            var urlApi    = baseUrl + <?php if (isset($idEmpresa)) { echo '"editar";'; } else { echo '"crear";'; } ?>

            var element = this;

            mostrarErrorInputText("#nombre_empresa");
            mostrarErrorInputText("#id_tipo_empresa");
            mostrarErrorInputText("#nombres_persona");
            mostrarErrorInputText("#apellido_persona");
            mostrarErrorInputText("#email_usuario");
            mostrarErrorInputText("#password_usuario");
            mostrarErrorInputText("#logo_empresa");

            GenericModal.config("#genericModal", "");

            if ( $("#nombre_empresa").val().length > 0 &&
                $("#id_tipo_empresa").val().length > 0 &&
                $("#nombres_persona").val().length > 0 &&
                $("#apellido_persona").val().length > 0 &&
                $("#email_usuario").val().length > 0 &&
                $("#password_usuario").val().length > 0 &&
                $("#logo_empresa").val().length > 0 ) {

                waitingDialog.show('Cargando...');

                formData.append("nombre_empresa",   $("#nombre_empresa").val());
                formData.append("id_tipo_empresa",  $("#id_tipo_empresa").val());
                formData.append("nombres_persona",  $("#nombres_persona").val());
                formData.append("apellido_persona", $("#apellido_persona").val());
                formData.append("email_usuario",    $("#email_usuario").val());
                formData.append("password_usuario", $("#password_usuario").val());
                formData.append("logo_empresa",     $("#logo_empresa").val());

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

                    formData = new FormData();

                    if (response.status) {

                        GenericModal.show("default", "<p>" + response.message + "</p>");
                        if (response.action == "insert") {
                            $("#nombre_empresa").val("");
                            $("#id_tipo_empresa").val("0");
                            $("#nombres_persona").val("");
                            $("#apellido_persona").val("");
                            $("#email_usuario").val("");
                            $("#password_usuario").val("");
                            $("#logo_empresa").val("");
                        }

                    } else {
                        GenericModal.show("danger", "<p>" + response.message + "</p>");
                    }

                });

                request.fail(function( jqXHR, textStatus ) {
                    waitingDialog.hide();
                    GenericModal.show("danger", "<p>" + textStatus + "</p>");
                });

            } else {
                GenericModal.show("danger", "<p>Ingrese los datos de la empresa correctamente.</p>");
            }

        });

        $("#logo_empresa").on("change", handleFileSelect);

    });

</script>
</body>
</html>