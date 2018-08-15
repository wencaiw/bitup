<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/7/18
 * Time: 下午5:38
 */
require_once '../../../common/data/api.include.php';

$fund_type = isset($_POST["fund_type"])&&($_POST["fund_type"] != 'undefined') ? trim($_POST["fund_type"]) : '';  //类型，bbb:币币宝，passive:被动基金，active:主动基金
$currency = isset($_POST["currency"])&&($_POST["currency"] != 'undefined') ? trim($_POST["currency"]) : 'usdt';  //预留:不需要传

$fund_type_list = array('bbb', 'passive', 'active');
if(!in_array($fund_type, $fund_type_list)){
    $ret["errMsg"] = 'fund type not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['currency'] = $currency;

    $result = json_decode(BTHttp::request(BT_BACKEND_URL . '/v1/rest/dacinfo/' . $fund_type . '/recommend', 'new_get', $params, 30));
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