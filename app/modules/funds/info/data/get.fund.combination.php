<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/6/6
 * Time: 下午5:07
 */

require_once '../../../../common/data/api.include.php';  //无需登录引用

//$user_id = $_SESSION['user_id']; //用户标识
//$token = $_SESSION['session_id'];

$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '';
if($dac_id == ''){
    $ret["errMsg"] = 'dac_id not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['dac_id'] = (int)$dac_id;

    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dac/combination', 'new_get', $params, 30));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
            /*
             * init	map	初始时的持仓比例
             * latest	map	现调整后比例
             *     + percent	float	比例
             *     + dac_name string	数字资产名称
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