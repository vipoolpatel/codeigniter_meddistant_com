<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller {
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

		$getRecord = $this->db->select('tbl_country.*');
		$getRecord = $this->db->from('tbl_country');
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		// $data['getRecord'] = $this->db->get('tbl_country')->result_array();

		$this->load->view('admin/country/list', $data);
		$this->load->view('admin/common/footer');
	}

	public function add() {

		if (!empty($_POST)) {

			$this->load->library('form_validation');
			$array = array(

				'country_name' => !empty($this->input->post('country_name')) ? $this->input->post('country_name') : '',
				'is_hospital' => !empty($this->input->post('is_hospital')) ? $this->input->post('is_hospital') : '',
				'is_employer' => !empty($this->input->post('is_employer')) ? $this->input->post('is_employer') : '',
				'is_quote' => !empty($this->input->post('is_quote')) ? $this->input->post('is_quote') : '',
				'is_agent' => !empty($this->input->post('is_agent')) ? $this->input->post('is_agent') : '',

			);

			$this->db->insert('tbl_country', $array);

			$this->session->set_flashdata('success_message', 'Record Created Successfully');
			redirect('admin/country');

		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$this->load->view('admin/country/add');
		$this->load->view('admin/common/footer');
	}

	public function edit($id) {

		if (!empty($_POST)) {
			$array = array(
				'country_name' => !empty($this->input->post('country_name')) ? $this->input->post('country_name') : '',
				'is_hospital' => !empty($this->input->post('is_hospital')) ? $this->input->post('is_hospital') : '',
				'is_employer' => !empty($this->input->post('is_employer')) ? $this->input->post('is_employer') : '',
				'is_quote' => !empty($this->input->post('is_quote')) ? $this->input->post('is_quote') : '',
				'is_agent' => !empty($this->input->post('is_agent')) ? $this->input->post('is_agent') : '',
			);

			$this->db->where('id', $id);
			$this->db->update('tbl_country', $array);

			$this->session->set_flashdata('success_message', 'Country Updated Successfully');
			redirect('admin/country');
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['user_data'] = $this->common_model->get_tbl_data('tbl_country', '*', array('id' => $id), $row = 1);

		$this->load->view('admin/country/edit', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_country');
		$this->session->set_flashdata('success_message', 'Record Deleted Successfully');
		redirect('admin/country');
	}

}
