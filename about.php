<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 17:03
 */
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>总有人过着你想过的生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/base.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/m.css" rel="stylesheet">
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.easyfader.min.js"></script>
<!--    <script src="js/scrollReveal.js"></script>-->
<!--    <script src="js/common.js"></script>-->
    <!--[if lt IE 9]>
    <script src="js/modernizr.js"></script>
    <![endif]-->
</head>
<body>
<!--音乐-->
<audio src="res/music1.mp3" loop="loop" id="audio">
    Your browser does not support the audio tag.
</audio>
<?php require_once "menu.html" ?>
<div class="pagebg ab"> </div>
<div class="container">
    <h1 class="t_nav"><span>像“草根”一样，紧贴着地面，低调的存在，冬去春来，枯荣无恙。</span><a href="index.php" class="n1">网站首页</a><a href="/" class="n2">关于我</a></h1>
    <div class="news_infos">
        <ul>
            <p>不一样的我</p>
            <h2>About my blog</h2>

        </ul>
    </div>
    <div class="sidebar">
        <div class="about">
            <p class="avatar"> <img src="images/me.jpg" alt=""> </p>
            <p class="abname">Bryant | 华华华仔</p>
            <p class="abposition">做自己喜欢</p>
            <p class="abtext"> 一个爱打球，看书，不爱读书的文艺“小青年” </p>
        </div>
        <div class="weixin" style="margin-bottom: 62px">
            <h2 class="hometitle">微信关注</h2>
            <ul>
                <img src="images/code.jpg">
            </ul>
        </div>
    </div>
</div>
<footer style="position: fixed;bottom: 0;">
    <p>Design by <a href="#">华华华仔</a>&nbsp;&nbsp;&nbsp;<a href="#">尚未备案</a></p>
</footer>
<div class="more play" id="more"></div>
<a href="#" class="cd-top">Top</a>
</body>
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
