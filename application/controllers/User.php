<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	 
	 protected $headers;
	 
	 public function __construct()
	 {
		 parent::__construct();
		 $this->headers = apache_request_headers();
	 }
	 
	 public function index()
	 {
		 if(!isset($this->headers["Authorization"]) || empty($this->headers["Authorization"]))
		 {
		 	//mejorar la validación, pero si está aquí es que no tenemos el token
		 }
		 else
		 {
			 $token = explode(" ", $this->headers["Authorization"]);
			 $user = JWT::decode(trim($token[1],'"'));
			 $this->load->model("Auth_model");
			 
			 if($this->auth_model->checkUser($user->id, $user->email) !== false)
			 {
				 $this->load->model("User_model");
				 $accounts = $this->User_model->get();
				 $user->iat = time();
				 $user->exp = time() + 900;
				 $jwt = JWT::encode($user, '');
				 echo json_encode(
				 array(
				 "code" => 0, 
				 "response" => array(
				 "token" => $jwt,
				 "accounts"=> $accounts
				 )));
			 }
		 }
	 }
}
 
/* End of file User.php */
/* Location: ./application/controllers/User.php */