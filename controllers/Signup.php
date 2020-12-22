<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
	public $user_id;

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}

	public function index() {

		isset($this->user_id) ? redirect('dashboard') : '';

		$data['getCountry'] = $this->common_model->getCountry();
		
        $key = $this->input->get('key');
		
		if ($key){
			$data['key'] = $key;
		}	
		
		$data['getHeader'] = $this->common_model->getHeader('signup');
		$this->load->view('common/header', $data);

		// $this->load->view('common/menubar');
		$data['authURL'] = $this->facebook->login_url();
		$this->load->view('login/signup', $data);
		$this->load->view('common/footer');
	}

	// emp_subscribe

	public function emp_subscribe()
	{
		if($this->input->get('user_id'))
		{
			$user_id = $this->input->get('user_id');
			$user = $this->common_model->get_single_user($user_id);
			if(!empty($user))
			{

				if(!empty($_POST))
				{
					$checking = 0;


					if($this->input->post('company_type_id') == 3)
					{
						$check_affiliate_partner_code = $this->db->where('patient_code',$this->input->post('affiliate_partner_code'));
						$check_affiliate_partner_code = $this->db->where('expire_date >=',date('Y-m-d'));
						$check_affiliate_partner_code = $this->db->get('tbl_affiliate_code')->num_rows();
						if($check_affiliate_partner_code == 0)
						{
							$checking = 1;							
						}
					}

					if(empty($checking))
					{
						$array = array(
							'company_type_id' 	=> $this->input->post('company_type_id'),
							'username' 			=> $this->input->post('username'),
							'address' 			=> $this->input->post('address'),
							'city' 				=> $this->input->post('city'),
							'state' 			=> !empty($this->input->post('state')) ? $this->input->post('state') : '',
							'zipcode' 			=> $this->input->post('zipcode'),
							'affiliate_partner_code' 	=> !empty($this->input->post('affiliate_partner_code')) ? trim($this->input->post('affiliate_partner_code')) : '',
							'employer_subscription_id' 	=> !empty($this->input->post('employer_subscription_id')) ? $this->input->post('employer_subscription_id') : '',
							'hos_p_o_number' 	=> !empty($this->input->post('hos_p_o_number')) ? $this->input->post('hos_p_o_number') : '',
							'plan_id' 			=> !empty($this->input->post('plan_id')) ? $this->input->post('plan_id') : '',
							'payment_option'  => !empty($this->input->post('payment_option')) ? $this->input->post('payment_option') : '',					
						);

						
						if(!empty($this->input->post('payment_option')))
						{	
							if($this->input->post('payment_option') == 2) 
							{
								$array['is_completed'] = 1;	
							}
						}

						if($this->input->post('company_type_id') == 3)
						{
							$array['is_completed'] = 1;	
						}

						$this->db->where('user_id',$user_id);
						$this->db->update('user',$array);
						redirect('signup/emp_subscribe_payment?user_id='.$user_id);

					}
					else
					{	
						$this->session->set_flashdata('error_message', 'Affiliate Partner Code Not Found.');
						redirect('signup/emp_subscribe?user_id='.$user_id);
					}

				}

				$data['user'] = $user;

				$data['get_usa_state'] = $this->common_model->get_usa_state();

			    $data['getHeader'] = $this->common_model->getHeader('subscribe');
			    $data['get_company_type'] = $this->common_model->get_company_type();
			    $data['get_employer_subscription'] = $this->common_model->get_employer_subscription();

				$this->load->view('common/header');		
				$this->load->view('user/emp_subscribe', $data);
				$this->load->view('common/footer');
			}
			else
			{
				redirect(base_url());		
			}
		}
		else
		{
			redirect(base_url());
		}
	}


	public function emp_subscribe_payment()
	{
		if($this->input->get('user_id'))
		{
			$user_id = $this->input->get('user_id');
			$user = $this->common_model->get_single_user_employer_subscription($user_id);
			if(!empty($user))
			{
				if($user->payment_option == '1' && $user->is_completed == '0')
				{
					$data['get_plan_single'] = $this->common_model->get_plan_single_employer_subscription($user->user_plan_id);
					$data['user'] 			 = $user;
				    $data['getHeader'] 		 = $this->common_model->getHeader('subscribe_payment');

					$this->load->view('common/header');		
					$this->load->view('user/emp_subscribe_payment', $data);
					$this->load->view('common/footer');
				}
				else
				{
					$data = array(
						'user_id' 	 => $user->user_id,
						'username' 	 => $user->username,
						'first_name' => $user->first_name,
						'email' 	 => $user->email,
						'phone_no' 	 => $user->phone_no,
						'user_type'  => $user->user_type,
						'active' 	 => $user->active,
						'picture' 	 => $user->picture,
						'created_on' => $user->created_on,
					);

				 	$this->session->set_userdata($data);
					redirect(base_url('dashboard'));
				}
			}
			else
			{
				redirect(base_url('signup/emp_subscribe?user_id='.$user_id));		
			}
		}
		else
		{
			redirect(base_url());
		}
	}


	public function emp_subscribe_payment_success()
	{
		$user_id 		= $this->input->post('user_id');
		$subscriptionID = $this->input->post('subscriptionID');

		$array = array(
			'hos_payment' => 1,
			'hos_subscription_id' => $subscriptionID,
			'is_completed' => 1,
		);


		$this->db->where('user_id',$user_id);
		$this->db->update('user',$array);


		$user = $this->common_model->get_single_user($user_id);

		$data = array(
			'user_id' 	 => $user->user_id,
			'username' 	 => $user->username,
			'first_name' => $user->first_name,
			'email' 	 => $user->email,
			'phone_no'   => $user->phone_no,
			'user_type'  => $user->user_type,
			'active'     => $user->active,
			'picture'    => $user->picture,
			'created_on' => $user->created_on,
		);

	 	$this->session->set_userdata($data);

		$json['success'] = 'Thank you! Your Payment Successfully done.';
		echo json_encode($json);
	}


	public function get_employer_subscription_type()
	{
		$id = $this->input->post('id');
	    $provider_type = $this->common_model->get_single_employer_subscription($id);


	    $setup_fees = !empty($provider_type->setup_fee) ? $provider_type->setup_fee : 0;

		$get_plan = $this->common_model->get_plan_employer_subscription($id);

		$html_plan .= '';

		$html_plan .= '<div class="col-md-12">
                              <div class="form-group">
                             <p style="margin-bottom: 10px;"><b>Please select a subscription plan that suits your best:</b></p>
                          </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">';
                    	  foreach ($get_plan as $value_plan) {
                         	 $html_plan .= '<label><input id="'.$value_plan->is_invoice.'" type="radio" required value="'.$value_plan->id.'" class="plan_id" name="plan_id"> '.$value_plan->plan_name.'</label>';  		
                           }
                            

          	     $html_plan .= '</div>
                        </div>
                        <div class="col-md-12">
                           <br />
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <p style="margin-bottom: 10px;"><b>Payment Options:</b></p>
                           </div>
                           <div class="form-group" id="getPaymentOption">
            					<label><input type="radio" value="1" required  name="payment_option"> By Credit Card</label>
                              	<label><input type="radio"  value="2" required name="payment_option"> Invoice Later </label>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <br />
                        </div>';
		
		
		$json['html_plan'] = $html_plan;
		$json['setup_fees'] = $setup_fees;
		
		echo json_encode($json);
	}

	// end emp_subscribe


	public function subscribe()
	{
		if($this->input->get('user_id'))
		{
			$user_id = $this->input->get('user_id');
			$user = $this->common_model->get_single_user($user_id);
			// if(!empty($user) && empty($user->hos_payment))
			if(!empty($user))
			{

				if(!empty($_POST))
				{

					$array = array(
						'hos_med_provider_type' => $this->input->post('hos_med_provider_type'),
						'username' 			=> $this->input->post('hos_health_provider_name'),
						'address' 			=> $this->input->post('hos_street_address'),
						'city' 				=> $this->input->post('hos_city'),
						'state' 			=> !empty($this->input->post('hos_state_province')) ? $this->input->post('hos_state_province') : '',
						'zipcode' 			=> $this->input->post('hos_postal_zip_code'),
						'hos_p_o_number' 	=> !empty($this->input->post('hos_p_o_number')) ? $this->input->post('hos_p_o_number') : '',
						'plan_id' 			=> !empty($this->input->post('plan_id')) ? $this->input->post('plan_id') : '',
						'payment_option' 	=> !empty($this->input->post('payment_option')) ? $this->input->post('payment_option') : '',					
					);

					if($user->country != 'USA')
					{	
						$array['is_completed'] = 1;
					}

					if(!empty($this->input->post('payment_option')))
					{	
						if($this->input->post('payment_option') == 2) 
						{
							$array['is_completed'] = 1;	
						}
					}

					$this->db->where('user_id',$user_id);
					$this->db->update('user',$array);
					redirect('signup/subscribe_payment?user_id='.$user_id);
				}


				$data['user'] = $user;

			    $data['getHeader'] = $this->common_model->getHeader('subscribe');


			    $data['get_med_provider_type'] = $this->common_model->get_med_provider_type();

			    


				$this->load->view('common/header');		
				$this->load->view('user/subscribe', $data);
				$this->load->view('common/footer');

			}
			else
			{
				redirect(base_url());		
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function subscribe_payment()
	{
		if($this->input->get('user_id'))
		{
			$user_id = $this->input->get('user_id');
			$user = $this->common_model->get_single_user_med_provider_type($user_id);
			// echo "<pre>";
			// print_r($user);
			// die;
			if(!empty($user))
			{

				if($user->country == 'USA' && $user->payment_option == '1')
				{
					$data['get_plan_single']  	    = $this->common_model->get_plan_single($user->user_plan_id);
					$data['user'] 					= $user;
				    $data['getHeader'] 				= $this->common_model->getHeader('subscribe_payment');
				    $data['get_med_provider_type']  = $this->common_model->get_med_provider_type();

					$this->load->view('common/header');		
					$this->load->view('user/subscribe_payment', $data);
					$this->load->view('common/footer');
				}
				else
				{
					$data = array(
						'user_id' 	 => $user->user_id,
						'username' 	 => $user->username,
						'first_name' => $user->first_name,
						'email' 	 => $user->email,
						'phone_no' 	 => $user->phone_no,
						'user_type'  => $user->user_type,
						'active' 	 => $user->active,
						'picture' 	 => $user->picture,
						'created_on' => $user->created_on,
					);

				 	$this->session->set_userdata($data);

					redirect(base_url('dashboard'));	
				}
				
			}
			else
			{
				redirect(base_url('signup/subscribe?user_id='.$user_id));		
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function get_health_provider_type()
	{
		$id = $this->input->post('id');
	    $provider_type = $this->common_model->get_single_med_provider_type($id);
	    $setup_fees = !empty($provider_type->setup_fee) ? $provider_type->setup_fee : 0;


		$hos_state_province = $this->input->post('hos_state_province');
		
		$type = '';
		if($id == 1)
		{
			$type  = 'hospitals';
		}
		else if($id == 2)
		{
			$type  = 'clinics';
		}
		else if($id == 3)
		{
			$type  = 'physicians';
		}

		$html = '';

		$html .= '<option value="">Select</option>';

		if(!empty($type))
		{
			 $get_usa_availability = $this->common_model->get_usa_availability($type);
			 foreach ($get_usa_availability as $key => $value) {
			 	$selected = '';
			 	if($hos_state_province == $value->state_name)
			 	{
		 			$selected = 'selected';
			 	}
				$html .= '<option '.$selected.' value="'.$value->state_name.'">'.$value->state_name.'</option>';			 	
			 }
		}

		$get_plan = $this->common_model->get_plan($id);

		$html_plan .= '';

		$html_plan .= '<div class="col-md-12">
                              <div class="form-group">
                             <p style="margin-bottom: 10px;"><b>Please select a subscription plan that suits your best:</b></p>
                          </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">';
                    	  foreach ($get_plan as $value_plan) {
                         	 $html_plan .= '<label><input id="'.$value_plan->is_invoice.'" type="radio" required value="'.$value_plan->id.'" class="plan_id" name="plan_id"> '.$value_plan->plan_name.'</label>';  		
                           }
                            

          	     $html_plan .= '</div>
                        </div>
                        <div class="col-md-12">
                           <br />
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <p style="margin-bottom: 10px;"><b>Payment Options:</b></p>
                           </div>
                           <div class="form-group" id="getPaymentOption">
            					<label><input type="radio" value="1" required  name="payment_option"> By Credit Card</label>
                              	<label><input type="radio"  value="2" required name="payment_option"> Invoice Later </label>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <br />
                        </div>';
		
		$json['success'] = $html;
		$json['html_plan'] = $html_plan;
		$json['setup_fees'] = $setup_fees;
		
		echo json_encode($json);
	}

	public function subscribe_payment_success()
	{
		$user_id 		= $this->input->post('user_id');
		$subscriptionID = $this->input->post('subscriptionID');

		$array = array(
			'hos_payment' => 1,
			'hos_subscription_id' => $subscriptionID,
			'is_completed' => 1,
		);


		$this->db->where('user_id',$user_id);
		$this->db->update('user',$array);


		$user = $this->common_model->get_single_user($user_id);

		$data = array(
			'user_id' => $user->user_id,
			'username' => $user->username,
			'first_name' => $user->first_name,
			'email' => $user->email,
			'phone_no' => $user->phone_no,
			'user_type' => $user->user_type,
			'active' => $user->active,
			'picture' => $user->picture,
			'created_on' => $user->created_on,
		);

	 	$this->session->set_userdata($data);

		$json['success'] = 'Thank you! Your Payment Successfully done.';
		echo json_encode($json);

	}

	public function getCountry() {
		$user_type = $this->input->post('user_type');
		$getCountry = $this->common_model->getCountry($user_type);

		$html = '';
		$html .= '<option value="">Select Country</option>';
		foreach ($getCountry as $value) {
			$html .= '<option value="' . $value->country_name . '">' . $value->country_name . '</option>';
		}

		$json['success'] = $html;
		echo json_encode($json);
	}

	public function oauth2callbackfacebook() {
		if ($this->facebook->is_authenticated()) {
			$fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
			$userData['oauth_provider'] = 'facebook';
			$userData['source'] = 'facebook';
			$userData['oauth_uid'] = !empty($fbUser['id']) ? $fbUser['id'] : '';
			$userData['username'] = !empty($fbUser['first_name']) ? $fbUser['first_name'] : '';
			$userData['first_name'] = !empty($fbUser['first_name']) ? $fbUser['first_name'] : '';
			$userData['last_name'] = !empty($fbUser['last_name']) ? $fbUser['last_name'] : '';
			$userData['email'] = !empty($fbUser['email']) ? $fbUser['email'] : '';
			$userData['gender'] = !empty($fbUser['gender']) ? $fbUser['gender'] : '';
			$userData['picture'] = !empty($fbUser['picture']['data']['url']) ? $fbUser['picture']['data']['url'] : '';
			$userData['link'] = !empty($fbUser['link']) ? $fbUser['link'] : '';
			$userData['created_on'] = date('Y-m-d H:i:s');
			// Insert or update user data
			$userID = $this->common_model->checkUser($userData);
			if ($userID != false) {
				$data = array(
					'user_id' => $userID,
					'username' => $userData['username'],
					'email' => $userData['email'],
					'phone_no' => '',
					'user_type' => 'customer',
					'active' => 1,
					'picture' => $userData['picture'],
					'created_on' => $userData['created_on'],
				);
				$this->session->set_userdata($data);
				redirect('dashboard');
			} else {
				redirect('Signup');
			}

		}
	}

	public function linkedin_callback() {

		$provider = new League\OAuth2\Client\Provider\LinkedIn([
			'clientId' => '81awm36u7gs0we',
			'clientSecret' => 'QhAkIQ6222d7Ic5c',
			'redirectUri' => 'http://localhost/consultancy/signup/linkedin_callback',
		]);

		$token = $provider->getAccessToken('authorization_code', [
			'code' => $_GET['code'],
		]);
		// We got an access token, let's now get the user's details
		$user = $provider->getResourceOwner($token);

		//echo '<pre>'; print_r($user->toArray()); echo '</pre>'; exit('Exit');

		// Use this to interact with an API on the users behalf
		echo $token->getToken();
	}

	public function twitter_callback() {

		$server = new League\OAuth1\Client\Server\Twitter(array(
			'identifier' => '9eQxjtaARL3TchcUOeLl29akK',
			'secret' => 'Tc09Or2s9uW31FuDWkXmXbwkoEW74cuxvEBKcBuXWXEZXjAjwn',
			'callback_uri' => "http://localhost/consultancy/signup/twitter_callback",
		));

		if (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])) {
			// Retrieve the temporary credentials we saved before
			$temporaryCredentials = unserialize($_SESSION['temporary_credentials']);

			// We will now retrieve token credentials from the server
			$tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $_GET['oauth_token'], $_GET['oauth_verifier']);

			unset($_SESSION['temporary_credentials']);
			$_SESSION['token_credentials'] = serialize($tokenCredentials);
			session_write_close();

			$user = $server->getUserDetails($tokenCredentials);

			echo '<pre>';
			print_r($user);
			echo '</pre>';exit('Exit');

		}

	}

	public function google_callback() {
		$this->google->setAccessToken();
		$userData = $this->google->getUserInfo();

		if (empty($userData['name'])) {
			$email_parts = explode("@", $userData['email']);
			$google_username = $email_parts[0];
		} else {
//            $google_username = preg_replace('/\s+/', ' ', $userData['name']);
			$google_username = $userData['name'];
		}
		// echo '<pre>'; print_r($userData); echo '</pre>'; exit('Exit');
		$password = mt_rand(10000000, 99999999);
		$result = $this->common_model->get_table_data('user', '*', array('email' => $userData['email'], 'user_type' => 'client'));
		if (count($result) < 1) {
			$insert_data = array(
				'username' => $google_username,
				'email' => $userData['email'],
				'password' => md5($password),
				'user_type' => 'client',
				'signup_method' => 'gmail',
				'gmail_id' => $userData['id'],
				'active' => '1',
				'created_on' => date('Y-m-d H:i:s'),
			);

			$insert_result = $this->common_model->insert_table('users', $insert_data);
			if (!empty($userData['email'])) {

				$this->smtp_email->send('support@mailresumes.com', 'Mail Resumes', $userData['email'], 'Welcome to Mail Resumes!', $this->email_temp->email_content('Welcome to Mail Resumes!', 'Your mail resumes account is now active. You can learn more about our services at <a href="https://mailresumes.com/welcome/services" style="color: #0c7cd5">mailresumes.com</a>. You can also click on the "Start the Process" tab here [<a href="https://mailresumes.com/job_criteria" style="color: #0c7cd5">Start the Process tab</a>] to begin your search for a new job today.', '', ''));

			}
			$new_result = $this->common_model->get_table_data('users', '*', array('user_id' => $insert_result));
			$session_data = array(
				'user_id' => $new_result[0]['user_id'],
				'username' => $new_result[0]['username'],
				'email' => $new_result[0]['email'],
				'user_type' => $new_result[0]['user_type'],
				'active' => $new_result[0]['active'],
				'signup_method' => 'gmail',
				'gmail_id' => $new_result[0]['gmail_id'],
				'created_on' => $new_result[0]['created_on'],
			);
			$this->session->set_userdata($session_data);
			$this->session->set_flashdata('success_message', 'Your account is created Successfully.');
			$this->activity_log->track_this('Registered and logged in with Gmail', 'login');
			$this->common_model->update_table('users', array('last_login' => time()), array('user_id' => $new_result[0]['user_id']));
			$this->notification->new_backend_notify('New Lead is Added - <a href="' . base_url() . 'admin/leads/lead_board/' . $insert_result . '" class="m-link"> ' . ucfirst($new_result[0]['username']) . ' </a>');
			if ($this->session->flashdata('sample_file')) {
				redirect($this->session->flashdata('sample_file'));
			} else {
				redirect('job_criteria');
			}

		} else {
			$session_data = array(
				'user_id' => $result[0]['user_id'],
				'username' => $result[0]['username'],
				'email' => $result[0]['email'],
				'user_type' => $result[0]['user_type'],
				'active' => $result[0]['active'],
				'signup_method' => 'gmail',
				'gmail_id' => $result[0]['gmail_id'],
				'created_on' => $result[0]['created_on'],
			);
			$this->session->set_userdata($session_data);
			$this->activity_log->track_this('Logged In using Gmail', 'login');
			$this->common_model->update_table('users', array('last_login' => time()), array('user_id' => $result[0]['user_id']));
			if ($this->session->flashdata('sample_file')) {
				redirect($this->session->flashdata('sample_file'));
			} else {
				redirect('job_criteria');
			}

		}
	}

	public function fb_callback() {
		if (!session_id()) {
			session_start();
		}
		$userProfile = $this->facebook->request('get', '/me?fields=id,name,picture,email,gender');
		if (empty($userProfile['name'])) {
			$email_parts = explode("@", $userProfile['email']);
			$fb_username = $email_parts[0];
		} else {
//            $fb_username = preg_replace('/\s+/', '_', $userProfile['name']);
			$fb_username = $userProfile['name'];
		}
		if (!isset($userProfile['error']) || !empty($userProfile['email'])) {
			$password = mt_rand(10000000, 99999999);
			$result = $this->common_model->get_table_data('users', '*', array('email' => $userProfile['email']));
			if (count($result) < 1) {
				$insert_data = array(
					'username' => $fb_username,
					'email' => $userProfile['email'],
					'password' => md5($password),
					'user_type' => 'client',
					'signup_method' => 'facebook',
					'fb_id' => $userProfile['id'],
					'Active' => '1',
					'created_on' => date('Y-m-d H:i:s'),
				);
				$insert_result = $this->common_model->insert_table('users', $insert_data);
				if (!empty($userProfile['email'])) {
					$this->smtp_email->send('support@mailresumes.com', 'Mail Resumes', $userProfile['email'], 'Welcome to Mail Resumes', $this->email_temp->email_content('Welcome to Mail Resumes', 'Your mail resumes account is now active. You can learn more about our services at <a href="https://mailresumes.com/welcome/services" style="color: #0c7cd5">mailresumes.com</a>. You can also click on the "Start the Process" tab here [<a href="https://mailresumes.com/job_criteria" style="color: #0c7cd5">Start the Process tab</a>] to begin your search for a new job today.', '', ''));
				}
				$new_result = $this->common_model->get_table_data('users', '*', array('user_id' => $insert_result));
				$session_data = array(
					'user_id' => $new_result[0]['user_id'],
					'username' => $new_result[0]['username'],
					'email' => $new_result[0]['email'],
					'user_type' => $new_result[0]['user_type'],
					'active' => $new_result[0]['active'],
					'signup_method' => 'gmail',
					'gmail_id' => $new_result[0]['gmail_id'],
					'created_on' => $new_result[0]['created_on'],
				);
				$this->session->set_userdata($session_data);
				$this->session->set_flashdata('success_message', 'Your account is created Successfully.');
				$this->activity_log->track_this('Registered and logged in with Facebook', 'login');
				$this->common_model->update_table('users', array('last_login' => time()), array('user_id' => $new_result[0]['user_id']));
				$this->notification->new_backend_notify('New Lead is Added - <a href="' . base_url() . 'admin/leads/lead_board/' . $insert_result . '" class="m-link"> ' . ucfirst($new_result[0]['username']) . ' </a>');
				if ($this->session->flashdata('sample_file')) {
					redirect($this->session->flashdata('sample_file'));
				} else {
					redirect('job_criteria');
				}

			} else {
				$session_data = array(
					'user_id' => $result[0]['user_id'],
					'username' => $result[0]['username'],
					'email' => $result[0]['email'],
					'user_type' => $result[0]['user_type'],
					'active' => $result[0]['active'],
					'signup_method' => 'gmail',
					'gmail_id' => $result[0]['gmail_id'],
					'created_on' => $result[0]['created_on'],
				);
				$this->session->set_userdata($session_data);
				$this->activity_log->track_this('Logged In using Facebook', 'login');
				$this->common_model->update_table('users', array('last_login' => time()), array('user_id' => $result[0]['user_id']));
				if ($this->session->flashdata('sample_file')) {
					redirect($this->session->flashdata('sample_file'));
				} else {
					redirect('job_criteria');
				}
			}
		} else {
			$this->session->set_flashdata('error_message', 'Unable to process, Please try again later!');
		}
	}

	public function getCompanyID() {
		$getRecord = $this->db->order_by('user_id', 'desc');
		$getRecord = $this->db->where('company_id !=', '');
		$getRecord = $this->db->get('tbl_user')->row();
		if (!empty($getRecord->company_id)) {
			$company_id = explode('-', $getRecord->company_id);
			$second_id = $company_id[1] + 1;
			return '1-' . $second_id;
		} else {
			return '1-10101';
		}

	}

	public function register() {

		if(trim($this->input->post('current_captcha')) != trim($this->input->post('captcha'))) {
			$this->session->set_flashdata('error_message', 'Invalid verification code.');
			redirect('signup');
		}
		else
		{

			$username = !empty($this->input->post('username')) ? $this->input->post('username') : '';
			$email = $this->input->post('email');
			$first_name = !empty($this->input->post('first_name')) ? $this->input->post('first_name') : '';
			$last_name = !empty($this->input->post('last_name')) ? $this->input->post('last_name') : '';
			$phone_no = $this->input->post('phone_no');
			$password2 = $this->input->post('password');
			$password = md5($this->input->post('password'));
			$country = $this->input->post('country');
			$user_type = $this->input->post('user_type');
			$company_id = '';
			if ($user_type == 'employer') {
				$company_id = $this->getCompanyID();
			}

			$captcha = $this->input->post('g-recaptcha-response');
			if ($user_type == 'customer') {
				if (!empty($email) && !empty($password) && !empty($phone_no)) {
					$where = "email='$email'";



					$result = $this->common_model->get_tbl_data('user', '*', $where);



					$patient_no = $this->common_model->getPatientNo();



					if (count($result) < 1) {

						$check_all_quote_nr = $this->common_model->check_all_quote_nr($email);

						$get_without_patient_quote = $this->common_model->get_without_patient_quote($email);

						foreach ($get_without_patient_quote as $patient) {
							$patient_no_q = $this->common_model->getPatientNoQuote();

							$update  = $this->db->where('id',$patient->id);
							$update  = $this->db->set('patient_no',$patient_no_q);
							$update  = $this->db->update('tbl_quote_request');
						}


						$update_quote_request = $this->db->where('quote_status','incomplete');
						$update_quote_request = $this->db->where('email',$email);
						$update_quote_request = $this->db->set('quote_status',PLEASEQUOTE);
						$update_quote_request = $this->db->update('tbl_quote_request');
						
						

						

						$data = array(
							'username'   => $username,
							'company_id' => $company_id,
							'email' 	 => $email,
							'first_name' => $first_name,
							'last_name'  => $last_name,
							'password'   => $password,
							'phone_no'   => $phone_no,
							'country'    => $country,
							'user_type'  => $user_type,
							'patient_no' => $patient_no,
							'Active'     => $bit,
							'approved'   => 1,
							'created_on' => date('Y-m-d H:i:s'),
						);

						$insert_id = $this->common_model->insert_tbl_data('user', $data);



						


						$subject = "Registered";
						$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$code = substr(str_shuffle($set), 0, 12);
						$str = "<h2>Thank you for Registering.</h2>
								<p>Your Account:</p>
								<p>Email: " . $email . "</p>
								<p>Password: " . $password2 . "</p>
								<p>Please click the link below to activate your account.</p>
								<h4><a href='" . base_url() . "signup/activate?id=" . $email . "&code=" . $code . "'>Activate My Account</a></h4>";

						// $this->common_model->mail_mail($email, $subject, $str, "joez@meddistant.com");

						$this->common_model->update_tbl_data('user', array('user_otp' => $code), array('user_id' => $insert_id));


						
						// $this->session->set_flashdata('success_message', 'Please check your email to login');

						$this->session->set_flashdata('success_message', 'You are successfully registered, please log in and submit a quote request:');

						redirect('login');	
						


					} else {
						$this->session->set_flashdata('error_message', 'Email Already Exist');
						redirect('signup');
					}
				} else {
					$this->session->set_flashdata('error_message', 'All fields are required');
					redirect('signup');
				}
			} else {
				if (!empty($username) && !empty($email) && !empty($password) && !empty($phone_no)) {
					$where = "email='$email'";
					$result = $this->common_model->get_tbl_data('user', '*', $where);
					if (count($result) < 1) {

						$approved = 0;

						if ($user_type == 'hospital' || $user_type == 'employer') {
							$approved = 1;
						}

						$data = array(
							'username' => $username,
							'approved' => 1,
							'company_id' => $company_id,
							'email' => $email,
							'first_name' => $first_name,
							'last_name' => $last_name,
							'password' => $password,
							'phone_no' => $phone_no,
							'country' => $country,
							'user_type' => $user_type,
							'Active' => 1,
							'created_on' => date('Y-m-d H:i:s'),
						);

						$insert_id = $this->common_model->insert_tbl_data('user', $data);
						$subject = 'Registered';
						$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$code = substr(str_shuffle($set), 0, 12);
						$str = "<h2>Thank you for Registering.</h2>
								<p>Your Account:</p>
								<p>Email: " . $email . "</p>
								<p>Password: " . $password2 . "</p>
								<p>Please click the link below to activate your account.</p>
								<h4><a href='" . base_url() . "signup/activate?id=" . $email . "&code=" . $code . "'>Activate My Account</a></h4>";

						// $this->common_model->mail_mail($email, $subject, $str, "joez@meddistant.com");

						$this->common_model->update_tbl_data('user', array('user_otp' => $code), array('user_id' => $insert_id));


						if ($user_type == 'hospital') {
							redirect('signup/subscribe?user_id='.$insert_id);
						}
						else if ($user_type == 'employer') {
							redirect('signup/emp_subscribe?user_id='.$insert_id);
						}
						else
						{
							// $this->session->set_flashdata('success_message', 'Please check your email to login');
							$this->session->set_flashdata('success_message', 'You are successfully registered, please log in and submit a quote request:');
							redirect('login');	
						}


						

					} else {
						$this->session->set_flashdata('error_message', 'Email Already Exist');
						redirect('signup');
					}
				} else {
					$this->session->set_flashdata('error_message', 'All fields are required');
					redirect('signup');
				}
			}
		}
	}

	
	public function activate() {
		$email = $this->input->get('id');
		$code = $this->input->get('code');
		$this->db->select("user_id");
		$this->db->from("tbl_user");
		$this->db->where(array('email' => $email, 'user_otp' => $code));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
		if ($prevCheck > 0) {
			$prevResult = $prevQuery->row_array();
			$this->common_model->update_tbl_data('user', array('approved' => 1), array('user_id' => $prevResult['user_id']));
			$this->session->set_flashdata('success_message', 'Your account is Verified Successfully.');
			redirect('login');
		} else {
			$this->session->set_flashdata('error_message', 'Otp Did Not Match');
			redirect('signup');
		}

	}
}
