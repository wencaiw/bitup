<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/4/21
 * Time: 下午4:05
 */
require_once '../../../../common/data/api.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '1';
//$start_time = isset($_POST["start_time"])&&($_POST["start_time"] != 'undefined') ? trim($_POST["start_time"]) : '';
//$end_time = isset($_POST["end_time"])&&($_POST["end_time"] != 'undefined') ? trim($_POST["end_time"]) : '';

try{
    $params = array();
    $params['dac_id'] = $dac_id;
//    $params['start_time'] = $start_time;
//    $params['end_time'] = $end_time;

    $timestamp = time() * 1000;
    $sign = md5(TEMP_TOKEN . $timestamp . $dac_id . TEMP_SECRET);
    $header = array('timestamp:'. $timestamp, 'sign:'. $sign);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/promotion/info/daily_assets', 'new_get', $params, 30, $header));

    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
            $ret['x_list'] = array();
            $ret['y_list'] = array();
            foreach($ret['data'] as $item){
//                $ret['x_list'][] = date('m.d', ($item->date)/1000);
                $date_arr = explode('-', $item->date);
                $ret['x_list'][] = $date_arr[1] . '.' . $date_arr[2];
                $ret['y_list'][] = $item->profit_btc_amount;
            }
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