<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>管理中心 - 商品列表 </title>
    <meta name="Copyright" content="Douco Design." />
    <link href="<?php echo (CSS_URL); ?>public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo (JS_URL); ?>global.js"></script>
    <script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.js"></script>
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
                            <a href="/mywallet/index.php/admin/Manager/editManager">编辑我的个人资料</a>
                        </div>
                    </li>

                    <li class="noRight"><a href="<?php echo U('Consumer/LoginOut');?>">退出</a></li>
                </ul>
            </div>

        </div>
    </div>
    <!-- dcHead 结束 --> <div id="dcLeft"><div id="menu">
    <ul class="top">
        <li><a href="/mywallet/index.php/admin/MainPage/index"><i class="home"></i><em>管理首页</em></a></li>
    </ul>
    <ul>
        <li class="cur"><a href="/mywallet/index.php/admin/Consumer/index"><i class="product"></i><em>用户列表</em></a></li>
    </ul>

    <ul class="bot">
        <li><a href="/mywallet/index.php/admin/DBBackup/index"><i class="backup"></i><em>数据备份</em></a></li>
        <li><a href="/mywallet/index.php/admin/Manager/index"><i class="manager"></i><em>网站管理员</em></a></li>
    </ul>
</div></div>
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">管理中心<b>></b><strong>用户列表</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <h3><a href="/mywallet/index.php/admin/consumer/addConsumer.html" class="actionBtn add">用户</a>用户列表</h3>
        <div class="filter">
            <form name="search" action="<?php echo U('Consumer/recordFinder');?>" method="post">
                <input name="keyword" type="text" class="inpMain" value="" size="20"  />
            </form>
            <a name="submit" href="javascript:void(0)" class="btnGray" onclick="javascript:document.search.submit()" >筛选</a>

    <span>
    <a class="btnGray" href="javascript:void(0)" onclick="javascript:document.action.submit()">批量删除</a>
        </span>
        </div>
        <form name="action" method="post" action="<?php echo U('Consumer/deleteSelect');?>" >
            <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                <thead>
                 <tr>
                    <th width="22" align="center"><input name='chkall' type='checkbox'  onclick='selectcheckbox(this.form)' value='check'></th>
                    <th width="40" align="center">编号</th>
                    <th width="50" align="center">用户名</th>
                    <th width="left" align="center">密码</th>
                    <th width="left" align="center">邮箱</th>
                    <th width="80" align="center">注册日期</th>
                    <th width="150" align="center">最近登陆时间</th>
                    <th width="50" align="center">登陆次数</th>
                    <th width="50" align="center">简单描述</th>
                    <th width="80" align="center">操作</th>
                 </tr>
                </thead>

                <?php if(is_array($param)): foreach($param as $key=>$u): ?><tr>
                    <td width="22" align="center">
                        <input name="id[]" type="checkbox" id="id[]" value="<?php echo ($u["user_id"]); ?>">
                    </td>
                    <td width="40" align="center"><?php echo ($num++); ?></td>
                    <td width="50" align="center"><?php echo ($u["user_name"]); ?></td>
                    <td width="left" align="center"><?php echo ($u["password"]); ?></td>
                    <td width="left" align="center"><?php echo ($u["email"]); ?></td>
                    <td width="80" align="center"><?php echo ($u["reg_time"]); ?></td>
                    <td width="150" align="center"><?php echo ($u["last_login_time"]); ?></td>
                    <td width="50" align="center"><?php echo ($u["login_time"]); ?></td>
                    <td width="50" align="center"><?php echo ($u["status"]); ?></td>
                    <td width="80" align="center">
                        <a href="<?php echo U('Consumer/editConsumer?user_id='.$u[user_id]);?>">编辑</a> |
                        <a href="<?php echo U('Consumer/delete?user_id='.$u[user_id]);?>" onclick="return confirm('确认删除？')">删除</a></td>
                    </td>
                    </tr><?php endforeach; endif; ?>

            </table>
        </form>
    </div>
        <div class="clear"></div>
        <div class="pager"><?php echo ($pageList); ?></div>
    </div>
</div>
<div class="clear"></div>
<div id="dcFooter">
</div>
<div class="clear"></div> </div>
</body>
</html>