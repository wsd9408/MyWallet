<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理中心-数据备份 </title>
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
     <div class="drop mTopad">
         <a href="/mywallet/index.php/admin/d_b_backup/../Consumer/addConsumer">用户</a>
         <a href="/mywallet/index.php/admin/d_b_backup/../Manager/addManager">管理员</a>
     </div>
    </li>

    <li><a href="/mywallet/index.php/admin/ClearCache/cache_clear">清除缓存</a></li>
    <li><a href="/mywallet/index.php/admin/MainPage/help">帮助</a></li>
   </ul>
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，<?php echo ($admin); ?></a>
     <div class="drop mUser">
      <a href="/mywallet/index.php/admin/Manager/editManager">编辑我的个人资料</a>
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
  <li class="cur"><a href="index.html"><i class="backup"></i><em>数据备份</em></a></li>
  <li><a href="/mywallet/index.php/admin/Manager/index"><i class="manager"></i><em>网站管理员</em></a></li>
 </ul>
</div></div>
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>数据备份</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">

    <h3><a href=" /mywallet/index.php/admin/DBBackup/index?Action=backup" class="actionBtn">添加备份</a>数据备份</h3>
     <div class="filter">
        <span>
            <a class="btnGray" href="javascript:void(0)" onclick="javascript:document.action.submit()">批量删除</a>
        </span>
     </div>
     <form name="action" method="post" action="<?php echo U('DBBackup/deleteSelect');?>" >
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
         <tr>
             <th width="22" align="center"><input name='chkall' type='checkbox'  onclick='selectcheckbox(this.form)' value='check'></th>
             <th align="center">序号</th>
             <th align="center">文件名</th>
             <th align="center">备份时间</th>
             <th align="center">文件大小</th>
             <th align="center">操作</th>
         </tr>
         <tbody>
         <?php if(!empty($lists)): if(is_array($lists)): foreach($lists as $key=>$row): if($key > 1): ?><tr>
                         <td width="22" align="center">
                             <input name="id[]" type="checkbox" id="id[]" value="<?php echo ($row); ?>">
                         </td>
                         <td align="center"><?php echo ($key-1); ?></td>
                         <td align="center"><a href="<?php echo U('DBBackup/index',array('Action'=>'download','file'=>$row));?>"><?php echo ($row); ?></a></td>
                         <td align="center"><?php echo (getfiletime($row,$datadir)); ?></td>
                         <td align="center"><?php echo (getfilesize($row,$datadir)); ?></td>
                         <td align="center">
                             <a href="<?php echo U('DBBackup/index',array('Action'=>'download','file'=>$row));?>">下载</a>
                             <a onclick="return confirm('确定将数据库还原到当前备份吗？')"href="<?php echo U('DBBackup/index',array('Action'=>'RL','File'=>$row));?>">还原</a>
                             <a onclick="return confirm('确定删除该备份文件吗？')"href="<?php echo U('DBBackup/index',array('Action'=>'Del','File'=>$row));?>">删除</a>
                         </td>
                     </tr><?php endif; endforeach; endif; ?>
             <?php else: ?>
                 <tr>
                     <td align="center" colspan="5">没有找到相关数据。</td>
                 </tr><?php endif; ?>
         </tbody>
     </table>
     </form>
     <div class="pager"><?php echo ($pageList); ?></div>

     <p>
     </p>
 </div>
 </div>

 </div>
 <div class="clear"></div>


<div class="clear"></div> </div>
</body>
</html>