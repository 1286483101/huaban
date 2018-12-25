<?php
	session_start();
	if(isset($_SESSION['userinfo'])){
		$userinfo = $_SESSION['userinfo'][0];
	}
	isset($_GET['input']) ? $input=$_GET['input'] : $input='';
	if(empty($input)){
		$input = ' ';
	}
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
	<link rel="stylesheet" href="css/account.css">

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
		.header_rightpart .login{
			background-color:#F4F4F4;
			border:1px solid #DDDDDD;
			color:black;
		}

		/*内容部分开始*/
		.content{
			margin-top: 64px;
			margin-bottom: 10px;
		}
		/*中央大图*/
		.banner{
			height: 162px;
			background-image: url(img/search_img.jpg);
			background-repeat: no-repeat;
			background-size: 100%;
			text-align: left;
			color: white;
			/*overflow解决.title的margin-top折叠问题*/
			overflow: hidden;
		}
		.banner .title{
			font-size: 1.5em;
		}
		/*banner-title的父亲*/
		.bt{
			width: 1250px;
			margin-top: 50px;
			/*padding-left: 20%;*/
			margin-left: auto;
			margin-right: auto;
			text-align: left;
		}
/*排序*/
		.sort{
			width: 1250px;
			margin:0px auto;
			margin-top:20px;
			font-size: 1.5em;
			padding-left:10px;
		}
		.sort span{
			color: red;
		}
	/*发现内容列表*/
		.search-list{
			width: 1250px;
			padding-left: 20px;
			padding-right: 20px;
			margin:20px auto;
		}
		.search-list:after{
			content: '';
			display: block;
			clear: both;
		}
		.search-list .item{
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

		<?php 
			if(empty($userinfo)){
		?>
			.person_info{
				display: none;
			}
			.login_btn_info{
				display: block;
			}
		<?php }else{ ?>
			.person_info{
				display: block;
			}
			.portrail{
				background-image: url(<?php echo '.'.$userinfo['H_portrait']?>);
			}
			.login_btn_info{
				display: none;
			}
		<?php } ?>
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
						<div class="login_btn_info">
							<button class="register">注册</button>
							<button class="login">登录</button>
						</div>

						<div class="person_info">
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
				</div>
			</nav>
		</header>
		<div class="content">
			<div class="banner">
				<div class="bt">
					<div class="title">国内最优质图片灵感库</div>
					<div class="title">已有数百万出众网友，用花瓣网保存喜欢的图片</div>
				</div>
			</div>
			<div class="sort">
				<p>排序：<span>按日期排序</span></p>
			</div>
			<ul class="search-list">
				<?php
					include 'php/mySql.php';
					$start = ($currentPage-1)*10;
					$sql = "select * from image where name like '%$input%' order by id asc limit $start,10";
					$rowCount = selectCountDB($sql);
					for($i=0;$i<$rowCount;$i++){
				?>
				<li class="item">
					<div class="ImgTex">
						<a href="<?php 
							$sql = "select * from image where name like '%$input%' order by id asc limit {$start},10";

							$rows = selectDB($sql);
							$value = $rows[$i];
							$p_date = date('Y-m-d', $value['date']);
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
					$sql = "select * from image where name like '%$input%'";
					$total = selectCountDB($sql);
					$total = ceil($total/10);
					if(!empty($total) && $total>1){
						echo "<span>&lt;</span>";
						for($i=1;$i<=$total;$i++){
							echo "<a href='?input=$input&page=$i' class='item'>$i</a>";
						}
						echo "<span>&gt;</span>";
					}
				?>				
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
	<!-- 注册弹出页 -->
		<div class="registerModel">
			<div class="rm_content">
				<span class="closeBtn">X</span>
				<img src="img/logo.svg" alt="">
				<p>使用用户名注册</p>
				<form id="regForm" action="">
					<input name="username" class="username" type="text" placeholder="字母开头字母数字组成6-11位">
					<br>
					<input name="pwd" class="password" type="text" placeholder="字母数字下划线组成8-15位">
					<br>
					<div class="validCode">
						<input name="validCode" class="valid" type="text" placeholder="请输入验证码">
						<!-- <img src="img/yzm.gif" alt=""> -->
						<img id="validImg" onclick="changeValidCode();" src="php/validCode.php" alt="">
					</div>
					<br>
				</form>
				<button class="btn_register">注册</button>
			</div>
		</div>
	<!-- 登录弹出页 -->
		<div class="loginModel">
			<div class="lm_content">
				<span class="closeBtn_login">X</span>
				<img src="img/logo.svg" alt="">
				<p>使用第三方账号登录</p>
				<div class="other_login"></div>
				<form id="logForm" action="">
					<input name="username" class="username" type="text" placeholder="输入花瓣网账号">
					<br>
					<input name="pwd" class="password" type="text" placeholder="输入密码">
					<br>
				</form>
				<br>
				<button class="btn_login">登录</button>
				<p class="gotoReg">还没有账号<a href="#">点击注册</a></p>
			</div>
		</div>
	</div>
</body>

<script src='js/account.js'></script>
<script>
	function person_click(){
		window.location.href="info.php?c=1"; 
	}
	function love_click(){
		window.location.href="info.php?c=2"; 
	}
	function exit_click(){
		window.location.href="php/login_out.php";
	}
	$('.go').on('click', function(event) {
		var search_input = $(this).prev().val();
		window.location.href = "search.php?input="+search_input;
	});
</script>
</html>