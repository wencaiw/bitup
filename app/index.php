<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/2
 * Time: 下午3:29
 */
require_once "../sdkv2/BTSession.class.php";
BTSession::openWithoutWrite();

if (!BTSession::isValid()) {
    $is_login = false;
}else{
    $is_login = true;
    $account = $_SESSION['account'];
}

?>
<!DOCTYPE html>
<html lang="en" ng-app="BitUP" ng-controller="DashboardCtrl">
<head>
    <base href="/">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>BitUP dashboard</title>
    <script type="text/javascript" src="../common/js/mod.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/angular/angular.min.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/angular-cookies/angular-cookies.min.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/angular-ui-router/release/angular-ui-router.min.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/oclazyload/dist/ocLazyLoad.min.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/angular-translate/angular-translate.min.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js"></script><!--ignore-->
    <script type="text/javascript" src="../bower_components/ngclipboard/dist/ngclipboard.min.js"></script><!--ignore-->
    <!-- <script src="../common/i18n/lang.js?v=5"></script> -->
    <link rel="shortcut icon" type="image/x-icon" href="https://www.bitup.com/common/images/favicon_g.ico?v=2" media="screen">
    <link rel="stylesheet" type="text/css" href="../app/common/css/index.less?__inline">
    <link rel="stylesheet" type="text/css" href="../app/common/css/index-mobile.less?__inline">
    <script>
        window.localStorage.lang = '<?php echo $_COOKIE['BT_LANG']; ?>';
        window.isLogin = <?php echo !!$is_login ? 1 : 0; ?>;
        <?php if(isset($account)){ ?>
        window.account = '<?php echo $account; ?>';
        <?php } ?>
        require('common/i18n/lang');
        require('index');
    </script>
</head>
<body ng-cloak>
<link rel="import" href="common/tpl/top.html?__inline"/>

<div ui-view></div>

<!--提示框-->
<div class="confirm-wrap" ng-show="g.tipShow">
    <div class="confirm-main">
        <h3 class="title"><span ng-bind="g.tipTitle"></span><i class="common-icon icon-close" ng-click="g.clearTip()" ng-if="g.showTipClose"></i></h3>
        <div class="confirm-content">
            <p><span ng-bind="g.tipInfo"></span></p>
        </div>
        <buttton class="common-btn ok" ng-click="g.tipConfirm()">{{'100160' | translate}}</buttton>
    </div>
</div>

<link rel="import" href="common/tpl/footer.html?__inline"/>
</body>
</html>
