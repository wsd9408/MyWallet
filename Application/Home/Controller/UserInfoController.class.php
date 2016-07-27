<?php
/**
 * Created by PhpStorm.
 * User: Cielo
 * Date: 2016/7/7
 * Time: 2:21
 */

namespace Home\Controller;
use Think\Controller;

class UserInfoController extends Controller{
    public function index(){
        $this->pastUserInfo();
        $this->assign("controller_name","UserInfo");
        $this->display();
    }

    public function pastUserInfo(){
        $user_name=$_SESSION['username'];


        $user_id=$_SESSION['user_id'];
        $user=M('user')->where("user_id='$user_id'")->find();


        $this->assign("username",$user_name);
        $this->assign("regTime",$user['reg_time']);
        $this->assign("logTime",$user['login_time']);
        $this->assign("lastLogTime",$user['last_login_time']);
    }

    public function updatePwd(){
        $user_id=$_SESSION['user_id'];
        $pwd1=$_POST['pwd1'];
        $pwd2=$_POST['pwd2'];
        if($pwd1==$pwd2){
            $new['password']=md5($pwd1.C('HERIC'));
            $user=M('user')->where("user_id='$user_id'")->save($new);
            $this->success('修改密码成功', U('index'));
        }
    }
}