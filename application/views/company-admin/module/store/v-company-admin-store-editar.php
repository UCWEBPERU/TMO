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
                            <h3 class="box-title">Editar Store</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php if (!$existeTienda) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <h4><i class="icon fa fa-ban"></i> No existe la tienda!</h4>
                                    Lo sentimos la tienda que desea editar no existe.<br>
                                    <strong>No intente modificar la direccion url :D</strong>
                                </div>
                            <?php } ?>
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
                                        <form id="formStore" role="form"  enctype="multipart/form-data">
                                            <?php if ($existeTienda) { ?>
                                                <input type="hidden" name="id_tienda" value="<?php echo $dataTienda->id_tienda; ?>">
                                            <?php } ?>
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="txtNameStore">Name Store</label>
                                                    <?php if ($existeTienda) { ?>
                                                        <input type="text" class="form-control" id="txtNameStore" name="txtNameStore" maxlength="150" value="<?php echo $dataTienda->nombre_tienda; ?>" data-parsley-required data-parsley-required-message="Ingrese el nombre de la tienda.">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtNameStore" name="txtNameStore" maxlength="150" data-parsley-required data-parsley-required-message="Ingrese el nombre de la tienda.">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtMobilePhone">Mobile Phone</label>
                                                    <?php if ($existeTienda) { ?>
                                                        <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" value="<?php echo $dataTienda->nro_celular; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" data-parsley-type="digits" data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtStorePhone">Store Phone</label>
                                                    <?php if ($existeTienda) { ?>
                                                        <input type="text" class="form-control" id="txtMobilePhone" name="txtMobilePhone" maxlength="15" value="<?php echo $dataTienda->nro_telefono; ?>" data-parsley-type="digits" data-parsley-type-message="El numero de celular debe ser solo numeros.">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtStorePhone" name="txtStorePhone" maxlength="15" data-parsley-type="digits" data-parsley-type-message="El numero de la tienda debe ser solo numeros.">
                                                    <?php } ?>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtGPSLatitud">GPS - Latitud</label>
                                                            <div class="input-group">
                                                                <?php if ($existeTienda) { ?>
                                                                    <input type="text" class="form-control" id="txtGPSLatitud" name="txtGPSLatitud" maxlength="40" value="<?php echo $dataTienda->gps_latitud; ?>">
                                                                <?php } else { ?>
                                                                    <input type="text" class="form-control" id="txtGPSLatitud" name="txtGPSLatitud" maxlength="40">
                                                                <?php } ?>
                                                                <!-- btn-group -->
                                                                <div class="input-group-btn">
                                                                    <button id="btnInputLatitud" type="button" class="btn btn-primary" title="Generar Coordenadas"><i class="fa fa-map-marker"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txtGPSLongitud">GPS - Longitud</label>
                                                            <div class="input-group">
                                                                <?php if ($existeTienda) { ?>
                                                                    <input type="text" class="form-control" id="txtGPSLongitud" name="txtGPSLongitud" maxlength="40" value="<?php echo $dataTienda->gps_longitud; ?>">
                                                                <?php } else { ?>
                                                                    <input type="text" class="form-control" id="txtGPSLongitud" name="txtGPSLongitud" maxlength="40">
                                                                <?php } ?>
                                                                <!-- btn-group -->
                                                                <div class="input-group-btn">
                                                                    <button id="btnInputLongitud" type="button" class="btn btn-primary" title="Generar Coordenadas"><i class="fa fa-map-marker"></i></button>
                                                                </div>
                                                                <!-- /btn-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txtIDPayAccount">ID Pay Account</label>
                                                    <?php if ($existeTienda) { ?>
                                                        <input type="text" class="form-control" id="txtIDPayAccount" name="txtIDPayAccount" maxlength="15" value="<?php echo $dataTienda->pay_id; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtIDPayAccount" name="txtIDPayAccount" maxlength="15">
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtTypePayAccount">Type Pay Account</label>
                                                    <?php if ($existeTienda) { ?>
                                                        <input type="text" class="form-control" id="txtTypePayAccount" name="txtTypePayAccount" maxlength="15" value="<?php echo $dataTienda->tipo_metodo_pago; ?>">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtTypePayAccount" name="txtTypePayAccount" maxlength="15">
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="cboCountry">Country</label>
                                                    <select id="cboCountry" name="cboCountry" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" data-parsley-required data-parsley-required-message="Seleccione un pais.">
                                                        <?php if (!empty($dataTienda->pais)) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_countries as $geo_country): ?>
                                                                <?php if ($geo_country->code == $dataTienda->pais) { ?>
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
                                                        <?php if (!empty($dataTienda->region)) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_regions as $geo_region): ?>
                                                                <?php if ($geo_region->code == $dataTienda->region) { ?>
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
                                                        <?php if (!empty($dataTienda->ciudad)) { ?>
                                                            <option value="">Seleccione</option>
                                                            <?php foreach($modulo->data_geo_cities as $geo_ciudad): ?>
                                                                <?php if ($geo_ciudad->ID == $dataTienda->ciudad) { ?>
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
                                                    <?php if ($existeTienda) { ?>
                                                        <input type="text" class="form-control" id="txtAddress" name="txtAddress" maxlength="150" value="<?php echo $dataTienda->direccion; ?>" data-parsley-required data-parsley-required-message="Ingrese una direccion.">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control" id="txtAddress" name="txtAddress" maxlength="150" data-parsley-required data-parsley-required-message="Ingrese una direccion.">
                                                    <?php } ?>
                                                </div>

                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button id="btnAgregar" type="submit" class="btn btn-primary">Editar</button>
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
<!-- Geolocation -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>geolocation/jquery.geolocation.min.js"></script>
<script>
    $(function () {

        //Initialize Select2 Elements
        $("#cboTipoEmpresa, #cboPaqueteTmo").select2();

        var formData = new FormData();

        GenericModal.config("#genericModal", "");

        var selectorInputsForm = ["#txtNameStore", "#txtMobilePhone", "#txtStorePhone", "#cboCountry", "#cboRegion", "#cboCity", "#txtAddress"];
        var baseUrl         = "<?php echo base_url(); ?>";
        var modulePanelUrl  = "<?php echo $modulo->url_module_panel; ?>";

        $("#btnAgregar").on("click", function(evt){
            evt.preventDefault();

            if ( ValidateInputFormWithParsley.validate(selectorInputsForm)) {

                waitingDialog.show('Cargando...');

                var request = $.ajax({
                    url: modulePanelUrl + "/ajax/editStore",
                    method: "POST",
                    data: $("#formStore").serialize(),
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

        $("#btnInputLatitud, #btnInputLongitud").on("click", function() {
            GenericModal.show("default", "<div id='box-gmap'></div>");
            setTimeout(function(){
                $.geolocation.get({
                    win: function(position) {
                        $('#box-gmap').locationpicker({
                            location: {latitude: position.coords.latitude, longitude: position.coords.longitude},
                            radius: 0,
                            zoom: 15,
                            inputBinding: {
                                latitudeInput: $("#txtGPSLatitud"),
                                longitudeInput: $("#txtGPSLongitud"),
                                radiusInput: null,
                                locationNameInput: null
                            }
                        });
                    },
                    fail: function(error) {
                        $('#box-gmap').locationpicker({
                            location: {latitude: 48.858365282590746, longitude: 2.2944820579116367},
                            radius: 0,
                            zoom: 15,
                            inputBinding: {
                                latitudeInput: $("#txtGPSLatitud"),
                                longitudeInput: $("#txtGPSLongitud"),
                                radiusInput: null,
                                locationNameInput: null
                            }
                        });
                    }
                });
            }, 1000);
        });

    });

</script>
</body>
</html>