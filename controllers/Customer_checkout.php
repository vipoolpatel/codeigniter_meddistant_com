<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*require("vendor/autoload.php");
use \DrewM\MailChimp\MailChimp;*/

class Customer_checkout extends CI_Controller {
	public $user_id;
	public $user_email;

	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_email = $this->session->userdata('email');

		if (empty($this->user_id)) {
			redirect(base_url() . 'logout');
		}
	}

	public function index() {
		is_user_in();
		$this->load->view('common/user_backend_header');
		$this->load->view('common/user_backend_menubar');

		$data['quotes_received_data'] = $this->db->query("SELECT *, tbl_quote_sent.message as msg FROM tbl_quote_sent INNER JOIN tbl_quote_request ON tbl_quote_sent.quote_request_id = tbl_quote_request.id WHERE tbl_quote_request.email = '$this->user_email' ORDER BY tbl_quote_sent.created_on DESC")->result_array();

		$this->load->view('customer_quotes_received/quotes_received', $data);
		$this->load->view('common/user_backend_footer');
	}

	public function process_quote() {

		$this->common_model->clear_session();

		$selected_quote_id = $this->uri->segment(3);

		$quote_sent_data = $this->db->select('tbl_quote_sent.*,
			tbl_user.username,
			tbl_user.city,
			tbl_user.state,
			tbl_user.country,
			tbl_quote_request.destination_start_date,
			tbl_quote_request.destination_end_date,
			tbl_user.email,tbl_user.user_type,tbl_user.phone_no,tbl_doctors.name,tbl_treatment.treatment_name,tbl_quote_request.request_no');
		$quote_sent_data = $this->db->from('tbl_quote_sent');
		$quote_sent_data = $this->db->join('tbl_user', 'tbl_user.user_id  = tbl_quote_sent.id_user');
		$quote_sent_data = $this->db->join('tbl_doctors', 'tbl_doctors.doctor_id  = tbl_quote_sent.doctor_id', 'left');
		$quote_sent_data = $this->db->join('tbl_quote_request', 'tbl_quote_request.id  = tbl_quote_sent.quote_request_id');
		$quote_sent_data = $this->db->join('tbl_treatment', 'tbl_treatment.id  = tbl_quote_request.procedure_treatment');
		$quote_sent_data = $this->db->where('tbl_quote_sent.quote_sent_id', $selected_quote_id);
		$quote_sent_data = $this->db->get()->row_array();

		$data['selected_quote_data'] = $quote_sent_data;
		
		$prepayment_hospital = 0;
		if(trim($quote_sent_data['user_type']) == 'agent')
		{
			$prepayment_hospital = $quote_sent_data['agent_prepay'];
		}
		else
		{
			if (!empty($quote_sent_data['hospital_id'])) {
				$getHospital = $this->db->where('user_id', $quote_sent_data['hospital_id']);
				$getHospital = $this->db->get('tbl_user')->row();
				$prepayment_hospital = $getHospital->hospital_prepay;
			}	
		}
		

		$getHospitalDetail = $this->db->where('user_id', $quote_sent_data['hospital_id']);
		$getHospitalDetail = $this->db->get('tbl_user')->row();
		$data['getHospitalDetail'] = $getHospitalDetail;



		$data['prepayment_hospital'] = $prepayment_hospital;

		if ($this->session->userdata('user_type') === 'agent') {

			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
			$this->load->view('customer_checkout/checkout', $data);
			$this->load->view('admin/common/footer');

		} else {

			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
			$this->load->view('customer_checkout/checkout', $data);
			$this->load->view('common/user_backend_footer');

		}
	}

	public function checkout_detail() {

		$quote_sent_id = $this->uri->segment(3);

		$getInvoice = $this->db->select('tbl_checkout.*,tbl_user.first_name,tbl_user.last_name,tbl_doctors.name,tbl_treatment.treatment_name,tbl_quote_request.request_no,tbl_quote_sent.type,tbl_quote_sent.service_name,tbl_quote_sent.message,tbl_quote_sent.hospital_clinic,tbl_quote_sent.hospital_table_id,tbl_quote_sent.facilitation_fees');
		$getInvoice = $this->db->from('tbl_checkout');
		$getInvoice = $this->db->join('tbl_quote_sent', 'tbl_quote_sent.quote_sent_id = tbl_checkout.id_quote_sent');
		$getInvoice = $this->db->join('tbl_user', 'tbl_user.user_id  = tbl_checkout.id_user');
		$getInvoice = $this->db->join('tbl_doctors', 'tbl_doctors.doctor_id  = tbl_quote_sent.doctor_id', 'left');
		$getInvoice = $this->db->join('tbl_quote_request', 'tbl_quote_request.id  = tbl_quote_sent.quote_request_id');
		$getInvoice = $this->db->join('tbl_treatment', 'tbl_treatment.id  = tbl_quote_request.procedure_treatment');
		$getInvoice = $this->db->where('tbl_checkout.checkout_id', $quote_sent_id);
		$getInvoice = $this->db->get()->row_array();

		$data['getInvoice'] = $getInvoice;

		$getHospital = $this->db->select('tbl_hospital.*,tbl_user.country,tbl_user.state');
		$getHospital = $this->db->from('tbl_hospital');
		$getHospital = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_hospital.user_id');
		$getHospital = $this->db->where('tbl_hospital.id', $getInvoice['hospital_table_id']);
		$getHospital = $this->db->get()->row_array();
		$data['getHospital'] = $getHospital;

		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/header');
			$this->load->view('admin/common/menubar');
		} else {
			$this->load->view('common/user_backend_header');
			$this->load->view('common/user_backend_menubar');
		}

		$this->load->view('customer_checkout/checkout_detail', $data);

		if ($this->session->userdata('user_type') == "agent" || $this->session->userdata('user_type') == "admin") {
			$this->load->view('admin/common/footer');
		} else {
			$this->load->view('common/user_backend_footer');
		}
	}

	/* adding coupon coming from step 3 via Ajax call*/
	public function apply_coupon() {
		$amount = $this->input->post('amount');
		if ($amount >= 2000) {
			$discount = $this->db->where('discount_code', $this->input->post('coupon_code'));
			$discount = $this->db->get('tbl_discount')->row();
			if (!empty($discount->discount_code)) {

				$json['coupon_code'] = $discount->discount_code;
				$json['discount_type'] = $discount->discount_type;
				$json['discount_amount_percent'] = $discount->amount;
			} else {
				$json['coupon_code'] = '';
				$json['discount_type'] = '';
				$json['discount_amount_percent'] = '';
			}
		} else {
			$json['coupon_code'] = '';
			$json['amount_dis'] = '0';
			$json['discount_type'] = '';
			$json['discount_amount_percent'] = '';
		}

		echo json_encode($json);
	}

	public function checkout() {

		$payment_method = trim($this->input->post('payment_method'));

		$total_quote_price = $this->input->post('final_amount');

		$quote_sent_id = $this->input->post('quote_sent_id');
		$procedure_treatment = $this->input->post('procedure_treatment');

		if ($payment_method == 'paypal') {

			$this->common_model->clear_session();

			$this->session->set_userdata('quote_sent_id', $this->input->post('quote_sent_id'));

			$this->session->set_userdata('schedule_treatment', $this->input->post('schedule_treatment'));
			$this->session->set_userdata('accommodation', $this->input->post('accommodation'));
			$this->session->set_userdata('total_stay_day', $this->input->post('total_stay_day'));
			$this->session->set_userdata('hotel_accommodation', $this->input->post('hotel_accommodation'));
			$this->session->set_userdata('travel_accommodation', $this->input->post('travel_accommodation'));
			$this->session->set_userdata('accommodation_promotion', $this->input->post('accommodation_promotion'));
			$this->session->set_userdata('prepayment_accommodation', $this->input->post('prepayment_accommodation'));
			$this->session->set_userdata('facilitation_fee_cash', $this->input->post('facilitation_fee_cash'));
			$this->session->set_userdata('companion', $this->input->post('companion'));
			$this->session->set_userdata('companion_name', $this->input->post('companion_name'));
			$this->session->set_userdata('total_checkout_price', $this->input->post('total_checkout_price'));
			$this->session->set_userdata('remaining_payment', $this->input->post('remaining_payment'));
			$this->session->set_userdata('total_discount', $this->input->post('total_discount'));
			$this->session->set_userdata('coupon_code', $this->input->post('coupon_code'));
			$this->session->set_userdata('discount_type', $this->input->post('discount_type'));
			$this->session->set_userdata('discount_amount_percent', $this->input->post('discount_amount_percent'));

			$returnURL = base_url() . 'paypal/success_checkout'; //payment success url
			$cancelURL = base_url() . 'paypal/cancel'; //payment cancel url
			$notifyURL = base_url() . 'paypal/ipn'; //ipn url

			$this->paypal_lib->add_field('cmd', '_xclick');
			$this->paypal_lib->add_field('item_number', $quote_sent_id);
			$this->paypal_lib->add_field('item_name', $procedure_treatment);
			$this->paypal_lib->add_field('custom', $this->user_id);
			$this->paypal_lib->add_field('amount', $total_quote_price);
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->paypal_auto_form();

		} 
		else if($payment_method == 'no_payment')
		{
			$checkout_data = array(
				'id_user' => $this->user_id,
				'id_quote_request' => $this->input->post('quote_request_id'),
				'id_quote_sent' => $this->input->post('quote_sent_id'),
				'item_title' => $this->input->post('procedure_treatment'),
				'checkout_price' => $this->input->post('final_amount'),

				'schedule_treatment' => $this->input->post('schedule_treatment'),
				'accommodation' => $this->input->post('accommodation'),
				'total_stay_day' => $this->input->post('total_stay_day'),
				'hotel_accommodation' => $this->input->post('hotel_accommodation'),
				'travel_accommodation' => $this->input->post('travel_accommodation'),
				'accommodation_promotion' => $this->input->post('accommodation_promotion'),
				'prepayment_accommodation' => $this->input->post('prepayment_accommodation'),
				'companion' => $this->input->post('companion'),
				'facilitation_fee_cash' => !empty($this->input->post('facilitation_fee_cash')) ? 1 : '0',
				
				'companion_name' => $this->input->post('companion_name'),
				'total_checkout_price' => $this->input->post('total_checkout_price'),
				'remaining_payment' => $this->input->post('remaining_payment'),
				'total_discount' => $this->input->post('total_discount'),
				'coupon_code' => $this->input->post('coupon_code'),
				'discount_type' => $this->input->post('discount_type'),
				'discount_amount_percent' => $this->input->post('discount_amount_percent'),

				'payment_status' => 'Completed',
				'payment_type' => 'No Pre Payment',
				'txn_id' => '',
				'payment_date' => date('Y-m-d h:i:s'),
			);

			$this->common_model->insert_tbl_data('checkout', $checkout_data);

			$this->common_model->booked_email($this->input->post('quote_sent_id'));

			$this->session->set_flashdata('success_message', 'Payment completed successfully! One of our representative will contact you shortly for further process!');

			if ($this->session->userdata('user_type') === 'agent') {
				redirect('admin/agent/quotes_received');
			} else {
				redirect('customer_quotes_received/');
			}
		}
		else {

			\Stripe\Stripe::setApiKey($this->config->item('stripe_secret_key'));

			$token = $_POST['stripeToken'];
			$email = $_POST['stripeEmail'];

			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source' => $token,
			));

			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount' => number_format($total_quote_price, 0, '.', '') * 100,
				'currency' => 'usd',
			));

			$checkout_data = array(
				'id_user' => $this->user_id,
				'id_quote_request' => $this->input->post('quote_request_id'),
				'id_quote_sent' => $this->input->post('quote_sent_id'),
				'item_title' => $this->input->post('procedure_treatment'),
				'checkout_price' => $this->input->post('final_amount'),

				'schedule_treatment' => $this->input->post('schedule_treatment'),
				'accommodation' => $this->input->post('accommodation'),
				'total_stay_day' => $this->input->post('total_stay_day'),
				'hotel_accommodation' => $this->input->post('hotel_accommodation'),
				'travel_accommodation' => $this->input->post('travel_accommodation'),
				'accommodation_promotion' => $this->input->post('accommodation_promotion'),
				'prepayment_accommodation' => $this->input->post('prepayment_accommodation'),
				'companion' => $this->input->post('companion'),
				'companion_name' => $this->input->post('companion_name'),
				'total_checkout_price' => $this->input->post('total_checkout_price'),
				'remaining_payment' => $this->input->post('remaining_payment'),
				'total_discount' => $this->input->post('total_discount'),
				'coupon_code' => $this->input->post('coupon_code'),
				'discount_type' => $this->input->post('discount_type'),
				'discount_amount_percent' => $this->input->post('discount_amount_percent'),
				'facilitation_fee_cash' => !empty($this->input->post('facilitation_fee_cash')) ? 1 : '0',

				'payment_status' => !empty($charge->outcome->seller_message) ? $charge->outcome->seller_message : '',
				'payment_type' => 'Card',
				'txn_id' => !empty($charge->balance_transaction) ? $charge->balance_transaction : '',
				'payment_date' => date('Y-m-d h:i:s', $charge->created),
			);

			$this->common_model->insert_tbl_data('checkout', $checkout_data);

			$this->common_model->booked_email($this->input->post('quote_sent_id'));

			$this->session->set_flashdata('success_message', 'Payment completed successfully! One of our representative will contact you shortly for further process!');

			if ($this->session->userdata('user_type') === 'agent') {
				redirect('admin/agent/quotes_received');
			} else {
				redirect('customer_quotes_received/');
			}
		}

	}

	public function checkout_detail_pdf($id) {
		$this->load->library('dompdf_gen');

		$getInvoice = $this->db->select('tbl_checkout.*,tbl_user.first_name,tbl_user.last_name,tbl_doctors.name,tbl_treatment.treatment_name,tbl_quote_request.request_no,tbl_quote_sent.type,tbl_quote_sent.service_name,tbl_quote_sent.message,tbl_quote_sent.hospital_clinic,tbl_quote_sent.hospital_table_id,tbl_quote_sent.facilitation_fees');
		$getInvoice = $this->db->from('tbl_checkout');
		$getInvoice = $this->db->join('tbl_quote_sent', 'tbl_quote_sent.quote_sent_id = tbl_checkout.id_quote_sent');
		$getInvoice = $this->db->join('tbl_user', 'tbl_user.user_id  = tbl_checkout.id_user');
		$getInvoice = $this->db->join('tbl_doctors', 'tbl_doctors.doctor_id  = tbl_quote_sent.doctor_id', 'left');
		$getInvoice = $this->db->join('tbl_quote_request', 'tbl_quote_request.id  = tbl_quote_sent.quote_request_id');
		$getInvoice = $this->db->join('tbl_treatment', 'tbl_treatment.id  = tbl_quote_request.procedure_treatment');
		$getInvoice = $this->db->where('tbl_checkout.checkout_id', $id);
		$getInvoice = $this->db->get()->row_array();

		$getHospital = $this->db->select('tbl_hospital.*,tbl_user.country,tbl_user.state');
		$getHospital = $this->db->from('tbl_hospital');
		$getHospital = $this->db->join('tbl_user', 'tbl_user.user_id = tbl_hospital.user_id');
		$getHospital = $this->db->where('tbl_hospital.id', $getInvoice['hospital_table_id']);
		$getHospital = $this->db->get()->row_array();

		$payment_date = date('m-d-Y', strtotime($getInvoice['payment_date']));

		$html = '';
		$html .= '<style>
		table {
			display: table; border-collapse: collapse;
		}
		.pricedetail tr td
		{
			font-family:Verdana;
			padding:8px;
			text-align:left;
		}
		.pricedetail tr th
		{
			font-family:Verdana;
			padding:8px;
			text-align:left;
			width:25%;
		}
		</style>


		<p><img src="' . base_url() . 'assets/frontend-asset/images/uploads/sites/11/2018/01/logo2.jpg"></p>


		<p style="font-weight: bold;"> Meddistant Care Team</p>
		<p style="font-weight: bold;"> USA & Canada +1888 9699959</p>
		<p style="font-weight: bold;"> Worldwide  +1312 8899105 </p>
		<p style="font-weight: bold;"> Turkey +90 (541)9473789 </p>
		<p style="font-weight: bold;"> care@meddistant.com</p>


		<table border="1" width="100%" class="pricedetail" style="margin-top: 5px;">
  <tbody>
    <tr>
      <th>Name</th>
      <td>' . $getInvoice['first_name'] . ' ' . $getInvoice['last_name'] . '</td>

    </tr>
     <tr>
      <th>QR No.</th>

       <td>' . $getInvoice['request_no'] . '</td>
    </tr>';

		$html .= ' <tr>
      <th>Hospital/Clinic</th>

       <td>' . $getInvoice['hospital_clinic'] . '</td>
    </tr>';

		$html .= ' <tr>
      <th>Treatment</th>

       <td>' . $getInvoice['treatment_name'] . '</td>
    </tr>';

		if ($getInvoice['type'] == 'Treatment') {

			$html .= ' <tr>
      <th>Country</th>

       <td>' . $getHospital['country'] . '</td>
    </tr>';

		}

		$html .= '<tr>
      <th>Service</th>

       <td>' . $getInvoice['service_name'] . '</td>
    </tr>';

		$Message_Proposed_treatment = ($getInvoice['type'] != 'Service') ? 'Message/Proposed treatment' : 'Proposed Service';

		$html .= '<tr>
      <th>' . $Message_Proposed_treatment . '</th>
     <td>' . $getInvoice['message'] . '</td>

    </tr>
    <tr>
      <th>Payment Date</th>
     <td>' . $payment_date . '</td>

    </tr>
    <tr>
      <th>Payment Type</th>
     <td>' . $getInvoice['payment_type'] . '</td>

    </tr>';

		if ($getInvoice['type'] == 'Treatment') {

			$html .= '<tr>
      <th>Treatment Date</th>

       <td>' . $getInvoice['schedule_treatment'] . '</td>
    </tr>
    <tr>
      <th>Total ($)</th>
      <td>' . $getInvoice['total_checkout_price'] . '</td>

    </tr>
';

			if (!empty($getInvoice['companion_name'])) {
				$html .= '<tr>
      <th>Companion Name</th>

       <td>' . $getInvoice['companion_name'] . '</td>
    </tr>';
			}

			$accommodation = !empty($getInvoice['accommodation']) ? 'Yes' : 'No';

			$html .= '<tr>
      <th>Meddistant will arrange your hotel accommodations</th>

        <td>' . $accommodation . '</td>
    </tr>';
			if (!empty($getInvoice['hotel_accommodation'])) {

				if ($getInvoice['hotel_accommodation'] == 100) {
					$hotel_accommodation = "3 or 4 Star Hotel ($100/day)";
				} else if ($getInvoice['hotel_accommodation'] == 140) {
					$hotel_accommodation = "5 Star Hotel ($140/day)";
				} else if ($getInvoice['hotel_accommodation'] == 94) {
					$hotel_accommodation = "3 or 4 Star Hotel ($94/day)";
				} else if ($getInvoice['hotel_accommodation'] == 127) {
					$hotel_accommodation = "5 Star Hotel ($127/day)";
				} else {
					$hotel_accommodation = "4/5 Star Hotel ($" . $getInvoice['hotel_accommodation'] . "/day)";
				}

				$html .= '<tr>
      <th>Hotel Accommodation for ' . $getInvoice['total_stay_day'] . ' Days</th>
     <td>' . $hotel_accommodation . '</td>

    </tr>';
			}

			$html .= '<tr>
      <th>Flight/Travel to Destination</th>
     <td>' . $getInvoice['travel_accommodation'] . '</td>

    </tr>';
			if (!empty($getInvoice['hotel_accommodation'])) {

				$hotel = $getInvoice['hotel_accommodation'] * $getInvoice['total_stay_day'];
				$hotel_total = number_format($hotel, 2);

				$html .= '<tr>
      <th>Hotel ($)</th>
     <td>' . $hotel_total . '</td>

    </tr>';
			}

			$accommodation_promotion = '';
			if($getInvoice['accommodation_promotion'] == '0')
			{
				$accommodation_promotion = 'Free one day guided tour';
			}
			else
			{
				if(!empty($getInvoice['accommodation_promotion']))
				{
					$accommodation_promotion = "$50 Off ($50 for one day)";
				}
			}

			$html .= '<tr>
      <th>Promotion ($)</th>

      <td>' . $accommodation_promotion . '</td>
    </tr>';
			$total_discount = !empty($getInvoice['total_discount']) ? number_format($getInvoice['total_discount'], 2) : '0';

			$html .= ' <tr>
      <th>Discount ($)</th>
     <td>' . $total_discount . '</td>

    </tr>';
		}

		$checkout_price = !empty($getInvoice['checkout_price']) ? number_format($getInvoice['checkout_price'], 2) : '0';

		$html .= '<tr>
      <th>Paid Amount ($)</th>

      <td>' . $checkout_price . '</td>
    </tr>';


    	if(!empty($getInvoice['facilitation_fees']))
		{
			$facilitation_fee_cash = '';
			if(!empty($getInvoice['facilitation_fee_cash']))
			{
				$facilitation_fee_cash = '(Cash)';
			}

			$html .= '<tr>
			      <th>Paid Amount Facilitation '.$facilitation_fee_cash.' ($) :</th>
			      <td>' . $getInvoice['facilitation_fees'] . '</td>
			    </tr>';
		}


		if ($getInvoice['type'] == 'Treatment') {
			$remaining_payment = !empty($getInvoice['remaining_payment']) ? number_format($getInvoice['remaining_payment'], 2) : '0';

			$html .= '<tr>
      <th>Remaining Payment at Hospital/Clinic ($)</th>
       <td>' . $remaining_payment . '</td>

    </tr>';
		}

		$html .= '
    </tbody>

		</table>';

		$pdfname = "invoice.pdf";
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$this->dompdf->stream($pdfname);
		// file_put_contents('public/invoice/' . $pdfname . '', $output);
	}

}
