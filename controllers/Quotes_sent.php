<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Quotes_sent extends CI_Controller {
	public $user_id;

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}
	}

	public function index() {
		is_user_in();
		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->db->select('country');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $this->user_id);

//        a.kader
		$this->db->where('approved', '1');
		$hospital_country_arr = $this->db->get()->result();
		$data['quote_requested_data'] = null;
		if (count($hospital_country_arr) > 0) {
			$data['quote_requested_data'] = $this->db->query("SELECT *, tbl_quote_sent.message as msg,tbl_treatment.treatment_name as procedure_treatment,tbl_quote_request.id FROM tbl_quote_sent INNER JOIN tbl_quote_request ON tbl_quote_sent.quote_request_id = tbl_quote_request.id INNER JOIN tbl_treatment ON tbl_treatment.id = tbl_quote_request.procedure_treatment WHERE tbl_quote_sent.id_user = '$this->user_id' ORDER BY tbl_quote_sent.created_on DESC")->result_array();

		}

		$this->load->view('quotes_sent/quotes_sent', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function manage_send_quote() {

		$is_new = $this->input->post('add');
		$is_edit = $this->input->post('edit');
		$edit_id = $this->input->post('edit_id');
		$quote_request_id = $this->uri->segment(3);

		if (isset($is_new) OR isset($is_edit)) {

			$quote_sent_data = array(
				'id_user' => $this->user_id,
				'quote_request_id' => $this->input->post('quote_request_id'),
				'hospital_clinic' => $this->input->post('hospital_clinic'),
				'quote_preparer_name' => $this->input->post('quote_preparer_name'),
				'doctor_id' => $this->input->post('doctor_id'),
				'accomodations' => $this->input->post('accomodations'),
				'new_doctor' => $this->input->post('new_doctor'),
				'message' => $this->input->post('message'),
				'stay_length' => $this->input->post('stay_length'),
				'treatment_cost' => $this->input->post('treatment_cost'),
				'created_on' => date('Y-m-d H:i:s'),
			);

			if ($is_new) {

				$insert_id = $this->common_model->insert_tbl_data('quote_sent', $quote_sent_data);

				$this->session->set_flashdata('success_message', 'Quote Sent Successfully!');
				redirect('quotes_requested/');

			} else {

			}
		} else {

			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
			$data['send_quote_data'] = $this->common_model->get_tbl_data('quote_request', '*', array('id' => $quote_request_id), $row = 1, 'created_on DESC');

			$data['facility_data'] = $this->db->query("SELECT * FROM tbl_user  WHERE user_id = '$this->user_id'")->row_array();

			$data['doctors'] = $this->db->query("SELECT * FROM tbl_doctors INNER JOIN tbl_user ON tbl_doctors.id_user = tbl_user.user_id WHERE tbl_user.user_id = '$this->user_id'")->result_array();

			$this->load->view('quotes_requested/manage_send_quote', $data);
			$this->load->view('common/user_backend_footer');
		}
	}

	public function dlt_customer_quote() {
		$id = $this->uri->segment(3);

		$this->common_model->dlt_tbl_data('quote_request', array('id' => $id));

		$this->session->set_flashdata('success', 'Quote Deleted Successfully');
		redirect('customer_quotes/');

	}

	public function quote_edit_sent($id) {
		$user_data = $this->common_model->get_tbl_data('tbl_quote_sent', '*', array('quote_sent_id' => $id), $row = 1);

		$data['user_data'] = $user_data;

		$data['doctors'] = $this->db->query("SELECT * FROM tbl_doctors INNER JOIN tbl_user ON tbl_doctors.id_user = tbl_user.user_id WHERE tbl_doctors.hospital_id =  '" . $user_data['hospital_table_id'] . "' ")->result_array();

		if (!empty($_FILES["file_one"]["name"])) {
			$file_one = $_FILES["file_one"]["name"];
			$array_name = explode(".", $file_one);
			$ext = end($array_name);

			$file_one = date('ymdhis') . '1.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_one"]["tmp_name"], $folder . $file_one);
		} else {
			$file_one = $this->input->post('old_file_one');
		}

		if (!empty($_FILES["file_two"]["name"])) {
			$file_two = $_FILES["file_two"]["name"];
			$array_name = explode(".", $file_two);
			$ext = end($array_name);

			$file_two = date('ymdhis') . '2.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_two"]["tmp_name"], $folder . $file_two);
		} else {
			$file_two = $this->input->post('old_file_two');
		}

		if (!empty($_FILES["file_three"]["name"])) {
			$file_three = $_FILES["file_three"]["name"];
			$array_name = explode(".", $file_three);
			$ext = end($array_name);

			$file_three = date('ymdhis') . '3.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_three"]["tmp_name"], $folder . $file_three);
		} else {
			$file_three = $this->input->post('old_file_three');
		}

		if (!empty($_FILES["file_four"]["name"])) {
			$file_four = $_FILES["file_four"]["name"];
			$array_name = explode(".", $file_four);
			$ext = end($array_name);

			$file_four = date('ymdhis') . '4.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_four"]["tmp_name"], $folder . $file_four);
		} else {
			$file_four = $this->input->post('old_file_four');
		}

		if (!empty($_FILES["file_five"]["name"])) {
			$file_five = $_FILES["file_five"]["name"];
			$array_name = explode(".", $file_five);
			$ext = end($array_name);

			$file_five = date('ymdhis') . '5.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_five"]["tmp_name"], $folder . $file_five);
		} else {
			$file_five = $this->input->post('old_file_five');
		}

		if ($this->session->userdata('user_type') === 'agent') {
			if (!empty($_POST)) {

				if ($user_data['type'] == 'Treatment') {
					$array = array(
						'accomodations' => !empty($this->input->post('accomodations')) ? $this->input->post('accomodations') : '',
						'new_doctor' => !empty($this->input->post('new_doctor')) ? $this->input->post('new_doctor') : '',
						'doctor_id' => !empty($this->input->post('doctor_id')) ? $this->input->post('doctor_id') : '0',
						'message' => !empty($this->input->post('message')) ? $this->input->post('message') : '',
						'stay_length' => !empty($this->input->post('stay_length')) ? $this->input->post('stay_length') : '',

						'hotel_name' => !empty($this->input->post('hotel_name')) ? $this->input->post('hotel_name') : '',
						'hotel_cost' => !empty($this->input->post('hotel_cost')) ? $this->input->post('hotel_cost') : '',

						'treatment_cost' => !empty($this->input->post('treatment_cost')) ? $this->input->post('treatment_cost') : '',
						'agent_prepay' 	 => !empty($this->input->post('agent_prepay')) ? $this->input->post('agent_prepay') : 0,
						'facilitation_fees' 	 => !empty($this->input->post('facilitation_fees')) ? $this->input->post('facilitation_fees') : 0,
						'file_one' => $file_one,
						'file_two' => $file_two,
						'file_three' => $file_three,
						'file_four' => $file_four,
						'file_five' => $file_five,
						'revised_date' => date('Y-m-d'),
					);

					$this->db->where('quote_sent_id', $id);
					$this->db->update('tbl_quote_sent', $array);
				} else {
					$array = array(
						'message' => !empty($this->input->post('message')) ? $this->input->post('message') : '',
						'treatment_cost' => !empty($this->input->post('treatment_cost')) ? $this->input->post('treatment_cost') : '',
					);

					$this->db->where('quote_sent_id', $id);
					$this->db->update('tbl_quote_sent', $array);
				}

				$this->session->set_flashdata('success_message', 'Updated Successfully');
				redirect('admin/quotes_sent');
			}

			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
			$this->load->view('quotes_sent/edit', $data);
			$this->load->view('admin/common/footer');
		} else {
			if (!empty($_POST)) {

				$array = array(

					'accomodations' => !empty($this->input->post('accomodations')) ? $this->input->post('accomodations') : '',
					'new_doctor' => !empty($this->input->post('new_doctor')) ? $this->input->post('new_doctor') : '',
					'doctor_id' => !empty($this->input->post('doctor_id')) ? $this->input->post('doctor_id') : '0',
					'message' => !empty($this->input->post('message')) ? $this->input->post('message') : '',
					'stay_length' => !empty($this->input->post('stay_length')) ? $this->input->post('stay_length') : '',

					'hotel_name' => !empty($this->input->post('hotel_name')) ? $this->input->post('hotel_name') : '',
					'hotel_cost' => !empty($this->input->post('hotel_cost')) ? $this->input->post('hotel_cost') : '',

					'treatment_cost' => !empty($this->input->post('treatment_cost')) ? $this->input->post('treatment_cost') : '',
					'file_one' => $file_one,
					'file_two' => $file_two,
					'file_three' => $file_three,
					'file_four' => $file_four,
					'file_five' => $file_five,
					'revised_date' => date('Y-m-d'),
					
				);

				$this->db->where('quote_sent_id', $id);
				$this->db->update('tbl_quote_sent', $array);

				$this->session->set_flashdata('success_message', 'Updated Successfully');
				redirect('quotes_sent');
			}

			$data['facility_data'] = $this->db->query("SELECT * FROM tbl_user  WHERE user_id = '$this->user_id'")->row_array();

			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
			$this->load->view('quotes_sent/edit', $data);
			$this->load->view('common/user_backend_footer');
		}

	}

}
