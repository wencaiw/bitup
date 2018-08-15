<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/4/16
 * Time: 上午9:57
 */

require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$coin = isset($_POST["coin"])&&($_POST["coin"] != 'undefined') ? trim($_POST["coin"]) : '';
$coin_address = isset($_POST["coin_address"])&&($_POST["coin_address"] != 'undefined') ? trim($_POST["coin_address"]) : '';
$amount = isset($_POST["amount"])&&($_POST["amount"] != 'undefined') ? trim($_POST["amount"]) : 0;
$sms_id = isset($_POST["sms_id"])&&($_POST["sms_id"] != 'undefined') ? trim($_POST["sms_id"]) : '';
$sms_code = isset($_POST["sms_code"])&&($_POST["sms_code"] != 'undefined') ? trim($_POST["sms_code"]) : '';
$tfa_code = isset($_POST["tfa_code"])&&($_POST["tfa_code"] != 'undefined') ? trim($_POST["tfa_code"]) : '';
$mail_code_id = isset($_POST["mail_code_id"])&&($_POST["mail_code_id"] != 'undefined') ? trim($_POST["mail_code_id"]) : '';
$mail_code = isset($_POST["mail_code"])&&($_POST["mail_code"] != 'undefined') ? trim($_POST["mail_code"]) : '';

if(empty($coin)){
    $ret["errMsg"] = 'Please choose the Coin';
    print json_encode($ret);
    exit();
}
if(empty($coin_address)){
    $ret["errMsg"] = 'Please choose the Coin Address';
    print json_encode($ret);
    exit();
}
if($amount <= 0){
    $ret["errMsg"] = 'Please choose Withdraw Amount';
    print json_encode($ret);
    exit();
}
if(empty($sms_id)){
    $ret["errMsg"] = 'miss params sms_id';
    print json_encode($ret);
    exit();
}
if(empty($sms_code)){
    $ret["errMsg"] = 'Please enter the phone verification code';
    print json_encode($ret);
    exit();
}
if(empty($tfa_code)){
    $ret["errMsg"] = 'Please enter the 2FA code';
    print json_encode($ret);
    exit();
}
if(empty($mail_code_id)){
    $ret["errMsg"] = 'miss params mail_code_id';
    print json_encode($ret);
    exit();
}
if(empty($mail_code)){
    $ret["errMsg"] = 'Please enter the email verification code';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['coin'] = $coin;
    $params['receiver_address'] = $coin_address;
    $params['amount'] = "$amount";
    $params['sms_id'] = (int)$sms_id;
    $params['sms_code'] = $sms_code;
    $params['tfa_code'] = $tfa_code;
    $params['mail_code_id'] = (int)$mail_code_id;
    $params['mail_code'] = $mail_code;

    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/wallet/withdraw', 'post', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
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