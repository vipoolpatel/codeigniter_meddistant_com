<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public $user_id;

	function __construct() {

		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

	}

	public function index() {
		$data['getHeader'] = $this->common_model->getHeader('login');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$data['authURL'] = $this->facebook->login_url();
		$this->load->view('login/login', $data);
		$this->load->view('common/footer');
	}

	public function login_file() {

		$this->session->set_flashdata('file_download_msg', 'Please Sign in below to download this Sample Document!');
		$doc_id = $this->uri->segment(3);
		$qry = $this->db->query("SELECT * FROM tbl_sample_docs WHERE doc_id = '$doc_id' LIMIT 1")->row();
		$sample_file = base_url() . 'upload_dir/sample_docs/' . $qry->file;
		$this->session->set_flashdata('sample_file', $sample_file);
		$data['gmail_url'] = $this->google->getLoginUrl();
		$data['fb_url'] = $this->facebook->login_url();
		$this->load->view('common/header');
		$this->load->view('common/sidebar');
		$this->load->view('login/login', $data);
		$this->load->view('common/footer');
	}

	public function userlogin() {

		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		if (!empty($email) && !empty($password)) {
			$where = "email='$email' AND password='$password' AND user_type != 'admin' AND user_type != 'agent' AND approved = 1";
			$result = $this->common_model->get_tbl_data('user', '*', $where, $row = 1);
			if ($result) {
				$where = "email='$email'";
				$result2 = $this->common_model->get_tbl_data('user', '*', $where, $row = 1);
				if ($result2) {
					if ($result['user_type'] == 'hospital') 
					{ 
						if($result['is_completed'] == 1)
						{
							$data = array(
								'user_id' => $result['user_id'],
								'username' => $result['username'],
								'first_name' => $result['first_name'],
								'email' => $result['email'],
								'phone_no' => $result['phone_no'],
								'user_type' => $result['user_type'],
								'active' => $result['active'],
								'picture' => $result['picture'],
								'created_on' => $result['created_on'],
							);
							$this->session->set_userdata($data);	
						}						
					}
					else if ($result['user_type'] == 'employer') 
					{ 
						if($result['is_completed'] == 1)
						{
							$data = array(
								'user_id' => $result['user_id'],
								'username' => $result['username'],
								'first_name' => $result['first_name'],
								'email' => $result['email'],
								'phone_no' => $result['phone_no'],
								'user_type' => $result['user_type'],
								'active' => $result['active'],
								'picture' => $result['picture'],
								'created_on' => $result['created_on'],
							);
							$this->session->set_userdata($data);	
						}						
					}
					else
					{
						$data = array(
							'user_id' => $result['user_id'],
							'username' => $result['username'],
							'first_name' => $result['first_name'],
							'email' => $result['email'],
							'phone_no' => $result['phone_no'],
							'user_type' => $result['user_type'],
							'active' => $result['active'],
							'picture' => $result['picture'],
							'created_on' => $result['created_on'],
						);
						$this->session->set_userdata($data);	
					}
					
					//$this->activity_log->track_this('Logged In', 'login');
					//$this->common_model->update_table('users', array('last_login' => time()), array('user_id' => $result['user_id']));

					if ($result['user_type'] === 'customer') {
						redirect('admin/agent/manage_quote');
					}
					elseif ($result['user_type'] === 'hospital')
				    { 
				    	if($result['is_completed'] == 1)
						{
							redirect('dashboard');	
						}
						else
						{
							redirect(base_url('signup/subscribe?user_id='.$result['user_id']));			
						}
					} 
					elseif ($result['user_type'] === 'employer')
				    { 
				    	if($result['is_completed'] == 1)
						{
							redirect('dashboard');	
						}
						else
						{
							redirect(base_url('signup/emp_subscribe?user_id='.$result['user_id']));			
						}
					} 
					else 
					{
						redirect('dashboard');		
					}

				} else {
					$this->session->set_flashdata('error_message', 'Please Varifiy Your User');
					redirect('login');
				}

			} else {
				$this->session->set_flashdata('error_message', 'Invalid Email or Password');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('error_message', 'Invalid Email or Password');
			redirect('login');
		}
	}

	public function recover_password() {

		$email = $this->input->post('email');
		if (isset($email)) {
			// echo "hello ";
			$check_email = $this->common_model->get_tbl_data('user', '*', array('email' => $email));
			if (count($check_email) >= 1) {
				$password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8 / strlen($x)))), 1, 8);
				$this->common_model->update_tbl_data('user', array('password' => md5($password)), array('email' => $email));
				$subject = 'Forgot Password';
				$str = "<p>Looks like you forgot your password,<br/> here is your new generated password: <b style='color: #ff2600'>'$password'</b> if you want to update this password please login:</p>";
				$this->common_model->mail_mail($email, $subject, $str, "joez@meddistant.com");
				$this->session->set_flashdata('success_message', 'Please check your email, it contain your new generated password');
				//$this->activity_log->track_this('Recovered Password', 'forgot password');
				redirect('login');
				// $email_body = "So, have you forgot your password? Don't worry at all." ."\n\n\n";
				// $to = "hamzarehman012@gmail.com, $email";
				// $email_subject = "Forgot Password";
				// $headers = "From: hamzarehmanofficial@gmail.com" . "\r\n";
				// $headers .= "Reply-To: hamzarehmanofficial@gmail.com" . "\r\n";
				// if (mail($to,$email_subject,$email_body,$headers)){
				//     echo "chli ja yaar ab to chli ja";
				// }
				//     $password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8 / strlen($x)))), 1, 8);
				//     $this->common_model->update_tbl_data('user', array('password' => md5($password)), array('email' => $email));

				//     $this->smtp_email->send('support@mailresumes.com', 'Mail Resumes', $email, '','Forgot Password', $this->email_temp->email_content('Forgot Password', 'Looks like you forgot your password, here is your new generated password: <b>' . $password . '</b> if you want to update this password please - <a href="https://mailresumes.com/dashboard" style="color: #0c7cd5">Login</a>', '', ''));

