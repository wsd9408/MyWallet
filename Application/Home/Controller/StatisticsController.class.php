<?php
namespace Home\Controller;
use Think\Controller;

class StatisticsController extends Controller{
    /**
     * 默认模板，显示过去一年收支总览
     */
    public function index(){
        $this->pastUsername();
        $this->pastControllerName();
        $this->month_stat_past_year();

        $this->display();
    }

    /**
     * 取出当前登录用户名并传递到显示模板
     */
    public function pastUserName(){
        $username=$_SESSION['username'];
        $this->assign('username',$username);
    }

    /**
     * 取出控制器名并传递到显示模板
     */
    public function pastControllerName(){
        $controller_name="Statistics";
        $this->assign('controller_name',$controller_name);
    }

    /**
     * 显示收入统计页面
     */
    public function Income(){
        $this->pastUsername();
        $this->pastControllerName();
        $user_id=$_SESSION['user_id'];
        $data=M('record');
        $pinMoney=$data->where("I_E='I' AND user_id='$user_id' AND category='零花钱'")->sum('money');
        $alimony=$data->where("I_E='I' AND user_id='$user_id' AND category='生活费'")->sum('money');
        $salary=$data->where("I_E='I' AND user_id='$user_id' AND category='工资'")->sum('money');
        $bonus=$data->where("I_E='I' AND user_id='$user_id' AND category='奖金'")->sum('money');
        $other=$data->where("I_E='I' AND user_id='$user_id' AND category='其他'")->sum('money');
        
        
        if($pinMoney=="")
            $pinMoney=0;
        if($alimony=="")
            $alimony=0;
        if($salary=="")
            $salary=0;
        if($bonus=="")
            $bonus=0;
        if($other=="")
            $other=0;


        $this->assign('pinMoney',$pinMoney);
        $this->assign('alimony',$alimony);
        $this->assign('bonus',$bonus);
        $this->assign('salary',$salary);
        $this->assign('other',$other);
        
        $this->display();
    }

    /**
     * 显示支出统计页面
     */
    public function Expend(){
        $this->pastUsername();
        $this->pastControllerName();
        $user_id=$_SESSION['user_id'];
        $data=M('record');
        $diet=$data->where("I_E='E' AND user_id='$user_id' AND category='饮食'")->sum('money');
        $clothing=$data->where("I_E='E' AND user_id='$user_id' AND category='服装'")->sum('money');
        $amusement=$data->where("I_E='E' AND user_id='$user_id' AND category='娱乐'")->sum('money');
        $sport=$data->where("I_E='E' AND user_id='$user_id' AND category='运动'")->sum('money');
        $traffic=$data->where("I_E='E' AND user_id='$user_id' AND category='交通'")->sum('money');
        $other=$data->where("I_E='E' AND user_id='$user_id' AND category='其他'")->sum('money');
        
        if($diet=="")
            $diet=0;
        if($clothing=="")
            $clothing=0;
        if($amusement=="")
            $amusement=0;
        if($sport=="")
            $sport=0;
        if($traffic=="")
            $traffic=0;
        if($other=="")
            $other=0;

        $this->assign('diet',$diet);
        $this->assign('clothing',$clothing);
        $this->assign('amusement',$amusement);
        $this->assign('sport',$sport);
        $this->assign('traffic',$traffic);
        $this->assign('other',$other);

        $this->display();
    }

    /**
     * 显示时间轴页面
     */
    public function TimeLine(){
        $this->pastUsername();
        $this->pastControllerName();
        $this->eachRecord();
        
        $this->display();
    }

    /**
     * 统计过去十二个月的收支数据
     */
    public function month_stat_past_year(){
        $user_id=$_SESSION['user_id'];
        $thisyear=date('Y');
        $thismonth=date('m');
        
        $monthArray[0]=$thismonth;
        
        
        $incomeData[0]=M('record')->where("user_id='$user_id' AND I_E='I' AND year(record_date)='$thisyear' AND month(record_date)='$thismonth'")->sum(money);

        for($i=1;$i<12;$i++){
            if($thismonth>1)
                $thismonth--;
            else{
                $thismonth=12;
                $thisyear--;
            }
            $incomeData[$i]=M('record')->where("user_id='$user_id' AND I_E='I' AND year(record_date)='$thisyear' AND month(record_date)='$thismonth'")->sum(money);
            if($incomeData[$i]=="")
                $incomeData[$i]=0;
            $monthArray[$i]=$thismonth;
        }

        $thisyear=date('Y');
        $thismonth=date('m');
        $expendData[0]=M('record')->where("user_id='$user_id' AND I_E='E' AND year(record_date)='$thisyear' AND month(record_date)='$thismonth'")->sum(money);
        for($i=1;$i<12;$i++){
            if($thismonth>1)
                $thismonth--;
            else{
                $thismonth=12;
                $thisyear--;
            }
            $expendData[$i]=M('record')->where("user_id='$user_id' AND I_E='E' AND year(record_date)='$thisyear' AND month(record_date)='$thismonth'")->sum(money);
            if($expendData[$i]==NULL)
                $expendData[$i]=0;
        }
        
        $this->assign("incomeData",$incomeData);
        $this->assign("expendData",$expendData);
        $this->assign("monthArray",$monthArray);
    }

    /**
     * 查询每一条收支记录
     */
    public function eachRecord(){
        $user_id=$_SESSION['user_id'];
        $record=M('record')->field("I_E,year(record_date) as year,month(record_date) as month,day(record_date) as day,money,category,remark")->where("user_id='$user_id'")->order("record_date desc,record_id desc")->select();
        foreach($record as $key=>&$value){
            if($value['i_e']=="I")
                $value['i_e']="收入";
            else
                $value['i_e']="支出";
        }

        $thisYear=date('Y');
        $this->assign("thisYear",$thisYear);
        $this->assign("record",$record);
    }
}

?>