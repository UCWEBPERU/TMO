<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Cart extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->load->model('store/M_Store');
        $this->load->library('cart');
    }

    function addCart()
    {
        $json 				= new stdClass();
        $json->type 		= "Insertar Carrito";
        $json->presentation = "";
        $json->data 		= array();

        //$json->status 		= FALSE;

        // Set array for send data.
        /*$insert_data = array(
            'id' => $this->input->post('id_producto'),
            'name' => $this->input->post('nombre_producto'),
            'price' => $this->input->post('precio_producto'),
            'qty' => 1
        );*/

        //$result = $this->cart->insert($insert_data);

        $json->message = "Carrito insertado correctamente";
        $json->status 	= TRUE;
        echo json_encode($json);



    }
    
}
?>