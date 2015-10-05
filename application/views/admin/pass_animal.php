<div class="pageContent">
<div class="panelBar">
		<ul class="toolBar">
			<li><a class="delete" href="index.php/api/del_animal/{animalid}/pass_animal" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
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
//$CI = get_instance()
$this->db->where('state','PASS');
$animal_array = $this->db->get('animal')->result_array();
foreach ($animal_array as $animal){
?>
			<tr target="animalid" rel="<?php echo $animal['id'];?>">
				<td><?php echo $animal['chineseName'];?></td>
				<td><?php echo $animal['latinName'];?></td>
				<td><?php echo $animal['uploader']?></td>
				<td><?php echo substr(strip_tags($animal['description']),0,100)?></td>
				<td><a  href="<?php echo base_url('index.php/specimen/detail/animal/'.$animal['id']);?>/admin_check" target="navTab" rel="dlg_page12" title="动物标本详情"><span>查看详情</span></a></td>
			</tr>
<?php 
}
?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="200">200</option>
			</select>
			<span>条，共<?php echo $this->db->affected_rows()?>条</span>
		</div>
		
		<div class="pagination" targetType="navTab" totalCount="200" numPerPage="20" pageNumShown="10" currentPage="1"></div>

	</div>
</div>