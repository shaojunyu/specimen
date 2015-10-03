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
		$username = 'U201312515';
		$this->db->where('username',$username);
		var_dump($this->db->get('user')->result_array()[0]['group']);
		
	}
	
	public function login(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$this->db->where(array('username'=>$username,'password'=>$password));
		$this->db->get('user');
		if ($this->db->affected_rows() == 1){
			echo '{"statusCode":"200", "message":"登录成功","callbackType":"redirect","redirectUrl":"'.base_url().'"}';
			$this->session->set_userdata('username',$username);
			$this->db->where('username',$username);
			$this->session->set_userdata('usergroup',$this->db->get('user')->result_array()[0]['group']);
		}else {
			echo '{"statusCode":"300", "message":"用户名或密码错误！"}';
		}
		
	}
	
	public function logout() {
		$this->session->sess_destroy();
		header("Location:".base_url());
	}
	
	//用户管理
	public function add_user(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$group = $_POST['group'];
		$this->db->insert('user',array(
				'username'=>$username,
				'name'=>$name,
				'password'=>$password,
				'group'=>$group
		));
		if ($this->db->affected_rows() == 1) {
			echo '{"statusCode":"200", "message":"添加用户成功","navTabId":"user_list","callbackType":"closeCurrent"}';
		}else {
			echo '{"statusCode":"300", "message":"添加失败，请重试！"}';
		}
	}
	
	public function del_user($userid){
		$this->db->where('id',$userid);
		$this->db->delete('user');
		if ($this->db->affected_rows() == 1) {
			echo '{"statusCode":"200", "message":"删除用户成功","navTabId":"user_list"}';
		}else {
			echo '{"statusCode":"300", "message":"删除失败，请重试！"}';
		}
		
	}
	
	//新闻管理
	public function add_news(){
		$title = $_POST['title'];
		$content = $_POST['content'];
		$writer = $this->session->userdata('username');
		$this->db->insert('news',array(
				'title'=>$title,
				'content'=>$content,
				'writer'=>$writer
		));
		if ($this->db->affected_rows() == 1) {
			echo '{"statusCode":"200", "message":"添加新闻成功！","navTabId":"news_list","callbackType":"closeCurrent"}';
		}else {
			echo '{"statusCode":"300", "message":"添加失败，请重试！"}';
		}
	}
	
	public function del_news($newsid){
		$this->db->where('id',$newsid);
		$this->db->delete('news');
		if ($this->db->affected_rows() == 1) {
			echo '{"statusCode":"200", "message":"'.$newsid.'删除新闻成功","navTabId":"news_list"}';
		}else {
			echo '{"statusCode":"300", "message":"删除失败，请重试！"}';
		}
		
	}
}