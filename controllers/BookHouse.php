<?php
defined('BASEPATH') OR exit('No direct script access allowed');




class BookHouse extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		
		redirect('welcome');
	}
	
	
	public function save_reservation() {
		
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$phone_no = $this->input->post('phone_no');
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');
		$total_nights = $this->input->post('total_nights');
		$adults = $this->input->post('adults');
		$children = $this->input->post('children');
		$total_price = $this->input->post('total_price');
		
		
		if (!empty($first_name) && !empty($email)) {
			
			$userdata = array(
					'first_name' => $first_name,
					'last_name'  => $last_name,
					'email'      => $email,
					'phone_no'   => $phone_no,
					'user_type'   => 'client',
					'created_on' => date('Y-m-d H:i:s'),
			);
			$save_user = $this->common_model->insert_tbl_data('user', $userdata);
			$reservation_id = $this->generateRandomString(FALSE, TRUE, FALSE, '', 7);
			$booking_data = array(
					'id_user'        => $save_user,
					'reservation_id' => $reservation_id,
					'checkin'        => date('Y-m-d', strtotime($checkin)),
					'checkout'       => date('Y-m-d', strtotime($checkout)),
					'total_nights'       => $total_nights,
					'adults'         => $adults,
					'children'       => $children,
					'total_price'    => $total_price,
					'booking_date'   => date('Y-m-d H:i:s'),
			);
			
			
			$save_booking = $this->common_model->insert_tbl_data('reservation', $booking_data);
			$session_data = array('user_id'    => $save_user,
								  'first_name' => $userdata['first_name'],
								  'email'      => $userdata['email'],
								  'reservation_id'      => $reservation_id,
								  'user_type'  => 'client',
			);
			$this->session->set_userdata($session_data);
			$this->session->set_flashdata('new_trip', '1');
			redirect('admin/trip');
		} else {
			
			$this->session->set_flashdata('error', 'Something went wrong, please try again later');
			redirect('welcome');
		}
	}
	
	
	
	
	function generateRandomString($alpha = TRUE, $nums = TRUE, $usetime = FALSE, $string = '', $length = 120) {
		
		$alpha = ($alpha == TRUE) ? 'abcdefghijklmnopqrstuvwxyz' : '';
		$nums = ($nums == TRUE) ? '1234567890' : '';
		if ($alpha == TRUE || $nums == TRUE || !empty($string)) {
			if ($alpha == TRUE) {
				$alpha = $alpha;
				$alpha .= strtoupper($alpha);
			}
		}
		$randomstring = '';
		$totallength = $length;
		for ($na = 0; $na < $totallength; $na++) {
			$var = (bool) rand(0, 1);
			if ($var == 1 && $alpha == TRUE) {
				$randomstring .= $alpha[(rand() % mb_strlen($alpha))];
			} else {
				$randomstring .= $nums[(rand() % mb_strlen($nums))];
			}
		}
		if ($usetime == TRUE) {
			$randomstring = $randomstring . time();
		}
		
		return ($randomstring);
	}
	
	
	
}
