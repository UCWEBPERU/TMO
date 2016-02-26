<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
<body class="hold-transition skin-blue sidebar-mini fix-padding-scrollbar">
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
                <?php echo $modulo->titulo; ?>
                <small><a href="<?php echo $modulo->url_module_panel; ?>">Regresar</a></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo $modulo->url_module_panel; ?>">Store</a> </li>
                <li class="active">Agregar</li>
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
                            <h3 class="box-title">Agregar Store</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-group">
                                <!-- Panel Empresa-->
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a  class="">
                                                Datos de Store
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="box-body">
                                        <!-- form start -->
                                        <form id="formEmpresa" role="form"  enctype="multipart/form-data">
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="txtFirstName">Name Store</label>
                                                    <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" maxlength="150" data-parsley-required data-parsley-required-message="Ingrese el nombre.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtMobilePhone">Mobile Phone</label>
                                                    <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" data-parsley-required data-parsley-type="digits" data-parsley-required-message="Ingrese el numero de celular." data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtHomePhone">Home Phone</label>
                                                    <input type="text" class="form-control" id="txtHomePhone" name="txtHomePhone" maxlength="15" data-parsley-type="digits" data-parsley-type-message="El numero de casa debe ser solo numeros.">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtGPSLatitud">GPS - Latitud</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="txtGPSLatitud" name="txtPassword" maxlength="40" data-parsley-required data-parsley-required-message="Ingrese una contraseña.">
                                                                <!-- btn-group -->
                                                                <div class="input-group-btn">
                                                                    <!--                                                                    <button type="button" class="btn btn-success" title="Generar Contraseña"><i class="fa fa-ellipsis-h"></i></button>-->
                                                                    <button id="btnInputLatitud" type="button" class="btn btn-primary" title="Generar Contraseña"><i class="fa fa-map-marker"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtGPSLongitud">GPS - Longitud</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="txtGPSLongitud" name="txtLastName" maxlength="40" data-parsley-required data-parsley-equalto="#txtPassword" data-parsley-required-message="Vuelva a ingresar la contraseña." data-parsley-equalto-message="Las contraseñas no coinciden.">
                                                                <!-- btn-group -->
                                                                <div class="input-group-btn">
                                                                    <button id="btnInputLongitud" type="button" class="btn btn-primary" title="Ver Contraseña"><i class="fa fa-map-marker"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txtMobilePhone">ID Pay Account</label>
                                                    <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" data-parsley-required data-parsley-type="digits" data-parsley-required-message="Ingrese el numero de celular." data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtHomePhone">Type Pay Account</label>
                                                    <input type="text" class="form-control" id="txtHomePhone" name="txtHomePhone" maxlength="15" data-parsley-type="digits" data-parsley-type-message="El numero de casa debe ser solo numeros.">
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
                                                    <input type="text" class="form-control" id="txtAddress" name="txtAddress" maxlength="150" data-parsley-required data-parsley-required-message="Ingrese una direccion.">
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
                                                    <label for="fileLogoEmpresa">Añadir Logo Institucional</label>
                                                    <input type="file" class="form-control" id="fileLogoEmpresa" name="fileLogoEmpresa">
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
                            <button id="btnAgregar" type="submit" class="btn btn-primary">Agregar</button>
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
<!-- Handle File -->
<script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/HandleFile.js"></script>
<!--<script src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc_iF34MQNbX2_GkY_HQjHDiHTzXc3ado" async defer></script>
<!-- Location Picker -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>locationpicker/locationpicker.jquery.js"></script>
<script>
    $(function () {

        //Initialize Select2 Elements
        $("#cboTipoEmpresa, #cboPaqueteTmo").select2();

        var formData = new FormData();

        GenericModal.config("#genericModal", "");

        var selectorInputsForm = ["#txtFirstName", "#txtLastName", "#txtEmail", "#txtPassword", "#txtRepeatPassword", "#txtOrganization", "#cboTipoEmpresa",
            "#txtMobilePhone", "#txtHomePhone", "#txtWorkPhone", "#txtFax", "#cboCountry", "#cboRegion", "#cboCity", "#txtAddress", "#txtAddress2", "#cboPaqueteTmo"];

        var baseUrl = "<?php echo base_url(); ?>";
        var urlApi  = baseUrl + "admin/empresa/crear";

        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

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
                            $("#cboTipoEmpresa").val("").trigger("change");
                            $("#txtMobilePhone").val("");
                            $("#txtHomePhone").val("");
                            $("#txtWorkPhone").val("");
                            $("#txtFax").val("");
                            $("#cboCountry").val("").trigger("change");
                            $("#cboRegion").empty();
                            $("#cboRegion").append("<option value='' selected='selected'>Seleccione</option>");
                            $("#cboCity").empty();
                            $("#cboCity").append("<option value='' selected='selected'>Seleccione</option>");
                            $("#txtAddress").val("");
                            $("#txtAddress2").val("");
                            $("#cboPaqueteTmo").val("").trigger("change");
                            $("$fileLogoEmpresa").val("");
                        }
                    } else {
                        GenericModal.show("danger", "<p>" + response.message + "</p>");
                    }

                });

                request.fail(function( jqXHR, textStatus ) {
                    waitingDialog.hide();
                    formData = new FormData();
                    GenericModal.show("danger", "<p>" + textStatus + "</p>");
                });

            }

        });

        $("#cboCountry").select2()
            .on("change", function(event) {
                $("#cboRegion").empty();
                $("#cboRegion").append("<option value='' selected='selected'>Cargando...</option>");
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

        var objHandleFile = new HandleFile("#fileLogoEmpresa");
        objHandleFile.onSelect(
            function(file) {
                console.log("select image");
                console.log(file);
                formData.append("fileLogoEmpresa", file);
            },
            function(readResult) {}
        );

        $("#btnInputLatitud, #btnInputLongitud").on("click", function() {
            GenericModal.show("default", "<div id='somecomponent' style='min-width: 300px; max-width: 500px; min-height: 300px; max-height: 500px; margin: 0px auto;'></div>");
            setTimeout(function(){
                $('#somecomponent').locationpicker({
                    location: {latitude: 46.15242437752303, longitude: 2.7470703125},
                    radius: 0,
                    zoom: 12,
                    inputBinding: {
                        latitudeInput: $("#txtGPSLatitud"),
                        longitudeInput: $("#txtGPSLongitud"),
                        radiusInput: null,
                        locationNameInput: null
                    }
                });
            }, 1000);

        });

    });

</script>
</body>
</html>