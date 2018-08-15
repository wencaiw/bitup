<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/17
 * Time: 下午9:02
 */
require_once '../../../common/data/api.include.php';

//$user_id = $_SESSION['user_id']; //用户标识
//$token = $_SESSION['session_id'];

$type = isset($_POST["type"])&&($_POST["type"] != 'undefined') ? trim($_POST["type"]) : '1';  //类型，1表示定期固定收益，2表示活期固定收益，10表示ETF指数基金，20表示主动量化基金
$offset = isset($_POST["offset"])&&($_POST["offset"] != 'undefined') ? trim($_POST["offset"]) : '0';  //起始位置
$limit = isset($_POST["limit"])&&($_POST["limit"] != 'undefined') ? trim($_POST["limit"]) : '100';  //查询记录数

try{
    $params = array();
    $params['type'] = (int)$type;
    $params['offset'] = (int)$offset;
    $params['limit'] = (int)$limit;

//    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dacinfo/list', 'new_get', $params, 30));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
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