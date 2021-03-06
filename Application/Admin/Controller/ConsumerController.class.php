<?php
/**
 * Created by PhpStorm.
 * User: Leopold
 * Date: 2016/7/1
 * Time: 17:19
 */
namespace Admin\Controller;
use Think\Controller;
class ConsumerController extends Controller{
    public function index(){
        $this->returnAdminName();
        $this->recordList();
        $this->display();
    }
    public function returnAdminName(){
        $admin = $_SESSION['admin'];
        if(!isset($admin)&&is_null($admin)){
            $this->error('请重新登陆','../Login/index');
        }
        $this->assign('admin',$admin);
    }

    public function recordList(){
        $record = M('user');
        $total=$record->where("user_type='User'")->count();
        $per = 5;
        import('Org.Util.Page');
        $page = new \Page($total,$per);
        $sql = "select * from wallet_user where user_type='User'".$page->limit;
        $query = $record -> query($sql);
        $pageList=$page->fpage();
        $this->assign('param',$query);
        $this->assign('pageList',$pageList);
        $this->assign('num',1);
    }

    public function recordFinder(){
        $admin = $_SESSION['admin'];
        if(!isset($admin)&&is_null($admin)){
            $this->error('请重新登陆','../Login/index');
        }

        $str = $_POST['keyword'];
        if(empty($str)||is_null($str)){
            $this->recordList();
        }
        else{$user = M('user');
        $key = '%'.$str.'%';
        $map['user_type']=array('eq','User');
        $map['user_name|email|status']=array('like',$key);
        $total = $user->where($map)->count();
        $per = 5;
        import('Org.Util.Page');
        $page = new \Page($total,$per);
        $sql = "select * from wallet_user where user_type = 'User' AND (user_name like '%".$str."%' or email like '%".$str."%')".$page->limit;
        $query = $user -> query($sql);
            $pageList=$page->fpage();
        $this->assign('param',$query);
        $this->assign('pageList',$pageList);
        $this->assign('num',1);
        }
        $this->assign('admin',$admin);
        $this->display('recordFinder');
    }

    /**
     * 添加用户
     */
    public function addConsumer(){
        $admin = $_SESSION['admin'];

        if(!isset($admin)&&is_null($admin)){
            $this->error('请重新登陆','../Login/index');
        }
        $this->assign('admin',$admin);
        $this->display();
    }
    public function addUser(){
        $data['user_name'] = $_POST['user_name'];
        $data['password'] = MD5($_POST['user_password']);
        $data['email'] = $_POST['email'];
        $data['reg_time']= date('Y-m-d H:i:s');
        $data['user_type']='User';
        $data['status'] = $_POST['status'];
        $user_name= $data['user_name'];
        $user = M('user');
        $record=$user->where("user_name='$user_name'")->count();
        if($record==0) {
            if ($user->add($data)) {
                $this->success('添加用户成功', "index.html");
            } else {
                $this->error('发生未知错误，添加用户失败');
            }
        }else{
            $this->error('该用户名已经被注册，请重试','addConsumer.html');

        }
    }

    public function editDisplay(){
        $admin = $_SESSION['admin'];
        if(!isset($admin)&&is_null($admin)){
            $this->error('请重新登陆','../Login/index');
        }
        $user_id = $_GET['user_id'];
        $info = M('user')->where("user_id=$user_id")->find();
        $this->assign('admin',$admin);
        $this->assign('info',$info);

    }
    public function editConsumer(){

        $this->editDisplay();
        $this->display();
    }

    public function editUser(){
        $user = M('user');
        $data['user_id']=$_POST['user_id'];
        $id = $data['user_id'];
        $oldName =$user->where("user_id='$id'")->getField('user_name');
        $data['user_name'] = $_POST['user_name'];
        $data['password'] = $_POST['user_password'];
        $data['email']= $_POST['user_email'];
        $data['reg_time']=$_POST['reg_time'];
        $data['user_type']='User';
        $data['status'] = $_POST['user_status'];

        $user_name= $data['user_name'];

        $record=$user->where("user_name='$user_name'")->count();
        if($record==0||$oldName==$data['user_name']) {
            if ($user->save($data)) {
                $this->success('更新数据成功', "index.html");
            } else {
                $this->error('发生未知错误或者未进行数据更新，请重试');
            }
        }else{
            $this->error('该用户名已经被注册，请重试');

        }

    }

    public function delete(){
        $user_id = $_GET['user_id'];
        $user = M('user');
        $statistic = M('statistic');
        $record = M('record');
        //执行删除操作
        $user->where("user_id =$user_id")->delete();
        $statistic->where("user_id =$user_id")->delete();
        $record->where("user_id =$user_id")->delete();
        $this->success('删除成功',U('Consumer/index'));
    }

    public function deleteSelect(){
        $getId = $_POST['id'];
        if(!$getId)
            $this->error('未选择记录');
            $getids = implode(',', $getId); //选择一个以上，就用,把值连接起来(1,2,3)这样

        $id = is_array($getId) ? $getids : $getId; //如果是数组，就把用,连接起来的值覆给$id,否则就覆获取到的没有,号连接起来的值

        D("user")->execute('DELETE FROM wallet_user where user_id IN ('.$id .')');
        D("statistic")->execute('DELETE FROM wallet_record where user_id IN ('.$id .')');
        D("record")->execute('DELETE FROM wallet_statistics where user_id IN ('.$id .')');
        $this->success('删除成功');

    }
    public function loginOut(){
        session(null);
        $this->success('注销成功，即将返回登陆界面',U('Login/index'));
    }
}