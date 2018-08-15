<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/4/19
 * Time: 上午11:56
 */
require_once 'api.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$national_code = isset($_POST["national_code"])&&($_POST["national_code"] != 'undefined') ? trim($_POST["national_code"]) : '';
$mobile = isset($_POST["mobile"])&&($_POST["mobile"] != 'undefined') ? trim($_POST["mobile"]) : '';
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

try{
    $params = array();
    $params['mobile_national_code'] = $national_code;
    $params['mobile'] = $mobile;
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/sms/code', 'post', $params, 30, $header));
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