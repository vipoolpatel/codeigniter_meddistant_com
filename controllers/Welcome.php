<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {

		$getlanding_page = $this->db->where('slug','home');
		$getlanding_page = $this->db->get('tbl_landing_page')->row();
		$data['getlanding_page'] = $getlanding_page;

		$data['getHeader'] = $this->common_model->getHeader('home');

		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('welcome/welcome');
		$this->load->view('common/footer');
	}

	public function reservation() {

		$checkin = str_replace('/', '-', $this->input->post('date_from'));
		$checkout = str_replace('/', '-', $this->input->post('date_to'));
		$total_nights = $this->input->post('total_nights');
		$adults = $this->input->post('adults');
		$children = $this->input->post('children');
		if (!empty($total_nights)) {

			$data['booking_prices_data'] = $this->common_model->get_tbl_data('booking_setup', '*', '', $row = 1);
			$data['booking_data'] = array(
				'checkin' => $checkin,
				'checkout' => $checkout,
				'total_nights' => $total_nights,
				'adults' => $adults,
				'children' => $children,
			);
			$this->load->view('common/header');
			$this->load->view('common/menubar');
			$this->load->view('book_house/bookHouse', $data);
			$this->load->view('common/footer');
		} else {
			$this->session->set_flashdata('error', 'Please select your trip dates');
			redirect('welcome');
		}
	}

	public function about() {
		$this->load->view('common/header');
		$this->load->view('common/menubar');
		$this->load->view('welcome/about');
		$this->load->view('common/footer');
	}

	public function how_it_works() {

		$data['getHeader'] = $this->common_model->getHeader('how-it-works');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('welcome/how_it_works');
		$this->load->view('common/footer');
	}

	public function top_doctors() {

		$data['getHeader'] = $this->common_model->getHeader('top-doctors');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('welcome/top_doctors');
		$this->load->view('common/footer');
	}

	public function top_hospitals() {

		$data['getHeader'] = $this->common_model->getHeader('top-hospitals');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('welcome/top_hospitals');
		$this->load->view('common/footer');
	}

	public function availability() {

		$this->load->view('common/header');
		$this->load->view('common/menubar');
		$data['availability_data'] = $this->common_model->get_tbl_data('availability', '*', '', '', 'avl_date ASC');
		$event_array = array();
		foreach ($data['availability_data'] as $data) {
			$event_array[] = array(
				'title' => $data['title'],
				'start' => $data['avl_date'],
				'allDay' => TRUE,
			);
		}
		$data['json_availability_data'] = $event_array;
		$this->load->view('welcome/availability', $data);
		//$this->load->view('common/footer');
	}

	public function email_subscription() {

		$email = $this->input->post('email');
		if ($this->input->post('current_captcha') == $this->input->post('captcha')) {
			if (!empty($email)) {
				$check_qry = $this->common_model->get_tbl_data('email_subscription', '*', array('email' => $email));
				if (count($check_qry) < 1) {
					$data = array(
						'email' => $email,
						'subscription_date' => date('Y-m-d H:i:s'),
					);
					$this->common_model->insert_tbl_data('email_subscription', $data);
					$this->session->set_flashdata('success_message', 'You are successfully subscribed for Newsletter!');
					redirect('welcome');
				} else {
					$this->session->set_flashdata('error_message', 'This Email is already subscribed');
				}
				redirect('welcome');
			}
		} else {
			$this->session->set_flashdata('error_message', 'Email required!');
			redirect('welcome');
		}
	}

	public function contact() {
 
		if (!empty($_POST)) {

			if ($this->input->post('current_captcha') == $this->input->post('captcha')) {

				$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_contact_us.email]');
				if ($this->form_validation->run() == TRUE) {

					$insert_data = array(
						'first_name' => $this->input->post('full_name'),
						'last_name' => $this->input->post('lname'),
						'full_name' => $this->input->post('full_name') . ' ' . $this->input->post('lname'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('phone'),
						'subject' => $this->input->post('subject'),
						'message' => $this->input->post('message'),
						'contact_date' => date('Y-m-d H:i:s'),
					);

					$save_user = $this->common_model->insert_tbl_data('contact_us', $insert_data);

					/*$this->smtp_email->send('support@16oceanbreeze.com', '16 Ocean Breeze', 'Rentals@16oceanbreeze.com', $cc = FALSE, '16 Ocean Breeze Contact Us Query', $this->email_temp->email_content('Contact Query', ' <span style="color: black">Hi Michael,</span> <br><br> <b> ' . ucfirst($this->input->post('firstName')) . '</b> Contacted us through 16 Ocean Breeze! contact us page, below You can find his query in detail. <br><br>
						<table width="100%" border="1" style="border-collapse: collapse; font-size: 13px">
						 <tr><td style="padding: 15px; width: 30%"><B>First Name:</B></td> <td width="70%" style="padding: 15px;">' . ucfirst($this->input->post('firstName')) . '</td></tr>
						 <tr><td style="padding: 15px; width: 30%""><b>Last Name:</b></td> <td width="70%" style="padding: 15px;">' . ucfirst($this->input->post('lastName')) . '</td></tr>
						 <tr><td style="padding: 15px; width: 30%""><b>Email:</b></td> <td width="70%"style="padding: 15px;"><a style="color: #0411a0" href="mailto:' . $this->input->post('email') . '">' . $this->input->post('email') . '</a> </td></tr>
						 <tr><td style="padding: 15px; width: 30%""><b>Message:</b></td> <td width="70%" style="padding: 15px;">' . $this->input->post('message') . '</td></tr>
						</table>',
					*/

					$this->session->set_flashdata('success_message', 'Inquiry sent successfully! We will get you back soon!');

					redirect('contact');
				}

			} else {
				$this->session->set_flashdata('error_message', 'Verification Code does not match.');
				redirect('contact');
			}

		}

		$data['getHeader'] = $this->common_model->getHeader('contact');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('welcome/contact');
		$this->load->view('common/footer');
	}

	public function schedule_call() {

		if ($this->input->post('email')) {

			$insert_data = array(
				'full_name' => $this->input->post('full_name'),
				'email' => $this->input->post('email'),
				'phone_no' => $this->input->post('phone_no'),
				'procedure_treatment' => $this->input->post('procedure_treatment'),
				'schedule_date' => $this->input->post('schedule_date'),
				'time_from' => $this->input->post('time_from'),
				'time_to' => $this->input->post('time_to'),
				'message' => $this->input->post('message'),
				'created_on' => date('Y-m-d H:i:s'),
			);

			$agent_id_auto = $this->common_model->getAutoAssignAgentSchedule($this->input->post('email'));
			if (!empty($agent_id_auto)) {
				$insert_data['agent'] = $agent_id_auto;
			}

			$save_user = $this->common_model->insert_tbl_data('scheduled_calls', $insert_data);

			/*$this->smtp_email->send('support@16oceanbreeze.com', '16 Ocean Breeze', 'Rentals@16oceanbreeze.com', $cc = FALSE, '16 Ocean Breeze Contact Us Query', $this->email_temp->email_content('Contact Query', ' <span style="color: black">Hi Michael,</span> <br><br> <b> ' . ucfirst($this->input->post('firstName')) . '</b> Contacted us through 16 Ocean Breeze! contact us page, below You can find his query in detail. <br><br>
				<tabletbl_booking_setup width="100%" border="1" style="border-collapse: collapse; font-size: 13px">
				 <tr><td style="padding: 15px; width: 30%"><B>First Name:</B></td> <td width="70%" style="padding: 15px;">' . ucfirst($this->input->post('firstName')) . '</td></tr>
				 <tr><td style="padding: 15px; width: 30%""><b>Last Name:</b></td> <td width="70%" style="padding: 15px;">' . ucfirst($this->input->post('lastName')) . '</td></tr>
				 <tr><td style="padding: 15px; width: 30%""><b>Email:</b></td> <td width="70%"style="padding: 15px;"><a style="color: #0411a0" href="mailto:' . $this->input->post('email') . '">' . $this->input->post('email') . '</a> </td></tr>
				 <tr><td style="padding: 15px; width: 30%""><b>Message:</b></td> <td width="70%" style="padding: 15px;">' . $this->input->post('message') . '</td></tr>
				</table>',
			*/

			$this->session->set_flashdata('success_message', 'Call Scheduled Successfully! We will get you back soon!');

			redirect('schedule-call');

		} else {

			$getTreatment = $this->db->order_by('order_by_data', 'asc');
			$getTreatment = $this->db->get('tbl_treatment')->result();
			$data['getTreatment'] = $getTreatment;

			$data['getHeader'] = $this->common_model->getHeader('schedule-call');
			$this->load->view('common/header', $data);
			// $this->load->view('common/menubar');
			$this->load->view('welcome/schedule_call', $data);
			$this->load->view('common/footer');
		}
	}

	public function quote_request() {

		// if ($this->input->post('email')) {

		/* php recaptcha code */

		// Build POST request:
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		$recaptcha_secret = '6LdZu8YUAAAAABLmDnufQiM3t8PD4fyx91t3-2Oc';
		$recaptcha_response = $_POST['recaptcha_response'];

		// Make and decode POST request:
		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		$recaptcha = json_decode($recaptcha);

		if ($recaptcha->score >= 0.5) {

			$get_record = $this->db->order_by('request_no', 'desc');
			$get_record = $this->db->limit('1');
			$get_record = $this->db->get('tbl_quote_request')->row();

			if (!empty($get_record)) {
				$request_no = $get_record->request_no + 1;
			} else {
				$request_no = '1000101';
			}

			$insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'request_no' => $request_no,
				'email' => $this->input->post('email'),
				'phone_no' => $this->input->post('phone_no'),
				'procedure_treatment' => $this->input->post('procedure_treatment'),
				'message' => $this->input->post('message'),
				'created_on' => date('Y-m-d H:i:s'),
			);

			$insert_id = $this->common_model->insert_tbl_data('quote_request', $insert_data);

			$this->session->set_userdata($insert_data);
			$this->session->set_userdata(array('user_type' => 'customer'));
			$this->session->set_userdata(array('quote_process_id' => $insert_id));

			$this->session->set_flashdata('success_message', 'Please provide some additional information so that we can send you a best related quote!');
			redirect('quote-process');

		} else {

			$this->session->set_flashdata('error_message', 'You are bot');
			redirect('welcome');

		}

