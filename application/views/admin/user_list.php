<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="dwz/html/add_user.html" target="dialog" title="添加用户"><span>添加</span></a></li>
			<li><a class="delete" href="index.php/api/del_user/{userid}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="50">用户id</th>
				<th width="50">姓名</th>
				<th width="50">密码</th>
				<th width="50">用户分组</th>
			</tr>
		</thead>

		<tbody>
<?php 
//$CI = get_instance()
$user_array = get_instance()->db->get('user')->result_array();
foreach ($user_array as $user){
?>
			<tr target="userid" rel="<?php echo $user['id'];?>">
				<td><?php echo $user['username'];?></td>
				<td><?php echo $user['name'];?></td>
				<td><?php echo $user['password']?></td>
				<td><?php echo $user['group']?></td>

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
			<span>条，共${totalCount}条</span>
		</div>
		
		<div class="pagination" targetType="navTab" totalCount="200" numPerPage="20" pageNumShown="10" currentPage="1"></div>

	</div>
</div>

