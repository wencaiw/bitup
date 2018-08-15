<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/26
 * Time: 下午3:28
 */
require_once 'api.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];

try{
    $params = array();
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/dashboard/index', 'get', $params, 30, $header));
    file_put_contents("/tmp/bitup_test_log", var_export($result, TRUE), FILE_APPEND);
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
            $ret['data']->last_login_date = ((isset($result->data->last_login_time) && $result->data->last_login_time != 0) ? date('Y.m.d H:i:s', $ret['data']->last_login_time/1000) : '--');
            $ret['data']->account = $_SESSION['account'];
            $ret['data']->address = (!$result->data->last_login_city && !$result->data->last_login_country && !$result->data->last_login_province) ? '--' : $result->data->last_login_country.$result->data->last_login_province.$result->data->last_login_city;
            $ret['data']->coin_list = array(
                'BTC' => array(
                    'free' => 0,
                    'frozen' => 0
                ),
                'BUT' => array(
                    'free' => 0,
                    'frozen' => 0
                )
            );
            foreach($ret['data']->balances as $item){
                $ret['data']->coin_list[strtoupper($item->symbol)] = array();
                $ret['data']->coin_list[strtoupper($item->symbol)]['free'] = $item->free;
                $ret['data']->coin_list[strtoupper($item->symbol)]['frozen'] = $item->frozen;
            }

//            if($result->data->balances){
//                foreach($result->data->balances as $item){
//                    $ret['data']->coin_list[$item->symbol] = $item;
//                }
//            }

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

//        else if($result->result_code == 4 && ($result->result_msg == 'INVALID_TOKEN' || $result->result_msg == 'TOKEN_EXPIRE')){
//            BTSession::open();
//            BTSession::close();
//            $ret['resultCode'] = 2;
//            $ret['logout'] = true;
//            $ret['errMsg'] = 'No logon or session timeout';
//        }else{
//            $ret['errMsg'] = $result->err_detail;
//        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

//    $ret['resultCode'] = 0;
//    $ret['data'] = array(
//        'id_name' => 'Hajay',
//        'active' => false,
//        'assets' => array(
//            'USD' => 0,   //美分
//            'BTC' => 0.019156,
//            'ETH' => 0.349624,
//            'dac_list' => array(
//                'BPP' => array(
//                    'amount' => 550.000000,
//                    'curr_profit_loss' => 766.37,
//                    'curr_profit_loss_ratio' => 0.9429,
//                    'profit_taken' => 0,
//                    'profit_taken_ratio' => 0,
//                    'all_profit_loss' => 766.37,
//                    'all_profit_loss_ratio' => 0.9429,
//                )
//            )
//        )
//    );

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);