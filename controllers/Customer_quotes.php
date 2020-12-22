<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Customer_quotes extends CI_Controller {
	public $user_id;

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

	}

	public function index() {
		is_user_in();
		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		// $data['customer_quotes_data'] = $this->common_model->get_tbl_data('quote_request', '*', array('email' => $this->session->userdata('email')), '', 'created_on DESC');

		$data['customer_quotes_data'] = $this->common_model->get_tbl_data_customer($this->session->userdata('email'));

		$this->load->view('customer_quotes/customer_quotes_list', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function add_facility() {
		is_user_in();
		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		$this->load->view('facility/add_facility');

		$this->load->view('common/user_backend_footer');
	}

	public function dlt_customer_quote() {
		$id = $this->uri->segment(3);

		$this->db->query("UPDATE tbl_quote_request set status =1 where id=" . $id);

		$this->session->set_flashdata('success', 'Quote Deleted Successfully');
		redirect('customer_quotes/');

	}

}
