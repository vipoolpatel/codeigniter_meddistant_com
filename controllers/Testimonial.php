<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Testimonial extends CI_Controller {
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

		if (!empty($_POST)) {

			$getTestimonial = $this->db->where('user_id', $this->user_id);
			$getTestimonial = $this->db->get('tbl_testimonial')->row();

			$array = array(
				'user_id' => $this->user_id,
				'description' => $this->input->post('description'),
				'agree' => !empty($this->input->post('agree')) ? $this->input->post('agree') : '',
				'rating' => $this->input->post('rating'),
				'created_date' => date('Y-m-d H:i:s'),
			);

			if (!empty($getTestimonial->id)) {
				$this->db->where('id', $getTestimonial->id);
				$this->db->update('tbl_testimonial', $array);
			} else {
				$this->db->insert('tbl_testimonial', $array);
			}

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

						$update_data = array(
							'picture' => $picture,
						);

						$update = $this->db->where('user_id', $this->user_id);
						$update = $this->db->update('tbl_user', $update_data);
					}
				}
			}

			$this->session->set_flashdata('success_message', 'Restimonial successfully saved!');
			redirect('testimonial');
		}

		$getTestimonial = $this->db->where('user_id', $this->user_id);
		$getTestimonial = $this->db->get('tbl_testimonial')->row();
		$data['getTestimonial'] = $getTestimonial;

		$getUser = $this->db->where('user_id', $this->user_id);
		$getUser = $this->db->get('tbl_user')->row();
		$data['user_data'] = $getUser;

		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');
		$this->load->view('testimonial/testimonial', $data);
		$this->load->view('common/user_backend_footer');

	}
}
