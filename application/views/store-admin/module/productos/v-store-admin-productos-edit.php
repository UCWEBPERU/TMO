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
                            <?php if (sizeof($modulo->data_producto) == 0) { ?>
                            <div class="callout callout-danger">
                                <h4>No existe el producto!</h4>
                                <p>Lo sentimos el producto que intenta editar no existe.</p>
                            </div>
                            <?php } else { ?>
                            <input type="hidden" class="form-control" name="id_producto" value="<?php echo $modulo->data_producto[0]->id_producto; ?>">
                            <?php } ?>
                            <div class="form-group">
                                <label for="txtNombreProducto">Nombre</label>
                                <?php if (sizeof($modulo->data_producto) > 0) { ?>
                                <input type="text" class="form-control" id="txtNombreProducto" name="txtNombreProducto" value="<?php echo $modulo->data_producto[0]->nombre_producto; ?>" data-parsley-required data-parsley-required-message="Ingrese el nombre del producto.">
                                <?php } else { ?>
                                <input type="text" class="form-control" id="txtNombreProducto" name="txtNombreProducto" data-parsley-required data-parsley-required-message="Ingrese el nombre del producto.">
                                <?php } ?>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label for="txtDescripcionProducto">Descripcion</label>
                                <?php if (sizeof($modulo->data_producto) > 0) { ?>
                                <input type="text" class="form-control" id="txtDescripcionProducto" name="txtDescripcionProducto" value="<?php echo $modulo->data_producto[0]->descripcion_producto; ?>" data-parsley-required data-parsley-required-message="Ingrese la descripcion del producto.">
                                <?php } else { ?>
                                <input type="text" class="form-control" id="txtDescripcionProducto" name="txtDescripcionProducto" data-parsley-required data-parsley-required-message="Ingrese la descripcion del producto.">
                                <?php } ?>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label for="txtStockProducto">Stock</label>
                                <?php if (sizeof($modulo->data_producto) > 0) { ?>
                                <input type="text" class="form-control" id="txtStockProducto" name="txtStockProducto" value="<?php echo $modulo->data_producto[0]->stock; ?>" data-parsley-required data-parsley-required-message="Ingrese el stock del producto.">
                                <?php } else { ?>
                                <input type="text" class="form-control" id="txtStockProducto" name="txtStockProducto" data-parsley-required data-parsley-required-message="Ingrese el stock del producto.">
                                <?php } ?>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label for="txtPrecioProducto">Precio</label>
                                <?php if (sizeof($modulo->data_producto) > 0) { ?>
                                <input type="text" class="form-control" id="txtPrecioProducto" name="txtPrecioProducto" value="<?php echo $modulo->data_producto[0]->precio_producto; ?>" data-parsley-required data-parsley-required-message="Ingrese el precio del producto.">
                                <?php } else { ?>
                                <input type="text" class="form-control" id="txtPrecioProducto" name="txtPrecioProducto" data-parsley-required data-parsley-required-message="Ingrese el precio del producto.">
                                <?php } ?>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control select2" style="width: 100%;" id="cboCategorias" name="cboCategorias">
                                    <?php if (sizeof($modulo->data_categoria_producto) > 0) { var_dump($modulo->data_categoria_producto[0]);?>
                                        <option value="">Seleccione</option>
                                        <?php foreach($modulo->data_categorias as $categoria): ?>
                                            <?php if (intval($modulo->data_categoria_producto[0]->id_categoria) == intval($categoria->id_categoria)) { ?>
                                                <option selected="selected" value="<?php echo intval($categoria->id_categoria); ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                            <?php } else { ?>
                                                <option  value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <option selected="selected" value="">Seleccione</option>
                                        <?php foreach($modulo->data_categorias as $categoria): ?>
                                            <option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </select>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label>Sub Categoria</label>
                                <select class="form-control select2" style="width: 100%;" id="cboSubCategorias" name="cboSubCategorias" data-parsley-required data-parsley-required-message="Seleccion la categoria del producto.">
                                    <option value="">Seleccione</option>
                                    <?php if (sizeof($modulo->data_subcategoria_producto) > 0) { ?>
                                    <option selected="selected" value="<?php echo $modulo->data_subcategoria_producto[0]->id_categoria; ?>"><?php echo $modulo->data_subcategoria_producto[0]->nombre_categoria; ?></option>
                                    <?php } ?>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="button-effect-1" id="btnAgregar" >Guardar</button>
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
                        <?php if (sizeof($modulo->data_producto) > 0) { ?>
                        <?php foreach($modulo->data_galeria_producto as $imagen): ?>
                        <div class="col-md-4 col-sm-4 col-xs-12 box-image">
                            <button class="btn btn-box-tool btn-box-tool-delete" data-widget="remove" data-id-archivo="<?php echo intval($imagen->id_archivo); ?>" title="Eliminar"><i class="fa fa-remove"></i></button>
                            <img id='' class='' src="<?php echo $imagen->url_archivo; ?>" alt="<?php echo $imagen->nombre_archivo; ?>" title="<?php echo $imagen->nombre_archivo; ?>">
                        </div>
                        <?php endforeach; ?>
                        <?php }?>
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
            var selectorInputsForm = ["#txtNombreProducto", "#txtDescripcionProducto", "#txtStockProducto", "#txtPrecioProducto", "#cboSubCategorias"];
            var contadorImagenes = 1;
            var formDataProduct = new FormData();
            
            $("#btnAgregar").on("click", function(evt){
                evt.preventDefault();
                
                if (validateInputsForm(selectorInputsForm)) {
                    waitingDialog.show('Guardando Producto...');
                    
                    formDataProduct.append("txtNombreProducto", $("#txtNombreProducto").val());
                    formDataProduct.append("txtDescripcionProducto", $("#txtDescripcionProducto").val());
                    formDataProduct.append("txtStockProducto", $("#txtStockProducto").val());
                    formDataProduct.append("txtPrecioProducto", $("#txtPrecioProducto").val());
                    formDataProduct.append("cboSubCategorias", $("#cboSubCategorias").val());
                    
                    var request = $.ajax({
                        url: "<?php echo $modulo->url_main_panel."/products/ajax/editProduct"; ?>",
                        method: "POST",
                        data: formDataProduct,
                        dataType: "json",
                        processData: false,
                        contentType: false
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
                    formDataProduct.append("file_" + contadorImagenes, file);
                    console.log("Nombre File" + "file_" + contadorImagenes);
                    console.log("File Size: " + file.size );
                    var imageData = new ImageData(file, 128, 128); // Creates a 100x100 black rectangle
                },
                function(readResult) {
                    var html = "<div class='col-md-4 col-sm-4 col-xs-12 box-image'>" +
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
                    $("#cboSubCategorias").empty();
                    // $("#cboSubCategorias").val("").trigger("change");
                    var html = "<option selected='selected' value=''>Seleccione</option>";
                    if (response.status) {
                        for (var i=0; i < response.data.length; i++) { 
                            html += "<option value='" + response.data[i].id_categoria + "'>" + response.data[i].nombre_categoria + "</option>";
                        }
                    }
                    $("#cboSubCategorias").append(html);
                });

                request.fail(function( jqXHR, textStatus ) {
                    waitingDialog.hide();
                    GenericModal.show("danger", "<p>" + textStatus + "</p>");
                });
            });
            
            $("#cboSubCategorias").on("select2:select", function (event) { 
                // alert($(this).val() + " " + event.params.data.id);
            });
        });
    </script>
  </body>
</html>