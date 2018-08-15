<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/18
 * Time: 下午7:51
 *
 * auth_level	int	已经认证的最高等级
 * pending_level	int	当前正在处理的认证等级，比如实名认证需要人工审核，如果尚未审核或者审核失败了，都会包含该字段，如果没有正在处理的认证，不返回
 * pending_status	int	0 表示审核中，2表示审核失败
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];

try{
    $params = array();
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/tier', 'new_get', $params, 30, $header));

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