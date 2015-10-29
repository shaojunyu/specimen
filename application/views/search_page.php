<h2 class="contentTitle">标本搜索</h2>
<div class="pageContent">
	
	<form method="post" action="index.php/specimen/search" class="pageForm required-validate" onsubmit="return validateCallback(this)">
		<div class="pageFormContent nowrap" layoutH="97">
			 	
		<fieldset>
		<legend>条件搜索（优先）</legend>
		<dl class="nowrap">
			<dt>根据标本名搜索：(中文名或拉丁名)</dt>
			<dd><textarea name="name" cols="80" rows="2" ><?php echo time();?></textarea></dd>
		</dl>
		<dl class="nowrap">
			<dt>分类搜索</dt>
				<select class="combox" name="specimen_type" ref="division" refUrl="index.php/api/get_sons/{value}/all">
					<option value="all">标本类别</option>
					<option value="animal">动物</option>
					<option value="plant">植物</option>
				</select>
				<select class="combox" name="division" id="division" ref="class" refUrl="index.php/api/get_sons/{value}/all">
					<option value="all">门</option>
				</select>
				<select class="combox" name="class" id="class" ref="subclass" refUrl="index.php/api/get_sons/{value}/all">
					<option value="all">纲</option>
				</select>
				<select class="combox" name="subClass" id="subclass" ref="Superorder" refUrl="index.php/api/get_sons/{value}/all">
					<option value="all">亚纲</option>
				</select>
				<select class="combox" name="superOrder" id="Superorder" ref="Order" refUrl="index.php/api/get_sons/{value}/all">
					<option value="all">总目</option>
				</select>
				<select class="combox" name="order" id="Order" ref="subOrder" refUrl="index.php/api/get_sons/{value}/all">
					<option value="all">目</option>
				</select>
				<select class="combox" name="subOrder" id="subOrder" ref="family" refUrl="index.php/api/get_sons/{value/all}">
					<option value="all">亚目</option>
				</select>
				<select class="combox" name="family" id="family" ref="" refUrl="index.php/api/get_sons/{value}/all">
					<option value="all">科</option>
				</select>
		</dl>
		<dl class="nowrap">
			<dt>内容关键字</dt>
			<dd><textarea name="textarea3" cols="80" rows="2"></textarea></dd>
		</dl>
	</fieldset>
			<fieldset>
		<legend>模糊搜索</legend>
		<dl class="nowrap">
			<dt>搜索内容</dt>
			<dd><textarea name="name" cols="80" rows="2" ></textarea></dd>
		</dl>
	</fieldset>
			<div class="divider"></div>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交搜索</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	
</div>


<script type="text/javascript">
function customvalidXxx(element){
	if ($(element).val() == "xxx") return false;
	return true;
}
</script>
