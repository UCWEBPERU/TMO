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
                        <input type="text" class="form-control" id="txtNumeroCelular" name="txtNumeroCelular" value="<?php echo $modulo->datos_empresa->movil_empresa; ?>" data-parsley-type="integer" data-parsley-required-message="Ingrese el tipo de metodo de pago." data-parsley-type-message="Ingrese un numero de celular valido."/>
                        </div>
                        <div class="form-group">
                        <label for="txtNumeroTelefono">Numero Telefonico</label>
                        <input type="text" class="form-control" id="txtNumeroTelefono" name="txtNumeroTelefono" value="<?php echo $modulo->datos_empresa->telefono_empresa; ?>" data-parsley-type="integer" data-parsley-required-message="Ingrese el tipo de metodo de pago." data-parsley-type-message="Ingrese un numero de celular valido."/>
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
                    <form id="frmDatosUsuario" name="frmDatosUsuario" role="form" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="txtIDPayAccount">ID Account</label>
                                <?php if (isset($modulo->datos_pay_account)) { ?>
                                        <input type="text" class="form-control" id="txtIDPayAccount" name="txtIDPayAccount" value="<?php echo $modulo->datos_pay_account->pay_id; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese el id de su cuenta de pago."/>
                                <?php } else { ?>
                                        <input type="text" class="form-control" id="txtIDPayAccount" name="txtIDPayAccount" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese el id de su cuenta de pago."/>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="txtTipoPayAccount">Tipo de Metodo de Pago</label>
                                <?php if (isset($modulo->datos_pay_account)) { ?>
                                        <input type="text" class="form-control" id="txtTipoPayAccount" name="txtTipoPayAccount" value="<?php echo $modulo->datos_pay_account->tipo_metodo_pago; ?>" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese el tipo de metodo de pago."/>
                                <?php } else { ?>
                                        <input type="text" class="form-control" id="txtTipoPayAccount" name="txtTipoPayAccount" data-parsley-required data-parsley-type="alphanum" data-parsley-required-message="Ingrese el tipo de metodo de pago." />
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
                            <input type="file" id="logoStore" name="logoStore" accept="image/*">
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
            var selectorInputsFormDatosStore = ["#txtNombreEmpresa", "#txtNumeroCelular", "#txtNumeroTelefono"];
            
            $("#btnGuardarDatosStore").on("click", function(evt){
                evt.preventDefault();
                
                if (validateInputsForm(selectorInputsFormDatosStore)) {
                    waitingDialog.show('Actualizando Datos de Empresa...');
                    var request = $.ajax({
                        url: "<?php echo $modulo->url_main_panel."/perfil-store/update"; ?>",
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
                        GenericModal.show("danger", "<p>" + response.message + "</p>");
                    });
                }
            });
            
        });
        
    </script>
  </body>
</html>