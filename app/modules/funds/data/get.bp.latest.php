<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/6/1
 * Time: 下午2:23
 */
require_once '../../../common/data/api.include.php';

//$user_id = $_SESSION['user_id']; //用户标识
//$token = $_SESSION['session_id'];

$type = isset($_POST["type"])&&($_POST["type"] != 'undefined') ? trim($_POST["type"]) : '';  //indexType取值为bp10,bpp  bp10表示BP10，bpp表示平台币基金
$interval = isset($_POST["interval"])&&($_POST["interval"] != 'undefined') ? trim($_POST["interval"]) : 0;  //查询最新N分钟指数信息
$start_time = isset($_POST["start_time"])&&($_POST["start_time"] != 'undefined') ? trim($_POST["start_time"]) : 0;  //起始时间

$type_list = array('bp10', 'bpp');
if(!in_array($type, $type_list)){
    $ret["errMsg"] = 'Index type not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    if($interval != 0){
        $params['interval'] = (int)$interval;
    }
    if($start_time != 0){
        $params['start_time'] = (int)$start_time;
    }

    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/index/' . $type . '/latest', 'new_get', $params, 30));
//    print_r($result);die();
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
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