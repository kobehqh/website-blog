<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/6
 * Time: 18:24
 */
session_start();
header('content-Type:text/html;charset=uft-8');
date_default_timezone_set('PRC');
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');

    if($_POST["username"]&&$_POST["pwd"] && ($_POST["imgData"])){
        $pwd = md5(mysqli_real_escape_string($conn,$_POST["pwd"]));
        $username = mysqli_real_escape_string($conn,$_POST["username"]);
        $reg_time = date("Y-m-d H:i:s");
        $imgData = $_POST["imgData"];

        if(preg_match('/^(data:\s*image\/(\w+);base64,)/',$imgData,$result)){

            $type = $result[2];
            $filename =(microtime(true)*10000).".{$type}";
            $file = "upLoadImages/".$filename;
            $put_file = file_put_contents($file,base64_decode(str_replace($result[1],"",$imgData)));
            if($put_file){
            //插入数据库的sql语句
            $sql= "INSERT INTO user_register (user_head,user_name,user_pwd,intime)VALUES ('$filename','$username','$pwd','$reg_time')";
            $ret = mysqli_query($conn,$sql);
            if($ret){
                $resultStatus = true;
                $resultMsg = "注册成功";
            }else{
                $str=mysqli_error($conn);
                $resultStatus = false;
                $resultMsg = $str;
            }
        }else{
            $resultStatus = 2;
            $resultMsg = "头像上传失败";
        }
    }else{
        $resultStatus = 1;
        $resultMsg = "图片格式错误";
    }
}else{
    $resultStatus = false;
    $resultMsg = "非法访问！";
}
$reportArr = array('resultStatus'=>$resultStatus,'resultMsg'=>$resultMsg);
$report = json_encode($reportArr);
echo $report;
?>
