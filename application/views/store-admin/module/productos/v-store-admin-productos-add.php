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
            Agregar Producto
            <small><a href="<?php echo $modulo->url_main_panel; ?>/products">Regresar</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $modulo->url_main_panel; ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="<?php echo $modulo->url_main_panel; ?>/products"> Productos</a></li>
            <li> Agregar</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Datos Producto</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="frmDatosCategoria">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="txtNombreCategoria">Nombre</label>
                                <input type="text" class="form-control" id="txtNombreCategoria" name="txtNombreCategoria" data-parsley-required data-parsley-required-message="Ingrese el nombre de la categoria.">
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label for="txtNombreCategoria">Descripcion</label>
                                <input type="text" class="form-control" id="txtNombreCategoria" name="txtNombreCategoria" data-parsley-required data-parsley-required-message="Ingrese el nombre de la categoria.">
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label for="txtNombreCategoria">Stock</label>
                                <input type="text" class="form-control" id="txtNombreCategoria" name="txtNombreCategoria" data-parsley-required data-parsley-required-message="Ingrese el nombre de la categoria.">
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label for="txtNombreCategoria">Precio</label>
                                <input type="text" class="form-control" id="txtNombreCategoria" name="txtNombreCategoria" data-parsley-required data-parsley-required-message="Ingrese el nombre de la categoria.">
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control select2" style="width: 100%;" id="cboCategorias" name="cboCategorias">
                                    <option selected="selected" value="">Seleccione</option>
                                    <?php foreach($modulo->data_categorias as $categoria): ?>
                                    <option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label>Sub Categoria</label>
                                <select class="form-control select2" style="width: 100%;" id="cboSubCategoria" name="cboSubCategoria">
                                    <option selected="selected" value="">Seleccione</option>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="button-effect-1" id="btnAgregar" >Agregar</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!-- /.col -->
            
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Galeria Producto</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body box-galery-products">
                        
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="btn button-effect-1 btn-file">
                            <i class="fa fa-photo"></i> Upload new image
                            <input type="file" id="btnAddImage" accept="image/*">
                        </div>
                    </div>
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
    <script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
    <!-- Handle File -->
    <script src="<?php echo PATH_RESOURCE_ADMIN; ?>js/HandleFile.js"></script>
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
            var contadorImagenes = 1;
            var formDataProduct = new FormData();
            
            $("#btnAgregar").on("click", function(evt){
                evt.preventDefault();
                
                if (validateInputsForm(selectorInputsForm)) {
                    waitingDialog.show('Guardando Categoria...');
                    var request = $.ajax({
                        url: "<?php echo $modulo->url_main_panel."/categorys/ajax/addCategory"; ?>",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: formDataProduct
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
            
            var objHandleFile = new HandleFile("#btnAddImage");
            objHandleFile.onSelect(
                function(file) {
                    formData.append("file_" + contadorImagenes, file);
                    console.log("Nombre File" + "file_" + contadorImagenes);
                },
                function(readResult) {
                    var html = "<div class='col-md-4 col-sm-4 col-xs-12'>" +
                               "<img id='' class='' src='" + readResult + "' alt='Image Product' title='Image Product'>" +
                               "</div>";
                    $(".box-galery-products").append(html);
                    // $("#logoStore").attr("src", readResult);
                }
            );
            
            $("#cboCategorias").on("select2:select", function (event) { 
                var formDataCategory = new FormData();
                
                formDataCategory.append("id_categoria", event.params.data.id);
                var request = $.ajax({
                    url: "<?php echo $modulo->url_main_panel."/products/ajax/getSubCategorys"; ?>",
                    method: "POST",
                    data: formDataCategory,
                    dataType: "json",
                    processData: false,
                    contentType: false
                });

                request.done(function( response ) {
                    waitingDialog.hide();
                    console.log(response.data);
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
            });
        });
    </script>
  </body>
</html>