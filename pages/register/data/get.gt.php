<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 下午2:41
 */
require_once '../../common/data/api.include.php';

try{
    $params = array();
    $params['request_ip'] = get_client_ip();

    $header = array('temp_token:b066f569-2d01-4a70-9f71-b6b06a3098b6');
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/geetest/challenge', 'post', $params, 30, $header));

    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret["resultCode"] = 0;
            $ret["data"] = $result->data;
        }else{
            $ret['errMsg'] = $result->err_detail;
        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }
}catch(Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
print json_encode($ret);