<?php

namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
    public function  index(){
        $this->display();
    }
    //用户登录
    public function login(){
        if (IS_POST) {
            $username = $_POST['username'];//提取用户名
            $password = md5($_POST['password'].C('HERIC')); // 提取密码并进行加密
            //账号匹配
            if ($user = M('user')->where("user_name='$username' AND password='$password' AND user_type='Admin'")->find()) {
                // 写入原来登陆信息
                $user_id = $user['user_id'];//提取用户id
                $last['login_time'] = $user['login_time']+1;//登录次数加1
                $_SESSION['last_login_time'] = $user['last_login_time'];//提取该用户上次登录时间
                $last['last_login_time'] = date("Y-m-d h:i:s");//记录当前登录时间
                M('user')->where("user_id=$user_id")->save($last);//修改数据库
                $_SESSION['admin'] = $username;
                $_SESSION['admin_id']=$user_id;
                $this->redirect('MainPage/index');
            }else{
                $this->error('登陆失败，用户名或密码错误！');
            }
        }else{
            $this->error('网页出错');
        }
    }
    // 退出
    public function logout(){
        session(null);
        $this->redirect('Login/index');
    }
}