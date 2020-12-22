<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Paypal extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function success_checkout() {
		if (!empty($this->input->post())) {
			$paypalInfo = $this->input->post();
			$payment_status = !empty($paypalInfo['payment_status']) ? $paypalInfo['payment_status'] : '';
			$payment_gross = !empty($paypalInfo['payment_gross']) ? $paypalInfo['payment_gross'] : 0;
		} else {
			$paypalInfo = $this->input->get();
			$payment_status = !empty($paypalInfo['st']) ? $paypalInfo['st'] : '';
			$payment_gross = !empty($paypalInfo['amt']) ? $paypalInfo['amt'] : 0;
		}

		$user_id = !empty($paypalInfo['custom']) ? $paypalInfo['custom'] : '';

		$checkout_data = array(
			'id_user' => $user_id,
			'item_title' => !empty($paypalInfo['item_name']) ? $paypalInfo['item_name'] : '',
			'checkout_price' => $payment_gross,
			'payment_status' => $payment_status,

			'id_quote_sent' => $this->session->userdata('id_quote_sent'),

			'schedule_treatment'	 => $this->session->userdata('schedule_treatment'),
			'accommodation' 		 => $this->session->userdata('accommodation'),
			'total_stay_day' 		 => $this->session->userdata('total_stay_day'),
			'hotel_accommodation' 	 => $this->session->userdata('hotel_accommodation'),
			'travel_accommodation'   => $this->session->userdata('travel_accommodation'),
			'accommodation_promotion' => $this->session->userdata('accommodation_promotion'),
			'prepayment_accommodation' => $this->session->userdata('prepayment_accommodation'),
			'companion' 			=> $this->session->userdata('companion'),
			'companion_name' 		=> $this->session->userdata('companion_name'),
			'total_checkout_price' 	=> $this->session->userdata('total_checkout_price'),
			'remaining_payment' 		=> $this->session->userdata('remaining_payment'),
			'total_discount' => $this->session->userdata('total_discount'),
			'coupon_code' => $this->session->userdata('coupon_code'),
			'discount_type' => $this->session->userdata('discount_type'),
			'discount_amount_percent' => $this->session->userdata('discount_amount_percent'),
			'facilitation_fee_cash' => !empty($this->session->userdata('facilitation_fee_cash')) ? 1 : 0,
			'payment_type' => 'PayPal',
			'txn_id' => $paypalInfo['txn_id'],
			'payer_address' => $paypalInfo['address_street'] . ', ' . $paypalInfo['address_city'] . ', ' . $paypalInfo['address_state'] . ' ' . $paypalInfo['address_zip'],
			'payment_date' => $paypalInfo['payment_date'],
		);
		$this->common_model->insert_tbl_data('checkout', $checkout_data);

		$this->common_model->booked_email($paypalInfo['item_number']);

		$this->common_model->clear_session();

		$this->session->set_flashdata('success_message', 'Payment completed successfully! One of our representative will contact you shortly for further process!');

		if ($this->session->userdata('user_type') === 'agent') {
			redirect('admin/agent/quotes_received');
		} else {
			redirect('customer_quotes_received/');
		}

	}

	function cancel() {
		if ($this->session->userdata('user_type') === 'agent') {
			redirect('admin/agent/quotes_received');
		} else {
			redirect('dashboard');
		}

	}

	function ipn() {
//paypal return transaction details array
		$paypalInfo = $this->input->post();

		$paypalURL = $this->paypal_lib->paypal_url;
		$result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);

//check whether the payment is verified
		if (preg_match("/VERIFIED/i", $result)) {

			$txt = json_encode($paypalInfo);
			$myfile = file_put_contents('paypal_log.txt', $txt . PHP_EOL, FILE_APPEND | LOCK_EX);
			fwrite($myfile, $txt);
			fclose($myfile);
		}

	}
}
