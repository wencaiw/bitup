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

$mode = isset($_POST["mode"])&&($_POST["mode"] != 'undefined') ? trim($_POST["mode"]) : 0;  //0：查询24小时内, 1:7天, 2:3个月

try{
    $params = array();
    $params['mode'] = (int)$mode;

    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/bp10', 'new_get', $params, 30));
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