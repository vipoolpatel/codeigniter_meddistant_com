<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_companies extends CI_Controller {
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

	public function index() {

		is_admin_in();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$getRecord = $this->db->select('tbl_user.*,tbl_company_type.company_type');
		$getRecord = $this->db->from('tbl_user');
		$getRecord = $this->db->join('tbl_company_type', 'tbl_company_type.id = tbl_user.company_type_id', 'left');
		$getRecord = $this->db->where('tbl_user.user_type', 'employer');
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		$getAgent = $this->db->select('tbl_user.*');
		$getAgent = $this->db->from('tbl_user');
		$getAgent = $this->db->where('tbl_user.user_type', 'agent');
		$getAgent = $this->db->get()->result_array();
		$data['getAgent'] = $getAgent;

		$this->load->view('admin/manage_companies/list', $data);
		$this->load->view('admin/common/footer');

	}

	public function edit($id) {

		if (!empty($_POST)) {
			$array = array(
				'company_name' => $this->input->post('company_name'),
				'username' => $this->input->post('company_name'),
				'phone_no' => $this->input->post('phone_no'),
				'country' => $this->input->post('country'),
				'company_type_id' => $this->input->post('company_type_id'),

				'paid_setup' 	 => $this->input->post('paid_setup'),
				'subscription_type' 	 => $this->input->post('subscription_type'),
				'subscription_price' 	 => $this->input->post('subscription_price'),

			);

			$this->db->where('user_id', $id);
			$this->db->update('tbl_user', $array);

			if (!empty($this->input->post('password'))) {
				$array_password = array(
					'password' => md5($this->input->post('password')),
				);

				$password = $this->db->where('user_id', $id);
				$password = $this->db->update('tbl_user', $array_password);
			}

			$this->session->set_flashdata('success_message', 'Profile Updated Successfully');
			redirect('admin/manage_companies');
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['get_country'] = $this->db->get('tbl_country')->result();
		$data['get_company_type'] = $this->db->get('tbl_company_type')->result();

		$data['user_data'] = $this->common_model->get_tbl_data('user', '*', array('user_id' => $id), $row = 1);
		$this->load->view('admin/manage_companies/edit', $data);
		$this->load->view('admin/common/footer');
	}

	public function detail($id) {
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$getRecord = $this->db->select('tbl_user.*,tbl_company_type.company_type');
		$getRecord = $this->db->from('tbl_user');
		$getRecord = $this->db->join('tbl_company_type', 'tbl_company_type.id = tbl_user.company_type_id', 'left');
		$getRecord = $this->db->where('tbl_user.user_type', 'employer');
		$getRecord = $this->db->where('tbl_user.user_id', $id);
		$getRecord = $this->db->get()->row();
		$data['getRecord'] = $getRecord;

		$this->load->view('admin/manage_companies/detail', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete($id) {
		$this->db->where('user_id', $id);
		$this->db->delete('tbl_user');
		$this->session->set_flashdata('success_message', 'Profile Deleted Successfully');
		redirect('admin/manage_companies');
	}

	public function assign_agent() {
		$agent_id = $this->input->post('agent_id');
		$user_id = $this->input->post('user_id');
		$this->common_model->update_tbl_data('user', array('agent_id' => $agent_id), array('user_id' => $user_id));
		echo 'Agent Successfully Assign!';

	}


	

	public function change_approve_status()
	{
		$id = $this->input->post('id');
		$active = $this->input->post('status');

		if($active == 1) 
		{
			$hos_payment = 1;
		}
		else 
		{
			$hos_payment = 0;
		}
		
		$this->common_model->update_tbl_data('user', array('approved' => 1, 'hos_payment' => $hos_payment, 'is_quote' => $active), array('user_id' => $id));

		echo 'Status Change Successfully!';
	}

}
