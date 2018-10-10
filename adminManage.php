<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/16
 * Time: 9:59
 */
session_start();
header('content-Type:text/html;charset=uft-8');
date_default_timezone_set('PRC');
$conn = mysqli_connect('localhost', 'root', 'qjzeWaC9LqVS') or die('连接数据库失败，请检查您的数据库配置');
mysqli_select_db($conn,'myblog');
mysqli_set_charset($conn,'utf8');
$flag = 1;
$sqlSearch="CONCAT(content,intime,user_name) LIKE '%".$search."%' ";
$sql = "SELECT id FROM msg WHERE ".$sqlSearch;

$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);
if(!$result){
    $flag = 0;
}else{
    $flag = 1;
    $result_id = $result['id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>管理员管理列表</title>
    <link rel="stylesheet" href="css/reset.css">
    <!--WEUI CSS-->
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_509679_b1wmq5ynskqhbyb9.css">
    <!--JS-->
    <script src="js/responsive.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!--WEUI JS-->
    <script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
    <style>
        body{
            background: #eeeeee;
        }
        .search{
            height:3.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color:#adadad;
        }
        .search_container{
            position: fixed;
            top: 0;
            width: 100%;
        }
        .search div:nth-child(1){
            height: 2.5rem;
            width: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eceaed;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }
        .search div:nth-child(1) i{
            color: #929093;
            font-size: 1.4rem;
        }
        .search div:nth-child(2){
            height: 2.5rem;
            width: 17rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eceaed;
            border-bottom-right-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .search div:nth-child(2) input{
            width: 100%;
            height: 100%;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: none;
            background-color: #eceaed;
            outline: none;
            font-size: 1rem;
            border-bottom-right-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .search div:nth-child(3){
            height: 2.5rem;
            width: 6rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .search div:nth-child(3) input{
            width: 100%;
            height: 100%;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 1rem;
            background-color:#3a6ab5;
            border: none;
            font-size: 1rem;
            color: #ffffff;
            margin-left: 1rem;
            outline: none;
        }
        .orderList_container{
            /*min-height: 43rem;*/
            /*width: 26.6666666rem;*/
            width: 100%;
            margin: auto;
        }
        .not_find{
            width: 100%;
            display: none;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 35%;
            text-align: center;
        }
        .not_find p{
            text-align: center;
            font-size: 1rem;
            margin-top: 1rem;
        }
        .final{
            display: none;
            align-items: center;
            justify-content: center;
            width: 100%;
            color: #999;
            padding: 1rem 0;
            text-align: center;
            margin-bottom: 3rem;
        }
        .final p{
            font-size: 0.8rem;
            padding:0 1rem
        }
        .final .line{
            width: 5rem;
            height: 1px;
            background: #e2e2e2;
        }
        .orderList_container ul:first-child{
            margin-top: 2.5rem;
        }
    </style>
</head>
<body>
<div class="search_container">
    <div class="search">
        <div><i class="iconfont icon-soushuo"></i></div>
        <div><input type="search" placeholder="搜索留言" id="content"/></div>
        <div ><input id="search" type="button" value="搜索"></div>
    </div>
</div>
<div class="orderList_container">
    <ul style="list-style-type: none;padding: 1rem">
    </ul>
    <div class="not_find">
        <div><img src="images/no.png" style="width: 6rem" /></div>
        <p>没有留言信息</p>
    </div>
    <div class="final">
        <div class="line"></div>
        <p>已经加载完啦</p>
        <div class="line"></div>
    </div>

</div>

</body>
<script src="js/template-web.js"></script>
<script id="msg" type="text/html">
    {{each list as value }}
    <li>
        <div style="width:100%;background-color: white;margin: 1rem auto 0;">
            <div style="padding: 10px;">
                <div style="display: flex;align-items:center;justify-content: space-between">
                    <div style="width: 80%">
                        <span class="user"  style="font-size:1rem;color:#3a6ab5;">{{value.user_name}}</span>
                    </div>
                    <div style="width: 20%">
                        <?php if(isset($_SESSION['admin'])) {?>
                            <a id="delete" href="http://111.230.69.226/hqh/blog/api/apiDeleteContent.php?id=<?php echo $result_id;?>" style="color:#00A7EB;font-size: 1rem;float: right;">删除</a>
                        <?php }?>
                    </div>
                </div>
                <div id="text">
                    <div style="color:#555;font-size:0.9rem;" id="content">
                        {{value.content}}
                    </div>
                </div>
                <div style="height: 2rem">
                    <span style="float: right">{{value.intime}}</span>
                </div>
            </div>
        </div>
    </li>
    {{/each}}
</script>
<script>
    //分页加载数据
    var url="./api/apiAdminManage.php";
    var page=1;
    var num=10;
    var total=1;
    var loading=false;
    var search = '';
    onLoad(url);
    $('#search').click(function(){
        page=1;
        loading=false;
        search=$("#content").val();
        console.log(search);
        $.showLoading("正在获取");
        onLoad(url);

    });
    //下拉刷新加载数据
    $("body").infinite().on("infinite", function () {
        if (loading) return;
        loading = true;
        setTimeout(function (){
            //加载
            page++;
            if (page > total && page !=1) {
                $(".final").css('display','flex');
                return;
            }
            $.showLoading("正在获取...");
            onLoad(url);
            loading = false;
        }, 50);
    });
    //封装函数 ajax
    function onLoad(url){
        $(".not_find").hide();//把没有留言的情况提示隐藏掉
        $.ajax({
            url:url,
            type:"POST",
            data:{
                page:page,
                num:num,
                search:search
            },
            dataType:"json",
            error: function() {
                $.alert("服务器错误");
            },
            success:function(msg){
                $.hideLoading();
                console.log(msg);
                total = msg.total;                //返回当前总页数
                page = msg.page;                  //返回当前页
                console.log(total);
                console.log(page);
                var html = template('msg', msg);
                if(page == 1 && total > 0 ){
                    $(".orderList_container ul").html(html);
                }else if(page > 1 && total > 0){
                    $(".orderList_container ul").append(html);
                }else{
                    $(".orderList_container ul li").html("");
                    $(".final").css('display','none');
                    $(".not_find").css('display','block');
                }
            }
        })
    }
</script>
</html>