<?php
namespace Home\Controller;
use Think\Controller;
class FirstPageController extends Controller
{
	public function index(){
		$this->returnUsername();
		$this->returnControllerName();
		$this->returnRemain();
		$this->display();
	}

	/**
	 * 显示到增加收入记录页面
	 */
	public function addIncome(){
		$this->returnUsername();
		$this->returnControllerName();
		$this->returnRemain();

		$this->display();
	}

	/**
	 * 显示增加支出记录页面
	 */
	public function addExpend(){
		$this->returnUsername();
		$this->returnControllerName();
		$this->returnRemain();

		$this->display();
	}

	/**
	 * 将当前登录的用户名传送到模板
	 */
	public function returnUserName(){
		$username=$_SESSION['username'];
		$this->assign('username',$username);
	}

	/**
	 * 将当前控制名传送到模板
	 */
	public function returnControllerName(){
		$controller_name="FirstPage";
		$this->assign('controller_name',$controller_name);
	}

	/**
	 * 将当前用户余额传送到模板
	 */
	public function returnRemain(){
		$user_id=$_SESSION['user_id'];
		$user = M('statistics')->where("user_id='$user_id'")->find();
		$remain=$user['income']-$user['expend'];
		$percent = (int)($remain / $user['income'] *100);
		$this->assign('remain',$remain);
		$this->assign('percent',$percent);
	}

	/**
	 * 增加一条收入记录
	 */
	public function addIncomeRecord(){
		if(M('record')->count()==0){
			$newRecord['record_id'] = 1;
		}
		$user_id=$_SESSION['user_id'];
		$newRecord['user_id']=$user_id;
		$newRecord['I_E']='I';
		$newRecord['money']=$_POST['money'];
		$newRecord['record_date']=$_POST['date'];
		$newRecord['category']=$_POST['category'];
		$newRecord['remark']=$_POST['remark'];

		$statistics=M('statistics')->where("user_id='$user_id'")->find();
		$income=$statistics['income'];
		$newStat['income']=$income+$_POST['money'];

		if (
			(M('record')->add($newRecord))
			&&(M('statistics')->where("user_id='$user_id'")->save($newStat))
			) {// 插入用户表
				$this->success('成功添加收入纪录', U('FirstPage/index'));
		}else{
			$this->error('添加失败，请重新输入你的纪录！');
		}
	}

	/**
	 * 增加一条支出记录
	 */
	public function addExpendRecord(){
		if(M('record')->count()==0){
			$newRecord['record_id'] = 1;
		}
		$user_id=$_SESSION['user_id'];
		$newRecord['user_id']=$user_id;
		$newRecord['I_E']='E';
		$newRecord['money']=$_POST['money'];
		$newRecord['record_date']=$_POST['date'];
		$newRecord['category']=$_POST['category'];
		$newRecord['remark']=$_POST['remark'];

		$statistics=M('statistics')->where("user_id='$user_id'")->find();
		$expend=$statistics['expend'];
		$newStat['expend']=$expend+$_POST['money'];

		if (
			(M('record')->add($newRecord))
			&&(M('statistics')->where("user_id='$user_id'")->save($newStat))
		) {// 插入用户表
			$this->success('成功添加收入纪录', U('FirstPage/index'));
		}else{
			$this->error('添加失败，请重新输入你的纪录！');
		}
	}
}