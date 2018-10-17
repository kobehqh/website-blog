<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 16:57
 */

session_start();
header('content-Type:text/html;charset=uft-8');
date_default_timezone_set('PRC');
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');

$ip = $_SERVER['REMOTE_ADDR'];
$reg_time = date("Y-m-d H:i:s");
$reg_time1 = date("Y-m-d H:i");
$sql = "INSERT INTO contents (ip,reg_time) VALUES ('$ip','$reg_time')";
$ret = mysqli_query($conn,$sql);
if($ret){
    $resultStatus = true;
    $resultMsg = "插入成功";
}else{
    $str=mysqli_error($conn);
    $resultStatus = false;
    $resultMsg = $str;
}
$to_sql = "select count(*) from contents";
$to_result = mysqli_fetch_array(mysqli_query($conn,$to_sql));
//var_dump($to_result);
$num = $to_result[0];
////循环对比数据表中储存的IP，如果IP存在，不再记录
//$query = mysqli_query($conn,"select * from contents where ip = '".$ip."'");
//$result_db =  mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>总有人过着你想过的生活</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="css/base.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/m.css" rel="stylesheet">
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/resLoader.js"></script>
    <script src="js/jquery.easyfader.min.js"></script>
    <script src="js/scrollReveal.js"></script>
    <script src="js/modernizr.js"></script>
    <![endif]-->
</head>
<body>
<!--音乐-->
<audio  loop="loop" id="audio">
    Your browser does not support the audio tag.
</audio>
<?php require_once "menu.html" ?>
<article>
    <!--banner begin-->
    <div class="picsbox">
        <div class="banner">
            <div id="banner" class="fader">
                <li class="slide" ><img id="pic1"><span class="imginfo">我们总说来日方长</span></li>
                <li class="slide" ><img id="pic2"><span class="imginfo">我们曾经都有一个梦</span></li>
                <li class="slide" ><img id="pic3"><span class="imginfo">四年走来，一路有你</span></li>
                <div class="fader_controls">
                    <div class="page prev" data-target="prev">&lsaquo;</div>
                    <div class="page next" data-target="next">&rsaquo;</div>
                    <ul class="pager_list">
                    </ul>
                </div>
            </div>
        </div>
        <!--banner end-->
        <div class="toppic">
            <li>
                 <i><img src="images/pic-03.jpg"></i>
                <h2>愿你我有梦为马，随处可栖</h2>
            </li>
            <li>
                <i><img src="images/zd01.jpg"></i>
                <h2>个人博客，属于我的小世界！</h2>

            </li>
        </div>
    </div>
    <div class="blank"></div>
    <!--blogsbox begin-->
    <div class="blogsbox">
        <div class="blogs" data-scroll-reveal="enter bottom over 1s" >
            <h3 class="blogtitle">愿你我可以带着最微薄的行李和最丰盛的自己在世间流浪</h3>
            <span class="blogpic"><img src="images/our.jpg" alt=""></span>
            <p class="blogtext">四年时光匆匆走过，更多的是不舍</p>
            <p class="blogtext">六人宿舍温馨小窝，我们说散就散</p>
            <p class="blogtext">三两好友，咱们江湖再见！</p>
            <div class="bloginfo">
                <ul>
                    <li class="author">华华华仔</li>
                    <li class="timer"><?php echo $reg_time1?></li>
                    <li class="view">
                        <?php
                            echo $num;
                        ?>
                        已阅读
                    </li>
<!--                    <li class="like">0</li>-->
                </ul>
            </div>
        </div>
