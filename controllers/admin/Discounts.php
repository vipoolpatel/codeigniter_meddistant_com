<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discounts extends CI_Controller {
	public $id;

	public $currTime;

	public $currDate;

	function __construct() {

		parent::__construct();
		$this->id = $this->session->userdata('user_id');
		$this->currTime = time();
		$this->currDate = date('Y-m-d H:i:s');
		if (empty($this->id)) {
			redirect(base_url() . 'logout');
		}
	}

	public function index() {
		is_admin_in();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		if ($this->session->userdata('user_type') === 'agent') {
			$getRecord = $this->db->where('status', '0');
		}
		$getRecord = $this->db->get('tbl_discount')->result();
		$data['getRecord'] = $getRecord;


		$data['getAffiliate'] = $this->db->get('tbl_affiliate_code')->result();

		$this->load->view('admin/discounts/list', $data);
		$this->load->view('admin/common/footer');
	}

	public function edit($id) {

		if (!empty($_POST)) {
			$array = array(
				'name' => $this->input->post('name'),
				// 'discount_type' => $this->input->post('discount_type'),
				'amount' => $this->input->post('amount'),
				'discount_code' => $this->input->post('discount_code'),
			);

			$this->db->where('id', $id);
			$this->db->update('tbl_discount', $array);

			$this->session->set_flashdata('success_message', 'Discount Updated Successfully');
			redirect('admin/discounts');
		}

		$edit_row = $this->db->where('id', $id);
		$edit_row = $this->db->get('tbl_discount')->row();

		$data['edit_row'] = $edit_row;

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$this->load->view('admin/discounts/edit', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_discount');
		$this->session->set_flashdata('success_message', 'Discount Deleted Successfully');
		redirect('admin/discounts');
	}

}
