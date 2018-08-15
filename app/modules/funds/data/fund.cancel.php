<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/6/6
 * Time: 上午11:37
 */

require_once '../../../common/data/api.include.php';  //需登录引用

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];

$fund_type = isset($_POST["fund_type"])&&($_POST["fund_type"] != 'undefined') ? trim($_POST["fund_type"]) : '';  //类型，fixed:币币宝定期， flexible:币币宝活期, passive:被动基金，active:主动基金
$dac_order_id = isset($_POST["dac_order_id"])&&($_POST["dac_order_id"] != 'undefined') ? trim($_POST["dac_order_id"]) : '';
if($dac_order_id == ''){
    $ret["errMsg"] = 'order not exist';
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
            break;
//        case 'active':
//            break;
        default:
            $ret["errMsg"] = 'fund type not exist';
            print json_encode($ret);
            exit();
    }
    $params['dac_order_id'] = (int)$dac_order_id;
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dac/' . $fund_type . '/order/cancel', 'post', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
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