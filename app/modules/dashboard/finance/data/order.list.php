<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/30
 * Time: 下午4:38
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$skip = isset($_POST["skip"])&&($_POST["skip"] != 'undefined') ? trim($_POST["skip"]) : 0;       //从第几个记录开始
$limit = isset($_POST["limit"])&&($_POST["limit"] != 'undefined') ? trim($_POST["limit"]) : 20;  //查询多少条
$type = isset($_POST["type"])&&($_POST["type"] != 'undefined') ? trim($_POST["type"]) : '';       //0充值 1提现
$coin = isset($_POST["coin"])&&($_POST["coin"] != 'undefined') ? trim($_POST["coin"]) : '';      //过滤条件 如btc but

try{
    $params = array();
    $params['offset'] = $skip;
    $params['limit'] = $limit;
    if($type != ''){
        $params['type'] = (int)$type;
    }
    if($coin != ''){
        $params['coin'] = strtolower($coin);
    }

    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/wallet/order', 'new_get', $params, 30, $header));

    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
//            $ret['data'][] = array(
//                "id" => 4,
//                "userId" => 10602,
//                "type" => "WITHDRAW",
//                "coin" => "BTC",
//                "address" => "0xaddf50d97987e21d3b5f5256c7702cb4994fa8ae",
//                "amount" => 0.8,
//                "txnFee" => null,
//                "fiatAmount" => null,
//                "orderId" => "30fe24a9-159f-420c-9307-ad111d66442f",
//                "txnHash" => null,
//                "createdAt" => 1523602827000,
//                "updatedAt" => 1523602827000,
//                "blockHash" => null,
//                "blockHeight" => null,
//                "syncBalance" => 0,
//                "approveWithdraw" => 0
//            );
//            foreach($ret['data'] as $k => $v){
//                $v->create_date = date('Y-m-d', ($v->created_at)/1000);
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
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

//    $ret['data'] = array(
//        array(
//            'order_id' => '20180102315564600001',
//            'type' => 'WITHDRAW',
//            'address' => '',
//            'coin' => 'BTC',
//            'price' => 11800,
//            'amount' => 0.019156,
//            'txn_fee' => 0.0001,     //手续费
//            'fiat_amount' => 321.53,  //操作时等值的法币金额
//            'status' => 'success',
//            'success_time' => '2018-01-23 14:26:36',
//            'created_at' => '2018-01-23 14:25:36',
//            'updated_at' => '2018-01-23 16:25:36'
//        ),
//        array(
//            'order_id' => '20180102315564600002',
//            'type' => 'WITHDRAW',
//            'address' => '',
//            'coin' => 'ETH',
//            'price' => 1100,
//            'amount' => 1.600000,
//            'txn_fee' => 0.001,
//            'fiat_amount' => 998.4,
//            'status' => 'success',
//            'success_time' => '2018-01-23 14:26:36',
//            'created_at' => '2018-01-23 14:25:36',
//            'updated_at' => '2018-01-23 16:25:36'
//        )
//    );

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);