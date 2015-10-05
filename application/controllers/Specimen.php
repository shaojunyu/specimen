<?php

class Specimen extends CI_Controller{
	
	public function detail($type,$id,$look_type = 'look'){
		$this->load->view('detail_page',array('type'=>$type,'id'=>$id,'look_type'=>$look_type));
	}
	
	public function search(){
		echo '<h1>正在开发中，请稍后</h1>';
	}
	
	public function reEdit($type,$id){
		$this->load->view('reEdit_page',array('type'=>$type,'id'=>$id));
	}
	
	public function update($type,$id){
		if ($type == 'plant'){
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
			$this->db->where('id',$id);
			$this->db->update('plant',array(
					'chineseName'=>$chineseName,
					'latinName'=>$latinName,
					'location'=>$location,
					'nickname'=>$nickname,
					'description'=>$content,
					'classification'=>$division.'#'.$class.'#'.$subclass.'#'.$family,
					'state'=>'NOTCHECK'
			));
			if ($this->db->affected_rows()) {
				echo '{"statusCode":"200", "message":"更新成功！正在等待管理员审核","navTabId":"personInfo","callbackType":"closeCurrent"}';
			}else {
				echo '{"statusCode":"300", "message":"提交失败，请重试！"}';
			}
		}elseif ($type == 'animal'){
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
			
			$this->db->where('id',$id);
			$this->db->update('animal',array(
					'chineseName'=>$chineseName,
					'latinName'=>$latinName,
					'location'=>$location,
					'nickname'=>$nickname,
					'description'=>$content,
					'state'=>'NOTCHECK',
					'classification'=>$division.'#'.$class.'#'.$subClass.'#'.$superOrder.'#'.$order.'#'.$subOrder.'#'.$family
			));
			if ($this->db->affected_rows() == 1) {
				echo '{"statusCode":"200", "message":"更新成功！正在等待管理员审核","navTabId":"personInfo","callbackType":"closeCurrent"}';
			}else {
				echo '{"statusCode":"300", "message":"提交失败，请重试！"}';
			}
		}
	}
}