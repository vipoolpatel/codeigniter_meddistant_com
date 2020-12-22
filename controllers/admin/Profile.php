<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
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
		if ($this->session->userdata('user_type') == 'admin') {
			if (!empty($_POST)) {
				$array = array(
					'username' => $this->input->post('username'),
					'phone_no' => $this->input->post('phone_no'),

				);

				$this->db->where('user_id', $this->user_id);
				$this->db->update('tbl_user', $array);

				if (!empty($this->input->post('password'))) {

					$array_password = array(
						'password' => md5($this->input->post('password')),
					);

					$password = $this->db->where('user_id', $this->user_id);
					$password = $this->db->update('tbl_user', $array_password);
				}

				$this->session->set_flashdata('success_message', 'Profile Updated Successfully');
				redirect('admin/profile');
			}
		}


		$data['getRecordState']   = $this->common_model->getStateAgent_SEPARATOR($this->user_id);
		$data['getRecordCountry'] = $this->common_model->getCountryAgent_SEPARATOR($this->user_id);


		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$data['user_data'] = $this->common_model->get_tbl_data('user', '*', array('user_id' => $this->session->userdata('user_id')), $row = 1);

		if ($this->session->userdata('user_type') == 'admin') {
			$this->load->view('admin/profile/admin_profile', $data);
		} else if ($this->session->userdata('user_type') == 'agent') {
			$this->load->view('admin/profile/agent_profile', $data);
		} else {

			$this->load->view('admin/profile/manage_profile', $data);
		}

		$this->load->view('admin/common/footer');
	}

	public function update_profile() {

/*        $config =  array(
'upload_path'     => 'upload_dir/',
'allowed_types'   => "gif|jpg|png|PNG|JPG|JPEG|jpeg",
'max_size'        => 5000,
//'max_height'      => "1768",
//'max_width'       => "2048"
);*/

//        $this->load->library('upload', $config);

/*        if($_FILES['profile_logo']['name']) {

if (!$this->upload->do_upload('profile_logo')) {
$error = array('error' => $this->upload->display_errors());
$this->session->set_flashdata('error_message', $error['error']);
redirect('admin/profile/');

} else {

$filed = $this->upload->data();
$update_data = array(
'username' => $this->input->post('name'),
'email' => $this->input->post('email'),
'profileImg' => $filed["file_name"],
);

$this->session->set_userdata('profileImg', $filed["file_name"]);

}

} else {*/
		// $this->load->library('PhpMail');

		$email = $this->input->post('email');
		$chk_email = $this->db->query("SELECT user_id FROM tbl_user WHERE email = '$email' AND user_id != '$this->user_id'")->result_array();
		//print_r($this->user_id);exit;
		if ($chk_email) {
			//echo "email already exist";exit;
			$this->session->set_flashdata('error_message', 'This Email is already Exist');
			redirect('admin/profile/');
		} else {
			//echo "new email";exit;
			if ($this->session->userdata('user_type') == 'agent') {
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
							$this->load->library('phpmailer_lib');
							$picture = $rowData["file_name"];
						}
					}
				}
				$update_data = array(
					'first_name' => $this->input->post('username'),
					'last_name' => $this->input->post('last_name'),
					// 'email' => $this->input->post('email'),
					'phone_no' => $this->input->post('phone_no'),
					// 'pay_type' => $this->input->post('pay_type'),
					// 'pay_rate' => $this->input->post('pay_rate'),
					// 'agent_type' => $this->input->post('agent_type'),
					'gender' => $this->input->post('gender'),
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
					// 'zipcode' => $this->input->post('zipcode'),
					// 'territory' => $this->input->post('territory'),
				);
				$this->session->unset_userdata('picture');
				$session_data = array('picture' => $picture);
				$this->session->set_userdata($session_data);
				// $this->session->set_userdata('username',$this->input->post('name'));
				$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $this->session->userdata('user_id')));
			} else {
				$picture = '';
				$file_element_name = 'picture';
				$file = $_FILES['picture']['name'];
				if (!empty($file)) {
					$config['upload_path'] = './uploads/employer/';
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
				$token = NULL;
				//echo $token;exit;
				$chk_if_new_email = $this->db->query("SELECT user_id FROM tbl_user WHERE email = '$email' AND user_id = '$this->user_id'")->result_array();
				if (!$chk_if_new_email) {
					//echo "hi";exit;
					$timestamp = date('Y-m-d H:i:s');
					//echo $timestamp;exit;
					//echo "new email";exit;
					//echo $token;exit;
					$token = openssl_random_pseudo_bytes(16);
					$token = bin2hex($token);
					//echo $token;exit;
					$update_data['verify_email_token'] = $token;
					$update_data['verify_email_token_update_on'] = $timestamp;

					$subject = "Verify Admin Email ";
					$body = "<!DOCTYPE html>
        				<html><body>
        				<p>Dear Admin ,</p>
        				<p>You have new request to update your email Please click here and update <a href='https://meddistant.com/admin/profile/profile_verify_email?verify_token=" . $token . "&verify_email=" . $email . "'> Click Here </a></p>";
					$body .= "<br/>
        				</body></html>";
					$verify_email = $this->common_model->mail_mail('docs@gmail.com', $subject, $body, "joez@meddistant.com");
					// print_r($verify_email);exit;

				}
				$update_data['first_name'] = $this->input->post('first_name');
				$update_data['last_name'] = $this->input->post('last_name');
				$update_data['other_email'] = $this->input->post('other_email');
				$update_data['phone_no'] = $this->input->post('phone_no');
				$update_data['gender'] = $this->input->post('gender');
				$update_data['company_name'] = $this->input->post('company_name');
				$update_data['country'] = $this->input->post('country');
				$update_data['state'] = $this->input->post('state');
				$update_data['city'] = $this->input->post('city');
				$update_data['picture'] = $picture;
				$update_data['address'] = $this->input->post('address');
				$update_data['zipcode'] = $this->input->post('zipcode');

				$this->session->unset_userdata('picture');
				$session_data = array('picture' => $picture);
				$this->session->set_userdata($session_data);
				//$this->session->set_userdata('username',$this->input->post('name'));
				$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $this->session->userdata('user_id')));
			}
		}
		//}

		if ($update_qry) {
			$this->session->set_flashdata('success_message', 'Profile Updated Successfully');
			redirect('admin/profile/');
		}

	}
	public function update_pwd() {
		$update_data = array(
			'password' => md5($this->input->post('password')),
			'agent_password_changed' => 1,
		);
		$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $this->session->userdata('user_id')));

		if ($update_qry) {
			$this->session->unset_userdata('agent_password_changed');
			$session_data = array('agent_password_changed' => 1);
			$this->session->set_userdata($session_data);
			$this->session->set_flashdata('success_message', 'Password Updated Successfully');
			redirect('admin/profile/');
		}
	}
	public function profile_verify_email() {
		// print_r($_REQUEST);
		$verify_token = $_GET['verify_token'];
		$update_email = $_GET['verify_email'];
		//echo $update_email;

		$fetch_userid_sql = $this->db->query("SELECT user_id FROM tbl_user WHERE verify_email_token = '$verify_token'")->result_array();

		if (!empty($fetch_userid_sql[0])) {
			$timestamp = date('Y-m-d H:i:s');
			$update_data['verify_email_token'] = NULL;
			$update_data['email'] = $update_email;
			$update_data['verify_email_token_update_on'] = $timestamp;
			$update_email_sql_result = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $fetch_userid_sql[0]['user_id']));
			if ($update_email_sql_result) {
				$data['user_code'] = "1";
				$data['user_data'] = "Email Updated Successfully";
			} else {
				$data['user_code'] = "0";
				$data['user_data'] = "Error in updating the email";
			}
		} else {
			$data['user_code'] = "0";
			$data['user_data'] = "Link is Expired";
		}
		$this->load->view('admin/common/header');
		$this->load->view('admin/profile/profile_verify_email', $data);
		$this->load->view('admin/common/footer');

	}
}
