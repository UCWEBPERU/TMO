<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TMO | Panel Administrativo - <?php 
      for ($i = 0; $i < count($modulo->navegacion); $i++) {
        if ($i == count($modulo->navegacion) - 1) {
          echo $modulo->navegacion[$i]["nombre"];
        } else {
          echo $modulo->navegacion[$i]["nombre"]." - ";
        }
      } ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <base href="<?php echo base_url();?>">
    <link rel="icon" href="<?php echo PATH_RESOURCE_ADMIN; ?>img/icon/icon_app.png" type="image/png">
    
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_BOOTSTRAP; ?>css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_DIST; ?>css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <!--<link rel="stylesheet" href="<?php echo PATH_RESOURCE_DIST; ?>css/skins/_all-skins.min.css">-->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_DIST; ?>css/skins/skin-green.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <?php $this->load->view('admin/template/main-panel/header'); ?>
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