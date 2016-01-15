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
            <li class="active"><a href="<?php echo base_url(); ?>admin/tipoempresa"> Tipo Empresa</a> </li>
            <li><?php echo strtolower($modulo->nombreSeccion); ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $modulo->nombreSeccion; ?> Tipo Empresa</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="formTipoEmpresa" role="form">
                  <?php 
                  if ( isset($idTipo) ) { ?>
                    <input type="hidden" name="id_tipo" value="<?php echo $idTipo; ?>">
                  <?php } ?>
                 <div class="box-body">
                    <?php
                      if (isset($existeTipo) && !$existeTipo ) { ?>
                        <div class="alert alert-danger alert-dismissible">
                          <h4><i class="icon fa fa-ban"></i> No existe el Tipo!</h4>
                          Lo sentimos el Tipo que desea editar no existe.<br>
                          <strong>No intente modificar la direccion url :D</strong>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                      <label for="nombre_tipo_empresa">Nombre de Tipo de Empresa</label>
                      <?php
                        if (isset($existeTipo) && $existeTipo ) { ?>
                          <input type="text" class="form-control" id="nombre_tipo_empresa" name="nombre_tipo_empresa" maxlength="" value="<?php echo $dataTipo->nombre_tipo_empresa; ?>">
                      <?php } else { ?>
                          <input type="text" class="form-control" id="nombre_tipo_empresa" name="nombre_tipo_empresa" maxlength="">
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
          var urlApi    = baseUrl + <?php if (isset($idTipo)) { echo '"editar";'; } else { echo '"crear";'; } ?>
          var formData  = new FormData();
          
          var element = this;
          
          mostrarErrorInputText("#nombre_tipo_empresa");
          
          
          ManagerModal.config("#modalAdmin", "");
          
          if ( $("#nombre_tipo_empresa").val().length > 0) {
                
                $(".overlay").removeClass("hide");
                 
                var request = $.ajax({
                  url: urlApi,
                  method: "POST",
                  data: $("#formTipoEmpresa").serialize(),
                  dataType: "json"
                });
      
                request.done(function( response ) {
                  
                  $(".overlay").addClass("hide");
                  
                  if (response.status) {
                    
                    ManagerModal.show("default", response.message);
                    if (response.action == "insert") {
                      $("#nombre_tipo_empresa").val("");
                      
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
            ManagerModal.show("danger", "Ingrese los datos del Tipo de Empresa correctamente.");
          }
          
        });

      });
      
    </script> 
  </body>
</html>