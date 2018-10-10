<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/16
 * Time: 10:32
 */
session_start();
header('content-Type:text/html;charset=uft-8');
date_default_timezone_set('PRC');
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');

$total=1;   //查到结果的总页数
$page=1;    //当前页数
$offset=0;  //取数据时开始的位置
$nowpage=1; //当前页数
if(isset($_POST['num'])&& isset($_POST['page'])&&isset($_POST['search'])){
    $perPageNum=mysqli_real_escape_string($conn,$_POST['num']);
    $nowpage = mysqli_real_escape_string($conn,$_POST['page']);
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    //搜索
    $sqlSearch="CONCAT(content,intime,user_name) LIKE '%".$search."%' ";
//     取出所有数据的条数
    $sqlTotal="SELECT COUNT(id) as COUNT_TOTAL FROM msg WHERE ".$sqlSearch;
    $ret=mysqli_query($conn,$sqlTotal);
    $row=mysqli_fetch_assoc($ret);
    $totalCount=$row['COUNT_TOTAL'];
//      当前页和最大页比较  算出应该返回的数据条数
    $total=ceil($totalCount/floatval($perPageNum));   //总页数    向上取整(ceil是向上取整函数)
    if($total!=0){
        $nowpage = $total >= $nowpage ? $nowpage : $total;
        $page=$nowpage;
        $offset = ($nowpage-1) * $perPageNum;
    }
    // 正式开始取数据
    $sql="SELECT * FROM msg WHERE ".$sqlSearch." ORDER BY intime DESC limit $offset,$perPageNum";
//    $sql= "select * from msg ORDER BY id DESC limit ".$offset .",$perPageNum ";
    $ret=mysqli_query($conn,$sql);
    class data{
        public $user_name;
        public $intime;
        public $content;
    }
    $arr=array();
    while($res=mysqli_fetch_assoc($ret)){
        $user_name = $res['user_name'];           //留言人姓名
        $intime = $res['intime'];                //留言时间
        $content=$res['content'];               //留言内容

        $data=new data();
        $data ->user_name=$user_name;
        $data ->intime=$intime;
        $data ->content=$content;
        $arr[]=$data;
    }
    $resultStatus = true ;
    $resultMsg = "请求成功！";
}else{
    $resultStatus = false;
    $resultMsg = "非法访问！";
}
$reportArr = array('resultStatus'=>$resultStatus,'resultMsg'=>$resultMsg,'list'=>$arr,'page'=>$nowpage, 'total'=>$total);
$report = json_encode($reportArr);
echo $report;
?>
