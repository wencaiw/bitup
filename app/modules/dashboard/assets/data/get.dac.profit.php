<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/17
 * Time: 下午4:55
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];

$offset = isset($_POST["offset"])&&($_POST["offset"] != 'undefined') ? trim($_POST["offset"]) : 0;
$limit = isset($_POST["limit"])&&($_POST["limit"] != 'undefined') ? trim($_POST["limit"]) : 50;
$sync_balance = isset($_POST["sync_balance"])&&($_POST["sync_balance"] != 'undefined') ? trim($_POST["sync_balance"]) : '';

try{
    $params = array();
    $params['offset'] = (int)$offset;
    $params['limit'] = (int)$limit;
    if($sync_balance != ''){
        $params['sync_balance'] = (int)$sync_balance;
    }

    $header = array('token:'. $token, 'user_id:'. $user_id);
//    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/profit', 'new_get', $params, 30, $header));
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/balance/dac', 'new_get', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
            /*
             * 固定收益基金 map 字段
             *     +
             * etf指数基金 map 字段
             *     + possess_amount	bigdecimal	持有份数
             *     + sellable_amount	bigdecimal	可赎回份数
             *     + dac_price_on_usdt	bigdecimal	基金当前净值
             *     + dac_tls	list<map>	翻译列表
             *          + zh-cn 表示简体中文
             *               + name  基金名称
             *               + short_name  基金简称
             *          + en-us 表示英文
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