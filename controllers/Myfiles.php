<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myfiles extends CI_Controller {
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


		$data['getMyFiles'] = $this->common_model->getMyFiles($this->session->userdata('email'));

		$data['getMyFileUser'] = $this->common_model->getMyFileUser($this->session->userdata('user_id'));
		

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('myfile/list', $data);
		$this->load->view('common/user_backend_footer');

	}

	public function add()
	{
		is_user_in();

		if (!empty($_FILES["document"]["name"])) {

			$document = date('YmdHis').$_FILES["document"]["name"];
	        $folder = "uploads/document/";
	        move_uploaded_file($_FILES["document"]["tmp_name"], $folder . $document);

			$array = array(
				'user_id' 	   => $this->user_id,
				'file_type_id' => $this->input->post('file_type_id'),
				'document' 	   => $document,
				'created_at'   => date('Y-m-d H:i:s'),
			);

			$this->db->insert('tbl_user_file_type', $array);

			$this->session->set_flashdata('success', 'My file successfully saved');
			redirect('myfiles');
		}

		$data['getFileType'] = $this->common_model->getFileType();

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('myfile/add', $data);
		$this->load->view('common/user_backend_footer');		
	}
}
