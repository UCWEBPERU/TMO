<?php $this->load->view('template/main-panel/main-head', $modulo); ?>
<body class="hold-transition skin-blue fixed sidebar-mini fix-padding-scrollbar">
    <div class="wrapper">
        
      <?php 
        $data["modulo"] = $modulo;
        $this->load->view('template/main-panel/header', $data); ?>
      
      <?php 
        $data["menu"]     = $modulo->menu["menu"];
        $data["submenu"]  = $modulo->menu["submenu"];
        $this->load->view('company-admin/v-company-admin-menu', $data); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Agregar Categoria
            <small><a href="<?php echo $modulo->url_module_panel; ?>">Regresar</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="<?php echo $modulo->url_module_panel; ?>"> Categorias</a></li>
            <li> Agregar</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Datos Categoria</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="frmDatosCategoria">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Categoria Superior</label>
                                <select class="form-control select2" style="width: 100%;" name="cboCategoriaSuperior">
                                    <option selected="selected" value="">Seleccione</option>
                                    <?php foreach($modulo->data_categorias as $categoria): ?>
                                    <option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label for="txtNombreCategoria">Nombre Categoria</label>
                                <input type="text" class="form-control" id="txtNombreCategoria" name="txtNombreCategoria" data-parsley-required data-parsley-required-message="Ingrese el nombre de la categoria.">
                            </div><!-- /.form-group -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="button-effect-1" id="btnAgregar" >Agregar</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
      <?php $this->load->view('template/main-panel/footer'); ?>
    </div><!-- ./wrapper -->
    <?php $this->load->view('template/main-panel/modal-admin'); ?>
    <?php $this->load->view('template/main-panel/scripts-footer'); ?>
    <!-- Parsley -->
    <!--<script src="http://parsleyjs.org/dist/parsley.min.js" type="text/javascript" ></script>-->
    <script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $(".select2").select2();
        
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
            var selectorInputsForm = ["#txtNombreCategoria"];
            
            $("#btnAgregar").on("click", function(evt){
                evt.preventDefault();
                
                if (validateInputsForm(selectorInputsForm)) {
                    waitingDialog.show('Guardando Categoria...');
                    var request = $.ajax({
                        url: "<?php echo $modulo->url_module_panel."/ajax/addCategory"; ?>",
                        method: "POST",
                        data: $("#frmDatosCategoria").serialize(),
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
        });
        
    </script>
  </body>
</html>