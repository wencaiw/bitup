<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/6/6
 * Time: 上午10:25
 */

require_once '../../../../common/data/api.include.php';

//$user_id = $_SESSION['user_id']; //用户标识
//$token = $_SESSION['session_id'];

$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '';
$currency = isset($_POST["currency"])&&($_POST["currency"] != 'undefined') ? trim($_POST["currency"]) : 'btc';  //衡量货币，例如btc, usd, cny等
$interval = isset($_POST["interval"])&&($_POST["interval"] != 'undefined') ? trim($_POST["interval"]) : 0;  //查询最新N分钟指数信息
$start_time = isset($_POST["start_time"])&&($_POST["start_time"] != 'undefined') ? trim($_POST["start_time"]) : 0;  //起始时间

if($dac_id == ''){
    $ret["errMsg"] = 'dac_id not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['dac_id'] = (int)$dac_id;
    $params['currency'] = strtolower($currency);
    if($interval != 0){
        $params['interval'] = (int)$interval;
    }
    if($start_time != 0){
        $params['start_time'] = (int)$start_time;
    }

    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dac/price/latest', 'new_get', $params, 30));
//    print_r($result);die();
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
            /*
             * trends	array	价格列表
             * day_fluctuation	float	24小时波动
             * week_fluctuation	float	近7天波动
             * month_fluctuation	float	近一个月波动
             * three_month_fluctuation	float	近三个月波动
             * six_month_fluctuation	float	近半年波动
             */
        }else{
            $ret['errMsg'] = $result->err_detail;
        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);