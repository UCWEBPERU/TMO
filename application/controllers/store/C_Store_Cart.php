<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Store_Cart extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->load->model('store/M_Store');
        $this->load->helper('store/h_store');
        $this->load->library('cart');
        $this->load->helper('form');
    }

    function index(){
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

        $data["modulo"] = $modulo;

        //$this->load->view('store/v-store-account', $data);
        $this->load->view('store/v-store-cart',  $data);

    }

    function addCart()
    {
        $json 				= new stdClass();
        $json->type 		= "Insertar Carrito";
        $json->presentation = "";
        $json->data 		= array();
        $json->status 		= FALSE;

        $dataProducto = $this->M_Store->getProductByID(
            array(
                "id_empresa"    => $this->uri->segment(2),
                "id_tienda"     => $this->uri->segment(4),
                "id_producto"   => intval($this->input->post('id_producto'))
            )
        );

        cargarGaleriaPorProducto($dataProducto[0]);

        // Set array for send data.
        $insert_data = array(
            'id' => $this->input->post('id_producto'),
            'name' => $this->input->post('nombre_producto'),
            'price' => $this->input->post('precio_producto'),
            'qty' => 1,
            'options' => array('url_image' => $dataProducto[0]->galeria_producto[0]->url_archivo)
        );

        $result = $this->cart->insert($insert_data);
        
        if($result){
            $json->message = "Carrito insertado correctamente";
            $json->status 	= TRUE;
        }


        echo json_encode($json);



    }


    function updateCart(){

        // Recieve post values,calcute them and update
        $cart_info = $_POST['cart'];
        foreach ($cart_info as $id => $cart) {
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];

            $data = array(
                'rowid' => $rowid,
                'price' => $price,
                'amount' => $amount,
                'qty' => $qty
            );
        }

    }

    function deleteitemCart(){
        $json 				= new stdClass();
        $json->type 		= "Eliminar Item";
        $json->presentation = "";
        $json->data 		= array();
        $json->status 		= FALSE;

        $result = $this->cart->remove($this->input->post('id_producto'));

        if($result){
            $json->message = "Item eliminado correctamente";
            $json->status 	= TRUE;
        }


        echo json_encode($json);


    }
    
}
?>