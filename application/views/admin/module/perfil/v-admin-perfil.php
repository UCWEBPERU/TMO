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
                Mi Perfil
                <!--<small>Enlaces rapidos</small>-->
            </h1>
            <ol class="breadcrumb">
                <li ><a href="<?php echo base_url()."admin"; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Perfil</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Personales</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="frmPerfilUsuario" name="frmPerfilUsuario" role="form" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="txtFirstName">First Name</label>
                                    <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" maxlength="150" value="<?php echo $modulo->datos_usuario->nombres_persona; ?>" data-parsley-required data-parsley-required-message="Ingrese nombre."/>
                                </div>

                                <div class="form-group">
                                    <label for="txtLastName">Last Name</label>
                                    <input type="text" class="form-control" id="txtLastName" name="txtLastName" maxlength="150" value="<?php echo $modulo->datos_usuario->apellidos_persona; ?>" data-parsley-required data-parsley-required-message="Ingrese apellido.">
                                </div>

                                <div class="form-group">
                                    <label for="txtMobilePhone">Mobile Phone</label>
                                    <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" value="<?php echo $modulo->datos_usuario->celular_personal; ?>" data-parsley-required data-parsley-type="digits" data-parsley-required-message="Ingrese el numero de celular." data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                </div>

                                <div class="form-group">
                                    <label for="txtHomePhone">Home Phone</label>
                                    <input type="text" class="form-control" id="txtHomePhone" name="txtHomePhone" maxlength="15" value="<?php echo $modulo->datos_usuario->telefono; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de casa debe ser solo numeros.">
                                </div>

                                <div class="form-group">
                                    <label for="txtWorkPhone">Work Phone</label>
                                    <input type="text" class="form-control" id="txtWorkPhone" name="txtWorkPhone" maxlength="15" value="<?php echo $modulo->datos_usuario->celular_trabajo; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de trabajo debe ser solo numeros.">
                                </div>

                                <div class="form-group">
                                    <label for="cboCountry">Country</label>
                                    <select id="cboCountry" name="cboCountry" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un pais.">
                                        <?php if (strlen($modulo->datos_usuario->pais_persona) > 0) { ?>
                                                <option value="">Seleccione</option>
                                                <?php foreach($modulo->data_geo_countries as $geo_country): ?>
                                                    <?php if ($geo_country->code == $modulo->datos_usuario->pais_persona) { ?>
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
                                        <?php if (strlen($modulo->datos_usuario->region_persona) > 0) { ?>
                                            <option value="">Seleccione</option>
                                            <?php foreach($modulo->data_geo_regions as $geo_region): ?>
                                                <?php if ($geo_region->code == $modulo->datos_usuario->region_persona) { ?>
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
                                        <?php if (strlen($modulo->datos_usuario->ciudad_persona) > 0) { ?>
                                            <option value="">Seleccione</option>
                                            <?php foreach($modulo->data_geo_cities as $geo_ciudad): ?>
                                                <?php if ($geo_ciudad->ID == $modulo->datos_usuario->ciudad_persona) { ?>
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

                                <div class="form-group">
                                    <label for="txtAdrress">Address</label>
                                    <input type="text" class="form-control" id="txtAdrress" name="txtAdrress" maxlength="150" value="<?php echo $modulo->datos_usuario->direccion_persona; ?>" data-parsley-required data-parsley-required-message="Ingrese su direccion."/>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button id="btnGuardarPerfil" type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box  -->

                </div>

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cuenta de Usuario</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="frmDatosUsuario" name="frmDatosUsuario" role="form" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="txtEmailUsuario">Email Account</label>
                                    <input type="email" class="form-control" id="txtEmailUsuario" name="emailUsuario" value="<?php echo $modulo->datos_usuario->email_usuario; ?>" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="txtPassword">Password</label>
                                    <input type="password" class="form-control" id="txtPassword" name="passwordUsuario" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese la nueva contraseña."/>
                                </div>
                                <div class="form-group">
                                    <label for="txtPasswordRepeat">Repeat Password</label>
                                    <input type="password" class="form-control" id="txtPasswordRepeat" name="repeatPasswordUsuario" data-parsley-required data-parsley-type="alphanum" data-parsley-equalto="#txtPassword" data-parsley-required-message="Confirme su contraseña." data-parsley-equalto-message="Las contraseñas no coinciden."/>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button id="btnGuardarUsuario" type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box  -->

                </div>

            </div><!-- /.row -->

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

    <?php $this->load->view('template/main-panel/footer'); ?>

</div><!-- ./wrapper -->
<?php $this->load->view('template/main-panel/modal-admin'); ?>

<?php $this->load->view('template/main-panel/scripts-footer'); ?>
<!-- Parsley -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
<!-- Validate Input Form With Parsley -->
<script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/ValidateInputFormWithParsley.js"></script>
<script>

    GenericModal.config("#genericModal", "");

    $(function () {
        var formData  = new FormData();
        var baseUrl = "<?php echo base_url(); ?>";
        var selectorInputsFormPerfilUsuario = ["#txtFirstName", "#txtLastName", "#txtMobilePhone", "#txtHomePhone", "#txtWorkPhone", "#cboCountry", "#cboRegion", "#cboCity", "#txtAdrress"];
        var selectorInputsFormDatosUsuario = ["#txtPassword", "#txtPasswordRepeat"];

        $("#btnGuardarPerfil").on("click", function(evt){
            evt.preventDefault();

            if ( ValidateInputFormWithParsley.validate(selectorInputsFormPerfilUsuario)) {
                waitingDialog.show('Actualizando Datos Personales...');
                var request = $.ajax({
                    url: "<?php echo base_url().'admin/perfil/actualizar-perfil-usuario'; ?>",
                    method: "POST",
                    data: $("#frmPerfilUsuario").serialize(),
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
                    GenericModal.show("danger", "<p>" + response.message + "</p>");
                });
            }
        });

        $("#btnGuardarUsuario").on("click", function(evt){
            evt.preventDefault();

            if ( ValidateInputFormWithParsley.validate(selectorInputsFormDatosUsuario)) {
                waitingDialog.show('Actualizando Datos de Usuario...');
                var request = $.ajax({
                    url: "<?php echo base_url().'admin/perfil/actualizar-cuenta-usuario'; ?>",
                    method: "POST",
                    data: $("#frmDatosUsuario").serialize(),
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
                    GenericModal.show("danger", "<p>" + response.message + "</p>");
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

    });

</script>
</body>
</html>