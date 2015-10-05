<?php
//此页面加载的参数 type,id,todo(普通查看，用户检查)
$info = '';
if ($type == 'plant') {
	$this->db->where('id',$id);
	$info = $this->db->get('plant')->result_array()[0];
}else {
	$this->db->where('id',$id);
	$info = $this->db->get('animal')->result_array()[0];
}
?>
<div class="pageContent" layoutH='0' style="margin-left:5px;">
<?php 
//是否显示菜单
if ($look_type == 'user_check'){
?>
	<div class="panelBar">
		<ul class="toolBar">
		<?php if ($info['state'] != 'PASS'){?>
			<li><a class="delete" href="index.php/api/del_<?php echo $type;?>/<?php echo $id;?>/personInfo" target="ajaxTodo" title="确定要拒绝通过吗?"><span>删除</span></a></li>
			<li class="line"></li>
			<li><a class="edit" href="index.php/specimen/reEdit/<?php echo $type;?>/<?php echo $id;?>" target="navTab"><span>修改</span></a></li>
			<li class="line"></li>
		<?php }?>
			<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			<li class="line"></li>
		</ul>
	</div>
<?php }?>
<?php
if ($look_type == 'admin_check'){
?>
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="delete" href="index.php/api/del_<?php echo $type;?>/<?php echo $id;?>/personInfo" target="ajaxTodo" title="确定要拒绝通过吗?"><span>删除</span></a></li>
			<li class="line"></li>
			<li><a class="edit" href="index.php/specimen/reEdit/<?php echo $type;?>/<?php echo $id;?>" target="navTab"><span>修改</span></a></li>
			<li class="line"></li>
			<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			<li class="line"></li>
		</ul>
	</div>
<?php }?>

<h1 style="margin-top:5px">基本信息:</h1>
<pre  style="margin:5px;line-height:1.5em">
中文名:<?php echo $info['chineseName'].'<br>';?>
拉丁名：<?php echo $info['latinName'].'<br>';?>
别名：<?php echo $info['nickName'].'<br>';?>
采集地：<?php echo $info['location'].'<br>';?>
分类：<?php
$class_array = explode('#', $info['classification']);
foreach ($class_array as $class){
	$this->db->where('id',$class);
	$res = $this->db->get('classify')->result_array();
	if (!empty($res)) {
		$res = $res[0];
		echo $res['name'].'    ';
	}
}
echo '<br>';
?>

</pre>

<div class="divider"></div>
<h1 style="margin-top:5px;margin-bottom:10px">描述信息:</h1>
<div style="margin-bottom:50px;margin-left:5px">
<?php echo $info['description'];?>
</div>

</div>