<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
        
      <?php 
        $data["menu"]     = $modulo->menu["menu"];
        $data["submenu"]  = $modulo->menu["submenu"];
        $this->load->view('admin/template/main-panel/menu', $data); 
      ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $modulo->titulo; ?>
            <small><a href="<?php echo base_url().$modulo->base_url; ?>agregar">Agregar</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <?php foreach ($modulo->navegacion as $navegacion) {
                    if ($navegacion["activo"]) { ?>
                      <li class="active"><?php echo $navegacion["nombre"]; ?></li>
              <?php } else { 
                      if (strlen($navegacion["url"]) > 0) { ?>
                        <li><a href="<?php echo base_url().$navegacion["url"]; ?>"><?php echo $navegacion["nombre"]; ?></a></li>
                <?php } else { ?>
                        <li><?php echo $navegacion["nombre"]; ?></li>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $modulo->titulo_registro; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                                         
                      <?php foreach ($modulo->cabecera_registro as $nombreCabecera) { ?>
                        <th><?php echo $nombreCabecera; ?></th>
                      <?php } ?>
                      
                      <th></th>
                    </tr>
                    <?php 
                    $registros["registros"] = $modulo->registros;
                    $registros["moduloNombre"] = $modulo->nombre;
                    $this->load->view($modulo->ruta_plantilla_registro, $registros); ?>
                    
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <!-- Show pagination links -->
                    <?php 
                      foreach ($modulo->links as $link) {
                        echo "<li>". $link."</li>";
                      } 
                    ?>
                  </ul>
                </div>
                <div class="overlay hide" >
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </div><!-- /.box -->
              
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?php $this->load->view('admin/template/main-panel/footer'); ?>
      
    </div><!-- ./wrapper -->
    
    <?php $this->load->view('admin/template/main-panel/modal-admin'); ?>
    <?php $this->load->view('admin/template/main-panel/scripts-footer'); ?>
    
    <script>
			$(function () {
        ManagerModal.config("#modalAdmin", "");
				$(".btnActionRow").on("click", function(evt){
          
          var baseUrl   = "<?php echo base_url(); ?>";
          var urlApi    = "";
          var formData  = new FormData();
          
          var element = this;
          
          if ( $(this).attr("data-row-action") == "edit") {
            
          } else if ( $(this).attr("data-row-action") == "delete") {
            evt.preventDefault();
            $(".overlay").removeClass("hide");
            urlApi = baseUrl + "<?php echo $modulo->base_url; ?>delete";
            formData.append("<?php echo $modulo->api_rest_params["delete"]; ?>", $(this).attr("data-row-id"));
          }
          
          var request = $.ajax({
            url: urlApi,
            method: "POST",
            processData: false,
            contentType: false,
            data: formData
          });

          request.done(function( response ) {
            $(".overlay").addClass("hide");
            var json = JSON.parse(response);
            if (json.status) {
              $(element).parent().parent().fadeOut("slow", function() {
                $(element).parent().parent().remove();
              });
            } else {
              ManagerModal.show("danger", json.message);
            }
            
          });

          request.fail(function( jqXHR, textStatus ) {
            $(".overlay").addClass("hide");
            var json = JSON.parse(textStatus);
            ManagerModal.show("danger", json.message);
          });
          
				});

			});
		</script>
    
  </body>
</html>