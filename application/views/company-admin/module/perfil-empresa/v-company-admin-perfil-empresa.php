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
                Empresa
            </h1>
            <ol class="breadcrumb">
                <li ><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Empresa</li>
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
                            <h3 class="box-title">Perfil</h3>
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

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtFirstName">First Names</label>
                                                            <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" maxlength="150" value="<?php echo $modulo->datos_empresa->nombres_representante; ?>" data-parsley-required data-parsley-required-message="Ingrese el nombre.">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtLastName">Last Name</label>
                                                            <input type="text" class="form-control" id="txtLastName" name="txtLastName" maxlength="150" value="<?php echo $modulo->datos_empresa->apellidos_representante; ?>" data-parsley-required data-parsley-required-message="Ingrese el apellido.">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtEmail">Email</label>
                                                    <input type="text" class="form-control" id="txtEmail" name="txtEmail" maxlength="150" value="<?php echo $modulo->datos_empresa->email_representante; ?>" data-parsley-required data-parsley-type="email" data-parsley-required-message="Ingrese el email." data-parsley-type-message="Ingrese un email valido.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtOrganization">Organization</label>
                                                    <input type="text" class="form-control" id="txtOrganization" name="txtOrganization" maxlength="40" value="<?php echo $modulo->datos_empresa->organization; ?>" data-parsley-required data-parsley-required-message="Ingrese nombre de la organización.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cboTipoEmpresa">Business Type</label>
                                                    <select id="cboTipoEmpresa" name="cboTipoEmpresa" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione el tipo de empresa.">
                                                        <?php if ($modulo->datos_empresa->id_tipo_empresa != 0) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <?php if ($tipo->id_tipo_empresa == $modulo->datos_empresa->id_tipo_empresa) { ?>
                                                                    <option value="<?php echo $tipo->id_tipo_empresa; ?>" selected="selected"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>
                                                        <?php } else { ?>
                                                            <option value="" selected="selected">Seleccione</option>
                                                            <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                                                <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cboPaqueteTmo">Paquete TMO</label>
                                                    <select id="cboPaqueteTmo" name="cboPaqueteTmo" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled>
                                                        <?php if ($modulo->suscripcion_paquete_tmo->id_paquetes_tmo != 0) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->paquetes_tmo as $paquete): ?>
                                                                <?php if ($paquete->id_paquetes_tmo == $modulo->suscripcion_paquete_tmo->id_paquetes_tmo) { ?>
                                                                    <option value="<?php echo $paquete->id_paquetes_tmo; ?>" selected="selected"><?php echo $paquete->nombre_paquete; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $paquete->id_paquetes_tmo; ?>"><?php echo $paquete->nombre_paquete; ?></option>
                                                                <?php } ?>
                                                            <?php endforeach; ?>
                                                        <?php } else { ?>
                                                            <option value="" selected="selected">Seleccione</option>
                                                            <?php foreach($modulo->paquetes_tmo as $paquete): ?>
                                                                <option value="<?php echo $paquete->id_paquetes_tmo; ?>"><?php echo $paquete->nombre_paquete; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="txtMobilePhone">Mobile Phone</label>
                                                    <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" value="<?php echo $modulo->datos_empresa->celular_personal; ?>" data-parsley-required data-parsley-type="digits" data-parsley-required-message="Ingrese el numero de celular." data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtHomePhone">Home Phone</label>
                                                    <input type="text" class="form-control" id="txtHomePhone" name="txtHomePhone" maxlength="15" value="<?php echo $modulo->datos_empresa->telefono; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de casa debe ser solo numeros.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtWorkPhone">Work Phone</label>
                                                    <input type="text" class="form-control" id="txtWorkPhone" name="txtWorkPhone" maxlength="15" value="<?php echo $modulo->datos_empresa->celular_trabajo; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de trabajo debe ser solo numeros.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtFax">Fax</label>
                                                    <input type="text" class="form-control" id="txtFax" name="txtFax" maxlength="15" value="<?php echo $modulo->datos_empresa->fax; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de fax debe ser solo numeros.">
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="cboCountry">Country</label>
                                                    <select id="cboCountry" name="cboCountry" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un pais.">
                                                        <?php if (strlen($modulo->datos_empresa->pais) > 0) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_countries as $geo_country): ?>
                                                                <?php if ($geo_country->code == $modulo->datos_empresa->pais) { ?>
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
                                                        <?php if (strlen($modulo->datos_empresa->region) > 0) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_regions as $geo_region): ?>
                                                                <?php if ($geo_region->code == $modulo->datos_empresa->region) { ?>
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
                                                        <?php if (strlen($modulo->datos_empresa->ciudad) > 0) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_cities as $geo_ciudad): ?>
                                                                <?php if ($geo_ciudad->ID == $modulo->datos_empresa->ciudad) { ?>
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
                                                    <label for="txtAddress">Address</label>
                                                    <input type="text" class="form-control" id="txtAddress" name="txtAddress" maxlength="150" value="<?php echo $modulo->datos_empresa->direccion; ?>" data-parsley-required data-parsley-required-message="Ingrese una direccion.">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtAddress2">Address 2</label>
                                                    <input type="text" class="form-control" id="txtAddress2" name="txtAddress2" maxlength="150" value="<?php echo $modulo->datos_empresa->direccion_2; ?>">
                                                </div>

                                            </div>

                                        </form>

                                    </div>
                                    <div class="box-footer">
                                        <button id="btnAgregar" type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>

<!--                            <div class="box-group">-->
<!--                                 Panel Empresa -->
<!--                                <div class="panel box box-primary">-->
<!--                                    <div class="box-header with-border">-->
<!--                                        <h4 class="box-title">-->
<!--                                            <a class="">-->
<!--                                                Datos Extra-->
<!--                                            </a>-->
<!--                                        </h4>-->
<!--                                    </div>-->
<!--                                    <div class="box-body">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-md-4">-->
<!--                                                <div class="box box-primary">-->
<!--                                                    <div class="box-header with-border">-->
<!--                                                        <h3 class="box-title">Logo Empresa</h3>-->
<!--                                                    </div>-->
<!--                                                    <div class="box-logo-store">-->
<!--                                                        <img id="logoStore" class="img-size-50" src="--><?php //echo $modulo->icono_empresa; ?><!--" alt="Logo Store" title="Logo Store">-->
<!--                                                        <div class="btn btn-default btn-file">-->
<!--                                                            <i class="fa fa-paperclip"></i> Upload new logo-->
<!--                                                            <input type="file" id="imgLogoStore" name="imgLogoStore" accept="image/*">-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="box-footer">-->
<!--                                                        <button id="btnActualizarLogoEmpresa" type="submit" class="btn btn-primary">Guardar</button>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Logo Empresa</h3>
                                        </div>
                                        <div class="box-logo-store">
                                            <div class="logo-store-inner" style="background-image:url(&quot;<?php echo $modulo->icono_empresa; ?>&quot;);">
                                                <div class="logo-store-hint">Cambiar Avatar</div>
                                                <input type="file" id="imgLogoStore" name="imgLogoStore">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

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
<!-- Sweet Alert -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.min.js"></script>
<script>
    $(function () {

        $("#cboTipoEmpresa, #cboPaqueteTmo").select2();
        var formData = new FormData();
        GenericModal.config("#genericModal", "");

        var selectorInputsForm = ["#txtFirstName", "#txtLastName", "#txtEmail", "#txtOrganization", "#cboTipoEmpresa", "#cboPaqueteTmo", "#txtMobilePhone", "#txtHomePhone", "#txtWorkPhone", "#txtFax", "#cboCountry", "#cboRegion", "#cboCity", "#txtAddress", "#txtAddress2"];

        var baseUrl         = "<?php echo base_url(); ?>";
        var modulePanelUrl  = "<?php echo $modulo->url_module_panel; ?>";

//        $("#btnAgregar").on("click", function(evt){
//            evt.preventDefault();
//
//            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {
//
//                waitingDialog.show('Cargando...');
//
//                formData.append("txtFirstName",     $("#txtFirstName").val());
//                formData.append("txtLastName",      $("#txtLastName").val());
//                formData.append("txtEmail",         $("#txtEmail").val());
//                formData.append("txtOrganization",  $("#txtOrganization").val());
//                formData.append("cboTipoEmpresa",   $("#cboTipoEmpresa").val());
//                formData.append("cboPaqueteTmo",    $("#cboPaqueteTmo").val());
//                formData.append("txtMobilePhone",   $("#txtMobilePhone").val());
//                formData.append("txtHomePhone",     $("#txtHomePhone").val());
//                formData.append("txtWorkPhone",     $("#txtWorkPhone").val());
//                formData.append("txtFax",           $("#txtFax").val());
//                formData.append("cboCountry",       $("#cboCountry").val());
//                formData.append("cboRegion",        $("#cboRegion").val());
//                formData.append("cboCity",          $("#cboCity").val());
//                formData.append("txtAddress",       $("#txtAddress").val());
//                formData.append("txtAddress2",      $("#txtAddress2").val());
//
//                var request = $.ajax({
//                    url: modulePanelUrl + "/ajax/updateDataCompany";
//                    method: "POST",
//                    data: formData,
//                    dataType: "json",
//                    processData: false,
//                    contentType: false
//                });
//
//                request.done(function( response ) {
//
//                    waitingDialog.hide();
//
//                    formData = new FormData();
//
//                    if (response.status) {
//                        GenericModal.show("default", "<p>" + response.message + "</p>");
//                    } else {
//                        GenericModal.show("danger", "<p>" + response.message + "</p>");
//                    }
//
//                });
//
//                request.fail(function( jqXHR, textStatus ) {
//                    waitingDialog.hide();
//                    formData = new FormData();
//                    GenericModal.show("danger", "<p>" + textStatus + "</p>");
//                });
//
//            }
//
//        });
//
//        $("#cboCountry").select2()
//            .on("change", function(event) {
//                $("#cboRegion").empty();
//                $("#cboRegion").append("<option value='' selected='selected'>Cargando...</option>");
//                formData.append("code_country", $(this).val());
//                var request = $.ajax({
//                    url: baseUrl + "api-rest/geo-data/getRegionsByCountry",
//                    method: "POST",
//                    data: formData,
//                    dataType: "json",
//                    processData: false,
//                    contentType: false
//                });
//
//                request.done(function( response ) {
//                    formData = new FormData();
//                    if (response.status) {
//                        var html = "<option value='' selected='selected'>Seleccione</option>";
//                        for (var c = 0; c < response.data.length; c++ ) {
//                            html += "<option value='" + response.data[c].code + "'>" + response.data[c].name + "</option>";
//                        }
//                        $("#cboRegion").empty();
//                        $("#cboRegion").append(html);
//                    }
//                });
//
//                request.fail(function( jqXHR, textStatus ) {
//                    formData = new FormData();
//                    waitingDialog.hide();
//                    GenericModal.show("danger", "<p>Lo sentimos ocurrio un error al momento de cargar los estados.</p>");
//                });
//            });
//
//        $("#cboRegion").select2()
//            .on("change", function(event) {
//                $("#cboCity").empty();
//                $("#cboCity").append("<option value='' selected='selected'>Cargando...</option>");
//                formData.append("code_country", $("#cboCountry").val());
//                formData.append("code_region", $(this).val());
//                var request = $.ajax({
//                    url: baseUrl + "api-rest/geo-data/getCitiesByRegionAndCountry",
//                    method: "POST",
//                    data: formData,
//                    dataType: "json",
//                    processData: false,
//                    contentType: false
//                });
//
//                request.done(function( response ) {
//                    formData = new FormData();
//                    if (response.status) {
//                        var html = "<option value='' selected='selected'>Seleccione</option>";
//                        for (var c = 0; c < response.data.length; c++ ) {
//                            html += "<option value='" + response.data[c].ID + "'>" + response.data[c].name + "</option>";
//                        }
//                        $("#cboCity").empty();
//                        $("#cboCity").append(html);
//                    }
//                });
//
//                request.fail(function( jqXHR, textStatus ) {
//                    formData = new FormData();
//                    waitingDialog.hide();
//                    GenericModal.show("danger", "<p>Lo sentimos ocurrio un error al momento de cargar las ciudades.</p>");
//                });
//            });
//
//        $("#cboCity").select2()
//            .on("change", function(event) {
//
//            });
//
//        $("#btnVerPassword").on("click", function(evt) {
//            evt.preventDefault();
//            if ($("#txtPassword").attr("type") == "password") {
//                $("#txtPassword").attr("type", "text");
//                $("#txtRepeatPassword").attr("type", "text");
//                $(this).children().removeClass("fa-eye");
//                $(this).children().addClass("fa-eye-slash");
//                $(this).attr("title", "Ocultar Contraseña");
//            } else {
//                $("#txtPassword").attr("type", "password");
//                $("#txtRepeatPassword").attr("type", "password");
//                $(this).children().removeClass("fa-eye-slash");
//                $(this).children().addClass("fa-eye");
//                $(this).attr("title", "Ver Contrseña");
//            }
//        });
//
//        $("#btnGenerarPassword").on("click", function(){
//            waitingDialog.show('Generando Contraseña...');
//
//            var request = $.ajax({
//                url: baseUrl + "admin/empresa/ajax/generatePassword",
//                method: "POST",
//                data: formData,
//                dataType: "json",
//                processData: false,
//                contentType: false
//            });
//
//            request.done(function( response ) {
//                waitingDialog.hide();
//                $("#txtPassword").val(response.data.password);
//                $("#txtRepeatPassword").val(response.data.password);
//                GenericModal.show("default", "<p>" + response.message + "</p>");
//            });
//
//            request.fail(function( jqXHR, textStatus ) {
//                waitingDialog.hide();
//                GenericModal.show("danger", "<p>" + textStatus + "</p>");
//            });
//        });
//
//        var objHandleFile = new HandleFile("#imgLogoStore");
//        objHandleFile.onSelect(
//            function(file) {
//                formData = new FormData();
//                formData.append("imgLogoStore", file);
//            },
//            function(readResult) {
//                swal({
//                        title: "Logo Empresa",
//                        text: "¿Seguro que desea cambiar el logo de la empresa?",
//                        imageUrl: readResult,
//                        showCancelButton: true,
//                        confirmButtonColor: "#fc0836",
//                        confirmButtonText: "Yes, delete it!",
//                        closeOnConfirm: false,
//                        showLoaderOnConfirm: true
//                    },
//                    function() {
//                        var request = $.ajax({
//                            url: modulePanelUrl + "/ajax/updateLogoEmpresa",
//                            method: "POST",
//                            data: formData,
//                            dataType: "json",
//                            processData: false,
//                            contentType: false
//                        });
//
//                        request.done(function( response ) {
//                            waitingDialog.hide();
//                            if (response.status) {
//                                swal("Actualizado!", response.message, "success");
//                                $(".logo-store-inner").attr("style", "background-image: url('" + readResult + "');");
//                                $(".user-menu img").attr("src", readResult);
//                                $("link[rel='shortcut icon'").attr("href", readResult);
//                            } else {
//                                swal("Error", response.message, "error");
//                            }
//                        });
//
//                        request.fail(function( jqXHR, textStatus ) {
//                            waitingDialog.hide();
//                            swal("Error", textStatus, "error");
//                        });
//                    }
//                );
//            }
//        );

    });

</script>
</body>
</html>