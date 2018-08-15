<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/5
 * Time: 下午5:36
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$code_id = isset($_POST["code_id"])&&($_POST["code_id"] != 'undefined') ? trim($_POST["code_id"]) : '';
$code = isset($_POST["code"])&&($_POST["code"] != 'undefined') ? trim($_POST["code"]) : '';
$national_code = isset($_POST["national_code"])&&($_POST["national_code"] != 'undefined') ? trim('00'.$_POST["national_code"]) : '';
$mobile = isset($_POST["mobile"])&&($_POST["mobile"] != 'undefined') ? trim($_POST["mobile"]) : '';
if(empty($code_id)){
    $ret["errMsg"] = 'code_id cannot be empty';
    print json_encode($ret);
    exit();
}
if(empty($national_code)){
    $ret["errMsg"] = 'Please choose the phone international area code';
    print json_encode($ret);
    exit();
}
if(empty($mobile)){
    $ret["errMsg"] = 'Please enter the phone number';
    print json_encode($ret);
    exit();
}
if(empty($code)){
    $ret["errMsg"] = 'Please enter the phone verification code';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['code_id'] = (int)$code_id;
    $params['mobile_national_code'] = $national_code;
    $params['mobile'] = $mobile;
    $params['code'] = $code;
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/sms/verify', 'put', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            if($result->data->verify_result == 1){
                $ret['resultCode'] = 0;
            }else{
                $ret['errMsg'] = $result->data->verify_msg;
            }
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