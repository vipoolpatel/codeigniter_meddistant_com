<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Archives extends CI_Controller {
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

		$date = date('Y-m-d', strtotime("-90 days"));

		is_admin_in();
		$this->load->view('admin/common/header');

		$this->load->view('admin/common/menubar');

		$quote_data = $this->db->query("SELECT tbl_quote_request.*, tbl_user.user_type FROM tbl_quote_request left outer join tbl_user on tbl_user.user_id = tbl_quote_request.added_by where tbl_quote_request.created_on <= '" . $date . "'  ORDER BY created_on DESC")->result_array();

		$data['quote_data'] = $quote_data;
		$this->load->view('admin/archive/quote_list', $data);
		$this->load->view('admin/common/footer');
	}

}
