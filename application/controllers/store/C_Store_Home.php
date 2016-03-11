<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('store/M_Store_Home');
    }

    public function index() {
        $modulo = new stdClass();

        $dataEmpresa = $this->M_Store_Home->getCompanyAndStore(
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

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = cargarDatosSubCategorias($dataCategorias);
            $modulo->data_productos = cargarDatosProductos($dataCategorias);
            foreach ($modulo->data_productos as $producto) {
                $producto = cargarGaleriaPorProducto($producto);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-home', $data);
    }

    public function viewSubCategorias() {
        $modulo = new stdClass();

        $dataEmpresa = $this->M_Store_Home->getCompanyAndStore(
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

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = cargarDatosSubCategorias($dataCategorias);
            $modulo->data_productos = cargarDatosProductos($dataCategorias);
            foreach ($modulo->data_productos as $producto) {
                $producto = cargarGaleriaPorProducto($producto);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-home', $data);
    }

    public function cargarDatosCategoriasPrincipales() {
        return $this->M_Store_Home->getPrimaryCategories($this->uri->segment(2));
    }

    public function cargarDatosSubCategorias($dataCategorias) {
        $dataSubCategorias = $this->M_Store_Home->getSubCategories(
            array(
                "id_empresa"            => $this->uri->segment(2),
                "id_categoria_superior" => $dataCategorias[0]->id_categoria
            )
        );
        return $dataSubCategorias;
    }

    public function cargarDatosProductos($dataCategorias) {
        $dataProductos = $this->M_Store_Home->getProducts(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4),
                "id_categoria"  => $dataCategorias[0]->id_categoria
            )
        );
        return $dataProductos;
    }

    public function cargarGaleriaPorProducto($producto) {
        $geleriaProducto = $this->M_Store_Home->getGalleryByProduct(
            array(
                "id_producto"    => $producto->id_producto
            )
        );

        if (sizeof($geleriaProducto) > 0) {
            $producto->galeria_producto = $geleriaProducto;
        } else {
            $producto->galeria_producto = array(
                "url_archivo" => base_url().PATH_RESOURCE_ADMIN."img/image_not_found.png"
            );
        }
        return $producto;
    }

}