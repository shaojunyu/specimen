<?php
class Person extends CI_Controller{
	
	public function myself(){
		$this->load->view('personal_page');
	}
}