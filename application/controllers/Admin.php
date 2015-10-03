<?php

class Admin extends CI_Controller{
	public function user_list(){
		$this->load->view('admin/user_list');
	}
	
	public function news_list() {
		$this->load->view('admin/news_list');
	}
	
	public function news_detail($newsid){
		$this->load->view('admin/news_detail',array('newsid'=>$newsid));
	}
	
}