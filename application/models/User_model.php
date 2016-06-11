<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{
	 public function get()
	 {
	 	$this->load->database();
	 	return $this->db->select("*")->from("user")->get()->result();
	 }
}
/* End of file movies_model.php */
/* Location: ./application/models/movies_model.php */