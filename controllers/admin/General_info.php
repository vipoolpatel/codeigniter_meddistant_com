<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_info extends CI_Controller {

	public $user_id;

	function __construct() {
		parent::__construct();
		// is_user_in();
		// $this->agent_id = $this->session->userdata('agent_id');

		require_once APPPATH . 'third_party/PHPExcel.php';
		$this->excel = new PHPExcel();
	}

	public function index() {

		is_admin_in();
		$this->load->view('admin/dashboard/dashboard');
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$this->load->view('admin/common/footer');
	}

	public function contact_inq() {

		is_admin_in();

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		$data['contact_inq_data'] = $this->common_model->getContact();

		$getAgent = $this->db->select('tbl_user.*');
		$getAgent = $this->db->from('tbl_user');
		$getAgent = $this->db->where('tbl_user.user_type', 'agent');
		$getAgent = $this->db->get()->result_array();
		$data['getAgent'] = $getAgent;

		$this->load->view('admin/general_info/contact_inq', $data);
		$this->load->view('admin/common/footer');
	}

	public function scheduled_calls() {

		is_admin_in();

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		// $data['scheduled_calls_data'] = $this->common_model->get_tbl_data('scheduled_calls', '*', '', '', 'created_on DESC');

		$data['scheduled_calls_data'] = $this->common_model->getScheduledCalls();

		$this->load->view('admin/general_info/scheduled_calls', $data);
		$this->load->view('admin/common/footer');
	}

	public function dlt_contact_inq() {
		$id = $this->uri->segment(4);

		$this->common_model->dlt_tbl_data('contact_us', array('id' => $id));

		$this->session->set_flashdata('success', 'Contact Inquiry Delete Successfully');
		redirect('admin/general_info/contact_inq');

	}

	public function newsletter() {

		is_admin_in();
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$data['subscription_data'] = $this->db->query('SELECT * FROM tbl_email_subscription WHERE active = 1')->result_array();
		$this->load->view('admin/general_info/newsletter', $data);
		$this->load->view('admin/common/footer');
	}

	public function delete_newsletter($subscription_id) {
		$this->db->where('subscription_id', $subscription_id);
		$this->db->delete('tbl_email_subscription');
		$this->session->set_flashdata('success', 'Email Subscription Deleted Successfully');
		redirect('admin/general_info/newsletter');
	}

	public function delete_scheduled_calls($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_scheduled_calls');
		$this->session->set_flashdata('success', 'Record Deleted Successfully.');
		redirect('admin/general_info/scheduled_calls');
	}

	public function assign_agent() {
		$agent_id = $this->input->post('agent_id');
		$id = $this->input->post('id');


		$updateData = $this->db->where('id',$id);
		$updateData = $this->db->set('agent',$agent_id);
		$updateData = $this->db->update('scheduled_calls');
		
		// $this->common_model->update_tbl_data('scheduled_calls', array('agent' => $agent_id), array('id' => $id));

		$subject = "Schedule Call";
		$body = "<!DOCTYPE html>
		<html><body>
		<p>A new Schedule call is assign you.</p>";
		$body .= "<br/>
		</body></html>";
		$this->common_model->mail_mail($this->input->post('email'), $subject, $body, "joez@meddistant.com");
		echo 'Agent Assigned Successfully!';

	}

	public function assign_agent_general() {
		$agent_id = $this->input->post('agent_id');
		$id = $this->input->post('id');

		$updateData = $this->db->where('id',$id);
		$updateData = $this->db->set('agent_id',$agent_id);
		$updateData = $this->db->update('tbl_contact_us');

		// $this->common_model->update_tbl_data('tbl_contact_us', array('agent_id' => $agent_id), array('id' => $id));
		echo 'Agent Successfully Assign!';

	}

	public function add_contact_us_inquiries() {
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		if (!empty($_POST)) {

			$agent_id = '';

			if ($this->session->userdata('user_type') == 'agent') {
				$agent_id = $this->session->userdata('user_id');
			}
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_contact_us.email]');
			if ($this->form_validation->run() == TRUE) {

				$array = array(
					'agent_id' => $agent_id,
					'first_name' => !empty($this->input->post('first_name')) ? $this->input->post('first_name') : '',
					'last_name' => !empty($this->input->post('last_name')) ? $this->input->post('last_name') : '',
					'full_name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
					'email' => !empty($this->input->post('email')) ? $this->input->post('email') : '',
					'phone' => !empty($this->input->post('phone')) ? $this->input->post('phone') : '',
					'subject' => !empty($this->input->post('subject')) ? $this->input->post('subject') : '',
					'message' => !empty($this->input->post('message')) ? $this->input->post('message') : '',
					'type' => 'Add',
					'contact_date' => date('Y-m-d H:i:s'),

				);

				$this->db->insert('tbl_contact_us', $array);
				$this->session->set_flashdata('success', 'Contact us Inquiries Add Successfully');
				redirect('admin/general_info/contact_inq');
			}
		}
		$this->load->view('admin/general_info/add_contact_us_inquiries');
		$this->load->view('admin/common/footer');

	}

	public function edit_contact_us_inquiries($id) {
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		if (!empty($_POST)) {
			$array = array(
				'first_name' => !empty($this->input->post('first_name')) ? $this->input->post('first_name') : '',
				'last_name' => !empty($this->input->post('last_name')) ? $this->input->post('last_name') : '',
				'email' => !empty($this->input->post('email')) ? $this->input->post('email') : '',
				'phone' => !empty($this->input->post('phone')) ? $this->input->post('phone') : '',
				'subject' => !empty($this->input->post('subject')) ? $this->input->post('subject') : '',
				'message' => !empty($this->input->post('message')) ? $this->input->post('message') : '',
			);

			$this->db->where('id', $id);
			$this->db->update('tbl_contact_us', $array);

			$this->session->set_flashdata('success', 'Contact us Inquiries Updated Successfully');
			redirect('admin/general_info/contact_inq');
		}

		$edit_row = $this->db->where('id', $id);
		$edit_row = $this->db->get('tbl_contact_us')->row();

		$data['edit_row'] = $edit_row;

		$this->load->view('admin/general_info/edit_contact_us_inquiries', $data);
		$this->load->view('admin/common/footer');
	}

	public function add_contact_us_inquiries_upload_excel() {
		//$this->load->library('form_validation');
		//$this->validate();
		$this->load->library('form_validation');

		if ($_FILES['result_file']['size'] > 0) {

			$path = $_FILES['result_file']['name'];
			$ext  = pathinfo($path, PATHINFO_EXTENSION);
			
			if($ext == 'csv')
			{
				$newfile = 'uploads/quiz/';
				$picturename = date('YmdHis') . $_FILES['result_file']['name'];

				move_uploaded_file($_FILES['result_file']['tmp_name'], $newfile . $picturename);

				$file_type = PHPExcel_IOFactory::identify($newfile . $picturename);

				$objReader = PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($newfile . $picturename);
				$sheet_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

				$agent_id = '';

				if ($this->session->userdata('user_type') == 'agent') {
					$agent_id = $this->session->userdata('user_id');
				}

				$j = 1;
				foreach ($sheet_data as $value) {
					if ($j != '1') {
						if (!empty($value['A']) && !empty($value['B'])) {

							$checking_email = $this->db->where('email', $value['B']);
							$checking_email = $this->db->get('tbl_contact_us')->num_rows();
							if ($checking_email == '0') {
								$data = array(
									'agent_id' => $agent_id,
									'first_name' => $value['A'],
									'email' => $value['B'],
									'phone' => !empty($value['C']) ? $value['C'] : '',
									'type' => 'Add',
									'contact_date' => date('Y-m-d H:i:s'),

								);
								$this->db->insert('tbl_contact_us', $data);
							}
						}
					}
					$j++;
				}

				$this->session->set_flashdata('success', 'Excel Upload Successfully');
				redirect('admin/general_info/contact_inq');
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please upload CSV file only.');
				redirect('admin/general_info/add_contact_us_inquiries_upload_excel');	
			}
		}

		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/general_info/add_contact_us_inquiries_upload_excel');
		$this->load->view('admin/common/footer');

	}

}
