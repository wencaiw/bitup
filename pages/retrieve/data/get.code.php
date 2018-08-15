<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/19
 * Time: 下午3:34
 */

require_once '../../common/data/api.include.php';

$account = isset($_POST["account"]) ? strtolower(trim($_POST["account"])) : '';
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

try{
    $params = array();
    $params['email'] = $account;
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/findback', 'post', $params, 30));

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