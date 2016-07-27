<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理中心-添加用户 </title>
<meta name="Copyright" content="Douco Design." />
<link href="<?php echo (CSS_URL); ?>public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo (JS_URL); ?>global.js"></script>
<script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.autotextarea.js"></script>
</head>
<body>
<div id="dcWrap">
 <div id="dcHead">
 <div id="head">
  <div class="logo"></div>
  <div class="nav">
   <ul>
    <li class="M"><a href="JavaScript:void(0);" class="topAdd">新建</a>
     <div class="drop mTopad">
      <a href="/mywallet/index.php/admin/Consumer/addConsumer">用户</a>
      <a href="/mywallet/index.php/admin/Manager/addManager">管理员</a>
     </div>
    </li>
    <li><a href="/mywallet/index.php/admin/ClearCache/cache_clear">清除缓存</a></li>
    <li><a href="/mywallet/index.php/admin/MainPage/help">帮助</a></li>
   </ul>
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，<?php echo ($admin); ?></a>
     <div class="drop mUser">
      <a href="/mywallet/index.php/admin/Manager/editManager">编辑个人资料</a>
     </div>
    </li>
    <li class="noRight"><a href="/mywallet/index.php/admin/MainPage/loginOut">退出</a></li>
   </ul>
  </div>
 </div>
</div>
 <!--目录-->
    <div id="dcLeft">
      <div id="menu">
        <ul class="top">
           <li><a href="index.html"><i class="home"></i><em>管理首页</em></a></li>
       </ul>
       <ul>
            <li class="cur"><a href="/mywallet/index.php/admin/Consumer/index"><i class="product"></i><em>用户列表</em></a></li>
        </ul>
        <ul class="bot">
           <li><a href="/mywallet/index.php/admin/DBBackup/index"><i class="backup"></i><em>数据备份</em></a></li>
           <li><a href="/mywallet/index.php/admin/Manager/index"><i class="manager"></i><em>网站管理员</em></a></li>
       </ul>
       </div>
    </div>
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>用户列表</strong><b>></b><strong>添加用户</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="index.html" class="actionBtn">用户列表</a>添加用户</h3>
    <form action="/mywallet/index.php/admin/Consumer/addUser" method="post" enctype="multipart/form-data" >
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td align="right">用户名</td>
       <td>
        <input type="text" name="user_name" value="" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right">密码</td>
       <td>
        <input type="text" name="user_password"   size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right">邮箱</td>
       <td>
        <input type="text" name="email"   size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right" valign="top">用户描述</td>
       <td>
        <textarea id="content" name="status" style="width:780px;height:400px;" class="textArea"></textarea>
       </td>
      </tr>
      <tr>
       <td></td>
       <td>
        <input name="submit" class="btn" type="submit" value="提交" />
       </td>
      </tr>
     </table>
    </form>
 </div>
 </div>
 <div class="clear"></div>

<div class="clear"></div> </div>
</body>
</html>