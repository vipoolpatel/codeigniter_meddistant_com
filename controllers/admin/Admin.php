<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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

		$getRecord = $this->db->select('tbl_user.*');
		$getRecord = $this->db->from('tbl_user');
		$getRecord = $this->db->where('tbl_user.user_type', 'admin');
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		$this->load->view('admin/admin/list', $data);
		$this->load->view('admin/common/footer');
	}

	public function add() {

		if (!empty($_POST)) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_user.email]');
			if ($this->form_validation->run() == TRUE) {
				$password = rand();

				$array = array(
					'username' => $this->input->post('username'),
					'phone_no' => $this->input->post('phone_no'),
					'active' => $this->input->post('active'),
					'email' => $this->input->post('email'),
					'password' => md5($password),
					'user_type' => 'admin',
					'created_on' => date('Y-m-d H:i:s'),
				);

				$this->db->insert('tbl_user', $array);

				$subject = 'Meddistant "Your Request Recieved"';
				$body = "<!DOCTYPE html>
					<html><body>
					<p>Hello " . $this->input->post('username') . ",</p>
					<p>As per our agreement, you have been assigned to Admin panel management until further notice.<p>

					<p>Please login and immediately change password for higher security.</p>

					<p>Email : " . $this->input->post('email') . "</p>
					<p>Password : " . $password . "</p>

					<p><a href='" . base_url() . "admin/login'>login</a></p>

					<br />

					<p>Truly,</p>
					<br>
					<p> Meddistant Care Team</p>
					<p>	USA & Canada +1888 9699959</p>
					<p> Worldwide  +1312 8899105 </p>
					<p> Turkey +90 (541)9473789 </p>
					<p> Or email us at care@meddistant.com</p></body></html>";

				$subject = 'Meddistant "New Account"';
				$this->common_model->mail_mail($this->input->post('email'), $subject, $body, "joez@meddistant.com");

				$this->session->set_flashdata('success_message', 'Record Created Successfully');
				redirect('admin/admin');
			}

		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$this->load->view('admin/admin/add');
		$this->load->view('admin/common/footer');
	}

	public function edit($id) {

		if (!empty($_POST)) {
			$array = array(
				'username' => $this->input->post('username'),
				'phone_no' => $this->input->post('phone_no'),
				'active' => $this->input->post('active'),
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
			redirect('admin/admin');
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['user_data'] = $this->common_model->get_tbl_data('user', '*', array('user_id' => $id), $row = 1);

		$this->load->view('admin/admin/edit', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete($id) {
		$this->db->where('user_id', $id);
		$this->db->delete('tbl_user');
		$this->session->set_flashdata('success_message', 'Record Deleted Successfully');
		redirect('admin/admin');
	}

	

}
