<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = $modulo->menu["menu"];
        $data["submenu"]  = $modulo->menu["submenu"];
        $this->load->view('store-admin/v-store-admin-menu', $data); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Empresa
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
                    <h3 class="box-title">Datos Empresa</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form id="frmDatosStore" name="frmDatosStore" role="form" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="txtNombreEmpresa">Nombre</label>
                            <input type="text" class="form-control" id="txtNombreEmpresa" name="txtNombreEmpresa" value="<?php echo $modulo->datos_empresa->nombre_empresa; ?>" data-parsley-required data-parsley-required-message="Ingrese el nombre de la empresa."/>
                        </div>
                        <div class="form-group">
                            <label for="cbo_tipo_empresa">Tipo Empresa</label>
                            <select id="cbo_tipo_empresa"  name="cbo_tipo_empresa" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <?php foreach($modulo->datos_tipo_empresa as $tipo_empresa): ?>
                                <?php if (intval($modulo->datos_empresa->id_tipo_empresa) == intval($tipo_empresa->id_tipo_empresa)) { ?>
                                    <option selected="selected" value="<?php echo $tipo_empresa->id_tipo_empresa;?>"> <?php echo $tipo_empresa->nombre_tipo_empresa; ?></option> 
                                <?php } else { ?>  
                                    <option value="<?php echo $tipo_empresa->id_tipo_empresa; ?>"><?php echo $tipo_empresa->nombre_tipo_empresa; ?></option>
                                <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">Descripcion</label>
                            <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" value="<?php echo $modulo->datos_empresa->descripcion_empresa; ?>" />
                        </div>
                        <div class="form-group">
                        <label for="txtDireccion">Direccion</label>
                        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" value="<?php echo $modulo->datos_empresa->direccion_empresa; ?>" />
                        </div>
                        <div class="form-group">
                        <label for="txtPais">Pais</label>
                        <input type="text" class="form-control" id="txtPais" name="txtPais" value="<?php echo $modulo->datos_empresa->pais_region_empresa; ?>" />
                        </div>
                        <div class="form-group">
                        <label for="txtEstado">Estado</label>
                        <input type="text" class="form-control" id="txtEstado" name="txtEstado" value="<?php echo $modulo->datos_empresa->estado_region_empresa; ?>" />
                        </div>
                        <div class="form-group">
                        <label for="txtCodigoPostal">Codigo Postal</label>
                        <input type="text" class="form-control" id="txtCodigoPostal" name="txtCodigoPostal" value="<?php echo $modulo->datos_empresa->codigo_postal_empresa; ?>" />
                        </div>
                        <div class="form-group">
                        <label for="txtNumeroCelular">Numero Celular</label>
                        <input type="text" class="form-control" id="txtNumeroCelular" name="txtNumeroCelular" value="<?php echo $modulo->datos_empresa->movil_empresa; ?>" data-parsley-type="integer" data-parsley-type-message="El numero de celular solo debe ser digitos."/>
                        </div>
                        <div class="form-group">
                        <label for="txtNumeroTelefono">Numero Telefonico</label>
                        <input type="text" class="form-control" id="txtNumeroTelefono" name="txtNumeroTelefono" value="<?php echo $modulo->datos_empresa->telefono_empresa; ?>" data-parsley-type="integer" data-parsley-type-message="El numero de telefono solo debe ser digitos."/>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button id="btnGuardarDatosStore" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <!-- /.box  -->

            </div>
            
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cuenta de Pago</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="frmDatosPayAccount" name="frmDatosPayAccount" role="form" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="txtIDPayAccount">ID Account</label>
                                <?php if (isset($modulo->datos_pay_account)) { ?>
                                        <input type="text" class="form-control" id="txtIDPayAccount" name="txtIDPayAccount" value="<?php echo $modulo->datos_pay_account->pay_id; ?>" data-parsley-required data-parsley-required-message="Ingrese el id de su cuenta de pago."/>
                                <?php } else { ?>
                                        <input type="text" class="form-control" id="txtIDPayAccount" name="txtIDPayAccount" data-parsley-required data-parsley-required-message="Ingrese el id de su cuenta de pago."/>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="txtTipoPayAccount">Tipo de Metodo de Pago</label>
                                <?php if (isset($modulo->datos_pay_account)) { ?>
                                        <input type="text" class="form-control" id="txtTipoPayAccount" name="txtTipoPayAccount" value="<?php echo $modulo->datos_pay_account->tipo_metodo_pago; ?>" data-parsley-required data-parsley-required-message="Ingrese el tipo de metodo de pago."/>
                                <?php } else { ?>
                                        <input type="text" class="form-control" id="txtTipoPayAccount" name="txtTipoPayAccount" data-parsley-required data-parsley-required-message="Ingrese el tipo de metodo de pago." />
                                <?php } ?>
                                
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button id="btnGuardarDatosPayAccount" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
                <!-- /.box  -->
                
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Logo Empresa</h3>
                    </div>
                    <div class="box-logo-store">
                        <img id="logoStore" class="img-circle img-size-25" src="<?php echo $modulo->icono_empresa; ?>" alt="Logo Store" title="Logo Store">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Upload new logo
                            <input type="file" id="imgLogoStore" name="imgLogoStore" accept="image/*">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="btnActualizarLogoEmpresa" type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
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
    <script src="http://parsleyjs.org/dist/parsley.min.js" type="text/javascript" ></script>
    <!-- Handle File -->
    <script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/HandleFile.js"></script>
    <script>
        
         GenericModal.config("#genericModal", "");
         
         function validateInputsForm(selectorInputsForm) {
            var messagesError = "";
            for (var i = 0; i < selectorInputsForm.length; i++) {
                if ($(selectorInputsForm[i]).parsley().isValid()) {
                    $(selectorInputsForm[i]).parent().removeClass("has-error");
                } else {
                    $(selectorInputsForm[i]).parent().addClass("has-error");
                    messagesError += "<li>" + ParsleyUI.getErrorsMessages($(selectorInputsForm[i]).parsley()) + "</li>";
                }
            }
            
            if (messagesError.length > 0) {
                GenericModal.show("danger", "<ul>" + messagesError + "</ul>");
                return false;
            }
            
            return true;
        }
        
        $(function () {
            var selectorInputsFormDatosStore = ["#txtNombreEmpresa", "#txtNumeroCelular", "#txtNumeroTelefono"];
            
            $("#btnGuardarDatosStore").on("click", function(evt){
                evt.preventDefault();
                
                if (validateInputsForm(selectorInputsFormDatosStore)) {
                    waitingDialog.show('Guardando Datos de Empresa...');
                    var request = $.ajax({
                        url: "<?php echo $modulo->url_main_panel."/perfil-store/updatePerfilStore"; ?>",
                        method: "POST",
                        data: $("#frmDatosStore").serialize(),
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
            
            $("#btnGuardarDatosPayAccount").on("click", function(evt){
                evt.preventDefault();
                
                if (validateInputsForm(selectorInputsFormDatosStore)) {
                    waitingDialog.show('Guardando Datos de Cuenta de Pago...');
                    var request = $.ajax({
                        url: "<?php echo $modulo->url_main_panel."/perfil-store/updatePayAccount"; ?>",
                        method: "POST",
                        data: $("#frmDatosPayAccount").serialize(),
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
            
            var formData  = new FormData();
            
            function handleFileSelect(evt) {
                var files = evt.target.files; // FileList object
                // Loop through the FileList and render image files as thumbnails.
                for (var i = 0, f; f = files[i]; i++) {
                
                    // Only process image files.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
                    
                    formData.append("imgLogoStore", f);
                
                    var reader = new FileReader();
                
                    // Closure to capture the file information.
                    reader.onload = (function(theFile) {
                        return function(e) {
                            $("#logoStore").attr("src", e.target.result);
                        };
                    })(f);
                
                    // Read in the image file as a data URL.
                    reader.readAsDataURL(f);
                }
            }
                
            $("#btnActualizarLogoEmpresa").on("click", function(evt){
                evt.preventDefault();
                
                if ( $("#imgLogoStore").val().length > 0 ) {
                        
                        waitingDialog.show('Actualizando Logo de Empresa...');
                        
                        var request = $.ajax({
                            url: "<?php echo $modulo->url_main_panel."/perfil-store/updateLogoStore"; ?>",
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
                            } else {
                                GenericModal.show("danger", "<p>" + response.message + "</p>");
                            }
                        });
            
                        request.fail(function( jqXHR, textStatus ) {
                            waitingDialog.hide();
                            GenericModal.show("danger", "<p>" + textStatus + "</p>");
                        });
                    
                } else {
                    GenericModal.show("danger", "<p>Seleccione una imagen.</p>");
                }
                
            });
                
            // $("#imgLogoStore").on("change", handleFileSelect);
            
            var objHandleFile = new HandleFile();
            objHandleFile.init(
                "#imgLogoStore",
                function(file) {
                    formData.append("imgLogoStore", file);
                },
                function(readResult) {
                    $("#logoStore").attr("src", readResult);
                }
            );
            
        });
        
    </script>
  </body>
</html>