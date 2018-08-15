<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/19
 * Time: 下午3:42
 */

require_once '../../common/data/api.include.php';

$account = isset($_POST["account"]) ? strtolower(trim($_POST["account"])) : '';
$code = isset($_POST["code"]) ? trim($_POST["code"]) : '';
$pwd = isset($_POST["pwd"]) ? trim($_POST["pwd"]) : '';
if(empty($account) || empty($pwd)){
    $ret["errMsg"] = 'Please enter a account or a password';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['email'] = $account;
    $params['code'] = $code;
//    $params['password'] = hash_hmac('md5', $pwd, $account, false);
    $params['new_password'] = $pwd;
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/reset_pw', 'post', $params, 30));

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