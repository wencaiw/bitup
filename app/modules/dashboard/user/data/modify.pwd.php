<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/5
 * Time: 下午5:36
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$account = $_SESSION['account'];
$token = $_SESSION['session_id'];
$old_pwd = isset($_POST["old_pwd"]) ? trim($_POST["old_pwd"]) : '';
$new_pwd = isset($_POST["new_pwd"]) ? trim($_POST["new_pwd"]) : '';
if(empty($old_pwd) || empty($new_pwd)){
    $ret["errMsg"] = 'Entered passwords differ';
    print json_encode($ret);
    exit();
}
//if(preg_match("/^\\d+$/", $new_pwd) || preg_match("/^[a-zA-Z]+$/", $new_pwd) || !preg_match("/^[A-Za-z0-9]{8,12}$/", $new_pwd)){
//    $ret["errMsg"] = 'Incorrect password format';
//    print json_encode($ret);
//    exit();
//}

try{
    $params = array();
//    $params['old_password'] = hash_hmac('md5', $old_pwd, $account, false);
    $params['old_password'] = $old_pwd;
//    $params['new_password'] = hash_hmac('md5', $new_pwd, $account, false);
    $params['new_password'] = $new_pwd;
    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/password', 'put', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            BTSession::open();
            BTSession::close();
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