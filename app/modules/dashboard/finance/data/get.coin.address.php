<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/4/16
 * Time: 上午9:57
 */

require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$coin = isset($_POST["coin"])&&($_POST["coin"] != 'undefined') ? strtolower(trim($_POST["coin"])) : 'btc';

if(empty($coin)){
    $ret["errMsg"] = 'Please choose the Coin';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
//    $params['coin'] = $coin;

    $header = array('token:'. $token, 'user_id:'. $user_id);
//    echo $coin;
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/wallet/' . $coin, 'post', $params, 30, $header));

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