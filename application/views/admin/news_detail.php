<textarea style="width:100%;height:200px">
<?php 
$this->db->where('id',$newsid);
$content = $this->db->get('news')->result_array()[0]['content'];
echo $content;
?>
</textarea>

<br>
