<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/21
 * Time: 10:53
 */
session_start();
//header('Access-Control-Allow-Origin:*');
header('content-Type:text/html;charset=uft-8');
date_default_timezone_set('PRC');
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');

if(isset($_POST["username"])&&isset($_POST["pwd"])){
    $pwd = md5(mysqli_real_escape_string($conn,$_POST["pwd"]));
    $username = mysqli_real_escape_string($conn,$_POST["username"]);
//        查询数据库中用户的注册信息
    $sql = "SELECT * FROM user_register WHERE user_name = '{$username}'";
    $ret = mysqli_query($conn,$sql);
    $result_db =  mysqli_fetch_assoc($ret);
    if(!empty($result_db)){
        if($pwd != $result_db['user_pwd']){
            $resultStatus = "4";
            $resultMsg = "密码错误，请重新输入";
        }else{
            $_SESSION['user_name'] = $result_db['user_name'];
            $resultStatus = "1";
            $resultMsg = "登录成功";
        }
    }else{
//        $str=mysqli_error($conn);
        $resultStatus = "2";
        $resultMsg ='您还未注册哦';
    }
}else{
    $resultStatus = "3";
    $resultMsg = "非法访问！";
}
$reportArr = array('resultStatus'=>$resultStatus,'resultMsg'=>$resultMsg);
$report = json_encode($reportArr);
echo $report;
?>
