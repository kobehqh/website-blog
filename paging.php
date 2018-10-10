<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/20
 * Time: 23:01
 */
header('content-Type:text/html;charset=uft-8');
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');
/**1,传入页码**/
if(isset($_GET["p"])){
    $page = $_GET["p"];
}else{
    $page = 1;
}
$page1 = $page-1;
$page2 = $page+1;
//判断当前页数是否小于1页，则点击上一页为第一页
if($page1 <= 0){
    $page1 = 1;
}
//每页取出的条数
$pageSize = 4;
 //编写sql获取分页数据SELECT * FROM 表名 LIMIT 起始位置,显示条数
//$page=1;
 $sql = "select * from msg ORDER BY id DESC limit ".($page-1) * $pageSize .",$pageSize";
 //把sql语句传送到数据中
 $result = mysqli_query($conn,$sql);
if (!$result) {
//    printf("Error: %s\n", mysqli_error($result));
    echo mysqli_error($result);
    echo 123;
    exit();
}

 //处理数据
echo "<meta charset=\"utf-8\">";
 echo "<table border=1 cellspacing=0 width=50% style='margin: 50px auto'>";
 echo "<tr><td>ID</td><td>评价内容</td><td>评价时间</td></tr>";
 while($row = mysqli_fetch_assoc($result)){
     echo "<tr>";
     echo "<td>{$row['id']}</td>";
     echo "<td>{$row['content']}</td>";
     echo "<td>{$row['intime']}</td>";
     echo "<tr>";
 }
mysqli_free_result($result);

//分页条
$to_sql = "SELECT COUNT(*)FROM msg";
$to_result = mysqli_fetch_array(mysqli_query($conn,$to_sql));
var_dump($to_result);
$num = $to_result[0];
$to_page = ceil($num /$pageSize);
echo '<div style="text-align: center;">';
if($page>1){
    $page_banner="<a href='".$_SERVER['PHP_SELF']."?p=".$page1."'>上一页</a>";
}
$page_banner3="<a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";
$page_banner4="<a href='".$_SERVER['PHP_SELF']."?p=".$to_page."'>尾页</a>";
if($page>=$to_page){
    $page = $to_page;
    $page2 = $page;
}
$page_banner.="<a href='".$_SERVER['PHP_SELF']."?p=".$page2."'>下一页</a>";
$page_banner1="共{$to_page}页";
echo "<meta charset=\"utf-8\">";
echo $page_banner3;
echo $page_banner;
echo $page_banner4;
echo $page_banner1;

echo '</div>';

?>

