<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
 
 public function login()
 {
	 if($this->input->is_ajax_request())
	 {
		 if(!$this->input->post("email") || !$this->input->post("pass"))
		 {
		 	echo json_encode(array("code" => 1, "response" => "Datos insuficientes"));
		 }
		 $email = $this->input->post("email");
		 $password = sha1($this->input->post("pass"));
		 $this->load->model("Auth_model");
		 $user = $this->Auth_model->login($email, $password);
		 if($user !== false)
		 {
			 //ha hecho login
			 $user->iat = time();
			 $user->exp = time() + 900;
			 $jwt = JWT::encode($user, '');
			 echo json_encode(
			 array(
			 "code" => 0, 
			 "response" => array(
			 "token" => $jwt
			 )));
		 }
	 }
	 else
	 {
	 	show_404();
	 } 
 }
}


/*fin de Auth.php...............*/