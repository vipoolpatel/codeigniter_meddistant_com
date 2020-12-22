<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Treatment extends CI_Controller {

	public function index() {

		$data['getHeader'] = $this->common_model->getHeader('treatment');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('treatment/treatment');
		$this->load->view('common/footer');
	}

	public function hair_transplant() {

		$data['getHeader'] = $this->common_model->getHeader('hair-transplant');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('treatment/hair_transplant');
		$this->load->view('common/footer');
	}

	public function butt_lift() {

		$data['getHeader'] = $this->common_model->getHeader('butt-lift');
		$this->load->view('common/header', $data);
		$this->load->view('common/menubar');
		$this->load->view('treatment/butt_lift');
		$this->load->view('common/footer');
	}

	public function nosejob() {

		$data['getHeader'] = $this->common_model->getHeader('nosejob');
		$this->load->view('common/header', $data);
		$this->load->view('common/menubar');
		$this->load->view('treatment/nosejob');
		$this->load->view('common/footer');
	}

	public function knee_surgery() {

		$data['getHeader'] = $this->common_model->getHeader('knee-surgery');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('treatment/knee_surgery');
		$this->load->view('common/footer');
	}

	public function eyesurgery() {

		$data['getHeader'] = $this->common_model->getHeader('eyesurgery');
		$this->load->view('common/header', $data);
		$this->load->view('common/menubar');
		$this->load->view('treatment/eyesurgery');
		$this->load->view('common/footer');
	}

	public function ivf() {

		$data['getHeader'] = $this->common_model->getHeader('ivf');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('treatment/ivf');
		$this->load->view('common/footer');
	}

	// public function filler() {

	// 	$data['getHeader'] = $this->common_model->getHeader('filler');
	// 	$this->load->view('common/header', $data);
	// 	// $this->load->view('common/menubar');
	// 	$this->load->view('treatment/filler');
	// 	$this->load->view('common/footer');
	// }

	public function facelift() {

		$data['getHeader'] = $this->common_model->getHeader('facelift');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('treatment/facelift');
		$this->load->view('common/footer');
	}

	public function tummy() {

		$data['getHeader'] = $this->common_model->getHeader('tummy');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('treatment/tummy');
		$this->load->view('common/footer');
	}

	// public function veneer() {

	// 	$data['getHeader'] = $this->common_model->getHeader('veneer');
	// 	$this->load->view('common/header', $data);
	// 	// $this->load->view('common/menubar');
	// 	$this->load->view('treatment/veneer');
	// 	$this->load->view('common/footer');
	// }

	public function eyelid() {

		$data['getHeader'] = $this->common_model->getHeader('eyelid');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('treatment/eyelid');
		$this->load->view('common/footer');
	}

	public function dental_implant() {

		$data['getHeader'] = $this->common_model->getHeader('dental-implant');
		$this->load->view('common/header', $data);
		// $this->load->view('common/menubar');
		$this->load->view('treatment/dental_implant');
		$this->load->view('common/footer');
	}
}
