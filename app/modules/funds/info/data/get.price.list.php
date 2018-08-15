<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/6/5
 * Time: 下午8:50
 */
require_once '../../../../common/data/api.include.php';  //无需登录引用

//$user_id = $_SESSION['user_id']; //用户标识
//$token = $_SESSION['session_id'];

$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '';
$currency = isset($_POST["currency"])&&($_POST["currency"] != 'undefined') ? trim($_POST["currency"]) : 'btc';  //衡量货币，例如btc, usd, cny等
$mode = isset($_POST["mode"])&&($_POST["mode"] != 'undefined') ? trim($_POST["mode"]) : 0;  //0:24小时，1：七天，2:一个月，3:三个月，4:半年
if($dac_id == ''){
    $ret["errMsg"] = 'dac_id not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['dac_id'] = (int)$dac_id;
    $params['currency'] = strtolower($currency);
    $params['mode'] = (int)$mode;

    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dac/price', 'new_get', $params, 30));
//    print_r($result);die();
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
        }else{
            $ret['errMsg'] = $result->err_detail;
        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);