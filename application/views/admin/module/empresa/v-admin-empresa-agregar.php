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
                                                            <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese el nombre.">
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
                                                    <input type="text" class="form-control" id="txtEmail" name="txtEmail" maxlength="40" data-parsley-required data-parsley-type="email" data-parsley-required-message="Ingrese el email." data-parsley-email-message="Ingrese un email valido.">
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
                                                                    <button id="btnGenerarPassword" type="button" class="btn btn-primary" title="Generar Contraseña"><i class="fa fa-pencil"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtRepeatPassword">Repeat Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="txtRepeatPassword" name="txtLastName" maxlength="40" data-parsley-required data-parsley-equalto="#txtPassword" data-parsley-required-message="Vuelva a ingresar la contraseña." data-parsley-equalto-message="Las contraseñas no coinciden.">
                                                                <!-- btn-group -->
                                                                <div class="input-group-btn">
                                                                    <button id="btnVerPassword" type="button" class="btn btn-primary" title="Ver Contraseña"><i class="fa fa-eye"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtOrganization">Organization</label>
                                                    <input type="text" class="form-control" id="txtOrganization" name="txtOrganization" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese nombre de la organización.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cboTipoEmpresa">Business Type</label>
                                                    <select id="cboTipoEmpresa"  name="cboTipoEmpresa"  class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione el tipo de empresa.">
                                                        <option value="" selected="selected">Seleccione</option>
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
                                                    <input type="text" class="form-control" id="txtHomePhone" name="txtHomePhone" maxlength="40">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtWorkPhone">Work Phone</label>
                                                    <input type="text" class="form-control" id="txtWorkPhone" name="txtWorkPhone" maxlength="40">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtFax">Fax</label>
                                                    <input type="text" class="form-control" id="txtFax" name="txtFax" maxlength="40">
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="cboCountry">Country</label>
                                                    <select id="cboCountry" name="cboCountry" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un pais.">
                                                        <option value="" selected="selected">Seleccione</option>
                                                        <?php foreach($modulo->data_geo_countries as $geo_country): ?>
                                                            <option value="<?php echo $geo_country->code; ?>"><?php echo $geo_country->name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cboRegion">State</label>
                                                    <select id="cboRegion" name="cboRegion" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un estado.">
                                                        <option value="" selected="selected">Seleccione</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cboCity">City</label>
                                                    <select id="cboCity" name="cboCity" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione una ciudad.">
                                                        <option value="" selected="selected">Seleccione</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtAddress">Address</label>
                                                    <input type="text" class="form-control" id="txtAddress" name="txtAddress" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese una direccion.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtAddress2">Address 2</label>
                                                    <input type="text" class="form-control" id="txtAddress2" name="txtAddress2" maxlength="40">
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
                                                <div class="form-group">
                                                    <label for="logoEmpresa">Añadir Logo Institucional</label>
                                                    <input type="file" class="form-control" id="logoEmpresa" name="logoEmpresa">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cboPaqueteTmo">Paquete TMO</label>
                                                    <select id="cboPaqueteTmo"  name="cboPaqueteTmo"  class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un paquete.">
                                                        <option value="" selected="selected">Seleccione</option>
                                                        <?php foreach($modulo->paquetes_tmo as $paquete): ?>
                                                            <option value="<?php echo $paquete->id_paquetes_tmo; ?>"><?php echo $paquete->nombre_paquete; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
