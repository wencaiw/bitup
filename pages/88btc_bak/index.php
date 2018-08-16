<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/4/20
 * Time: 下午3:26
 */
require_once "../common/data/include.php";
BTSession::openWithoutWrite();
if (!BTSession::isValid()) {
    $is_login = false;
}else{
    $is_login = true;
    $account = $_SESSION['account'];
}

$l = $_COOKIE['BT_LANG'];
$title = '数字资产管理平台 | Digital Asset Investment Platform | BTC Fund';
?>
<!DOCTYPE html>
<html lang="en" ng-app="BTCFund" ng-controller="BTCFundCtrl">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>BitUP dashboard</title>
    <script type="text/javascript" src="../common/js/mod.js"></script>
<!--    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>-->
    <script type="text/javascript" src="../bower_components/angular/angular.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/angular-cookies/angular-cookies.js"></script>
    <script type="text/javascript" src="../bower_components/angular-translate/angular-translate.min.js"></script>
    <script type="text/javascript" src="../bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js"></script>
    <script type="text/javascript" src="../bower_components/highcharts/highcharts.js"></script>
    <script type="text/javascript" src="../bower_components/highcharts/highcharts-more.js"></script>
    <script type="text/javascript" src="../bower_components/highcharts-ng/dist/highcharts-ng.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://www.bitup.com/common/images/favicon_g.ico?v=2" media="screen">
    <link rel="stylesheet" type="text/css" href="../../app/common/css/index.less?__inline">
    <link rel="stylesheet" type="text/css" href="../../app/common/css/index-mobile.less?__inline">
    <link rel="stylesheet" type="text/css" href="../../app/common/css/czj.less?__inline">
    <script>
        window.localStorage.lang = '<?php echo $_COOKIE['BT_LANG']; ?>';
        window.isLogin = <?php echo !!$is_login ? 1 : 0; ?>;
        <?php if(isset($account)){ ?>
        window.account = '<?php echo $account ?>';
        <?php } ?>
        require('common/i18n/lang');
    </script>
