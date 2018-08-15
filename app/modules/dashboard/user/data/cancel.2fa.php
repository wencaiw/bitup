<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/11
 * Time: 下午3:54
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$tfa_code = isset($_POST["tfa_code"])&&($_POST["tfa_code"] != 'undefined') ? trim($_POST["tfa_code"]) : '';
$sms_id = isset($_POST["sms_id"])&&($_POST["sms_id"] != 'undefined') ? trim($_POST["sms_id"]) : '';
$sms_code = isset($_POST["sms_code"])&&($_POST["sms_code"] != 'undefined') ? trim($_POST["sms_code"]) : '';
$mail_code_id = isset($_POST["mail_code_id"])&&($_POST["mail_code_id"] != 'undefined') ? trim($_POST["mail_code_id"]) : '';
$mail_code = isset($_POST["mail_code"])&&($_POST["mail_code"] != 'undefined') ? trim($_POST["mail_code"]) : '';
if(empty($tfa_code)){
    $ret["errMsg"] = 'Please Enter 2FA verification code';
    print json_encode($ret);
    exit();
}
if(empty($sms_code)){
    $ret["errMsg"] = 'Please Enter phone verification code';
    print json_encode($ret);
    exit();
}
if(empty($mail_code)){
    $ret["errMsg"] = 'Please Enter email verification code';
    print json_encode($ret);
    exit();
}
if(empty($sms_id)){
    $ret["errMsg"] = 'sms_id cannot be empty';
    print json_encode($ret);
    exit();
}
if(empty($mail_code_id)){
    $ret["errMsg"] = 'mail_code_id cannot be empty';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['tfa_code'] = $tfa_code;
    $params['sms_id'] = (int)$sms_id;
    $params['sms_code'] = $sms_code;
    $params['mail_code_id'] = (int)$mail_code_id;
    $params['mail_code'] = $mail_code;
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/2fa/deactivate', 'post', $params, 30, $header));

    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
        }else{
            if(result_logout($result)){
                BTSession::open();
                BTSession::close();
                $ret['resultCode'] = 2;
                $ret['logout'] = true;
                $ret['errMsg'] = 'No logon or session timeout';
            }else{
                $ret['errMsg'] = $result->err_detail;
            }
        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);