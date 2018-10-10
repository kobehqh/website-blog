<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 17:01
 */
//开启session
session_start();
//设置编码
header('content-Type:text/html;charset=uft-8');
date_default_timezone_set('PRC');
//数据库连接
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');
//分页部分
//传入页码
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
$pageSize = 3;
//编写sql获取分页数据SELECT * FROM 表名 LIMIT 起始位置,显示条数
//$page=1;
//$sql = "select * from msg ORDER BY id DESC limit ".($page-1) * $pageSize .",$pageSize ";
$sql = "SELECT msg.id,msg.content,msg.intime,user_register.user_name,user_register.user_head FROM msg,user_register ";
$sql .= "WHERE msg.user_name=user_register.user_name ORDER BY id DESC limit ".($page-1) * $pageSize .",$pageSize ";
//把sql语句传送到数据中
$result = mysqli_query($conn,$sql);
//$result1 = mysqli_query($conn,$sql1);
//$row1 = mysqli_fetch_assoc($result1);
if (!$result) {
    printf("Error: %s\n", mysqli_error($result));
    exit();
}
$rows = [];
while($row = mysqli_fetch_assoc($result)){
    $rows[]=$row;
}
//$row['content'] = ubbReplace($row['content']);
//function ubbReplace($str) {
//    $str = str_replace ( ">", '<；', $str );
//    $str = str_replace ( ">", '>；', $str );
//    $str = str_replace ( "\n", '>；br/>；', $str );
//    $str = preg_replace ( "[\[em_([0-9]*)\]]", "<img src=\"/arclist/$1.gif\" />", $str );
//    return $str;
//}
//分页条
$to_sql = "select count(*) from msg";
$to_result = mysqli_fetch_array(mysqli_query($conn,$to_sql));
//var_dump($to_result);
$num = $to_result[0];
$to_page = ceil($num /$pageSize);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>总有人过着你想过的生活</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link href="css/base.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/m.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<!--    <script src="js/jquery.easyfader.min.js"></script>-->
    <script src="js/modernizr.js"></script>
    <!--WEUI JS-->
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
    <style>
        textarea::-webkit-input-placeholder{
            text-indent: 2rem;
        }
        .paging a{
            border: 1px solid gray;
            display: inline-block;
            width: 3rem;
            margin: 0 0.3rem;
        }
        .qqFace{
            margin-top: 4px;
            background: #fff;
            border: 1px #dfe6f6 solid;
        }
        .qqFace table td { padding: 0; }
        .qqFace table td img { cursor: pointer; border: 1px #fff solid; }
        .qqFace table td img:hover { border: 1px #0066cc solid; }
    </style>
</head>
<body>
<!--音乐-->
<audio src="res/music1.mp3" loop="loop" id="audio">
    Your browser does not support the audio tag.
</audio>
<?php require_once "menu.html" ?>
<div class="pagebg ab"> </div>
<div class="container">
    <h1 class="t_nav">
        <span>你，我生命中一个重要的过客，我们之所以是过客，因为你未曾会为我停留。</span>
        <p class="n2">留言</p>
    </h1>

    <div class="news_infos">
        <?php
        foreach($rows as $row){
            ?>
            <div style="width:100%;background-color: white;margin: 1rem auto 0;">
                <div style="padding: 10px;">
                    <div style="display: flex;align-items:center;justify-content: space-between">
                        <div style="padding-right: 0.5rem">
                            <img src="upLoadImages/<?php echo $row['user_head']?>" alt="" style="height: 2rem;width: 2rem;border-radius: 1rem">
                        </div>
                        <div style="width: 85%">
                            <span class="user"  style="font-size:1rem;color:#3a6ab5;"><?php echo $row['user_name']?></span>
                        </div>
                        <div style="width: 20%">
                            <?php if(isset($_SESSION['admin'])) {?>
                                <a id="delete" href="http://111.230.69.226/hqh/blog/api/apiDeleteContent.php?id=<?php echo $row['id'];?>" style="color:#00A7EB;font-size: 1rem;float: right;">删除</a>
                            <?php }?>
                        </div>
                    </div>
                    <div id="text" style="margin-top: 0.3rem;">
                        <div style="width:15%"></div>
                        <div style="color:#555;font-size:0.9rem;width: 85%" id="content">
                            <?php echo $row['content']?>
                        </div>
                    </div>
                    <div style="height: 2rem">
                        <span style="float: right"><?php echo $row["intime"]?></span>
                    </div>
                </div>

            </div>
            <?php
        }
        ?>
        <?php
        echo "<div style='text-align:center;margin:1rem auto 0' class='paging'>";
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
        echo $page_banner3;
        echo $page_banner;
        echo $page_banner4;
        echo $page_banner1;
        echo '</div>';

        ?>
        <div style="margin-top:1rem">
            <div style="text-indent: 2em">
                <textarea name="saytext" id="cont" placeholder="留下你的足迹，你的分享或许会成为别人的共鸣" cols="30" rows="10" style="display:block;font-size: 1rem;width:100%; border: 1px solid gray;margin:0 auto 1rem;float: left;padding-top:15px;overflow: hidden;text-indent:2em;"></textarea>
            </div>
            <div class="comment">
                <span class="emotion">☺表情</span></p>
            </div>
            <div>
                <?php
                if(isset($_SESSION['user_name'])){
                 ?>
                <input type="submit" style="display:block;width: 6rem;height: 2rem;border:1px solid gray;text-align: center;line-height: 1rem;background-color: gray;border-radius: 3px;color: white;float: right;-webkit-appearance: none;font-size:0.8rem;" value="发表" id="report">
                    <?php
                }else{
                ?>
                <a href="login.php" style="border-radius: 3px;float: right;display: block;width: 6rem;height: 2rem;line-height:2rem;text-align: center;background-color: gray;color: white;font-size:0.8rem">登录</a>
                <?php }?>
                <p style="float: right;font-size: 0.8rem;color: #00A7EB;line-height:2rem;padding-right:0.5rem;">留言前请先登录哦</p>
            </div>
        </div>
    </div>

    <div class="sidebar" style="float: right">
        <div class="about">
            <p class="avatar"> <img src="images/me.jpg" alt=""> </p>
            <p class="abname">华华华仔</p>
            <p class="abposition">做自己喜欢</p>
            <p class="abtext"> 一个爱打球，看书，不爱读书的文艺“小青年” </p>
        </div>
        <div class="weixin">
            <h2 class="hometitle">微信关注</h2>
            <ul>
                <img src="images/code.jpg">
            </ul>
        </div>
    </div>
</div>
<footer>
    <p>Design by 华华华仔&nbsp;&nbsp;&nbsp; <a href="#">尚未备案</a></p>
</footer>
<div class="more play" id="more"></div>
<a href="#" class="cd-top">Top</a>
</body>
<script type="text/javascript" src="js/jquery-browser.js"></script>
<script type="text/javascript" src="js/jquery.qqFace.js"></script>
<script>
    window.onload=function(){
        document.getElementById('audio').load();
        document.getElementById('audio').play();
        //      微信必须加入Weixin JSAPI的WeixinJSBridgeReady才能生效
        document.addEventListener("WeixinJSBridgeReady", function () {
            document.getElementById('audio').play();
        }, false);
    }
</script>
<script>
    var audio= document.getElementById('audio');
    $('.more').on('click',function(){
        if (audio.paused) {
            audio.play();
            $(this).addClass('play');
        } else {
            audio.pause();
            $(this).removeClass('play');
        }
    });
</script>
<script>
    $('.emotion').qqFace({
        id : 'facebox',
        assign:'cont',
        path:'arclist/'	//表情存放的路径
    });
    $("#report").click(function(){
//        $.showLoading("留言中...");
        //查看结果
        var cont = $("#cont").val();
//        $("#content").html(replace_em("<?php //echo $row['content']?>//"));
//        alert(str);
//        var cont = $("#cont").html(replace_em(str));
        $.ajax({
            url:"api/apiSaveMsg.php",
            type: "POST",
            data:{
               'content':cont
            },
            dataType:"json",
            error:function(data){
//                $.hideLoading();
                $.alert("服务器请求失败，请稍后重试");
            },
            success:function(data){
//                console.log(data.resultStatus);
                if(data.resultStatus == '1'){
                    alert(data.resultMsg);
                    window.location = "gbook.php";
                }
                if(data.resultStatus == '0'){
                    alert(data.resultMsg);
                    window.location = "gbook.php";
                }
            }
        })
    });
    function replace_em(str){

        str = str.replace(/\</g,'&lt;');

        str = str.replace(/\>/g,'&gt;');

        str = str.replace(/\n/g,'<br/>');

        str = str.replace(/\[em_([0-9]*)\]/g,'<img src="arclist/$1.gif" border="0" />');

        return str;
    }
</script>
<script>
    $("#delete").click(function(){
        alert("删除成功！")
    });
</script>
</html>
