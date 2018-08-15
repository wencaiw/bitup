<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/2
 * Time: 下午2:58
 */
require_once "../common/data/include.php";

$retrieve = array(
    'en' => array(
        '1001' => 'Already have an account? ',
        '1002' => 'Log In',
        '1003' => 'Email verification code has been sent. Please check. ',
        '1004' => 'Enter email verification code',
        '1005' => 'Did not receive email? ',
        '1006' => 'Try again',
        '1007' => 'Confirm new password',
        '1008' => 'Your password has been reset, please log in again.'
    ),
    'cn' => array(
        '1001' => '已有帐号',
        '1002' => '立刻登录',
        '1003' => '系统已向您的邮箱发送验证码，请至邮箱查收。',
        '1004' => '请输入邮箱验证码',
        '1005' => '没有收到邮件？点击 ',
        '1006' => '重新发送',
        '1007' => '重复密码',
        '1008' => '您的密码已经修改成功，请使用新密码登录您的账户。'
    )
);
$l = $_COOKIE['BT_LANG'];
$_Retrieve = $retrieve[$l];

//$curr_page_id = 1;
$title = '数字资产管理平台 | Digital Asset Investment Platform | BitUP Retrieve';
?>
<!DOCTYPE html>
<html lang="en" ng-app="indexControllers" ng-controller="indexCtrl">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
</head>
<body ng-cloak>

<?php include_once '../common/tpl/header.php'; ?>
<div class="login-wrap register-wrap">
    <div class="common-container clearfix">
        <div class="login-main">
            <h3 class="login-title"><span><?php echo $_Lang['100196']; ?></span></h3>
            <!--输入账号-->
            <div id="retrieve-verify">
                <div class="form-box account">
                    <input type="text" placeholder="<?php echo $_Lang['100153']; ?>" class="input-text" id="account">
                </div>
<!--                <div class="form-box">-->
<!--                    <input type="text" placeholder="输入图片验证码" class="input-text middle" ng-model="info.code" style="width: 160px;padding-left: 15px;">-->
<!--                    <img src="/common/images/code-img.png" class="middle" style="width: 96px;" alt="">-->
<!--                    <i class="common-icon icon-refresh middle"></i>-->
<!--                </div>-->
<!--                <div style="margin-bottom: 24px;" id="g_verify_id"></div>-->
                <div class="temp-box">
                    <p class="error"></p>
                </div>
                <div class="btn-box" style="margin-top: 18px;">
                    <button class="common-btn ok long" type="button" id="retrieve-verify-sub"><span><?php echo $_Lang['100195']; ?></span><i class="common-icon icon-loading middle" style="display: none;"></i></button>
                </div>
            </div>
            <!--输入邮箱验证码-->
            <div id="retrieve-set" style="display: none;">
<!--                <p style="margin-bottom: 32px;">--><?php //echo $_Retrieve['1003']; ?><!--</p>-->
                <div class="form-box code">
                    <input type="text" placeholder="<?php echo $_Retrieve['1004']; ?>" class="input-text" id="code">
                </div>
                <div class="form-box pwd">
                    <input type="password" placeholder="<?php echo $_Lang['100193']; ?>" class="input-text" id="pwd" title="<?php echo $_Lang['100193']; ?>">
                    <span class="tips"><?php echo $_Lang['100193']; ?></span>
                </div>
                <div class="form-box pwd">
                    <input type="password" placeholder="<?php echo $_Retrieve['1007']; ?>" class="input-text" id="re-pwd">
                </div>
                <div class="temp-box">
                    <p class="error"></p>
                </div>
                <div class="btn-box" style="margin-top: 18px;margin-bottom: 16px;">
                    <button class="common-btn ok long" type="button" id="retrieve-set-sub"><span><?php echo $_Lang['100195']; ?></span><i class="common-icon icon-loading middle" style="display: none;"></i></button>
                </div>
                <p class="center" style="color:#4d4d4d;"><?php echo $_Retrieve['1005']; ?><a href="javascript:;" class="common-link color-orange" id="again-try"><?php echo $_Retrieve['1006']; ?></a></p>
            </div>
            <!--找回密码-->
<!--            <div style="display: none;">-->
<!--                <div class="form-box pwd">-->
<!--                    <input type="password" placeholder="--><?php //echo $_Lang['100193']; ?><!--" class="input-text" ng-model="info.pwd" title="--><?php //echo $_Lang['100193']; ?><!--">-->
<!--                </div>-->
<!--                <div class="form-box pwd">-->
<!--                    <input type="password" placeholder="--><?php //echo $_Retrieve['1007']; ?><!--" class="input-text" ng-model="info.confirmPwd">-->
<!--                </div>-->
<!--                <div class="temp-box">-->
<!--                    <p class="error" ng-if="!!info.message" ng-bind="info.message"></p>-->
<!--                </div>-->
<!--                <div class="btn-box" style="margin-top: 18px;">-->
<!--                    <button class="common-btn ok long" type="button" ng-click="info.loginSub()">--><?php //echo $_Lang['100197']; ?><!--</button>-->
<!--                </div>-->
<!--            </div>-->
            <!--成功-->
            <div class="register-success" id="retrieve-success" style="display: none;">
                <p class="center"><i class="common-icon icon-smile"></i></p>
                <p class="p1" style="margin:16px 0 33px;"><?php echo $_Retrieve['1008']; ?></p>
                <div class="btn-box">
                    <button class="common-btn ok long" type="button" id="retrieve-success-sub"><?php echo $_Lang['100160']; ?>(<span>3</span>s)</button>
                </div>
            </div>
            <p class="lr-toggle-tips">
                <?php echo $_Retrieve['1001']; ?><a href="/login/" class="common-link color-orange"><?php echo $_Retrieve['1002']; ?></a>
            </p>
        </div>
    </div>
</div>

<div class="home-section3 common-container login-section">
    <ul class="adv-list">
        <li>
            <i class="common-icon icon1"></i>
            <p class="feature"><?php echo $_Lang['100185']; ?></p>
            <p><?php echo $_Lang['100186']; ?></p>
        </li>
        <li>
            <i class="common-icon icon2"></i>
            <p class="feature"><?php echo $_Lang['100187']; ?></p>
            <p><?php echo $_Lang['100188']; ?></p>
        </li>
        <li>
            <i class="common-icon icon3"></i>
            <p class="feature"><?php echo $_Lang['100189']; ?></p>
            <p><?php echo $_Lang['100190']; ?></p>
        </li>
        <li>
            <i class="common-icon icon4"></i>
            <p class="feature"><?php echo $_Lang['100191']; ?></p>
            <p><?php echo $_Lang['100192']; ?></p>
        </li>
    </ul>
</div>
<?php include_once '../common/tpl/footer.php'; ?>
<script type="text/javascript" src="/common/js/md5.js"></script>
<script type="text/javascript" src="js/retrieve.js"></script>
</body>
</html>
