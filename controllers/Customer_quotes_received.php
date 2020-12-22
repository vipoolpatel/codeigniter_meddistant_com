<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_quotes_received extends CI_Controller {
	public $user_id;
	public $user_email;

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_email = $this->session->userdata('email');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}
	}

	public function index() {
		is_user_in();
		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		$quotes_received_data = $this->db->select('tbl_quote_sent.*,tbl_quote_request.*,tbl_treatment.treatment_name as procedure_treatment, tbl_quote_sent.message as msg');
		$quotes_received_data = $this->db->from('tbl_quote_sent');
		$quotes_received_data = $this->db->join('tbl_quote_request', 'tbl_quote_request.id = tbl_quote_sent.quote_request_id');
		$quotes_received_data = $this->db->join('tbl_treatment', 'tbl_treatment.id = tbl_quote_request.procedure_treatment');
		$quotes_received_data = $this->db->where('tbl_quote_request.email', $this->user_email);
		$quotes_received_data = $this->db->order_by('tbl_quote_sent.created_on', 'DESC');
		$quotes_received_data = $this->db->get()->result_array();
		$data['quotes_received_data'] = $quotes_received_data;

		$this->load->view('customer_quotes_received/quotes_received', $data);
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

			$data['facility_data'] = $this->db->query("SELECT * FROM tbl_facility INNER JOIN tbl_user ON tbl_facility.id_user = tbl_user.user_id WHERE tbl_facility.id_user = '$this->user_id'")->row_array();

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
	public function view_doctor_profile($doctor_id) {

		$data['user_data'] = $this->db->query("SELECT *  FROM tbl_doctors  WHERE doctor_id = '$doctor_id'")->result_array()[0];
		if ($this->session->userdata('user_type') === 'agent') {
			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
			$this->load->view('quotes_requested/doctor_detail', $data);
			$this->load->view('admin/common/footer');
		} else {
			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
			$this->load->view('quotes_requested/doctor_detail', $data);
			$this->load->view('common/user_backend_footer');
		}

	}

}
