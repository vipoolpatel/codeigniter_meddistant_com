<?php
defined('BASEPATH') OR exit('No direct script access allowed');




class Setting extends CI_Controller {
	

	
	public function index() {
		
		is_admin_in();
		$this->load->view('admin/dashboard/dashboard');
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$this->load->view('admin/common/footer');
	}
	
	
	public function save_availability() {
		
		
		$avl_date = $this->input->post('avl_date');
		$title = $this->input->post('title');
		$type = $this->input->post('type');
		
		$insert_data = array(
				'avl_date' => $avl_date,
				'title' => $title,
				'type' => $type,
		);
		$this->common_model->insert_tbl_data('availability', $insert_data);
	}
	
	
	public function update_availability() {
		$avl_date = $this->input->post('avl_date');
		$title = $this->input->post('title');
		
		$update_data = array(
				'title' => $title,
		);
		$this->common_model->update_tbl_data('availability', $update_data, array('avl_date' => $avl_date));
	}
	
	public function del_availability() {
		$avl_date = $this->input->post('avl_date');
		
		$this->common_model->dlt_tbl_data('availability', array('avl_date' => $avl_date));
	}
	
	
	
	
	public function get_availabilityData_json() {
		
		
		$qry = $this->db->query("SELECT * FROM tbl_availability ORDER BY avl_date ASC")->result_array();
		
		$event_array = array();
		foreach($qry as $data) {
			$event_array[] = array(
					'title' => $data['title'],
					'start' => $data['avl_date'],
					'className' => $data['type'],
					'allDay' => true
			);
		}
		
		echo json_encode($event_array, true);
		/*if(count($qry) >= 1) {
			//echo '[';
			foreach($qry as $data) {
				echo json_encode($data);
			}
			//echo ']';
		}*/
	}
	
	
	
	public function availability() {
		
		is_admin_in();
		
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$data['availability_data'] = $this->common_model->get_tbl_data('availability', '*');
		$this->load->view('admin/setting/availability', $data);
		$this->load->view('admin/common/footer');
	}
	
	
	public function save_availability2() {
		
		$date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
		$title = $this->input->post('title');
	
		if(!empty($date_from) && !empty($date_to)) {
			
			$insert_data = array(
					'date_from' => $date_from,
					'date_to' => $date_to,
					'title' => $title,
			);
			$this->common_model->update_tbl_data('availability', $insert_data, array('id' => 1));
			
			$this->session->set_flashdata('success', 'Booking Availability Successfully');
			redirect('admin/setting/availability');
		} else {
			$this->session->set_flashdata('error', 'Please select dates!');
			redirect('admin/setting/availability');
		}
		
	}
	
	
	
	
	
	public function bookingSetup() {
		
		is_admin_in();
		
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/menubar');
		$data['booking_prices_data'] = $this->common_model->get_tbl_data('booking_setup', '*', '', $row = 1);
		$this->load->view('admin/setting/bookingSetup', $data);
		$this->load->view('admin/common/footer');
	}
	
	
	
	
	
	public function save_booking_prices() {
		
		$price_per_night = $this->input->post('price_per_night');
		$cleaning_fee = $this->input->post('cleaning_fee');
		
		if(!empty($price_per_night) && !empty($cleaning_fee)) {
			$insert_data = array(
					'price_per_night' => $price_per_night,
					'cleaning_fee' => $cleaning_fee,
			);
			$this->common_model->update_tbl_data('booking_setup', $insert_data, array('id' => 1));
			
			$this->session->set_flashdata('success', 'Booking Prices are Saved Successfully');
			redirect('admin/setting/bookingSetup');
		} else {
			$this->session->set_flashdata('error', 'Please select all fields');
			redirect('admin/setting/bookingSetup');
		}
		
	}
	
	
	
	
}
