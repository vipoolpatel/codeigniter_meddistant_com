<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function index() {
		$data['getHeader'] = $this->common_model->getHeader('about');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('about/general_info');
		$this->load->view('common/footer');
	}

	public function why_meddistant() {

		$data['getHeader'] = $this->common_model->getHeader('why-meddistant');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('about/why_meddistant');
		$this->load->view('common/footer');
	}

	public function general_info() {

		$data['getHeader'] = $this->common_model->getHeader('about');
		$this->load->view('common/header', $data);
		$this->load->view('common/menubar');
		$this->load->view('about/general_info');
		$this->load->view('common/footer');
	}

	public function our_mission() {

		$data['getHeader'] = $this->common_model->getHeader('our-mission');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('about/our_mission');
		$this->load->view('common/footer');
	}

	public function med_treatment() {

		$data['getHeader'] = $this->common_model->getHeader('med-treatment');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('about/med_treatment');
		$this->load->view('common/footer');
	}

	public function terms() {

		$data['getHeader'] = $this->common_model->getHeader('terms');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('about/terms');
		$this->load->view('common/footer');
	}
	public function hospital_terms() {

		$data['getHeader'] = $this->common_model->getHeader('about');
		$this->load->view('common/header', $data);
		//$this->load->view('common/menubar');
		$this->load->view('about/hospital_terms');
		$this->load->view('common/footer');
	}
	public function privacy_policy() {

		$data['getHeader'] = $this->common_model->getHeader('privacy-policy');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('about/privacy_policy');
		$this->load->view('common/footer');
	}

	public function faqs() {

		$data['getHeader'] = $this->common_model->getHeader('faqs');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('about/faqs');
		$this->load->view('common/footer');
	}

	public function careers() {

		$data['getHeader'] = $this->common_model->getHeader('careers');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('about/careers');
		$this->load->view('common/footer');
	}

	public function cookies_policy() {

		$data['getHeader'] = $this->common_model->getHeader('about');
		$this->load->view('common/header', $data);
		$this->load->view('common/menubar');
		$this->load->view('about/cookies_policy');
		$this->load->view('common/footer');
	}
}
