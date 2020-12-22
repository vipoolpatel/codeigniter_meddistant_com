<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destinations extends CI_Controller {

	public function index() {

		$this->load->view('common/header');
		$this->load->view('common/menubar');
		$this->load->view('destinations/turkey');
		$this->load->view('common/footer');
	}

	public function turkey() {

		$data['getHeader'] = $this->common_model->getHeader('turkey');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('destinations/turkey');
		$this->load->view('common/footer');
	}

	public function mexico() {

		$data['getHeader'] = $this->common_model->getHeader('mexico');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('destinations/mexico');
		$this->load->view('common/footer');
	}
	public function italy() {

		$data['getHeader'] = $this->common_model->getHeader('italy');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('destinations/italy');
		$this->load->view('common/footer');
	}

}
