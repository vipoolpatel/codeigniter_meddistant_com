<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_model extends CI_Model
{
    
    public function get_single_user($user_id)
	{
		$user = $this->db->where('user_id',$user_id);
		$user = $this->db->get('user')->row();
		return $user;
	}



	public function get_employer_subscription()
	{
		$query = $this->db->get('tbl_employer_subscription')->result();
		return $query;
	}

	public function get_company_type()
	{
		$query = $this->db->get('tbl_company_type')->result();
		return $query;
	}

	public function get_single_employer_subscription($id)
	{
		$query = $this->db->where('id',$id);
		$query = $this->db->get('tbl_employer_subscription')->row();
		return $query;
	}

    public function get_plan_employer_subscription($id)
	{
		$get_plan = $this->db->where('employer_subscription_id',$id);
		$get_plan = $this->db->get('tbl_employer_subscription_plan')->result();
		return $get_plan;
	}

	public function get_single_user_employer_subscription($user_id)
	{
		$user = $this->db->select('user.*,user.plan_id as user_plan_id, tbl_employer_subscription.name, tbl_employer_subscription.setup_fee, tbl_company_type.company_type');
		$user = $this->db->join('tbl_employer_subscription','tbl_employer_subscription.id = user.employer_subscription_id', 'left');

		$user = $this->db->join('tbl_company_type','tbl_company_type.id = user.company_type_id', 'left');

		$user = $this->db->from('user');
		$user = $this->db->where('user.user_id', $user_id);
		$user = $this->db->get()->row();
		return $user;
	}

	public function get_plan_single_employer_subscription($id)
	{
		$get_plan = $this->db->where('id',$id);
		$get_plan = $this->db->get('tbl_employer_subscription_plan')->row();
		return $get_plan;	
	}





    public function get_plan_single($id)
	{
		$get_plan = $this->db->where('id',$id);
		$get_plan = $this->db->get('tbl_med_provider_type_plan')->row();
		return $get_plan;
	}


    public function get_plan($id)
	{
		$get_plan = $this->db->where('provider_type_id',$id);
		$get_plan = $this->db->get('tbl_med_provider_type_plan')->result();
		return $get_plan;
	}

	public function get_single_user_med_provider_type($user_id)
	{
		$user = $this->db->select('user.*,user.plan_id as user_plan_id,  med_provider_type.plan_id, med_provider_type.name, med_provider_type.text_name, med_provider_type.plan_id, med_provider_type.price, med_provider_type.setup_fee');
		$user = $this->db->join('med_provider_type','med_provider_type.id = user.hos_med_provider_type');
		$user = $this->db->from('user');
		$user = $this->db->where('user.user_id',$user_id);
		$user = $this->db->get()->row();
		return $user;
	}

	public function get_single_med_provider_type($id)
	{
		$record = $this->db->where('id',$id);
		$record = $this->db->get('med_provider_type')->row();
		return $record;
	}


	public function get_med_provider_type()
	{
		$record = $this->db->get('med_provider_type')->result();
		return $record;
	}

	public function get_usa_availability($type)
	{	
		$record = $this->db->where($type, 1);
		$record = $this->db->get('tbl_state')->result();
		return $record;
	}

	public function get_usa_state()
	{	
		$record = $this->db->get('tbl_state')->result();
		return $record;
	}

	public function clear_session()
	{
		$data = array(
			'quote_sent_id' => '',
			'schedule_treatment' => '',
			'accommodation' => '',
			'total_stay_day' => '',
			'hotel_accommodation' => '',
			'travel_accommodation' => '',
			'accommodation_promotion' => '',
			'prepayment_accommodation' => '',
			'companion' => '',
			'companion_name' => '',
			'total_checkout_price' => '',
			'remaining_payment' => '',
			'total_discount' => '',
			'coupon_code' => '',
			'discount_type' => '',
			'discount_amount_percent' => '',
			'facilitation_fee_cash' => '',
		);

		$this->session->unset_userdata($data);
	}

	public function get_tbl_data($tbl, $select, $where = NULL, $row = NULL, $order = NULL, 	$group_by = NULL, $limit = NULL)
	{
		$this->db->select($select);

		if ($where) {
			$this->db->where($where);
		}
		if ($order) {
			$this->db->order_by($order);
		}
		if ($group_by) {
			$this->db->group_by($group_by);
		}
		if ($limit) {
			$this->db->limit($limit);
		}
		$qry = $this->db->get($tbl);

		if ($row) {
			return $qry = $qry->row_array();
		}
		return $qry = $qry->result_array();
	}

	public function insert_tbl_data($tbl, $data)
	{

		$this->db->insert($tbl, $data);
		return $this->db->insert_id();
	}

	public function checkUser($userData = array())
	{
		if (!empty($userData)) {
			//check whether user data already exists in database with same oauth info
			$this->db->select("user_id");
			$this->db->from("tbl_user");
			$this->db->where(array('oauth_provider' => $userData['oauth_provider'], 'oauth_uid' => $userData['oauth_uid']));
			$prevQuery = $this->db->get();
			$prevCheck = $prevQuery->num_rows();

			if ($prevCheck > 0) {
				$prevResult = $prevQuery->row_array();

				//update user data
				unset($userData['first_name']);
				unset($userData['last_name']);
				unset($userData['picture']);
				unset($userData['email']);
				unset($userData['gender']);
				$update = $this->db->update("tbl_user", $userData, array('user_id' => $prevResult['user_id']));

				//get user ID
				$userID = $prevResult['user_id'];
			} else {
				//insert user data
				// $userData['created']  = date("Y-m-d H:i:s");
				// $userData['modified'] = date("Y-m-d H:i:s");
				$insert = $this->db->insert("tbl_user", $userData);

				//get user ID
				$userID = $this->db->insert_id();
			}
		}

		//return user ID
		return $userID ? $userID : FALSE;
	}

	public function update_tbl_data($tbl, $data, $where, $limit = NULL) {

		$this->db->where($where);
		$qry = $this->db->update($tbl, $data);

		if ($limit) {
			$this->db->limit($limit);
		}
		return $qry;

	}



	public function update_tbl_data_quote($tbl, $data, $quote_data2 = '', $where, $limit = NULL)
	{
		// echo '<pre>';
		// print_r($quote_data2);
		// echo '</pre>';
		// exit;
		
		$this->db->set($quote_data2);
		$this->db->where($where);
		$qry = $this->db->update($tbl, $quote_data2);
		
		

		if ($limit) {
			$this->db->limit($limit);
		}
		return $qry;
	}

	public function dlt_tbl_data($tbl, $where)
	{
		$this->db->where($where);
		$this->db->delete($tbl);
	}

	public function count_tbl_rows($tbl, $where = NULL)
	{
		$this->db->select("*");
		if ($where) {
			$this->db->where($where);
		}
		$qry = $this->db->get($tbl);
		return $qry->num_rows();
	}

	function mail_mail_agent($to, $subject, $body, $from = '', $attach = '', $user = 'joez@meddistant.com', $pass = 'Waysbar123$')
	{
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
		$this->email->from($from, "Meddistant");
		$this->email->to($to);
		$this->email->cc('info@meddistant.com');
		$this->email->subject($subject);
		$this->email->message($body);
		if (!empty($attach)) {
			$this->email->attach($attach);
		}

		$send = $this->email->send();
		//var_dump($send);exit;

		if ($send) {
			return 'Sent';
		} else {
			return 'Not Sent';
		}
	}

	function mail_mail($to, $subject, $body, $from = '', $user = 'joez@meddistant.com', $pass = 'Waysbar123$')
	{
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
		$this->email->from($from, "Meddistant");
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($body);
		$send = $this->email->send();
		//var_dump($send);exit;

		if ($send) {
			return 'Sent';
		} else {
			return 'Not Sent';
		}
	}

	function mail_mail_reply($to, $subject, $body, $from = '', $reply = '', $user = 'joez@meddistant.com', $pass = 'Waysbar123$')
	{
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
		$this->email->from($from, "Meddistant");
		$this->email->to($to);
		$this->email->reply_to($reply, "Meddistant");
		$this->email->subject($subject);
		$this->email->message($body);
		$send = $this->email->send();
		//var_dump($send);exit;

		if ($send) {
			return 'Sent';
		} else {
			return 'Not Sent';
		}
	}

	public function get_tbl_data_hospital_table($desired_country, $desired_country2)
	{
		$hospital = $this->db->select('tbl_user.*');
		$hospital = $this->db->from('tbl_user');
		$hospital = $this->db->where('tbl_user.user_type', 'hospital');
		$hospital = $this->db->where("(country='" . $desired_country . "' OR country='" . $desired_country2 . "')");
		$hospital = $this->db->get()->result_array();

		$array = array();
		foreach ($hospital as $value) {
			$array[] = $value['user_id'];
		}

		if (!empty($array)) {
			$get_hospital = $this->db->select('tbl_hospital.*');
			$get_hospital = $this->db->from('tbl_hospital');
			$get_hospital = $this->db->where_in('user_id', $array);
			$get_hospital = $this->db->get()->result_array();

			return $get_hospital;
		} else {
			return array();
		}
	}

	public function get_tbl_data_hospital($desired_country, $desired_country2)
	{
		$this->db->select('tbl_user.*');
		$this->db->from('tbl_user');
		$this->db->where('tbl_user.user_type', 'hospital');
		$this->db->where("(country='" . $desired_country . "' OR country='" . $desired_country2 . "')");
		return $this->db->get()->result_array();
	}

	public function get_tbl_data_customer($email)
	{
		// echo '<pre>';
		// print_r($email);
		// echo '</pre>';
		// exit;
		$this->db->select('tbl_quote_request.*,tbl_treatment.treatment_name as procedure_treatment');
		$this->db->from('tbl_quote_request');
		$this->db->join('tbl_treatment', 'tbl_treatment.id = tbl_quote_request.procedure_treatment');
		$this->db->where('tbl_quote_request.email', $email);
		$this->db->order_by('tbl_quote_request.created_on', 'desc');
		return $this->db->get()->result_array();
	}

	public function get_tbl_data_by_id($id)
	{
		$this->db->select('tbl_quote_request.*,tbl_treatment.treatment_name as procedure_treatment');
		$this->db->from('tbl_quote_request');
		$this->db->join('tbl_treatment', 'tbl_treatment.id = tbl_quote_request.procedure_treatment');
		$this->db->where('tbl_quote_request.id', $id);
		$this->db->order_by('tbl_quote_request.created_on', 'desc');
		return $this->db->get()->row_array();
	}

	public function update_procedure_treatment($user_id)
	{
		$getFacility = $this->db->where('id_user', $user_id);
		$getFacility = $this->db->get('tbl_facility')->row();

		if (!empty($getFacility->facility_id)) {
			$checking = $this->db->where('id_tbl_user', $user_id);
			$checking = $this->db->where('id_facility', $getFacility->facility_id);
			$checking = $this->db->where('procedure_name', '49');
			$checking = $this->db->get('tbl_facility_procedure')->num_rows();

			if ($checking == '0') {

				$arrayName = array(
					'id_tbl_user' => $user_id,
					'id_facility' => $getFacility->facility_id,
					'procedure_name' => '49',
					'created_on' => date('Y-m-d H:i:s'),
				);

				$this->db->insert('tbl_facility_procedure', $arrayName);
			}
		}
	}

	public function booked_email($quote_sent_id)
	{
		$this->db->select('tbl_user.first_name,tbl_user.email,tbl_quote_request.assigned_agent,tbl_quote_sent.type');
		$this->db->from('tbl_quote_sent');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_quote_sent.id_user');
		$this->db->join('tbl_quote_request', 'tbl_quote_request.id = tbl_quote_sent.quote_request_id');
		$this->db->where('tbl_quote_sent.quote_sent_id', $quote_sent_id);
		$quote_sent = $this->db->get()->row();

		if ($quote_sent->type = 'Service') {
			$subject = 'Meddistant "Booked Service"';
		} else {
			$subject = 'Meddistant "Booked"';
		}

		$body = "<!DOCTYPE html>
			<html><body>
			<p>Dear " . $quote_sent->first_name . ",</p>
			<p>Good news, a customer has booked your service per quote you recently sent them.Please login to your portal at <a href='" . base_url() . "/login'>meddistant.com/login</a>.</p>
			<p>Be sure to see booking details at dashboard and confirm with us an appointment date and time for the customer within the one week customer requested.</p>
			<p>A team member from Meddistant will be in touch with you to confirm final arrangements for happy customer experience.</p>
			<p>Thank you,</p>
			<p>Meddistant Care Team</p>
			</body></html>";

		if (!empty($quote_sent->assigned_agent)) {
			$getAgent = $this->db->where('user_id', $quote_sent->assigned_agent);
			$getAgent = $this->db->get('tbl_user')->row();
			$reply = !empty($getAgent->email) ? $getAgent->email : '';

			$this->mail_mail_reply($quote_sent->email, $subject, $body, "joez@meddistant.com", $reply);
		} else {
			$this->mail_mail_reply($quote_sent->email, $subject, $body, "joez@meddistant.com", "care@meddistant.com");
		}
	}

	public function send_destination_hospital_mail($insert_id, $hospital_id = "", $multiple = false)
	{
		if($multiple == true) {
                 
			$q1 = "SELECT * FROM tbl_quote_request WHERE id = $insert_id";
			$request = $this->db->query($q1)->row();
			if($request->desired_country == "USA") {
				 
				if ($request->desired_state){
					
					$usa_query = "SELECT * FROM tbl_user WHERE country = '$request->desired_country' AND state = '$request->desired_state' and user_type = 'hospital' AND approved = 1";
				$usa_hospital = $this->db->query($usa_query);
				
				    
				
				if($usa_hospital->num_rows() > 0) {
					// echo '<pre>';
					// print_r($usa_hospital->result());
					// echo '</pre>';
					// echo '<pre>';
					// print_r($this->db->last_query());
					// echo '</pre>';

					foreach ($usa_hospital->result() as $hospital) {
						$subject = 'Meddistant "Your Request Recieved"';
						$body = "<!DOCTYPE html>
						<html><body>
						<p>Dear " . $hospital->first_name . ",</p>
						<p>Good news, you received a request to quote from a customer. Please login to your portal at <a href='" . base_url() . "/login'>meddistant.com/login</a>.</p>
						<p>Be sure to offer competitive price and service as other hospitals may also bid on this hospital request. </p>
						<p>Thank you,</p>
						<p>Meddistant Care Team</p>
						</body></html>";

						$subject = 'Meddistant "Quote Request"';
						$this->mail_mail($hospital->email, $subject, $body, "joez@meddistant.com");
						
					}

				}
					
				}else{
					$usa_query = "SELECT * FROM tbl_user WHERE country = '$request->desired_country' AND  user_type = 'hospital' AND approved = 1";
				$usa_hospital = $this->db->query($usa_query);
				    
				
				if($usa_hospital->num_rows() > 0) {
					// echo '<pre>';
					// print_r($usa_hospital->result());
					// echo '</pre>';
					// echo '<pre>';
					// print_r($this->db->last_query());
					// echo '</pre>';

					foreach ($usa_hospital->result() as $hospital) {
						$subject = 'Meddistant "Your Request Recieved"';
						$body = "<!DOCTYPE html>
						<html><body>
						<p>Dear " . $hospital->first_name . ",</p>
						<p>Good news, you received a request to quote from a customer. Please login to your portal at <a href='" . base_url() . "/login'>meddistant.com/login</a>.</p>
						<p>Be sure to offer competitive price and service as other hospitals may also bid on this hospital request. </p>
						<p>Thank you,</p>
						<p>Meddistant Care Team</p>
						</body></html>";

						$subject = 'Meddistant "Quote Request"';
						$this->mail_mail($hospital->email, $subject, $body, "joez@meddistant.com");
						
					}

				}
					
				}	
				
				// exit;
			} else {
				// echo "other country";
				$other_country_query = "SELECT * FROM tbl_user WHERE country = '$request->desired_country' AND user_type = 'hospital' AND approved = 1";
				$other_country_hospital = $this->db->query($other_country_query);
				if($other_country_hospital->num_rows() > 0) {
					foreach($other_country_hospital->result() as $hospital) {
						
						$subject = 'Meddistant "Your Request Recieved"';
						$body = "<!DOCTYPE html>
						<html><body>
						<p>Dear " . $hospital->first_name . ",</p>
						<p>Good news, you received a request to quote from a customer. Please login to your portal at <a href='" . base_url() . "/login'>meddistant.com/login</a>.</p>
						<p>Be sure to offer competitive price and service as other hospitals may also bid on this hospital request. </p>
						<p>Thank you,</p>
						<p>Meddistant Care Team</p>
						</body></html>";

						$subject = 'Meddistant "Quote Request"';
						$this->mail_mail($hospital->email, $subject, $body, "joez@meddistant.com");
					}
				}
				// echo '<pre>';
				// print_r($other_country_hospital);
				// echo '</pre>';
				// echo '<pre>';
				// print_r($this->db->last_query());
				// echo '</pre>';
			}
			
			// exit;
		} else {
			// echo "trip";
			$this->db->select('*');
			$this->db->from('tbl_user');
			$this->db->where('user_id', $hospital_id);
			$hospital = $this->db->get()->row();
			
			$subject = 'Meddistant "Your Request Recieved"';
			$body = "<!DOCTYPE html>
						<html><body>
						<p>Dear " . $hospital->first_name . ",</p>
						<p>Good news, you received a request to quote from a customer. Please login to your portal at <a href='" . base_url() . "/login'>meddistant.com/login</a>.</p>
						<p>Be sure to offer competitive price and service as other hospitals may also bid on this hospital request. </p>
						<p>Thank you,</p>
						<p>Meddistant Care Team</p>
						</body></html>";
	
			$subject = 'Meddistant "Quote Request"';
			$this->mail_mail($hospital->email, $subject, $body, "joez@meddistant.com");
		}
	}
	
	public function send_hostpital_mail($insert_id)
	{

		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('approved', '1');
		$this->db->where('user_type', 'hospital');
		$hospital_country_arr = $this->db->get()->result();

		// echo '<pre>';
		// print_r($hospital_country_arr);
		// echo '</pre>';
		// exit;
		// print_r($this->db->last_query());
		// die;
		foreach ($hospital_country_arr as $value) {
			$hospital_country = $value->country;
			$update_on = $value->updated_on;

			$quote_requested_data = $this->db->query("SELECT *,tbl_quote_request.created_on,tbl_quote_request.id,tbl_treatment.treatment_name as procedure_treatment FROM tbl_quote_request INNER JOIN tbl_facility_procedure ON tbl_quote_request.procedure_treatment = tbl_facility_procedure.procedure_name INNER JOIN tbl_treatment ON tbl_treatment.id = tbl_quote_request.procedure_treatment WHERE tbl_facility_procedure.created_on != '' AND (tbl_quote_request.desired_country= '$hospital_country' OR tbl_quote_request.desired_country2= '$hospital_country' ) AND tbl_quote_request.created_on>='" . $update_on . "' AND tbl_quote_request.quote_status != 'incomplete' AND tbl_quote_request.id = '" . $insert_id . "' GROUP BY tbl_quote_request.request_no  ")->num_rows();

			// echo '<pre>';
			// print_r($quote_requested_data);
			// echo '</pre>';
			// exit;
			// echo "<br >******";
			// echo "<br >";
			// print_r($this->db->last_query());
			// echo "<br >";
			// print_r($quote_requested_data);

			// echo "<br >******";
			// echo "<br >";

			if ($quote_requested_data > 0) {

				// echo "<br >";
				// echo $value->country;
				// echo "<br >";
				// echo $value->updated_on;
				// echo "<br >";
				// echo $value->email;

				// echo "<br >******";
				// echo "<br >";

				$subject = 'Meddistant "Your Request Recieved"';
				$body = "<!DOCTYPE html>
					<html><body>
					<p>Dear " . $value->first_name . ",</p>
					<p>Good news, you received a request to quote from a customer. Please login to your portal at <a href='" . base_url() . "/login'>meddistant.com/login</a>.</p>
					<p>Be sure to offer competitive price and service as other hospitals may also bid on this hospital request. </p>
					<p>Thank you,</p>
					<p>Meddistant Care Team</p>
					</body></html>";

				$subject = 'Meddistant "Quote Request"';
				// $this->mail_mail($value->email, $subject, $body, "joez@meddistant.com");
			}
		}
		// exit;
	}

	public function quotes_requested_mail_customer($quote_sent_id)
	{

		$this->db->select('tbl_quote_request.email,tbl_quote_request.first_name,tbl_user.email as agent_email');
		$this->db->from('tbl_quote_sent');
		$this->db->join('tbl_quote_request', 'tbl_quote_request.id = tbl_quote_sent.quote_request_id');
		$this->db->join('tbl_user', 'tbl_user.user_id = tbl_quote_request.assigned_agent', 'left');
		$this->db->where('tbl_quote_sent.quote_sent_id', $quote_sent_id);
		$value = $this->db->get()->row();

		$emailreply = !empty($value->agent_email) ? $value->agent_email : 'care@meddistant.com';

		$subject = 'Meddistant "Quote Requested"';
		$body = '<!DOCTYPE html>
					<html><body>
					<p>Hello ' . $value->first_name . ',</p>
					<p>Goo news, you received a quote price regarding your request for treatment. For privacy reason, Please log in at <a href="' . base_url() . 'login">meddistant.com/login</a> to see details of quote at "Quotes received" tap. You may then schedule treatment online. </p>

					<p>If you have any questions please contact your care agent at ' . $emailreply . ' or Meddistant below.</p>
					<p>Truly,</p>
					<br>
					<p> Meddistant Care Team</p>
					<p>	USA & Canada +1888 9699959</p>
					<p> Worldwide  +1312 8899105 </p>
					<p> Turkey +90 (541)9473789 </p>
					<p> Or email us at care@meddistant.com</p>
					</body></html>';

		$subject = 'Meddistant "Quote Request"';
		$this->mail_mail($value->email, $subject, $body, "joez@meddistant.com");
	}

	public function getContact()
	{

		$this->db->select('tbl_contact_us.*');
		$this->db->from('tbl_contact_us');
		if ($this->session->userdata('user_type') == 'agent') {
			$this->db->where('agent_id', $this->session->userdata('user_id'));
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getScheduledCalls()
	{
		$this->db->select('tbl_scheduled_calls.*,tbl_treatment.treatment_name as procedure_treatment');
		$this->db->from('tbl_scheduled_calls');
		$this->db->join('tbl_treatment', 'tbl_treatment.id = tbl_scheduled_calls.procedure_treatment');
		if ($this->session->userdata('user_type') == 'agent') {
			$this->db->where('tbl_scheduled_calls.agent', $this->session->userdata('user_id'));
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	// Search Engine Optimization Start
	public function getSeo()
	{
		$this->db->select('tbl_seo.*');
		$this->db->from('tbl_seo');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getHeader($slug)
	{
		$this->db->select('*');
		$this->db->from('tbl_seo');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		return $query->row();
	}

	// Search Engine Optimization End

	public function getCountry($user_type = 'customer')
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		if ($user_type == 'hospital') {
			$this->db->where('is_hospital', 1);
		} else if ($user_type == 'employer') {
			$this->db->where('is_employer', 1);
		} else if ($user_type == 'quate') {
			$this->db->where('is_quote', 1);
		} else if ($user_type == 'agent') {
			$this->db->where('is_agent', 1);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function getAutoAssignAgent($email)
	{
		$getAutoAssignAgent = $this->db->select('tbl_contact_us.*');
		$getAutoAssignAgent = $this->db->from('tbl_contact_us');
		$getAutoAssignAgent = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_contact_us.agent_id');
		$getAutoAssignAgent = $this->db->where('tbl_contact_us.email', $email);
		$getAutoAssignAgent = $this->db->where('tbl_user.approved', 1);
		$getAutoAssignAgent = $this->db->get()->row();
		if (!empty($getAutoAssignAgent)) {
			return $getAutoAssignAgent->agent_id;
		} else {
			return '';
		}
	}


	public function getAutoAssignAgentCountry($country)
	{
		$getAutoAssignAgent = $this->db->select('tbl_user_country.*');
		$getAutoAssignAgent = $this->db->from('tbl_user_country');
		$getAutoAssignAgent = $this->db->join('tbl_country', 'tbl_country.id = tbl_user_country.country_id');
		$getAutoAssignAgent = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_user_country.user_id');
		$getAutoAssignAgent = $this->db->where('tbl_user.territory !=','all');
		$getAutoAssignAgent = $this->db->where('tbl_country.country_name', $country);
		$getAutoAssignAgent = $this->db->get()->row();
		if (!empty($getAutoAssignAgent)) {
			return $getAutoAssignAgent->user_id;
		} else {
			return '';
		}
	}

	public function getAutoAssignAgentState($state)
	{
		$getAutoAssignAgent = $this->db->select('tbl_user_state.*');
		$getAutoAssignAgent = $this->db->from('tbl_user_state');
		$getAutoAssignAgent = $this->db->join('tbl_state', 'tbl_state.id = tbl_user_state.state_id');
		$getAutoAssignAgent = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_user_state.user_id');
		$getAutoAssignAgent = $this->db->where('tbl_user.territory !=','all');
		$getAutoAssignAgent = $this->db->where('tbl_state.state_name', $state);
		$getAutoAssignAgent = $this->db->get()->row();
		if (!empty($getAutoAssignAgent)) {
			return $getAutoAssignAgent->user_id;
		} else {
			return '';
		}
	}


	



	public function getAutoAssignAgentSchedule($email)
	{
		$getAutoAssignAgent = $this->db->select('scheduled_calls.*');
		$getAutoAssignAgent = $this->db->from('scheduled_calls');
		$getAutoAssignAgent = $this->db->join('tbl_user', 'tbl_user.user_id = scheduled_calls.agent');
		$getAutoAssignAgent = $this->db->where('scheduled_calls.email', $email);
		$getAutoAssignAgent = $this->db->where('tbl_user.approved', 1);
		$getAutoAssignAgent = $this->db->get()->row();
		if (!empty($getAutoAssignAgent)) {
			return $getAutoAssignAgent->agent;
		} else {
			return '';
		}
	}

	public function getHospitalList()
	{
		$this->db->select('tbl_hospital.*');
		$this->db->from('tbl_hospital');
		$this->db->where('status', 0);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$query = $this->db->get();
		return $query->result_array();
	}

	function viewHospital($id)
	{
		$this->db->select('tbl_hospital.*');
		$this->db->from('tbl_hospital');
		$this->db->where('tbl_hospital.status', 0);
		$this->db->where('tbl_hospital.user_id', $id);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getFileType()
	{
		$query = $this->db->get('tbl_file_type');
		return $query->result();
	}

	public function getFileSingle($id)
	{
		$query = $this->db->where('id', $id);
		$query = $this->db->get('tbl_file_type');
		return $query->row();
	}



	public function getMyFiles($email)
	{
		$query = $this->db->where('email', $email);
		$query = $this->db->where('is_file', 1);
		$query = $this->db->get('tbl_quote_request');
		return $query->result();
	}


	public function getMyFilesCount($email, $user_id)
	{
		$query = $this->db->where('email', $email);
		$query = $this->db->where('is_file', 1);
		$query = $this->db->get('tbl_quote_request');
		$first = $query->num_rows();

		$second_query = $this->db->where('user_id', $user_id);
		$second_query = $this->db->get('tbl_user_file_type');
		$second = $second_query->num_rows();


		$total = $first + $second;
		return $total;
	}

	public function getMyFileUser($user_id)
	{
		$query = $this->db->where('user_id', $user_id);
		$query = $this->db->get('tbl_user_file_type');
		return $query->result();
	}



	public function getPatientNo()
	{
		$query = $this->db->where('patient_no !=', 'TBD');
		$query = $this->db->where('user_type', 'customer');
		$query = $this->db->order_by('user_id', 'desc');
		$query = $this->db->limit(1);
		$query = $this->db->get('tbl_user');
		$result =  $query->row();

		if (!empty($result)) {
			return $result->patient_no + 1;
		} else {
			return '10120001';
		}
	}


	public function getPatientNoQuote()
	{
		$query = $this->db->where('patient_no !=', 'TBD');
		$query = $this->db->order_by('id', 'desc');
		$query = $this->db->limit(1);
		$query = $this->db->get('tbl_quote_request');
		$result =  $query->row();

		if (!empty($result)) {
			return $result->patient_no + 1;
		} else {
			return '10120001';
		}
	}





	public function getDestinationHospital()
	{
		$query = $this->db->select('user_id,username, start_date, end_date, city, state, country');
		$query = $this->db->from('tbl_user');
		$query = $this->db->where('start_date !=', '');
		$query = $this->db->where('end_date !=', '');
		$query = $this->db->where('user_type', 'hospital');
		$query = $this->db->get();
		$result =  $query->result();
		return $result;
	}

	public function getDestinationTreatmentHospital($treatment_id)
	{
		$query = $this->db->select('tbl_user.user_id,tbl_user.username,tbl_user.start_date,tbl_user.end_date,tbl_user.city,tbl_user.state,tbl_user.country');
		$query = $this->db->from('tbl_user');
		$query = $this->db->join('tbl_facility_procedure','tbl_facility_procedure.id_tbl_user = tbl_user.user_id');
		$query = $this->db->where('tbl_facility_procedure.procedure_name', $treatment_id);
		$query = $this->db->where('tbl_user.start_date !=', '');
		$query = $this->db->where('tbl_user.end_date !=', '');
		$query = $this->db->where('tbl_user.user_type', 'hospital');
		$query = $this->db->group_by('tbl_user.user_id');
		$query = $this->db->get();
		$result =  $query->result();
		return $result;
	}

	public function getSingleHospital($id)
	{
		$query = $this->db->where('user_id', $id);
		$query = $this->db->get('tbl_user');
		return $query->row();
	}

	public function checkEmailRegister($email)
	{
		$query = $this->db->where('email', $email);
		$query = $this->db->get('tbl_user');
		return $query->num_rows();
	}

	public function check_all_quote_nr($email)
	{
		$query = $this->db->where('company_type', 'NR');
		$query = $this->db->where('email', $email);
		$query = $this->db->set('company_type', 'DS');
		$query = $this->db->update('tbl_quote_request');
	}


	public function get_without_patient_quote($email)
	{
		$query = $this->db->where('email', $email);
		$query = $this->db->set('patient_no', 'TBD');
		$query = $this->db->get('tbl_quote_request')->result();
		return  $query;
	}


	// plan start

	public function countPlan($id) {
		$this->db->select('tbl_med_provider_type_plan.*,tbl_med_provider_type.name');
		$this->db->from('tbl_med_provider_type_plan');
		$this->db->join('tbl_med_provider_type', 'tbl_med_provider_type.id = tbl_med_provider_type_plan.provider_type_id', 'left');
		$this->db->where('tbl_med_provider_type_plan.provider_type_id', $id);
		return $this->db->count_all_results();
		
	}

	public function getPlan($id, $limit = NULL, $offset = NULL) {
		$this->db->select('tbl_med_provider_type_plan.*,tbl_med_provider_type.name');
		$this->db->from('tbl_med_provider_type_plan');
		$this->db->join('tbl_med_provider_type', 'tbl_med_provider_type.id = tbl_med_provider_type_plan.provider_type_id', 'left');
		$this->db->where('tbl_med_provider_type_plan.provider_type_id', $id);
		$this->db->limit($limit, $offset);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getCountryAgent($id) {
		$this->db->select('tbl_user_country.*,tbl_country.country_name');
		$this->db->from('tbl_user_country');
		$this->db->join('tbl_country', 'tbl_country.id = tbl_user_country.country_id', 'left');
		$this->db->where('tbl_user_country.user_id', $id);
	
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();

	}


	public function getStateAgent($id) {
		$this->db->select('tbl_user_state.*,tbl_state.state_name');
		$this->db->from('tbl_user_state');
		$this->db->join('tbl_state', 'tbl_state.id = tbl_user_state.state_id', 'left');
		$this->db->where('tbl_user_state.user_id', $id);
	
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getStateAgent_SEPARATOR($id)
	{
		
		$this->db->select('tbl_user.*,GROUP_CONCAT(tbl_state.state_name SEPARATOR ",") as state_name');
        $this->db->from('tbl_user');
        $this->db->join('tbl_user_state', 'tbl_user_state.user_id = tbl_user.user_id','left');
        $this->db->join('tbl_state', 'tbl_state.id = tbl_user_state.state_id','left');

		$this->db->where('tbl_user.user_id', $id);
        $this->db->order_by('tbl_user.user_id','desc');
        $query = $this->db->get();
        return $query->result();
		
	}

	public function getCountryAgent_SEPARATOR($id)
	{
		$this->db->select('tbl_user.*,GROUP_CONCAT(tbl_country.country_name SEPARATOR ",") as country_name');
		$this->db->from('tbl_user');
		$this->db->join('tbl_user_country', 'tbl_user_country.user_id = tbl_user.user_id','left');
		$this->db->join('tbl_country', 'tbl_country.id = tbl_user_country.country_id','left');
		$this->db->where('tbl_user.user_id', $id);
		$this->db->order_by('tbl_user.user_id', 'desc');
		$query = $this->db->get();
        return $query->result();

	}


	function pdf_quote_request($id) {

		$this->db->select('*');
		$this->db->from('tbl_quote_request');
		// $this->db->join('', '. = .','left');
		$this->db->where('tbl_quote_request.id', $id);
		$query = $this->db->get();
		return $query->row();

	}

	function pdf_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		
		$this->db->where('tbl_user.user_id', $user_id);
		$query = $this->db->get();
		return $query->row();
	}


}
