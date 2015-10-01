<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller{
	var $postdata;
	public function __construct(){
		parent::__construct();
		$this->postdata = file_get_contents("php://input");
	}
	
	public function index(){
		echo 'index 方法';
		$this->db->get('user');
	}
	
	public function login(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$this->db->where(array('username'=>$username,'password'=>$password));
		$this->db->get('user');
		if ($this->db->affected_rows() == 1){
			echo '{"statusCode":"200", "message":"登录成功","callbackType":"closeCurrent","forwardUrl":""}';
			$this->session->set_userdata('username',$username);
			//header("Location:".base_url());
		}else {
			echo '{"statusCode":"300", "message":"用户名或密码错误！"}';
		}
		
	}
	
	public function logout() {
		$this->session->sess_destroy();
		header("Location:".base_url());
	}
}