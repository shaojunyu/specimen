<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller{
	var $postdata;
	public function __construct(){
		parent::__construct();
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
			$this->session->set_userdata('name',$this->db->get('user')->result_array()[0]['name']);
			
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
		
		$this->db->where('username',$username);
		$this->db->get('user');
		if ($this->db->affected_rows()) {
			echo '{"statusCode":"300", "message":"已存在该用户，请勿重复添加"}';
			exit();
		}
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
	
	//更改密码
	public function changePW(){
		$oldPW = $this->input->post('oldPassword');
		$newPW = $this->input->post('rnewPassword');
		$username = $this->session->userdata('username');
		$this->db->where('username',$username);
		$originPW = $this->db->get('user')->result_array()[0]['password'];
		if ($oldPW == $originPW){
			$this->db->where('username',$username);
			$this->db->update('user',array('password'=>$newPW));
			if ($this->db->affected_rows() == 1) {
				echo '{"statusCode":"200", "message":"更改密码成功","callbackType":"closeCurrent"}';
			}else {
				echo '{"statusCode":"300", "message":"更新失败，请稍后再试"}';
			}
		}else {
			echo '{"statusCode":"300", "message":"旧密码错误！"}';
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
	
	//联动下拉菜单数据
	//门
	/*
	 * @param type :plant or animal
	 * return json
	 */
	public function get_division($type = 'plant') {
		if ($type == 'plant') {
			$this->db->like('id','p','after');
			$this->db->where('father','0');
			$res = $this->db->get('classify')->result_array();
			var_dump($res);
		}else {
			$this->db->like('id','a','after');
			$this->db->where('father','0');
			$res = $this->db->get('classify')->result_array();
			var_dump($res);
		}
	}
	
	//纲
	//@param 父
	public function get_sons($father){
		if ($father == 'all') {
			echo '[["all", "请先选上一级"]]';
			exit();
		}
		$this->db->where('father',$father);
		$res_array = $this->db->get('classify')->result_array();
		$data = '[';
		foreach ($res_array as $one){
			$data = $data.'["'.$one['id'].'","'.$one['name'].'"],';
		}
		$data = substr($data, 0,strlen($data)-1);
		if ($data == NULL) {
			$data = '[["null", "无"]]';
		}else {
			$data = $data.']';
		}
		
		echo ($data);
	}	
	
	
	//标本管理
	//viwe 在哪个视图下删除标本
	public function del_plant($plantid,$view){
		$this->db->where('id',$plantid);
		$this->db->delete('plant');
		if ($this->db->affected_rows() == 1) {
			echo '{"statusCode":"200", "message":"删除成功","navTabId":"'.$view.'"}';
		}else {
			echo '{"statusCode":"300", "message":"删除失败，请重试！"}';
		}
	}
	public function del_animal($animalid,$view){
		$this->db->where('id',$animalid);
		$this->db->delete('animal');
		if ($this->db->affected_rows() == 1) {
			echo '{"statusCode":"200", "message":"删除成功","navTabId":"'.$view.'"}';
		}else {
			echo '{"statusCode":"300", "message":"删除失败，请重试！"}';
		}
	}
	
	//审核通过
	public function pass($type,$id){
		if ($type == 'plant'){
			$this->db->where('id',$id);
			$this->db->update('plant',array('state'=>'PASS'));
		}else {
			$this->db->where('id',$id);
			$this->db->update('animal',array('state'=>'PASS'));
		}
		
		if ($this->db->affected_rows() == 1) {
			echo '{"statusCode":"200", "message":"操作成功","callbackType":"closeCurrent","navTabId":"notcheck_'.$type.'"}';
		}else {
			echo '{"statusCode":"300", "message":"操作失败，请重试！"}';
		}
	}
	
	//审核不通过
	public function notpass($type,$id){
		if ($type == 'plant'){
			$this->db->where('id',$id);
			$this->db->update('plant',array('state'=>'NOTPASS'));
		}else {
			$this->db->where('id',$id);
			$this->db->update('animal',array('state'=>'NOTPASS'));
		}
	
		if ($this->db->affected_rows() == 1) {
			echo '{"statusCode":"200", "message":"操作成功","callbackType":"closeCurrent","navTabId":"notcheck_'.$type.'"}';
		}else {
			echo '{"statusCode":"300", "message":"操作失败，请重试！"}';
		}
	}
	
}