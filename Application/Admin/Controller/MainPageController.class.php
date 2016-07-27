<?php
/**
 * Created by PhpStorm.
 * User: Leopold
 * Date: 2016/6/30
 * Time: 20:29
 */
namespace Admin\Controller;
use Think\Controller;

class MainPageController extends Controller{
    public function index(){
        $admin = $_SESSION['admin'];
        if(!isset($admin)&&is_null($admin)){
            $this->error('请重新登陆','../Login/index');
        }
        $MYSQL_INFO=mysql_get_server_info();
        $max_upload = ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled";

        $SYSTEN_CONFIG = array("SYSTEM_LANG"=>'ZH_CN',
            "SYSTEM_ENCODING"=>'UTF-8',
            "SYSTEM_VERSION"=>'MyWallet_V_1.0');
        $SERVER_CONFIG =  array('SERVER_PHP_VERSION'=>PHP_VERSION,
            'SERVER_VERSION'=>php_uname('r'),
            'SERVER_SQL_VERSION'=>$MYSQL_INFO,
            'SERVER_OS'=>php_uname('s'),
            'WEB_SERVER'=>$_SERVER['SERVER_SOFTWARE'],
            'SERVER_LANG'=> $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'IS_GD'=>'是',
            'UPLOADLIMIT'=>$max_upload
        );
        $os = $this->getOs();
        $brower = $this->getBroswer();
        $ip = $this->getIp();
        $address = $this->getAddress();
        $USER_CONFIG = array('User_OS'=>$os,
                             'User_BROWER'=>$brower,
                             'User_IP'=>$ip,
                             'User_ADDRESS'=>$address);

        $this->assign('SYSTEN_CONFIG',$SYSTEN_CONFIG);
        $this->assign('admin',$admin);
        $this->assign('SERVER_CONFIG',$SERVER_CONFIG);
        $this->assign('USER_CONFIG',$USER_CONFIG);
        $this->display();
    }
    /**
     * 获取客户端操作系统信息包括win10
     * @param  null
     * @return string
     */
    function getOs(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $os = false;

        if (preg_match('/win/i', $agent) && strpos($agent, '95'))
        {
            $os = 'Windows 95';
        }
        else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90'))
        {
            $os = 'Windows ME';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent))
        {
            $os = 'Windows 98';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent))
        {
            $os = 'Windows Vista';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent))
        {
            $os = 'Windows 7';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent))
        {
            $os = 'Windows 8';
        }else if(preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent))
        {
            $os = 'Windows 10';#添加win10判断
        }else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent))
        {
            $os = 'Windows XP';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent))
        {
            $os = 'Windows 2000';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent))
        {
            $os = 'Windows NT';
        }
        else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent))
        {
            $os = 'Windows 32';
        }
        else if (preg_match('/linux/i', $agent))
        {
            $os = 'Linux';
        }
        else if (preg_match('/unix/i', $agent))
        {
            $os = 'Unix';
        }
        else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent))
        {
            $os = 'SunOS';
        }
        else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent))
        {
            $os = 'IBM OS/2';
        }
        else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent))
        {
            $os = 'Macintosh';
        }
        else if (preg_match('/PowerPC/i', $agent))
        {
            $os = 'PowerPC';
        }
        else if (preg_match('/AIX/i', $agent))
        {
            $os = 'AIX';
        }
        else if (preg_match('/HPUX/i', $agent))
        {
            $os = 'HPUX';
        }
        else if (preg_match('/NetBSD/i', $agent))
        {
            $os = 'NetBSD';
        }
        else if (preg_match('/BSD/i', $agent))
        {
            $os = 'BSD';
        }
        else if (preg_match('/OSF1/i', $agent))
        {
            $os = 'OSF1';
        }
        else if (preg_match('/IRIX/i', $agent))
        {
            $os = 'IRIX';
        }
        else if (preg_match('/FreeBSD/i', $agent))
        {
            $os = 'FreeBSD';
        }
        else if (preg_match('/teleport/i', $agent))
        {
            $os = 'teleport';
        }
        else if (preg_match('/flashget/i', $agent))
        {
            $os = 'flashget';
        }
        else if (preg_match('/webzip/i', $agent))
        {
            $os = 'webzip';
        }
        else if (preg_match('/offline/i', $agent))
        {
            $os = 'offline';
        }
        else
        {
            $os = '未知操作系统';
        }
        return $os;
    }
    /**
     * 获取客户端浏览器信息 添加win10 edge浏览器判断
     * @param  null
     * @author  Jea杨
     * @return string
     */
    function getBroswer(){
        $sys = $_SERVER['HTTP_USER_AGENT'];  //获取用户代理字符串
        if (stripos($sys, "Firefox/") > 0) {
            preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
            $exp[0] = "Firefox";
            $exp[1] = $b[1];  //获取火狐浏览器的版本号
        } elseif (stripos($sys, "Maxthon") > 0) {
            preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
            $exp[0] = "傲游";
            $exp[1] = $aoyou[1];
        } elseif (stripos($sys, "MSIE") > 0) {
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            $exp[0] = "IE";
            $exp[1] = $ie[1];  //获取IE的版本号
        } elseif (stripos($sys, "OPR") > 0) {
            preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
            $exp[0] = "Opera";
            $exp[1] = $opera[1];
        } elseif(stripos($sys, "Edge") > 0) {
            //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
            preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
            $exp[0] = "Edge";
            $exp[1] = $Edge[1];
        } elseif (stripos($sys, "Chrome") > 0) {
            preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
            $exp[0] = "Chrome";
            $exp[1] = $google[1];  //获取google chrome的版本号
        } elseif(stripos($sys,'rv:')>0 && stripos($sys,'Gecko')>0){
            preg_match("/rv:([\d\.]+)/", $sys, $IE);
            $exp[0] = "IE";
            $exp[1] = $IE[1];
        }else {
            $exp[0] = "未知浏览器";
            $exp[1] = "";
        }
        return $exp[0].'('.$exp[1].')';
    }

    /**
     * 获取IP
     * @return string
     */
    function getIp()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {//获取代理ip
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        }
        if (@$ip) {
            $ips = array_unshift($ips, $ip);
        }
        $count = count(@$ips);
        for ($i = 0; $i < $count; $i++) {
            if (!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i])) {//排除局域网ip
                $ip = $ips[$i];
                break;
            }
        }
        $tip = empty($_SERVER['REMOTE_ADDR']) ? $ip : $_SERVER['REMOTE_ADDR'];
        if ($tip == "127.0.0.1") {
            return $tip = "127.0.0.1";
        } else {
            return $tip;
        }
    }

    /**
     * 根据ip获得访客所在地地名
     * @param string $ip
     * @return string
     */
    function getAddress($ip=''){
        if (empty($ip)) {
            $ip =$this->getIp();
        }
        $url     = 'http://www.ip138.com/ips138.asp?ip='.$ip;
        $content = file_get_contents($url);
        if ($content) {
            preg_match('/<ul class=\"ul1\"><li>[\s|\S]*?<\/ul>/', $content, $matches);
            $ip_address = iconv('gbk', 'utf-8', @$matches[0]);
            return $ip_address;
        } else {
            return "未查到此IP对应的地址";
        }
    }

    /**
     * 清除缓存
     */
    public function cache_clear() {
        $this->deldir(TEMP_PATH);
        $this->success('清除缓存成功');
    }

    /**
     * 清除文件夹
     * @param $dir
     */
    function deldir($dir)
    {
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullpath = $dir . "/" . $file;
                if (!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }
    }

    /**
     * 退出Main界面
     */
    public function loginOut(){
        session(null);
        $this->success('注销成功，即将返回登陆界面',U('Login/index'));
    }
    public function help(){
        $admin = $_SESSION['admin'];
        if(!isset($admin)&&is_null($admin)){
            $this->error('请重新登陆','../Login/index');
        }
        $this->assign('admin',$admin);
        $this->display();
    }


}