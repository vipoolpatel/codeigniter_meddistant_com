<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_page extends CI_Controller {

	function __construct() {

		parent::__construct();

		is_admin_in();


		$this->user_id = $this->session->userdata('user_id');
		$this->currTime = time();
		$this->currDate = date('Y-m-d H:i:s');
		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}
	}

	public function index() {

		if(!empty($_POST))
		{
			$update = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description')
			);

			$this->db->where('slug','home');
			$this->db->update('tbl_landing_page',$update);
		}


		$getdata = $this->db->where('slug','home');
		$getdata = $this->db->get('tbl_landing_page')->row();

		$data['getdata'] = $getdata;

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$this->load->view('admin/landing_page/list', $data);
		
		$this->load->view('admin/common/footer');
	}

	
}
?>