<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/15
 * Time: 下午4:39
 *
 * 如果当前用户认证等级<1或者>=2，返回result_code不为0，否则返回认证等级为1的用户信息
 * 如果status=true,则返回用户基本信息
 * 如果status=false,则返回用户基本信息
 * 返回参数:status	boolean	false:审核中 true:审核失败或者从未提交过认证信息
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];

try{
    $params = array();
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/tier01', 'new_get', $params, 30, $header));

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