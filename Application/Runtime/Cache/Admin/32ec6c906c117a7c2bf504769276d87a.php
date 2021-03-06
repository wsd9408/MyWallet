<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>管理中心</title>
    <link href="<?php echo (CSS_URL); ?>login.css" rel="stylesheet" type="text/css" media="all" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- -->
    <script>
        var __links = document.querySelectorAll('a');
        function __linkClick(e) {
            parent.window.postMessage(this.href, '*');
        };
        for (var i = 0, l = __links.length; i < l; i++) {
            if ( __links[i].getAttribute('data-t') == '_blank' ) {
                __links[i].addEventListener('click', __linkClick, false);
            }
        }
    </script>
    <link href="<?php echo (CSS_URL); ?>default.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo (CSS_URL); ?>macbook.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo (JS_URL); ?>jquery.js" type="text/javascript"></script>
    <script src="<?php echo (JS_URL); ?>raphael.js" type="text/javascript"></script>
    <script src="<?php echo (JS_URL); ?>init.js" type="text/javascript"></script>
    <script src="<?php echo (JS_URL); ?>jquery.min.js"></script>
    <script>$(document).ready(function(c) {
        $('.alert-close').on('click', function(c){
            $('.message').fadeOut('slow', function(c){
                $('.message').remove();
            });
        });
    });
    </script>
</head>
<body>
<!-- chart-->
<div id="content">
    <div class="legend">
        <h1>随时记录:</h1>
        <div class="skills">
            <ul>
                <li class="jq">出行交通</li>
                <li class="css">生活用品</li>
                <li class="html">电子设备</li>
                <li class="php">吃喝玩乐</li>
                <li class="sql">学习用品</li>
            </ul>
        </div>
    </div>
    <div id="diagram"></div>
</div>
<div class="get">
    <div class="arc">
        <span class="text">出行交通</span>
        <input type="hidden" class="percent" value="95" />
        <input type="hidden" class="color" value="#97BE0D" />
    </div>
    <div class="arc">
        <span class="text">生活用品</span>
        <input type="hidden" class="percent" value="90" />
        <input type="hidden" class="color" value="#D84F5F" />
    </div>
    <div class="arc">
        <span class="text">电子设备</span>
        <input type="hidden" class="percent" value="80" />
        <input type="hidden" class="color" value="#88B8E6" />
    </div>
    <div class="arc">
        <span class="text">吃喝玩乐</span>
        <input type="hidden" class="percent" value="53" />
        <input type="hidden" class="color" value="#BEDBE9" />
    </div>
    <div class="arc">
        <span class="text">学习用品</span>
        <input type="hidden" class="percent" value="45" />
        <input type="hidden" class="color" value="#EDEBEE" />
    </div>
</div>
<div class="clear"> </div>
<!--- footer --->
<!-- contact-form -->
<div class="message warning">
    <div class="inset">
        <div class="login-head">
            <i class="macbook"></i>
        </div>
        <form action="<?php echo U('Login/login');?>" method="post">
            <li class="li">
                <input name="username" type="text" class="text" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}"><a href="#" class=" icon user"></a>
            </li>
            <div class="clear"> </div>
            <li class="li">
                <input name="password" type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}"> <a href="#" class="icon lock"></a>
            </li>
            <div class="clear"> </div>
            <div class="submit">
                <input type="submit"  onclick="myFunction()" value="登陆" >
            </div>

        </form>
    </div>
</div>
</div>
</body>
</html>