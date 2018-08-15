<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 下午2:41
 */
require_once '../../common/data/api.include.php';

$id = isset($_GET["id"]) ? strtolower(trim($_GET["id"])) : '';
$code = isset($_GET["code"]) ? trim($_GET["code"]) : '';
if(empty($id) || empty($code)){
    $ret["errMsg"] = 'id or code cannot be empty!';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['id'] = $id;
    $params['code'] = $code;
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/email/verify', 'new_get', $params, 30));

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