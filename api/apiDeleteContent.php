<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/15
 * Time: 11:03
 */
header('content-Type:text/html;charset=uft-8');
date_default_timezone_set('PRC');
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');

$deleteId = $_GET['id'];
$sql ="DELETE FROM msg WHERE id = '{$deleteId}'";
$result = mysqli_query($conn,$sql);
if($result){
    header("Location:http://111.230.69.226/hqh/blog/adminManage.php");
}else{
    echo "<script>alert('删除失败')</script>";
}
mysqli_close($conn);
?>
