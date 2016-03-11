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

        $dataCategorias = $this->cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;
        $modulo->id_categoria_raiz =  $dataCategorias[0]->id_categoria;

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = $this->cargarDatosSubCategorias($dataCategorias[0]->id_categoria);
            $modulo->data_productos = $this->cargarDatosProductos($dataCategorias[0]->id_categoria);
            foreach ($modulo->data_productos as $producto) {
                $producto = $this->cargarGaleriaPorProducto($producto);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-home', $data);
    }

    public function viewSubCategorias($listaCategorias) {
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

        $dataCategorias = $this->cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;

        $listaCategorias = explode(".", $listaCategorias);
        $idCategoriaSuperior = intval($listaCategorias[sizeof($listaCategorias) - 1]);

        $modulo->id_categoria_raiz =  $listaCategorias[0];

        if (sizeof($dataCategorias) > 0) {
            $modulo->data_sub_categorias = $this->cargarDatosSubCategorias($idCategoriaSuperior);
            $modulo->data_productos = $this->cargarDatosProductos($idCategoriaSuperior);
            foreach ($modulo->data_productos as $producto) {
                $producto = $this->cargarGaleriaPorProducto($producto);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-home', $data);
    }

    public function cargarDatosCategoriasPrincipales() {
        return $this->M_Store_Home->getPrimaryCategories($this->uri->segment(2));
    }

    public function cargarDatosSubCategorias($id_categoria_superior) {
        $dataSubCategorias = $this->M_Store_Home->getSubCategories(
            array(
                "id_empresa"            => $this->uri->segment(2),
                "id_categoria_superior" => $id_categoria_superior
            )
        );
        return $dataSubCategorias;
    }

    public function cargarDatosProductos($id_categoria) {
        $dataProductos = $this->M_Store_Home->getProducts(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4),
                "id_categoria"  => $id_categoria
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
            $galeria = new stdClass();
            $galeria->url_archivo = base_url().PATH_RESOURCE_ADMIN."img/image_not_found.png";
            $producto->galeria_producto = array($galeria);
        }
        return $producto;
    }

    public function validarListaCategorias($listaCategorias) {
        $listaCategorias = explode(".", $listaCategorias);
        foreach ($listaCategorias as $categoria) {
            $dataCategoria = $this->M_Store_Home->getCategory($categoria);
        }
    }

}