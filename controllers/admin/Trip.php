<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trip extends CI_Controller {

	public $user_id;

	public function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}

	}

	public function index() {

		is_user_in();
		$data['booking_prices_data'] = $this->common_model->get_tbl_data('booking_setup', '*', '', $row = 1);
		$data['reservation_data'] = $this->common_model->get_tbl_data('reservation', '*', array('id_user' => $this->user_id), $row = 1);
		$this->load->view('admin/trip/dashboard', $data);
		$this->load->view('admin/common/footer');
	}

	public function login() {
		$this->load->view('admin/common/header');
		$this->load->view('admin/login/trip_login');
	}

	public function guestLogin() {

		$email = $this->input->post('email');
		$reservation_id = trim($this->input->post('reservation_id'));
		if (isset($email) && isset($reservation_id)) {

			$qry = $this->db->query("SELECT * FROM tbl_user INNER JOIN tbl_reservation ON tbl_user.user_id = tbl_reservation.id_user
									 WHERE tbl_user.email = '$email' AND tbl_reservation.reservation_id = '$reservation_id'")->row_array();

			if ($qry) {

				$session_data = array('user_id' => $qry['user_id'], 'first_name' => $qry['first_name'], 'email' => $qry['email'], 'reservation_id' => $qry['reservation_id'], 'user_type' => $qry['user_type'], 'active' => $qry['active']);
				$this->session->set_userdata($session_data);
				redirect('admin/trip');
			} else {
				$this->session->set_flashdata('error', 'Invalid Email or Reservation Id');
				redirect('admin/trip/login');
			}
		} else {
			$this->session->set_flashdata('error', 'Required Email & Reservation');
			redirect('admin/trip/login');
		}
	}

}
