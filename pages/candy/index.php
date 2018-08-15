<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/2/2
 * Time: 下午4:17
 */
//include_once "../sdkv2/BTSession.class.php";

$code = isset($_GET['code']) ? $_GET['code'] : '';

$title = 'BitUP Candy';
?>
<!DOCTYPE html>
<html lang="en" ng-app="butCandy" ng-controller="butCandyCtrl">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../bower_components/angular/angular.js"></script>
    <script type="text/javascript" src="../bower_components/angular-cookies/angular-cookies.js"></script>
    <script type="text/javascript" src="../bower_components/angular-translate/angular-translate.min.js"></script>
    <script type="text/javascript" src="../bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js"></script>
    <script src="js/lang.js?v=423"></script>
    <script type="text/javascript">
        var onloadCallback = function() {
//            widgetId1 = grecaptcha.render('example1', {
//                'sitekey' : '6LdAiEQUAAAAANTlpTc-YuCvAXN_lriv-FoOEKE5',
//                'theme' : 'dark'
//            });
            grecaptcha.render('g_verify_id', {
                'sitekey' : '6LdAiEQUAAAAANTlpTc-YuCvAXN_lriv-FoOEKE5',
                'callback' : window.verifyCallback,
                'theme' : 'light'
            });
        };
    </script>
    <script type="text/javascript" src="js/index.js?v=1"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://www.bitup.com/common/images/favicon_g.ico?v=2" media="screen">
    <link rel="stylesheet" href="candy.css?v=1">
</head>
<body ng-cloak>
<div class="page" style="position: relative;">
    <span id="lang" ng-click="info.switching()">{{'1020' | translate}}</span>
    <img src="./img/icon-logo@2x.png" class="icon">
    <div class="main-title">{{'1001' | translate}}</div>
    <a ng-if="info.step == 1" target="_blank" href="https://t.me/bitupofficial" class="cluster-btn">{{'1002' | translate}}</a>
    <div class="text" ng-if="info.step == 1">{{'1029' | translate}}</div>
    <div class="form" ng-if="info.step == 1">
        <div class="row address">
            <input type="text" ng-model="info.address" placeholder="{{'1003' | translate}}">
        </div>
        <div style="margin-bottom: 24px;" id="g_verify_id"></div>
        <!--        <div class="row verify-code-box">-->
        <!--            <div style="margin-right: 102px;"><input type="text" ng-model="info.verifyCode" placeholder="{{'1004' | translate}}"></div>-->
        <!---->
        <!--            <img ng-src="{{info.vcodeImg}}" ng-click="info.vcode()" alt="" class="verify-code">-->
        <!--        </div>-->
        <div class="row get-candy-btn">
            <button ng-click="info.submit()">{{'1030' | translate}}</button>
            <a ng-click="info.rule('open')" style="cursor: pointer">{{'1006' | translate}}</a>
        </div>
    </div>
    <div class="form form-copy" ng-show="info.step == 2">

        <div class="row data">
            <div class="left">
                <span>{{'1011' | translate}}</span>
                <p>{{info.child_count}}</p>
            </div>
            <div class="right">
                <span>{{'1012' | translate}}</span>
                <p>{{info.reward}}</p>
            </div>
        </div>
        <div class="copy-box">
            <div class="line"><span>1.<a target="_blank" style="color: #2588F0;" style="margin-bottom: 24px;" href="https://t.me/bitupofficial">{{'1013' | translate}}</a></span></div>
            <div class="line">
                <span>2.{{'1014' | translate}}</span>
                <div class="row copy-address">
                    <input id="copy-content-1" type="text" ng-model="info.shareCode">
                    <button id="plain-copy-1" class="btn-copy">{{'1015' | translate}}</button>
                    <span class="result" id="plain-copy-result-1"></span>
                </div>
            </div>
            <div class="line">
                <span>3.{{'1016' | translate}}</span>
                <div class="row copy-address">
                    <input id="copy-content-2" type="text" ng-model="info.shareUrl">
                    <button id="plain-copy-2" class="btn-copy">{{'1015' | translate}}</button>
                    <span class="result" id="plain-copy-result-2"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="text" ng-if="info.step == 1">{{'1007' | translate}}</div>
    <div class="bottom-btns">
        <span style="font-size: 12px;">Copyright © BitUP All Rights Reserved</span>
    </div>
</div>
<!-- 全屏弹窗 -->
<div class="pop" ng-if="info.pop">
    <div class="pop-text rule" ng-if="info.message"><p>{{info.message}}</p></div>
    <div class="pop-text rule" ng-if="!info.message">
        <div style="max-width: 600px; margin: 0 auto;">
            <dl>
                <dt>{{'1021' | translate}}</dt>
                <dd>1.{{'1022' | translate}}</dd>
                <dd>2.{{'1023' | translate}}</dd>
                <dd>3.{{'1024' | translate}}</dd>
                <dd>4.{{'1028' | translate}}</dd>
                <dd>{{'1025' | translate}}</dd>
            </dl>
            <p><span ng-click="info.rule('close')">{{'1018' | translate}}</span></p>
        </div>
    </div>
</div>
<script src="js/clipboard.min.js"></script>
<script>
    window.code = '<?php echo $code; ?>';
    (function(){
        var result = {
            1:document.getElementById("plain-copy-result-1"),
            2:document.getElementById("plain-copy-result-2")
        };
        var btn = {
            1:document.getElementById("plain-copy-1"),
            2:document.getElementById("plain-copy-2")
        };
        var content = {
            1:document.getElementById('copy-content-1'),
            2:document.getElementById('copy-content-2')
        };
        btn[1].addEventListener("click", function() {
            clipboard.writeText(content[1].value).then(function(){
                result[1].textContent = window.localStorage.lang == 'en' ?  'copied' : '复制成功';
                setTimeout(function(){
                    result[1].textContent = '';
                },2000)
            }, function(err){
                result[1].textContent = err;
            });
        });
        btn[2].addEventListener("click", function() {
            clipboard.writeText(content[2].value).then(function(){
                result[2].textContent = window.localStorage.lang == 'en' ?  'copied' : "复制成功";
                setTimeout(function(){
                    result[2].textContent = '';
                },2000)
            }, function(err){
                result[2].textContent = err;
            });
        })
    })()
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
</body>
</html>
