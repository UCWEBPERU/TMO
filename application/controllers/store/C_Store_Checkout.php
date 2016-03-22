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

//        $gateway = Omnipay::create('Stripe');
//        $gateway->setApiKey('abc123');

//        $formData = array('number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123');
        $response = $gateway->purchase(
            array(
                'amount'    => '10.00',
                'currency'  => 'USD',
                'returnUrl' => 'http://www.uc-web.mobi/TMO/company/6/store/1/',
                'cancelUrl' => 'http://www.uc-web.mobi/TMO/company/6/store/1/'
            ))->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            print_r($response);
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway
            $response->redirect();
        } else {
            // payment failed: display message to customer
            echo $response->getMessage();
        }

    }

}