<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {

		parent::__construct();

		$this->user_id = $this->session->userdata('user_id');

		$this->currTime = time();

		$this->currDate = date('Y-m-d H:i:s');

	}
	public function email1() {
		$user = 'joez@meddistant.com';
		$pass = 'Waysbar123$';
		$this->load->library('email');

		$config = array(
			'protocol' => 'mail',
			'smtp_host' => 'mail.meddistant.com',
			'smtp_port' => 587,
			'smtp_user' => $user,
			'smtp_pass' => $pass,
			'mailtype' => 'html',
			'charset' => 'utf-8',
		);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->from('joez@meddistant.com', "Meddistant");
		$this->email->to('ketansangani12@gmail.com');

		$this->email->subject('Test123');
		$this->email->message('Ketan here 123');
		$this->email->send();
		echo $this->email->print_debugger();exit;
	}
	public function email() {
		$user = 'joez@meddistant.com';
		$pass = 'Waysbar123$';
		$this->load->library('email');

		$config = array(
			'protocol' => 'mail',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'joez@meddistant.com',
			'smtp_pass' => 'Waysbar123$',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
		);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->from('joez@meddistant.com', "Meddistant");
		$this->email->to('ketansangani38@gmail.com');

		$this->email->subject('Test');
		$this->email->message('Ketan here');
		$this->email->send();
		echo $this->email->print_debugger();exit;
	}
	public function index() {
		/*$this->load->view('admin/common/header');
			is_admin_in();
			$data['reservation_data'] = $qry = $this->db->query("SELECT * FROM tbl_user INNER JOIN tbl_reservation ON tbl_user.user_id = tbl_reservation.id_user ORDER BY tbl_reservation.booking_date DESC")->result_array();
			$this->load->view('admin/dashboard/dashboard', $data);

			$this->load->view('admin/common/menubar');
		*/
		is_admin_in();

		//var_dump($send);exit;
		if ($this->session->userdata('user_type') == 'agent') {
			$data['quote_data'] = $this->db->query("SELECT tbl_quote_request.*, tbl_user.user_type FROM tbl_quote_request left outer join tbl_user on tbl_user.user_id = tbl_quote_request.added_by  WHERE added_by = '$this->user_id' OR assigned_agent = '$this->user_id' ORDER BY created_on DESC")->result_array();

			$this->load->view('admin/common/header');

			$this->load->view('admin/common/menubar');

			$this->load->view('admin/agent/quote_list', $data);

			$this->load->view('admin/common/footer');
		} else {
			$data['quote_data'] = $this->db->query("SELECT qt.*, u.user_type
												FROM tbl_quote_request as qt
												left join tbl_user as u on u.user_id = qt.added_by
												ORDER BY created_on DESC")->result_array();
			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
			$this->load->view('admin/manage_quotes/quote_list', $data);
			$this->load->view('admin/common/footer');
		}

	}

	public function about() {

		$this->load->view('common/header');
		$this->load->view('common/menubar');
		$this->load->view('welcome/about');
		$this->load->view('common/footer');
	}

	public function availability() {

		$this->load->view('common/header');
		$this->load->view('common/menubar');
		$this->load->view('welcome/availability');
		//$this->load->view('common/footer');
	}

	public function gallery() {

		$this->load->view('common/header');
		$this->load->view('common/menubar');
		$this->load->view('welcome/gallery');
		$this->load->view('common/footer');
	}

}
