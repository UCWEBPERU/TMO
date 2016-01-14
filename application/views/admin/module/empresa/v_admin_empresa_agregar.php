<<<<<<< HEAD


<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = 0;
        $data["submenu"]  = 0;
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
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $modulo->nombreSeccion; ?> Empresa</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="formEmpresa" role="form">
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
                      <label for="txtnombre_empresa">Nombre</label>
                      <?php
                        if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                          <input type="text" class="form-control" id="txtnombre_empresa" name="nombre_empresa" maxlength="10" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                      <?php } else { ?>
                          <input type="text" class="form-control" id="txtnombre_empresa" name="nombre_empresa" maxlength="10">
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="txtDescripcion">Descripcion</label>
                      <?php
                        if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                          <input type="text" class="form-control" id="txtDescripcion" name="descripcion_empresa" maxlength="150" value="<?php echo $dataEmpresa->descripcion_empresa; ?>">
                      <?php } else { ?>
                          <input type="text" class="form-control" id="txtDescripcion" name="descripcion_empresa" maxlength="150">
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="txtTipo">Tipo Empresa</label>
                      <?php
                        if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                          
                          <select id="txtTipo"  name="id_tipo_empresa" value="<?php echo $dataEmpresa->id_tipo_empresa; ?>" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="selected"></option>
                            <option>Alaska</option>
                            
                          </select>
                      <?php } else { ?>
                          <select id="txtTipo"  name="id_tipo_empresa"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="selected">Seleccione un Tipo de Empresa</option>
                            <?php foreach($tipo_empresa as $tipo_empresa): ?>
                                <option value="<?php echo $tipo_empresa->id_tipo_empresa; ?>"><?php echo $tipo_empresa->nombre_tipo_empresa; ?></option>
                            <?php endforeach; ?>  
                          </select>
                      <?php } ?>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button id="btnAgregar" type="submit" class="btn btn-primary"><?php echo $modulo->nombreSeccion; ?></button>
                  </div>
                </form>
                <div class="overlay hide" >
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      
      <?php $this->load->view('template/main-panel/footer'); ?>

    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>

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
          
          var baseUrl   = "<?php echo base_url(); ?>";
          var urlApi    = baseUrl + <?php if (isset($idCliente)) { echo '"admin/cliente/update";'; } else { echo '"admin/cliente/insert";'; } ?>
          var formData  = new FormData();
          
          var element = this;
          
          mostrarErrorInputText("#txtCodigoSigne");
          mostrarErrorInputText("#txtRazonSocial");
          mostrarErrorInputText("#txtRUC");
          
          ManagerModal.config("#modalAdmin", "");
          
          if ( $("#txtCodigoSigne").val().length > 0 &&
               $("#txtRazonSocial").val().length > 0 &&
               $("#txtRUC").val().length > 0 ) {
                 
                $(".overlay").removeClass("hide");
                 
                var request = $.ajax({
                  url: urlApi,
                  method: "POST",
                  data: $("#formCliente").serialize(),
                  dataType: "json"
                });
      
                request.done(function( response ) {
                  
                  $(".overlay").addClass("hide");
                  
                  if (response.status) {
                    
                    ManagerModal.show("default", response.message);
                    if (response.action == "insert") {
                      $("#txtCodigoSigne").val("");
                      $("#txtRazonSocial").val("");
                      $("#txtRUC").val("");
                    }
                    
                  } else {
                    ManagerModal.show("danger", response.message);
                  }
                  
                });
      
                request.fail(function( jqXHR, textStatus ) {
                  $(".overlay").addClass("hide");
                  ManagerModal.show("danger", textStatus);
                });
            
          } else {
            ManagerModal.show("danger", "Ingrese los datos de cliente correctamente.");
          }
          
        });

      });
      
    </script> 
  </body>
=======


<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = 0;
        $data["submenu"]  = 0;
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
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $modulo->nombreSeccion; ?> Empresa</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="formEmpresa" role="form">
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
                      <label for="txtnombre_empresa">Nombre</label>
                      <?php
                        if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                          <input type="text" class="form-control" id="txtnombre_empresa" name="nombre_empresa" maxlength="10" value="<?php echo $dataEmpresa->nombre_empresa; ?>">
                      <?php } else { ?>
                          <input type="text" class="form-control" id="txtnombre_empresa" name="nombre_empresa" maxlength="10">
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="txtDescripcion">Descripcion</label>
                      <?php
                        if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                          <input type="text" class="form-control" id="txtDescripcion" name="descripcion_empresa" maxlength="150" value="<?php echo $dataEmpresa->descripcion_empresa; ?>">
                      <?php } else { ?>
                          <input type="text" class="form-control" id="txtDescripcion" name="descripcion_empresa" maxlength="150">
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="txtTipo">Tipo Empresa</label>
                      <?php
                        if (isset($existeEmpresa) && $existeEmpresa ) { ?>
                          
                          <select id="txtTipo"  name="id_tipo_empresa" value="<?php echo $dataEmpresa->id_tipo_empresa; ?>" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="selected"></option>
                            <option>Alaska</option>
                            
                          </select>
                      <?php } else { ?>
                          <select id="txtTipo"  name="id_tipo_empresa"  class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="selected">Seleccione un Tipo de Empresa</option>
                            <?php foreach($tipo_empresa as $tipo): ?>
                                <option value="<?php echo $tipo->id_tipo_empresa; ?>"><?php echo $tipo->nombre_tipo_empresa; ?></option>
                            <?php endforeach; ?>  
                          </select>
                      <?php } ?>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button id="btnAgregar" type="submit" class="btn btn-primary"><?php echo $modulo->nombreSeccion; ?></button>
                  </div>
                </form>
                <div class="overlay hide" >
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      
      <?php $this->load->view('template/main-panel/footer'); ?>

    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>

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
          
          var baseUrl   = "<?php echo base_url(); ?>";
          var urlApi    = baseUrl + <?php if (isset($idCliente)) { echo '"admin/cliente/update";'; } else { echo '"admin/cliente/insert";'; } ?>
          var formData  = new FormData();
          
          var element = this;
          
          mostrarErrorInputText("#txtCodigoSigne");
          mostrarErrorInputText("#txtRazonSocial");
          mostrarErrorInputText("#txtRUC");
          
          ManagerModal.config("#modalAdmin", "");
          
          if ( $("#txtCodigoSigne").val().length > 0 &&
               $("#txtRazonSocial").val().length > 0 &&
               $("#txtRUC").val().length > 0 ) {
                 
                $(".overlay").removeClass("hide");
                 
                var request = $.ajax({
                  url: urlApi,
                  method: "POST",
                  data: $("#formCliente").serialize(),
                  dataType: "json"
                });
      
                request.done(function( response ) {
                  
                  $(".overlay").addClass("hide");
                  
                  if (response.status) {
                    
                    ManagerModal.show("default", response.message);
                    if (response.action == "insert") {
                      $("#txtCodigoSigne").val("");
                      $("#txtRazonSocial").val("");
                      $("#txtRUC").val("");
                    }
                    
                  } else {
                    ManagerModal.show("danger", response.message);
                  }
                  
                });
      
                request.fail(function( jqXHR, textStatus ) {
                  $(".overlay").addClass("hide");
                  ManagerModal.show("danger", textStatus);
                });
            
          } else {
            ManagerModal.show("danger", "Ingrese los datos de cliente correctamente.");
          }
          
        });

      });
      
    </script> 
  </body>
>>>>>>> 31317dae555c9931be521d0a439ba0be780ca8a1
</html>