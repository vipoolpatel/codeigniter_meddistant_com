<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Referrals extends CI_Controller {
	public $user_id;

	function __construct() {
		parent::__construct();
		is_user_in();
		$this->user_id = $this->session->userdata('user_id');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}

		require_once APPPATH . 'third_party/PHPExcel.php';
		$this->excel = new PHPExcel();
	}

	public function index() {
		$this->validate();
		$getRecord = $this->db->where('user_id', $this->user_id);
		$getRecord = $this->db->get('tbl_referrals')->result();
		$data['getRecord'] = $getRecord;

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('employer/referral/list', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function add() {
		$this->validate();

		$this->load->library('form_validation');
		if (!empty($_POST)) {
			$this->form_validation->set_rules('ref_email', 'Email', 'required|is_unique[tbl_referrals.ref_email]');
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'user_id' => $this->user_id,
					'ref_first_name' => $this->input->post('ref_first_name'),
					'ref_last_name' => $this->input->post('ref_last_name'),
					'ref_email' => $this->input->post('ref_email'),
					'ref_phone' => $this->input->post('ref_phone'),
					'ref_created_date' => date('Y-m-d H:i:s'),
				);

				$this->db->insert('tbl_referrals', $data);
				$this->session->set_flashdata('success_message', 'Referral Created Successfully');
				redirect('referrals');
			}
		}
		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('employer/referral/add');
		$this->load->view('common/user_backend_footer');
	}

	public function validate() {
		$this->db->where('user_id', $this->user_id);
		$validate = $this->db->get('tbl_user')->row();
		if (!empty($validate->address)
			&& !empty($validate->city)
			&& !empty($validate->state)
			&& !empty($validate->country)
			&& !empty($validate->zipcode)
			&& !empty($validate->company_type_id)
			&& !empty($validate->self_insured_employer)
			&& !empty($validate->employees_travel)
			&& !empty($validate->terms)
			&& !empty($validate->is_quote)
		) {
			return 1;
		} else {
			redirect('entrollment_data');
		}
	}

	public function upload_excel() {
		$this->validate();
		$this->load->library('form_validation');

		if ($_FILES['result_file']['size'] > 0) {

			$path = $_FILES['result_file']['name'];
			$ext  = pathinfo($path, PATHINFO_EXTENSION);

			if($ext == 'csv')
			{
				$newfile = 'uploads/referral/';
				$picturename = date('YmdHis') . $_FILES['result_file']['name'];

				move_uploaded_file($_FILES['result_file']['tmp_name'], $newfile . $picturename);

				$file_type = PHPExcel_IOFactory::identify($newfile . $picturename);

				$objReader = PHPExcel_IOFactory::createReader($file_type);
				$objPHPExcel = $objReader->load($newfile . $picturename);
				$sheet_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

				$j = 1;
				foreach ($sheet_data as $value) {
					if ($j != '1') {
						if (!empty($value['A']) && !empty($value['B']) && !empty($value['C'])) {

							$checking_email = $this->db->where('ref_email', $value['C']);
							$checking_email = $this->db->get('tbl_referrals')->num_rows();
							if ($checking_email == '0') {
								$data = array(
									'user_id' => $this->user_id,
									'ref_first_name' => $value['A'],
									'ref_last_name' => $value['B'],
									'ref_email' => $value['C'],
									'ref_phone' => !empty($value['D']) ? $value['D'] : '',
									'ref_created_date' => date('Y-m-d H:i:s'),
								);

								$this->db->insert('tbl_referrals', $data);
							}

						}
					}
					$j++;
				}

				$this->session->set_flashdata('success_message', 'Excel Upload Successfully');
				redirect('referrals');
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please upload CSV file only.');
				redirect('referrals/upload_excel');	
			}
		}

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('employer/referral/upload_excel');
		$this->load->view('common/user_backend_footer');
	}

	public function edit($id) {
		if (!empty($_POST)) {

			$array = array(
				'ref_first_name' => $this->input->post('ref_first_name'),
				'ref_last_name' => $this->input->post('ref_last_name'),
				'ref_phone' => $this->input->post('ref_phone'),
			);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_referrals', $array);

			$this->session->set_flashdata('success_message', 'Referral Updated Successfully');
			redirect('referrals');
		}

		$edit_row = $this->db->where('user_id', $this->user_id);
		$edit_row = $this->db->where('id', $id);
		$edit_row = $this->db->get('tbl_referrals')->row();

		$data['edit_row'] = $edit_row;

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('employer/referral/edit', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function view($id) {
		$this->db->select('*');
		$this->db->from('tbl_referrals');
		$this->db->where('tbl_referrals.id', $id);
		$this->db->where('user_id', $this->user_id);
		$data['upcomming'] = $this->db->get()->row();

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('employer/referral/view', $data);
		$this->load->view('common/user_backend_footer');

	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_referrals');

		$this->session->set_flashdata('success_message', 'Referral Deleted Successfully');
		redirect('referrals');
	}

}
