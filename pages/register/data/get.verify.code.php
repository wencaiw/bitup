<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 下午2:41
 */
require_once '../../common/data/api.include.php';

$account = isset($_POST["account"]) ? strtolower(trim($_POST["account"])) : '';
$recaptcha_provider = isset($_POST['recaptcha_provider']) ? trim($_POST['recaptcha_provider']) : 'google';
$geetest_challenge = isset($_POST['geetest_challenge']) ? trim($_POST['geetest_challenge']) : '';
$geetest_validate = isset($_POST['geetest_validate']) ? trim($_POST['geetest_validate']) : '';
$geetest_seccode = isset($_POST['geetest_seccode']) ? trim($_POST['geetest_seccode']) : '';
$google_recaptcha = isset($_POST['google_recaptcha']) ? trim($_POST['google_recaptcha']) : '';
//$recaptcha = isset($_POST['recaptcha']) ? trim($_POST['recaptcha']) : '';
if(empty($account)){
    $ret["errMsg"] = 'Please enter a account';
    print json_encode($ret);
    exit();
}
$pattern = "/^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$/";
if(!preg_match($pattern, $account)){
    $ret["errMsg"] = 'Incorrect email format';
    print json_encode($ret);
    exit();
}

//临时处理
//if($recaptcha_provider != 'google'){
//    $ret['errMsg'] = 'Verification Error';
//    echo json_encode($ret);
//    exit;
//}

if($recaptcha_provider == 'geetest'){
    if(empty($geetest_challenge) || empty($geetest_validate) || empty($geetest_seccode)){
        $ret['errMsg'] = 'Verification Error';
        echo json_encode($ret);
        exit;
    }
    $header = array('recaptcha_provider:' . $recaptcha_provider, 'geetest_challenge:' . $geetest_challenge, 'geetest_validate:' . $geetest_validate, 'geetest_seccode:' . $geetest_seccode);
}else{
    if(empty($google_recaptcha)){
        $ret['errMsg'] = 'Verification error, please make sure Google CAPTCHA can be correctly displayed in your Internet and refresh the page.';
        echo json_encode($ret);
        exit;
    }
    $header = array('recaptcha_provider:' . $recaptcha_provider, 'google_recaptcha:' . $google_recaptcha);
}

try{
    $params = array();
    $params['email'] = $account;
    $params['request_ip'] = get_client_ip();
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/email/init', 'post', $params, 30, $header));

    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret["resultCode"] = 0;
        }else{
            $ret['errMsg'] = $result->err_detail;
        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }
}catch(Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
print json_encode($ret);