<!--        <div class="blogs" data-scroll-reveal="enter bottom over 1s" >-->
<!--            <h3 class="blogtitle">帝国cms 首页或者列表页 实现图文不同样式调用方法</h3>-->
<!--            <p class="blogtext">如图，要实现上图效果，我采用如下方法：1、首先在数据库模型，增加字段，分别是图片2，图片3。2、增加标签模板，用if，else if 来判断，输出。思路已打开，样式调用就可以多样化啦！...</p>-->
<!--            <div class="bloginfo">-->
<!--                <ul>-->
<!--                    <li class="author">华华华仔</li>-->
<!--                    <li class="timer">2018-5-13</li>-->
<!--                    <li class="view">4567已阅读</li>-->
<!--                    <li class="like">9999</li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="blogs" data-scroll-reveal="enter bottom over 1s" >-->
<!--            <h3 class="blogtitle">别让这些闹心的套路，毁了你的网页设计</h3>-->
<!--      <span class="bplist">-->
<!--              <li><img src="images/avatar.jpg" alt=""></li>-->
<!--              <li><img src="images/toppic02.jpg" alt=""></li>-->
<!--              <li><img src="images/banner01.jpg" alt=""></li>-->
<!--      </span>-->
<!--            <p class="blogtext">如图，要实现上图效果，我采用如下方法：1、首先在数据库模型，增加字段，分别是图片2，图片3。2、增加标签模板，用if，else if 来判断，输出。思路已打开，样式调用就可以多样化啦！... </p>-->
<!--            <div class="bloginfo">-->
<!--                <ul>-->
<!--                    <li class="author">华华华仔</li>-->
<!--                    <li class="timer">2018-5-13</li>-->
<!--                    <li class="view"><span>34567</span>已阅读</li>-->
<!--                    <li class="like">9999</li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="blogs" data-scroll-reveal="enter bottom over 1s" >-->
<!--            <h3 class="blogtitle">别让这些闹心的套路，毁了你的网页设计</h3>-->
<!--            <span class="bigpic"><img src="images/toppic01.jpg" alt=""></span>-->
<!--            <p class="blogtext">如图，要实现上图效果，我采用如下方法：1、首先在数据库模型，增加字段，分别是图片2，图片3。2、增加标签模板，用if，else if 来判断，输出。思路已打开，样式调用就可以多样化啦！... </p>-->
<!--            <div class="bloginfo">-->
<!--                <ul>-->
<!--                    <li class="author">华华华仔</li>-->
<!--                    <li class="timer">2018-5-13</li>-->
<!--                    <li class="view"><span>34567</span>已阅读</li>-->
<!--                    <li class="like">9999</li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->

    </div>
    <div class="blogsbox">
        <div class="blogs" data-scroll-reveal="enter bottom over 1s" >
            <h3 class="blogtitle">街末问华龄，此间诸安宁</h3>
            <span class="blogpic"><img src="images/pic-01.jpg" alt="图片未正常显示"></span>
            <p class="blogtext">就像一次普通的相聚，我们从正荣到工程</p>
            <p class="blogtext">那天的月特别的圆，我们还是我们</p>
            <p class="blogtext">我们放荡不羁，却也抵挡不住时间</p>
            <div class="bloginfo">
                <ul>
                    <li class="author">华华华仔</li>
                    <li class="timer"><?php echo $reg_time1?></li>
                    <li class="view">
                        <?php
                        echo $num;
                        ?>
                        已阅读
                    </li>
<!--                    <li class="like">0</li>-->
                </ul>
            </div>
        </div>
    </div>
    <!--blogsbox end-->
    <div class="sidebar">
        <div class="zhuanti">
            <h2 class="hometitle">特别推荐</h2>
            <ul>
                <li> <i><img src="images/b04.jpg"></i>
                    <p>我想对你说 <span><a href="#">阅读</a></span></p>
                </li>
                <li> <i><img src="images/b05.jpg"></i>
                    <p>个人博客，属于我的小世界！ <span><a href="#">阅读</a></span></p>
                </li>
            </ul>
        </div>
<!--        <div class="tuijian">-->
<!--            <h2 class="hometitle">点击排行</h2>-->
<!--            <ul class="tjpic">-->
<!--                <i><img src="images/toppic01.jpg"></i>-->
<!--                <p><a href="#">别让这些闹心的套路，毁了你的网页设计</a></p>-->
<!--            </ul>-->
<!--            <ul class="sidenews">-->
<!--                <li> <i><img src="images/toppic01.jpg"></i>-->
<!--                    <p><a href="#">别让这些闹心的套路</a></p>-->
<!--                    <span>2018-05-13</span> </li>-->
<!--                <li> <i><img src="images/toppic02.jpg"></i>-->
<!--                    <p><a href="#">给我模板PSD源文件，我给你设计HTML！</a></p>-->
<!--                    <span>2018-05-13</span> </li>-->
<!--                <li> <i><img src="images/v1.jpg"></i>-->
<!--                    <p><a href="#">别让这些闹心的套路，毁了你的网页设计</a></p>-->
<!--                    <span>2018-05-13</span> </li>-->
<!--                <li> <i><img src="images/v2.jpg"></i>-->
<!--                    <p><a href="#">给我模板PSD源文件，我给你设计HTML！</a></p>-->
<!--                    <span>2018-05-13</span> </li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>
</article>
<footer>
    <p>Design by 华华华仔&nbsp;&nbsp;&nbsp;<a href="#">尚未备案</a></p>
</footer>
<div class="more play" id="more"></div>
<a href="#" class="cd-top">Top</a>
</body>
<script>
    var bgMusic = $("#audio");
    var loader = new resLoader({
    resources : [
                 'http://111.230.69.226/hqh/blog/res/music1.mp3',
                'http://111.230.69.226/hqh/blog/images/class.jpg',
                'http://111.230.69.226/hqh/blog/images/basketball.jpg',
                'http://111.230.69.226/hqh/blog/images/honey.jpg'
            ],
    onStart : function(total){
    console.log('start:'+total);
    },
    onProgress : function(current, total){
    console.log(current+'/'+total);
//    var percent = current/total*100;
//    $('.progressbar').css('width', percent+'%');
//    $('.progresstext .current').text(current);
//    $('.progresstext .total').text(total);
    },
    onComplete : function(total){
    alert('加载完毕:'+total+'个资源');
    }
    });
    loader.start();
//    for (var i =1;i < 4;i++){
//        console.log(i);
//        var imgId = i;
//    }
    $("#pic1").attr("src","http://111.230.69.226/hqh/blog/images/class.jpg");
    $("#pic2").attr("src","http://111.230.69.226/hqh/blog/images/basketball.jpg");
    $("#pic3").attr("src","http://111.230.69.226/hqh/blog/images/honey.jpg");
    bgMusic.attr('src',"http://111.230.69.226/hqh/blog/res/music1.mp3");
</script>
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
</html>
