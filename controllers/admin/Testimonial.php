<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Testimonial extends CI_Controller {
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

		$this->db->select('tbl_testimonial.*,tbl_user.city,tbl_user.first_name,tbl_user.picture,tbl_user.last_name,tbl_user.country');
		$this->db->from('tbl_testimonial');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_testimonial.user_id');
		$query = $this->db->get();
		$data['getRecord'] = $query->result();
		$this->load->view('admin/testimonial/testimonial_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_testimonial');
		$this->session->set_flashdata('success_message', 'Testimonial Deleted Successfully');
		redirect('admin/testimonial');
	}

	public function ChangeStatus() {
		$this->db->set('status', $this->input->post('status'));
		$this->db->where('id', $this->input->post('id'));
		$this->db->update($this->input->post('table'));

		$json['sucess'] = true;
		echo json_encode($json);
	}

}
