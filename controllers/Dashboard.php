<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Dashboard extends CI_Controller {
	public $user_id;

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}
	}

	public function index() {
		is_user_in();

		if ($this->session->userdata('user_type') === 'employer' || $this->session->userdata('user_type') === 'customer' || $this->session->userdata('user_type') === 'hospital') {
			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
		} else {
			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
		}

		$data['user_data'] = $this->common_model->get_tbl_data('user', '*', array('user_id' => $this->user_id));
		if ($this->session->userdata('user_type') === 'employer') {

			$validate = $this->db->where('user_id', $this->user_id);
			$validate = $this->db->get('tbl_user')->row();
			$data['validate'] = $validate;
			$this->load->view('employer/dashboard', $data);

		} else if ($this->session->userdata('user_type') === 'customer') {

			// $data['customer_quotes_data'] = $this->common_model->get_tbl_data('quote_request', '*', array('email' => $this->session->userdata('email')), '', 'created_on DESC');

			$data['customer_quotes_data'] = $this->common_model->get_tbl_data_customer($this->session->userdata('email'));

			$this->load->view('customer_quotes/customer_quotes_list', $data);

		} else if ($this->session->userdata('user_type') === 'hospital') {

			$this->common_model->update_procedure_treatment($this->user_id);

			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');

			$this->db->select('state,country,updated_on,is_quote,start_quote_date,end_quote_date');
			$this->db->from('tbl_user');
			$this->db->where('user_id', $this->user_id);

			$this->db->where('approved', '1');
			$hospital_country_arr = $this->db->get()->result();
			$data['quote_requested_data'] = null;

			$hospital_country = $hospital_country_arr[0]->country;

			$hospital_state = $hospital_country_arr[0]->state;
			$updated_on 	= $hospital_country_arr[0]->updated_on;

			

			if(!empty($hospital_country_arr[0]->start_quote_date))
			{
				$start_quote_date 	= $hospital_country_arr[0]->start_quote_date;
			}
			else
			{
				$start_quote_date = date('Y-m-d H:i:s');
				$start_quote_date = date("Y-m-d H:i:s", strtotime("+1 day", strtotime($start_quote_date)));
			}	


			if(!empty($hospital_country_arr[0]->end_quote_date))
			{
				$end_quote_date = $hospital_country_arr[0]->end_quote_date;
			}
			else
			{
				$end_quote_date = date('Y-m-d H:i:s');
				// $end_quote_date = date("Y-m-d H:i:s", strtotime("+1 day", strtotime($start_quote_date)));
			}	
			



			// echo $start_quote_date;
			// die;


			$quote_requested_data = $this->db->query("SELECT *,tbl_quote_request.status,tbl_quote_request.created_on,tbl_quote_request.id,tbl_treatment.treatment_name as procedure_treatment FROM tbl_quote_request
				INNER JOIN tbl_facility_procedure ON tbl_quote_request.procedure_treatment = tbl_facility_procedure.procedure_name
				INNER JOIN tbl_treatment ON tbl_treatment.id = tbl_quote_request.procedure_treatment
				WHERE tbl_facility_procedure.id_tbl_user = '".$this->user_id."' AND (tbl_quote_request.desired_country= '".$hospital_country."' OR tbl_quote_request.desired_country2= '".$hospital_country."') 
				AND 
				tbl_quote_request.created_on >= '" . $start_quote_date . "' AND 
				tbl_quote_request.created_on <= '" . $end_quote_date . "' AND 
				tbl_quote_request.quote_status != 'incomplete' GROUP BY tbl_quote_request.request_no ORDER BY tbl_quote_request.created_on DESC")->result_array();

			
	// is_completed


			// $data['quote_requested_data'] = $this->db->query("SELECT *,tbl_quote_request.created_on,tbl_quote_request.id,tbl_treatment.treatment_name as procedure_treatment FROM tbl_quote_request
			// 	INNER JOIN tbl_facility_procedure ON tbl_quote_request.procedure_treatment = tbl_facility_procedure.procedure_name
			// 	INNER JOIN tbl_treatment ON tbl_treatment.id = tbl_quote_request.procedure_treatment
			// 	WHERE tbl_facility_procedure.id_tbl_user = '$this->user_id' 
			// 	AND (tbl_quote_request.desired_country= '$hospital_country' OR tbl_quote_request.desired_country2= '$hospital_country' ) 
			// 	AND tbl_quote_request.created_on>='" . $update_on . "' AND tbl_quote_request.quote_status != 'incomplete' GROUP BY tbl_quote_request.request_no  ORDER BY tbl_quote_request.created_on DESC")->result_array();


			 $i = 0;
			 foreach ($quote_requested_data as $item){
				 if (!empty($item['destination_hospital_id'])) {

					 if (trim($item['destination_hospital_id']) == trim($this->user_id))
					 {

					 }
					 else
				     {
                        unset($quote_requested_data[$i]);
					 }						 
				 }
				 
				 if (!empty($item['desired_state'])){
				 	 if (trim($item['desired_state']) == trim($hospital_state))
				 	 {

					 }
					 else
					 {
				        unset($quote_requested_data[$i]);
					 }	
				 }		 
				 $i++;
			}
	 
			$data['quote_requested_data'] = $quote_requested_data;
		

			$this->load->view('quotes_requested/quotes_requested', $data);
		} else if ($this->session->userdata('user_type') === 'agent') {
			$this->load->view('dashboard/agent_dashboard', $data);
		} else {
			$this->load->view('dashboard/admin_dashboard', $data);
		}

		if ($this->session->userdata('user_type') === 'employer' || $this->session->userdata('user_type') === 'customer' || $this->session->userdata('user_type') === 'hospital') {
			$this->load->view('common/user_backend_footer');
		} else {
			$this->load->view('admin/common/footer');
		}

	}
}
