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
        $json->type 		= "User Store";
        $json->presentation = "";
        $json->action 		= "register";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("txtFirstName") &&
            $this->input->post("txtLastName") &&
            $this->input->post("txtEmail") &&
            $this->input->post("txtPassword") &&
            $this->input->post("txtConfirmPassword")) {

            $existeEmail = $this->M_Store->getUserBYEmail(
                array(
                    'email_usuario' => trim($this->input->post("txtEmail", TRUE))
                )
            );

            if (sizeof($existeEmail) == 0) {
                $json->message = "Su registro de usuario se realizo correctemente.";
                $json->status = TRUE;
            } else {
                $json->message = "Lo sentimos el email ingresado ya existe, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

}