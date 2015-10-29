<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="dwz/html/add_news.html" target="navTab" title="添加新闻"><span>添加</span></a></li>
			<li><a class="delete" href="index.php/api/del_news/{newsid}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="80">
		<thead>
			<tr>
				<th width="50">标题</th>
				<th width="50">作者</th>
				<th width="50">时间</th>
				<th width="50">内容提要</th>
				<th width="50"></th>
			</tr>
		</thead>

		<tbody>
<?php 
//$CI = get_instance()
$news_array = get_instance()->db->get('news')->result_array();
foreach ($news_array as $news){
?>
			<tr target="newsid" rel="<?php echo $news['id'];?>">
				<td><?php echo $news['title'];?></td>
				<td><?php echo $news['writer'];?></td>
				<td><?php echo $news['time']?></td>
				<td><?php echo substr(strip_tags($news['content']),0,100)?></td>
				<td><a  href="<?php echo base_url('index.php/admin/news_detail/'.$news['id']);?>" target="navTab" title="新闻详情"><span>查看详情</span></a></td>
			</tr>
<?php 
}
?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>共<?php echo $this->db->affected_rows()?>条</span>
		</div>
		

	</div>
</div>

