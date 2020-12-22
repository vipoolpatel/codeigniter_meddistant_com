<?php
defined('BASEPATH') OR die("Direct access is not allowed");

class Logout extends CI_Controller {

	public function index() {
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('session_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('first_name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('user_type');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('created_on');

		$this->session->unset_userdata('session');
		$this->session->unset_userdata('total_quote_price');
		$this->session->unset_userdata('payment_method');
		$this->session->unset_userdata('quote_sent_id');
		$this->session->unset_userdata('procedure_treatment');
		$this->session->unset_userdata('quote_request_id');
		$this->session->unset_userdata('total_before_coupon');
		$this->session->unset_userdata('schedule_treatment');
		$this->session->unset_userdata('accommodation');
		$this->session->unset_userdata('hotel_accommodation');
		$this->session->unset_userdata('coupon_code');
		$this->session->unset_userdata('stripeToken');
		$this->session->unset_userdata('stripeEmail');
		$this->session->unset_userdata('coupon_discount');

		$data = array('user_id' => '', 'session_id' => '', 'username' => '', 'email' => '', 'user_type' => '', 'status' => '', 'created_on' => ''

			, 'session' => '', 'total_quote_price' => '', 'payment_method' => '', 'quote_sent_id' => '', 'procedure_treatment' => '', 'quote_request_id' => '', 'total_before_coupon' => '', 'schedule_treatment' => '', 'accommodation' => '', 'hotel_accommodation' => '', 'coupon_code' => '', 'stripeToken' => '', 'stripeEmail' => '', 'coupon_discount' => '');

		$this->session->unset_userdata($data);

		redirect(base_url(), 'refresh');
	}
}
