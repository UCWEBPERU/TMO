<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('store/h_store');
        $this->load->library('session');
        $this->load->model('store/M_Store');
    }

    public function index() {

        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);

//        $dataEmpresa = $this->M_Store->getCompanyAndStore(
//            array(
//                "id_empresa"    => $this->uri->segment(2),
//                "id_tienda"     => $this->uri->segment(4)
//            )
//        );
//
//        if (sizeof($dataEmpresa) == 0) {
//            redirect("not-found/store");
//        }
//
//        $modulo->data_empresa = $dataEmpresa[0];
//
//        $dataCategorias = cargarDatosCategoriasPrincipales();
//        $modulo->data_categorias = $dataCategorias;
//
//        $rutaPlantilla = "";
//
//        if ($this->input->get("s")) { // cargar resultados de busquedas
//            $this->cargarVistaResultadoBusqueda($modulo, $rutaPlantilla);
//        } else { // cargar vista por defecto de busquedas
//            $this->cargarVistaBusqueda($modulo, $rutaPlantilla);
//        }

        $data["modulo"] = $modulo;

//        $this->load->view($rutaPlantilla, $data);
        $this->load->view("store/v-store-search", $data);
    }

    public function cargarVistaBusqueda($modulo, &$rutaPlantilla) {
        $rutaPlantilla = "store/v-store-search";

        $dataSubCategorias = $this->M_Store->getCategories(
            array(
                "id_empresa"    => $this->uri->segment(2)
            )
        );

        $dataSubCategorias = filtrarSubCategorias($dataSubCategorias);
        $modulo->data_sub_categorias = $dataSubCategorias;

        foreach ($modulo->data_sub_categorias as $sub_categoria) {
            $sub_categoria->url_categoria = generarUrlSubCategoria($modulo->base_url_store, $sub_categoria->id_categoria, $sub_categoria->id_categoria_superior);
        }
    }

    public function cargarVistaResultadoBusqueda($modulo, &$rutaPlantilla) {
        $rutaPlantilla = "store/v-store-search-result";

        $modulo->keyrwords_search = $this->input->get("s");


        $dataProductos = $this->M_Store->getProductByName(
            array(
                "id_empresa"        => $this->uri->segment(2),
                "id_tienda"         => $this->uri->segment(4),
                "nombre_producto"   => $this->input->get("s")
            )
        );

        $modulo->data_productos = $dataProductos;

        foreach ($modulo->data_productos as $producto) {
            $producto = cargarGaleriaPorProducto($producto);
        }
    }

}