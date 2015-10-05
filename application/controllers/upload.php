<?php
 class Upload extends CI_Controller{
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->helper(array('form', 'url'));
 	}
 	
 	//上传植物媒体信息
 	public function upload_plant_media()
 	{
 		
 		$config['upload_path']      = './uploads/plants';
 		$config['allowed_types']    = 'gif|jpg|png|gif|jepg';
 		$config['max_size']     = 2048;
 		$config['encrypt_name']        = true;
 		//$config['max_height']       = 768;
 	
 		$this->load->library('upload', $config);
 	
 		if ( ! $this->upload->do_upload('filedata'))
 		{
 			$error = array('error' => $this->upload->display_errors());
 			//var_dump($this->upload->display_errors());
 			//$this->load->view('upload_form', $error);
 		}
 		else
 		{
 			$data = $this->upload->data();
 			echo json_encode(array('err'=>'','msg'=>array(
 											'url'=>base_url('uploads/plants').'/'.$data['file_name'],
 											'localname'=>$data['file_name'],
 											'id'=>'1'
 			)));

 		}
 	}
 	
 	public function upload_animal_media()
 	{
 			
 		$config['upload_path']      = './uploads/animals';
 		$config['allowed_types']    = 'gif|jpg|png|gif|jepg|swf|mp3|wav';
 		$config['max_size']     = 2048;
 		$config['encrypt_name']        = true;
 		//$config['max_height']       = 768;
 	
 		$this->load->library('upload', $config);
 	
 		if ( ! $this->upload->do_upload('filedata'))
 		{
 			$error = array('error' => $this->upload->display_errors());
 			//var_dump($this->upload->display_errors());
 			//$this->load->view('upload_form', $error);
 		}
 		else
 		{
 			$data = $this->upload->data();
 			echo json_encode(array('err'=>'','msg'=>array(
 					'url'=>base_url('uploads/animals').'/'.$data['file_name'],
 					'localname'=>$data['file_name'],
 					'id'=>'1'
 			)));
 	
 		}
 	}
 	
 	//上传表单
 	public function upload_plant(){
 		$chineseName = $this->input->post('chineseName');
 		$latinName = $this->input->post('latinName');
 		$nickname = $this->input->post('nickname');
 		$location = $this->input->post('location');
 		//分类信息 门，纲，亚纲，科
 		$division = $this->input->post('division');
 		$class = $this->input->post('class');
 		$subclass = $this->input->post('subclass');
 		$family = $this->input->post('family');
 		
 		$content = $this->input->post('content');
 		$this->db->insert('plant',array(
 				'chineseName'=>$chineseName,
 				'latinName'=>$latinName,
 				'location'=>$location,
 				'nickname'=>$nickname,
 				'description'=>$content,
 				'uploader'=>$this->session->userdata('username'),
 				'classification'=>$division.'#'.$class.'#'.$subclass.'#'.$family
 		));
 		if ($this->db->affected_rows()) {
 			echo '{"statusCode":"200", "message":"添加植物标本成功！正在等待管理员审核","navTabId":"personInfo","callbackType":"closeCurrent"}';
 		}else {
 			echo '{"statusCode":"300", "message":"提交失败，请重试！"}';
 		}
 	}
 	
 	public function upload_animal(){
 		$chineseName = $this->input->post('chineseName');
 		$latinName = $this->input->post('latinName');
 		$nickname = $this->input->post('nickname');
 		$location = $this->input->post('location');
 		$content = $this->input->post('content');
 		//分类信息 门 ，纲，亚纲，总目，目，亚目，科
 		$division = $this->input->post('division');
 		$class = $this->input->post('class');
 		$subClass = $this->input->post('subclass');
 		$superOrder = $this->input->post('superOrder');
 		$order = $this->input->post('order');
 		$subOrder = $this->input->post('subOrder');
 		$family = $this->input->post('family');
 		
 		$this->db->insert('animal',array(
 				'chineseName'=>$chineseName,
 				'latinName'=>$latinName,
 				'location'=>$location,
 				'nickname'=>$nickname,
 				'description'=>$content,
 				'uploader'=>$this->session->userdata('username'),
 				'classification'=>$division.'#'.$class.'#'.$subClass.'#'.$superOrder.'#'.$order.'#'.$subOrder.'#'.$family
 		));
 		if ($this->db->affected_rows() == 1) {
 			echo '{"statusCode":"200", "message":"添加动物标本成功！正在等待管理员审核","navTabId":"personInfo","callbackType":"closeCurrent"}';
 		}else {
 			echo '{"statusCode":"300", "message":"提交失败，请重试！"}';
 		}
 	}
 	
 }
 	
