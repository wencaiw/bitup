<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/2
 * Time: 下午2:58
 */
require_once "../sdkv2/BTRequest.class.php";
require_once "../sdkv2/config.php";
require_once "../common/data/include.php";

$verify = array(
    'en' => array(
        '1001' => 'Email verification',
        '1002' => 'Hi, ',
        '1003' => '. Email verification has been successful, your account has completed registration.',
        '1004' => '. Email verification link has expired.',
        '1005' => 'Go to BitUP',
        '1006' => '. Email verification error.'
    ),
    'cn' => array(
        '1001' => '邮件验证',
        '1002' => '你好，',
        '1003' => '。邮件验证已经成功，你的帐号已经完成注册。',
        '1004' => '。邮件验证链接已过期。',
        '1005' => '去BitUP官网',
        '1006' => '。邮件验证失败。'
    )
);
$l = $_COOKIE['BT_LANG'];
$_Verify = $verify[$l];

$curr_page_id = 1;
$title = 'BitUP Verify';

//定义结果
$verify_result = -1;
$account = '';
$result_msg = '';
//获取参数
$id = isset($_GET["id"]) ? strtolower(trim($_GET["id"])) : '';
$code = isset($_GET["code"]) ? trim($_GET["code"]) : '';
//调取后端接口激活
$params = array();
$params['id'] = $id;
$params['code'] = $code;
$result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/email/verify', 'new_get', $params, 30));
print_r($result);
if(isset($result->result_code)){
    $verify_result = $result->result_code;
    $account = $result->data->email;
    if($result->result_code != 0){
        $result_msg = $result->result_msg;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
</head>
<body>

<div class="login-wrap verify-wrap">
    <div class="common-container">
        <img src="/common/images/logo-white.png" class="logo" alt="">
    </div>
</div>
<div class="verify-main common-container">
    <h3 class="title"><?php echo $_Verify['1001']; ?></h3>
    <?php if($verify_result == 0){ ?>
        <p>
            <i class="common-icon icon-ok"></i>
            <span><?php echo $_Verify['1002']; ?></span><span class="color-orange"><?php echo $account; ?></span><span><?php echo $_Verify['1003']; ?></span>
        </p>
    <?php }else if($verify_result == 5 && $result_msg == 'OPERATION_TIMEOUT'){ ?>
        <p>
            <i class="common-icon icon-fail"></i>
            <span><?php echo $_Verify['1002']; ?></span><span class="color-orange"><?php echo $account; ?></span><span><?php echo $_Verify['1004']; ?></span>
        </p>
    <?php }else{ ?>
        <p>
            <i class="common-icon icon-fail"></i>
            <span><?php echo $_Verify['1002']; ?></span><span class="color-orange"><?php echo $account; ?></span><span><?php echo $_Verify['1006']; ?></span>
        </p>
    <?php } ?>
    <p>
        <a href="/index.php" class="common-btn ok"><?php echo $_Verify['1005']; ?></a>
    </p>
</div>

</body>
</html>
