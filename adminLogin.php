<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/13
 * Time: 10:32
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>管理员登录</title>
    <!--WEUI CSS-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/layui/css/layui.css">
    <!--JS-->
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <!--WEUI JS-->
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
    <script src="js/vue.js"></script>
    <script type="text/javascript" src="plugins/layui/layui.all.js"></script>
    <style>
        *{
            padding: 0;
            margin:0 ;
        }
        body{
            background-color: #01AAED;
            width: 100%;
            height: 100%;
        }
        .main{
            width: 500px;
            height: 210px;
            margin: 0;
            border-radius: 5px;
            box-shadow:5px 5px 20px #444444;
            background-color: white;
            padding: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>
    <link rel="stylesheet" href="css/m.css">
</head>
<body>
<div class="main" id="main">
    <div class="layui-form-item" style="color:gray;text-align: center">
        <h2>管理员登录</h2>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="text-align: center">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="username" v-model="name" id="username" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="text-align: center">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
        <div class="layui-input-block">
            <input type="password" v-model="pwd" name="password" id="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input" >
        </div>
    </div>
    <button class="layui-btn layui-btn-lg layui-btn-normal" style="display:block;margin: 28px auto;width: 4.2rem;height: 1.6rem;font-size: 0.7rem; line-height: 1.6rem;" id="dL" v-on:click="check">登录</button>
</div>
</body>
<script type="text/javascript" src="js/checkForm.js"></script>
<script>
    var main = new Vue({
        el:'#main',
        data:{
            pwd:'',
            name:''
        },
        methods:{
            check:function(){
                if(checkName(this.name)){
                    if(checkPwd(this.pwd)){
                        $.showLoading("登录中");
                        $.ajax({
                            type:"post",
                            url:"apiAdminLogin.php",
                            data:{
                                username:this.name,
                                pwd:this.pwd
                            },
                            dataType:"json",
                            error:function(data){
                                $.hideLoading();
//                                console.log(data.resultMsg);
                                $.alert("服务器请求失败，请稍后重试");
                            },
                            success: function (data){
                                $.hideLoading();
                                var result = data.resultStatus;
                                if(result == "1"){
                                    console.log(data.resultStatus);
                                    $.alert(data.resultMsg,function(){
                                        window.location = "adminManage.php";
                                    })
                                }
                                if(result == "2"){
                                    console.log(data.resultStatus);
                                    $.alert(data.resultMsg,function(){
                                        window.location = "adminLogin.php";
                                    })
                                }
                                if(result == "3"){
                                    console.log(data.resultStatus);
                                    $.alert(data.resultMsg,function(){
                                        window.location = "adminLogin.php";
                                    })
                                }
                            }
                        });
                    }else {
                        $.alert('请输入正确的6-10位密码');
                        $(".weui-dialog__btn ").click(function(){
                            $("input[name='orderPhone']").focus();
                        });
                    }
                }else {
                    $.alert('您填写的用户名有误');
                    $(".weui-dialog__btn ").click(function(){
                        $("input[name='orderName']").focus();
                    });
                }
            }
        }
    })
</script>
</html>