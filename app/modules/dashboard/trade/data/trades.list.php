<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/30
 * Time: 下午4:38
 */
require_once '../../../../common/data/api.include.php';

$account = $_SESSION['account']; //用户标识
$session_id = $_SESSION['session_id'];

try{
    $params = array();
    $params['account'] = $account;
    $params['session_id'] = $session_id;
//    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/dac', 'get', $params, 30));
//    if(isset($result->result_code)){
//        if($result->result_code == 0){
//            $ret['resultCode'] = 0;
//            $ret['data'] = $result->items;
//            foreach($ret['data'] as $k => $v){
//                $v->create_date = date('Y年m月d日', ($v->create_date)/1000);
//            }
//        }else{
//            $ret['errMsg'] = $result->err_detail;
//        }
//    }else{
//        $ret["errMsg"] = '超时或者没有记录';
//    }
    $ret['resultCode'] = 0;
    $ret['data'] = array(
        array(
            'order_id' => '20180102315564600001',
            'dac_id' => '000000000000000001',
            'direction' => 'buy',
            'price' => 2.8712,
            'amount' => 550.000000,
            'trade_currency' => 'BTC',
            'exchange_ratio' => 0.01,
            'trade_currency_amount' => 0.01,
            'trade_currency_price' => 2.8712,
            'fee' => 0,
            'trade_fiat_value' => 2.8712,
            'status' => 'success',
            'success_time' => '2018-01-23 14:26:36',
            'created_at' => '2018-01-23 14:25:36',
            'updated_at' => '2018-01-23 16:25:36'
        )
    );

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);