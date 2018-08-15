<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/8/9
 * Time: 上午11:11
 */
require_once '../../../common/data/api.token.include.php';  //需登录引用

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];

$fund_type = isset($_POST["fund_type"])&&($_POST["fund_type"] != 'undefined') ? trim($_POST["fund_type"]) : '';  //类型，fixed:币币宝定期， flexible:币币宝活期, passive:被动基金，active:主动基金
$amount = isset($_POST["amount"])&&($_POST["amount"] != 'undefined') ? trim($_POST["amount"]) : '0';  //卖出份数
$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '';
$sell_currency = isset($_POST["sell_currency"])&&($_POST["sell_currency"] != 'undefined') ? trim($_POST["sell_currency"]) : '';  //卖出结算的币种，btc eth等小写
$fee_currency = isset($_POST["fee_currency"])&&($_POST["fee_currency"] != 'undefined') ? trim($_POST["fee_currency"]) : '';  //可不传 优先支付手续费的币种，but btc等小写

if($amount <= 0){
    $ret["errMsg"] = 'amount must be more than 0';
    print json_encode($ret);
    exit();
}
if($dac_id == ''){
    $ret["errMsg"] = 'dac_id not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    switch($fund_type){
//        case 'fixed':
//            break;
        case 'flexible':
            $fund_type = 'current';
            break;
        case 'passive':
            $fund_type = 'unfixed';
            if($sell_currency == ''){
                $ret["errMsg"] = 'Please choose the currency';
                print json_encode($ret);
                exit();
            }
            $params['sell_currency'] = strtolower($sell_currency);
            if($fee_currency != ''){
                $params['fee_currency'] = strtolower($fee_currency);
            }else{
                $params['fee_currency'] = strtolower($sell_currency);
            }
            break;
//        case 'active':
//            break;
        default:
            $ret["errMsg"] = 'fund type not exist';
            print json_encode($ret);
            exit();
    }

    $params['amount'] = $amount;
    $params['dac_id'] = (int)$dac_id;

    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dac/' . $fund_type . '/order/sell', 'post', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
//            $ret['data'] = $result->data;
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