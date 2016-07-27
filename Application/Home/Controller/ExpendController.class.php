<?php
namespace Home\Controller;
use Think\Controller;

/**
 * Class ExpendController
 * @package Home\Controller
 * 控制显示支出记录模板
 */
    class ExpendController extends Controller{
        public function index(){
            $this->returnUsername();
            $this->returnControllerName();
            $this->recordList();

            $this->display();
        }

        /**
         * 讲当前登录用户名传送到模板
         */
        public function returnUserName(){
            $username=$_SESSION['username'];//从SESSION中获取当前登录的用户名
            $this->assign('username',$username);
        }

        /**
         * 将当前控制器名传送到模板
         */
        public function returnControllerName(){
            $controller_name="Expend";
            $this->assign('controller_name',$controller_name);
        }

        /**
         * 删除支出记录
         */
        public function deleteRecord(){
            if (isset($_GET['record_id'])) {

                if (M('record')->where(array('record_id'=>$_GET['record_id']))->delete()) {
                    $this->url = "U(Income/index)/"; //返回链接
                    $this->refreshSum();//刷新统计表中的支出总额和收入总额
                    $this->success('删除成功，正在返回...');
                }
                else{
                    $this->error('删除失败！');
                }
            }else{
                $this->error('操作错误！');
            }
        }

        /**
         *修改支出数据
         */
        public function update(){
                $data = array(
                    'user_id'=>$_SESSION['user_id'],//从SESSION中获取当前登录的用户名
                    'money' => $_POST['money'],//从表单中获取数据
                    'record_id' => $_POST['record_id'],
                    'record_ate' => $_POST['date'],
                    'category' => $_POST['category'],
                    'remark' => $_POST['remark']
                );
                if (M('record')->where(array('record_id'=>$_POST['record_id']))->save($data)) {
                    $this->refreshSum();//刷新统计表中的支出总额和收入总额
                    $this->url = "U(Income/index)/"; //返回链接
                    $this->success('修改成功，正在返回...');
                }else{
                    $this->error('修改失败，请检查数据是否正确！');
                }
        }

        /**
         * 将全部记录经过分页处理后传送到模板
         */
        public function recordList(){
            $user_id=$_SESSION['user_id'];//从SESSION中获取当前登录的用户名
            
            //计算支出总额
            $this->sum = M('record')->where(array('user_id' => $_SESSION['user_id'],'I_E'=>'E'))->sum('money');
            $record =M('record');
            $total=$record->where("I_E='E' AND user_id='$user_id'")->count();
            $per=10;//每页显示10条

            import('Org.Util.Page');
            $page = new \Page($total,$per);
            
            //查询所有支出记录，并按日期降序和id降序排列
            $sql = "select * from wallet_record where I_E='E' AND user_id='$user_id' ORDER BY record_date desc,record_id desc  ".$page->limit;
            $info = $record -> query($sql);

            $pageList=$page->fpage();
            $this->assign('info',$info);
            $this->assign('pageList',$pageList);
            $this->assign('num',1);
        }

        /**
         * 根据查找条件将符合的记录经过分页处理后传送到模板
         */
        public function recordListCon(){
            $user_id=$_SESSION['user_id'];//从SESSION中获取当前登录的用户名
            
            //从模板表单中提取所需查看的记录类别
            $categoryCon=$_POST['categoryCon'];

            //从模板表单中提取所需查看的时间区间并整理格式
            $daterange=$_POST['daterange'];
            list($startDate,$endDate)=split('-',$daterange);
            $startDate=trim($startDate);
            $endDate=trim($endDate);

            list($sMonth,$sDay,$sYear)=split("/",$startDate);
            list($eMonth,$eDay,$eYear)=split("/",$endDate);
            $sDate=$sYear."-".$sMonth."-".$sDay;
            $eDate=$eYear."-".$eMonth."-".$eDay;

            if($categoryCon=="全部")
                $catCon="";
            else
                $catCon=" AND category= '".$categoryCon."'";


            $record =M('record');
            $this->sum =$record->where("I_E='E' AND record_date >= '$sDate' AND record_date <= '$eDate' AND user_id='$user_id'".$catCon)->sum('money');
            $total=$record->where("I_E='E' AND record_date >= '$sDate' AND record_date <= '$eDate' AND user_id='$user_id'".$catCon)->count();
            $per=10;//每页显示10条记录

            import('Org.Util.Page');
            $page = new \Page($total,$per);
            $sql = "select * from wallet_record where I_E='E' AND record_date >= '$sDate' AND record_date <= '$eDate' AND user_id='$user_id'".$catCon."ORDER BY record_date desc,record_id desc ".$page->limit;
            $info = $record -> query($sql);

            $pageList=$page->fpage();
            $this->assign('info',$info);
            $this->assign('pageList',$pageList);
            $this->assign('num',1);
            $this->assign('categoryCon',$categoryCon);
            $this->assign('startDate',$startDate);
            $this->assign('endDate',$endDate);
            $this->assign('sum',$this->sum);
        }

        /**刷新统计表中个人的收入总和和支出总和
         * 
         * @return bool
         */
        public function refreshSum(){
            $newIncome = M('record')->where(array('user_id' => $_SESSION['user_id'],'I_E'=>'I'))->sum('money');
            $income['income']=$newIncome;
            $newExpend = M('record')->where(array('user_id' => $_SESSION['user_id'],'I_E'=>'E'))->sum('money');
            $expend['expend']=$newExpend;
            if(M('statistics')->where(array('user_id' => $_SESSION['user_id']))->save($income)){
                if(M('statistics')->where(array('user_id' => $_SESSION['user_id']))->save($expend)){
                    return true;}
                else{
                    return false;
                }
            }
            else
                return false;

        }

        /**
         * 将按所需条件查询到的记录传送到模板并显示
         */
        public function findByCon(){
            $this->returnUsername();
            $this->returnControllerName();
            $this->recordListCon();
            $this->display("index");
        }
    }

?>

