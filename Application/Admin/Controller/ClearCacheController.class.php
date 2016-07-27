<?php
/**
 * Created by PhpStorm.
 * User: Leopold
 * Date: 2016/7/1
 * Time: 13:28
 */
namespace Admin\Controller;
use Think\Controller;
class ClearCacheController extends Controller{
    public function cache_clear() {
        header("Content-type: text/html; charset=utf-8");
        //清文件缓存
        $dirs = array('Application/Runtime');
        @mkdir('Runtime',0777,true);
        //清理缓存
        foreach($dirs as $value) {
            $this->rmdirr($value);
        }
        $this->assign("jumpUrl","../MainPage/index/");
        $this->success('系统缓存清除成功！');
    }
    public function rmdirr($dirname) {
        if (!file_exists($dirname)) {
            return false;
        }
        if (is_file($dirname) || is_link($dirname)) {
            return unlink($dirname);
        }
        $dir = dir($dirname);
        if($dir){
            while (false !== $entry = $dir->read()) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }
                //递归
                $this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
            }
        }
        $dir->close();
        return rmdir($dirname);
    }

}