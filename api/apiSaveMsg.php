<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 22:11
 */
session_start();
header('content-Type:text/html;charset=uft-8');
date_default_timezone_set('PRC');
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');

function ubbReplace($str) {
    $str = str_replace ( ">", '<;', $str );
    $str = str_replace ( ">", '>;', $str );
    $str = str_replace ( "\n", '>;br/>;', $str );
    $str = preg_replace ( "[\[em_([0-9]*)\]]", "<img src=\"./arclist/$1.gif\" />", $str );
    return $str;
}
if(isset($_POST['content'])){
    if(!empty($_POST['content'])){
        $content=ubbReplace($_POST['content']);
//        $content = mysqli_real_escape_string($conn,$_POST['content']);
        $time =date('Y-m-d H:i:s') ;
        $user_name = $_SESSION['user_name'];
        //插入数据库的sql语句
        $sql = "INSERT INTO msg (content,intime,user_name) VALUES ('{$content}','{$time}','{$user_name}')";
        $ret = mysqli_query($conn,$sql);
        if($ret){
            $resultStatus = "1";
            $resultMsg = "留言成功";
        }else{
            $str=mysqli_error($conn);
            $resultStatus = false;
            $resultMsg = $str;
        }
    }else{
        $resultStatus = "0";
        $resultMsg = "请输入留言内容哦";
    }
}else{
    $resultStatus = false;
    $resultMsg = "非法访问！";
}

$reportArr = array('resultStatus'=>$resultStatus,'resultMsg'=>$resultMsg);
$report = json_encode($reportArr);
echo $report;
?>