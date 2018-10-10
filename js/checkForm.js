/**
 * Created by Administrator on 2018/6/1.
 */

//    姓名验证
    function checkName(v){
        var name = v;
        if(!(/^[A-z]+$|^[\u4E00-\u9FA5]+$/.test(name))){
            //alert("姓名有误");
            return false;
        }else {
            return true;
        }
    }
//    密码正则验证
    function checkPwd(v) {
        var phone = v;
        if(!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,10}$/.test(phone))) {
            //alert("手机号码有误");
            return false;
        }else{
            return true;
        }
    }
