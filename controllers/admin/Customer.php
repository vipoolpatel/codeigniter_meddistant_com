<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 300);
ini_set("display_errors", 0);

class Customer extends CI_Controller {

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
		is_admin_in();
		$data['customer_data'] = $this->db->query("SELECT * FROM tbl_user WHERE user_type = 'customer' ORDER BY created_on DESC")->result_array();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/customer/customer_list', $data);
		$this->load->view('admin/common/footer');
	}


	public function detail_file()
	{
		is_admin_in();
		$email = $this->input->get('email');
		$user_id = $this->input->get('user_id');

		

		$data['getMyFiles'] = $this->common_model->getMyFiles($email);
		$data['getMyFileUser'] = $this->common_model->getMyFileUser($user_id);
		
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('myfile/list', $data);
		$this->load->view('admin/common/footer');
	}


	public function edit($id) {
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$data['user_data'] = $this->common_model->get_tbl_data('user', '*', array('user_id' => $id), $row = 1);
		$this->load->view('admin/customer/manage_profile', $data);
		$this->load->view('admin/common/footer');
	}

	public function detail($id) {
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$data['user_data'] = $this->common_model->get_tbl_data('user', '*', array('user_id' => $id), $row = 1);
		$this->load->view('admin/customer/detail', $data);
		$this->load->view('admin/common/footer');
	}

	public function update_profile() {
		$picture = '';
		$file_element_name = 'picture';
		$file = $_FILES['picture']['name'];
		if (!empty($file)) {
			$config['upload_path'] = './uploads/customer/';
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
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'picture' => $picture,
			'address' => $this->input->post('address'),
		);
		$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $this->input->post('user_id')));

		if ($update_qry) {
			$this->session->set_flashdata('success_message', 'Profile Updated Successfully');
			redirect('admin/customer/');
		}

	}

	public function manage_customer() {

		//is_admin_in();

		if ($this->uri->segment(4) == 'del') {
			$this->common_model->dlt_tbl_data('user', array('user_id' => $this->uri->segment(5)));

			$this->session->set_flashdata('success_message', 'Customer Deleted Successfully! ');
			redirect('admin/customer/');
		}
		$is_new = $this->input->post('add');
		$is_edit = $this->input->post('edit');
		$edit_id = $this->input->post('edit_id');
		if (isset($is_new) OR isset($is_edit)) {
			$digits_needed = 6;

			$random_number = ''; // set up a blank string

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
				'company_address' => $this->input->post('company_address'),
				'company_country' => $this->input->post('company_country'),
				'company_street' => $this->input->post('company_street'),
				'company_apt' => $this->input->post('company_apt'),
				'company_city' => $this->input->post('company_city'),
				'company_state' => $this->input->post('company_state'),
				'company_zipcode' => $this->input->post('company_zipcode'),
				'company_tax_id' => $this->input->post('company_tax_id'),
				'picture' => $picture,
				'country' => $this->input->post('country'),
				'state' => $this->input->post('state'),
				'city' => $this->input->post('city'),
				'address' => $this->input->post('address'),
				'territory' => $this->input->post('territory'),
				'created_on' => date('Y-m-d H:i:s'),
			);

			if ($is_new) {
				$insert_id = $this->common_model->insert_tbl_data('user', $user_data);
				$this->session->set_flashdata('success_message', 'Agent Added Successfully! ');
				$subject = "Registered";
				$body = "<!DOCTYPE html>
				<html><body>
				<p>Full Name: " . $user_data['username'] . " " . $user_data['last_name'] . "</p>
				<p>Your Password: " . $random_number . "</p>
				<p>Site Link: <a href=" . base_url() . "admin/login" . ">Meddistant</a></p>";
				$body .= "<br/>
				</body></html>";
				$this->common_model->mail_mail($user_data['email'], $subject, $body, "joez@meddistant.com");
				@unlink($_FILES[$file_element_name]);
				redirect('admin/agent/');
			} else {

				$this->common_model->update_tbl_data('user', $user_data, array('user_id' => $edit_id));
				$this->session->set_flashdata('success_message', 'Updated Successfully! ');
				redirect('admin/agent/');
			}
		} else {

			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
			$this->load->view('admin/agent/manage_agent');
			$this->load->view('admin/common/footer');
		}
	}

	public function quote_list() {
		$data['quote_data'] = $this->db->query("SELECT tbl_quote_request.*, tbl_user.user_type FROM tbl_quote_request left outer join tbl_user on tbl_user.user_id = tbl_quote_request.added_by  WHERE added_by = '$this->user_id' OR assigned_agent = '$this->user_id' ORDER BY created_on DESC")->result_array();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/agent/quote_list', $data);
		$this->load->view('admin/common/footer');
	}

	public function manage_quote() {

		if ($this->uri->segment(4) == 'del') {
			$this->common_model->dlt_tbl_data('quote_request', array('id' => $this->uri->segment(5)));
			$this->session->set_flashdata('success_message', 'Quote Deleted Successfully! ');
			redirect('admin/agent/quote_list');
		}
		$is_new = $this->input->post('add');
		$is_edit = $this->input->post('edit');
		$edit_id = $this->input->post('edit_id');
		if (isset($is_new) OR isset($is_edit)) {

			$get_max_id = $this->db->query("SELECT max(id)as max_id FROM `tbl_quote_request`")->row_array();
			$request_no = 10100 . $get_max_id['max_id'];

			if ($this->session->userdata('user_type') === 'customer') {
				$email = $this->input->post('email');
			} else {
				$email = $this->input->post('quote_email');
			}

			$time = time();
			$config = array(
				'upload_path' => 'upload_dir/quote_image/',
				'allowed_types' => 'jpg|png|PNG|JPG|JPEG|jpeg|pdf|PDF|docx|doc',
				'max_size' => 2000,
				'max_width' => 0,
				'max_height' => 0,
				'file_name' => $time,
			);
			$this->load->library('upload', $config);
			if (!empty($_FILES['quote_image']['name']) && !$this->upload->do_upload('quote_image')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error_message', $error['error']);
				redirect('manage_doctors/');
			}
			$data = array('upload_data' => $this->upload->data());

			$quote_data = array(
				'request_no' => $request_no,
				'first_name' => $this->input->post('fname'),
				'last_name' => $this->input->post('lname'),
				'full_name' => $this->input->post('full_name'),
				'email' => $email,
				'phone_no' => $this->input->post('phone_no'),
				'age' => $this->input->post('age'),
				'gender' => $this->input->post('gender'),
				'country' => $this->input->post('country'),
				'street' => $this->input->post('street'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'zipcode' => $this->input->post('zipcode'),
				'desired_country' => $this->input->post('desired_country'),
				'high_cholesterol' => $this->input->post('high_cholesterol'),
				'anemic' => $this->input->post('anemic'),
				'diabetic' => $this->input->post('diabetic'),
				'heart_issues' => $this->input->post('heart_issues'),
				'allergic' => $this->input->post('allergic'),
				'allergic_desc' => $this->input->post('allergic_desc'),
				'pregnant' => $this->input->post('pregnant'),
				'procedure_treatment' => $this->input->post('procedure_treatment'),
				'added_by' => $this->user_id,

				'quote_image' => $data['upload_data']['orig_name'],
				'orignal_quote_image' => $data['upload_data']['client_name'],

				'created_on' => date('Y-m-d H:i:s'),
			);

			$password_txt = mt_rand(100000, 999999);
			$password = md5($password_txt);

			$fname = $this->input->post('fname');
			if (empty($fname)) {
				$username = $this->input->post('full_name');
			} else {
				$username = $this->input->post('fname');
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

				$insert_id = $this->common_model->insert_tbl_data('quote_request', $quote_data);
				$this->session->set_flashdata('success_message', 'Quote Request Added Successfully!');

				$post_email = $email;
				$where = "email='$post_email'";
				$result = $this->common_model->get_tbl_data('user', '*', $where);
				if (count($result) < 1) {
					$this->common_model->insert_tbl_data('user', $user_data);
					$this->session->set_flashdata('success_message', 'Account is also created successfully, here is a password to login with the email: ' . $password_txt);
				}

				if ($this->session->userdata('user_type') === 'customer') {
					redirect('customer_quotes');
				} else if ($this->session->userdata('user_type') === 'agent') {
					redirect('admin/agent/quote_list');
				} else {
					redirect('admin/manage_quotes');
				}

			} else {

				$this->common_model->update_tbl_data('quote_request', $quote_data, array('id' => $edit_id));

				$this->session->set_flashdata('success_message', 'Quote Request Added Successfully!');

				$post_email = $email;
				$where = "email='$post_email'";
				$result = $this->common_model->get_tbl_data('user', '*', $where);
				if (count($result) < 1) {
					$this->common_model->insert_tbl_data('user', $user_data);
					$this->session->set_flashdata('success_message', 'Quotation submitted! <br> Your Account is created successfully, You can now login with your email and this password ' . $password_txt);
				}

				if ($this->session->userdata('user_type') === 'customer') {
					$this->session->set_userdata($user_data);
					redirect('login/');
				} else if ($this->session->userdata('user_type') === 'agent') {
					redirect('admin/agent/quote_list');
				} else {
					redirect('admin/manage_quotes');
				}
			}
		} else {

			if ($this->session->userdata('user_type') === 'customer') {
				$this->load->view('common/user_backend_header');
				$this->load->view('common/user_backend_menubar');
			} else {
				$this->load->view('admin/common/header');
				$this->load->view('admin/common/menubar');
			}

			$this->load->view('admin/agent/manage_quote');
			$this->load->view('admin/common/footer');
		}
	}

	function generateRandomString($alpha = TRUE, $nums = TRUE, $usetime = FALSE, $string = '', $length = 120) {

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

	public function company() {

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
		if (isset($is_new) OR isset($is_edit)) {

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
			if (!empty($company) AND $company == 'edit') {
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

	public function get_sub_properties($property_id) {

		$qry = $this->common_model->get_tbl_data('sub_property_type', '*', array('id_property_type' => $property_id));

		return $qry;
	}

	public function join_network_request() {

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

	public function review_profile() {

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

	public function profile_review_status() {

		;
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

	public function manage_city() {

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

	public function change_status() {
		$id = $this->input->post('id');
		$active = $this->input->post('active');
		$this->common_model->update_tbl_data('user', array('active' => $active), array('user_id' => $id));
		echo 'Status Change Successfully!';

	}

	public function get_city() {

		$state_id = $this->input->post('state_id');
		$city_data = $this->common_model->get_tbl_data('city', '*', array('id_state' => $state_id), 'city ASC', '', 'city');
		$new_arr = array();
		foreach ($city_data as $data) {

			echo '<option value="' . $data['city_id'] . '">' . $data['city'] . ' </option>';
		}
	}

	public function get_city_detail() {

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

	public function get_zipcodes_json() {

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

	public function manage_account() {

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

	public function account_detail() {

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

	public function manage_leads() {

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

	public function lead_notify() {

		is_user_in();
		$this->load->view('admin/common/header');
		$data['company_data'] = $manager_company = $this->db->query("SELECT * FROM tbl_company LEFT JOIN tbl_user ON tbl_company.id_manager = tbl_user.user_id ORDER BY tbl_company.created_on DESC")->result_array();
		$this->load->view('admin/leads/lead_notify', $data);
		$this->load->view('admin/common/footer');
	}

	public function acc_renewal() {

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

	public function cancel_subscription($user_id) {

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

	public function update_zipcode_price() {

		$zipcode_id = $this->input->post('zipcode_id');
		$price = $this->input->post('price');
		$this->common_model->update_table('manager_zipcode', array('bid_price' => $price), array('zipcode_id' => $zipcode_id));
	}

	public function update_pwd($id) {

		$update_data = array(
			'password' => md5($this->input->post('password')),
		);

		$update_qry = $this->common_model->update_tbl_data('user', $update_data, array('user_id' => $id));

		if ($update_qry) {
			$this->session->set_flashdata('success_message', 'Password Updated Successfully');
			redirect('admin/customer/');
		}
	}

}
