<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理中心</title>
<meta name="Copyright" content="Douco Design." />
<link href="<?php echo (CSS_URL); ?>public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo (JS_URL); ?>global.js"></script>
</head>
<body>
<div id="dcWrap"> <div id="dcHead">
 <div id="head">
  <div class="logo"></div>
  <div class="nav">
   <ul>
    <li class="M"><a href="JavaScript:void(0);" class="topAdd">新建</a>
     <div class="drop mTopad">
      <a href="/mywallet/index.php/admin/Consumer/addConsumer">用户</a>
      <a href="/mywallet/index.php/admin/Manager/addManager">管理员</a></div>
    </li>
    <li><a href="/mywallet/index.php/admin/ClearCache/cache_clear">清除缓存</a></li>
    <li><a href="/mywallet/index.php/admin/MainPage/help">帮助</a></li>
   </ul>
   <ul class="navRight">
    <li class="M noLeft"><a>您好，<?php echo ($admin); ?></a>
     <div class="drop mUser">
      <a href="/mywallet/index.php/admin/Manager/editManager">编辑个人资料</a>
     </div>
    </li>

    <li class="noRight"><a href="<?php echo U('MainPage/loginOut');?>">退出</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 --> <div id="dcLeft"><div id="menu">
 <ul class="top">
  <li><a href="index.html"><i class="home"></i><em>管理首页</em></a></li>
 </ul>
   <ul>
  <li><a href="/mywallet/index.php/admin/Consumer/index"><i class="product"></i><em>用户列表</em></a></li>
 </ul>
  <ul class="bot">
  <li><a href="/mywallet/index.php/admin/DBBackup/index"><i class="backup"></i><em>数据备份</em></a></li>
  <li><a href="/mywallet/index.php/admin/Manager/index"><i class="manager"></i><em>网站管理员</em></a></li>
 </ul>
</div></div>
 <div id="dcMain"> <!-- 当前位置 -->
<div id="urHere">管理中心</div>  <div id="index" class="mainBox" style="padding-top:18px;height:auto!important;height:550px;min-height:550px;">
   <div id="douApi"></div>
   <div class="indexBox">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="indexBoxTwo">
    <tr>
     <td width="65%" valign="top" class="pr">
      <div class="indexBox">
       <div class="boxTitle">基本信息</div>
       <ul>
        <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">

         <tr>
          <td>系统语言：</td>
          <td><strong><?php echo ($SYSTEN_CONFIG['SYSTEM_LANG']); ?></strong></td>
         </tr>
         <tr>
          <td>编码：</td>
          <td><strong><?php echo ($SYSTEN_CONFIG['SYSTEM_ENCODING']); ?></strong></td>
         </tr>
         <tr>
          <td>版本：</td>
          <td><strong><?php echo ($SYSTEN_CONFIG['SYSTEM_VERSION']); ?></strong></td>
         </tr>
        </table>
       </ul>
      </div>
     </td>
    </tr>
   </table>
    <div class="indexBox">
     <div class="boxTitle">客户器信息</div>
     <ul>
      <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
       <tr>
        <td width="120" valign="top">客户端系统：</td>
        <td valign="top"><?php echo ($USER_CONFIG['User_OS']); ?> </td>
        <td width="100" valign="top">客户端浏览器版本：</td>
        <td valign="top"><?php echo ($USER_CONFIG['User_BROWER']); ?></td>
       </tr>
       <tr>
        <td width="100" valign="top">客户端IP：</td>
        <td valign="top"><?php echo ($USER_CONFIG['User_IP']); ?></td>
        <td valign="top">客户端所在地址：</td>
        <td valign="top"><?php echo ($USER_CONFIG['User_ADDRESS']); ?></td>
       </tr>
      </table>
     </ul>
    </div>


   <div class="indexBox">
    <div class="boxTitle">服务器信息</div>
    <ul>
     <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
      <tr>
       <td width="120" valign="top">PHP 版本：</td>
       <td valign="top"><?php echo ($SERVER_CONFIG['SERVER_PHP_VERSION']); ?> </td>
       <td width="100" valign="top">MySQL 版本：</td>
       <td valign="top"><?php echo ($SERVER_CONFIG['SERVER_SQL_VERSION']); ?></td>
       <td width="100" valign="top">服务器操作系统：</td>
       <td valign="top"><?php echo ($SERVER_CONFIG['SERVER_OS']); ?></td>
      </tr>

      <tr>
       <td valign="top">文件上传限制：</td>
       <td valign="top"><?php echo ($SERVER_CONFIG['UPLOADLIMIT']); ?></td>
       <td valign="top">GD 库支持：</td>
       <td valign="top"><?php echo ($SERVER_CONFIG['IS_GD']); ?></td>
       <td valign="top">Web 服务器：</td>
       <td valign="top"><?php echo ($SERVER_CONFIG['WEB_SERVER']); ?></td>
      </tr>
     </table>
    </ul>
   </div>
   <div class="indexBox">
    <div class="boxTitle">系统开发</div>
    <ul>
     <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
      <tr>
       <td width="120">URL： </td>
       <td><a href="" target="_blank"></a></td>
      </tr>
      <tr>
       <td>系统开发： </td>
       <td> 杨梓浩&nbsp;&nbsp;&nbsp;王思达</td>
      </tr>
     </table>
    </ul>
   </div>
    
  </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   版权所有 © 2013-2015
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</div>
</body>
</html>