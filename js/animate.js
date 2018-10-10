/**
 * Created by Administrator on 2018/6/19.
 */
(function ($, window) {
    //document.getElementById('shakingAudio').load();
    document.getElementById('shakingAudio').play();
    //      微信必须加入Weixin JSAPI的WeixinJSBridgeReady才能生效
    document.addEventListener("WeixinJSBridgeReady", function () {
        document.getElementById('shakingAudio').play();
    }, false);
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
})(jQuery, window);