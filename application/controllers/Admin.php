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
	
	//审核相关
	public function check_list(){
		$this->load->view('admin/check_list');
	}
	
	//已通过植物
	public function pass_plant(){
		$this->load->view('admin/pass_plant');
	}
	
	//已通过动物
	public function pass_animal(){
		$this->load->view('admin/pass_animal');
	}
	
	//待审核植物
	public function notcheck_plant(){
		$this->load->view('admin/notcheck_plant');
	}
	
	//待审核动物
	public function notcheck_animal(){
		$this->load->view('admin/notcheck_animal');
	}
	public function notpass(){
		$this->load->view('admin/notpass');
	}
	
	public function checking($type,$id){
		//type:plant or animal
		$this->load->view('admin/checking',array('type'=>$type,'id'=>$id));
	}
}