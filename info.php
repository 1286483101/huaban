<?php
	session_start();
	
	isset($_GET['c']) ? $c = $_GET['c'] : $c = 1;
	if(isset($_SESSION['userinfo']))
		$userinfo = $_SESSION['userinfo'][0];
	else
		header("location:home.php");
	$id = $userinfo['id'];
	$username = $userinfo['username'];
	$pwd = $userinfo['pwd'];
	$H_portrait = $userinfo['H_portrait'];
	$sex = $userinfo['sex'];
	$city = $userinfo['city'];
	$birthday = $userinfo['birthday'];
	$brief = $userinfo['brief'];
	$phone = $userinfo['phone'];

	include 'php/mySql.php';
	isset($_GET['page']) ? $currentPage = $_GET['page'] : $currentPage = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="sweetAlert/sweetalert.css">
	<script src='js/jquery-3.0.0/jquery-3.0.0.js'></script>
	<script src='sweetAlert/sweetalert-dev.js'></script>
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/footer.css">
	<style>
		/*重写头部样式*/
		.header_navbar{
			background-color:white;
		}
		.header_nav a{
			color: black;
		}
		.header_nav a:first{
			color: #C90000
		}
		.logo a{
			background-image:url(img/logo.svg);
		}
		.header_search{
			display: inline-block;
		}

	/*内容区域*/
	.content{
		margin-top:48px;
		background-color: #FAFAFA;
		padding-bottom: 20px;
	}
	.bg{
		background-image: url(img/banner_4.jpg);
		background-repeat: no-repeat;
		background-position: center;
		height: 400px;
		background-size: 100%;
	}
	.top{
		width: 1250px;
		height: 200px;
		background-color: white;
		margin:0px auto;
		width: 1250px;
		margin-top: -200px;
		position: relative;
	}
	.top .avatar{
		width: 150px;
		height: 150px;
		border:10px solid white;
		background-image: url(<?php echo '.'.$H_portrait?>);
		background-size: 150px 150px;
		background-position: center;
		margin:0px auto;
		margin-top:-75px;
		position: absolute;
		left: 50%;
		margin-left: -75px;
		border-radius: 50%;
	}
	.top .title{
		text-align: center;
		position: absolute;
		top: 120px;
		font-size: 2em;
		width: 100%;
	}
	.bottom{
		width: 1250px;
		height: 63px;
		background-color: #FAFAFA;
		margin:0px auto;
		box-shadow: 2px 0px 1px 0px rgba(0,0,0,0.3),
		-2px 0px 1px 0px rgba(0,0,0,0.3),
		0px 2px 2px 0px rgba(0,0,0,0.3);
		margin-bottom: 50px;
	}
	.myinfo,.love{
		float: left;
		width: 50%;
		height: 100%;
		line-height: 63px;
		/*border:1px solid red;*/
		box-sizing: border-box;
		font-size: 1.5em;
	}
	.myinfo{
		text-align:right;
		padding-right: 30px;
	}
	.love{
		text-align: left;
		padding-left:30px;
	}

	.bottom a{
		color: black;
		cursor: pointer;
	}
	.myinfo a{
		color: #EE515D;
	}
	.myinfo_content{
		width: 990px;
		margin:0px auto;
		background: white;
		padding:30px 30px;
	}
	.love_content{
		display: none;
	}
	.info_item{
		height: 50px;
		line-height: 50px;
		font-size: 1.2em;

	}
	.info_name{
		width: 100px;
		display: inline-block;
	}
	.info_item input{
		font-size: 1.1em;
		outline: none;
		border:none;
	}
	.info_item input[type=file]{
		font-size: 0.8em;
	}
	.info_content{
		margin-left:80px;
	}
	.info_item .info_modify{
		float: right;
		outline: none;
		border:none;
		background-color: #EE515D;
		font-size: 16px;
		color: white;
		border-radius: 4px;
		display: inline-block;
		width: 50px;
		height: 30px;
		margin-top: 10px;
		cursor: pointer;

	}

	/*发现内容列表*/
		.discovery-list{
			width: 1250px;
			padding-left: 20px;
			padding-right: 20px;
			margin:20px auto;
		}
		.discovery-list:after{
			content: '';
			display: block;
			clear: both;
		}
		.discovery-list .item{
			width: 20%;
			box-sizing: border-box;
			/*height: 273px;*/
			padding-left:5px;
			padding-right:5px;
			float: left;
			margin-bottom: 20px;
		}
	/*图片与头像布局*/
		.ImgTex{
			height: 273px;
		}
		.author_info{
			border:1px solid #F2F2F2;
		}
		.author_info .title{
			text-align: center;
			font-size: 1.2em;
			height: 25px;
			line-height: 25px;
			/*padding-bottom: 10px;*/
			padding-top: 10px;
			padding-bottom: 10px;
			background-color: #FCFCFC;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}
		.author_info:after{
			content: '';
			display: block;
			clear: both;
		}
		.author_info .avatar,.author_info .a_info{
			float: left;
			height: 40px;
			box-sizing: border-box;
			/*border:1px solid red;*/
			font-size: 13px;
		}
		.avatar,.a_info{
			padding-left: 10px;
		}
		.a_info .from a{
			color: red;
		}
		.avatar img{
			width: 30px;
			height: 30px;
			border-radius: 50%;
			margin-top: 3px;
		}
		/*分页*/
		.pager{
			width: 300px;
			margin:0px auto;
			text-align: center;
		}
		.pager .item:nth-of-type(<?php echo $currentPage?>){
			color: red;
		}
		.pager .item{
			cursor: pointer;
			margin-left: 5px;
			margin-right: 5px;
			color: black;
			text-decoration: none;
		}
		.portrail{
			background-image: url(<?php echo '.'.$userinfo['H_portrait']?>);
		}
	</style>
</head>
<body>
	<div>
		<header>
			<!-- 头部导航条 -->
			<nav class="header_navbar">
				<!-- 头部导航，保证缩放居中效果 -->
				<div class="navpart">
					<!-- 左边部分 -->
					<div class="header_leftpart">
						<!-- 花瓣logo -->
						<div class="logo">
							<a href="home.php" alt="logo"></a>
						</div>
						<!-- 导航部分（发现、最新、美思...） -->
						<ul class="header_nav">
							<li><a href="">发现</a></li>
							<li><a href="">最新</a></li>
							<li><a href="">美思</a></li>
							<li>
								<a href="">
									活动
									<span class="mark">new</span>
								</a>
							</li>
							<li><a href="">教育</a></li>
						</ul>
						<!-- 导航动态搜索框 -->
						<div class="header_search">
							<form action="">
								<input type="text" size="27" placeholder="搜索你喜欢的">
								<!-- 放大镜 -->
								<a class="go"></a>
							</form>
						</div>
					</div>
					<!-- 导航条右边部分 -->
					<div class="header_rightpart">
						<div class="portrail"></div>
						<ul class="portrail_list">
							<li>
								<a onclick="person_click();">
									<img src="img/person.png" alt="" width="20px" height="20px"><span>个人信息</span>
								</a>
							</li>
							<li>
								<a onclick="love_click();">
									<img src="img/love.png" alt="" width="20px" height="20px"><span>我的收藏</span>
								</a>
							</li>
							<li>
								<a onclick="exit_click();">
									<img src="img/exit.png" alt="" width="20px" height="20px"><span>退出登录</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<div class="content">
			<div class="bg">
			</div>
			<div class="top">
				<div class="avatar"></div>
				<p class="title"><?php echo $username?></p>
			</div>
			<div class="bottom">
				<div class="myinfo"><a class="showMyInfo">个人信息</a></div>
				<div class="love"><a class="showLove">我的收藏</a></div>
			</div>
			<div class="myinfo_content">
					<div class="info_item">
						<span class="info_name">登录名：</span>
						<input class="info_content" type="text" value="<?php echo $username ?>" readonly>
<!-- 						<input class="info_modify" type="button" value="修改">
 -->					</div>
					<div class="info_item">
						<span class="info_name">密码：</span>
						<input name="pwd" class="info_content" type="text" value="<?php echo $pwd ?>">
						<input class="info_modify" type="button" value="修改">
					</div>
					<div class="info_item">
						<span class="info_name">性别：</span>
						<?php if($sex == '男'){ ?>
						<label for="male" class="info_content">男</label>
						<input  type="radio" name="sex" checked>

						<label for="female">女</label>
						<input id="female" type="radio" name="sex">	
						<input class="info_modify" type="button" value="修改">
						<?php }else{?>
						<label for="male" class="info_content">男</label>
						<input id="male" type="radio" name="sex">
						
						<label for="female">女</label>
						<input id="female" type="radio" name="sex" checked>
						<input class="info_modify" type="button" value="修改">
						<?php }?>
					</div>
					<div class="info_item">
						<form action="php/uploadFile.php" method="post" enctype="multipart/form-data"> 
							<span class="info_name">头像：</span>
                          	<img id="up_img" class="info_content" src="img/person.png" alt="" width="30px" height="30px" style="vertical-align: middle;margin-top: -5px;cursor: pointer;">
                          	<span>上传头像</span>
							<input type="file" name="portrail" id="portrail" class="info_content" hidden/> 
							<input class="info_modify" type="submit" name="submit" value="修改" /> 
						</form> 
	

					</div>
					<div class="info_item">
						<span class="info_name">所在地区：</span>
						<input name="city" class="info_content" type="text" value="<?php echo $city?>">
						<input class="info_modify" type="button" value="修改">
					</div>
					<div class="info_item">
						<span class="info_name">电话号码：</span>
						<input name="phone" class="info_content" type="text" value="<?php echo $phone?>">
						<input class="info_modify" type="button" value="修改">
					</div>
					<div class="info_item">
						<span class="info_name">个人签名：</span>
						<input name="brief" class="info_content" type="text" value="<?php echo $brief?>">
						<input class="info_modify" type="button" value="修改">
					</div>
			</div>
			<div class="love_content">
				<ul class="discovery-list">
					<?php
						$start = ($currentPage-1)*10;
						$sql = "select * from image where id in (select iid from collection where uid = $id) limit {$start},10";
						$rowCount = selectCountDB($sql);
						for($i=0;$i<$rowCount;$i++){
					?>
					<li class="item">
						<div class="ImgTex">
							<a href="<?php  
								//获取图片信息
								$sql = "select * from image where id in (select iid from collection where uid = $id) order by id asc limit {$start},10";

								$rows = selectDB($sql);
								$value = $rows[$i];
								$p_date = date('Y-m-d', $value['date']);
								//获取用户信息
								$sql = "select username,H_portrait from  user where id=$value[uid]";
								$user = selectDB($sql);
								echo "detail.php?id={$value['id']}&name={$user[0]['username']}&portrait={$user[0]['H_portrait']}&date={$p_date}&img={$value['url']}"
							?>">
								<img src="<?php 
									echo $value['url'];
								?>" alt="" height="273px" width="100%">
							</a>
						</div>
						<div class="author_info">
							<p class="title">
								<?php
									echo $value['brief'];
								?>
							</p>
							<div class="avatar">
								<a href="#">
									<img src="<?php
										echo $user[0]['H_portrait'];
									?>
									" alt="">
								</a>
							</div>
							<div class="a_info">
								<span class="from">
									来自
									<a href="#">
										<?php
											echo $user[0]['username'];
										?>
									</a>
									的收藏
								</span>
								<p class="date">
									<?php
										echo date('Y-m-d', $value['date']); 
									?>
								</p>
							</div>
						</div>
					</li>
					<?php
						}
					?>
			
				<!-- 动态生成部分 -->
				</ul>
				<div class="pager">
					<?php
						$sql = "select * from image where id in (select iid from collection where uid = $id)";
						$total = selectCountDB($sql);
						$total = ceil($total/10);
						if(!empty($total) && $total>1){
							echo "<span>&lt;</span>";
							for($i=1;$i<=$total;$i++){
								echo "<a href='?c=$c&page=$i' class='item'>$i</a>";
							}
							echo "<span>&gt;</span>";
						}
				
					?>				
				</div>
			</div>
		</div>
		<!-- 页面底部 -->
		<footer>
			<!-- info保证缩放居中 -->
			<div class="info">
				<div class="ft homepage">
					<a href="" class="title">花瓣首页</a>
					<a href="">花瓣采集工具</a>
					<a href="">花瓣官方博客</a>
				</div>
				<div class="ft contact">
					<a href="" class="title">联系与合作</a>
					<a href="">联系我们</a>
					<a href="">用户反馈</a>
					<a href="">花瓣logo标准文档</a>
				</div>
				<div class="ft client">
					<a href="" class="title">移动客户端</a>
					<a href="">花瓣iphone版</a>
					<a href="">花瓣Android版</a>
					<a href="">花瓣HD</a>
				</div>
				<div class="ft about">
					<p class="title">关注我们</p>
					<a href="">新浪微博:@花瓣网</a>
					<a href="">官方QQ:188126952</a>
					<img class="realname" src="img/sm.png" alt="">
				</div>
			</div>
			<!-- 版权信息 -->
			<div class="copyright">
				© Huaban 杭州纬聚网络有限公司|浙公网安备 33010602001878号
			</div>
		</footer>
	</div>
</body>
<script src='js/account.js'></script>

<script>
	function person_click(){
		$('.showMyInfo').trigger('click');
	}
	function love_click(){
		$('.showLove').trigger('click');
	}
	function exit_click(){
		window.location.href="php/login_out.php";
	}
	// 上传头像
	$('#up_img').on('click', function(event) {
		$('#portrail').trigger('click');
	});
	// 点击修改(头像和性别除外)
	$('.info_modify').on('click', function(event) {
		// console.log($(this).prev().val());

		var mKey = $(this).prev().attr('name');
		var mValue = null;
		if(mKey == 'portrail'){
			return;
		}
		else if(mKey == 'sex'){
			mValue = $(this).prevAll(":checked");
			if(mValue.attr("id") == 'male')
				mValue = '男';
			else
				mValue = '女';
		}
		else
			mValue = $(this).prev().val();

		var mData = {key:mKey,value:mValue};

		$.ajax({
			url: 'php/updateInfo.php',
			type: 'POST',
			dataType: 'json',
			data:mData
		})
		.done(function(data) {
			if(data.code == 0){
				showSweetAlert('修改成功');
			}
			else{
				showSweetAlert('修改失败');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	// 点击个人信息
	$('.showMyInfo').on('click', function(event) {
		$('.showMyInfo').css("color",'#EE515D');
		$('.showLove').css("color",'black');
		$('.love_content').fadeOut('fast');
		$('.myinfo_content').fadeIn('fast');
	});
	// 点击我的收藏
	$('.showLove').on('click', function(event) {
		$('.showMyInfo').css("color",'black');
		$('.showLove').css("color",'#EE515D');
		$('.myinfo_content').fadeOut('fast');
		$('.love_content').fadeIn('fast');
	});

	<?php
		if($c==1){
			echo "$('.showMyInfo').trigger('click');";
		}
		else{
			echo "$('.showLove').trigger('click');";
		}
	?>
</script>
</html>