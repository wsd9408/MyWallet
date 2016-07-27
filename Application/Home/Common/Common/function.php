<?php 
    /**
     * 发送邮件
     */
    function sendMail($to, $subject, $content) {
        vendor('phpmailer.class#phpmailer');
        $mail = new PHPMailer();
        // 装配邮件服务器
        if (C('MAIL_SMTP')) {
            $mail->IsSMTP();
        }
        $mail->Host = C('MAIL_HOST');
        $mail->SMTPAuth = C('MAIL_SMTPAUTH');
        $mail->Username = C('MAIL_USERNAME');
        $mail->Password = C('MAIL_PASSWORD');
        //$mail->SMTPSecure = C('MAIL_SECURE');
        $mail->Port     = C('MAIL_PORT');
        $mail->CharSet = C('MAIL_CHARSET');
        // 装配邮件头信息
        $mail->From = C('MAIL_USERNAME');
        $mail->AddAddress($to);
        $mail->FromName = $subject;
        $mail->IsHTML(C('MAIL_ISHTML'));
        // 装配邮件正文信息
        $mail->Subject = $subject;
        $mail->Body = $content;
        // 发送邮件
        if (!$mail->Send()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }


    /**
    * 导出数据为excel表格
    *@param $data    一个二维数组,结构如同从数据库查出来的数组
    *@param $title   excel的第一行标题,一个数组,如果为空则没有标题
    *@param $filename 下载的文件名
    *@examlpe 
    *$stu = M ('User');
    *$arr = $stu -> select();
    *exportexcel($arr,array('id','账户','密码','昵称'),'文件名!');
    */
    function exportexcel($data=array(),$title=array(),$filename='report'){
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Content-type:application/vnd.ms-excel");  
        header("Content-Disposition:attachment;filename=".$filename.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        //导出xls 开始
        if (!empty($title)){
            foreach ($title as $k => $v) {
                $title[$k]=iconv("UTF-8", "GB2312",$v);
            }
            $title= implode("\t", $title);
            echo "$title\n";
        }
        if (!empty($data)){
            foreach($data as $key=>$val){
                foreach ($val as $ck => $cv) {
                    $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
                }
                $data[$key]=implode("\t", $data[$key]);
                
            }
            echo implode("\n",$data);
        }
     }

    /********************************
    * 函数名:myreaddir($dir)
    * 作用:读取目录所有的文件名
    * 参数:$dir 目录地址
    * 返回值:文件名数组
    *********************************/
    function myreaddir($dir) {
        $handle=opendir($dir);
        $i=0;
        while($file=readdir($handle)) {
            if (($file!=".")and($file!="..")) {
                $list[$i]=$file;
                $i=$i+1;
            }
        }
        closedir($handle); 
        return $list;
    }

    // 获取文件名数组 返回文件名数组
    function getFileList($url){
        //$url = C('DB_BACKUP');
        $tmp = myreaddir($url); // 获取文件数组
        // 重组文件数组
        foreach ($tmp as $key => $value) {
            $file[$key] = array(
                'time' =>retime($value,1),
                'filename' =>$value
                );
        }
        rsort($file); // 降序排序
        return $file;
    }

    // 返回完整时间
    function retime($arr , $num){
        $name = array();
        $name = explode('_', $arr);
        $time = "$name[$num]";
        $year = "";
        for ($i=0; $i < 4; $i++) { 
            $year .= $time[$i];
        }
        $month = "";
        for ($i=4; $i < 6; $i++) { 
            $month .= $time[$i];
        }
        $day = "";
        for ($i=6; $i < 8; $i++) { 
            $day .= $time[$i];
        }
        $hour = "";
        for ($i=8; $i < 10; $i++) { 
            $hour .= $time[$i];
        }
        $minute = "";
        for ($i=10; $i < 12; $i++) { 
            $minute .= $time[$i];
        }
        $second = "";
        for ($i=12; $i < 14; $i++) { 
            $second .= $time[$i];
        }
        return $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.$second;
    }

?>