<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_GEO_Data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
//        $this->load->library('session');
//        $this->load->library('utils/UserSession');
//        $this->usersession->validateSession("panel-admin");
//        $this->load->model("M_Usuario");
//        $this->load->model('admin/M_Admin_Empresa');
    }

    public function ajaxGetRegionsByCountry() {
        $this->load->model("M_GEO_Regions");

        $json 				= new stdClass();
        $json->type 		= "GEO Data - Regions By Country";
        $json->presentation = "";
        $json->action 		= "list";
        $json->data 		= array();
        $json->status 		= FALSE;

        if ( $this->input->post("code_country") ) {

            $result = $this->M_GEO_Regions->getRegionsByCountry(
                array(
                    "code" => trim($this->input->post("code_country", TRUE))
                )
            );

            if (count($result) > 0) {
                $json->message  = "Lista de regiones.";
                $json->data     = $result;
                $json->status 	= TRUE;
            } else {
                $json->message = "Lo sentimos no se encontraron regiones del pais buscado.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);

    }

}