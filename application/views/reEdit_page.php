<?php 
$specimen = '';
if ($type == 'plant') {
	$this->db->where('id',$id);
	$res = $this->db->get('plant')->result_array();
	$specimen = $res[0];
}elseif ($type == 'animal') {
	$this->db->where('id',$id);
	$res = $this->db->get('animal')->result_array();
	$specimen = $res[0];
}else {exit('参数错误！');}
?>
<div class="pageContent">
	<form method="post" name="<?php echo $type;?>_info" action="index.php/specimen/update/<?php echo $type;?>/<?php echo $id;?>" class="required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>中文名</label>
				<input name="chineseName" type="text" size="30" class="required" value="<?php echo $specimen['chineseName'];?>"/>
			</p>
			<p>
				<label>拉丁名：</label>
				<input name="latinName" class="required" type="text" size="30" value="<?php echo $specimen['latinName'];?>"/>
			</p>
			<p>
				<label>别名（可选）：</label>
				<input type="text" class="" name="nickname" value="<?php echo $specimen['nickName'];?>" size="30"/>
			</p>
			<p>
				<label>采集地：</label>
				<select name="location" class="required combox">
					<option value="武汉" <?php if ($specimen['location']=='武汉'){echo 'selected';}?>>武汉</option>
					<option value="大别山" <?php if ($specimen['location']=='大别山'){echo 'selected';}?>>大别山</option>
					<option value="云南" <?php if ($specimen['location']=='云南'){echo 'selected';}?>>云南</option>
					<option value="庐山" <?php if ($specimen['location']=='庐山'){echo 'selected';}?>>庐山</option>
				</select>
			</p>
			<p><span style="color:red;">原分类信息：</span><?php
$class_array = explode('#', $specimen['classification']);
foreach ($class_array as $class){
	$this->db->where('id',$class);
	$res = $this->db->get('classify')->result_array();
	if (!empty($res)) {
		$res = $res[0];
		echo $res['name'].'--';
	}
}?></p>
			<?php if ($type == 'plant'){//植物分类?>
			<div>
				
				<label style="color:red;">请重新选择植物分类：</label>				
				<select class="combox" name="division" ref="plant_class" refUrl="index.php/api/get_sons/{value}">
					<option value="all">门</option>
					<option value="p1">被子植物门</option>
					<option value="p2">裸子植物门</option>
				</select>
				<select class="combox required" name="class" id="plant_class" ref="subplantclass" refUrl="index.php/api/get_sons/{value}">
					<option value="all">纲</option>
				</select>
				<select class="combox" name="subclass"  id="subplantclass" ref="plantfamily" refUrl="index.php/api/get_sons/{value}">
					<option value="all">亚纲</option>
				</select>
				<select class="combox" name="family" id="plantfamily" >
					<option value="all">科</option>
				</select>
			</div><?php }?>
			
			<?php if ($type == 'animal'){//动物分类?>
						<div>
				<label style="color:red;">请重新选择动物分类：</label>				
				<select class="combox" name="division" ref="animal_class" refUrl="index.php/api/get_sons/{value}">
					<option value="all">门</option>
					<option value="a001">节肢动物门</option>
					<option value="a002">脊索动物门</option>
				</select>
				<select class="combox" name="class" id="animal_class" ref="subclass" refUrl="index.php/api/get_sons/{value}">
					<option value="all">纲</option>
				</select>
				<select class="combox" name="subClass" id="subclass" ref="Superorder" refUrl="index.php/api/get_sons/{value}">
					<option value="all">亚纲</option>
				</select>
				<select class="combox" name="superOrder" id="Superorder" ref="Order" refUrl="index.php/api/get_sons/{value}">
					<option value="all">总目</option>
				</select>
				<select class="combox" name="order" id="Order" ref="subOrder" refUrl="index.php/api/get_sons/{value}">
					<option value="all">目</option>
				</select>
				<select class="combox" name="subOrder" id="subOrder" ref="family" refUrl="index.php/api/get_sons/{value}">
					<option value="all">亚目</option>
				</select>
				<select class="combox" name="family" id="family" ref="" refUrl="index.php/api/get_sons/{value}">
					<option value="all">科</option>
				</select>
			</div>
			<?php }?>
			<div class="divider"></div>
			<div class="">
				<p>标本描述(上传的单个文件最大为2048KB，图片过大请压缩！)：</p>
				<textarea class="editor required" name="content" rows="30" cols="170" 
					upLinkUrl="index.php/upload/upload_plant_media" upLinkExt="zip,rar,txt" 
					upImgUrl="index.php/upload/upload_plant_media" upImgExt="jpg,jpeg,gif,png,gif" 
					upFlashUrl="index.php/upload/upload_plant_media" upFlashExt="swf"
					upMediaUrl="index.php/upload/upload_plant_media" upMediaExt:"avi">
					<?php echo $specimen['description'];?>
					</textarea>
			</div>

		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>