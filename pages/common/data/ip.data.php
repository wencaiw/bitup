<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/22
 * Time: 下午8:32
 */

require_once '../../common/data/api.include.php';

try{
    $params = array();
    $result = json_decode(BTHttp::request('https://api.ipdata.co', 'get', $params, 30));
    print_r($result);die();

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