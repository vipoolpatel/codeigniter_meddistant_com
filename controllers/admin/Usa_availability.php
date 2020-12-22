<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usa_availability extends CI_Controller {
	public $user_id;

	public $currTime;

	public $currDate;

	function __construct() {

		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->currTime = time();
		$this->currDate = date('Y-m-d H:i:s');
		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}
	}

	
// UAS Availability Start
	public function index()
	{
		is_admin_in();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$getRecord = $this->db->select('tbl_state.*');
		$getRecord = $this->db->from('tbl_state');
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		$this->load->view('admin/usa_availability/list', $data);
		$this->load->view('admin/common/footer');
	}

	public function add() {

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$this->load->view('admin/usa_availability/add');
		$this->load->view('admin/common/footer');
	}

	public function edit($id) {

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['user_data'] = $this->common_model->get_tbl_data('tbl_state', '*', array('id' => $id), $row = 1);

		$this->load->view('admin/usa_availability/edit', $data);
		$this->load->view('admin/common/footer');
	}

	public function store_update($id = '')
	{
		$data = array(
			'state_name' => !empty($this->input->post('states')) ? $this->input->post('states') : '',
			'hospitals' => !empty($this->input->post('hospitals')) ? $this->input->post('hospitals') : '0',
			'clinics' => !empty($this->input->post('clinics')) ? $this->input->post('clinics') : '0',
			'physicians' => !empty($this->input->post('physicians')) ? $this->input->post('physicians') : '0',
		);

		if(!empty($id))
		{
			$this->db->where('id',$id); 
            $this->db->update('tbl_state',$data); 
	
		}else{
			
			$this->db->insert('tbl_state', $data);
		}
			$this->session->set_flashdata('success_message', 'Record Successfully Submit');
			redirect('admin/usa_availability');
	}

	
	// UAS Availability End


}