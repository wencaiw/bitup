<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 下午2:41
 */
require_once '../../common/data/api.include.php';

$account = isset($_GET["account"]) ? strtolower(trim($_GET["account"])) : '';
$pwd = isset($_GET["pwd"]) ? trim($_GET["pwd"]) : '';
$tfa_code = isset($_GET["tfa_code"]) ? trim($_GET["tfa_code"]) : '';
if(empty($account) || empty($pwd)){
    $ret["errMsg"] = '请输入邮箱或密码';
    print json_encode($ret);
    exit();
}

try{
    $login_ip = get_client_ip();
    $ip_address = get_Address($login_ip);

    $params = array();
    $params['account'] = $account;  //wencai@beecloud.cn
//    $params['password'] = hash_hmac('md5', $pwd, $account, false);
    $params['password'] = $pwd;
    $params['login_ip'] = $login_ip;
    $params['system'] = get_os();
    $params['client'] = get_client_browser();
    $params['province'] = $ip_address['region'] ? $ip_address['region'] : $ip_address['province'];
    $params['city'] = $ip_address['city'];
    $params['country'] = $ip_address['country'];
    $params['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    if($tfa_code != ''){
        $params['tfa_code'] = $tfa_code;
    }
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/login/pc', 'post', $params, 30));

    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret["resultCode"] = 0;
            $ret["data"] = $result->data;
            if($result->data->token){
                BTSession::setSession($result->data->token, $account, $result->data->id);
                BTSession::updateTime();
                BTSession::unblockWrite();
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