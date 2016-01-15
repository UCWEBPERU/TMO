<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = 4;
        $data["submenu"]  = 0;
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
            <li class="active"><a href="#">Perfil</a></li>
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
                <form id="frmPerfilUsuario" name="frmPerfilUsuario" role="form">
                    <div class="box-body">
                        <div class="form-group">
                        <label for="txtNombres">Nombres</label>
                        <input type="email" class="form-control" id="txtNombres" value="<?php echo $modulo->datos_usuario->nombres_persona; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese nombre."/>
                        </div>
                        <div class="form-group">
                        <label for="txtApellidos">Apellidos</label>
                        <input type="email" class="form-control" id="txtApellidos" value="<?php echo $modulo->datos_usuario->apellidos_persona; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese apellido."/>
                        </div>
                        <div class="form-group">
                        <label for="txtPais">Pais</label>
                        <input type="email" class="form-control" id="txtPais" value="<?php echo $modulo->datos_usuario->pais_region_persona; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese su pais."/>
                        </div>
                        <div class="form-group">
                        <label for="txtEstado">Estado</label>
                        <input type="email" class="form-control" id="txtEstado" value="<?php echo $modulo->datos_usuario->estado_region_persona; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese su estado."/>
                        </div>
                        <div class="form-group">
                        <label for="txtDireccion">Direccion</label>
                        <input type="email" class="form-control" id="txtDireccion" value="<?php echo $modulo->datos_usuario->direccion_persona; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese su direccion."/>
                        </div>
                        <div class="form-group">
                        <label for="txtNumeroCelular">Numero Celular</label>
                        <input type="email" class="form-control" id="txtNumeroCelular" data-parsley-type="digits" value="<?php echo $modulo->datos_usuario->movil_persona; ?>" data-parsley-required data-parsley-type="integer" data-parsley-required-message="Ingrese su numero de celular."/>
                        </div>
                        <div class="form-group">
                        <label for="txtNumeroTelefonico">Numero Telefonico</label>
                        <input type="email" class="form-control" id="txtNumeroTelefonico" value="<?php echo $modulo->datos_usuario->telefono_persona; ?>" data-parsley-required data-parsley-type="integer" data-parsley-required-message="Ingrese su numero de telefono."/>
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
                <form id="frmPerfilUsuario" name="frmPerfilUsuario" role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="txtNombreUsuario">Nombre Usuario</label>
                            <input type="email" class="form-control" id="txtNombreUsuario" value="<?php echo $modulo->datos_usuario->email_usuario; ?>" disabled />
                        </div>
                        <div class="form-group">
                            <label for="txtPassword">Contraseña</label>
                            <input type="text" class="form-control" id="txtPassword" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese la nueva contraseña."/>
                        </div>
                        <div class="form-group">
                            <label for="txtPasswordRepeat">Confirmar Contraseña</label>
                            <input type="text" class="form-control" id="txtPasswordRepeat" data-parsley-required data-parsley-type="alphanum" data-parsley-equalto="#txtPassword" data-parsley-required-message="Confirme su contraseña." data-parsley-equalto-message="Las contraseñas no coinciden."/>
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
    <script src="http://parsleyjs.org/dist/parsley.min.js" type="text/javascript" ></script>
    <script>
        
         function validateInputsForm(selectorInputsForm) {
            var messagesError = "";
            for (var i = 0; i < selectorInputsForm.length; i++) {
                if ($(selectorInputsForm).parsley().isValid()) {
                    $(selectorInputsForm).parent().removeClass("has-error");
                } else {
                    $(selectorInputsForm).parent().addClass("has-error");
                    message = "<li>" + ParsleyUI.getErrorsMessages($(selectorInputsForm).parsley()) + "</li>";
                }
            }
            
            if (messagesError.length > 0) {
                ManagerModal.show("danger", "<ul>" + message + "</ul>");
                return false;
            }
            
            return true;
        }
        
        $(function () {
            ManagerModal.config("#genericModal", "");
//             $("#btnSignIn").on("click", function(evt){
//                 evt.preventDefault();
// 
//                 if ( $("#email_usuario").val().length > 0 && $("#contrasenia_usuario").val().length > 0 ) {
//                     waitingDialog.show('Iniciando sesion...');
//                     var request = $.ajax({
//                         url: "<?php echo base_url().'admin/signIn'; ?>",
//                         method: "POST",
//                         data: $("#formLogin").serialize(),
//                         dataType: "json"
//                     });
// 
//                     request.done(function( response ) {
//                         waitingDialog.hide();
//                         if (response.status) {
//                             $(location).attr("href", response.data.url_redirect);
//                         } else {
//                             $( ".modal-body" ).html("<p>" + response.message + "<p>");
//                             $('#myModal').modal('show');
//                         }
//                     });
// 
//                     request.fail(function( jqXHR, textStatus ) {
//                         waitingDialog.hide();
//                         $( ".modal-body" ).html( "<p>" + textStatus + " FAIL<p>");
//                         $('#myModal').modal('show');
//                     });
//                 } else {
//                     $( ".modal-body" ).html( "<p>Ingrese sus datos de usuario correctamente.<p>");
//                     $('#myModal').modal('show');
//                 }
// 
//             });
            
            $("#btnGuardarUsuario").on("click", function(evt){
                evt.preventDefault();
                
                var selectorInputsForm = ["#txtPassword", "#txtPasswordRepeat"];
                validateInputsForm(selectorInputsForm);
                
                // var message = "";
                // 
                // if ($('#txtPassword').parsley().isValid()) {
                //     $("#txtPassword").parent().removeClass("has-error");
                // } else {
                //     $("#txtPassword").parent().addClass("has-error");
                //     message = "<li>" + ParsleyUI.getErrorsMessages($('#txtPassword').parsley()) + "</li>";
                // }
                // 
                // if ($('#txtPasswordRepeat').parsley().isValid()) {
                //     $("#txtPasswordRepeat").parent().removeClass("has-error");
                // } else {
                //     $("#txtPasswordRepeat").parent().addClass("has-error");
                //     message += "<li>" + ParsleyUI.getErrorsMessages($('#txtPasswordRepeat').parsley()) + "</li>";
                //     ManagerModal.show("danger", "<ul>" + message + "</ul>");
                // }
                
            });
            
        });
        

        
    </script>
  </body>
</html>