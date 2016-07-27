<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理中心 - 网站管理员 </title>
<meta name="Copyright" content="Douco Design." />
<link href="<?php echo (CSS_URL); ?>public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo (JS_URL); ?>global.js"></script>
</head>
<body>
<div id="dcWrap">
 <div id="dcHead">
 <div id="head">
  <div class="logo"></div>
  <div class="nav">
   <ul>
    <li class="M"><a href="JavaScript:void(0);" class="topAdd">新建</a>
     <div class="drop mTopad"><a href="/mywallet/index.php/admin/Consumer/addConsumer">用户</a>
      <a href="/mywallet/index.php/admin/Manager/addManager">管理员</a></div>
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
    <li class="noRight"><a href="/mywallet/index.php/admin/MainPage/LoginOut">退出</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 --> <div id="dcLeft"><div id="menu">
 <ul class="top">
  <li><a href="/mywallet/index.php/admin/MainPage/index"><i class="home"></i><em>管理首页</em></a></li>
 </ul>
   <ul>
  <li><a href="/mywallet/index.php/admin/Consumer/index"><i class="product"></i><em>用户列表</em></a></li>
 </ul>
     <ul class="bot">
  <li><a href="/mywallet/index.php/admin/DBBackup/index"><i class="backup"></i><em>数据备份</em></a></li>
  <li class="cur"><a href="index.html"><i class="manager"></i><em>网站管理员</em></a></li>
 </ul>
</div></div>
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>网站管理员</strong> </div>   <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3><a href="<?php echo U('Manager/addManager');?>" class="actionBtn">添加管理员</a>网站管理员</h3>

  <div class="filter">
   <form name="search" action="/mywallet/index.php/admin/Manager/recordFinder" method="post">
    <input name="keyword" type="text" class="inpMain" value="" size="20"  />
   </form>
   <a name="submit" href="javascript:void(0)" class="btnGray" onclick="javascript:document.search.submit()" >筛选</a>

    <span>
    <a class="btnGray" href="javascript:void(0)" onclick="javascript:document.action.submit()">批量删除</a>
        </span>
  </div>
  <form name="action" method="post" action="<?php echo U('Manager/deleteSelect');?>" >
   <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
     <tr>
      <th width="22" align="center"><input name='chkall' type='checkbox'  onclick='selectcheckbox(this.form)' value='check'></th>
      <th width="30" align="center">编号</th>
      <th align="center">管理员名称</th>
      <th align="center">E-mail地址</th>
      <th align="center">添加时间</th>
      <th align="center">最后登录时间</th>
      <th align="center">操作</th>
     </tr>
      <tbody>
        <?php if(is_array($param)): foreach($param as $key=>$a): ?><tr>
             <td width="22" align="center">
              <input name="id[]" type="checkbox" id="id[]" value="<?php echo ($a["user_id"]); ?>">
             </td>
             <td align="center"><?php echo ($num++); ?></td>
             <td align="center"><?php echo ($a["user_name"]); ?></td>
             <td align="center"><?php echo ($a["email"]); ?></td>
             <td align="center"><?php echo ($a["reg_time"]); ?></td>
             <td align="center"><?php echo ($a["last_login_time"]); ?></td>
            <td width="80" align="center">
             <a href="<?php echo U('Manager/editManager?user_id='.$a[user_id]);?>">编辑</a> |
             <a href="<?php echo U('Manager/delete?user_id='.$a[user_id]);?>" onclick="return confirm('确认删除？')">删除</a></td>
            </td>
           </tr><?php endforeach; endif; ?>
      </tbody>
    </table>
   </form>
 </div>
  <div class="pager"><?php echo ($pageList); ?></div>

 </div>
 <div class="clear"></div>

</div>
</body>
</html>