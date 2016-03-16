<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
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

        $dataCategorias = $this->cargarDatosCategoriasPrincipales();
        $modulo->data_categorias = $dataCategorias;

        if (sizeof($dataCategorias) > 0) {
            $dataSubCategorias = $this->M_Store->getCategories(
                array(
                    "id_empresa"    => $this->uri->segment(2)
                )
            );

            $dataSubCategorias = $this->seleccionarSubCategorias($dataSubCategorias);
            $modulo->data_sub_categorias = $dataSubCategorias;

            foreach ($modulo->data_sub_categorias as $sub_categoria) {
                $sub_categoria->url_categoria = $this->generarUrlSubCategoria($modulo->base_url_store, $sub_categoria->id_categoria, $sub_categoria->id_categoria_superior);
            }
        }

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-search', $data);
    }

    public function cargarDatosCategoriasPrincipales() {
        return $this->M_Store->getPrimaryCategories($this->uri->segment(2));
    }

    public function seleccionarSubCategorias($dataSubCategorias) {
        $nuevaListaSubCategorias = array();
        for ( $c = 0; $c < sizeof($dataSubCategorias); $c++ ) {
            if ( intval($dataSubCategorias[$c]->nivel_categoria) != 1 ) { // Buscar Sub Categorias
                array_push($nuevaListaSubCategorias, $dataSubCategorias[$c]);
            }
        }
        return $nuevaListaSubCategorias;
    }

    public function generarUrlSubCategoria($url_store, $id_categoria, $id_categoria_superior){
        $idCategoria         = $id_categoria;
        $idCategoriaSuperior = $id_categoria_superior;
        $urlIdCategorias     = intval($idCategoria);

        while ( $idCategoriaSuperior != 0 ) {
            $dataCategoria = $this->M_Store->getCategory(
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