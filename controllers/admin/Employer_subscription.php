
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_subscription extends CI_Controller {
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
	

	public function index()
	{
	  	is_admin_in();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$getRecord = $this->db->select('tbl_employer_subscription.*');
		$getRecord = $this->db->from('tbl_employer_subscription');
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		$this->load->view('admin/employer_subscription/list', $data);
		$this->load->view('admin/common/footer');
	}  

	public function edit($id)
	{
		if (!empty($_POST)){
			$array = array(
				'name'     => !empty($this->input->post('name')) ? $this->input->post('name') : '',
				'setup_fee'     => !empty($this->input->post('setup_fee')) ? $this->input->post('setup_fee') : '',
				'created_date' => date('Y-m-d H:i:s')
			);
			$this->db->where('id', $id);
			$this->db->update('tbl_employer_subscription', $array);

			$this->session->set_flashdata('success_message', 'Employer Subscription Updated Successfully');
			redirect('admin/employer_subscription');
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['user_data'] = $this->common_model->get_tbl_data('tbl_employer_subscription', '*', array('id' => $id), $row = 1);

		$this->load->view('admin/employer_subscription/edit', $data);
		$this->load->view('admin/common/footer');
	}

	public function plan_list($id)
	{
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$getRecord = $this->db->select('tbl_employer_subscription_plan.*');
		$getRecord = $this->db->from('tbl_employer_subscription_plan');
		$getRecord = $this->db->where('tbl_employer_subscription_plan.employer_subscription_id', $id);
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		$data['employer_subscription_id'] = $id;
		
		$this->load->view('admin/employer_subscription/plan_list', $data);
		$this->load->view('admin/common/footer');

	} 

	public function edit_plan($employer_subscription_id, $id)
	{
		if (!empty($_POST)){
			$array = array(
				'plan_name'      => !empty($this->input->post('plan_name')) ? $this->input->post('plan_name') : '',
				'price'     	 => !empty($this->input->post('price')) ? $this->input->post('price') : '0',
				'payable_amount' => !empty($this->input->post('payable_amount')) ? $this->input->post('payable_amount') : '0',
				'plan_id'  		 => !empty($this->input->post('plan_id')) ? $this->input->post('plan_id') : '',
			);
			$this->db->where('id', $id);
			$this->db->update('tbl_employer_subscription_plan', $array);

			$this->session->set_flashdata('success_message', 'Employer Subscription Plan Updated Successfully');
	
			redirect(base_url() . 'admin/employer_subscription/plan_list/'.$employer_subscription_id);
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['user_data'] = $this->common_model->get_tbl_data('tbl_employer_subscription_plan', '*', array('id' => $id), $row = 1);
	
		$this->load->view('admin/employer_subscription/edit_plan', $data);
		$this->load->view('admin/common/footer');
	}


}

?>