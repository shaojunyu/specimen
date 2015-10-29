<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>华中科技大学标本馆</title>

<link href="dwz/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<!--[if IE]>
<link href="themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->

<!--[if lte IE 9]>
<script src="js/speedup.js" type="text/javascript"></script>
<![endif]-->

<script src="dwz/js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="dwz/js/jquery.cookie.js" type="text/javascript"></script>
<script src="dwz/js/jquery.validate.js" type="text/javascript"></script>
<script src="dwz/js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="dwz/xheditor/xheditor-1.2.1.min.js" type="text/javascript"></script>
<script src="dwz/xheditor/xheditor_lang/zh-cn.js" type="text/javascript"></script>
<script src="dwz/uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>

<script src="dwz/js/dwz.min.js" type="text/javascript"></script>

<!-- 可以用dwz.min.js替换前面全部dwz.*.js (注意：替换是下面dwz.regional.zh.js还需要引入)
<script src="bin/dwz.min.js" type="text/javascript"></script>
-->
<script src="dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	DWZ.init("dwz.frag.xml", {
		loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
		keys: {statusCode:"statusCode", message:"message"}, //【可选】
		ui:{hideMode:'offsets'}, //【可选】hideMode:navTab组件切换的隐藏方式，支持的值有’display’，’offsets’负数偏移位置的值，默认值为’display’
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({themeBase:"themes"}); // themeBase 相对于index页面的主题base路径
		}
	});
});

</script>
</head>

<body scroll="no">
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<h2>华中科技大学</h2>
				<ul class="nav">
					<li><a>欢迎 <?php echo $this->session->userdata('username');?></a></li>
					<?php if (!$this->session->userdata('username')){?><li><a href="dwz/html/login_dialog.html" target="dialog" width="600">登录</a></li><?php }?>
					<?php if ($this->session->userdata('username')){?><li><a href="index.php/api/logout">退出</a></li><?php }?>
				</ul>
				<ul class="themeList" id="themeList">
					<li theme="default"><div >蓝色</div></li>
					<li theme="green"><div>绿色</div></li>
					<!--<li theme="red"><div>红色</div></li>-->
					<li theme="purple"><div>紫色</div></li>
					<li theme="silver"><div>银色</div></li>
					<li theme="azure"><div class="selected">天蓝</div></li>
				</ul>
			</div>

			<!-- navMenu -->
			
		</div>

		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar">
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

				<div class="accordion" fillSpace="sidebar">
					
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a>开放功能</a>
								<ul>
									<li><a href="index.php/specimen/plant_index" target="navTab" rel="plant_index" >植物标本</a></li>
									<li><a href="index.php/specimen/animal_index" target="navTab" rel="animal_index" >动物标本</a></li>
								</ul>
							</li>
							
							<?php if ($this->session->userdata('username')){?>
							<li><a>个人中心</a>
								<ul>
									<li><a href="index.php/person/myself" target="navTab" rel="personInfo" >个人资料</a></li>
									<li><a href="dwz/html/upload_plant.html" target="navTab" rel="upload_plant" >上传植物标本</a></li>
									<li><a href="dwz/html/upload_animal.html" target="navTab" rel="upload_animal" >上传动物标本</a></li>
								</ul>
							</li>
							<?php }?>
							
							<?php if ($this->session->userdata('usergroup') == 'admin'){?>
							<li><a>后台管理</a>
								<ul>
									<li><a href="index.php/admin/user_list" target="navTab" rel="user_list" >用户管理</a></li>
									<li><a href="index.php/admin/news_list" target="navTab" rel="news_list" >新闻管理</a></li>
									<li><a>标本管理</a>
										<ul>
										<li><a href="index.php/admin/pass_plant" target="navTab" rel="pass_plant">已通过植物标本</a></li>
										<li><a href="index.php/admin/pass_animal" target="navTab" rel="pass_animal">已通过动物标本</a></li>
										<li><a href="index.php/admin/notcheck_plant" target="navTab" rel="notcheck_plant">待审核植物标本</a></li>
										<li><a href="index.php/admin/notcheck_animal" target="navTab" rel="notcheck_animal">待审核动物标本</a></li>
										</ul>
									</li>
									
								</ul>
							</li>
							<?php }?>
						</ul>
					</div>

				</div>
			</div>
		</div>
		<div id="container">
			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">主页</span></span></a></li>
						</ul>
					</div>
				</div>
				<div class="navTab-panel tabsPageContent layoutBox">
					<div class="page unitBox">
						<div class="accountInfo">
							<div class="alertInfo">
								<p><a href="dwz/html/about.html" target="dialog">关于网站</a></p>
							</div>
							<p><span>华中科技大学数字标本馆 v1.1</span></p>
							<p>登录体验更多功能！最新更新日期2015/11/1</p>
						</div>
					
<div class="pageFormContent" layoutH="80" style="margin-right:230px">
<?php 
$CI = get_instance();
$news_array = get_instance()->db->get('news')->result_array();
if(count($news_array) >= 1){
?>
<table class="table" width="100%" layoutH="80">
		<thead>
			<tr>
				<th width="50">新闻标题</th>
				<th width="50">作者</th>
				<th width="50">发布时间</th>
				<th width="50">内容提要</th>
				<th width="50"></th>
			</tr>
		</thead>

		<tbody>
<?php 

foreach ($news_array as $news){
?>
			<tr target="newsid" rel="<?php echo $news['id'];?>">
				<td><?php echo $news['title'];?></td>
				<?php 
				$CI->db->where('username',$news['writer']);
				$r = $CI->db->get('user')->result_array()[0];
				$name = $r['name'];
				?>
				<td><?php echo $name;?></td>
				<td><?php echo $news['time']?></td>
				<td><?php echo substr(strip_tags($news['content']),0,100)?></td>
				<td><a  href="<?php echo base_url('index.php/admin/news_detail/'.$news['id']);?>" target="navTab" title="新闻详情"><span>查看详情</span></a></td>
			</tr>
<?php 
}}
?>
		</tbody>
	</table>
</div>
					
					
					</div>
					
				</div>
			</div>
		</div>

	</div>

	<div id="footer">Copyright &copy; 华中科技大学生命科学与技术学院</div>

</body>
</html>
