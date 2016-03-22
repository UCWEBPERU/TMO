<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Omnipay\Omnipay;

class C_Store_Checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('utils/UserSession');
        $this->load->model('store/M_Store');
        $this->load->helper('store/h_store');
        $this->load->model('M_Archivo');
    }

    public function index() {

        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('adrian');
        $gateway->setPassword('12345');
        $settings = $gateway->getDefaultParameters();
    }

}