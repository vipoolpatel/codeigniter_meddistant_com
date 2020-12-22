<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		// $this->load->view('admin/common/header');
		$this->load->view('admin/login/login');
	}

	public function userLogin() {

		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		if (isset($email) && isset($password)) {

			$qry = $this->common_model->get_tbl_data('user', '*', array('email' => $email, 'password' => $password), $row = 1);

			/*echo "<pre>";
				print_r($qry);
			*/

			if ($qry) {
				if (!empty($qry['active'])) {

					if ($qry['user_type'] === 'admin' || $qry['user_type'] === 'agent') {
						$session_data = array('user_id' => $qry['user_id'], 'username' => $qry['username'], 'email' => $qry['email'], 'user_type' => $qry['user_type'], 'active' => $qry['active'], 'agent_password_changed' => $qry['agent_password_changed'], 'picture' => $qry['picture'], 'super_admin' => $qry['super_admin']);
						$this->session->set_userdata($session_data);

						redirect('admin/dashboard');
					} else {
						$this->session->set_flashdata('error', 'You are not authorized to login!');
						redirect('admin/login');
					}
				} else {
					$this->session->set_flashdata('error', 'You are not authorized to login!');
					redirect('admin/login');
				}

			} else {
				$this->session->set_flashdata('error', 'Invalid Email or Password');
				redirect('admin/login');
			}
		} else {
			$this->session->set_flashdata('error', 'Required Email & Password');
			redirect('admin/login');
		}
	}

}
