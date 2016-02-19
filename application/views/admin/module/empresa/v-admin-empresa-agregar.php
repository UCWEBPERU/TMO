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
                                            <a  class="">
                                            Datos de Empresa
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="box-body">
                                        <!-- form start -->
                                        <form id="formEmpresa" role="form"  enctype="multipart/form-data">
                                            <div class="col-md-4">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtFirstName">First Names</label>
                                                            <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese el nombre..">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtLastName">Last Name</label>
                                                            <input type="text" class="form-control" id="txtLastName" name="txtLastName" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese el apellido.">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtEmail">Email</label>
                                                    <input type="text" class="form-control" id="txtEmail" name="txtEmail" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese el email.">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtPassword">Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="txtPassword" name="txtPassword" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese una contraseña.">
                                                                <!-- btn-group -->
                                                                <div class="input-group-btn">
<!--                                                                    <button type="button" class="btn btn-success" title="Generar Contraseña"><i class="fa fa-ellipsis-h"></i></button>-->
                                                                    <button id="btnGenerarPassword" type="button" class="btn btn-success" title="Generar Contraseña"><i class="fa fa-pencil"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtRepeatPassword">Repeat Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="txtRepeatPassword" name="txtLastName" maxlength="40" data-parsley-required data-parsley-required-message="Vuelva a ingresar la contraseña.">
                                                                <!-- btn-group -->
                                                                <div class="input-group-btn">
                                                                    <button id="btnVerPassword" type="button" class="btn btn-success" title="Ver Contraseña"><i class="fa fa-eye"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtOrganiaztion">Organization</label>
                                                    <input type="text" class="form-control" id="txtOrganiaztion" name="txtOrganiaztion" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese nombre de la organización.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_tipo_empresa">Business Type</label>
                                                    <select id="id_tipo_empresa"  name="id_tipo_empresa"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione el tipo de empresa.">
                                                        <option value="0" selected="selected">Seleccione</option>
                                                        <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                            <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="txtMobilePhone">Mobile Phone</label>
                                                    <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese el numero de celular.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtHomePhone">Home Phone</label>
                                                    <input type="text" class="form-control" id="txtHomePhone" name="txtHomePhone" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese el telefono de casa.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtWorkPhone">Work Phone</label>
                                                    <input type="text" class="form-control" id="txtWorkPhone" name="txtWorkPhone" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese nombre de la organización.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtFax">Fax</label>
                                                    <input type="text" class="form-control" id="txtFax" name="txtFax" maxlength="40">
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="idCountry">Country</label>
                                                    <select id="idCountry" name="idCountry" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un pais.">
                                                        <option value="0" selected="selected">Seleccione</option>
                                                        <?php foreach($modulo->data_geo_countries as $geo_country): ?>
                                                            <option value="<?php echo $geo_country->code; ?>"><?php echo $geo_country->name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="idRegion">State</label>
                                                    <select id="idRegion" name="idRegion" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un estado.">
                                                        <option value="0" selected="selected">Seleccione</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="idCity">City</label>
                                                    <select id="idCity" name="idCity" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione una ciudad.">
                                                        <option value="0" selected="selected">Seleccione</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtAddress">Address</label>
                                                    <input type="text" class="form-control" id="txtAddress" name="txtAddress" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese una direccion.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtAddress2">Address 2</label>
                                                    <input type="text" class="form-control" id="txtAddress2" name="txtAddress2" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese una direccion alterna.">
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
                                                Datos Extra
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
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
                                                    <label for="logo_empresa">Añadir Logo Institucional</label>
                                                    <?php
                                                    if (isset($existeArchivo) && $existeArchivo ) { ?>
                                                        <input type="file" class="form-control" id="logo_empresa" name="logo_empresa" maxlength="" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                                    <?php } else { ?>
                                                        <input type="file" class="form-control" id="logo_empresa" name="logo_empresa">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="idPaqueteTMO">Paquete TMO</label>
                                                    <?php
                                                    if (isset($existeEmpresa) && $existeEmpresa ) { ?>

                                                        <select id="idPaqueteTMO"  name="idPaqueteTMO" value="<?php echo $dataEmpresa->id_tipo_empresa; ?>" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">

                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <?php if($dataEmpresa->id_tipo_empresa == $tipo->id_tipo_empresa ){?>
                                                                    <option selected="selected" value="<?php echo $tipo->id_tipo_empresa;?>"> <?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>

                                                        </select>
                                                    <?php } else { ?>
                                                        <select id="idPaqueteTMO"  name="idPaqueteTMO"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                            <option value="0" selected="selected">Seleccione</option>
                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>
                                            </div>
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
<!-- Validate Input Form With Parsley -->
<script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/ValidateInputFormWithParsley.js"></script>
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

        GenericModal.config("#genericModal", "");

        var selectorInputsForm = ["#txtNombreCategoria"];

        var baseUrl   = "<?php echo base_url(); ?>";
        var urlApi    = baseUrl + <?php if (isset($idEmpresa)) { echo '"editar";'; } else { echo '"crear";'; } ?>

        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

            var element = this;

            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {

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

        $("#idCountry").on("change", function() {
            formData.append("code_country", $(this).val());
            var request = $.ajax({
                url: baseUrl + "api-rest/geo-data/getRegionsByCountry",
                method: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false
            });

            request.done(function( response ) {
                formData = new FormData();
                if (response.status) {
                    $("#idRegion").empty();
                    var html = "";
                    for (var c = 0; c < response.data.length; c++ ) {
                        html += "<option value='" + response.data[c].ID + "' selected='selected'>" + response.data[c].name + "</option>";
                    }
                    $("#idRegion").append(html);
                }
            });

            request.fail(function( jqXHR, textStatus ) {
                formData = new FormData();
                waitingDialog.hide();
//                GenericModal.show("danger", "<p>" + textStatus + "</p>");
                GenericModal.show("danger", "<p>Lo sentimos ocurrio un error al momento de cargar los estados.</p>");
            });

        });

        $("#logo_empresa").on("change", handleFileSelect);

    });

</script>
</body>
</html>