<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/8/6
 * Time: 下午4:13
 */
require_once "../common/data/include.php";
require_once "../sdkv2/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="BitUP豪送10万USDT红包！">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>BitUP豪送10万USDT红包！</title>
    <link rel="stylesheet" href="css/reset.css?v=2">
    <link rel="stylesheet" href="css/index.css?v=2">
    <link rel="stylesheet" href="css/swiper-4.3.3.min.css?v=2">
    <style>
        body{ background:#21165e url("img/bg1.png?v=1") no-repeat center top; background-size: 100%;}
    </style>
</head>
<body>
<div id="app">
    <!--内容部分-->
    <div class="banner">
        <img src="img/index-banner.png?v=1" width="100%"/>

    </div>

    <div class="soc">
        <div class="swiper-container swiper-no-swiping">
            <div class="swiper-wrapper">
                <div class="swiper-slide">a***88@yahoo.com.cn抢到了1.4 USDT基金红包</div>
                <div class="swiper-slide">c***bf66@126.com抢到了2.0 USDT基金红包</div>
                <div class="swiper-slide">d***237@126.com抢到了0.4 USDT基金红包</div>
                <div class="swiper-slide">t***mmy.cui@seakingsoft.com抢到了1.5 USDT基金红包</div>
                <div class="swiper-slide">t***yan@188.com抢到了1.0 USDT基金红包</div>
                <div class="swiper-slide">w***jun@comnetech.com 抢到了1.1 USDT基金红包</div>
                <div class="swiper-slide">w***tao36@126.com抢到了1.2 USDT基金红包</div>
                <div class="swiper-slide">z***dy@163.com抢到了1.3 USDT基金红包</div>
                <div class="swiper-slide">z***h85@163.com抢到了0.4 USDT基金红包</div>
                <div class="swiper-slide">d***gjix@126.com抢到了0.5 USDT基金红包</div>
                <div class="swiper-slide">y***16@163.com抢到了0.6 USDT基金红包</div>
                <div class="swiper-slide">l***ing1800@126.com抢到了0.8 USDT基金红包</div>
                <div class="swiper-slide">L***69276@126.com抢到了0.9 USDT基金红包</div>
                <div class="swiper-slide">l***000@163.com抢到了0.1 USDT基金红包</div>
                <div class="swiper-slide">z***27@163.com抢到了1.0 USDT基金红包</div>
                <div class="swiper-slide">l***iq@sente.com.cn抢到了1.5 USDT基金红包</div>
                <div class="swiper-slide">c***min@sina.com抢到了1.7 USDT基金红包</div>
                <div class="swiper-slide">w***jun9518@sina.com抢到了1.9 USDT基金红包</div>
                <div class="swiper-slide">w***k@ufida.com.cn抢到了2.1 USDT基金红包</div>
                <div class="swiper-slide">w***kunpeng76121@163.com抢到了2.2 USDT基金红包</div>
                <div class="swiper-slide">w***kun_cgb@126.com抢到了2.3 USDT基金红包</div>
                <div class="swiper-slide">w***l@jsqtech.com抢到了2.8 USDT基金红包</div>
                <div class="swiper-slide">1***25468@qq.com抢到了2.9 USDT基金红包</div>
                <div class="swiper-slide">1***98567@qq.com抢到了2.4 USDT基金红包</div>
                <div class="swiper-slide">1***14574@qq.com抢到了2.5 USDT基金红包</div>
                <div class="swiper-slide">1***78478@qq.com抢到了2.3 USDT基金红包</div>
                <div class="swiper-slide">1***41457@qq.com抢到了2.2 USDT基金红包</div>
                <div class="swiper-slide">1***42334@qq.com抢到了2.1 USDT基金红包</div>
                <div class="swiper-slide">1***980987@qq.com抢到了2.4 USDT基金红包</div>
                <div class="swiper-slide">1***78459@qq.com抢到了2.4 USDT基金红包</div>
            </div>
        </div>
    </div>

    <div class="enter_email">
        <div class="email_box">
            <input type="email" placeholder="请输入您的常用邮箱" v-model="email">
        </div>
        <button class="btn" @click="getReward" :disabled="over">立即领取</button>
        <p class="text-center bai" @click="activityModal=true">查看<span class="hong">活动规则</span></p>
    </div>

    <!--尾部-->
    <div class="foot">
        <p class="text-center" style="line-height: 2.4rem">更多福利及资讯请扫码关注公众号<br>如您有任何疑问请扫码添加下方客服账号，客服小姐姐会在第一时间为您服务</p>

        <div class="QRCode reset">
            <div class="gah f-left">
                <img src="img/img-gzh.png?v=1"/><br>
                <p>bitup官方公众号</p>
            </div>
            <div class="kf f-right">
                <img src="img/img-kf.png?v=1"/><br>
                <p>bitup官方客服</p>
            </div>
        </div>
    </div>

    <!--活动规则-->
    <div style="display: none;" class="modal" v-show="activityModal" @click="activityModal=false">
        <div class="tip_box" @click.stop="">
            <img src="img/gz.png?v=1" class="tit">
            <div class="soc_box">
                <p class="rem1-4">一、活动时间</p>
                <p>即日起-2018.08.19 </p>

                <p>二、活动细则</p>
                <p>1.用户可以通过分享好友的方式增加抢红包次数。每日最多可通过分享获得2次抢红包的机会，每日可抢上限为3次。</p>
                <p>2.所有奖励均会在第一时间发放至您填写的邮箱账中。</p>
                <p>3.严禁使用外挂第三方工具或技术手段进行作弊行为，一经发现，取消奖励资格。</p>
                <p>4.请您于8月19日23:59前完成KYC（实名）认证,以便于提现及奖励的领取。</p>
                <p>5.红包奖励将以8月24日12:00的BP10基金(BP10是一支指数基金，近1个月的收益高达30%)价格进行兑换，并把基金份额充到您的账户</p>
                <p>6.在法律许可的合法范围内，本活动最终解释权归BitUP所有。</p>
            </div>

            <img src="img/close.png?v=1" class="close" @click="activityModal=false">
        </div>

    </div>
</div>

<script src="js/index.js?v=2"></script>
<script src="js/vue.js"></script>
<script src="js/swiper-4.3.3.min.js"></script>
<script>
    window.url = '<?php echo BT_BACKEND_URL; ?>';

    var app = new Vue({
        el: '#app',
        data: {
            activityModal:false,
            email:'',
            over:false
        },
        methods: {
            getReward:function () {
                var reg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                var p = this.email.substring(0,this.email.indexOf('@'));
                if(this.email!=='' && reg.test(this.email) && p.length<25){//邮箱
                    localStorage.setItem('email',this.email);
                    location.href = 'share.php';
                }else{
                    console.log(this.email);
                    alert('请输入正确的邮箱！');
                }
            }
        },
        mounted:function () {
            var mySwiper = new Swiper('.swiper-container', {
                autoplay: {
                    delay:1000
                },
                loop : true,
                direction : 'vertical',
                slidesPerView: 3,//纵列
                slidesPerColumn : 1,//横列
                slidesPerColumnFill : 'row'
                //slidesPerGroup : 3
            });

            var tagTime = new Date("2018-8-19 23:59:59").getTime();
            var nowTime = new Date().getTime();
            if(nowTime - tagTime > 0){
                this.over = true;
                alert('活动已结束！');
            }
        }
    });
</script>
</body>
</html>

