<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/4/21
 * Time: 下午4:05
 */
require_once '../../../../common/data/api.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '1';

try{
    $params = array();
    $params['dac_id'] = $dac_id;

    $timestamp = time() * 1000;
    $sign = md5(TEMP_TOKEN . $timestamp . $dac_id . TEMP_SECRET);
    $header = array('timestamp:'. $timestamp, 'sign:'. $sign);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/promotion/info/dac', 'new_get', $params, 30, $header));

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