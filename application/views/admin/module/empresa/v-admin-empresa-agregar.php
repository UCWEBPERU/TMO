<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
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
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo $modulo->nombreSeccion; ?> Empresa</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion">
                  <!-- Panel Empresa-->
                  <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a class="">
                          Datos de Empresa
                        </a>
                      </h4>
                    </div>
                    <div >
                    <div class="box-body">
                        <!-- form start -->
                          <form id="formEmpresa" role="form"  enctype="multipart/form-data">
                            <?php 
                            if ( isset($idEmpresa) ) { ?>
                              <input type="hidden" name="id_empresa" value="<?php echo $idEmpresa; ?>">
                            <?php } ?>
                           <div class="box-body">
                              <?php
                                if (isset($existeEmpresa) && !$existeEmpresa ) { ?>
                                  <div class="alert alert-danger alert-dismissible">
                                    <h4><i class="icon fa fa-ban"></i> No existe el cliente!</h4>
                                    Lo sentimos el cliente que desea editar no existe.<br>
                                    <strong>No intente modificar la direccion url :D</strong>
                                  </div>
                              <?php } ?>
                              <div class="form-group">
                                <label for="nombre_empresa">Nombre</label>
                                <?php
                                  if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                    <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                <?php } else { ?>
                                    <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength="40">
                                <?php } ?>
                              </div>
                              
                              <div class="form-group">
                                <label for="id_tipo_empresa">Tipo Empresa</label>
                                <?php
                                  if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                                    
                                    <select id="id_tipo_empresa"  name="id_tipo_empresa" value="<?php echo $dataEmpresa->id_tipo_empresa; ?>" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      
                                      <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                        <?php if($dataEmpresa->id_tipo_empresa == $tipo->id_tipo_empresa ){?>
                                          <option selected="selected" value="<?php echo $tipo->id_tipo_empresa;?>"> <?php echo $tipo->nombre_tipo_empresa; ?></option> 
                                        <?php } else { ?>  
                                          <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                        <?php } ?>
                                      <?php endforeach; ?>
                                      
                                    </select>
                                <?php } else { ?>
                                    <select id="id_tipo_empresa"  name="id_tipo_empresa"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <option selected="selected">Seleccione un Tipo de Empresa</option>
                                      <?php foreach($modulo->tipo_empresa as $tipo): ?>
                                          <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                <?php } ?>
                              </div>

                            </div><!-- /.box-body -->

                            <!--div class="box-footer">
                              <button id="btnAgregar" type="submit" class="btn btn-primary"><?php //echo $modulo->nombreSeccion; ?></button>
                            </div-->
                          
                    </div>
                    </div>
                  </div>
                  
                  <!-- Panel Usuario-->
                  <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a >
                          Datos de Usuario
                        </a>
                      </h4>
                    </div>
                    <div>
                      <div class="box-body">
                        
                            <?php 
                            if ( isset($idUsuario) ) { ?>
                              <input type="hidden" name="id_usuario" value="<?php echo $idUsuario; ?>">
                            <?php } ?>
                           <div class="box-body">
                              <?php
                                if (isset($existeUsuario) && !$existeUsuario ) { ?>
                                  <div class="alert alert-danger alert-dismissible">
                                    <h4><i class="icon fa fa-ban"></i> No existe el cliente!</h4>
                                    Lo sentimos el cliente que desea editar no existe.<br>
                                    <strong>No intente modificar la direccion url :D</strong>
                                  </div>
                              <?php } ?>
                              <div class="form-group">
                                <label for="nombres_persona">Nombre</label>
                                <?php
                                  if (isset($existeUsuario) && $existeUsuario ) { ?>
                                    <input type="text" class="form-control" id="nombres_persona" name="nombres_persona" maxlength="30" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                <?php } else { ?>
                                    <input type="text" class="form-control" id="nombres_persona" name="nombres_persona" maxlength="30">
                                <?php } ?>
                              </div>
                              <div class="form-group">
                                <label for="apellido_persona">Apellidos</label>
                                <?php
                                  if (isset($existeUsuario) && $existeUsuario ) { ?>
                                    <input type="text" class="form-control" id="apellido_persona" name="apellido_persona" maxlength="30" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                <?php } else { ?>
                                    <input type="text" class="form-control" id="apellido_persona" name="apellido_persona" maxlength="30">
                                <?php } ?>
                              </div>
                              <div class="form-group">
                                <label for="email_usuario">Email</label>
                                <?php
                                  if (isset($existeUsuario) && $existeUsuario ) { ?>
                                    <input type="email" class="form-control" id="email_usuario" name="email_usuario" maxlength="" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                <?php } else { ?>
                                    <input type="email" class="form-control" id="email_usuario" name="email_usuario" maxlength="">
                                <?php } ?>
                              </div>
                              <div class="form-group">
                                <label for="password_usuario">Password</label>
                                <?php
                                  if (isset($existeCuenta) && $existeCuenta ) { ?>
                                    <input type="password" class="form-control" id="password_usuario" name="password_usuario" maxlength="12" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                <?php } else { ?>
                                    <input type="password" class="form-control" id="password_usuario" name="password_usuario" maxlength="12">
                                <?php } ?>
                              </div>
                              
                            </div><!-- /.box-body -->

                          
                        
                      </div>
                    </div>
                  </div>
                  <!-- Panel Archivo-->
                  <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a >
                          Logo Institucional
                        </a>
                      </h4>
                    </div>
                    <div>
                    <div class="box-body">
                        
                            <?php 
                            if ( isset($idArchivo) ) { ?>
                              <input type="hidden" name="id_usuario" value="<?php echo $idArchivo; ?>">
                            <?php } ?>
                           <div class="box-body">
                              <?php
                                if (isset($existeArchivo) && !$existeArchivo ) { ?>
                                  <div class="alert alert-danger alert-dismissible">
                                    <h4><i class="icon fa fa-ban"></i> No existe el cliente!</h4>
                                    Lo sentimos el cliente que desea editar no existe.<br>
                                    <strong>No intente modificar la direccion url :D</strong>
                                  </div>
                              <?php } ?>
                              <div class="form-group">
                                <label for="url_archivo">Añadir Logo</label>
                                <?php
                                  if (isset($existeArchivo) && $existeArchivo ) { ?>
                                    <input type="file" class="form-control" id="url_archivo" name="url_archivo" maxlength="" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                                <?php } else { ?>
                                    <input type="file" class="form-control" id="url_archivo" name="url_archivo">
                                    
                                <?php } ?>
                              </div>
                              
                              </div>
                        
                    </div><!-- /.box-body -->
                    </div>
                  </div>

                </div>
               
              </div><!-- /.box-body -->
              <div class="box-footer">
                  <button id="btnAgregar" type="submit" class="btn btn-primary"><?php echo $modulo->nombreSeccion; ?></button>
              </div>
              </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      
      <?php $this->load->view('template/main-panel/footer'); ?>

    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>
    <?php $this->load->view('template/main-panel/modal-admin'); ?>

    <script>
      
      

      function mostrarErrorInputText(id) {
          if ( $(id).val().length == 0) {
            $(id).parent().addClass("has-error");
          } else {
            $(id).parent().removeClass("has-error");
          }
      } 

      $(function () {
       

        $("#btnAgregar").on("click", function(evt){
          evt.preventDefault();
          
          var baseUrl   = "<?php echo $modulo->base_url; ?>";
          var urlApi    = baseUrl + <?php if (isset($idEmpresa)) { echo '"editar";'; } else { echo '"crear";'; } ?>
          var formData  = new FormData();
          
          var element = this;
          
          mostrarErrorInputText("#nombre_empresa");
          mostrarErrorInputText("#id_tipo_empresa");
          mostrarErrorInputText("#nombres_persona");
          mostrarErrorInputText("#apellido_persona");
          mostrarErrorInputText("#email_usuario");
          mostrarErrorInputText("#password_usuario");
          mostrarErrorInputText("#url_archivo");
          
          GenericModal.config("#genericModal", "");
          
          if ( $("#nombre_empresa").val().length > 0 &&
               $("#id_tipo_empresa").val().length > 0 &&
               $("#nombres_persona").val().length > 0 &&
               $("#apellido_persona").val().length > 0 &&
               $("#email_usuario").val().length > 0 &&
               $("#password_usuario").val().length > 0 &&
               $("#url_archivo").val().length > 0 
               ) {
                
                // $(".overlay").removeClass("hide");
                waitingDialog.show('Cargando...');
                                 
                var request = $.ajax({
                  url: urlApi,
                  method: "POST",
                  data: $("#formEmpresa").serialize(),
                  dataType: "json"
                });
      
                request.done(function( response ) {
                  
                 waitingDialog.hide();
                  
                  if (response.status) {
                    
                    GenericModal.show("default", "<p>" + response.message + "</p>");
                    if (response.action == "insert") {
                      $("#nombre_empresa").val("");
                      $("#id_tipo_empresa").val(0);
                      $("#nombres_persona").val("");
                      $("#apellido_persona").val("");
                      $("#email_usuario").val("");
                      $("#password_usuario").val("");
                      $("#url_archivo").val("");
                    }
                    
                  } else {
                    GenericModal.show("danger", "<p>" + response.message + "</p>");
                  }
                  
                });
      
                request.fail(function( jqXHR, textStatus ) {
                  waitingDialog.hide();
                  GenericModal.show("danger", "<p>" + textStatus + "</p>");
                });
            
          } else {
            GenericModal.show("danger", "<p>Ingrese los dattos de la empresa correctamente.</p>");
          }
          
        });

      });
      
    </script> 
  </body>
</html>