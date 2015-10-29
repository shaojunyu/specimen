<div style="margin-left: 5px">
<br/>
新闻标题：
<?php 
$this->db->where('id',$newsid);
$res = $this->db->get('news')->result_array()[0];
echo $res['title'];
?>
<div class="divider"></div>
<span style="margin-bottom: 10px">新闻详情：</span>
<br/>
	<div style="margin-top: 10px">
	<?php 
	$content = $res['content'];
	echo $content;
	?>
	</div>
</div>

<br>
