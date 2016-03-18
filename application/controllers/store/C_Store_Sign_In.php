<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Sign_In extends CI_Controller {

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

        $this->load->view('store/v-store-sign-in', $data);
    }

    public function ajaxSignIn() {
        $this->load->library('security/Cryptography');
        $json 				= new stdClass();
        $json->type 		= "User Store";
        $json->presentation = "";
        $json->action 		= "register";
        $json->data 		= array();
        $json->status 		= FALSE;

        $base_url_store = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4);

        if ($this->input->post("txtEmail") && $this->input->post("txtPassword")) {

            $Usuario = $this->M_Store->getUserBYEmail(
                array(
                    'email_usuario' => trim($this->input->post("txtEmail", TRUE)),
                )
            );

            if (sizeof($Usuario) > 0) {
                $Usuario = $Usuario[0];
                if ($this->cryptography->validateHash($Usuario->password_usuario, trim($this->input->post("txtPassword", TRUE)))) {
                    $sessionUser = array(
                        'user_session'          => TRUE,
                        'id_usuario'            => intval($Usuario->id_usuario),
                        'nombres_usuario'       => $Usuario->nombres_persona,
                        'apellidos_usuario'	    => $Usuario->apellidos_persona,
                        'email_usuario'		    => $Usuario->email_usuario,
                        'id_tipo_usuario'		=> $Usuario->id_tipo_usuario,
                        'nombre_tipo_usuario'	=> $Usuario->nombre_tipo_usuario,
                        'id_empresa'            => ""
                    );

                    if (intval($Usuario->id_tipo_usuario) == 3) {
                        $this->session->set_userdata($sessionUser);
                        $json->data = array("url_redirect" => $base_url_store."/account");
                        $json->message = "Inicio de sesion existosa.";
                        $json->status 	= TRUE;
                    } else {
                        $json->message = "Lo sentimos la cuenta de usuario ingresado no esta habilitado para realizar compras, Registrese <a href='$base_url_store/signin'>aqui</a>.";
                    }
                } else {
                    $json->message = "La contraseña del usuario es incorrecta, intente de nuevo.";
                }
            } else {
                $json->message = "Lo sentimos la cuenta de usuario no existe, intente de nuevo.";
            }

        } else {
            $json->message 	= "No se recibio los parametros necesarios para procesar su solicitud.";
        }

        echo json_encode($json);
    }

    public function signOut() {
        $sessionUser = array(
            'user_session',
            'id_usuario',
            'nombres_usuario',
            'apellidos_usuario',
            'email_usuario',
            'id_tipo_usuario',
            'nombre_tipo_usuario'
        );
        $this->session->unset_userdata($sessionUser);
        $this->session->sess_destroy();
        $urlAccount = base_url()."company/".$this->uri->segment(2)."/store/".$this->uri->segment(4)."/account";
        redirect($urlAccount);
    }

}