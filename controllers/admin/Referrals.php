<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referrals extends CI_Controller {
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

		$this->db->select('tbl_referrals.*,tbl_user.username');
		$this->db->from('tbl_referrals');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_referrals.user_id');

		if($this->session->userdata('user_type') == 'agent')
		{
			 $this->db->where('tbl_user.agent_id',$this->user_id);	
		}

		$query = $this->db->get();





		$data['getRecord'] = $query->result();
		$this->load->view('admin/referral/list', $data);
		$this->load->view('admin/common/footer');
	}

	public function view($id) {
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$this->db->select('tbl_referrals.*,tbl_user.username');
		$this->db->from('tbl_referrals');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_referrals.user_id');
		$this->db->where('tbl_referrals.id', $id);
		$data['upcomming'] = $this->db->get()->row();

		$this->load->view('admin/referral/view', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_referrals');
		$this->session->set_flashdata('success_message', 'Record Deleted Successfully');
		redirect('admin/referrals');
	}

}
