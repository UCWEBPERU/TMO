<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('store/M_Store_Home');
        $this->load->model('store/M_Store_Product');
    }

    public function viewProduct($idProducto) {
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);

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
        $modulo->id_categoria_raiz = $dataCategorias[0]->id_categoria;


        if (sizeof($dataCategorias) > 0) {
            $modulo->data_productos = $this->cargarDatosProducto($idProducto);
            if (sizeof($modulo->data_productos) > 0) {
                $producto = $this->cargarGaleriaPorProducto($modulo->data_productos[0]);
                $dataCategoria = $this->M_Store_Home->getCategory(
                    array(
                        "id_categoria"          => $modulo->data_productos[0]->id_categoria,
                        "id_empresa"            => $this->uri->segment(2)
                    )
                );
                $modulo->url_button_back = $this->generarUrlSubCategoria($modulo->base_url_store, $dataCategoria[0]->id_categoria, $dataCategoria[0]->id_categoria_superior);
                $dataModifiers = $this->M_Store_Home->getModifiers(
                    array(
                        "id_producto" => $producto->id_producto
                    )
                );
                $modulo->data_modifiers = $dataModifiers;
                var_dump($dataModifiers);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-product-detail', $data);
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

    public function cargarDatosProducto($idProducto) {
        $dataProductos = $this->M_Store_Product->getProduct(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4),
                "id_producto"   => $idProducto
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

    public function generarUrlSubCategoria($url_store, $id_categoria, $id_categoria_superior){
        $idCategoria         = $id_categoria;
        $idCategoriaSuperior = $id_categoria_superior;
        $urlIdCategorias     = intval($idCategoria);

        while ( $idCategoriaSuperior != 0 ) {
            $dataCategoria = $this->M_Store_Home->getCategory(
                array(
                    "id_categoria"          => $idCategoriaSuperior,
                    "id_empresa"            => $this->uri->segment(2)
                )
            );

            if ( sizeof($dataCategoria) > 0 ) {
                $idCategoria            = intval($dataCategoria[0]->id_categoria);
                $idCategoriaSuperior    = intval($dataCategoria[0]->id_categoria_superior);
                $urlIdCategorias        = $idCategoria.".".$urlIdCategorias;
            } else {
                $urlIdCategorias = substr($urlIdCategorias, 1);
                $idCategoriaSuperior = 0;
            }
        }

        $urlIdCategorias = $url_store."/categories/".$urlIdCategorias;

        return $urlIdCategorias;
    }

}