<?php
defined('BASEPATH') OR exit('No direct script access allowed');




class Logout extends CI_Controller {
	
	public function index() {
		
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
		
		redirect('admin/login', 'refresh');
	}
	
	public function trip() {
		
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
		
		redirect('', 'refresh');
	}
	
}
