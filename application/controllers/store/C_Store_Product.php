<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('store/h_store');
        $this->load->library('session');
        $this->load->model('store/M_Store');
        $this->load->library('utils/UserSession');
    }

    public function viewProduct($idProducto) {
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);
        $modulo->has_user_session = $this->usersession->isClient(); 

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


        if (sizeof($dataCategorias) > 0) {
            $modulo->data_productos = cargarDatosProducto($idProducto);
            if (sizeof($modulo->data_productos) > 0) {
                $producto = cargarGaleriaPorProducto($modulo->data_productos[0]);
                $dataCategoria = $this->M_Store->getCategory(
                    array(
                        "id_categoria"          => $modulo->data_productos[0]->id_categoria,
                        "id_empresa"            => $this->uri->segment(2)
                    )
                );
                $modulo->url_button_back = generarUrlSubCategoria($modulo->base_url_store, $dataCategoria[0]->id_categoria, $dataCategoria[0]->id_categoria_superior);
                $dataModifiers = $this->M_Store->getModifiers(
                    array(
                        "id_producto" => $producto->id_producto
                    )
                );
                $dataModifiers = configurarColorModificadores($dataModifiers);
                $modulo->data_modifiers = $dataModifiers;
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-product-detail', $data);
    }

    public function viewProductPromotions($idProducto) {
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);
        $modulo->has_user_session = $this->usersession->isClient();

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


        if (sizeof($dataCategorias) > 0) {
            $modulo->data_productos = cargarDatosProducto($idProducto);
            if (sizeof($modulo->data_productos) > 0) {
                $producto = cargarGaleriaPorProducto($modulo->data_productos[0]);
                $dataCategoria = $this->M_Store->getCategory(
                    array(
                        "id_categoria"          => $modulo->data_productos[0]->id_categoria,
                        "id_empresa"            => $this->uri->segment(2)
                    )
                );
                $modulo->url_button_back = generarUrlSubCategoria($modulo->base_url_store, $dataCategoria[0]->id_categoria, $dataCategoria[0]->id_categoria_superior);
                $dataModifiers = $this->M_Store->getModifiers(
                    array(
                        "id_producto" => $producto->id_producto
                    )
                );
                var_dump($dataModifiers);
                $dataModifiers = configurarColorModificadores($dataModifiers);
                $modulo->data_modifiers = $dataModifiers;
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-promotions-detail', $data);
    }

}