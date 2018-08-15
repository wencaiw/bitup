<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/4/21
 * Time: 下午4:05
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '1';
$amount = isset($_POST["amount"])&&($_POST["amount"] != 'undefined') ? trim($_POST["amount"]) : 0;

try{
    $params = array();
    $params['dac_id'] = (int)$dac_id;
    $params['trade_currency'] = 'but';
    $params['amount'] = (string)$amount;

    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/promotion/order/buy', 'post', $params, 30, $header));

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
                if($result->result_code == 3){
                    if($result->result_msg == 'BUT_BALANCE_NOT_ENOUGH'){
                        $ret['resultCode'] = 300000;
                    }else if($result->result_msg == 'VALID_AMOUNT_NOT_ENOUGH'){
                        $ret['resultCode'] = 300005;
                    }else{
                        $ret['errMsg'] = $result->err_detail;
                    }
                }else if($result->result_code == 18){
                    if($result->result_msg == 'AMOUNT_TOO_SMALL_LESS_MIN'){
                        $ret['resultCode'] = 300001;
                    }else if($result->result_msg == 'AMOUNT_TOO_SMALL_LESS_1K'){
                        $ret['resultCode'] = 300002;
                    }else if($result->result_msg == 'AMOUNT_TOO_LARGE'){
                        $ret['resultCode'] = 300003;
                    }else if($result->result_msg == 'TOTAL_AMOUNT_NOT_ENOUGH'){
                        $ret['resultCode'] = 300004;
                    }else if($result->result_msg == 'REMAIN_AMOUNT_LESS_MIN'){
                        $ret['resultCode'] = 300006;
                    }else if($result->result_msg == 'AMOUNT_TOO_SMALL_LESS_1K'){
                        $ret['resultCode'] = 300007;
                    }else{
                        $ret['errMsg'] = $result->err_detail;
                    }
                }else{
                    $ret['errMsg'] = $result->err_detail;
                }
            }
        }

//        else if($result->result_code == 4 && ($result->result_msg == 'INVALID_TOKEN' || $result->result_msg == 'TOKEN_EXPIRE')){
//            BTSession::open();
//            BTSession::close();
//            $ret['resultCode'] = 2;
//            $ret['logout'] = true;
//            $ret['errMsg'] = 'No logon or session timeout';
//        }else if($result->result_code == 3){
//            if($result->result_msg == 'BUT_BALANCE_NOT_ENOUGH'){
//                $ret['resultCode'] = 300000;
//            }else if($result->result_msg == 'VALID_AMOUNT_NOT_ENOUGH'){
//                $ret['resultCode'] = 300005;
//            }else{
//                $ret['errMsg'] = $result->err_detail;
//            }
//        }else if($result->result_code == 18){
//            if($result->result_msg == 'AMOUNT_TOO_SMALL_LESS_MIN'){
//                $ret['resultCode'] = 300001;
//            }else if($result->result_msg == 'AMOUNT_TOO_SMALL_LESS_1K'){
//                $ret['resultCode'] = 300002;
//            }else if($result->result_msg == 'AMOUNT_TOO_LARGE'){
//                $ret['resultCode'] = 300003;
//            }else if($result->result_msg == 'TOTAL_AMOUNT_NOT_ENOUGH'){
//                $ret['resultCode'] = 300004;
//            }else if($result->result_msg == 'REMAIN_AMOUNT_LESS_MIN'){
//                $ret['resultCode'] = 300006;
//            }else if($result->result_msg == 'AMOUNT_TOO_SMALL_LESS_1K'){
//                $ret['resultCode'] = 300007;
//            }else{
//                $ret['errMsg'] = $result->err_detail;
//            }
//        }else{
//            $ret['errMsg'] = $result->err_detail;
//        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);