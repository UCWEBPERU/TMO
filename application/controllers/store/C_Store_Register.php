<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('store/h_store');
        $this->load->library('session');
        $this->load->library('user_agent');
        $this->load->model('store/M_Store');
        $this->load->model("M_Archivo");
    }

    public function index() {
        $modulo = new stdClass();
        $modulo->base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);
        $modulo->previuos_url = $this->agent->referrer();

        $dataEmpresa = $this->M_Store->getCompanyAndStore(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4)
            )
        );

        if (sizeof($dataEmpresa) == 0) {
            redirect("not-found/store");
        }

        cargarLogoEmpresa($modulo, $dataEmpresa[0]);

        $data["modulo"] = $modulo;

        $this->load->view('store/v-store-register', $data);
    }

    public function ajaxRegister() {
        $json 				= new stdClass();
        $json->type 		= "Modifier Producto";
        $json->presentation = "";
        $json->action 		= "delete";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtFirstName") &&
            $this->input->post("txtLastName") &&
            $this->input->post("txtEmail") &&
            $this->input->post("txtPassword") &&
            $this->input->post("txtConfirmPassword")) {

            $resultImageProduct = $this->M_CompanyAdmin_Product->getModifierByProduct(
                array(
                    'id_producto'               => trim($this->input->post("id_product", TRUE)),
                    'id_modifier'  => trim($this->input->post("id_modifier", TRUE))
                )
            );

            if (sizeof($resultImageProduct) > 0) {

                $result = $this->M_CompanyAdmin_Product->deleteDetalleModificadorProductos(
                    array(
                        'id_producto' => trim($this->input->post("id_product", TRUE)),
                        'id_modifier' => trim($this->input->post("id_modifier", TRUE))
                    )
                );

                $result = $this->M_CompanyAdmin_Product->deleteModificadorProductos(
                    array(
                        'id_modifier' => trim($this->input->post("id_modifier", TRUE))
                    )
                );

                $json->message = "El modificador del producto se elimino correctamente.";
                $json->status = TRUE;
            } else {
                $json->message = "El modificador del producto que quiere eliminar no existe.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

}