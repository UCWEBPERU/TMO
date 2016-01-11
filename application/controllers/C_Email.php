<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Email extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
 
	public function sendMailGmail() {
		var_dump($this->send_mail('ANDRONIKA', 'uc-web@uc-web.mobi', 'CONTACTO', "naomi_yamile_17@hotmail.com", 'Formulario en linea - CONTACTENOS', 'Un mensaje de prueba.', ''));
		// if ($this->send_mail('ANDRONIKA', 'uc-web@uc-web.mobi', 'CONTACTO', "naomi_yamile_17@hotmail.com", 'Formulario en linea - CONTACTENOS', 'Un mensaje de prueba.', '')) {
		// 	echo "OK";
		// } else {
		// 	echo "FAIL";
		// }

		$this->load->library("email");
 
		//configuracion para gmail
		$configGmail = array(
			'protocol' 	=> 'smtp',
			'_smtp_auth'=> TRUE,
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'mickhve@gmail.com',
			'smtp_pass' => 'd0ntf0rg3t@',
			'mailtype' 	=> 'html',
			'charset' 	=> 'utf-8',
			'newline' 	=> "\r\n"
		);    
 
		//cargamos la configuración para enviar con gmail
		$this->email->initialize($configGmail);
 
		$this->email->from('Mick Heral');
		$this->email->to("naomi_yamile_17@hotmail.com");
		$this->email->subject('Bienvenido/a a uno-de-piera.com');
		$this->email->message('<h2>Email enviado con codeigniter haciendo uso del smtp de gmail</h2><hr><br> Bienvenido al blog');
		$this->email->send();
		//con esto podemos ver el resultado
		var_dump($this->email->print_debugger());
	}
	
	public function send_mail($myname, $myemail, $contactname, $contactemail, $subject, $message, $bcc) {
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From: \"".$myname."\" <".$myemail.">\n";
		if ($bcc != "")
			$headers .= "Bcc: ".$bcc."\n";    
		$output = $message;                $output = wordwrap($output, 72);
		return(mail("\"".$contactname."\" <".$contactemail.">", $subject, $output, $headers));
	}
 
	public function sendMailYahoo()	{
		//cargamos la libreria email de ci
		$this->load->library("email");
 
		//configuracion para yahoo
		$configYahoo = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.mail.yahoo.com',
			'smtp_port' => 587,
			'smtp_crypto' => 'tls',
			'smtp_user' => 'emaildeyahoo',
			'smtp_pass' => 'password',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		); 
 
		//cargamos la configuración para enviar con yahoo
		$this->email->initialize($configYahoo);
 
		$this->email->from('correo que envia los emails');//correo de yahoo o no funcionará
		$this->email->to("correo que recibe el email");
		$this->email->subject('Bienvenido/a a uno-de-piera.com');
		$this->email->message('<h2>Email enviado con codeigniter haciendo uso del smtp de yahoo</h2><hr><br> Bienvenido al blog');
		$this->email->send();
		//con esto podemos ver el resultado
		var_dump($this->email->print_debugger());
 
	}
}