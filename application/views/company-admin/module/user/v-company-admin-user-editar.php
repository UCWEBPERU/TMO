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
                <li class="active">Editar</li>
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
                            <h3 class="box-title">Editar Usuario</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php if (!$existeUsuario) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <h4><i class="icon fa fa-ban"></i> No existe el usuario!</h4>
                                    Lo sentimos el usuario que desea editar no existe.<br>
                                    <strong>No intente modificar la direccion url :D</strong>
                                </div>
                            <?php } ?>
                            <div class="box-group">
                                <!-- Panel Empresa-->
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a  class="">
                                                Datos de Usuario
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="box-body">
                                        <!-- form start -->
                                        <form id="formUsuario" role="form"  enctype="multipart/form-data">
                                            <?php if ($existeUsuario) { ?>
                                                <input type="hidden" name="id_usuario" value="<?php echo $dataUsuario->id_usuario; ?>">
                                            <?php } ?>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtFirstName">First Names</label>
                                                            <?php if ($existeUsuario) { ?>
                                                                <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" maxlength="150" value="<?php echo $dataUsuario->nombres_persona; ?>" data-parsley-required data-parsley-required-message="Ingrese el nombre.">
                                                            <?php } else { ?>
                                                                <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" maxlength="150" data-parsley-required data-parsley-required-message="Ingrese el nombre.">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtLastName">Last Name</label>
                                                            <?php if ($existeUsuario) { ?>
                                                                <input type="text" class="form-control" id="txtLastName" name="txtLastName" maxlength="150" value="<?php echo $dataUsuario->apellidos_persona; ?>" data-parsley-required data-parsley-required-message="Ingrese el apellido.">
                                                            <?php } else { ?>
                                                                <input type="text" class="form-control" id="txtLastName" name="txtLastName" maxlength="150" data-parsley-required data-parsley-required-message="Ingrese el apellido.">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtEmail">Email</label>
                                                    <?php if ($existeUsuario) { ?>
                                                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" maxlength="150" disabled value="<?php echo $dataUsuario->email_usuario; ?>" data-parsley-required data-parsley-type="email" data-parsley-required-message="Ingrese el email." data-parsley-type-message="Ingrese un email valido.">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" maxlength="150" data-parsley-required data-parsley-type="email" data-parsley-required-message="Ingrese el email." data-parsley-type-message="Ingrese un email valido.">
                                                    <?php } ?>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtPassword">Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="txtPassword" name="txtPassword" maxlength="40" data-parsley-required-message="Ingrese una contraseña.">
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
                                                                <input type="password" class="form-control" id="txtRepeatPassword" name="txtRepeatPassword" maxlength="40" data-parsley-equalto="#txtPassword" data-parsley-required-message="Vuelva a ingresar la contraseña." data-parsley-equalto-message="Las contraseñas no coinciden.">
                                                                <!-- btn-group -->
                                                                <div class="input-group-btn">
                                                                    <button id="btnVerPassword" type="button" class="btn btn-primary" title="Ver Contraseña"><i class="fa fa-eye"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="txtMobilePhone">Mobile Phone</label>
                                                    <?php if ($existeUsuario) { ?>
                                                        <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" value="<?php echo $dataUsuario->celular_personal; ?>" data-parsley-required data-parsley-type="digits" data-parsley-required-message="Ingrese el numero de celular." data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" data-parsley-required data-parsley-type="digits" data-parsley-required-message="Ingrese el numero de celular." data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtHomePhone">Home Phone</label>
                                                    <?php if ($existeUsuario) { ?>
                                                        <input type="text" class="form-control" id="txtHomePhone" name="txtHomePhone" maxlength="15" value="<?php echo $dataUsuario->telefono; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de casa debe ser solo numeros.">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtHomePhone" name="txtHomePhone" maxlength="15" data-parsley-type="digits" data-parsley-type-message="El numero de casa debe ser solo numeros.">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtWorkPhone">Work Phone</label>
                                                    <?php if ($existeUsuario) { ?>
                                                        <input type="text" class="form-control" id="txtWorkPhone" name="txtWorkPhone" maxlength="15" value="<?php echo $dataUsuario->celular_trabajo; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de trabajo debe ser solo numeros.">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtWorkPhone" name="txtWorkPhone" maxlength="15" data-parsley-type="digits" data-parsley-type-message="El numero de trabajo debe ser solo numeros.">
                                                    <?php } ?>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="cboCountry">Country</label>
                                                    <select id="cboCountry" name="cboCountry" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un pais.">
                                                        <?php if (!empty($dataUsuario->pais_persona)) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_countries as $geo_country): ?>
                                                                <?php if ($geo_country->code == $dataUsuario->pais_persona) { ?>
                                                                    <option value="<?php echo $geo_country->code; ?>" selected="selected"><?php echo $geo_country->name; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $geo_country->code; ?>"><?php echo $geo_country->name; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>
                                                        <?php } else { ?>
                                                            <option value="" selected="selected">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_countries as $geo_country): ?>
                                                                <option value="<?php echo $geo_country->code; ?>"><?php echo $geo_country->name; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cboRegion">State</label>
                                                    <select id="cboRegion" name="cboRegion" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un estado.">
                                                        <?php if (!empty($dataUsuario->region_persona)) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_regions as $geo_region): ?>
                                                                <?php if ($geo_region->code == $dataUsuario->region_persona) { ?>
                                                                    <option value="<?php echo $geo_region->code; ?>" selected="selected"><?php echo $geo_region->name; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $geo_region->code; ?>"><?php echo $geo_region->name; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>
                                                        <?php } else { ?>
                                                            <option value="" selected="selected">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_regions as $geo_region): ?>
                                                                <option value="<?php echo $geo_region->code; ?>"><?php echo $geo_region->name; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cboCity">City</label>
                                                    <select id="cboCity" name="cboCity" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione una ciudad.">
                                                        <?php if (!empty($dataUsuario->ciudad_persona)) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_cities as $geo_ciudad): ?>
                                                                <?php if ($geo_ciudad->ID == $dataUsuario->ciudad_persona) { ?>
                                                                    <option value="<?php echo $geo_ciudad->ID; ?>" selected="selected"><?php echo $geo_ciudad->name; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $geo_ciudad->ID; ?>"><?php echo $geo_ciudad->name; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>
                                                        <?php } else { ?>
                                                            <option value="" selected="selected">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_cities as $geo_ciudad): ?>
                                                                <option value="<?php echo $geo_ciudad->ID; ?>"><?php echo $geo_ciudad->name; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <!--                                                <div class="form-group">-->
                                                <!--                                                    <label for="txtAddress">Address</label>-->
                                                <!--                                                    <input type="text" class="form-control" id="txtAddress" name="txtAddress" maxlength="150" data-parsley-required data-parsley-required-message="Ingrese una direccion.">-->
                                                <!--                                                </div>-->

                                            </div>

                                        </form>

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
<script>
    $(function () {

        //Initialize Select2 Elements
        $("#cboTipoEmpresa, #cboPaqueteTmo").select2();

        var formData = new FormData();

        GenericModal.config("#genericModal", "");

        var selectorInputsForm = ["#txtFirstName", "#txtLastName", "#txtEmail", "#txtPassword", "#txtRepeatPassword", "#txtMobilePhone", "#txtHomePhone", "#txtWorkPhone", "#cboCountry", "#cboRegion", "#cboCity"];
        var baseUrl         = "<?php echo base_url(); ?>";
        var modulePanelUrl  = "<?php echo $modulo->url_module_panel; ?>";

        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {

                waitingDialog.show('Cargando...');

                var request = $.ajax({
                    url: modulePanelUrl + "/ajax/editUser",
                    method: "POST",
                    data: $("#formUsuario").serialize(),
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

        $("#btnGenerarPassword").on("click", function(){
            waitingDialog.show('Generando Contraseña...');

            var request = $.ajax({
                url: modulePanelUrl + "/ajax/generatePassword",
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