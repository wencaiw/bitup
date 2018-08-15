<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 下午2:41
 */
require_once '../../common/data/api.include.php';

$account = isset($_POST["account"]) ? strtolower(trim($_POST["account"])) : '';
$code = isset($_POST["code"]) ? trim($_POST["code"]) : '';
$pwd = isset($_POST["pwd"]) ? trim($_POST["pwd"]) : '';
$referral = isset($_POST["referral"]) ? trim($_POST["referral"]) : '';
if(empty($account) || empty($pwd)){
    $ret["errMsg"] = 'Please enter a account or a password';
    print json_encode($ret);
    exit();
}
//if(preg_match("/^\\d+$/", $pwd) || preg_match("/^[a-zA-Z]+$/", $pwd) || !preg_match("/^[A-Za-z0-9]{8,12}$/", $pwd)){
//    $ret["errMsg"] = 'Incorrect password format';
//    print json_encode($ret);
//    exit();
//}

try{
    $params = array();
    $params['email'] = $account;
    $params['code'] = $code;
//    $params['password'] = hash_hmac('md5', $pwd, $account, false);
    $params['password'] = $pwd;
    $params['referral'] = $referral;
    $params['request_ip'] = get_client_ip();
    $params['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/register/pc', 'post', $params, 30));

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