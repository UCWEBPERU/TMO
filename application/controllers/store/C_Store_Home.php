<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Home extends CI_Controller {

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

        $dataEmpresa = $this->M_Store->getCompanyAndStore(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        $dataCategorias = cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;
        $modulo->id_categoria_raiz = $dataCategorias[0]->id_categoria;
        $modulo->data_navegacion_sub_categorias = array();

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = cargarDatosSubCategorias($dataCategorias[0]->id_categoria);
            $modulo->data_productos = cargarDatosProductos($dataCategorias[0]->id_categoria);
            foreach ($modulo->data_productos as $producto) {
                $producto = cargarGaleriaPorProducto($producto);
            }
            foreach ($modulo->data_sub_categorias as $sub_categoria) {
                $sub_categoria->url_categoria = generarUrlSubCategoria($modulo->base_url_store, $sub_categoria->id_categoria, $sub_categoria->id_categoria_superior);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-home', $data);
    }

    public function viewSubCategorias($listaCategorias) {
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);
        $listaCategorias = explode(".", $listaCategorias);

        $dataEmpresa = $this->M_Store->getCompanyAndStore(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        $dataCategorias = $this->cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;
        $modulo->id_categoria_raiz = $listaCategorias[0];
        $modulo->data_navegacion_sub_categorias = $this->generarNavegacionSubCategorias($modulo->base_url_store, $listaCategorias);
        $idCategoriaSuperior = intval($listaCategorias[sizeof($listaCategorias) - 1]);

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = $this->cargarDatosSubCategorias($idCategoriaSuperior);
            $modulo->data_productos = $this->cargarDatosProductos($idCategoriaSuperior);
            foreach ($modulo->data_productos as $producto) {
                $producto = $this->cargarGaleriaPorProducto($producto);
            }
            foreach ($modulo->data_sub_categorias as $sub_categoria) {
                $sub_categoria->url_categoria = $this->generarUrlSubCategoria($modulo->base_url_store, $sub_categoria->id_categoria, $sub_categoria->id_categoria_superior);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-home', $data);
    }

}