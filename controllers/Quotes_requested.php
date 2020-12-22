<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Quotes_requested extends CI_Controller {
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
		$this->common_model->update_procedure_treatment($this->user_id);

		redirect('dashboard');

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->db->select('country,updated_on');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $this->user_id);

//        a.kader
		$this->db->where('approved', '1');
		$hospital_country_arr = $this->db->get()->result();
		$data['quote_requested_data'] = null;
		// print_r($hospital_country_arr);exit;
		if (count($hospital_country_arr) > 0) {
			$hospital_country = $hospital_country_arr[0]->country;
			$update_on = $hospital_country_arr[0]->updated_on;
			$data['quote_requested_data'] = $this->db->query("SELECT * ,tbl_quote_request.created_on, tbl_treatment.treatment_name as procedure_treatment,tbl_quote_request.id FROM tbl_quote_request INNER JOIN tbl_facility_procedure ON tbl_quote_request.procedure_treatment = tbl_facility_procedure.procedure_name INNER JOIN tbl_treatment ON tbl_treatment.id = tbl_quote_request.procedure_treatment WHERE tbl_facility_procedure.id_tbl_user = '$this->user_id' and (tbl_quote_request.desired_country= '$hospital_country' OR tbl_quote_request.desired_country2= '$hospital_country' )AND tbl_quote_request.created_on>='" . $update_on . "' GROUP BY tbl_quote_request.request_no   ORDER BY tbl_quote_request.created_on DESC")->result_array();
		}

		$this->load->view('quotes_requested/quotes_requested', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function getDoctor() {
		$hospital_id = $this->input->post('user_id');
		$doctors = $this->db->query("SELECT * FROM tbl_doctors WHERE  tbl_doctors.hospital_id = '" . $hospital_id . "' ")->result();

		$html = '';

		$html .= '<option value="">Select Doctor</option>';
		foreach ($doctors as $doctor) {
			$html .= '<option value="' . $doctor->doctor_id . '">' . $doctor->name . '</option>';
		}

		$html .= '<option value="0">Add Other Doctor</option>';
		$json['success'] = $html;
		echo json_encode($json);

	}

	public function manage_send_quote() {

		$quote_request_id = $this->uri->segment(3);

		$send_quote_data = $this->common_model->get_tbl_data_by_id($quote_request_id);
		$data['send_quote_data'] = $send_quote_data;

		$data['facility_data'] = $this->db->query("SELECT * FROM tbl_user  WHERE user_id = '$this->user_id'")->row_array();

		$data['doctors'] = $this->db->query("SELECT * FROM tbl_doctors INNER JOIN tbl_user ON tbl_doctors.id_user = tbl_user.user_id WHERE tbl_user.user_id = '$this->user_id'")->result_array();

		if (!empty($_FILES["file_one"]["name"])) {
			$file_one = $_FILES["file_one"]["name"];
			$array_name = explode(".", $file_one);
			$ext = end($array_name);

			$file_one = date('ymdhis') . '1.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_one"]["tmp_name"], $folder . $file_one);
		} else {
			$file_one = '';
		}

		if (!empty($_FILES["file_two"]["name"])) {
			$file_two = $_FILES["file_two"]["name"];
			$array_name = explode(".", $file_two);
			$ext = end($array_name);

			$file_two = date('ymdhis') . '2.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_two"]["tmp_name"], $folder . $file_two);
		} else {
			$file_two = '';
		}

		if (!empty($_FILES["file_three"]["name"])) {
			$file_three = $_FILES["file_three"]["name"];
			$array_name = explode(".", $file_three);
			$ext = end($array_name);

			$file_three = date('ymdhis') . '3.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_three"]["tmp_name"], $folder . $file_three);
		} else {
			$file_three = '';
		}

		if (!empty($_FILES["file_four"]["name"])) {
			$file_four = $_FILES["file_four"]["name"];
			$array_name = explode(".", $file_four);
			$ext = end($array_name);

			$file_four = date('ymdhis') . '4.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_four"]["tmp_name"], $folder . $file_four);
		} else {
			$file_four = '';
		}

		if (!empty($_FILES["file_five"]["name"])) {
			$file_five = $_FILES["file_five"]["name"];
			$array_name = explode(".", $file_five);
			$ext = end($array_name);

			$file_five = date('ymdhis') . '5.' . $ext;
			$folder = "uploads/quotes/";
			move_uploaded_file($_FILES["file_five"]["tmp_name"], $folder . $file_five);
		} else {
			$file_five = '';
		}

		if ($this->session->userdata('user_type') === 'agent') {

			is_admin_in();

			if (!empty($_POST)) {

				if ($this->input->post('type') == 'Service') {
					$hospital_clinic = 'N/A';
					$accomodations = 'N/A';
					$stay_length = 'N/A';
					$hospital_id = 0;
				} else {
					$get_name_hospital_clinic = $this->db->where('id', $this->input->post('hospital_clinic'));
					$get_name_hospital_clinic = $this->db->get('tbl_hospital')->row();

					$hospital_id = !empty($get_name_hospital_clinic->user_id) ? $get_name_hospital_clinic->user_id : '';

					$hospital_clinic = !empty($get_name_hospital_clinic->hospital_name) ? $get_name_hospital_clinic->hospital_name : $this->input->post('new_hospital_clinic');

					$accomodations = $this->input->post('accomodations');
					$stay_length = $this->input->post('stay_length');
				}

				$quote_sent_data = array(
					'id_user' => $this->user_id,

					'hospital_table_id' => !empty($this->input->post('hospital_clinic')) ? $this->input->post('hospital_clinic') : 0,

					'hospital_id' => !empty($hospital_id) ? $hospital_id : 0,

					'quote_request_id'  => $this->input->post('quote_request_id'),
					'service_name' 		=> !empty($this->input->post('service_name')) ? $this->input->post('service_name') : 'N/A',
					'type' 				=> $this->input->post('type'),
					'hospital_clinic' 	=> $hospital_clinic,
					'hospital_ref' 		=> $this->input->post('hospital_ref'),
					'quote_preparer_name' => $this->input->post('quote_preparer_name'),
					'doctor_id' 	 => !empty($this->input->post('doctor')) ? $this->input->post('doctor') : '',
					'hotel_name'     => !empty($this->input->post('hotel_name')) ? $this->input->post('hotel_name') : '',
					'hotel_cost' 	 => !empty($this->input->post('hotel_cost')) ? $this->input->post('hotel_cost') : '',
					'accomodations'  => $accomodations,
					'new_doctor' 	 => !empty($this->input->post('new_doctor')) ? $this->input->post('new_doctor') : '',
					'message' 		 => $this->input->post('message'),
					'stay_length' 	 => $stay_length,
					'treatment_cost' => !empty($this->input->post('treatment_cost')) ? $this->input->post('treatment_cost') : 0,
					'agent_prepay' 	 => !empty($this->input->post('agent_prepay')) ? $this->input->post('agent_prepay') : 0,
					'facilitation_fees'  => !empty($this->input->post('facilitation_fees')) ? $this->input->post('facilitation_fees') : 0,
					'is_determined'  => !empty($this->input->post('is_determined')) ? 1 : 0,				
					'quote_by' 	 => 'Meddistant',
					'created_on' => date('Y-m-d H:i:s'),
					'file_one'   => $file_one,
					'file_two'   => $file_two,
					'file_three' => $file_three,
					'file_four'  => $file_four,
					'file_five' => $file_five,
				);

				$insert_id = $this->common_model->insert_tbl_data('quote_sent', $quote_sent_data);

				$this->common_model->quotes_requested_mail_customer($insert_id);

				$this->session->set_flashdata('success_message', 'Quote Sent Successfully!');
				redirect('admin/dashboard');

			}

			$data['hospital'] = $this->common_model->get_tbl_data_hospital_table($send_quote_data['desired_country'], $send_quote_data['desired_country2']);

			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
			$this->load->view('quotes_requested/manage_send_quote', $data);
			$this->load->view('admin/common/footer');

		} else {
			$is_new = $this->input->post('add');
			$is_edit = $this->input->post('edit');
			$edit_id = $this->input->post('edit_id');

			if (isset($is_new) OR isset($is_edit)) {

				$get_name_hospital_clinic = $this->db->where('id', $this->input->post('hospital_clinic'));
				$get_name_hospital_clinic = $this->db->get('tbl_hospital')->row();

				$hospital_clinic = !empty($get_name_hospital_clinic->hospital_name) ? $get_name_hospital_clinic->hospital_name : '';

				$facilitation_fees = 0;
				if(!empty($this->input->post('is_determined')))
				{
					if($data['facility_data']['country'] == 'USA')
					{
						$facilitation_fees = 500;
					}
					else
					{
						$facilitation_fees = 300;
					}
				}
				else
				{

					$get_quote_request = $this->db->where('id', $this->input->post('quote_request_id'));
					$get_quote_request = $this->db->get('tbl_quote_request')->row();

					$get_referral = $this->db->where('ref_email', $get_quote_request->email);
					$get_referral = $this->db->get('tbl_referrals')->num_rows();

					if(!empty($get_referral))
					{
						$facilitation_fees = $this->input->post('treatment_cost') * 0.025;
					}
					else
					{
						$facilitation_fees = $this->input->post('treatment_cost') * 0.05;
					}					
				}
				

				$quote_sent_data = array(
					'id_user' => $this->user_id,
					'hospital_table_id' => !empty($this->input->post('hospital_clinic')) ? $this->input->post('hospital_clinic') : 0,
					'hospital_id' => $this->user_id,
					'type' => $this->input->post('type'),
					'quote_request_id' => $this->input->post('quote_request_id'),
					'hospital_clinic' => $hospital_clinic,
					'hospital_ref' => $this->input->post('hospital_ref'),
					'quote_preparer_name' => $this->input->post('quote_preparer_name'),
					'doctor_id' => $this->input->post('doctor'),
					'accomodations' => $this->input->post('accomodations'),
					'hotel_name' => !empty($this->input->post('hotel_name')) ? $this->input->post('hotel_name') : '',
					'hotel_cost' => !empty($this->input->post('hotel_cost')) ? $this->input->post('hotel_cost') : '',
					'new_doctor' => $this->input->post('new_doctor'),
					'message' => $this->input->post('message'),
					'stay_length' => $this->input->post('stay_length'),
					'treatment_cost' => !empty($this->input->post('treatment_cost')) ? $this->input->post('treatment_cost') : 0,
					'is_determined'  => !empty($this->input->post('is_determined')) ? 1 : 0,
					'quote_by' => 'Hospital/Clinic',
					'facilitation_fees'  => $facilitation_fees,
					'file_one' => $file_one,
					'file_two' => $file_two,
					'file_three' => $file_three,
					'file_four' => $file_four,
					'file_five' => $file_five,
					'created_on' => date('Y-m-d H:i:s'),
				);

				if ($is_new) {

					$insert_id = $this->common_model->insert_tbl_data('quote_sent', $quote_sent_data);
					$this->common_model->quotes_requested_mail_customer($insert_id);
					$this->session->set_flashdata('success_message', 'Quote Sent Successfully!');
					redirect('quotes_requested/');

				} else {

				}
			} else {

				$hospital = $this->common_model->getHospitalList();

				if (empty($hospital)) {
					redirect('manage_facility/add_hospitals');
				}

				$data['hospital'] = $hospital;

				$this->load->view('common/user_backend_header');
				$this->load->view('common/user_backend_menubar');
				$this->load->view('quotes_requested/manage_send_quote', $data);
				$this->load->view('common/user_backend_footer');
			}
		}

	}

	public function dlt_customer_quote() {
		$id = $this->uri->segment(3);

		$this->common_model->dlt_tbl_data('quote_request', array('id' => $id));

		$this->session->set_flashdata('success', 'Quote Deleted Successfully');
		redirect('customer_quotes/');

	}

}
