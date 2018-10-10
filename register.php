<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/12
 * Time: 10:19
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>用户注册</title>
    <!--WEUI CSS-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/layui/css/layui.css">
    <!--JS-->
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <!--WEUI JS-->
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<!--    <script src="https://unpkg.com/vue/dist/vue.js"></script>-->
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
            width:20rem;
            height:15rem;
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
        .upload{
            height: 4rem;
            width: 4rem;
            border-radius:2.5rem;
            margin: 1.5rem auto 0;
            position: relative;
        }
        .icon{
            height: 4rem;
            width: 4rem;
            border-radius:2.5rem;
            margin: 0 auto;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        #photo{
            z-index: 1000;
            position: absolute;
        }
        .saveImg{
            height:4rem;
            width:4rem;
            /*border: 1px solid #f24334;*/
            border-radius:2.5rem;
            display: none;
            overflow: hidden;
            position: absolute;
            pointer-events:none;
            z-index: 9999;
        }
    </style>
    <link rel="stylesheet" href="css/m.css">
</head>
<body>
<div class="main" id="main">
    <div>
        <div class="upload">
            <div class="icon">
                <img src="images/upLoadHead.jpg" alt="" style="height:100%;width: 100%;border-radius2.5rem;margin: 0 auto;display: block">
            </div>
            <input type="file" id="photo" name="file" style="width:100%;height:100%;opacity: 0;" />
            <div class="saveImg">
                <img id="pic" style="height:100%;width: 100%;brorde-radius2.5rem;margin: 0 auto;display: block" >
            </div>
        </div>
    </div>
    <div class="layui-form-item" style="margin-top:1.5rem">
        <label class="layui-form-label" style="text-align: center;">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="username" v-model="name" id="username" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="text-align: center">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
        <div class="layui-input-block">
            <input type="password" v-model="pwd" name="password" id="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <button class="layui-btn layui-btn-lg layui-btn-normal" style="display:block;margin: 28px auto;width: 4.2rem;height: 1.6rem;font-size: 0.7rem; line-height: 1.6rem;" id="dL" v-on:click="check">注册</button>
</div>
</body>
<script type="text/javascript" src="js/checkForm.js"></script>
<script>
    $(function() {
        $('#photo').change(function (e) {
            var files = this.files;
            console.log(files);
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function (e) {
                var type = files.type;
                var mb = (e.total / 1024) / 1024;
                if (type == "image/jpg" || type == "image/png" || type == "image/jpeg" || mb <= 5) {

                    $('.upload').css('border', 'none');
                    $('.saveImg').css('display', 'block');
                    $('.icon').css('display', 'none');
                    $('#pic').attr('src', e.target.result);
                } else {
                    $.alert({
                        title: '提示',
                        text: '请选择正确的图片格式（jpg、jpeg、png）及图片大小',
                        onOK: function () {
                        }
                    });
                }

            }
        });
    });
</script>
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
                        $.showLoading("注册中");
                        var imgData = $("#pic").attr("src");
//                        console.log(imgData);
                        $.ajax({
                            type:"post",
                            url:"apiGetMsg.php",
                            data:{
                                'username':this.name,
                                'pwd':this.pwd,
                                'imgData':imgData
                            },
                            dataType:"json",
                            error:function(){
                                $.hideLoading();
                                $.alert("服务器请求失败，请稍后重试");
                            },
                            success: function (data){
                                console.log(data.resultStatus);
                                $.hideLoading();
                                if(data.resultStatus = 'true'){
                                    $.alert(data.resultMsg,function(){
                                        window.location = "login.php";
                                    })
                                }else {
                                    $.alert(data.resultMsg);
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
                    $.alert('您注册的用户名有误');
                    $(".weui-dialog__btn ").click(function(){
                        $("input[name='orderName']").focus();
                    });
                }
            }
        }
    })
</script>
</html>
