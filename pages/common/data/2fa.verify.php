<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 下午2:41
 */
require_once '../../common/data/api.include.php';

$token = isset($_GET["token"]) ? trim($_GET["token"]) : '';
$user_id = isset($_GET["user_id"]) ? trim($_GET["user_id"]) : '';
$account = isset($_GET["account"]) ? strtolower(trim($_GET["account"])) : '';
$code = isset($_GET["code"]) ? trim($_GET["code"]) : '';
if(empty($token) || empty($user_id)){
    $ret["errMsg"] = 'token或user_id不可为空';
    print json_encode($ret);
    exit();
}
if(empty($code)){
    $ret["errMsg"] = '请输入2FA密码';
    print json_encode($ret);
    exit();
}

try{
    //2FA
    $params = array();
    $params['user_id'] = $user_id;
    $params['code'] = $code;
    $header = array('token:'. $token);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/2fa/verify', 'post', $params, 30, $header));

    if(isset($result->result_code)){
        if($result->result_code == 0){
            if($result->data->verify_result){
                $ret["resultCode"] = 0;
                BTSession::setSession($token, $account, $user_id);
                BTSession::updateTime();
                BTSession::unblockWrite();
            }else{
                $ret["errMsg"] = '校验未通过';
            }
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