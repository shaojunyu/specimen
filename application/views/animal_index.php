<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="index.php/specimen/animal_index/true" method="post">
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					输入搜索关键字：<textarea name="keyword" cols="80" rows="2"><?php if(!empty($keyword)){echo $keyword;}?></textarea>
				</td>
			</tr>
		</table>
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
			</ul>
		</div>
	</div>
	</form>
</div>
<div class="pageContent">
	<table class="table" width="100%" layoutH="130">
		<thead>
			<tr>
				<th >标本中文名</th>
				<th >标本拉丁名</th>
				<th >创建者</th>
				<th>内容提要</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
<?php 
if ($search and !empty($keyword)) {
	//搜索算法
	//先搜名字；
	$this->db->where('state','PASS');
	$this->db->where('chineseName',$keyword);
	$this->db->or_where('latinName',$keyword);
	$this->db->or_where('nickName',$keyword);
	$animal_array = $this->db->get('animal')->result_array();
	
	//再搜类别
	$this->db->like('name',$keyword);
	$class_array = $this->db->get('classify')->result_array();
	foreach ($class_array as $class){
		//echo $class['id'];
		$this->db->like('classification',$class['id']);
		$temp = $this->db->get('animal')->result_array();
		$animal_array = array_merge($animal_array,$temp);
	}
	
	//搜索地点
	$this->db->like('location',$keyword);
	$temp = $this->db->get('animal')->result_array();
	$animal_array = array_merge($animal_array,$temp);
	
	//搜索描述内容
	$this->db->like('description',$keyword);
	$temp = $this->db->get('animal')->result_array();
	$animal_array = array_merge($animal_array,$temp);
	//var_dump($class);
	//exit();
}else {
	$this->db->where('state','PASS');
	$animal_array = $this->db->get('animal')->result_array();
}
function assoc_unique($arr, $key)
{
	$id_array = array();
	$tmp = array();
	foreach($arr as $k => $v)
	{
		if(!in_array($v['id'], $id_array)){
			array_push($id_array, $v['id']);
			$tmp[] = $arr[$k];
		}
	}
 	//sort($tmp); //sort函数对数组进行排序
 	return $tmp;
}
$animal_array = assoc_unique($animal_array,'id');
//var_dump($animal_array);
foreach ($animal_array as $animal){
?>
			<tr target="animalid" rel="<?php echo $animal['id'];?>">
				<td><?php echo $animal['chineseName'];?></td>
				<td><?php echo $animal['latinName'];?></td>
				<td><?php echo $animal['uploader']?></td>
				<td><?php echo substr(strip_tags($animal['description']),0,100)?></td>
				<td><a  href="<?php echo base_url('index.php/specimen/detail/animal/'.$animal['id']);?>" target="navTab" rel="dlg_page12" title="动物标本详情"><span>查看详情</span></a></td>
			</tr>
<?php 
}
?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
共<?php echo count($animal_array)?>条</span>
		</div>
		

	</div>
</div>