<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_engine_optimization extends CI_Controller {

	public function index() {

		is_admin_in();
		$data['seo_data'] = $this->common_model->getSeo();
		$this->load->view('admin/search_engine_optimization/seo_list', $data);
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/common/footer');
	}

	public function add_seo() {
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		if (!empty($_POST)) {
			$array = array(
				'slug' => !empty($this->input->post('slug')) ? $this->input->post('slug') : '',
				'meta_title' => !empty($this->input->post('meta_title')) ? $this->input->post('meta_title') : '',
				'meta_description' => !empty($this->input->post('meta_description')) ? $this->input->post('meta_description') : '',
				'meta_keyword' => !empty($this->input->post('meta_keyword')) ? $this->input->post('meta_keyword') : '',
				'created_date' => date('Y-m-d H:i:s'),

			);

			$this->db->insert('tbl_seo', $array);
			$this->session->set_flashdata('success', 'Search Engine Optimization Add Successfully');
			redirect('admin/search_engine_optimization');
		}

		$this->load->view('admin/search_engine_optimization/add_seo');
		$this->load->view('admin/common/footer');

	}


	public function edit_seo($id) {
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');

		if (!empty($_POST)) {
			$array = array(
				'slug' => !empty($this->input->post('slug')) ? $this->input->post('slug') : '',
				'meta_title' => !empty($this->input->post('meta_title')) ? $this->input->post('meta_title') : '',
				'meta_description' => !empty($this->input->post('meta_description')) ? $this->input->post('meta_description') : '',
				'meta_keyword' => !empty($this->input->post('meta_keyword')) ? $this->input->post('meta_keyword') : '',
			);

			$this->db->where('id', $id);
			$this->db->update('tbl_seo', $array);

			$this->session->set_flashdata('success', 'Search Engine Optimization Updated Successfully');
			redirect('admin/search_engine_optimization');
		}

		$edit_row = $this->db->where('id', $id);
		$edit_row = $this->db->get('tbl_seo')->row();

		$data['edit_row'] = $edit_row;

		$this->load->view('admin/search_engine_optimization/edit_seo', $data);
		$this->load->view('admin/common/footer');
	}


	public function delete_dlt_seo($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_seo');
		$this->session->set_flashdata('success', 'Search Engine Optimization Deleted Successfully');
		redirect('admin/search_engine_optimization');
	}

}
?>