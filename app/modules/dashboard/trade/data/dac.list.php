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
            'dac_id' => '000000000000000001',
            'name' => 'BitUP Prime',
            'short_name' => 'BPP',
            'admin' => 'BitUP',
            'desc_en' => '',
            'desc_ch' => '',
            'init_price' => 2.8712,
            'init_coin_ratio' => array(
                'USDT' => 0.50,
                'ETC' => 0.20,
                'ETH' => 0.20,
                'LTC' => 0.10
            ),
            'current_coin_ratio' => array(
                'USDT' => 0.4778,
                'ETC' => 0.2072,
                'ETH' => 0.2102,
                'LTC' => 1048
            ),
            'coin_amount' => array(
                'USDT' => 47.78,
                'ETC' => 4.32,
                'ETH' => 0.0245,
                'LTC' => 0.0356
            ),
            'created_at' => '2018-01-01 14:25:36',
            'updated_at' => '2018-01-01 14:25:36',
            'management_ratio' => 0.003,
            'price' => 2.8712,
            'returnRate' => array(
                'day' => -0.0036,
                'week' => 0.2903,
                'month' => 1.1986,
                'threeMonth' => 3.5763,
                'sixMonth' => 6.9351
            )
        )
    );

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);