<!-- Parsley -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
<!-- Validate Input Form With Parsley -->
<script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/ValidateInputFormWithParsley.js"></script>
<script>
    $(function () {

        //Initialize Select2 Elements
        $("#cboTipoEmpresa, #cboPaqueteTmo").select2();

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

        var selectorInputsForm = ["#txtFirstName", "#txtLastName", "#txtEmail", "#txtPassword", "#txtRepeatPassword", "#txtOrganization", "#cboTipoEmpresa",
            "#txtMobilePhone", "#txtHomePhone", "#txtWorkPhone", "#txtFax", "#cboCountry", "#cboRegion", "#cboCity", "#txtAddress", "#txtAddress2", "#cboPaqueteTmo"];

        var baseUrl   = "<?php echo base_url(); ?>";
        var urlApi    = baseUrl + <?php if (isset($idEmpresa)) { echo '"editar";'; } else { echo '"crear";'; } ?>

        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

            var element = this;

            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {

                waitingDialog.show('Cargando...');

                formData.append("txtFirstName",     $("#txtFirstName").val());
                formData.append("txtLastName",      $("#txtLastName").val());
                formData.append("txtEmail",         $("#txtEmail").val());
                formData.append("txtPassword",      $("#txtPassword").val());
                formData.append("txtRepeatPassword",$("#txtRepeatPassword").val());
                formData.append("txtOrganization",  $("#txtOrganization").val());
                formData.append("cboTipoEmpresa",   $("#cboTipoEmpresa").val());
                formData.append("txtMobilePhone",   $("#txtMobilePhone").val());
                formData.append("txtHomePhone",     $("#txtHomePhone").val());
                formData.append("txtWorkPhone",     $("#txtWorkPhone").val());
                formData.append("txtFax",           $("#txtFax").val());
                formData.append("cboCountry",       $("#cboCountry").val());
                formData.append("cboRegion",        $("#cboRegion").val());
                formData.append("cboCity",          $("#cboCity").val());
                formData.append("txtAddress",       $("#txtAddress").val());
                formData.append("txtAddress2",      $("#txtAddress2").val());
                formData.append("cboPaqueteTmo",    $("#cboPaqueteTmo").val());

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
                            $("#txtFirstName").val("");
                            $("#txtLastName").val("");
                            $("#txtEmail").val("");
                            $("#txtPassword").val("");
                            $("#txtRepeatPassword").val("");
                            $("#txtOrganization").val("");
                            $("#cboTipoEmpresa").val("");
                            $("#txtMobilePhone").val("");
                            $("#txtHomePhone").val("");
                            $("#txtWorkPhone").val("");
                            $("#txtFax").val("");
                            $("#cboCountry").val("");
                            $("#cboRegion").val("");
                            $("#cboCity").val("");
                            $("#txtAddress").val("");
                            $("#txtAddress2").val("");
                            $("#cboPaqueteTmo").val();
                        }

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

        $("#cboCountry").select2()
            .on("change", function(event) {
                $("#cboRegion").empty();
                $("#cboRegion").append("<option value='' selected='selected'>Cargando...</option>");
                $("#cboRegion").trigger("change");
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
                        var html = "<option value='' selected='selected'>Seleccione</option>";
                        for (var c = 0; c < response.data.length; c++ ) {
                            html += "<option value='" + response.data[c].code + "'>" + response.data[c].name + "</option>";
                        }
                        $("#cboRegion").empty();
                        $("#cboRegion").append(html);
                    }
                });

                request.fail(function( jqXHR, textStatus ) {
                    formData = new FormData();
                    waitingDialog.hide();
                    GenericModal.show("danger", "<p>Lo sentimos ocurrio un error al momento de cargar los estados.</p>");
                });
            });

        $("#cboRegion").select2()
            .on("change", function(event) {
                $("#cboCity").empty();
                $("#cboCity").append("<option value='' selected='selected'>Cargando...</option>");
                $("#cboCity").trigger("change");
                formData.append("code_country", $("#cboCountry").val());
                formData.append("code_region", $(this).val());
                var request = $.ajax({
                    url: baseUrl + "api-rest/geo-data/getCitiesByRegionAndCountry",
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false
                });

                request.done(function( response ) {
                    formData = new FormData();
                    if (response.status) {
                        var html = "<option value='' selected='selected'>Seleccione</option>";
                        for (var c = 0; c < response.data.length; c++ ) {
                            html += "<option value='" + response.data[c].ID + "'>" + response.data[c].name + "</option>";
                        }
                        $("#cboCity").empty();
                        $("#cboCity").append(html);
                    }
                });

                request.fail(function( jqXHR, textStatus ) {
                    formData = new FormData();
                    waitingDialog.hide();
                    GenericModal.show("danger", "<p>Lo sentimos ocurrio un error al momento de cargar las ciudades.</p>");
                });
            });

        $("#cboCity").select2()
            .on("change", function(event) {

            });

        $("#btnVerPassword").on("click", function(evt) {
            evt.preventDefault();
            if ($("#txtPassword").attr("type") == "password") {
                $("#txtPassword").attr("type", "text");
                $("#txtRepeatPassword").attr("type", "text");
                $(this).children().removeClass("fa-eye");
                $(this).children().addClass("fa-eye-slash");
                $(this).attr("title", "Ocultar Contraseña");
            } else {
                $("#txtPassword").attr("type", "password");
                $("#txtRepeatPassword").attr("type", "password");
                $(this).children().removeClass("fa-eye-slash");
                $(this).children().addClass("fa-eye");
                $(this).attr("title", "Ver Contrseña");
            }
        });

        $("#logo_empresa").on("change", handleFileSelect);

        $("#btnGenerarPassword").on("click", function(){
            waitingDialog.show('Generando Contraseña...');

            var request = $.ajax({
                url: baseUrl + "admin/empresa/ajax/generatePassword",
                method: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false
            });

            request.done(function( response ) {
                waitingDialog.hide();
                $("#txtPassword").val(response.data.password);
                $("#txtRepeatPassword").val(response.data.password);
                GenericModal.show("default", "<p>" + response.message + "</p>");
            });

            request.fail(function( jqXHR, textStatus ) {
                waitingDialog.hide();
                GenericModal.show("danger", "<p>" + textStatus + "</p>");
            });
        });

    });

</script>
</body>
</html>