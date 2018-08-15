<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/6/6
 * Time: 上午11:29
 */

require_once '../../../../common/data/api.include.php';  //需登录引用

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];

$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '';
if($dac_id == ''){
    $ret["errMsg"] = 'dac_id not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['dac_id'] = (int)$dac_id;
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dac/unfixed/order/pre-info', 'new_get', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
            /*
             * dac_price_on_usdt	BigDecimal	基金净值，usdt计价
             * user_possess_amount	BigDecimal	用户持有份数
             * dac_left_on_usdt	BigDecimal	可投额度，usdt计价
             * user_sellable_amount	BigDecimal	可赎回份数
             */
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