//                echo $this->smtp_email->send('support@mailresumes.com', 'Mail Resumes', $email, 'Forgot Password', $this->email_temp->email_content('Forgot Password', 'Looks like you forgot your password, here is your new generated password: <b style="color: #ff2600">' . $password . '</b> if you want to update this password please login', 'https://mailresumes.com/dashboard', 'Login'));

				//     $this->session->set_flashdata('success_message', 'Please check your email, it contain your new generated password');
				//     // $this->activity_log->track_this('Recovered Password', 'forgot password');
				//     redirect('login');
			} else {
				//echo "not find it";
				$this->session->set_flashdata('error_message', 'This Email is not exist');
				$data['getHeader'] = $this->common_model->getHeader('recover-password');
				$this->load->view('common/header', $data);

				// $this->load->view('common/user_backend_sidebar');
				$this->load->view('login/recover_password');
				$this->load->view('common/footer');
			}
		} else {
			$data['getHeader'] = $this->common_model->getHeader('recover-password');
			$this->load->view('common/header', $data);

			// $this->load->view('common/user_backend_sidebar');
			$this->load->view('login/recover_password');
			$this->load->view('common/footer');
		}
	}

	public function recover_username() {

		$email = $this->input->post('email');
		if (isset($email)) {
			$check_email = $this->common_model->get_tbl_data('user', '*', array('email' => $email));
			if (count($check_email) >= 1) {
				$username = $check_email[0]['username'];
				$this->smtp_email->send('support@mailresumes.com', 'Mail Resumes', $email, 'Forgot Username', $this->email_temp->email_content('Forgot Username', 'Looks like you forgot your Username, <br> Your Username is: ' . $username,
					'https://mailresumes.com/login', 'Login'));
				$this->session->set_flashdata('success_message', 'We have sent you an email containing your Username');
				$this->activity_log->track_this('Recovered Username', 'forgot username');
				redirect('login');
			} else {
				$this->session->set_flashdata('error_message', 'This Email is not exist');
				redirect('login/recover_username');
			}
		} else {
			$this->load->view('common/header');
			// $this->load->view('common/sidebar');
			$this->load->view('login/recover_username');
			$this->load->view('common/footer');
		}
	}
}