/*			$response = array(
'status' => 'success',
'msg'    => 'Call Scheduled Successfully! We will get you back soon!'
);
echo json_encode($response);*/
		// } else {
		// 	$this->load->view('common/header');
		// 	// $this->load->view('common/menubar');
		// 	$this->load->view('welcome/schedule_call');
		// 	$this->load->view('common/footer');
		// }
	}

	

	public function getTreatmentHospital()
	{
		$treatment_id = $this->input->post('treatment_id');

		$getDestinationHospital = $this->common_model->getDestinationTreatmentHospital($treatment_id);

		$html = '';
		$html .= '<option data-val="" value="">No Destionation Plan</option>';
		
		foreach ($getDestinationHospital as $key => $destination) {

			$html .= '<option data-val="'.$destination->country.'" value="'.$destination->user_id.'">'.$destination->username.', '.$destination->city.', '.$destination->state.', '.$destination->country.'  ('.$destination->start_date.' to '.$destination->end_date.')</option>';	
		}		

		$json['success'] = $html;
		echo json_encode($json);
	}



	public function quote_process() {

		$data['getDestinationHospital'] = $this->common_model->getDestinationHospital();
		
		$data['getFileType'] = $this->common_model->getFileType();

		$data['getCountry'] = $this->db->get('tbl_country')->result();

		$getTreatment = $this->db->order_by('order_by_data', 'asc');
		$getTreatment = $this->db->get('tbl_treatment')->result();
		$data['getTreatment'] = $getTreatment;

		$data['getHeader'] = $this->common_model->getHeader('quote-process');
		$this->load->view('common/header', $data);

		$data['getCountryQuate'] = $this->common_model->getCountry('quate');

		// $this->load->view('common/menubar');
		$this->load->view('welcome/quote_process', $data);
		$this->load->view('common/footer');

	}

	public function manage_quote() {

	$getUserDataCheck = $this->db->where('email', $this->input->post('email'));
	$getUserDataCheck = $this->db->get('tbl_user')->row();

	if (empty($getUserDataCheck)) {

			$destination_start_date = null;
			$destination_end_date   = null;


			if(!empty($this->input->post('destination_hospital_id')))
			{
				$getSingleHospital 		= $this->common_model->getSingleHospital($this->input->post('destination_hospital_id'));
				$destination_start_date = $getSingleHospital->start_date;
				$destination_end_date   = $getSingleHospital->end_date;			
				$country = $getSingleHospital->country;
			}


			$is_file = 0;
			$get_record = $this->db->order_by('request_no', 'desc');
			$get_record = $this->db->limit('1');
			$get_record = $this->db->get('tbl_quote_request')->row();

			if (!empty($get_record)) {
				$request_no = $get_record->request_no + 1;
			} else {
				$request_no = '1000101';
			}

			$email = $this->input->post('email');

			if (!empty($_FILES["quote_image"]["name"])) {
				$folder = "upload_dir/quote_image/";
				$orig_name = date('ymdhisHi') . $_FILES["quote_image"]["name"];
				move_uploaded_file($_FILES["quote_image"]["tmp_name"], $folder . $orig_name);
				$client_name = '';
				$is_file = 1;
			} else {
				$orig_name = '';
				$client_name = '';
			}

			if (!empty($_FILES['quote_image_two']['name'])) {
				$orig_name_two = date('YmdHisis') . $_FILES["quote_image_two"]["name"];
				$path = $folder . $orig_name_two;
				move_uploaded_file($_FILES["quote_image_two"]["tmp_name"], $path);
				$client_name_two = '';
				$is_file = 1;
			} else {
				$orig_name_two = '';
				$client_name_two = '';
			}

			$check_email = $this->common_model->checkEmailRegister($email);
			if(!empty($check_email)) {
				$company_type = 'DS';
			}
			else {
				$company_type = 'NR';
			}




			$quote_data = array(
				'request_no' 		=> $request_no,
				'first_name' 		=> $this->input->post('first_name'),
				'last_name' 		=> $this->input->post('last_name'),
				'full_name' 		=> !empty($this->input->post('first_name')) ? $this->input->post('first_name') : '',
				'email' 			=> $email,
				'phone_no' 			=> $this->input->post('phone_no'),
				'age' 				=> $this->input->post('age'),
				'gender' 			=> $this->input->post('gender'),
				'country' 			=> $this->input->post('country'),
				'street' 			=> $this->input->post('street'),
				'city' 				=> $this->input->post('city'),
				'state' 			=> $this->input->post('state'),
				'zipcode' 			=> $this->input->post('zipcode'),
				'desired_country' 	=> !empty($country) ? $country : $this->input->post('desired_country'),
				'desired_country2' 	=> $this->input->post('desired_country2'),

				'desired_state' 	=> $this->input->post('desired_state'),
				'desired_state2' 	=> $this->input->post('desired_state2'),
				
				'high_cholesterol' 	=> $this->input->post('high_cholesterol'),
				'anemic' 			=> $this->input->post('anemic'),
				'diabetic' 			=> $this->input->post('diabetic'),
				'heart_issues' 		=> $this->input->post('heart_issues'),
				'allergic' 			=> $this->input->post('allergic'),
				'pregnant' 			=> $this->input->post('pregnant'),

				'quote_status' 		=> INCOMPLETE,

				'procedure_treatment' => $this->input->post('procedure_treatment'),

				'terms' 			=> $this->input->post('terms'),
				'added_by' 			=> $this->user_id,
				'treatment_detail' 	=> $this->input->post('treatment_detail'),

				'file_type_one' 	=> $this->input->post('file_type_one'),
				'file_type_two' 	=> $this->input->post('file_type_two'),

				'destination_hospital_id' 	=> !empty($this->input->post('destination_hospital_id')) ? $this->input->post('destination_hospital_id') : null,
			
				
				'destination_start_date' => $destination_start_date,
				'destination_end_date' 	 => $destination_end_date,

				'is_file' 		  => $is_file,

				'quote_image' 			  => $orig_name,
				'orignal_quote_image' 	  => $client_name,
				'quote_image_two' 		  => $orig_name_two,
				'orignal_quote_image_two' => $client_name_two,
				'company_type' 			  => $company_type,
				'created_on' 			  => date('Y-m-d H:i:s'),
			);

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

			$res = $this->common_model->insert_tbl_data('quote_request', $quote_data);

			$getUserDataCheck = $this->db->where('email', $this->input->post('email'));
			$getUserDataCheck = $this->db->get('tbl_user')->row();
			if (empty($getUserDataCheck)) {
				$this->session->set_flashdata('success_message', 'Thank you for your request. For privacy reasons, please continue to signup with same email.. <a style="color:#000" href="' . base_url() . 'signup?key=patients">continue</a>');
			} else {

				$data_again = array(
					'first_name' => $getUserDataCheck->first_name,
					'last_name' => $getUserDataCheck->last_name,
					'phone_no' => $getUserDataCheck->phone_no,
					'country' => $getUserDataCheck->country,
				);

				$update_quate_data = $this->db->where('id', $res);
				$update_quate_data = $this->db->update('tbl_quote_request', $data_again);

				$gender = $this->input->post('gender');

				$getUserData = $this->db->where('email', $email);
				$getUserData = $this->db->where('first_name', $this->input->post('first_name'));
				$getUserData = $this->db->where('last_name', $this->input->post('last_name'));
				$getUserData = $this->db->where('country', $this->input->post('country'));
				$getUserData = $this->db->where('phone_no', $this->input->post('phone_no'));
				$getUserData = $this->db->where('gender', $gender);
				$getUserData = $this->db->get('user')->num_rows();

				if (empty($getUserData)) {
					$update_quate = $this->db->where('id', $res);
					$update_quate = $this->db->set('quote_status', INCOMPLETE);
					$update_quate = $this->db->update('quote_request');
				}

				$this->session->set_flashdata('success_message', 'Email already exists. please use other email or login with ' . $email . ' to continue');
			}

			$this->common_model->send_hostpital_mail($res);

			$subject = 'Meddistant "Your Request Recieved"';
			$body = "<!DOCTYPE html>
						<html><body>
						<p>Hello " . $this->input->post('first_name') . ",</p>
						<p>Thank you for showing interest in our services from Meddistant. We are working on getting you competing treatment quotes from top quality hospitals and clinics.
	For privacy reasons and to follow the status of your quote request, please login or signup at <a href='https://meddistant.com/signup'>https://meddistant.com/signup.</a></p>
	<p>One of our team memebrs will contact you soon.</p>
	<br />

						<p>Truly,</p>
						</br>
						<p> Meddistant Care Team</p>
						<p>	USA & Canada +1888 9699959</p>
						<p> Worldwide  +1312 8899105 </p>
						<p> Turkey +90 (541)9473789 </p>
						<p> Or email us at care@meddistant.com</p></body></html>";

			$this->common_model->mail_mail($email, $subject, $body, "joez@meddistant.com");
		}
		else
		{
			$this->session->set_flashdata('success_message', 'Email already exists. please login with ' . $this->input->post('email') . ' to <a style="color:#000" href="' . base_url() . 'login">continue</a>');
		}

		redirect("quote-process");

	}

	public function email_subscription_no_work_possibasl() {

		$email = $this->input->post('email');
		if (!empty($email)) {
			$check_qry = $this->common_model->get_tbl_data('email_subscription', '*', array('email' => $email));
			if (count($check_qry) < 1) {
				$data = array('email' => $email, 'subscription_date' => date('Y-m-d H:i:s'));
				$this->common_model->insert_tbl_data('email_subscription', $data);
				$this->session->set_flashdata('success_message', 'You are successfully subscribed for Newsletter!');
				redirect('welcome');
			} else {
				$this->session->set_flashdata('error_message', 'This Email is already subscribed');
				redirect('welcome');
			}
		} else {
			$this->session->set_flashdata('error_message', 'Email required!');
			redirect('welcome');
		}
	}

	public function financing() {
		$data['getHeader'] = $this->common_model->getHeader('financing');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('welcome/financing');
		$this->load->view('common/footer');
	}

	public function getStateDirect() {
		$country_id = $this->input->post('country_id');
		$state_name = $this->input->post('state_name');

		$getState = $this->db->where('country_id', $country_id);
		$getState = $this->db->get('tbl_state')->result();

		$html = '';
		
		$html .= '<option value="">Select</option>';
		foreach ($getState as $value) {
			$selected = '';
			if ($state_name == $value->state_name) {
				$selected = 'selected';
			}
			$html .= '<option ' . $selected . ' value="' . $value->state_name . '">' . $value->state_name . '</option>';
		}
		
		
		$json['success'] = $html;
		echo json_encode($json);

	}


	public function getState() {
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


}
