<?php
namespace Home\Controller;
use Think\Controller;

/**
 * Class IncomeController
 * @package Home\Controller
 * 控制显示收入记录模板
 */
class IncomeController extends Controller{
        public function index(){
            $this->returnUsername();
            $this->returnControllerName();
            $this->recordList();

            $this->display();
        }

        /**
         * 将当期登录用户名传送到模板
         */
        public function returnUserName(){
            $username=$_SESSION['username'];
            $this->assign('username',$username);
        }

    /**
     * 将当前控制器名传送到模板
     */
        public function returnControllerName(){
            $controller_name="Income";
            $this->assign('controller_name',$controller_name);
        }

    /**
     * 删除一条数据
     */
    public function deleteRecord(){
        if (isset($_GET['record_id'])) {

            if (M('record')->where(array('record_id'=>$_GET['record_id']))->delete()) {
                    $this->url = "U(Income/index)/"; //返回链接
                    $this->refreshSum();
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
     * 修改数据
     */
    public function update(){
        if (IS_POST) {
            $data = array(
                'user_id'=>$_SESSION['user_id'],
                'money' => $_POST['money'],
                'record_id' => $_POST['record_id'],
                'record_date' => $_POST['date'],
                'category' => $_POST['category'],
                'remark' => $_POST['remark']
            );
            if (M('record')->where(array('record_id'=>$_POST['record_id']))->save($data)) {
                if($this->refreshSum())
                    $this->url = "U(Income/index)/"; //返回链接
                    $this->success('修改成功，正在返回...');
            }else{
                $this->error('修改失败，请检查数据是否正确！');
            }
        }else{
            $result = M('record')->where(array('record_id'=>$_POST['record_id']))->find();

            $this->assign('data' , $result);
            $this->display();
        }
    }

    /**
     * 将全部收入记录经过分页处理后传送到模板
     */
    public function recordList(){
        $user_id=$_SESSION['user_id'];
        $this->sum = M('record')->where(array('user_id' => $_SESSION['user_id'],'I_E'=>'I'))->sum('money');
        $record =M('record');
        $total=$record->where("I_E='I' AND user_id='$user_id'")->count();
        $per=10;

        import('Org.Util.Page');
        $page = new \Page($total,$per);
        $sql = "select * from wallet_record where I_E='I' AND user_id='$user_id' ORDER BY record_date desc,record_id desc ".$page->limit;
        $info = $record -> query($sql);
        
        $pageList=$page->fpage();
        $this->assign('info',$info);
        $this->assign('pageList',$pageList);
        $this->assign('num',1);
        $this->assign('sum',$this->sum);
    }

    /**
     * 将符合条件的收入记录经过分页处理后传送模板
     */
    public function recordListCon(){
        $user_id=$_SESSION['user_id'];
        $categoryCon=$_POST['categoryCon'];
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
        $this->sum =$record->where("I_E='I' AND record_date >= '$sDate' AND record_date <= '$eDate' AND user_id='$user_id'".$catCon)->sum('money');
        $total=$record->where("I_E='I' AND record_date >= '$sDate' AND record_date <= '$eDate' AND user_id='$user_id'".$catCon)->count();
        $per=10;

        import('Org.Util.Page');
        $page = new \Page($total,$per);
        $sql = "select * from wallet_record where I_E='I' AND record_date >= '$sDate' AND record_date <= '$eDate' AND user_id='$user_id'".$catCon."ORDER BY record_date desc,record_id desc ".$page->limit;
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

    /**
     * 刷新统计表中收入总额和支出总额
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
     * 将符合所需条件的结果显示到页面上
     */
    public function findByCon(){
        $this->returnUsername();
        $this->returnControllerName();
        $this->recordListCon();
        $this->display("index");
    }
}
?>