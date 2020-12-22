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
		$this->load->library('form_validation');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}

	}

	public function index() {
		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		$data['get_med_provider_type'] = $this->common_model->get_med_provider_type();

		
		$user_data = $this->common_model->get_tbl_data('user', '*', array('user_id' => $this->session->userdata('user_id')), $row = 1);

		$data['user_data'] = $user_data;

		$license_number = "";
		$this->db->select('license_number');
		$this->db->from('tbl_facility');
		$this->db->where('id_user', $this->session->userdata('user_id'));
		$license_number_arr = $this->db->get()->result();
		$license_number = $license_number_arr[0]->license_number;

		$country_id = '';
		if (strtoupper($user_data['country']) == 'USA') {
			$country_id = 1;
		}

		$getState = $this->db->where('country_id', $country_id);
		$getState = $this->db->get('tbl_state')->result();
		$data['getState'] = $getState;

		$data['user_data']['license_number'] = $license_number;
		$this->load->view('profile/manage_profile', $data);

		$this->load->view('common/user_backend_footer');

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

		// $email = $this->input->post('email');

		// $chk_email =   $this->db->query("SELECT * FROM tbl_user WHERE email = '$email' AND user_id != '$this->user_id'")->result_array();

		// if($chk_email) {
		// 	$this->session->set_flashdata('error_message', 'This Email is already Exist');
		// 	redirect('profile/');
		// } else {
		$picture = '';
		$file_element_name = 'picture';
		$file = $_FILES['picture']['name'];
		if (!empty($file)) {
			if ($this->session->userdata('user_type') == 'customer') {
				$config['upload_path'] = './uploads/customer/';
			} else {
				$config['upload_path'] = './uploads/hospital/';
			}
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
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone_no' => $this->input->post('phone_no'),
			'gender' => $this->input->post('gender'),
			'company_name' => $this->input->post('company_name'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'picture' => $picture,
			'address' => $this->input->post('address'),
			'zipcode' => $this->input->post('zipcode'),
		);
		$this->form_validation->set_rules('country', "Country", 'required');

		$this->session->set_userdata('username', $this->input->post('name'));
		$update_qry = false;
		if ($this->form_validation->run() == true) {
			$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $this->session->userdata('user_id')));

		}

		// }

		//}

		$this->session->unset_userdata('picture');
		$this->session->set_userdata(array('picture' => $picture));
		if ($update_qry && $this->form_validation->run() == true) {
			$this->session->set_flashdata('success_message', 'Profile Updated Successfully');
		}
		redirect('profile/');

	}

	public function update_pwd() {

		$update_data = array(
			'password' => md5($this->input->post('password')),
		);

		$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $this->session->userdata('user_id')));

		if ($update_qry) {
			$this->session->set_flashdata('success_message', 'Password Updated Successfully');
			redirect('profile/');
		}
	}

}
