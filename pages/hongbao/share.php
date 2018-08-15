<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/8/6
 * Time: 下午4:27
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
    <!--<link rel="stylesheet" href="css/share.css">-->
    <style>
        body{ background:#271b65 url("img/bg2.png?v=1") no-repeat center top; background-size: 100%;}
    </style>
</head>
<body>
<div id="app">
    <!--内容部分-->

    <!--领红包-->
    <div style="padding: 0 10%" v-if="d.status==0 || d.status==1 || d.status==2">
        <div class="get_reward">
            <img src="img/bg_box.png?v=1" width="100%">
            <div class="info">
                <p class="suc_tit">恭喜您获得BitUP数字货币基金超市</p>
                <p class="new_user hong" v-if="d.reward">您是新用户，我们额外奉上1.0 USDT见面礼</p>
                <p class="num"><strong v-html="d.price"></strong><span>USDT</span></p>
                <p class="share_tip">分享好友还可以再抢1次哦</p>
                <div class="btn_box reset">
                    <a href="/dashboard/user/hongbao"><img src="img/btn1.png?v=1" class="f-left"></a>
                    <img @click="share" src="img/btn2.png?v=1" class="f-right">
                </div>
                <p class="email">放入帐号<span v-html="d.email"></span></p>
            </div>
        </div>
    </div>
    <!--已领完-->
    <div style="padding: 0 10%" v-if="d.status==-1 || d.status==5">
        <div class="get_reward">
            <img src="img/bg_box.png?v=1" width="100%">
            <div class="info">
                <p class="suc_tit">哇哦，没抢到哦，请明天再来~</p>
                <p class="num">--</p>
                <p class="share_tip">去看看今天抢到多少吧</p>
                <div class="btn_box reset">
                    <a href="/dashboard/user/hongbao"><img src="img/btn1.png?v=1" class="f-left"></a>
                    <img @click="share" src="img/btn2.png?v=1" class="f-right">
                </div>
                <p class="email"><span v-html="d.email"></span></p>
            </div>
        </div>
    </div>
    <!--操作太频繁-->
    <!--<div style="padding: 0 10%" v-if="d.status==-1">
        <div class="get_reward">
            <img src="img/bg_box.png" width="100%">
            <div class="info">
                <p class="suc_tit">哇哦，没抢到哦，请明天再来~</p>
                <p class="num">-</p>
                <p class="share_tip">去看看今天抢到多少吧</p>
                <div class="btn_box reset">
                    <a href="/dashboard/user/hongbao"><img src="img/btn1.png" class="f-left"></a>
                    <img @click="share" src="img/btn2.png" class="f-right">
                </div>
                <p class="email"><span v-html="d.email"></span></p>
            </div>
        </div>
    </div>-->

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

    <div style="display: none;" class="modal" v-show="activityModal" @click="activityModal=false">
        <img v-if="random >= 0.5" class="tip_img" src="img/1.png?v=1">
        <img v-if="random < 0.5" class="tip_img" src="img/2.png?v=1">
    </div>
</div>

<script>
    window.url = '<?php echo BT_BACKEND_URL; ?>';
</script>
<script src="js/index.js?v=2"></script>
<script src="js/vue.js"></script>
<script src="js/axios.js"></script>
<!--<script src="js/share.js"></script>-->
<script>
    var app = new Vue({
        el: '#app',
        data: {
            random:0,
            activityModal:false,
            d:{},
            email:localStorage.getItem('email')
        },
        methods: {
            share:function () {
                this.random = Math.random();
                this.activityModal = true;
            }
        },
        mounted:function () {
            if(!localStorage.getItem('email') || localStorage.getItem('email')===''){
                location.href = 'index.php';
                return false;
            }
            axios.get(getReward,{
                params:{
                    email: this.email
                }
            }).then(function (response) {//领取红包
                if(response.data.data.status == 4){
                    alert('活动已结束！');
                    return false;
                }
                if(response.data.result_code == 0){
                    app.d = response.data.data;
//                    app.d.price = app.d.price + ' USDT'
                }
            }).catch(function (error) {
                alert('红包获取失败！请稍后再试！')
            });
            /*if(!localStorage.getItem('email') || localStorage.getItem('email')===''){
             //                location.href = 'https://bitup.com/dashboard/user/hongbao'
             }
             else {
             /!*axios.get(getReward,{
             params:{
             email: this.email
             }
             }).then(function (response) {//领取红包
             if(response.data.result_code==0){
             app.d = response.data.data;
             app.ok = true;
             }
             }).catch(function (error) {
             alert('请求失败！')
             });*!/
             }*/
        }
    });
</script>
</body>
</html>
