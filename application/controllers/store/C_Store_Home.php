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

        $modulo->data_empresa = $dataEmpresa[0];

        $dataCategorias = cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;
        $modulo->id_categoria_raiz = $dataCategorias[0]->id_categoria;
        $modulo->data_navegacion_sub_categorias = array();

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = cargarDatosSubCategorias();
//            $modulo->data_productos = cargarDatosProductos();
//            foreach ($modulo->data_productos as $producto) {
//                $producto = cargarGaleriaPorProducto($producto);
//            }
            foreach ($modulo->data_sub_categorias as $sub_categoria) {
                $sub_categoria->url_categoria = generarUrlSubCategoria($modulo->base_url_store, $sub_categoria->id_categoria, $sub_categoria->id_categoria_superior);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-home', $data);
    }

    public function promotions() {
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

        $modulo->data_empresa = $dataEmpresa[0];


        $dataCategorias = cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;
        $modulo->id_categoria_raiz = $dataCategorias[0]->id_categoria;
        $modulo->data_navegacion_sub_categorias = array();

        $modulo->tipo_sub_categorias = "promotions";

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = cargarDatosSubCategorias($dataCategorias[0]->id_categoria);
//            $modulo->data_productos = cargarDatosProductosConPromocion();
//            foreach ($modulo->data_productos as $producto) {
//                $producto = cargarGaleriaPorProducto($producto);
//            }
            foreach ($modulo->data_sub_categorias as $sub_categoria) {
                $sub_categoria->url_categoria = generarUrlSubCategoria($modulo->base_url_store, $sub_categoria->id_categoria, $sub_categoria->id_categoria_superior);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-promotions', $data);
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

        $dataCategorias = cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;
        $modulo->id_categoria_raiz = $listaCategorias[0];
        $modulo->data_navegacion_sub_categorias = generarNavegacionSubCategorias($modulo->base_url_store, $listaCategorias);
        $idCategoriaSuperior = intval($listaCategorias[sizeof($listaCategorias) - 1]);

        $modulo->tipo_sub_categorias = "products";

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = cargarDatosSubCategoriaSeleccionada($idCategoriaSuperior);
            $modulo->data_productos = cargarDatosProductosbyCategory($idCategoriaSuperior);
            foreach ($modulo->data_productos as $producto) {
                $producto = cargarGaleriaPorProducto($producto);
            }
            foreach ($modulo->data_sub_categorias as $sub_categoria) {
                $sub_categoria->url_categoria = generarUrlSubCategoria($modulo->base_url_store, $sub_categoria->id_categoria, $sub_categoria->id_categoria_superior);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-subcategories', $data);
    }

    public function viewSubCategoriasPromotions($listaCategorias) {
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

        $dataCategorias = cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;
        $modulo->id_categoria_raiz = $listaCategorias[0];
        $modulo->data_navegacion_sub_categorias = generarNavegacionSubCategorias($modulo->base_url_store, $listaCategorias);
        $idCategoriaSuperior = intval($listaCategorias[sizeof($listaCategorias) - 1]);

        $modulo->tipo_sub_categorias = "promotions";

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = cargarDatosSubCategoriaSeleccionada($idCategoriaSuperior);
            $modulo->data_productos = cargarDatosProductosConPromocion($idCategoriaSuperior);
            foreach ($modulo->data_productos as $producto) {
                $producto = cargarGaleriaPorProducto($producto);
            }
            foreach ($modulo->data_sub_categorias as $sub_categoria) {
                $sub_categoria->url_categoria = generarUrlSubCategoria($modulo->base_url_store, $sub_categoria->id_categoria, $sub_categoria->id_categoria_superior);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-subcategories', $data);
    }

}