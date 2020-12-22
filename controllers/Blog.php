<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index() {

		$data['getHeader'] = $this->common_model->getHeader('blog');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('blog/blog_list');
		$this->load->view('common/footer');
	}

	public function blog_1() {

		$data['getHeader'] = $this->common_model->getHeader('pitfalls-to-avoid-while-availing-medical-tourism');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('blog/blog_1');
		$this->load->view('common/footer');
	}

	public function blog_2() {

		$data['getHeader'] = $this->common_model->getHeader('5-significant-reasons-turkey-is-becoming-hub-of-medical-tourism');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('blog/blog_2');
		$this->load->view('common/footer');
	}
	public function blog_3() {

		$data['getHeader'] = $this->common_model->getHeader('turkey-safer-medical-tourism-destination-as-compared-to-the-usa-and-europe');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('blog/blog_3');
		$this->load->view('common/footer');
	}
	public function blog_4() {

		$data['getHeader'] = $this->common_model->getHeader('guide-on-after-treatment-medical-travel-you-can-always-rely-on');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('blog/blog_4');
		$this->load->view('common/footer');
	}
}
