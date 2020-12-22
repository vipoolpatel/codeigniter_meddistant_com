<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Quotes_sent extends CI_Controller {
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
		$this->db->select('country');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $this->user_id);
		$this->db->where('approved', '1');
		$hospital_country_arr = $this->db->get()->result();
		$data['quote_requested_data'] = null;
		if (count($hospital_country_arr) > 0) {
			$data['quote_requested_data'] = $this->db->query("SELECT *, tbl_quote_sent.message as msg, tbl_treatment.treatment_name as procedure_treatment, tbl_quote_sent.created_on as created, tbl_quote_request.id FROM tbl_quote_sent INNER JOIN tbl_quote_request ON tbl_quote_sent.quote_request_id = tbl_quote_request.id INNER JOIN tbl_treatment ON tbl_treatment.id = tbl_quote_request.procedure_treatment WHERE tbl_quote_sent.id_user = '$this->user_id' ORDER BY tbl_quote_sent.created_on DESC")->result_array();

		}

		$this->load->view('admin/quotes_sent/quotes_sent', $data);
		$this->load->view('admin/common/footer');
	}
}