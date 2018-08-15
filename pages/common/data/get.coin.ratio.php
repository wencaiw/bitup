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
//$symbol = isset($_POST["symbol"])&&($_POST["symbol"] != 'undefined') ? trim($_POST["symbol"]) : '';
$fiat_currency = isset($_POST["fiat_currency"])&&($_POST["fiat_currency"] != 'undefined') ? trim($_POST["fiat_currency"]) : 'usd';
$coin_list = array('BTC' => array(), 'ETH' => array(), 'BUT' => array());

try{
    $params = array();
    $params['fiat_currency'] = $fiat_currency;

    $timestamp = time() * 1000;
    $sign = md5(TEMP_TOKEN . $timestamp . TEMP_SECRET);
    $header = array('timestamp:'. $timestamp, 'sign:'. $sign);

    foreach($coin_list as $k=>$v){
        $params['symbol'] = strtolower($k);
        $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/price/fiat_ratio/all', 'new_get', $params, 30, $header));
//        print_r($result);die();
        if(!isset($result->result_code)){
            $ret["errMsg"] = 'Timeout or no record';
            echo json_encode($ret);
            exit();
        }
        if($result->result_code != 0){
            $ret["errMsg"] = $result->err_detail;
            echo json_encode($ret);
            exit();
        }
        $coin_list[$k]['fiat_ratio'] = $result->data->usd_ratio;
        $coin_list[$k]['cny_ratio'] = $result->data->cny_ratio;
        $coin_list[$k]['usd_ratio'] = $result->data->usd_ratio;
//        $coin_list[$k]['fiat_currency'] = $result->data->fiat_currency;
        $coin_list['USDT']['cny_ratio'] = $result->data->usd_cny;
    }
    $ret['resultCode'] = 0;
    $ret['data'] = $coin_list;

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);