</head>
<body ng-cloak>
<?php //include_once '../common/tpl/header.php'; ?>
<link rel="import" href="../common/tpl/top.html?__inline"/>
<div class="common-container por">

    <div id="btcfund" class="common-container">
        <!--banner-->
        <div class="banner">
            <img width="100%" src="/common/images/user-banner.jpg">
            <img class="share" width="50%" src="/common/images/btcfund-img-word-<?php echo $l; ?>.png">
        </div>

        <!--参与人数-->
        <div class="people-num">
            <div>
                <span><i class="middle">{{100339 | translate}}</i><span class="f24 color-black middle">{{info.activityInfo.history_total_user}}</span><i class="common-icon icon-up green middle"></i></span>
                <span><i class="middle">{{100340 | translate}}</i><span class="f24 color-black middle">{{info.activityInfo.total_profit}} BTC</span></span>
            </div>
        </div>

        <!--图表-->
        <div class="cont1 reset">
            <div class="head reset">
                <div class="blue-box">
                    <p>{{100287 | translate}}</p>
                    <p class="f12">— {{100288 | translate}} —</p>
                </div>
                <ul class="reset">
                    <li>
                        <p class="lv">4%～12%</p>
                        <p class="f12 hui">{{100289 | translate}}</p>
                    </li>
                    <li>
                        <p>T+1</p>
                        <p class="f12 hui">{{100290 | translate}}</p>
                    </li>
                    <li>
                        <p>1{{100348 | translate}}</p>
                        <p class="f12 hui">{{100291 | translate}}</p>
                    </li>
                    <li>
                        <p>{{100347 | translate}}BUT</p>
                        <p class="f12 hui">{{100292 | translate}}</p>
                    </li>
                    <li>
                        <p>{{100366| translate}}BUT</p>
                        <p class="f12 hui">{{100293 | translate}}</p>
                    </li>
                </ul>
            </div>

            <div class="chart">
                <h3 class="chart-title"><span class="shenhui f14">{{100294 | translate}}(BTC)</span></h3>
                <p><span>{{100295 | translate}}</span><span>{{100296 | translate}}</span></p>
                <div>
                    <highchart style="height: 180px;display: block;" config="info.column.chartConfig"></highchart>
                </div>
            </div>

            <!--登陆前-->
            <div ng-if="!info.isLogin" class="chart-sub hui">
                <p class="f-left"><span class="hei">{{100341 | translate}}：</span>{{100342 | translate}}</p>
                <p class="f-right"><span class="hei">{{100343 | translate}}：</span>{{100344 | translate}}</p>
                <div class="clear h15"></div>

                <p><span class="hei">{{100297 | translate}}：</span></p>
                <p>{{100298 | translate}}</p>
                <div class="h15"></div>

                <p class="about-info <?php echo $_COOKIE['BT_LANG']; ?>"><span class="hei">{{100299 | translate}}：</span>{{100300 | translate}}</p>

                <p style="text-align: center"><button class="login" style="float:inherit;margin: 15px 0 0 0px;" ng-click="info.goLogin()" style="margin:15px 0 0 60px;">{{100403 | translate}}</button></p>
                <!--<button class="share" ng-click="info.showShare = !info.showShare"></button>-->
                <div class="clear"></div>
            </div>
            <!--登陆后-->
            <div ng-if="info.isLogin" class="chart-sub">
                <p class="f14" style="margin-bottom: 8px;">{{100297 | translate}}</p>
                <p class="f12 hui" style="margin-bottom: 16px;">{{100298 | translate}}</p>

                <p class="f14" style="margin-bottom: 8px;">{{100299 | translate}}</p>
                <p class="f12 hui" style="line-height: 24px;">{{100300 | translate}}</p>
            </div>

        </div>

        <!--活动参与/额度/收益-->
        <div class="cont2 reset">
            <!--登陆前-->
            <div ng-if="!info.isLogin">
                <div class="bai-box-50">
                    <p class="shenhui f14">{{100301 | translate}}</p>
                    <div class="h20"></div>

                    <div class="progress-bar"><div ng-style="{'width':info.activityInfo.total_amount / 30000000 * 100 + '%'}"></div></div>
                    <p class="f12 hui">{{100302 | translate}} {{(info.activityInfo.total_amount / 30000000 * 100).toFixed(2) + '%'}}</p>
                    <div class="h15"></div>
                    <p class="f12 hui">{{100303 | translate}}<span class="hei">{{30000000-info.activityInfo.total_amount | number:2}}BUT</span></p>
                </div>

                <div class="bai-box-50 f-right">
                    <p class="shenhui f14">{{100304 | translate}}</p>
                    <div class="h20"></div>

                    <div class="drag-bar">
                        <input type="range" min="5" max="100" step="5" ng-model="info.profit" ng-style="{'background-size':(info.profit/95-0.052631578947368425)*100 +'% 100%'}">
                        <div class="node node1" ng-class="{'node-active':info.profit>=5}"></div>
                        <div class="node node2" ng-class="{'node-active':info.profit>=40}"></div>
                        <div class="node node3" ng-class="{'node-active':info.profit>=70}"></div>
                        <!--<div class="node node4"></div>-->
                        <div class="node node5" ng-class="{'node-active':info.profit>=99}"></div>
                    </div>

                    <div style="width: 500px;">
                        <p class="f12 hui f-left">{{100371 | translate}}BUT</p>
                        <p class="f12 hui f-right">{{100372 | translate}}BUT</p>
                    </div>
                    <div class="h15"></div>

                    <p class="f12 hui f-left">{{100305 | translate}}<span class="hei">{{info.profit * 10000 | number:2}}BUT</span></p>
                    <p class="f12 hui f-left" style="margin-left: 40px;">{{100306 | translate}}<span class="hei">{{info.minProfit}}BTC～{{info.maxProfit}}BTC</span></p>
                </div>
            </div>
        </div>

        <!--活动介绍-->
        <div class="h15"></div>
        <div class="bai-box-100 reset">
            <p class="shenhui f14">{{100320 | translate}}</p>
            <div class="h15"></div>
            <p class="hui" style="line-height: 24px;">{{100321 | translate}}<br>{{100359 | translate}}<br>{{100360 | translate}}</p>
            <div class="h10"></div>
            <p class="hui">{{100322 | translate}}</p>
        </div>
        <div class="h15"></div>

        <!--参与步骤/活动说明-->
        <div class="cont2 reset <?php echo $_COOKIE['BT_LANG']; ?>">
            <div class="bai-box-50 h250" style="height: 250px;">
                <p class="shenhui f14">{{100323 | translate}}</p>
                <div class="h30"></div>

                <div class="black-box"><span ng-bind-html="100349 | translate | htmlTag"></span></div>
                <div class="arrow-right"></div>

                <div class="black-box"><span ng-bind-html="100351 | translate | htmlTag"></span></div>
                <div class="arrow-right"></div>

                <div class="black-box"><span ng-bind-html="100353 | translate | htmlTag"></span></div>
                <div class="arrow-right"></div>

                <div class="black-box"><span ng-bind-html="100355 | translate | htmlTag"></span></div>

                <div class="h30 clear"></div>
                <p class="shenhui">{{100361 | translate}}</p>
            </div>

            <div class="bai-box-50 f-right f12 scroll-bar h250" style="height: 250px;">
                <p class="shenhui f14">{{100324 | translate}}</p>
                <div class="h20"></div>

                <p>{{100325 | translate}}</p>
                <div class="h10"></div>
                <p>{{100326 | translate}}</p>
                <div class="h10"></div>
                <p>{{100327 | translate}}</p>
                <div class="h10"></div>
                <p>{{100328 | translate}}</p>
                <div class="h10"></div>
                <p>{{100362 | translate}}</p>
                <div class="h10"></div>
                <p>{{100363 | translate}}</p>
                <div class="h10"></div>
                <p>{{100364 | translate}}</p>
                <div class="h10"></div>
                <p>{{100365 | translate}}</p>
            </div>
        </div>

        <!--收益表格-->
        <div class="h15"></div>
        <div class="bai-box-100 reset">
            <!--基金收益-->
            <div class="tab-box">
                <ul class="head reset">
                    <li class="active">{{100330 | translate}}</li>
                </ul>
                <div class="tab-cont">
                    <div class="tab-tit">
                        <p class="w50 f-left">{{100331 | translate}}</p>
                        <p class="w50 f-left">{{100332 | translate}}(BTC)</p>
                    </div>

                    <div class="no-record-box" ng-if="!info.item1.length || info.item1.length==0">
                        <img src="/pages/common/images/finance-record.png" alt="">
                        <span>暂无记录</span>
                    </div>

                    <ul class="list" ng-if="info.item1.length > 0">
                        <li ng-repeat="item in info.item1">
                            <p class="w50 f-left">{{item.date}}</p>
                            <p class="w50 f-left">{{item.profit_btc_amount | number:8}}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!--收益排行榜-->
            <div class="tab-box f-right">
                <ul class="head reset">
                    <li ng-repeat="(k,v) in info.tabList2" ng-class="{'active' : info.tabNum2==k}" ng-click="info.switchData('item2',k)">{{v}}</li>
                </ul>
                <div class="tab-cont">
                    <div class="tab-tit">
                        <p class="w30 f-left">{{100336 | translate}}</p>
                        <p class="w35 f-left">{{100335 | translate}}</p>
                        <p class="w35 f-left">{{100332 | translate}}(BTC)</p>
                    </div>

                    <div class="no-record-box" ng-if="!info.item2.length || info.item2.length==0">
                        <img src="/pages/common/images/finance-record.png" alt="">
                        <span>暂无记录</span>
                    </div>

                    <ul class="list" ng-if="info.item2.length > 0">
                        <li ng-repeat="item in info.item2">
                            <p class="w30 f-left">{{$index + 1}}</p>
                            <p class="w35 f-left">{{item.email}}</p>
                            <p class="w35 f-left">{{item.profit_btc_amount | number:8}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="h70"></div>

        <!--底部分享-->
        <div class="share-box">
            <p class="tit">{{100337 | translate}}</p>
            <ul class="share-list reset">
                <li><a href="https://t.me/bitupofficial" target="_blank"><img src="/common/images/share/telegram.png" width="20"></a></li>
                <li><a href="https://twitter.com/bitupofficial" target="_blank"><img src="/common/images/share/twitter.png" width="20"></a></li>
                <li><a href="https://www.facebook.com/bitupofficial" target="_blank"><img src="/common/images/share/facebook.png" width="20"></a></li>
                <li><img src="/common/images/share/wechat.png" width="20"><div><p>{{100357 | translate}}</p></div></li>
                <li><img src="/common/images/share/gongzhonghao.png" width="20"><div><img src="/common/images/wx-group.jpg" width="100%"><p>{{100358 | translate}}</p></div></li>
                <li><a href="//shang.qq.com/wpa/qunwpa?idkey=299396b5d0a6ef5a3496e184361c7aa5ed335d2bfae51c0d3764ced5f68047ab" target="_blank"><img src="/common/images/share/qq.png" width="20"></a></li>
            </ul>
            <p class="qianhui text-center">{{100338 | translate}}</p>
        </div>
    </div>
</div>
<?php //include_once '../common/tpl/footer.php'; ?>
<link rel="import" href="../common/tpl/footer.html?__inline"/>
<script src="index.js?v=2018063001"></script>
</body>
</html>
