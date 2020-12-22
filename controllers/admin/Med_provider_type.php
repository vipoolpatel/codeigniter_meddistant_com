<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Med_provider_type extends CI_Controller
{	
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
		// $this->load->model('common_model', '', TRUE);
	}
	// Med. Provider Type Start
	public function index()
	{
		is_admin_in();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$getRecord = $this->db->select('tbl_med_provider_type.*');
		$getRecord = $this->db->from('tbl_med_provider_type');
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		$this->load->view('admin/med_provider_type/list', $data);
		$this->load->view('admin/common/footer');
	}

	public function edit($id)
	{
		if (!empty($_POST)){
			$array = array(
				'name'     => !empty($this->input->post('name')) ? $this->input->post('name') : '',
				'text_name'     => !empty($this->input->post('text_name')) ? $this->input->post('text_name') : '',
				
				// 'plan_id'  => !empty($this->input->post('plan_id')) ? $this->input->post('plan_id') : '',
				// 'price'    => !empty($this->input->post('price')) ? $this->input->post('price') : '0',
				'setup_fee'    => !empty($this->input->post('setup_fee')) ? $this->input->post('setup_fee') : '0',
				// 'annual_rate'    => !empty($this->input->post('annual_rate')) ? $this->input->post('annual_rate') : '0',
				// 'bi_annual_rate'    => !empty($this->input->post('bi_annual_rate')) ? $this->input->post('bi_annual_rate') : '0',
				'created_date' => date('Y-m-d H:i:s')
			);
			$this->db->where('id', $id);
			$this->db->update('tbl_med_provider_type', $array);

			$this->session->set_flashdata('success_message', 'Med Provider Type Updated Successfully');
			redirect('admin/med_provider_type');
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['user_data'] = $this->common_model->get_tbl_data('tbl_med_provider_type', '*', array('id' => $id), $row = 1);

		$this->load->view('admin/med_provider_type/edit', $data);
		$this->load->view('admin/common/footer');
	}
	// Med. Provider Type End
	// Plan Start
	public function plan_list($id)
	{
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$getRecord = $this->db->select('tbl_med_provider_type_plan.*');
		$getRecord = $this->db->from('tbl_med_provider_type_plan');
		$getRecord = $this->db->where('tbl_med_provider_type_plan.provider_type_id', $id);
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		$data['provider_type_id'] = $id;
		
		$this->load->view('admin/med_provider_type/plan_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function add_plan($id)
	{

		if(!empty($_POST))
		{
			$array = array(
				'provider_type_id' => $id,
				'plan_name'        => trim($this->input->post('plan_name')),
                'plan_id'          => trim($this->input->post('plan_id')),
                'price'            => trim($this->input->post('price')),
                
			);

			$this->db->insert('tbl_med_provider_type_plan', $array);

			$this->session->set_flashdata('success_message', 'Plan Created Successfully.');
			redirect(base_url() . 'admin/med_provider_type/plan_list/'.$id);
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		
		$this->load->view('admin/med_provider_type/add_plan');
		$this->load->view('admin/common/footer');
	}


	public function edit_plan($provider_type_id, $id)
	{
		if (!empty($_POST)){
			$array = array(
				'plan_name'     => !empty($this->input->post('plan_name')) ? $this->input->post('plan_name') : '',
				'price'     => !empty($this->input->post('price')) ? $this->input->post('price') : '0',
				'payable_amount'     => !empty($this->input->post('payable_amount')) ? $this->input->post('payable_amount') : '0',
				'plan_id'  => !empty($this->input->post('plan_id')) ? $this->input->post('plan_id') : '',
				
				
			);
			$this->db->where('id', $id);
			$this->db->update('tbl_med_provider_type_plan', $array);

			$this->session->set_flashdata('success_message', 'Plan Updated Successfully');
	
			redirect(base_url() . 'admin/med_provider_type/plan_list/'.$provider_type_id);
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['user_data'] = $this->common_model->get_tbl_data('tbl_med_provider_type_plan', '*', array('id' => $id), $row = 1);
	
		$this->load->view('admin/med_provider_type/edit_plan', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete_plan($provider_type_id, $id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_med_provider_type_plan');
		$this->session->set_flashdata('success_message', "Plan deleted successfully! ");
		redirect('admin/med_provider_type/plan_list/' . $provider_type_id);
	}


	// Plan End
}

?>