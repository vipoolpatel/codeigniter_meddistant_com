<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Entrollment_data extends CI_Controller {
	public $user_id;

	function __construct() {
		parent::__construct();
		is_user_in();
		$this->user_id = $this->session->userdata('user_id');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}

	}

	public function index() {
		// echo $this->user_id;
		// die;

		if (!empty($_POST)) {
			$data = array(
				// 'address' => $this->input->post('address'),
				// 'city' => $this->input->post('city'),
				// 'state' => $this->input->post('state'),
				// 'zipcode' => $this->input->post('zipcode'),
				// 'company_type_id' => $this->input->post('company_type_id'),
				'company_description' => $this->input->post('company_description'),
				// 'enter_number' => $this->input->post('enter_number'),
				'self_insured_employer' => $this->input->post('self_insured_employer'),
				'employees_travel' => $this->input->post('employees_travel'),
				'terms' => !empty($this->input->post('terms')) ? 'yes' : '',
				'entrollment_date' => $this->input->post('entrollment_date'),
			);

			$this->db->where('user_id', $this->user_id);
			$this->db->update('tbl_user', $data);

			$this->session->set_flashdata('success_message', 'Entrollment data updated successfully!');
			redirect('entrollment_data');

		}

		$getUser = $this->db->select('tbl_user.*,tbl_employer_subscription.name');
		$getUser = $this->db->from('tbl_user');
		$getUser = $this->db->join('tbl_employer_subscription','tbl_employer_subscription.id = tbl_user.employer_subscription_id','left');
		$getUser = $this->db->where('tbl_user.user_id', $this->user_id);
		$getUser = $this->db->get()->row();
		$data['getUser'] = $getUser;

		$tbl_country = $this->db->where('country_name', $getUser->country);
		$tbl_country = $this->db->get('tbl_country')->row();
		$data['getCountry_id'] = !empty($tbl_country->id) ? $tbl_country->id : '';

		$data['company_type'] = $this->db->get('tbl_company_type')->result();

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('employer/entrollment/add', $data);
		$this->load->view('common/user_backend_footer');
	}

}
