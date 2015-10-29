<?php 
$username = $this->session->userdata('username');
$name = $this->session->userdata('name');
$this->db->where('username',$username);
$res = $this->db->get('user')->result_array();
$user = $res[0];
?>
<div class="accountInfo">	
	<p><span>个人中心</span></p>
<pre style="margin: 5px">
用户名（登录名）:<?php echo $username;?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp姓名：<?php echo $name;?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 用户类型：<?php if ($user['group']=='admin'){echo '管理员';}else {echo '学生';}?>
</pre>
	<div class="right">
	<a href="dwz/html/changepwd.html" target="dialog" width="600">更改密码</a>
	</div>
</div>

<div class="pageCentent" layoutH='0' style="margin-left:5px;">
	<div class="tabs" currentIndex="0" eventType="click">
		<div class="tabsHeader">
			<div class="tabsHeaderContent">
				<ul>
					<li><a href="javascript:;"><span>我上传的植物标本</span></a></li>
					<li><a href="javascript:;"><span>我上传的动物标本</span></a></li>
				</ul>
			</div>
		</div>
		<div class="tabsContent">
		<!-- 我上传的植物标本----------------------------------------- -->
		<div>
				<table class="table" width="100%" layoutH='0'>
		<thead>
			<tr>
				<th>中文名</th>
				<th>拉丁名</th>
				<th>别名</th>
				<th>上传时间</th>
				<th>状态</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
<?php
$this->db->where('uploader',$username);
$plant_array = $this->db->get('plant')->result_array();
foreach ($plant_array as $plant){
?>
			<tr target="plantid" rel="1">
				<td><?php echo $plant['chineseName'];?></td>
				<td><?php echo $plant['latinName'];?></td>
				<td><?php echo $plant['nickName'];?></td>
				<td><?php echo $plant['time'];?></td>
				<td><?php if ($plant['state']=='PASS'){echo '已通过';}
							elseif ($plant['state']=='NOTPASS'){echo '未通过';}
							else{echo '等待审核';}?></td>
				<td><a target="navTab" href="index.php/specimen/detail/plant/<?php echo $plant['id'];?>/user_check">查看详情</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	</div>
	
	<!-- 我上传的动物标本----------------------------------------- -->
	<div>
	
					<table class="table" width="100%" layoutH='0'>
		<thead>
			<tr>
				<th>中文名</th>
				<th>拉丁名</th>
				<th>别名</th>
				<th>上传时间</th>
				<th>状态</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
<?php
$this->db->where('uploader',$username);
$animal_array = $this->db->get('animal')->result_array();
foreach ($animal_array as $animal){
?>
			<tr target="animalid" rel="1">
				<td><?php echo $animal['chineseName'];?></td>
				<td><?php echo $animal['latinName'];?></td>
				<td><?php echo $animal['nickName'];?></td>
				<td><?php echo $animal['time'];?></td>
				<td><?php if ($animal['state']=='PASS'){echo '已通过';}
							elseif ($animal['state']=='NOTPASS'){echo '未通过';}
							else{echo '等待审核';}?></td>
				<td><a target="navTab" href="index.php/specimen/detail/animal/<?php echo $animal['id'];?>/user_check">查看详情</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	</div>
		</div>
	</div>
	


</div>
