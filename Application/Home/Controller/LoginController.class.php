<?php

namespace Home\Controller;
use Think\Controller;

/**
 * Class LoginController
 * @package Home\Controller
 * 用户登陆 ，注册，退出，找回密码操作
 */
class LoginController extends Controller {

	// 登陆页面显示
    public function index(){
		if(empty($_COOKIE['user_id'])){  //如果用户没有选择记录登录状态
			if(empty($_SESSION['user_id'])){//如果当前SESSION没有记录登录信息
				$this->display();
			}
			else{
				$user_id=$_SESSION['user_id'];
				$user = M('user')->where("user_id='$user_id'")->find();

				$last['login_time'] = $user['login_time'] + 1;//登录次数加1
				$_SESSION['last_login_time'] = $user['last_login_time'];//提取该用户上次登录时间
				$last['last_login_time'] = date("Y-m-d h:i:s");//记录当前登录时间
				M('user')->where("user_id=$user_id")->save($last);//修改数据库

				$this->redirect('FirstPage/index');
			}
		}
		else{
			$_SESSION['user_id']=$_COOKIE['user_id'];
			$_SESSION['username']=$_COOKIE['username'];

			$user_id=$_SESSION['user_id'];
			$user = M('user')->where("user_id='$user_id'")->find();

			$last['login_time'] = $user['login_time'] + 1;//登录次数加1
			$_SESSION['last_login_time'] = $user['last_login_time'];//提取该用户上次登录时间
			$last['last_login_time'] = date("Y-m-d h:i:s");//记录当前登录时间
			M('user')->where("user_id=$user_id")->save($last);//修改数据库

			$this->redirect('FirstPage/index');
		}
    }

	/**
	 * 登录操作
	 */
	public function login(){
		if (IS_POST) {
				$username = $_POST['username'];//提取用户名
				$password = md5($_POST['password'].C('HERIC')); // 提取密码并进行加密
				//账号匹配
				if ($user = M('user')->where("user_name='$username' AND password='$password'")->find()) {
					// 写入原来登陆信息
					$user_id = $user['user_id'];//提取用户id
					$last['login_time'] = $user['login_time'] + 1;//登录次数加1
					$_SESSION['last_login_time'] = $user['last_login_time'];//提取该用户上次登录时间
					$last['last_login_time'] = date("Y-m-d h:i:s");//记录当前登录时间
					M('user')->where("user_id=$user_id")->save($last);//修改数据库
					$_SESSION['user_id'] = $user_id;//写入登陆session
					$_SESSION['username'] = $username;//写入登陆session
					if ($_POST['rmbLogin']) {
						//如果用户选择记住登录状态，则将用户id和用户名写入cookie，保存时间为一周
						cookie("user_id", $user_id,604800);
						cookie("username", $username,604800);
					}
					
					$this->redirect('FirstPage/index');//进入应用首页
				}
				else{
					$this->error('登陆失败，用户名或密码错误！');

			}
		}else{
			$this->error('网页出错');
		}
	}

	/**
	 * 用户注册
	 */
	public function register(){
		if (IS_POST) { //验证注册信息
			if ($this->check_user($_POST['username'] ,$_POST['password1'] , $_POST['password2'],$_POST['email'],$_POST['verify'])) {
				$data['user_name'] = $_POST['username'];
				$data['password'] = md5($_POST['password1'].C('HERIC'));
				$data['email'] = $_POST['email'];
				$data['user_type'] = "User";
				$data['reg_time'] = date("Y-m-d h:i:s");
				$data['last_login_time'] = date("Y-m-d h:i:s");
				$data['login_time'] = 1;
				
				if ($user_id = M('user')->add($data)) {// 插入用户表
					$stat['user_id'] = $user_id;
					if($user_id = M('statistics')->add($stat)) {//在统计表中插入新的用户数据
						$_SESSION['user_id'] = $user_id; //设置登陆
						$_SESSION['username']=$_POST['username'];
						$this->success('注册成功 ,正在登陆...！', U('FirstPage/index'));
					}
				}else{
					$this->error('注册失败，请检查你的输入数据！');
				}
				
			}
		}else{
			$this->display();
		}
	}

	/**
	 * 注销当前登录
	 */
	public function logout(){
		cookie("user_id",NULL);
		cookie("username",NULL);
		session(null);
		$this->redirect('Login/index');//返回到登录页面
	}

	/**
	 * 找回密码
	 */
	public function find_pwd(){
		if (IS_POST) {
			$email = $_POST['email'];
			if (empty($email)) { // 检查是否为空
				$this->error('该邮箱不存在，请重新填写！');
			}
			if (!M('user')->where("email = '$email'")->find()) {
				$this->error('该邮箱不存在，请重新填写！'); // 检查账号是否存在
			}else if (!$this->check_verify($_POST['verify'])) {
				$this->error('验证码错误，请重新填写！'); // 匹配验证码
			}else{// 重置密码并发送密码
				$new = 'walle'.rand(10,100);
				$data_pwd['password'] = md5($new.C('HERIC'));
				if (M('user')->where("email='$email'")->save($data_pwd)) {
					$new_pwd = $new;
					$title = 'MyWallet密码重置成功！';
					$content = '你的新密码:'.$new_pwd.'<br>'.'请及时登陆修改密码！';
					if (sendMail($email ,$title ,$content)) {
						$this->success("密码已经重置，请留意你的信箱！" ,U('Login/index'));
					}else{
						$this->error('密码重置失败,请检查你的输入！');
					}
				}else{
					$this->error('密码重置失败,请检查你的输入！');
				}
			}
		}else{
			$this->display();
		}
	}

	/**
	 * 检查注册信息合法性
	 * @param $username
	 * @param $password1
	 * @param $password2
	 * @param $email
	 * @param $verify
	 * @return bool
	 */
	protected function check_user($username , $password1 ,$password2,$email , $verify){
		if (!preg_match("/^[a-zA-Z][a-zA-Z0-9_]{3,20}$/", $username)) {
			$this->error('账户名不合法，请重新填写！');
			die();
		}else if(M('user')->where("user_name = '$username' or email='$email'")->find()){
			$this->error('账户已存在，请重新填写！');
			die();
		}else if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
			$this->error('邮箱地址不合法，请重新填写！');
			die();
		}else if ($password1!=$password2) {
			$this->error('两次密码不一致，请重新填写！');
			die();
		}else if (!$this->check_verify($verify)) {
			$this->error('验证码错误，请重新填写！');
			die();
		}else{
			return true;
		}
	}

	/**
	 * 生成验证码
	 */
	public function verify(){
		$Verify =     new \Think\Verify();
		// 验证码字体使用 ThinkPHP/Library/Think/Verify/ttfs/5.ttf
		$Verify->fontttf = '5.ttf';
		$Verify->length = 4;
		$Verify->fontSize = 30;
		$Verify->entry();
	}
	/** 
	 * 匹配验证码
	 */
	public function check_verify($code, $id = ''){
    	$verify = new \Think\Verify();
    	return $verify->check($code, $id);
	}
	
}