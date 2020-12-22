<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Doctors extends CI_Controller {
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

		$data['doctors_data'] = $data['doctors_data'] = $this->db->query("SELECT tbl_doctors.*,tbl_user.country as hospital_country FROM tbl_doctors INNER JOIN tbl_user ON tbl_user.user_id = tbl_doctors.id_user ORDER BY tbl_doctors.created_on DESC")->result_array();
		$this->load->view('admin/doctors/doctors_list', $data);
		$this->load->view('admin/common/footer');
	}

	function popup($page_name = '', $param2 = '', $param3 = '') {
		$page_data['doctor_data'] = $this->db->get_where('tbl_doctors', array('doctor_id' => $param2))->row_array();

		$page_data['param2'] = $this->db->get_where('tbl_doctors', array('doctor_id' => $param2))->row_array();
		// print_r($page_data);
		// exit();
		$page_data['param3'] = $param3;
		$this->load->view('doctors/' . $page_name . '.php', $page_data);
	}

	public function delete($id) {
		$this->common_model->dlt_tbl_data('doctors', array('doctor_id' => $this->uri->segment(4)));

		$this->session->set_flashdata('success_message', 'Doctor `d Successfully! ');
		redirect('admin/doctors');
	}

	public function manage_doctor() {

		if ($this->uri->segment(3) == 'del') {
			$this->common_model->dlt_tbl_data('doctors', array('doctor_id' => $this->uri->segment(4)));

			$this->session->set_flashdata('success_message', 'Doctor `d Successfully! ');
			redirect('manage_doctors/');
		}

		$is_new = $this->input->post('add');
		$is_edit = $this->input->post('edit');
		$edit_id = $this->input->post('edit_id');
		if (isset($is_new) OR isset($is_edit)) {

			$count_doctors = $this->common_model->get_tbl_data('doctors', '*', array('id_user' => $this->user_id));

			if (count($count_doctors) == '5') {
				$this->session->set_flashdata('error_message', 'You can add only 5 Doctors!');
				redirect('manage_doctors/');
			}

			$doctor_image = $this->input->post('doctor_image');

			$time = time();
			$config = array(
				'upload_path' => 'upload_dir/doctors_image/',
				'allowed_types' => 'jpg|png|PNG|JPG|JPEG|jpeg',
				'max_size' => 2000,
				'max_width' => 0,
				'max_height' => 0,
				'file_name' => $time,
			);
			$this->load->library('upload', $config);
			if (!empty($_FILES['doctor_image']['name']) && !$this->upload->do_upload('doctor_image')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error_message', $error['error']);
				redirect('manage_doctors/');
			}
			$data = array('upload_data' => $this->upload->data());

			$specialties = implode(",", $this->input->post('specialties'));

			$doctor_data = array(
				'id_user' => $this->session->userdata('user_id'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone_no' => $this->input->post('phone_no'),
				'gender' => $this->input->post('gender'),
				'language_spoken' => $this->input->post('language_spoken'),
				'doctor_image' => $data['upload_data']['orig_name'],
				'orignal_doctor_image' => $data['upload_data']['client_name'],
				'specialties' => $specialties,
				'specialty_years' => $this->input->post('specialty_years'),
				'education' => $this->input->post('education'),
				'residency' => $this->input->post('residency'),
				'board_credential' => $this->input->post('board_credential'),
				'board_certified' => $this->input->post('board_certified'),
				'license_number' => $this->input->post('license_number'),
				'license_country' => $this->input->post('license_country'),
				'about_doctor' => $this->input->post('about_doctor'),
				'professional_association' => $this->input->post('professional_association'),
				'training' => $this->input->post('training'),
				'created_on' => date('Y-m-d H:i:s'),
			);

			if ($is_new) {

				$insert_id = $this->common_model->insert_tbl_data('doctors', $doctor_data);
				$this->session->set_flashdata('success_message', 'Doctor Added Successfully!');

				redirect('manage_doctors/');

			} else {

				$this->common_model->update_tbl_data('doctors', $doctor_data, array('doctor_id' => $edit_id));
				$this->db->query("DELETE FROM tbl_facility_procedure WHERE id_facility = $edit_id AND id_tbl_user = $this->user_id");

				$this->session->set_flashdata('success_message', 'Doctor Updated Successfully!');

				redirect('manage_doctors/');

			}
		} else {

			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
			$data['doctors_data'] = $this->common_model->get_tbl_data('doctors', '*', array('id_user' => $this->user_id), $row = 1, 'created_on DESC');
			$this->load->view('doctors/manage_doctor', $data);
			$this->load->view('common/user_backend_footer');
		}
	}

}
