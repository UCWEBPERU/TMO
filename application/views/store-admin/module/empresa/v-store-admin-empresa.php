<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
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
                <form id="frmPerfilUsuario" name="frmPerfilUsuario" role="form" method="post">
                    <div class="box-body">
                        <div class="form-group">
                        <label for="txtNombres">Nombre</label>
                        <input type="text" class="form-control" id="txtNombres" name="txtNombres" value="<?php echo $modulo->datos_empresa->nombre_empresa; ?>" data-parsley-required data-parsley-required-message="Ingrese nombre."/>
                        </div>
                        <div class="form-group">
                        <label for="txtApellidos">Descripcion</label>
                        <input type="text" class="form-control" id="txtApellidos" name="txtApellidos" value="<?php echo $modulo->datos_empresa->descripcion_empresa; ?>" data-parsley-required data-parsley-required-message="Ingrese apellido."/>
                        </div>
                        <div class="form-group">
                        <label for="txtPais">Direccion</label>
                        <input type="text" class="form-control" id="txtPais" name="txtPais" value="<?php echo $modulo->datos_empresa->direccion_empresa; ?>" data-parsley-required data-parsley-required-message="Ingrese su pais."/>
                        </div>
                        <div class="form-group">
                        <label for="txtEstado">Pais</label>
                        <input type="text" class="form-control" id="txtEstado" name="txtEstado" value="<?php echo $modulo->datos_empresa->pais_region_empresa; ?>" data-parsley-required data-parsley-required-message="Ingrese su estado."/>
                        </div>
                        <div class="form-group">
                        <label for="txtDireccion">Estado</label>
                        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" value="<?php echo $modulo->datos_empresa->estado_region_empresa; ?>" data-parsley-required data-parsley-required-message="Ingrese su direccion."/>
                        </div>
                        <div class="form-group">
                        <label for="txtNumeroCelular">Codigo Postal</label>
                        <input type="text" class="form-control" id="txtNumeroCelular" name="txtNumeroCelular" data-parsley-type="digits" value="<?php echo $modulo->datos_empresa->codigo_postal_empresa; ?>" data-parsley-required data-parsley-type="integer" data-parsley-required-message="Ingrese su numero de celular." data-parsley-type-message="Ingrese un numerico de celular valido."/>
                        </div>
                        <div class="form-group">
                        <label for="txtNumeroTelefono">Numero Celular</label>
                        <input type="text" class="form-control" id="txtNumeroTelefono" name="txtNumeroTelefono" value="<?php echo $modulo->datos_empresa->movil_empresa; ?>" data-parsley-required data-parsley-type="integer" data-parsley-required-message="Ingrese su numero de telefono."  data-parsley-type-message="Ingrese un numerico de celular valido."/>
                        </div>
                        <div class="form-group">
                        <label for="txtNumeroTelefono">Numero Telefonico</label>
                        <input type="text" class="form-control" id="txtNumeroTelefono" name="txtNumeroTelefono" value="<?php echo $modulo->datos_empresa->telefono_empresa; ?>" data-parsley-required data-parsley-type="integer" data-parsley-required-message="Ingrese su numero de telefono."  data-parsley-type-message="Ingrese un numerico de celular valido."/>
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
                        <h3 class="box-title">Cuenta de Pago</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="frmDatosUsuario" name="frmDatosUsuario" role="form" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="txtPassword">ID Account</label>
                                <?php if (isset($modulo->datos_pay_account)) { ?>
                                        <input type="text" class="form-control" id="txtPassword" name="passwordUsuario" value="<?php echo $modulo->datos_pay_account->pay_id; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese la nueva contraseña."/>
                                <?php } else { ?>
                                        <input type="text" class="form-control" id="txtPassword" name="passwordUsuario" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese la nueva contraseña."/>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="txtPasswordRepeat">Tipo Metodo de Pago</label>
                                <?php if (isset($modulo->datos_pay_account)) { ?>
                                        <input type="text" class="form-control" id="txtPasswordRepeat" name="repeatPasswordUsuario" value="<?php echo $modulo->datos_pay_account->tipo_metodo_pago; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-equalto="#txtPassword" data-parsley-required-message="Confirme su contraseña." data-parsley-equalto-message="Las contraseñas no coinciden."/>
                                <?php } else { ?>
                                        <input type="text" class="form-control" id="txtPasswordRepeat" name="repeatPasswordUsuario" data-parsley-required data-parsley-type="alphanum" data-parsley-equalto="#txtPassword" data-parsley-required-message="Confirme su contraseña." data-parsley-equalto-message="Las contraseñas no coinciden."/>
                                <?php } ?>
                                
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button id="btnGuardarUsuario" type="submit" class="btn btn-primary">Guardar</button>
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
                        <img class="img-circle img-size-25" src="<?php echo $modulo->icono_empresa; ?>" alt="Logo Store" title="Logo Store">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Upload new logo
                            <input type="file" name="logoStore">
                        </div>
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
            var selectorInputsFormPerfilUsuario = ["#txtNombres", "#txtApellidos", "#txtPais", "#txtEstado", "#txtDireccion", "#txtNumeroCelular", "#txtNumeroTelefono"];
            var selectorInputsFormDatosUsuario = ["#txtPassword", "#txtPasswordRepeat"];
            
            $("#btnGuardarPerfil").on("click", function(evt){
                evt.preventDefault();
                
                if (validateInputsForm(selectorInputsFormPerfilUsuario)) {
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
                
                if (validateInputsForm(selectorInputsFormDatosUsuario)) {
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
            
        });
        
    </script>
  </body>
</html>