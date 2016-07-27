<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
    <head>
        <title>找回密码</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="<?php echo (HOME_CSS_URL); ?>style.css" />
    </head>
    <body>
		<div class="wrapper">
			<div style="height:70px;"></div>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="login active" action="<?php echo U('Login/find_pwd');?>" method="post">
						<h3>找回密码</h3>
						<div>
							<label>请输入注册邮箱地址</label>
							<input type="text" name="email" />
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>验证码: </label>
							<input type="text" name="verify" /><br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<img src="<?php echo U('Login/verify');?>" id="check" onclick="picreload();">点击图片刷新
							<span class="error">This is an error</span>
						</div>
						<div class="bottom">
							<div class="remember"><input type="checkbox" /><span>记住我</span></div>
							<input type="submit" value="找回"/>
							<a href="<?php echo U('Login/index');?>" rel="register" class="linkform">点击登陆</a>
							<div class="clear"></div>
						</div>
					</form>
				</div>
				<div class="clear"></div>
			</div>
			<a class="back" href="<?php echo (SITE_URL); ?>/Admin/Login/index">登录到管理后台</a>
		</div>
		<div id="footer">
		
		</div>
<script>
	function picreload(){
		var change=document.getElementById('check');
		change.src="<?php echo U('Login/verify');?>";
	}
</script>
    </body>
</html>