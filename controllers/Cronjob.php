<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

	public function discount() {
		$discount = $this->db->get('tbl_discount')->result();
		$expire_date = date('Y-m-d', strtotime(' + 7 days'));
		foreach ($discount as $value) {
			$string = $this->generateRandomString(10);
			$this->db->where('id', $value->id);
			$this->db->set('discount_code', $string);
			$this->db->set('expire_date', $expire_date);
			$this->db->update('tbl_discount');
		}
	}




	public function affiliate_code() {
		$expire_date = date('Y-m-d', strtotime(' + 7 days'));
		$discount = $this->db->where_in('id', array('1','3','5','7','9'));
		$discount = $this->db->get('tbl_affiliate_code')->result();
		foreach ($discount as $value) {
			$string = $this->generateRandomString(10);
			$this->db->where('id', $value->id);
			$this->db->set('patient_code', $string);
			$this->db->set('expire_date', $expire_date);
			$this->db->update('tbl_affiliate_code');
		}
	}



	public function affiliate_code_one() {
		$expire_date = date('Y-m-d', strtotime(' + 6 days'));

		$discount = $this->db->where_in('id', array('2','4','6','8','10'));
		$discount = $this->db->get('tbl_affiliate_code')->result();
		foreach ($discount as $value) {
			$string = $this->generateRandomString(10);
			$this->db->where('id', $value->id);
			$this->db->set('patient_code', $string);
			$this->db->set('expire_date', $expire_date);
			$this->db->update('tbl_affiliate_code');
		}
		
	}



	function generateRandomString($length = 10) {
		$characters = '0123456789';
		// $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}



	 
}
