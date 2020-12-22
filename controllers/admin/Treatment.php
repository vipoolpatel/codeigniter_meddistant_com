<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Treatment extends CI_Controller {
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

		$getRecord = $this->db->get('tbl_treatment')->result();
		$data['getRecord'] = $getRecord;

		$this->load->view('admin/treatment/list', $data);
		$this->load->view('admin/common/footer');
	}

	public function add() {

		if (!empty($_POST)) {
			$array = array(
				'treatment_name' => $this->input->post('treatment_name'),
				'order_by_data' => $this->input->post('order_by_data'),
			);

			$this->db->insert('tbl_treatment', $array);

			$this->session->set_flashdata('success_message', 'Treatment Updated Successfully');
			redirect('admin/treatment');
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/treatment/add', $data);
		$this->load->view('admin/common/footer');
	}

	public function edit($id) {

		if (!empty($_POST)) {
			$array = array(
				'treatment_name' => $this->input->post('treatment_name'),
				'order_by_data' => $this->input->post('order_by_data'),
			);

			$this->db->where('id', $id);
			$this->db->update('tbl_treatment', $array);

			$this->session->set_flashdata('success_message', 'Treatment Updated Successfully');
			redirect('admin/treatment');
		}

		$edit_row = $this->db->where('id', $id);
		$edit_row = $this->db->get('tbl_treatment')->row();

		$data['edit_row'] = $edit_row;

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$this->load->view('admin/treatment/edit', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_treatment');
		$this->session->set_flashdata('success_message', 'Treatment Deleted Successfully');
		redirect('admin/treatment');
	}

}
