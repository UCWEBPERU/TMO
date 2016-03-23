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

        $gateway = Omnipay::create('Stripe');
        $gateway->setApiKey('sk_live_Y8KSanX283UzDT2OZ2xpNann');

        $formData = array('number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123');
//        $formData = array('number' => '4761739001010010', 'expiryMonth' => '12', 'expiryYear' => '2018', 'cvv' => '201');
        $response = $gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => $formData))->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            var_dump($response->getTransactionReference());
            var_dump($response);
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway
            $response->redirect();
        } else {
            // payment failed: display message to customer
            echo $response->getMessage();
        }

//        $gateway = Omnipay::create('PayPal_Express');
//        $gateway->setUsername('sales@lab.design');
//        $gateway->setPassword('Hovt100671');
//        $gateway->setTestMode(true);
//
////        $gateway = Omnipay::create('Stripe');
////        $gateway->setApiKey('abc123');
//
////        $formData = array('number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123');
//        $response = $gateway->purchase(
//            array(
//                'amount'    => '10.00',
//                'currency'  => 'USD',
//                'returnUrl' => 'http://www.uc-web.mobi/TMO/company/6/store/1/',
//                'cancelUrl' => 'http://www.uc-web.mobi/TMO/company/6/store/1/'
//            ))->send();
//
//        if ($response->isSuccessful()) {
//            // payment was successful: update database
//            print_r($response);
//        } elseif ($response->isRedirect()) {
//            // redirect to offsite payment gateway
//            $response->redirect();
//        } else {
//            // payment failed: display message to customer
//            echo $response->getMessage();
//        }

//         Create a gateway for the PayPal RestGateway
//         (routes to GatewayFactory::create)
//        phpinfo();

//        $gateway = Omnipay::create('PayPal_Rest');
//
//        // Initialise the gateway
////        $gateway->initialize(array(
////            'clientId' => 'AVg1I_sUtJ0o9EAjrOc0RcqTUPIZWScTjc_Goj7A0DSkbeIEts0oEf6w9zECrdSe-p8opzJtUCKdWab8',
////            'secret'   => 'EDpduhPbvFGXfWV23YvnifwEGrnHg3hA-v-RvgL1K9uk_xkDaat4XYNOVguvkENCercJYC8Je-12CYXH',
////            'testMode' => true, // Or false when you are ready for live transactions
////        ));
//        $gateway->initialize(array(
//            'clientId' => 'Ac-DjRm6aIjZdRWOUt4TbynQUlVfErqzMjh_7cxJB2Dc-dYqlDZoBSptF8yZ8eOTwscMcZD6eAYFwUj9',
//            'secret'   => 'EJRC21ay3VTyuoMguOHEnt8d3vwLR4kuI7eejaYAUbYLAG5ogrcrQd1T1YcIV5IxuGHIrkOZ-rhLjng6',
//            'testMode' => true, // Or false when you are ready for live transactions
//        ));
//
//
//
//        // Create a credit card object
//        // DO NOT USE THESE CARD VALUES -- substitute your own
//        // see the documentation in the class header.
//        $card = array(
//            'firstName' => 'Example',
//            'lastName' => 'User',
//            'number' => '4111111111111111',
//            'expiryMonth'           => '01',
//            'expiryYear'            => '2020',
//            'cvv'                   => '123',
//            'billingAddress1'       => '1 Scrubby Creek Road',
//            'billingCountry'        => 'AU',
//            'billingCity'           => 'Scrubby Creek',
//            'billingPostcode'       => '4999',
//            'billingState'          => 'QLD',
//        );
//
//        // Do an authorisation transaction on the gateway
//        $transaction = $gateway->authorize(array(
//            'amount'        => '10.00',
//            'currency'      => 'AUD',
//            'description'   => 'This is a test authorize transaction.',
//            'card'          => $card,
//        ));
//        $response = $transaction->send();
//        if ($response->isSuccessful()) {
//            echo "Authorize transaction was successful!\n";
//            // Find the authorization ID
//            $auth_id = $response->getTransactionReference();
//        }

    }

}