<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
    <head>
        <title>登录</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="<?php echo (HOME_CSS_URL); ?>style.css" />
    </head>
    <body>
		<div class="wrapper">
			<div style="height:70px;"></div>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="login active" action="<?php echo U('Login/login');?>" method="post">
						<h3>登录</h3>
						<div>
							<label>用户名</label>
							<input type="text" name="username" />
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>密码: </label>
							<input type="password" name="password" />
							<span class="error">This is an error</span>
							<a href="<?php echo U('Login/find_pwd');?>" rel="forgot_password" class="forgot linkform">忘记密码&nbsp;&nbsp;?&nbsp;&nbsp;</a>
						</div>
						<div class="bottom">
							<div class="remember"><input type="checkbox" name="rmbLogin" value="1"/><span>记住我</span></div>
							<input type="submit" value="登录"/>
							<a href="<?php echo U('Login/register');?>" rel="register" class="linkform">还没有账户? 点击注册</a>
							<div class="clear"></div>
						</div>
					</form>
				</div>
				<div class="clear"></div>
			</div>
			<a class="back" href="<?php echo (SITE_URL); ?>/Admin/Login/index">登录到管理后台</a>
		</div>
		
		</div>
    </body>
</html>