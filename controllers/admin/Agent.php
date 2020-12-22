<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 300);
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
ini_set('display_startup_errors', 1);
error_reporting(-1);
class Agent extends CI_Controller
{

	public $user_id;
	public $currTime;
	public $currDate;

	function __construct()
	{

		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->currTime = time();
		$this->currDate = date('Y-m-d H:i:s');
		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}
	}



	// public function referral_list()
	// {
	// 	$getRecord = $this->db->where('user_id', $this->user_id);
	// 	$getRecord = $this->db->get('tbl_referrals')->result();
	// 	$data['getRecord'] = $getRecord;

	// 	$this->load->view('admin/common/header');
	// 	$this->load->view('admin/common/menubar');
	// 	$this->load->view('admin/referral/referral_list', $data);
	// 	$this->load->view('admin/common/footer');
	// }


	public function add_referral()
	{
		$this->load->library('form_validation');
		if (!empty($_POST)) {
			$this->form_validation->set_rules('ref_email', 'Email', 'required|is_unique[tbl_referrals.ref_email]');
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'user_id'		 	=> $this->input->post('user_id'),
					'ref_first_name' 	=> $this->input->post('ref_first_name'),
					'ref_last_name'  	=> $this->input->post('ref_last_name'),
					'ref_email'  	 	=> $this->input->post('ref_email'),
					'ref_phone' 		=> $this->input->post('ref_phone'),
					'ref_created_date'  => date('Y-m-d H:i:s'),
				);

				$this->db->insert('tbl_referrals', $data);
				$this->session->set_flashdata('success_message', 'Referral Created Successfully');
				redirect('admin/referrals');
			}
		}

		if($this->session->userdata('user_type') == 'agent')
		{
			$get_company = $this->db->where('agent_id',$this->user_id);	
		}

		$get_company = $this->db->where('user_type','employer');
		$get_company = $this->db->get('tbl_user')->result();

		$data['get_company'] = $get_company;
		


		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/referral/add_referral',$data);
		$this->load->view('admin/common/footer');	
	}


	// public function edit_referral($id)
	// {

	// 	if (!empty($_POST)) {

	// 		$array = array(
	// 			'ref_first_name' => $this->input->post('ref_first_name'),
	// 			'ref_last_name' => $this->input->post('ref_last_name'),
	// 			'ref_phone' => $this->input->post('ref_phone'),
	// 		);

	// 		$this->db->where('id', $this->input->post('id'));
	// 		$this->db->update('tbl_referrals', $array);

	// 		$this->session->set_flashdata('success_message', 'Referral Updated Successfully');
	// 		redirect('admin/agent/referral_list');
	// 	}

	// 	$edit_row = $this->db->where('user_id', $this->user_id);
	// 	$edit_row = $this->db->where('id', $id);
	// 	$edit_row = $this->db->get('tbl_referrals')->row();

	// 	$data['edit_row'] = $edit_row;

	// 	$this->load->library('form_validation');
	// 	$this->load->view('admin/common/header');
	// 	$this->load->view('admin/common/menubar');
	// 	$this->load->view('admin/referral/edit_referral',$data);
	// 	$this->load->view('admin/common/footer');
	// }

	// public function delete_referral($id)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->delete('tbl_referrals');

	// 	$this->session->set_flashdata('success_message', 'Referral Deleted Successfully');
	// 	redirect('admin/agent/referral_list');
	// }

	public function index()
	{
		is_admin_in();
		$data['agent_data'] = $this->db->query("SELECT * FROM tbl_user WHERE user_type = 'agent' ORDER BY created_on DESC")->result_array();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/agent/agent_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function edit($id)
	{

		$data['getCountry'] = $this->common_model->getCountry('agent');
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$data['user_data'] = $this->common_model->get_tbl_data('user', '*', array('user_id' => $id), $row = 1);


		$data['getRecordState']   = $this->common_model->getStateAgent_SEPARATOR($id);
		$data['getRecordCountry'] = $this->common_model->getCountryAgent_SEPARATOR($id);


		$this->load->view('admin/agent/manage_profile', $data);
		$this->load->view('admin/common/footer');
	}
	public function detail($id)
	{
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$data['user_data'] = $this->common_model->get_tbl_data('user', '*', array('user_id' => $id), $row = 1);
		$this->load->view('admin/agent/detail', $data);
		$this->load->view('admin/common/footer');
	}

	public function update_profile()
	{
		$picture = '';
		$file_element_name = 'picture';
		$file = $_FILES['picture']['name'];
		if (!empty($file)) {
			$config['upload_path'] = './uploads/agent/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 1000000000;
			$new_name = time() . $file;
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($file_element_name)) {
				echo $this->upload->display_errors('', '');
			} else {
				$rowData = $this->upload->data();
				if ($rowData['file_name'] != "") {
					$picture = $rowData["file_name"];
				}
			}
		}
		$update_data = array(
			'first_name' => $this->input->post('username'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'phone_no' => $this->input->post('phone_no'),
			'pay_type' => $this->input->post('pay_type'),
			'pay_rate' => $this->input->post('pay_rate'),
			'agent_type' => $this->input->post('agent_type'),
			'gender' => $this->input->post('gender'),
			'agent_tax_id' => $this->input->post('tax_id'),
			'commission_rate' => $this->input->post('commission_rate'),
			'company_name' => $this->input->post('company_name'),
			// 'company_address' => $this->input->post('company_address'),
			// 'company_country' => $this->input->post('company_country'),
			// 'company_street' => $this->input->post('company_street'),
			// 'company_apt' => $this->input->post('company_apt'),
			// 'company_city' => $this->input->post('company_city'),
			// 'company_state' => $this->input->post('company_state'),
			// 'company_zipcode' => $this->input->post('company_zipcode'),
			// 'company_tax_id' => $this->input->post('company_tax_id'),
			'picture' => $picture,
			// 'country' => $this->input->post('country'),
			// 'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'address' => $this->input->post('address'),
			'zipcode' => $this->input->post('zipcode'),
			'territory' => !empty($this->input->post('territory')) ? 'all' : '',
		);
		$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $this->input->post('user_id')));
		if ($update_qry) {
			$this->session->set_flashdata('success_message', 'Profile Updated Successfully');
			redirect('admin/agent/');
		}
	}
	public function update_pwd($id = '')
	{
		if(!empty($id))
		{
			$update_data = array(
			'password' => md5($this->input->post('password')),
			);
			$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $id));
		}
		else
		{
			$update_data = array(
			'password' => md5($this->input->post('password')),
			);
			$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $this->session->userdata('user_id')));	
		}
		
		if ($update_qry) {
			$this->session->set_flashdata('success_message', 'Password Updated Successfully');
			redirect('admin/agent/');
		}
	}

	public function manage_agent() {

		$this->load->helper(array('form'));
	    $this->load->library('form_validation');
   

		if ($this->uri->segment(4) == 'del') {
			$this->common_model->dlt_tbl_data('user', array('user_id' => $this->uri->segment(5)));

			$this->session->set_flashdata('success_message', 'Agent Deleted Successfully! ');
			redirect('admin/agent/');
		}



		if(!empty($_POST))
		{
			$is_new = $this->input->post('add');
			$is_edit = $this->input->post('edit');
			$edit_id = $this->input->post('edit_id');

			$this->form_validation->set_rules('username', 'User First Name', 'required');
			$this->form_validation->set_rules('last_name', 'User Last Name', 'required');
			$this->form_validation->set_rules('phone_no', 'Phone No', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_user.email]');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'required');

			if ($this->form_validation->run() == TRUE) {

				if (isset($is_new) OR isset($is_edit)) {

					$digits_needed = 6;
					$random_number = ''; 
					$count = 0;
					while ($count < $digits_needed) {
						$random_digit = mt_rand(0, 9);

						$random_number .= $random_digit;
						$count++;
					}
					$picture = '';
					$file_element_name = 'picture';
					$file = $_FILES['picture']['name'];
					if (!empty($file)) {
						$config['upload_path'] = './uploads/agent/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = 1000000000;
						$new_name = time() . $file;
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload($file_element_name)) {
							echo $this->upload->display_errors('', '');
						} else {
							$rowData = $this->upload->data();
							if ($rowData['file_name'] != "") {
								$picture = $rowData["file_name"];
							}
						}
					}


					$user_data = array(
						'username' => $this->input->post('username'),
						'first_name' => $this->input->post('username'),
						'last_name' => $this->input->post('last_name'),
						'email' => $this->input->post('email'),
						'phone_no' => $this->input->post('phone_no'),
						'password' => md5($random_number),
						'user_type' => 'agent',
						'pay_type' => $this->input->post('pay_type'),
						'pay_rate' => $this->input->post('pay_rate'),
						'agent_type' => $this->input->post('agent_type'),
						'gender' => $this->input->post('gender'),
						'company_name' => $this->input->post('company_name'),
						'agent_tax_id' => $this->input->post('tax_id'),
						'commission_rate' => $this->input->post('commission_rate'),
						'picture' => $picture,
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
						'address' => $this->input->post('address'),
						'zipcode' => $this->input->post('zipcode'),
						'territory' => !empty($this->input->post('territory')) ? 'all' : '',
						'created_on' => date('Y-m-d H:i:s'),
					);

					if ($is_new) {
						$insert_id = $this->common_model->insert_tbl_data('user', $user_data);
						$this->session->set_flashdata('success_message', 'Agent Added Successfully! ');
						$subject = "Registered";
						$body = "<!DOCTYPE html>
						<html><body>
						<p>Dear " . $user_data['username'] . " " . $user_data['last_name'] . ",</p>


					<p>Thank you for joining our proficient team of care agents at Meddistant Inc. Please activate and consent to agent agreement attached, by clicking on Meddistant link below. Your login password is:" . $random_number . "</p>


					<p>You are advised to immediately change password after login for security and privacy purposes and to never share customer health information except with other than doctors and hospitals concerned.</p>

						<p><a href=" . base_url() . "admin/login" . ">Meddistant</a></p>

						<p>Soon after full registration, you will start receiving quote requests to administer and follow
		up with customers. Your information is at agent sales profile in dashboard. If you have any
		questions, feel free to contact us at any time</p>

						<p> Truly yours,</p><br>
						<p> Meddistant Care Team</p><br>
						<p> USA & Canada +1888 9699959</p>
						<p>  Worldwide +1312 8899105</p>
						<p>  Turkey +90 (541)9473789</p>
						<p> Or email us at care@meddistant.com</p>

					";
						$body .= "<br/>
						</body></html>";
						if (!empty($this->input->post('company_name'))) {
							$name = $this->input->post('company_name');
						} else {
							$name = $user_data['username'] . " " . $user_data['last_name'];
						}

						$data['name'] = $name;
						$data['commission_rate'] = $this->input->post('commission_rate');

						$this->load->library('dompdf_gen');

						$html = $this->load->view('admin/agent/manage_agent_pdf', $data, TRUE);
						$pdfname = date('Ymdhis') . "manage_agent.pdf";
						$this->dompdf->load_html($html);
						$this->dompdf->render();
						$output = $this->dompdf->output();
						file_put_contents('assets/manage_agent/' . $pdfname . '', $output);

						$attach = 'assets/manage_agent/' . $pdfname;

						$this->common_model->mail_mail_agent($user_data['email'], $subject, $body, "joez@meddistant.com", $attach);

						@unlink($_FILES[$file_element_name]);
						redirect('admin/agent/');
					} else {

						$this->common_model->update_tbl_data('user', $user_data, array('user_id' => $edit_id));
						$this->session->set_flashdata('success_message', 'Updated Successfully! ');
						redirect('admin/agent/');
					}
				}
			} 
		}
		

		$data['getCountry'] = $this->common_model->getCountry('agent');
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/agent/manage_agent', $data);
		$this->load->view('admin/common/footer');


	}

	public function quote_list()
	{
		$data['quote_data'] = $this->db->query("SELECT tbl_quote_request.*, tbl_user.user_type FROM tbl_quote_request left outer join tbl_user on tbl_user.user_id = tbl_quote_request.added_by  WHERE (added_by = '$this->user_id' OR assigned_agent = '$this->user_id') AND (tbl_quote_request.status IS NULL) ORDER BY created_on DESC")->result_array();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/agent/quote_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function booked_sales()
	{

		$getRecord = $this->db->select('tbl_checkout.*,
				tbl_quote_sent.message as msg,
				tbl_treatment.treatment_name as procedure_treatment,
				tbl_quote_request.request_no,
				tbl_quote_request.first_name,
				tbl_quote_request.last_name,
				tbl_quote_request.email,
				tbl_quote_request.phone_no,
				tbl_quote_request.country,
				tbl_quote_request.city,
				tbl_quote_sent.service_name,
				tbl_quote_sent.type,
				tbl_quote_sent.facilitation_fees,
				tbl_user.commission_rate
				');

		$getRecord = $this->db->from('tbl_checkout');
		$getRecord = $this->db->join('tbl_quote_sent', 'tbl_quote_sent.quote_sent_id = tbl_checkout.id_quote_sent');
		$getRecord = $this->db->join('tbl_quote_request', 'tbl_quote_request.id = tbl_quote_sent.quote_request_id');
		$getRecord = $this->db->join('tbl_treatment', 'tbl_treatment.id = tbl_quote_request.procedure_treatment');

		$getRecord = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_quote_request.assigned_agent');

		if ($this->session->userdata('user_type') == 'agent') {
			$getRecord = $this->db->where('tbl_quote_request.assigned_agent', $this->user_id);
		} else {

			if (!empty($this->input->get('user_id'))) {
				$getRecord = $this->db->where('tbl_quote_request.assigned_agent', $this->input->get('user_id'));
			}

			if (!empty($this->input->get('agent_email'))) {
				$getRecord = $this->db->like('tbl_user.email', $this->input->get('agent_email'));
			}

			if (!empty($this->input->get('name'))) {
				$getRecord = $this->db->like('tbl_user.username', $this->input->get('name'));
			}

			// if (!empty($this->input->get('assigned_agent'))) {
			// 	$getRecord = $this->db->where('tbl_quote_request.assigned_agent', $this->input->get('assigned_agent'));
			// }

		}

		if (!empty($this->input->get('start_date'))) {
			$getRecord = $this->db->where('DATE_FORMAT(tbl_checkout.payment_date,"%Y-%m-%d") >=', $this->input->get('start_date'));
		}
		if (!empty($this->input->get('end_date'))) {
			$getRecord = $this->db->where('DATE_FORMAT(tbl_checkout.payment_date,"%Y-%m-%d") <=', $this->input->get('end_date'));
		}

		// if (!empty($this->input->get('email'))) {
		// 	$getRecord = $this->db->like('tbl_quote_request.email', $this->input->get('email'));
		// }
		// if (!empty($this->input->get('name'))) {
		// 	$getRecord = $this->db->like('tbl_quote_request.first_name', $this->input->get('name'));
		// }

		$getRecord = $this->db->get()->result_array();

		$data['quote_data'] = $getRecord;

		$getCommision = $this->db->where('user_id', $this->user_id);
		$getCommision = $this->db->get('tbl_user')->row();

		if (!empty($this->input->get('user_id'))) {
			$getAgentName = $this->db->where('user_id', $this->input->get('user_id'));
			$getAgentName = $this->db->get('tbl_user')->row();
			$data['getAgentName'] = $getAgentName;
		}

		$data['getCommision'] = $getCommision;

		$getAgent = $this->db->select('tbl_user.*');
		$getAgent = $this->db->from('tbl_user');
		$getAgent = $this->db->where('tbl_user.user_type', 'agent');
		$getAgent = $this->db->get()->result();
		$data['getAgent'] = $getAgent;

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/agent/booked_sales_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function quotes_received()
	{

		$quotes_received = $this->db->select('*,tbl_quote_sent.message as msg,tbl_treatment.treatment_name as procedure_treatment');
		$quotes_received = $this->db->from('tbl_quote_sent');
		$quotes_received = $this->db->join('tbl_quote_request', 'tbl_quote_request.id = tbl_quote_sent.quote_request_id');
		$quotes_received = $this->db->join('tbl_treatment', 'tbl_treatment.id = tbl_quote_request.procedure_treatment');
		$quotes_received = $this->db->where('tbl_quote_request.assigned_agent', $this->user_id);
		$quotes_received = $this->db->get()->result_array();
		$data['quote_data'] = $quotes_received;

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/agent/quote_received_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function sales_leads()
	{
		$data['quote_data'] = $this->db->query("SELECT tbl_quote_request.*, tbl_user.user_type FROM tbl_quote_request left outer join tbl_user on tbl_user.user_id = tbl_quote_request.added_by  WHERE assigned_agent = '$this->user_id' AND (tbl_quote_request.status IS NULL)  GROUP BY tbl_quote_request.email ORDER BY created_on DESC")->result_array();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/agent/sales_leads_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function company_ref()
	{
		$getRecord = $this->db->select('tbl_user.*,tbl_company_type.company_type');
		$getRecord = $this->db->from('tbl_user');
		$getRecord = $this->db->join('tbl_company_type', 'tbl_company_type.id = tbl_user.company_type_id', 'left');
		$getRecord = $this->db->where('tbl_user.agent_id', $this->session->userdata('user_id'));
		$getRecord = $this->db->where('tbl_user.user_type', 'employer');
		$getRecord = $this->db->get()->result_array();
		$data['getRecord'] = $getRecord;

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/agent/company_ref_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function GeneralAgentAssign()
	{
		$country_name = $this->input->post('country_name');
		$state_name = $this->input->post('state_name');
		$territory = $this->input->post('territory');

		if (strtoupper($territory) != 'ALL') {
			if (strtoupper($country_name) == 'USA') {
				$check_user = $this->db->where('country', $country_name);
				$check_user = $this->db->where('state', $state_name);
				$check_user = $this->db->where('territory', $territory);
				$check_user = $this->db->get('tbl_user')->num_rows();
				if (!empty($check_user)) {
					$json['success'] = false;
				} else {
					$json['success'] = true;
				}
			} else {
				$check_user = $this->db->where('country', $country_name);
				$check_user = $this->db->where('territory', $territory);
				$check_user = $this->db->get('tbl_user')->num_rows();
				if (!empty($check_user)) {
					$json['success'] = false;
				} else {
					$json['success'] = true;
				}
			}
		} else {
			$json['success'] = true;
		}
		echo json_encode($json);
	}

	public function getStateAgent()
	{
		$country_id = $this->input->post('country_id');

		$getState = $this->db->where('country_id', $country_id);
		$getState = $this->db->get('tbl_state')->result();

		$html = '';
		if (!empty($getState)) {
			$html .= '<select class="form-control statename" name="state">';
			foreach ($getState as $value) {

				$html .= '<option value="' . $value->state_name . '">' . $value->state_name . '</option>';
			}
			$html .= '</select>';
		} else {
			$html .= '<input type="text" class="form-control statename" value="" name="state" placeholder="State">';
		}

		$json['success'] = $html;
		echo json_encode($json);
	}

	public function getState()
	{
		$country_id = $this->input->post('country_id');
		$state_name = $this->input->post('state_name');

		$getState = $this->db->where('country_id', $country_id);
		$getState = $this->db->get('tbl_state')->result();

		$html = '';
		if (!empty($getState)) {
			$html .= '<select class="form-control" name="state">';
			foreach ($getState as $value) {
				$selected = '';
				if ($state_name == $value->state_name) {
					$selected = 'selected';
				}
				$html .= '<option ' . $selected . ' value="' . $value->state_name . '">' . $value->state_name . '</option>';
			}
			$html .= '</select>';
		} else {
			$html .= '<input type="text" class="form-control" value="' . $state_name . '" name="state" placeholder="State">';
		}

		$json['success'] = $html;
		echo json_encode($json);
	}




	public function manage_quote()
	{
       
		// $request_no = 1000101;
		// $get_record = $this->db->get('tbl_quote_request')->result();
		// foreach ($get_record as $value) {
		// 	$get_record = $this->db->where('id', $value->id);
		// 	$get_record = $this->db->set('request_no', $request_no);
		// 	$get_record = $this->db->update('tbl_quote_request');

		// 	$request_no = $request_no + 1;
		// }
			// echo '<pre>';
			// print_r($this->input->post());
			// echo '</pre>';
			// exit; 
		if ($this->uri->segment(4) == 'del') {
			/*$this->common_model->dlt_tbl_data('quote_request', array('id' => $this->uri->segment(5)));*/
			$this->db->query("UPDATE tbl_quote_request set status=1 where id=" . $this->uri->segment(5));
			$this->session->set_flashdata('success_message', 'Quote Deleted Successfully! ');
			redirect('admin/agent/quote_list');
		}

		$data['getFileType'] = $this->common_model->getFileType();
		$data['getDestinationHospital'] = $this->common_model->getDestinationHospital();
		
		$is_new  = $this->input->post('add');
		$is_edit = $this->input->post('edit');
		$edit_id = $this->input->post('edit_id');

		if (isset($is_new) or isset($is_edit)) {
			
            
			$destination_start_date = null;
			$destination_end_date   = null;
			
			if (!empty($this->input->post('destination_hospital_id'))) {
				$getSingleHospital 		= $this->common_model->getSingleHospital($this->input->post('destination_hospital_id'));
				$destination_start_date = $getSingleHospital->start_date;
				$destination_end_date   = $getSingleHospital->end_date;
				$country   				= $getSingleHospital->country;
			} else {
				$country = !empty($this->input->post('desired_country')) ? $this->input->post('desired_country') : '';
			}


			if (!empty($this->input->post('patient_no'))) {
				$patient_no = $this->input->post('patient_no');
			} else {
				$patient_no = $this->common_model->getPatientNoQuote();
			}


			$get_max_id = $this->db->query("SELECT max(id)as max_id FROM `tbl_quote_request`")->row_array();

			if (empty($this->input->post('request_no'))) {
				$get_record = $this->db->order_by('request_no', 'desc');
				$get_record = $this->db->limit('1');
				$get_record = $this->db->get('tbl_quote_request')->row();

				if (!empty($get_record)) {
					$request_no = $get_record->request_no + 1;
				} else {
					$request_no = '1000101';
				}
			} else {
				$request_no = $this->input->post('request_no');
			}

			if ($this->session->userdata('user_type') === 'customer') {
				$email = $this->input->post('email');
			} else {
				$email = $this->input->post('quote_email');
			}

			$get_employee_Type = $this->db->select('tbl_company_type.company_code');
			$get_employee_Type = $this->db->from('tbl_referrals');
			$get_employee_Type = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_referrals.user_id');
			$get_employee_Type = $this->db->join('tbl_company_type', 'tbl_company_type.id = tbl_user.company_type_id');
			$get_employee_Type = $this->db->where('tbl_referrals.ref_email', $email);
			$get_employee_Type = $this->db->get()->row();
			$company_type = !empty($get_employee_Type->company_code) ? $get_employee_Type->company_code : 'DS';

			// if (!empty($_FILES['quote_image']['name'])) {
			// 	$file_element_name = 'quote_image';
			// 	$config['upload_path'] = './upload_dir/quote_image/';
			// 	$config['allowed_types'] = 'jpg|png|PNG|JPG|JPEG|jpeg|pdf|PDF|docx|doc';
			// 	$config['max_size'] = 20000000000;
			// 	$config['file_name'] = time();
			// 	$this->load->library('upload', $config);
			// 	if (!$this->upload->do_upload($file_element_name)) {
			// 		$error = array('error' => $this->upload->display_errors());
			// 		$this->session->set_flashdata('error_message', $error['error']);
			// 	} else {
			// 		$data = array('upload_data' => $this->upload->data());
			// 	}

			// 	$orig_name = (@$data['upload_data']['orig_name']) ? @$data['upload_data']['orig_name'] : '';

			// 	$client_name = (@$data['upload_data']['client_name']) ? @$data['upload_data']['client_name'] : '';
			// } else {
			// 	$orig_name = $this->input->post('old_quote_image');
			// 	$client_name = $this->input->post('old_orignal_quote_image');
			// }

			$is_file = !empty($this->input->post('is_file')) ? 1 : 0;

			$folder = "upload_dir/quote_image/";
			if (!empty($_FILES['quote_image']['name'])) {
				$orig_name = date('YmdHisH') . $_FILES["quote_image"]["name"];
				$path = $folder . $orig_name;
				move_uploaded_file($_FILES["quote_image"]["tmp_name"], $path);
				$client_name = '';
				$is_file = 1;
			} else {
				$orig_name = $this->input->post('old_quote_image');
				$client_name = $this->input->post('old_orignal_quote_image');
			}

			$folder = "upload_dir/quote_image/";
			if (!empty($_FILES['quote_image_two']['name'])) {
				$orig_name_two = date('YmdHisis') . $_FILES["quote_image_two"]["name"];
				$path = $folder . $orig_name_two;
				move_uploaded_file($_FILES["quote_image_two"]["tmp_name"], $path);
				$client_name_two = '';
				$is_file = 1;
			} else {
				$orig_name_two = $this->input->post('old_quote_image_two');
				$client_name_two = $this->input->post('old_orignal_quote_image_two');
			}

			if (!empty($_FILES['quote_image_three']['name'])) {
				$orig_name_three = date('YmdHisHi') . $_FILES["quote_image_three"]["name"];
				$path_three = $folder . $orig_name_three;
				move_uploaded_file($_FILES["quote_image_three"]["tmp_name"], $path_three);
				$client_name_three = '';
				$is_file = 1;
			} else {
				$orig_name_three = $this->input->post('old_quote_image_three');
				$client_name_three = $this->input->post('old_orignal_quote_image_three');
			}

			if (!empty($_FILES['quote_image_four']['name'])) {
				$orig_name_four = date('YmdHisisH') . $_FILES["quote_image_four"]["name"];
				$path_four = $folder . $orig_name_four;
				move_uploaded_file($_FILES["quote_image_four"]["tmp_name"], $path_four);
				$client_name_four = '';
				$is_file = 1;
			} else {
				$orig_name_four = $this->input->post('old_quote_image_four');
				$client_name_four = $this->input->post('old_orignal_quote_image_four');
			}

			if (!empty($_FILES['quote_image_five']['name'])) {
				$orig_name_five = date('YmdHis') . 'five' . $_FILES["quote_image_five"]["name"];
				$path_five = $folder . $orig_name_five;
				move_uploaded_file($_FILES["quote_image_five"]["tmp_name"], $path_five);
				$client_name_five = '';
				$is_file = 1;
			} else {
				$orig_name_five = $this->input->post('old_quote_image_five');
				$client_name_five = $this->input->post('old_orignal_quote_image_five');
			}

			if($this->input->post('gender') == 'Male')
			{
				$gender = 'm';
			}	
			else
			{
				$gender = 'f';
			}

			

			if ($this->session->userdata('user_type') == 'customer') {

				$update_user = array(
					'gender' => $gender,
					'address' => $this->input->post('street'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'zipcode' => $this->input->post('zipcode'),
				);
				$updateU = $this->db->where('user_id', $this->user_id);
				$updateU = $this->db->update('tbl_user', $update_user);
				
			}




			$quote_data = array(
				'request_no' 	=> $request_no,
				'patient_no' 	=> $patient_no,
				'first_name' 	=> $this->input->post('first_name'),
				'last_name' 	=> $this->input->post('last_name'),
				'full_name' 	=> !empty($this->input->post('full_name')) ? $this->input->post('full_name') : '',
				'email'			=> $email,
				'phone_no' 		=> $this->input->post('phone_no'),
				'age' 			=> $this->input->post('age'),
				'gender' 		=> $this->input->post('gender'),
				'country' 		=> $this->input->post('country'),
				'street' 		=> $this->input->post('street'),
				'city' 			=> $this->input->post('city'),
				'state' 		=> $this->input->post('state'),
				'zipcode' 		=> $this->input->post('zipcode'),
				'desired_country'  => !empty($country) ? $country : '',
				'desired_country2' => !empty($this->input->post('desired_country2')) ? $this->input->post('desired_country2') : '',

				'desired_state'  => !empty($this->input->post('desired_state')) ? $this->input->post('desired_state') : '',
				'desired_state2' => !empty($this->input->post('desired_state2')) ? $this->input->post('desired_state2') : '',

				'high_cholesterol'    => $this->input->post('high_cholesterol'),
				'anemic'              => $this->input->post('anemic'),
				'diabetic'            => $this->input->post('diabetic'),
				'heart_issues'        => $this->input->post('heart_issues'),
				'allergic'            => $this->input->post('allergic'),
				'allergic_desc'       => !empty($this->input->post('allergic_desc')) ? $this->input->post('allergic_desc') : '',
				'pregnant'            => $this->input->post('pregnant'),
				'procedure_treatment' => $this->input->post('procedure_treatment'),
				'terms'               => $this->input->post('terms'),
				'added_by'            => $this->user_id,
				'treatment_detail'    => $this->input->post('treatment_detail'),

				'insurance_information' => !empty($this->input->post('is_insurance')) ? $this->input->post('insurance_information') : '',
				'is_insurance' 	=> !empty($this->input->post('is_insurance')) ? $this->input->post('is_insurance') : '',

				'quote_image' 	=> $orig_name,
				'orignal_quote_image' => $client_name,

				'quote_image_two' => $orig_name_two,
				'orignal_quote_image_two' => $client_name_two,

				'quote_image_three' => $orig_name_three,
				'orignal_quote_image_three' => $client_name_three,

				'quote_image_four' => $orig_name_four,
				'orignal_quote_image_four' => $client_name_four,

				'quote_image_five' => $orig_name_five,
				'orignal_quote_image_five' => $client_name_five,

				'is_file' 		  => $is_file,

				'destination_hospital_id' 	=> !empty($this->input->post('destination_hospital_id')) ? $this->input->post('destination_hospital_id') : null,


				'destination_start_date' => $destination_start_date,
				'destination_end_date' 	 => $destination_end_date,


				'file_type_one'   => !empty($this->input->post('file_type_one')) ? $this->input->post('file_type_one') : '',
				'file_type_two'   => !empty($this->input->post('file_type_two')) ? $this->input->post('file_type_two') : '',
				'file_type_three' => !empty($this->input->post('file_type_three')) ? $this->input->post('file_type_three') : '',
				'file_type_four'  => !empty($this->input->post('file_type_four')) ? $this->input->post('file_type_four') : '',
				'file_type_five'  => !empty($this->input->post('file_type_five')) ? $this->input->post('file_type_five') : '',


				'created_on' => date('Y-m-d H:i:s'),
			);
			
			
			$quote_data2 = array(
				'high_cholesterol'    => $this->input->post('high_cholesterol'),
				'anemic'              => $this->input->post('anemic'),
				'diabetic'            => $this->input->post('diabetic'),
				'heart_issues'        => $this->input->post('heart_issues'),
				'allergic'            => $this->input->post('allergic'),
				'allergic_desc'       => !empty($this->input->post('allergic_desc')) ? $this->input->post('allergic_desc') : '',
				'pregnant'            => $this->input->post('pregnant'),
				'procedure_treatment' => $this->input->post('procedure_treatment'),
				'terms'               => $this->input->post('terms'),
				'added_by'            => $this->user_id,
				'treatment_detail'    => $this->input->post('treatment_detail'),

				'insurance_information' => !empty($this->input->post('is_insurance')) ? $this->input->post('insurance_information') : '',
				'is_insurance' 	=> !empty($this->input->post('is_insurance')) ? $this->input->post('is_insurance') : '',

				'quote_image' 	=> $orig_name,
				'orignal_quote_image' => $client_name,

				'quote_image_two' => $orig_name_two,
				'orignal_quote_image_two' => $client_name_two,

				'quote_image_three' => $orig_name_three,
				'orignal_quote_image_three' => $client_name_three,

				'quote_image_four' => $orig_name_four,
				'orignal_quote_image_four' => $client_name_four,

				'quote_image_five' => $orig_name_five,
				'orignal_quote_image_five' => $client_name_five,

				'is_file' 		  => $is_file,

				'destination_hospital_id' 	=> !empty($this->input->post('destination_hospital_id')) ? $this->input->post('destination_hospital_id') : null,


				'destination_start_date' => $destination_start_date,
				'destination_end_date' 	 => $destination_end_date,


				'file_type_one'   => !empty($this->input->post('file_type_one')) ? $this->input->post('file_type_one') : '',
				'file_type_two'   => !empty($this->input->post('file_type_two')) ? $this->input->post('file_type_two') : '',
				'file_type_three' => !empty($this->input->post('file_type_three')) ? $this->input->post('file_type_three') : '',
				'file_type_four'  => !empty($this->input->post('file_type_four')) ? $this->input->post('file_type_four') : '',
				'file_type_five'  => !empty($this->input->post('file_type_five')) ? $this->input->post('file_type_five') : '',


				'created_on' => date('Y-m-d H:i:s'),
			);
			
			
			
			
			//	print_r($quote_data);die;

			$password_txt = mt_rand(100000, 999999);
			$password = md5($password_txt);

			$fname = $this->input->post('first_name');
			if (empty($fname)) {
				$username = $this->input->post('first_name');
			} else {
				$username = $this->input->post('first_name');
			}
			$user_data = array(
				'username' => $username,
				'email' => $email,
				'phone_no' => $this->input->post('phone_no'),
				'password' => $password,
				'country' => $this->input->post('country'),
				'user_type' => 'customer',
				'Active' => '1',
				'created_on' => date('Y-m-d H:i:s'),
			);

			if ($this->session->userdata('user_type') == 'agent') {
				$quote_data['assigned_agent'] = $this->user_id;
			}
			
			if ($is_new) {
               
				if ($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'customer') {
					 
					if (!empty($email)) {
						$getReferral = $this->db->select('tbl_referrals.*,tbl_user.agent_id');
						$getReferral = $this->db->from('tbl_referrals');
						$getReferral = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_referrals.user_id');
						$getReferral = $this->db->where('tbl_referrals.ref_email', $email);
						$getReferral = $this->db->get()->row();
						
						if (!empty($getReferral->agent_id)) {
							$quote_data['assigned_agent'] = $getReferral->agent_id;
						} else {
							$agent_id_auto = $this->common_model->getAutoAssignAgent($email);
							if (!empty($agent_id_auto)) {
								$quote_data['assigned_agent'] = $agent_id_auto;
							}
						}						
					}


					if(empty($quote_data['assigned_agent']))
					{
						$agent_id_auto = $this->common_model->getAutoAssignAgentCountry($this->input->post('country'));
						if (!empty($agent_id_auto)) {
							$quote_data['assigned_agent'] = $agent_id_auto;
						}
						else
						{				
							$agent_id_auto = $this->common_model->getAutoAssignAgentState($this->input->post('state'));
							if (!empty($agent_id_auto)) {
								$quote_data['assigned_agent'] = $agent_id_auto;
							}						
						}
					}

				}
                   
				if ($this->session->userdata('user_type') == 'admin') {					
					$quote_data['request_by'] = 'Admin';
				} else if ($this->session->userdata('user_type') == 'agent') {					
					$quote_data['request_by'] = 'Agent';
				} else {					
					$quote_data['request_by'] = 'Self';
				}

				$quote_data['company_type'] = $company_type;
				$quote_data['quote_status'] = PLEASEQUOTE;
				$quote_data['awaiting_quotes_date'] = date('Y-m-d H:i:s');
				// echo '<pre>';
				// print_r($quote_data);
				// echo '</pre>';
				// exit;
				$insert_id = $this->common_model->insert_tbl_data('quote_request', $quote_data);

				if(!empty($this->input->post('destination_hospital_id'))) {
					// echo 'single hospital';
					$this->common_model->send_destination_hospital_mail($insert_id, $this->input->post('destination_hospital_id'), false);
				} else if(!empty($this->input->post('desired_country'))) {
					// echo 'multiple hospital';
					// $this->common_model->send_hostpital_mail($insert_id);
					$this->common_model->send_destination_hospital_mail($insert_id, '', true);

				}
				// exit;
				$this->session->set_flashdata('success_message', 'Quote Request Added Successfully!');

				$post_email = $email;
				$where = "email='$post_email'";
				$result = $this->common_model->get_tbl_data('user', '*', $where);
				if (count($result) < 1) {
					// $this->common_model->insert_tbl_data('user', $user_data);
					// $this->session->set_flashdata('success_message', 'Account is also created successfully, here is a password to login with the email: ' . $password_txt);
					if ($this->session->userdata('user_type') != 'customer') {
						$this->session->set_flashdata('success_message', 'Thank you an email has been sent to customer to encourage signup');
					}
				}

				// if ($this->session->userdata('user_type') != 'customer') {

				// 	$subject = 'Meddistant "Your Request Recieved"';
				// 	$body = "<!DOCTYPE html>
				// 	<html><body>
				// 	<p>Hello " . $this->input->post('first_name') . ",</p>
				// 	<p>Thank you for showing interest in our services from Meddistant. We are working on getting you competing treatment quotes from top quality hospitals and clinics.
				// 	For privacy reasons and to follow the status of your quote request, please login or signup at <a href='https://meddistant.com/signup'>https://meddistant.com/signup.</a></p>
				// 	<p>One of our team memebrs will contact you soon.</p>
				// 	<br />

				// 	<p>Truly,</p>
				// 	<br>
				// 	<p> Meddistant Care Team</p>
				// 	<p>	USA & Canada +1888 9699959</p>
				// 	<p> Worldwide  +1312 8899105 </p>
				// 	<p> Turkey +90 (541)9473789 </p>
				// 	<p> Or email us at care@meddistant.com</p></body></html>";

				// 	$subject = 'Meddistant "Your Request Recieved"';
				// 	$this->common_model->mail_mail($email, $subject, $body, "joez@meddistant.com");
				// }

				if ($this->session->userdata('user_type') === 'customer') {
					redirect('customer_quotes');
				} else if ($this->session->userdata('user_type') === 'agent') {
					redirect('admin/agent/quote_list');
				} else {
					redirect('admin/manage_quotes');
				}
			} else {

               
				unset($quote_data['added_by'], $quote_data['request_no'], $quote_data['created_on']);
				if ($quote_data['first_name'] != "" || $quote_data['last_name'] != "" || $quote_data['gender'] != "" || $quote_data['country'] != "" || $quote_data['city'] != "") {
					$quote_data['quote_status'] = PLEASEQUOTE;

					$check_data = $this->db->where('id', $edit_id);
					$check_data = $this->db->where('quote_status', 'incomplete');
					$check_data = $this->db->get('quote_request')->num_rows();
					if (!empty($check_data)) {
						$quote_data['awaiting_quotes_date'] = date('Y-m-d H:i:s');
					}
				}

				$this->common_model->update_tbl_data_quote('quote_request', $quote_data, $quote_data2, array('id' => $edit_id));

				$this->session->set_flashdata('success_message', 'Quote Request Added Successfully!');

				$post_email = $email;
				$where = "email='$post_email'";
				$result = $this->common_model->get_tbl_data('user', '*', $where);
				if (count($result) < 1) {
					// $this->common_model->insert_tbl_data('user', $user_data);
					if ($this->session->userdata('user_type') != 'customer') {
						$this->session->set_flashdata('success_message', 'Thank you an email has been sent to customer to encourage signup');
					}
				}

				if ($this->session->userdata('user_type') === 'customer') {
					redirect('customer_quotes');
				} else if ($this->session->userdata('user_type') === 'agent') {
					redirect('admin/agent/quote_list');
				} else {
					redirect('admin/manage_quotes');
				}
			}
		} else {
              
			$data['readonly'] = '';
			$data['required'] = '';
			$data['customer_data'] = array();
			$data['getCountry'] = $this->db->get('tbl_country')->result();

			$data['getCountryQuate'] = $this->common_model->getCountry('quate');

			$getTreatment = $this->db->order_by('order_by_data', 'asc');
			$getTreatment = $this->db->get('tbl_treatment')->result();
			$data['getTreatment'] = $getTreatment;

			if ($this->session->userdata('user_type') === 'customer') {
				$customer_data = $this->db->query("SELECT * FROM tbl_user WHERE user_id = '" . $this->session->userdata('user_id') . "' ORDER BY created_on DESC")->result();
				$data['customer_data'] = $customer_data;
				$data['readonly'] = 'readonly';
				$data['required'] = 'required';
				$this->load->view('common/user_backend_header');
				$this->load->view('common/user_backend_menubar');
			} else {
				$this->load->view('admin/common/header');
				$this->load->view('admin/common/menubar');
			}
			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
			// exit;
			$this->load->view('admin/agent/manage_quote', $data);
			$this->load->view('admin/common/footer');
		}
	}

	public function edit_quote($id)
	{
		$data['getFileType'] = $this->common_model->getFileType();
		$data['getDestinationHospital'] = $this->common_model->getDestinationHospital();

		$getTreatment = $this->db->order_by('order_by_data', 'asc');
		$getTreatment = $this->db->get('tbl_treatment')->result();
		$data['getTreatment'] = $getTreatment;
		// echo '<pre>';
		// print_r($this->input->post());
		// echo '</pre>';
		
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// exit;
		$data['customer_data'] = array();
		$data['readonly'] = '';
		$data['required'] = '';
		$data['getCountry'] = $this->db->get('tbl_country')->result();
		$data['getCountryQuate'] = $this->common_model->getCountry('quate');
		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
		} else {
			$customer_data = $this->db->query("SELECT * FROM tbl_user WHERE user_id = '" . $this->session->userdata('user_id') . "' ORDER BY created_on DESC")->result();
			$data['customer_data'] = $customer_data;
			$data['readonly'] = 'readonly';
			$data['required'] = 'required';
			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
		}

		$data['quote_data'] = $this->db->query("SELECT tbl_quote_request.*, tbl_user.user_type FROM tbl_quote_request left outer join tbl_user on tbl_user.user_id = tbl_quote_request.added_by where tbl_quote_request.id = " . $id . " ORDER BY created_on DESC")->result();
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// exit;
		$data['edit_page'] = "edit_page";
		
		$this->load->view('admin/agent/manage_quote', $data);
		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/footer');
		} else {
			$this->load->view('common/user_backend_footer');
		}
	}

	public function quote_detail($id)
	{
		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
		} else {
			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
		}

		$data['quote_data'] = $this->db->query("SELECT tbl_quote_request.*, tbl_treatment.treatment_name as procedure_treatment,tbl_user.user_type FROM tbl_quote_request left outer join tbl_user on tbl_user.user_id = tbl_quote_request.added_by  INNER JOIN tbl_treatment ON tbl_treatment.id = tbl_quote_request.procedure_treatment where tbl_quote_request.id = " . $id . " ORDER BY created_on DESC")->result();
		
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// echo '<pre>';
		// print_r($this->session->userdata());
		// echo '</pre>';
		// echo '<pre>';
		// print_r($this->db->last_query());
		// echo '</pre>';
		// exit;
		$data['quote_sent_data'] = $this->db->query("SELECT * FROM tbl_quote_sent WHERE quote_request_id = " . $id . " ORDER BY created_on DESC")->result_array();
		// exit;
		$this->load->view('admin/agent/quote_detail', $data);
		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/footer');
		} else {
			$this->load->view('common/user_backend_footer');
		}
	}

	public function quote_detail_sent($id)
	{
		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
		} else {
			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
		}

		$quote_sent_data = $this->db->select('tbl_quote_sent.*,tbl_user.email,tbl_user.user_type,tbl_user.phone_no,tbl_doctors.name,tbl_treatment.treatment_name,tbl_quote_request.first_name,tbl_quote_request.last_name,tbl_quote_request.request_no,tbl_quote_request.patient_no');
		$quote_sent_data = $this->db->from('tbl_quote_sent');
		$quote_sent_data = $this->db->join('tbl_user', 'tbl_user.user_id  = tbl_quote_sent.id_user');
		$quote_sent_data = $this->db->join('tbl_doctors', 'tbl_doctors.doctor_id  = tbl_quote_sent.doctor_id', 'left');
		$quote_sent_data = $this->db->join('tbl_quote_request', 'tbl_quote_request.id  = tbl_quote_sent.quote_request_id');
		$quote_sent_data = $this->db->join('tbl_treatment', 'tbl_treatment.id  = tbl_quote_request.procedure_treatment');
		$quote_sent_data = $this->db->where('tbl_quote_sent.quote_sent_id', $id);
		$quote_sent_data = $this->db->get()->row();



		$getHospital = $this->db->select('tbl_hospital.*,tbl_user.country,tbl_user.state');
		$getHospital = $this->db->from('tbl_hospital');
		$getHospital = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_hospital.user_id');
		$getHospital = $this->db->where('tbl_hospital.id', $quote_sent_data->hospital_table_id);
		$getHospital = $this->db->get()->row();
		$data['getHospital'] = $getHospital;


		$prepayment_hospital = 0;

		if (trim($quote_sent_data->user_type) == 'agent') {
			$prepayment_hospital = $quote_sent_data->agent_prepay;
		} else {
			if (!empty($quote_sent_data->hospital_id)) {
				$getHospital = $this->db->where('user_id', $quote_sent_data->hospital_id);
				$getHospital = $this->db->get('tbl_user')->row();
				$prepayment_hospital = $getHospital->hospital_prepay;
			}
		}

		$data['prepayment_hospital'] = $prepayment_hospital;

		$data['quote_sent_data'] = $quote_sent_data;

		$this->load->view('admin/agent/quote_detail_sent', $data);
		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/footer');
		} else {
			$this->load->view('common/user_backend_footer');
		}
	}

	public function quote_details($id)
	{
		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
		} else {
			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
		}
		$data['quote_data'] = $this->db->query("SELECT tbl_quote_request.*, tbl_user.user_type FROM tbl_quote_request left outer join tbl_user on tbl_user.user_id = tbl_quote_request.added_by where tbl_quote_request.id = " . $id . " ORDER BY created_on DESC")->result();
		$data['quote_sent_data'] = $this->db->query("SELECT * FROM tbl_quote_sent WHERE quote_request_id = " . $id . " ORDER BY created_on DESC")->result_array();

		$this->load->view('admin/agent/quote_details', $data);
		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/footer');
		} else {
			$this->load->view('common/user_backend_footer');
		}
	}

	function generateRandomString($alpha = TRUE, $nums = TRUE, $usetime = FALSE, $string = '', $length = 120)
	{

		$alpha = ($alpha == TRUE) ? 'abcdefghijklmnopqrstuvwxyz' : '';
		$nums = ($nums == TRUE) ? '1234567890' : '';
		if ($alpha == TRUE || $nums == TRUE || !empty($string)) {
			if ($alpha == TRUE) {
				$alpha = $alpha;
				$alpha .= strtoupper($alpha);
			}
		}
		$randomstring = '';
		$totallength = $length;
		for ($na = 0; $na < $totallength; $na++) {
			$var = (bool) rand(0, 1);
			if ($var == 1 && $alpha == TRUE) {
				$randomstring .= $alpha[(rand() % mb_strlen($alpha))];
			} else {
				$randomstring .= $nums[(rand() % mb_strlen($nums))];
			}
		}
		if ($usetime == TRUE) {
			$randomstring = $randomstring . time();
		}

		return ($randomstring);
	}

	public function company()
	{

		is_admin_in();
		if ($this->uri->segment(4) == 'del') {
			$this->common_model->dlt_tbl_data('manager_property', array(
				'id_user' => $this->uri->segment(5),
				'id_company' => $this->uri->segment(6),
			));
			$this->common_model->dlt_tbl_data('manager_zipcode', array(
				'id_user_tbl' => $this->uri->segment(5),
				'id_company_tbl' => $this->uri->segment(6),
			));
			$this->common_model->del_record('company', 'company_id', $this->uri->segment(6), 'admin/property_manager/', 'Property Manager Deleted Successfully');
		}
		$is_new = $this->input->post('add');
		$is_edit = $this->input->post('edit');
		$edit_id = $this->input->post('edit_id');
		$company_manager = $this->input->post('company_manager');
		if (isset($is_new) or isset($is_edit)) {

			$config = array(
				'upload_path' => FCPATH . 'upload_dir/company_logo/',
				'allowed_types' => 'jpg|png|PNG|JPG|JPEG|jpeg|gif',
				'max_size' => 0,
				'max_width' => 0,
				'max_height' => 0,
				'file_name' => $this->currTime,
			);
			$this->load->library('upload', $config);
			if (!empty($_FILES['company_logo']['name']) && !$this->upload->do_upload('company_logo')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error_message', $error['error']);
				redirect('admin/property_manager/manage_property_manager/');
			}
			$data = array('upload_data' => $this->upload->data());
			if ($is_new) {
                
				$company_data = array(
					'id_manager' => $company_manager,
					'company_name' => $this->input->post('company_name'),
					'company_address' => $this->input->post('company_address'),
					'company_tagline' => $this->input->post('company_tagline'),
					'company_description' => $this->input->post('company_description'),
					'company_logo' => $data['upload_data']['orig_name'],
					'created_on' => date('Y-m-d H:i:s'),
				);
				$insert_id_company = $this->common_model->insert_tbl_data('company', $company_data);
				foreach ($this->input->post('sub_property_type_id') as $sub_property) {

					$default_property_bid = $this->common_model->get_tbl_data('sub_property_type', '*', array('sub_property_type_id' => $sub_property), '', $row = 1);

					$property_data = array(
						'id_user' => $company_manager,
						'id_company' => $insert_id_company,
						'id_sub_property_type' => $sub_property,
						'bid_price' => $default_property_bid['min_price'],
					);
					$this->common_model->insert_tbl_data('manager_property', $property_data);
				}
				foreach ($this->input->post('property_zipcode') as $zipcode) {
					$zipcode_data = array(
						'id_user_tbl' => $company_manager,
						'id_company_tbl' => $insert_id_company,
						'id_city' => $zipcode,
					);
					$this->common_model->insert_tbl_data('manager_zipcode', $zipcode_data);
				}
				$this->session->set_flashdata('success_message', 'Sub Account Added Successfully! ');
				redirect('admin/property_manager/');
			} else {

				if (!empty($_FILES['company_logo']['name'])) {
					$company_data = array(
						'company_name' => $this->input->post('company_name'),
						'company_address' => $this->input->post('company_address'),
						'company_tagline' => $this->input->post('company_tagline'),
						'company_description' => $this->input->post('company_description'),
						'company_logo' => $data['upload_data']['orig_name'],
						'created_on' => date('Y-m-d H:i:s'),
					);
				} else {
					$company_data = array(
						'company_name' => $this->input->post('company_name'),
						'company_address' => $this->input->post('company_address'),
						'company_tagline' => $this->input->post('company_tagline'),
						'company_description' => $this->input->post('company_description'),
						'created_on' => date('Y-m-d H:i:s'),
					);
				}
				$this->common_model->update_table('company', $company_data, array('company_id' => $edit_id));

				/*	$this->common_model->dlt_tbl_data('manager_property', array(
						'id_user'    => $company_manager,
						'id_company' => $edit_id
				));*/
				$this->common_model->dlt_tbl_data('manager_zipcode', array(
					'id_user_tbl' => $company_manager,
					'id_company_tbl' => $edit_id,
				));

				$sub_property_data = implode(',', $this->input->post('sub_property_type_id'));

				$this->db->query("DELETE FROM tbl_manager_property WHERE id_user = $company_manager AND id_company = $edit_id AND id_sub_property_type NOT IN ($sub_property_data)");

				foreach ($this->input->post('sub_property_type_id') as $sub_property) {

					$default_property_bid = $this->common_model->get_tbl_data('sub_property_type', '*', array('sub_property_type_id' => $sub_property), '', $row = 1);

					$get_property_data = $this->common_model->get_tbl_data('manager_property', '*', array('id_user' => $company_manager, 'id_company' => $edit_id, 'id_sub_property_type' => $sub_property));

					if (count($get_property_data) < 1) {
						$property_data = array(
							'id_user' => $company_manager,
							'id_company' => $edit_id,
							'id_sub_property_type' => $sub_property,
							'bid_price' => $default_property_bid['min_price'],
						);

						$this->common_model->insert_tbl_data('manager_property', $property_data);
					} else {
						$property_data = array(
							'id_user' => $company_manager,
							'id_company' => $edit_id,
							'id_sub_property_type' => $sub_property,
						);

						$this->common_model->update_table('manager_property', $property_data, array('id_user' => $company_manager, 'id_company' => $edit_id, 'id_sub_property_type' => $sub_property));
					}
				}

				foreach ($this->input->post('property_zipcode') as $zipcode) {
					$zipcode_data = array(
						'id_user_tbl' => $company_manager,
						'id_company_tbl' => $edit_id,
						'id_city' => $zipcode,
					);
					$this->common_model->insert_tbl_data('manager_zipcode', $zipcode_data);
				}
				$this->session->set_flashdata('success_message', 'Updated Successfully! ');
				redirect('admin/property_manager/');
			}
		} else {

			$company = $this->uri->segment(4);
			$company_manager = $this->uri->segment(5);
			$company_id = $this->uri->segment(6);
			if (!empty($company) and $company == 'edit') {
				$data['company_data'] = $this->db->query("SELECT * FROM tbl_company WHERE id_manager = $company_manager AND company_id = $company_id")->row_array();
				$manager_id = $data['company_data']['id_manager'];
				$data['company_zipcode_data'] = $this->db->query("SELECT * FROM tbl_manager_zipcode INNER JOIN tbl_city ON tbl_manager_zipcode.id_city = tbl_city.city_id INNER JOIN tbl_state ON tbl_city.id_state = tbl_state.stateID WHERE id_user_tbl = $company_manager AND id_company_tbl = $company_id")->result_array();
			} else {
				$data['company_data'] = null;
			}
			$data['property_type'] = $this->common_model->get_tbl_data('property_type', '*', '', 'property_type_id ASC');
			$data['property_type_data'] = array();
			foreach ($data['property_type'] as $properties) {
				$data['property_type_data'][] = array(
					'property_type' => $properties['property_type'],
					$this->get_sub_properties($properties['property_type_id']),
				);
			}
			$data['city_data'] = $this->common_model->get_tbl_data('city', '*', '', 'city ASC');
			$this->load->view('admin/common/header');
			$this->load->view('admin/setting/manage_company', $data);
			$this->load->view('admin/common/footer');
		}
	}

	public function get_sub_properties($property_id)
	{

		$qry = $this->common_model->get_tbl_data('sub_property_type', '*', array('id_property_type' => $property_id));

		return $qry;
	}

	public function join_network_request()
	{

		is_admin_in();
		if ($this->uri->segment(4) == 'del') {
			$this->common_model->del_record('join_network', 'id', $this->uri->segment(5), 'admin/property_manager/join_network_request/', 'Deleted Successfully');
		}
		$data['join_network_data'] = $this->db->query("SELECT * FROM tbl_join_network ORDER BY created_on DESC")->result_array();
		$this->load->view('admin/common/header');
		//$this->load->view('admin/common/menubar');
		$this->load->view('admin/setting/join_network_request', $data);
		$this->load->view('admin/common/footer');
	}

	public function review_profile()
	{

		is_admin_in();
		if ($this->uri->segment(4) == 'del') {
			$this->common_model->del_record('join_network', 'id', $this->uri->segment(5), 'admin/property_manager/join_network_request/', 'Deleted Successfully');
		}

		$data['pending_review_data'] = $this->db->query("SELECT * FROM tbl_company INNER JOIN tbl_user ON tbl_company.id_manager = tbl_user.user_id WHERE tbl_company.is_profile_verify = 0 AND is_profile_approved = 'pending' ORDER BY tbl_company.created_on DESC")->result_array();

		$this->load->view('admin/common/header');
		//$this->load->view('admin/common/menubar');
		$this->load->view('admin/setting/review_profile', $data);
		$this->load->view('admin/common/footer');
	}

	public function profile_review_status()
	{;
		$user_id = $this->input->post('user_id');
		$company_id = $this->input->post('company_id');
		$status = $this->input->post('status');
		$email = $this->input->post('email');

		if ($status == 'approved') {
			$this->common_model->update_table('company', array('is_profile_verify' => 1, 'is_profile_approved' => $status), array('company_id' => $company_id));

			$this->smtp_email->send('info@selectpropertymanager.com', 'Select Property Manager', $email, $cc = FALSE, 'Profile changes Approved', $this->email_temp_formal->email_content('Profile changes Approved', 'Your business profile changes has been approved and moved to live with the access of every visitor.', '' . base_url() . 'login', 'Login Now'));
		} else {
			$this->common_model->update_table('company', array('is_profile_approved' => $status), array('company_id' => $company_id));

			$this->smtp_email->send('info@selectpropertymanager.com', 'Select Property Manager', $email, $cc = FALSE, 'Profile changes Decline', $this->email_temp_formal->email_content('Profile changes Decline', 'We are soory to inform you that your bussines profile changes are not approved. we have established a set of editorial guidelines, which are outlined on the business profile page. Please adhere to these guidelines and contact us with any questions!', '' . base_url() . 'login', 'Login Now'));
		}
	}

	public function manage_city()
	{

		$city_id = $this->input->post('city_id');
		if (isset($city_id)) {
			$config = array(
				'upload_path' => FCPATH . 'upload_dir/city_graphic/',
				'allowed_types' => 'jpg|png|PNG|JPG|JPEG|jpeg|gif',
				'max_size' => 0,
				'max_width' => 0,
				'max_height' => 0,
				'file_name' => $this->currTime,
			);
			$this->load->library('upload', $config);
			if (!empty($_FILES['info_graphic_image']['name']) && !$this->upload->do_upload('info_graphic_image')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error_message', $error['error']);
				redirect('admin/property_manager/manage_property_manager/');
			}
			$data = array('upload_data' => $this->upload->data());
			$insert_data = array(
				'id_city' => $this->input->post('city_id'),
				'tagline' => $this->input->post('city_tagline'),
				'market_overview' => $this->input->post('company_market_overview'),
				'info_graphic_title' => $this->input->post('info_graphic_ranking'),
				'info_graphic_image' => $data['upload_data']['orig_name'],
				'description' => $this->input->post('city_description'),
			);
			$chk_duplicate = $this->common_model->get_tbl_data('city_detail', '*', array('id_city' => $city_id));
			if (count($chk_duplicate) < 1) {

				$this->db->insert('city_detail', $insert_data);
				echo 'Added Successfully';
			} else {

				if (!empty($_FILES['info_graphic_image']['name'])) {
					$update_data = array(
						'tagline' => $this->input->post('city_tagline'),
						'market_overview' => $this->input->post('company_market_overview'),
						'info_graphic_title' => $this->input->post('info_graphic_ranking'),
						'info_graphic_image' => $data['upload_data']['orig_name'],
						'description' => $this->input->post('city_description'),
					);
				} else {
					$update_data = array(
						'tagline' => $this->input->post('city_tagline'),
						'market_overview' => $this->input->post('company_market_overview'),
						'info_graphic_title' => $this->input->post('info_graphic_ranking'),
						'description' => $this->input->post('city_description'),
					);
				}
				$this->common_model->update_table('city_detail', $update_data, array('id_city' => $city_id));
				echo 'Updated Successfully';
			}
		} else {

			$data['state_data'] = $this->common_model->get_tbl_data('state', '*', '', 'stateName ASC');
			$data['city_data'] = $this->common_model->get_tbl_data('city', '*', '', 'city ASC');
			$this->load->view('admin/common/header');
			$this->load->view('admin/setting/manage_city', $data);
			$this->load->view('admin/common/footer');
		}
	}
	public function change_status()
	{
		$id = $this->input->post('id');
		$active = $this->input->post('active');
		$this->common_model->update_tbl_data('user', array('approved' => $active), array('user_id' => $id));
		echo 'Status Change Successfully!';
	}

	public function get_city()
	{

		$state_id = $this->input->post('state_id');
		$city_data = $this->common_model->get_tbl_data('city', '*', array('id_state' => $state_id), 'city ASC', '', 'city');
		$new_arr = array();
		foreach ($city_data as $data) {

			echo '<option value="' . $data['city_id'] . '">' . $data['city'] . ' </option>';
		}
	}

	public function get_city_detail()
	{

		$city_id = $this->input->post('city_id');
		$city_data = $this->db->query("SELECT * FROM tbl_city_detail WHERE id_city = '$city_id' ")->row_array();
		$response_data = array(
			'tagline' => $city_data['tagline'],
			'market_overview' => $city_data['market_overview'],
			'info_graphic_title' => $city_data['info_graphic_title'],
			'city_desc' => $city_data['description'],
		);
		echo json_encode($response_data, TRUE);
	}

	public function get_zipcodes_json()
	{

		$q = $this->input->post('q');
		$zipcodes_data = $this->db->query("SELECT city_id AS id, city, country, zip AS text FROM tbl_city INNER JOIN tbl_state ON tbl_city.id_state = tbl_state.stateID WHERE ZIP LIKE  '%$q%'")->result_array();
		$new_arr = array();
		foreach ($zipcodes_data as $data) {

			$new_arr[] = array(
				'id' => $data['id'],
				'text' => $data['text'] . ' (' . $data['city'] . ' - ' . $data['country'] . ')',
			);
			//$new_arr['text'] = $data['text'] . ' (' . $data['city'] . ' - ' . $data['country'] . ')';
		}
		echo json_encode($new_arr, TRUE);
	}

	public function manage_account()
	{

		is_admin_in();
		$this->load->view('admin/common/header');
		$company_manager = $this->uri->segment(4);
		$data['accounts_data'] = $this->db->query("SELECT *,tbl_account.created_on as acc_date FROM tbl_user INNER JOIN tbl_account ON tbl_user.user_id = tbl_account.user_id
        WHERE tbl_account.user_id = '$company_manager' AND tbl_user.user_type = 'client' ORDER BY tbl_account.created_on DESC")->result_array();
		/*$data['accounts_data'] = $this->db->query("SELECT * FROM tbl_user INNER JOIN tbl_account ON tbl_user.user_id = tbl_account.user_id
			        INNER JOIN tbl_invoices ON tbl_user.user_id = tbl_invoices.user_id
		*/
		$this->load->view('admin/accounts/accounts_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function account_detail()
	{

		is_admin_in();
		$id_user = $this->uri->segment(4);
		$data['account_data'] = $this->db->query("SELECT *,tbl_transaction.created_at AS txn_date FROM `tbl_transaction` INNER JOIN tbl_user ON tbl_transaction.id_user = tbl_user.user_id  WHERE tbl_transaction.id_user = '$id_user' ORDER BY tbl_transaction.created_at DESC")->result_array();
		$data['current_balance'] = $this->db->query("SELECT * FROM tbl_account WHERE user_id = '$id_user'")->row_array();
		$data['manager_company_data'] = $this->db->query("SELECT * FROM tbl_company WHERE id_manager = '$id_user'")->result_array();
		/*$data['accounts_data'] = $this->db->query("SELECT * FROM tbl_user INNER JOIN tbl_account ON tbl_user.user_id = tbl_account.user_id
			        INNER JOIN tbl_invoices ON tbl_user.user_id = tbl_invoices.user_id
		*/
		$this->load->view('admin/common/header');
		$this->load->view('admin/accounts/account_detail', $data);
		$this->load->view('admin/common/footer');
	}

	public function manage_leads()
	{

		is_admin_in();
		$manager = $this->uri->segment(4);
		$data['leads_data'] = $this->db->query("SELECT *, tbl_quote_request.created_on AS lead_date FROM tbl_user
			INNER JOIN tbl_company ON tbl_user.user_id = tbl_company.id_manager
			INNER JOIN tbl_manager_property ON tbl_company.company_id = tbl_manager_property.id_company
			INNER JOIN tbl_quote_request ON tbl_company.company_id = tbl_quote_request.id_quote_company
			INNER JOIN tbl_sub_property_type ON tbl_quote_request.id_quote_property = tbl_sub_property_type.sub_property_type_id
			WHERE tbl_company.id_manager = '$manager'
			GROUP BY tbl_quote_request.quote_id ORDER BY tbl_quote_request.created_on DESC ")->result_array();
		$this->load->view('admin/common/header');
		$this->load->view('admin/leads/manage_leads', $data);
		$this->load->view('admin/common/footer');
	}

	public function lead_notify()
	{

		is_user_in();
		$this->load->view('admin/common/header');
		$data['company_data'] = $manager_company = $this->db->query("SELECT * FROM tbl_company LEFT JOIN tbl_user ON tbl_company.id_manager = tbl_user.user_id ORDER BY tbl_company.created_on DESC")->result_array();
		$this->load->view('admin/leads/lead_notify', $data);
		$this->load->view('admin/common/footer');
	}

	public function acc_renewal()
	{

		is_admin_in();
		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret_key'));
		$plans = \Stripe\Plan::all();
		$data['plans_data'] = $plans->data;
		//echo '<pre>'; print_r($data['plans_data']); echo '</pre>'; exit('Exit');
		$data['accounts_data'] = $this->db->query("SELECT *,tbl_user.user_id AS default_user_id, tbl_account.created_on as acc_date FROM tbl_user
		INNER JOIN tbl_account ON tbl_user.user_id = tbl_account.user_id
		INNER JOIN tbl_account_subscription ON tbl_user.user_id = tbl_account_subscription.user_id
		WHERE tbl_user.user_type = 'client' ORDER BY tbl_account.created_on DESC")->result_array();
		/*$data['accounts_data'] = $this->db->query("SELECT * FROM tbl_user INNER JOIN tbl_account ON tbl_user.user_id = tbl_account.user_id
			        INNER JOIN tbl_invoices ON tbl_user.user_id = tbl_invoices.user_id
		*/
		$this->load->view('admin/common/header');
		$this->load->view('admin/accounts/acc_renewal', $data);
		$this->load->view('admin/common/footer');
	}

	public function cancel_subscription($user_id)
	{

		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret_key'));
		$get_subscription_data = $this->common_model->get_tbl_data('account_subscription', '*', array('user_id' => $user_id), '', $row = 1);
		$sub = \Stripe\Subscription::retrieve($get_subscription_data['subscription_id']);
		$sub->cancel();
		if ($sub->status = "canceled") {
			$update_data = array(
				'status' => 'Canceled',
				'active' => 0,
				'canceled_at' => date('Y-m-d H:i:s', $sub->canceled_at),
			);
			$this->common_model->update_table('account_subscription', $update_data, array('user_id' => $user_id));
			$this->session->set_flashdata('success_message', 'Subscription Canceled Successfully');
			redirect('admin/property_manager/acc_renewal/');
		}
	}

	public function update_zipcode_price()
	{

		$zipcode_id = $this->input->post('zipcode_id');
		$price = $this->input->post('price');
		$this->common_model->update_table('manager_zipcode', array('bid_price' => $price), array('zipcode_id' => $zipcode_id));
	}

	public function quote_detail_pdf($id)
	{

		$this->load->library('dompdf_gen');
		$this->db->select('tbl_quote_request.*,tbl_treatment.treatment_name');
		$this->db->from('tbl_quote_request');
		$this->db->join('tbl_treatment', 'tbl_treatment.id = tbl_quote_request.procedure_treatment');
		$this->db->where('tbl_quote_request.id', $id);
		$printpdf = $this->db->get()->row();

		$trip = '';
		if (!empty($printpdf->destination_hospital_id)) {
			$getHostiptal =  $this->db->where('user_id', $printpdf->destination_hospital_id);
			$getHostiptal =  $this->db->get('tbl_user')->row();

			$trip = $getHostiptal->username . ', ' . $getHostiptal->state . ', ' . $getHostiptal->country . ' (' . $printpdf->destination_start_date . ' to ' . $printpdf->destination_end_date . ')';
		}

		$created_on = date('m-d-Y', strtotime($printpdf->created_on));
		$description = '';
		if (!empty($printpdf->treatment_detail)) {
			$description = str_replace("’", "", $printpdf->treatment_detail);
		} else if (!empty($printpdf->message)) {
			$description = str_replace("’", "", $printpdf->message);
		}

		$html = '';
		$html .= '<style>
			table {
				display: table; border-collapse: collapse;
			}
			.pricedetail tr td
			{
				font-family:Verdana;
				padding:8px;
				text-align:left;
			}
			.pricedetail tr th
			{
				font-family:Verdana;
				padding:8px;
				text-align:left;
				width:25%;
			}
			</style>
			<p><img src="' . base_url() . 'assets/frontend-asset/images/uploads/sites/11/2018/01/logo2.jpg"></p>
			<br />
			<table border="1" width="100%" class="pricedetail" style="margin-top: 15px;">
			<tbody>
				<tr>
				<th>Quote Request Number</th>
				<td>' . $printpdf->request_no . '</td>

				</tr>
				<tr>
				<th>Patient Number</th>
				<td>' . $printpdf->patient_no . '</td>

				</tr>
				<tr>
				<th>Created On</th>
				<td>' . $created_on . '</td>
				</tr>

				<tr>
				<th>Trip</th>
				<td>' . $trip . '</td>
				</tr>
				<tr>
				<th>First Name</th>
				<td>' . $printpdf->first_name . '</td>

				</tr>
				<tr>
				<th>Last Name</th>
				<td>' . $printpdf->last_name . '</td>

				</tr>
				<tr>
				<th>Age</th>
				<td>' . $printpdf->age . '</td>

				</tr>
				<tr>
				<th>Gender</th>
				<td>' . $printpdf->gender . '</td>

				</tr>
				<tr>
				<th>Country</th>
				<td>' . $printpdf->country . '</td>

				</tr>
				<tr>
				<th>Street</th>
				<td>' . $printpdf->street . '</td>

				</tr>
				<tr>
				<th>City</th>
				<td>' . $printpdf->city . '</td>

				</tr>
				<tr>
				<th>State</th>
				<td>' . $printpdf->state . '</td>

				</tr>
				<tr>
				<th>Zipcode</th>
				<td>' . $printpdf->zipcode . '</td>

				</tr>
				<tr>
				<th>Treatment</th>
				<td>' . $printpdf->treatment_name . '</td>

				</tr>
				<tr>
				<th>Desired Country 1</th>
				<td>' . $printpdf->desired_country . '</td>

				</tr>
				<tr>
				<th>Desired State 1</th>
				<td>' . $printpdf->desired_state . '</td>

				</tr>
				<tr>
				<th>Desired Country 2</th>
				<td>' . $printpdf->desired_country2 . '</td>

				</tr>

				
				<tr>
				<th>Desired State 2</th>
				<td>' . $printpdf->desired_state2 . '</td>
				</tr>



			<tr>
				<th>High Cholesterol</th>
				<td>' . $printpdf->high_cholesterol . '</td>

				</tr>
				<tr>
				<th>Anemic</th>
				<td>' . ucfirst($printpdf->anemic) . '</td>

				</tr>
				<tr>
				<th>Diabetic</th>
				<td>' . ucfirst($printpdf->diabetic) . '</td>

				</tr>
				<tr>
				<th>Heart Issues</th>
				<td>' . ucfirst($printpdf->heart_issues) . '</td>

				</tr>
				<tr>
				<th>Allergic</th>
				<td>' . ucfirst($printpdf->allergic) . '</td>

				</tr>
				<tr>
				<th>Pregnant</th>
				<td>' . ucfirst($printpdf->pregnant) . '</td>
				</tr>';

					if (!empty($printpdf->insurance_information)) {
						$html .= ' <tr>
				<th>Insurance</th>
				<td>' . $printpdf->insurance_information . '</td>
				</tr>';
					}

					$html .= '<tr>
				<th>Heath Conditions and Treatment Detail</th>
				<td>' . $description . '</td>
				</tr>

				<tr>
				<th>File</th>
				<td>';
				if (!empty($printpdf->quote_image)) {
					$file_type_one = $this->common_model->getFileSingle($printpdf->file_type_one);
					if (!empty($file_type_one)) {
						$html .= '' . $file_type_one->name . ' ';
					}

					$html .= '<a href="' . base_url() . 'upload_dir/quote_image/' . $printpdf->quote_image . '" style="text-decoration: underline;color:blue;">File 1</a> &nbsp;&nbsp;&nbsp;';
				}

				if (!empty($printpdf->quote_image_two)) {
					$file_type_two = $this->common_model->getFileSingle($printpdf->file_type_two);
					if (!empty($file_type_two)) {
						$html .= '' . $file_type_two->name . ' ';
					}

					$html .= '<a href="' . base_url() . 'upload_dir/quote_image/' . $printpdf->quote_image_two . '" style="text-decoration: underline;color:blue;">File 2</a> &nbsp;&nbsp;&nbsp;';
				}

				if (!empty($printpdf->quote_image_three)) {
					$file_type_three = $this->common_model->getFileSingle($printpdf->file_type_three);
					if (!empty($file_type_three)) {
						$html .= '' . $file_type_three->name . ' ';
					}

					$html .= '<a href="' . base_url() . 'upload_dir/quote_image/' . $printpdf->quote_image_three . '" style="text-decoration: underline;color:blue;">File 3</a> &nbsp;&nbsp;&nbsp;';
				}

				if (!empty($printpdf->quote_image_four)) {
					$file_type_four = $this->common_model->getFileSingle($printpdf->file_type_four);
					if (!empty($file_type_four)) {
						$html .= '' . $file_type_four->name . ' ';
					}

					$html .= '<a href="' . base_url() . 'upload_dir/quote_image/' . $printpdf->quote_image_four . '" style="text-decoration: underline;color:blue;">File 4</a> &nbsp;&nbsp;&nbsp;';
				}

				if (!empty($printpdf->quote_image_five)) {
					$file_type_five = $this->common_model->getFileSingle($printpdf->file_type_five);
					if (!empty($file_type_five)) {
						$html .= '' . $file_type_five->name . ' ';
					}

					$html .= '<a href="' . base_url() . 'upload_dir/quote_image/' . $printpdf->quote_image_five . '" style="text-decoration: underline;color:blue;">File 5</a> &nbsp;&nbsp;&nbsp;';
				}

				$html .= '</td>
			</tr>
			</tbody>
			</table>';

				$pdfname = "quote_detail.pdf";
				$this->dompdf->load_html(utf8_decode($html));
				$this->dompdf->render();
				$output = $this->dompdf->output();
				$this->dompdf->stream($pdfname);
				// file_put_contents('public/invoice/' . $pdfname . '', $output);
			}

			public function quote_detail_sent_pdf($id)
			{
				$this->load->library('dompdf_gen');

				$quote_sent_data = $this->db->select('tbl_quote_sent.*,tbl_user.email,tbl_user.user_type,tbl_user.phone_no,tbl_doctors.name,tbl_treatment.treatment_name,tbl_quote_request.first_name,tbl_quote_request.last_name');
				$quote_sent_data = $this->db->from('tbl_quote_sent');
				$quote_sent_data = $this->db->join('tbl_user', 'tbl_user.user_id  = tbl_quote_sent.id_user');
				$quote_sent_data = $this->db->join('tbl_doctors', 'tbl_doctors.doctor_id  = tbl_quote_sent.doctor_id', 'left');
				$quote_sent_data = $this->db->join('tbl_quote_request', 'tbl_quote_request.id  = tbl_quote_sent.quote_request_id');
				$quote_sent_data = $this->db->join('tbl_treatment', 'tbl_treatment.id  = tbl_quote_request.procedure_treatment');
				$quote_sent_data = $this->db->where('tbl_quote_sent.quote_sent_id', $id);
				$quote_sent_data = $this->db->get()->row();

				$getHospital = $this->db->select('tbl_hospital.*,tbl_user.country,tbl_user.state');
				$getHospital = $this->db->from('tbl_hospital');
				$getHospital = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_hospital.user_id');
				$getHospital = $this->db->where('tbl_hospital.id', $quote_sent_data->hospital_table_id);
				$getHospital = $this->db->get()->row();


				$prepayment_hospital = 0;

				if (trim($quote_sent_data->user_type) == 'agent') {
					$prepayment_hospital = $quote_sent_data->agent_prepay;
				} else {
					if (!empty($quote_sent_data->hospital_id)) {
						$getHospital = $this->db->where('user_id', $quote_sent_data->hospital_id);
						$getHospital = $this->db->get('tbl_user')->row();
						$prepayment_hospital = $getHospital->hospital_prepay;
					}
				}

				$created_on = date('m-d-Y', strtotime($quote_sent_data->created_on));

				$rev_date = '';
				if (!empty($quote_sent_data->rev_date)) {
					$rev_date = date('m-d-Y', strtotime($quote_sent_data->rev_date));
				}

				$html = '';
				$html .= '<style>
				table {
					display: table; border-collapse: collapse;
				}
				.pricedetail tr td
				{
					font-family:Verdana;
					padding:8px;
					text-align:left;
				}
				.pricedetail tr th
				{
					font-family:Verdana;
					padding:8px;
					text-align:left;
					width:25%;
				}
				</style>

				<p><img src="' . base_url() . 'assets/frontend-asset/images/uploads/sites/11/2018/01/logo2.jpg"></p>
				<p style="font-weight: bold;"> Illinois, USA</p>
				<p style="font-weight: bold;"> USA & Canada +1888 9699959</p>
				<p style="font-weight: bold;"> Worldwide  +1312 8899105 </p>
				<p style="font-weight: bold;"> Turkey +90 (541)9473789 </p>
				<p style="font-weight: bold;"> care@meddistant.com</p>

		<table border="1" width="100%" class="pricedetail" style="margin-top: 5px;">
		<tbody>
		<tr>
		<th>Date</th>
		<td>' . $created_on . '</td>

		</tr>
		<tr>
		<th>Patient Name</th>
		<td>' . $quote_sent_data->first_name . ' ' . $quote_sent_data->last_name . '</td>

		</tr>
		';

		if (!empty($rev_date)) {
			$html .= ' <tr>
      <th>Rev. Date</th>
       <td>' . $rev_date . '</td>
    </tr>';
		}

		if ($quote_sent_data->type == 'Treatment') {
			$html .= '<tr>
      <th>Treatment</th>

       <td>' . $quote_sent_data->treatment_name . '</td>
    </tr>';
		} else {
			$html .= '<tr>
      <th>Service</th>

       <td>' . $quote_sent_data->service_name . '</td>
    </tr>';
		}

		$html .= '<tr>
      <th>Hospital/Clinic</th>
     <td>' . $quote_sent_data->hospital_clinic . '</td>

    </tr>';

		if (!empty($getHospital)) {
			$html .= '
		<tr>
      <th>Hospital Pic</th>
     <td><img  style="height: 80px; width: 100px;" src="' . base_url() . 'uploads/hospital/' . $getHospital->pic_area . '"></td>


			<tr>
      <th>Hospital City</th>
     <td>' . $getHospital->hospital_city . '</td>

    </tr>
    <tr>
      <th>Hospital JCI</th>
     <td>' . $getHospital->hospital_jci . '</td>

    </tr>
    <tr>
      <th>Hospital State</th>

       <td>' . $getHospital->state . '</td>
    </tr>
    <tr>
      <th>Hospital Country</th>
      <td>' . $getHospital->country . '</td>

    </tr>';
		}

		$Quotes_Ref = ($quote_sent_data->type != 'Service') ? 'Hospital' : '';

		$html .= '<tr>
      <th>' . $Quotes_Ref . ' Quotes/Ref. No.</th>

       <td>' . $quote_sent_data->hospital_ref . '</td>
    </tr>
    <tr>
      <th>Quote By</th>

        <td>' . $quote_sent_data->quote_by . '</td>
    </tr>
    <tr>
      <th>Email</th>
     <td>' . $quote_sent_data->email . '</td>

    </tr>
    <tr>
      <th>Phone No</th>
     <td>' . $quote_sent_data->phone_no . '</td>

    </tr>';

		if (!empty($quote_sent_data->name)) {
			$doctor_name = $quote_sent_data->name;
		} else {
			$doctor_name = $quote_sent_data->new_doctor;
		}

		$html .= '<tr>
      <th>Doctor</th>
     <td>' . $doctor_name . '</td>

    </tr>';

		$html .= '<tr>
      <th>4/5 Star Stay Included</th>

      <td>' . $quote_sent_data->accomodations . '</td>
    </tr>';

		if ($quote_sent_data->accomodations == 'yes') {

			$html .= ' <tr>
      <th>Hotel Name</th>
     <td>' . $quote_sent_data->hotel_name . '</td>

    </tr>';
		}

		$Message_Proposed_treatment = ($quote_sent_data->type != 'Service') ? 'Message/Proposed treatment' : 'Proposed Service';

		$html .= '<tr>
      <th>' . $Message_Proposed_treatment . '</th>

      <td>' . $quote_sent_data->message . '</td>
    </tr>
    <tr>
      <th>Length of stay (Days)</th>
       <td>' . $quote_sent_data->stay_length . '</td>

    </tr>
    ';

		if ($quote_sent_data->accomodations == 'yes') {
			$html .= '<tr>
      <th>Hotel Total Cost ($)</th>

        <td>' . $quote_sent_data->hotel_cost . '</td>
    </tr>';
		}

		$cost_name = ($quote_sent_data->type != 'Service') ? 'Treatment' : '';

		$html .= ' <tr>
      <th>' . $cost_name . ' Cost ($)</th>
        <td>' . $quote_sent_data->treatment_cost . '</td>
    </tr>';

		if (!empty($quote_sent_data->facilitation_fees)) {
			$html .= '<tr>
      <th>Facilitation Fees ($)</th>
      <td>' . $quote_sent_data->facilitation_fees . '</td>
    </tr>';
		}



		$html .= '<tr>
      <th>Prepayment (%)</th>
      <td>' . $prepayment_hospital . '%</td>
    </tr>

    <tr>
      <th>File</th>
      <td>';
		if (!empty($quote_sent_data->file_one)) {
			$html .= '<a href="' . base_url() . 'uploads/quotes/' . $quote_sent_data->file_one . '" style="text-decoration: underline;color:blue;">File 1</a> &nbsp;&nbsp;&nbsp;';
		}

		if (!empty($quote_sent_data->file_two)) {
			$html .= '<a href="' . base_url() . 'uploads/quotes/' . $quote_sent_data->file_two . '" style="text-decoration: underline;color:blue;">File 2</a> &nbsp;&nbsp;&nbsp;';
		}

		if (!empty($quote_sent_data->file_three)) {
			$html .= '<a href="' . base_url() . 'uploads/quotes/' . $quote_sent_data->file_three . '" style="text-decoration: underline;color:blue;">File 3</a> &nbsp;&nbsp;&nbsp;';
		}

		if (!empty($quote_sent_data->file_four)) {
			$html .= '<a href="' . base_url() . 'uploads/quotes/' . $quote_sent_data->file_four . '" style="text-decoration: underline;color:blue;">File 4</a> &nbsp;&nbsp;&nbsp;';
		}

		if (!empty($quote_sent_data->file_five)) {
			$html .= '<a href="' . base_url() . 'uploads/quotes/' . $quote_sent_data->file_five . '" style="text-decoration: underline;color:blue;">File 5</a> &nbsp;&nbsp;&nbsp;';
		}

		$html .= '</td>
    </tr>





    </tbody>






		</table>';

		$pdfname = "quote_detail_sent.pdf";
		$this->dompdf->load_html(utf8_decode($html));
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$this->dompdf->stream($pdfname);
		// file_put_contents('public/invoice/' . $pdfname . '', $output);
	}


	public function reset_password_via_email()
	{
		$id = $this->input->post('id');

		$user = $this->common_model->get_single_user($id);

		$password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8 / strlen($x)))), 1, 8);

		$this->common_model->update_tbl_data('user', array('password' => md5($password)), array('user_id' => $id));

		$subject = 'Forgot Password';
		$str = "<p>Looks like you forgot your password,<br/> here is your new generated password: <b style='color: #ff2600'>'".$password."'</b> if you want to update this password please login:</p>";

		$getdata =$this->common_model->mail_mail($user->email, $subject, $str, "joez@meddistant.com");
		
		$json['success'] = $getdata;

		echo json_encode($json);


	}

	// Work date 20/10/2020

	public function assign_country($id)
	{
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		
	    $data['getRecord'] = $this->common_model->getCountryAgent($id);
 		
 		// print_r($this->db->last_query());
        //die;
		$data['get_country'] = $this->db->get('tbl_country')->result();
		$data['user_id'] = $id;
		$this->load->view('admin/agent/manage_country', $data);
		$this->load->view('admin/common/footer');
	}

	public function add_assign_country() {

		$check = $this->db->where('country_id', $this->input->post('country_id'));
		$check = $this->db->where('user_id', $this->input->post('user_id'));
		$check = $this->db->get('tbl_user_country')->num_rows();
		if ($check == 0) {
			$arrays = array(
				'country_id' => $this->input->post('country_id'),
				'user_id' => $this->input->post('user_id'),
				'created_at' => date('Y-m-d H:i:s'),

			);

			$this->db->insert('tbl_user_country', $arrays);
		}
	    $this->session->set_flashdata('success_message', 'Country Successfully Assign');
		redirect('admin/agent/assign_country/' . $this->input->post('user_id'));

	}

	public function delete_assign_country($user_id, $id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_user_country');
		$this->session->set_flashdata('success_message', 'Assign Country Successfully Deleted');
		redirect('admin/agent/assign_country/' . $user_id);
	}


	public function assign_state($id)
	{
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		
		$data['getRecord'] = $this->common_model->getStateAgent($id);

		$data['get_state'] = $this->db->get('tbl_state')->result();
		$data['user_id'] = $id;
		$this->load->view('admin/agent/manage_state', $data);
		$this->load->view('admin/common/footer');
	}

	public function add_assign_state()
	{
		$check = $this->db->where('state_id', $this->input->post('state_id'));
		$check = $this->db->where('user_id', $this->input->post('user_id'));
		$check = $this->db->get('tbl_user_state')->num_rows();
		if ($check == 0)
			{
				$arrays = array(
					'state_id'   => $this->input->post('state_id'), 
					'user_id'    => $this->input->post('user_id'), 
					'created_at' => date('Y-m-d H:i:s'), 
				);
				$this->db->insert('tbl_user_state', $arrays);
			}
		$this->session->set_flashdata('success_message', 'State Successfully Assign');
		redirect('admin/agent/assign_state/' . $this->input->post('user_id'));
	}

	public function delete_assign_state($user_id, $id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_user_state');
		$this->session->set_flashdata('success_message', 'Assign State Successfully Deleted');
		redirect('admin/agent/assign_state/' . $user_id);
	}

	// Work date 24/10/2020
	public function pdf_consent($id)
	{
	    $this->load->library('dompdf_gen');
		$printquote = $this->common_model->pdf_quote_request($id);
		$data['record'] = $printquote;
		$html = $this->load->view('admin/agent/manage_quote_request_pdf', $data, TRUE);
		$pdfname = date('Ymdhis') . "manage_quote_request.pdf";
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$output = $this->dompdf->output();

		$this->dompdf->stream($pdfname);
		// file_put_contents('assets/manage_quote_request/' . $pdfname . '', $output);
		// redirect('admin/dashboard');
	} 

}
