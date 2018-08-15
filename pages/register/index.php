<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/2
 * Time: 下午2:58
 */
require_once "../common/data/include.php";

BTSession::openWithoutWrite();
if (BTSession::isValid()) {
    header("location:/dashboard");
    exit();
}

$register = array(
    'en' => array(
        '1001' => 'Already have an account? ',
        '1002' => 'Log In',
        '1003' => 'I agree to the <a href="/tos" target="_blank" class="common-link color-orange">Terms Of Service</a>',
        '1004' => 'Hi,',
        '1005' => 'You have been registered successfully, please activate the BitUP account in your mailbox.',
        '1006' => 'You have not yet activated, please reconfirm.',
        '1007' => 'I have activated',
        '1008' => 'Get email verification code',
        '1009' => 'Did not receive email? ',
        '1010' => 'Try again',
        '1011' => 'Email verification Code'
    ),
    'cn' => array(
        '1001' => '已有帐号？',
        '1002' => '立刻登录',
        '1003' => '本人已阅读并同意<a href="/tos" target="_blank" class="common-link color-orange">服务条款</a>',
        '1004' => '您好，',
        '1005' => '。您已注册成功，请至您的邮箱激活BitUP帐户。',
        '1006' => '您还未激活，请重新确认。',
        '1007' => '我已激活',
        '1008' => '获取验证码',
        '1009' => '没有接收到邮件?',
        '1010' => '重试',
        '1011' => '邮件验证码'
    )
);
$l = $_COOKIE['BT_LANG'];
$_Register = $register[$l];

//$curr_page_id = 1;
$title = '数字资产管理平台 | Digital Asset Investment Platform | BitUP Register';

$referral = isset($_GET["referral"]) ? trim($_GET["referral"]) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
    <script type="text/javascript">
        window.onloadCallback = function() {
            grecaptcha.render('g_verify_code', {
                'sitekey' : '6LdAiEQUAAAAANTlpTc-YuCvAXN_lriv-FoOEKE5',
                'callback' : window.verifyCallback,
                'theme' : 'light'
            });
        };
        window.verifyCallback = function(gId){
            console.log(gId);
            window.recaptcha_code = gId;
        };
        window.referral = '<?php echo $referral; ?>';
        window.lang = '<?php echo $l; ?>';
    </script>
</head>
<body>

<?php include_once '../common/tpl/top.php'; ?>
<div class="login-wrap register-wrap">
    <div class="common-container clearfix">
        <div class="banner-box">
            <p class="fz-50" style="padding-top: 160px; line-height: 60px;"><?php echo $_Lang['100203']?></p>
            <p class="fz-24"><?php echo $_Lang['100204']?></p>
        </div>
        <div class="login-main">
            <h3 class="login-title"><span><?php echo $_Lang['100002']; ?></span></h3>
            <!--register google verify, get email code-->
            <div id="register-verify" style="display: block;">
                <div class="form-box account">
                    <input type="text" placeholder="<?php echo $_Lang['100153']; ?>" class="input-text" id="account">
                </div>
                <div class="recaptcha_type">
                    <i></i>
                    <span>Google RECAPTCHA</span>
                    <ul>
                        <li>Google RECAPTCHA</li>
                        <li>Geetest RECAPTCHA</li>
                    </ul>
                </div>
                <div style="margin-bottom: 14px;" id="g_verify_code"></div>
                <div style="margin-bottom: 14px;" id="gt_verify_code"></div>
                <div class="temp-box" style="margin-top: -4px;">
                    <p class="error"></p>
                </div>
                <p class="fz-12" style="margin: 4px 0;color:#4a4a4a;"><input type="checkbox" checked="checked" class="middle" style="margin: 0 6px 0;"><span class="middle"><?php echo $_Register['1003']; ?></span></p>
                <div class="btn-box" style="margin-top: 8px;">
                    <button class="common-btn ok long" type="button" id="register-verify-sub"><span><?php echo $_Register['1008']; ?></span><i class="common-icon icon-loading middle" style="display: none;"></i></button>
                </div>
            </div>
            <!--verify email code , set pwd-->
            <div id="register-set" style="display: none;">
                <div class="form-box code">
                    <input type="text" placeholder="<?php echo $_Register['1011']; ?>" class="input-text" id="code">
                </div>
                <div class="form-box pwd">
                    <input type="password" placeholder="<?php echo $_Lang['100193']; ?>" class="input-text" id="pwd" title="<?php echo $_Lang['100193']; ?>">
                    <span class="tips"><?php echo $_Lang['100193']; ?></span>
                </div>
                <div class="form-box pwd">
                    <input type="password" placeholder="<?php echo $_Lang['100194']; ?>" class="input-text" id="re-pwd">
                </div>
                <div class="temp-box">
                    <p class="error"></p>
                </div>
                <div class="btn-box" style="margin-top: 8px;">
                    <button class="common-btn ok long" type="button" id="register-set-sub"><span><?php echo $_Lang['100002']; ?></span><i class="common-icon icon-loading middle" style="display: none;"></i></button>
                </div>
                <p style="text-align: center; color: #4D4D4D;margin-top: 12px; cursor: pointer;"><?php echo $_Register['1009']; ?><span class="common-link color-orange" id="again-try"><?php echo $_Register['1010']; ?></span></p>
            </div>
<!--            <div class="register-success" id="register-active" style="display: none;">-->
<!--                <p class="p1" style="margin-bottom: 0;min-height: 130px;">--><?php //echo $_Register['1004']; ?><!--<span class="color-base" id="regAccount">jiangnan@163.com</span>--><?php //echo $_Register['1005']; ?><!--</p>-->
<!--                <p class="color-base"></p>-->
<!--                <div class="btn-box">-->
<!--                    <button class="common-btn ok long" type="button" id="active-btn">--><?php //echo $_Register['1007']; ?><!--</button>-->
<!--                </div>-->
<!--            </div>-->
            <p class="lr-toggle-tips">
                <?php echo $_Register['1001']; ?><a href="/login/" class="common-link color-orange"><?php echo $_Register['1002']; ?></a>
            </p>
        </div>
    </div>
</div>

<div class="home-section3 common-container login-section">
    <ul class="adv-list">
        <li>
            <i class="common-icon icon5"></i>
<!--            <p class="feature">--><?php //echo $_Lang['100185']; ?><!--</p>-->
            <p><?php echo $_Lang['100199']; ?></p>
        </li>
        <li>
            <i class="common-icon icon6"></i>
<!--            <p class="feature">--><?php //echo $_Lang['100187']; ?><!--</p>-->
            <p><?php echo $_Lang['100200']; ?></p>
        </li>
        <li>
            <i class="common-icon icon7"></i>
<!--            <p class="feature">--><?php //echo $_Lang['100189']; ?><!--</p>-->
            <p><?php echo $_Lang['100201']; ?></p>
        </li>
        <li>
            <i class="common-icon icon8"></i>
<!--            <p class="feature">--><?php //echo $_Lang['100191']; ?><!--</p>-->
            <p><?php echo $_Lang['100202']; ?></p>
        </li>
    </ul>
</div>
<?php include_once '../common/tpl/footer.php'; ?>
<script type="text/javascript" src="/common/js/md5.js"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script type="text/javascript" src="js/gt.js"></script>
<script type="text/javascript" src="js/register2.js?v=14"></script>
</body>
</html>
