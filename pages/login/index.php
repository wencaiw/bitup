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

$login = array(
    'en' => array(
        '1001' => ''
    ),
    'cn' => array(
        '1001' => ''
    )
);
$l = $_COOKIE['BT_LANG'];
$_Login = $login[$l];

//$curr_page_id = 1;
$title = '数字资产管理平台 | Digital Asset Investment Platform | BitUP Login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
</head>
<body>

<?php include_once '../common/tpl/top.php'; ?>
<div class="login-wrap">
    <div class="common-container clearfix">
        <div class="banner-box">
            <p class="fz-50" style="padding-top: 160px; line-height: 60px;"><?php echo $_Lang['100203']?></p>
            <p class="fz-24"><?php echo $_Lang['100204']?></p>
        </div>
        <div class="login-main" id="login">
            <h3 class="login-title"><span><?php echo $_Lang['100021']; ?></span></h3>
            <div class="form-box account">
                <input type="text" placeholder="<?php echo $_Lang['100153']; ?>" class="input-text" id="account">
            </div>
            <div class="form-box pwd">
                <input type="password" placeholder="<?php echo $_Lang['100154']; ?>" class="input-text" id="pwd">
            </div>
            <div class="temp-box">
                <p class="error"></p>
            </div>
            <div class="btn-box">
                <button class="common-btn ok long" type="button" id="login-sub"><span><?php echo $_Lang['100021']; ?></span><i class="common-icon icon-loading middle" style="display: none;"></i></button>
            </div>
            <p class="clearfix" style="margin-top: 8px;"><a href="/retrieve/" class="common-link fr fz-12 color-gray" text="<?php echo $_Lang['100198']; ?>"><?php echo $_Lang['100155']; ?></a></p>
            <p class="lr-toggle-tips">
                <?php echo $_Lang['100157']; ?><a href="/register/" class="common-link color-orange"><?php echo $_Lang['100156']; ?></a>
            </p>
        </div>
        <div class="login-main" id="login-2fa" style="display: none;">
            <h3 class="login-title"><span><?php echo $_Lang['100158']; ?></span></h3>
            <div class="form-box pwd">
                <input type="text" placeholder="<?php echo $_Lang['100158']; ?>" class="input-text" id="tfa_code">
            </div>
            <div class="temp-box">
                <p class="error"></p>
            </div>
            <div class="btn-box clearfix">
                <button class="common-btn ok fl" type="button" id="confirm"><span><?php echo $_Lang['100160']; ?></span><i class="common-icon icon-loading middle" style="display: none;"></i></button>
                <button class="common-btn fr" type="button" id="cancel"><?php echo $_Lang['100161']; ?></button>
            </div>
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
<script type="text/javascript" src="/common/js/login2.js?v=1"></script>
</body>
</html>
