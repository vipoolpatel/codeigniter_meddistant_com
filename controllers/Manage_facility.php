<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Manage_facility extends CI_Controller {
	public $user_id;

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}
	}

	public function index() {
		is_user_in();
		$user_id = $this->session->userdata('user_id');
		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		$data['facility_data'] = $this->common_model->get_tbl_data('facility', '*', array('id_user' => $this->user_id), '', 'created_on DESC');
		//print_r($data['facility_data']);exit;
		// $this->load->view('facility/facility_list', $data);
		$this->load->view('facility/facility_details', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function manage_facility() {
		if (!empty($_POST)) {

			$payment_types = implode(",", $this->input->post('payment_types'));
			$facility_data = array(
				'payment_types' => $payment_types,
				'lab_fee' => $this->input->post('lab_fee'),
			);

			$update = $this->db->where('user_id', $this->user_id);
			$update = $this->db->update('user', $facility_data);

			$this->db->query("DELETE FROM tbl_facility_procedure WHERE id_tbl_user = $this->user_id");

			$facility_procedure = $this->input->post('facility_procedure');

			foreach ($facility_procedure as $procedure) {
				if (!empty($procedure)) {
					$facility_procedure_data = array(
						'id_tbl_user' => $this->session->userdata('user_id'),
						'procedure_name' => $procedure,
						'created_on' => date('Y-m-d H:i:s'),
					);
					$this->common_model->insert_tbl_data('facility_procedure', $facility_procedure_data);
				}

			}


    			if (!empty($_FILES["medical_provider_picture"]["name"])) {
			           $medical_provider_picture = $_FILES["medical_provider_picture"]["name"];
			           $upload_image = $_FILES["medical_provider_picture"]["name"];
			           $folder = "assets/provider_picture/";
			           move_uploaded_file($_FILES["medical_provider_picture"]["tmp_name"], $folder . $medical_provider_picture);
			    } else {
			         $medical_provider_picture = $this->input->post('old_medical_provider_picture');
			    }


			$update_user_info = array(
				'about_us' => $this->input->post('about_us'),
				'medical_provider_picture' => $medical_provider_picture,
				// 'address' => $this->input->post('address'),
				// 'city' => $this->input->post('city'),
				// 'state' => $this->input->post('state'),
				// 'zipcode' => $this->input->post('zipcode'),
				// 'phone_no' => !empty($this->input->post('phone_no')) ? $this->input->post('phone_no') : '',
			);

			$update_user = $this->db->where('user_id',$this->session->userdata('user_id'));
			$update_user = $this->db->update('tbl_user',$update_user_info);


			$this->session->set_flashdata('success_message', 'Facility updated Successfully!');
			redirect('manage_facility/manage_facility');
		}

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		$user_id = $this->session->userdata('user_id');

		$getTreatment = $this->db->order_by('order_by_data', 'asc');
		$getTreatment = $this->db->get('tbl_treatment')->result();
		$data['getTreatment'] = $getTreatment;

		$user_history = $this->common_model->get_tbl_data('user', '*', array('user_id' => $this->user_id), $row = 1);

		$data['facility_data'] = $user_history;

		$data['get_usa_state'] = $this->common_model->get_usa_state();

		$facility_procedure = $this->db->where('id_tbl_user', $user_id);
		$facility_procedure = $this->db->get('facility_procedure')->result();
		$data['facility_procedure'] = $facility_procedure;

		$this->load->view('facility/manage_facility', $data);
		$this->load->view('common/user_backend_footer');

	}

	public function manage_doctors() {

		$is_new = $this->input->post('add');
		$is_edit = $this->input->post('edit');
		$edit_id = $this->input->post('edit_id');
		if (isset($is_new) OR isset($is_edit)) {

			$payment_types = implode(",", $this->input->post('payment_types'));
			$facility_data = array(
				'id_user' => $this->session->userdata('user_id'),
				'facility_name' => $this->input->post('facility_name'),
				'facility_desc' => $this->input->post('facility_desc'),
				'operation_years' => $this->input->post('operation_years'),
				'total_surgeons' => $this->input->post('total_surgeons'),
				'license_number' => $this->input->post('license_number'),
				'license_country' => $this->input->post('license_country'),
				'payment_types' => $payment_types,
				'lab_fee' => $this->input->post('lab_fee'),
				'created_on' => date('Y-m-d H:i:s'),
			);
			$facility_procedure = $this->input->post('facility_procedure');

			if ($is_new) {

				$insert_id = $this->common_model->insert_tbl_data('facility', $facility_data);

				foreach ($facility_procedure as $procedure) {
					$facility_procedure_data = array(
						'id_facility' => $insert_id,
						'id_tbl_user' => $this->session->userdata('user_id'),
						'procedure_name' => $procedure,
						'created_on' => date('Y-m-d H:i:s'),
					);
					$this->common_model->insert_tbl_data('facility_procedure', $facility_procedure_data);
				}

				$this->session->set_flashdata('success_message', 'Facility Added Successfully!');

				redirect('manage_facility/');

			} else {

				$this->common_model->update_tbl_data('facility', $facility_data, array('facility_id' => $edit_id));
				$this->db->query("DELETE FROM tbl_facility_procedure WHERE id_facility = $edit_id AND id_tbl_user = $this->user_id");

				foreach ($facility_procedure as $procedure) {
					$facility_procedure_data = array(
						'id_facility' => $edit_id,
						'id_tbl_user' => $this->session->userdata('user_id'),
						'procedure_name' => $procedure,
						'created_on' => date('Y-m-d H:i:s'),
					);
					$this->common_model->insert_tbl_data('facility_procedure', $facility_procedure_data);
				}

				$this->session->set_flashdata('success_message', 'Facility Updated Successfully!');

				redirect('manage_facility/');

			}
		} else {

			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
			$data['facility_data'] = $this->common_model->get_tbl_data('facility', '*', array('facility_id' => $edit_id), $row = 1, 'created_on DESC');
			$this->load->view('facility/manage_facility', $data);
			$this->load->view('common/user_backend_footer');
		}
	}
	public function add_hospitals() {

		if (!empty($_POST)) {
			if (!empty($_FILES["pic_area"]["name"])) {
				$pic_area = $_FILES["pic_area"]["name"];
				$array_name = explode(".", $pic_area);
				$ext = end($array_name);

				$pic_area = date('ymdhis') . '.' . $ext;
				$folder = "uploads/hospital/";
				move_uploaded_file($_FILES["pic_area"]["tmp_name"], $folder . $pic_area);
			} else {
				$pic_area = '';
			}

			$array = array(
				'user_id ' => $this->session->userdata('user_id'),
				'pic_area' => $pic_area,
				'hospital_name' => !empty($this->input->post('hospital_name')) ? $this->input->post('hospital_name') : '',
				'hospital_city' => !empty($this->input->post('hospital_city')) ? $this->input->post('hospital_city') : '',
				'hospital_jci' => !empty($this->input->post('hospital_jci')) ? $this->input->post('hospital_jci') : '',
				'status' => !empty($this->input->post('status')) ? $this->input->post('status') : '',
				'description' => !empty($this->input->post('description')) ? $this->input->post('description') : '',				
				'hospital_state' => !empty($this->input->post('hospital_state')) ? $this->input->post('hospital_state') : '',				
				'created_date' => date('Y-m-d H:i:s'),
			);

			$this->db->insert('tbl_hospital', $array);
			$this->session->set_flashdata('success_message', 'Hospital Add Successfully');
			redirect('manage_facility/hospitals');

		}

		$getUser = $this->db->select('tbl_user.*');
		$getUser = $this->db->from('tbl_user');
		$getUser = $this->db->where('tbl_user.user_id', $this->user_id);
		$getUser = $this->db->get()->row();
		$data['getUser'] = $getUser;

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		$this->load->view('hospitals/add_hospitals', $data);
		$this->load->view('common/user_backend_footer');
	}
	public function hospitals() {

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		$data['hospital_data'] = $this->common_model->getHospitalList();

		$this->load->view('hospitals/hospitals', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function edit_hospitals($id) {

		if (!empty($_POST)) {
			if (!empty($_FILES["pic_area"]["name"])) {
				$pic_area = $_FILES["pic_area"]["name"];
				$array_name = explode(".", $pic_area);
				$ext = end($array_name);

				$pic_area = date('ymdhis') . '.' . $ext;
				$folder = "uploads/hospital/";
				move_uploaded_file($_FILES["pic_area"]["tmp_name"], $folder . $pic_area);
			} else {
				$pic_area = $this->input->post('old_imagename');
			}

			$array = array(
				'user_id ' => $this->session->userdata('user_id'),
				'pic_area' => $pic_area,
				'hospital_name' => !empty($this->input->post('hospital_name')) ? $this->input->post('hospital_name') : '',
				'hospital_city' => !empty($this->input->post('hospital_city')) ? $this->input->post('hospital_city') : '',
				'hospital_jci' => !empty($this->input->post('hospital_jci')) ? $this->input->post('hospital_jci') : '',
				'status' => !empty($this->input->post('status')) ? $this->input->post('status') : '',
				'description' => !empty($this->input->post('description')) ? $this->input->post('description') : '',	
				'hospital_state' => !empty($this->input->post('hospital_state')) ? $this->input->post('hospital_state') : '',							

			);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_hospital', $array);

			$this->session->set_flashdata('success_message', 'Hospital Updated Successfully');
			redirect('manage_facility/hospitals');
		}
		$hospital_data = $this->db->where('id', $id);
		$hospital_data = $this->db->get('tbl_hospital')->row();

		$data['hospital_data'] = $hospital_data;

		$getUser = $this->db->select('tbl_user.*');
		$getUser = $this->db->from('tbl_user');
		$getUser = $this->db->where('tbl_user.user_id', $this->user_id);
		$getUser = $this->db->get()->row();
		$data['getUser'] = $getUser;

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('hospitals/edit_hospitals', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function delete_hospitals($hospitals_id) {
		$this->db->set('status', '1');
		$this->db->where('id', $hospitals_id);
		$this->db->update('tbl_hospital');
		$this->session->set_flashdata('success_message', 'Hospital Deleted Successfully');
		redirect('manage_facility/hospitals');
	}

}
