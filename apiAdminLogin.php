<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/13
 * Time: 10:33
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
    $sql = "SELECT * FROM admin WHERE user_name = '{$username}'AND user_pwd ='{$pwd}'";
    $ret = mysqli_query($conn,$sql);
    $result_db =  mysqli_fetch_assoc($ret);
    $admin = $result_db['role'];
    if(!empty($result_db)){
        if($admin == "admin"){
            $_SESSION['admin'] = $admin;
            $resultStatus = "1";
            $resultMsg ='登录成功';
        }else{
            $resultStatus = "3";
            $resultMsg =' 请确认管理员身份';
        }
    }else{
//        $str=mysqli_error($conn);
        $resultStatus = "2";
        $resultMsg ='请输入正确的用户名、密码';
    }
}else{
    $resultStatus = "3";
    $resultMsg = "非法访问！";
}
$reportArr = array('resultStatus'=>$resultStatus,'resultMsg'=>$resultMsg);
$report = json_encode($reportArr);
echo $report;
?>
