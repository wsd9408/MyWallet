<?php
namespace Admin\Controller;
use Think\Controller;
class DBBackupController extends Controller {

    public function index() {
        $DataDir = "Backup/";
        mkdir($DataDir);
        if (!empty($_GET['Action'])) {
            import("Common.Org.MySQLReback");
            $config = array(
                'host' => C('DB_HOST'),
                'port' => C('DB_PORT'),
                'userName' => C('DB_USER'),
                'userPassword' => C('DB_PWD'),
                'dbprefix' => C('DB_PREFIX'),
                'charset' => 'UTF8',
                'path' => $DataDir,
                'isCompress' => 0, //是否开启gzip压缩
                'isDownload' => 0
            );
            $mr = new MySQLReback($config);
            $mr->setDBName(C('DB_NAME'));
            if ($_GET['Action'] == 'backup') {
                $mr->backup();
                echo "<script>alert('备份数据成功');</script>";
                echo "<script>document.location.href='" . U("DBBackup/index") . "'</script>";
               // $this->success( '数据库备份成功！','index.html');
            } elseif ($_GET['Action'] == 'RL') {
                $mr->recover($_GET['File']);
                echo "<script>alert('还原数据库成功');</script>";
                echo "<script>document.location.href='" . U("DBBackup/index") . "'</script>";

            } elseif ($_GET['Action'] == 'Del') {
                if (@unlink($DataDir . $_GET['File'])) {
                    echo "<script>alert('删除成功');</script>";
                    echo "<script>document.location.href='" . U("DBBackup/index") . "'</script>";

                } else {
                    echo "<script>alert('删除失败');</script>";
                    echo "<script>document.location.href='" . U("DBBackup/index") . "'</script>";
                }
            }
            if ($_GET['Action'] == 'download') {

                function DownloadFile($fileName) {
                    ob_end_clean();
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Length: ' . filesize($fileName));
                    header('Content-Disposition: attachment; filename=' . basename($fileName));
                    readfile($fileName);
                }
                DownloadFile($DataDir . $_GET['file']);
                exit();
            }
        }
        $lists = $this->MyScandir('Backup/');
        $per = 3;
        $total = count($lists)-2;
        import('Org.Util.Page');
        $page = new \Page($total,$per);
        $pageList = $page->fpage();
        $admin = $_SESSION['admin'];

        if(!isset($admin)&&is_null($admin)){
            $this->error('请重新登陆','../Login/index');
        }
        $this->assign('admin',$_SESSION['admin']);
        $this->assign("datadir",$DataDir);
        $this->assign("lists", $lists);
        $this->assign('pageList',$pageList);
        $this->display();
    }

    private function MyScandir($FilePath = './', $Order = 0) {
        $FilePath = opendir($FilePath);
        while (false !== ($filename = readdir($FilePath))) {
            $FileAndFolderAyy[] = $filename;
        }
        $Order == 0 ? sort($FileAndFolderAyy) : rsort($FileAndFolderAyy);
        return $FileAndFolderAyy;
    }

    public function deleteSelect(){
        $DataDir = "Backup/";
        $getId = $_POST['id'];
        if(!$getId)
            $this->error('未选择记录');

        for($i=0;$i<count($getId);$i++){
            @unlink($DataDir . $getId[$i]);
        }
        echo "<script>alert('删除成功');</script>";
        echo "<script>document.location.href='" . U("DBBackup/index") . "'</script>";
    }

}

?>