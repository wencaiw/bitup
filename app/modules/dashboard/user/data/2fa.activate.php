<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/5
 * Time: 下午5:36
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$code = isset($_POST["code"])&&($_POST["code"] != 'undefined') ? trim($_POST["code"]) : '';
if(empty($code)){
    $ret["errMsg"] = 'Please Enter verification code';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['code'] = $code;
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/2fa/activate', 'post', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
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