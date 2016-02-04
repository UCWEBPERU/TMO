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
            Categoria: <?php echo $modulo->data_categoria->nombre_categoria; ?>
            <small><a href="<?php echo $modulo->url_main_panel; ?>/categorys">Regresar</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="<?php echo $modulo->url_main_panel; ?>/categorys"> Categorias</a></li>
            <li class="active"> Sub Categorias</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <?php foreach($modulo->data_sub_categorias as $sub_categoria): ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a class="link-shorcut" href="<?php echo $modulo->url_main_panel.'/categorys/edit/'.intval($sub_categoria->id_categoria); ?>">
                    <div class="info-box boxCategory">
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool btn-box-tool-delete" data-widget="remove" data-id-cat="<?php echo intval($sub_categoria->id_categoria); ?>" title="Eliminar"><i class="fa fa-remove"></i></button>
                        </div>
                        <span class="info-box-icon bg-aqua"><i class="fa fa-tags"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?php echo $sub_categoria->nombre_categoria; ?></span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </a>
            </div><!-- /.col -->
            <?php endforeach; ?>
          </div><!-- /.row -->
          
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      <?php $this->load->view('template/main-panel/footer'); ?>
    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>
    <!-- Sweet Alert -->
    <script src="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.min.js"></script>
    <script>
        (function($){
            $(".btn-box-tool-delete").on("click", function(){
                var self = this;
                swal({
                        title: "Eliminar Sub Categoria",
                        text: "¿Seguro que desea eliminar Sub categoria?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#fc0836",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, 
                    function() {
                        var formData  = new FormData();
                        formData.append("id_categoria", $(self).attr("data-id-cat"));
                        var request = $.ajax({
                            url: "<?php echo $modulo->url_main_panel."/categorys/ajax/deleteCategory"; ?>",
                            method: "POST",
                            data: formData,
                            dataType: "json",
                            processData: false,
                            contentType: false
                        });

                        request.done(function( response ) {
                            waitingDialog.hide();
                            if (response.status) {
                                swal("Eliminado!", response.message, "success");
                                $(self).parent().parent().hide("slow", function(){
                                    $(self).parent().parent().parent().parent().remove();
                                });
                            } else {
                                swal("Error", response.message, "error");
                            }
                        });

                        request.fail(function( jqXHR, textStatus ) {
                            waitingDialog.hide();
                            swal("Error", textStatus, "error");
                        });
                    }
                );
            });
            
        })(jQuery);
    </script>
  </body>
</html>