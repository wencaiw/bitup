<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/18
 * Time: 下午7:11
 */
require_once '../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];

$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '';
$offset = isset($_POST["offset"])&&($_POST["offset"] != 'undefined') ? trim($_POST["offset"]) : 0;
$limit = isset($_POST["limit"])&&($_POST["limit"] != 'undefined') ? trim($_POST["limit"]) : 50;
if($dac_id == ''){
    $ret["errMsg"] = 'dac_id not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['dac_id'] = (int)$dac_id;
    $params['offset'] = (int)$offset;
    $params['limit'] = (int)$limit;

    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dac/order/history', 'new_get', $params, 30, $header));
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