<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/15
 * Time: 下午4:48
 */

require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$country = isset($_POST["country"])&&($_POST["country"] != 'undefined') ? trim($_POST["country"]) : '';
$first_name = isset($_POST["first_name"])&&($_POST["first_name"] != 'undefined') ? trim($_POST["first_name"]) : '';
$last_name = isset($_POST["last_name"])&&($_POST["last_name"] != 'undefined') ? trim($_POST["last_name"]) : '';
$city = isset($_POST["city"])&&($_POST["city"] != 'undefined') ? trim($_POST["city"]) : '';
$resident_address = isset($_POST["resident_address"])&&($_POST["resident_address"] != 'undefined') ? trim($_POST["resident_address"]) : '';
$postal_code = isset($_POST["postal_code"])&&($_POST["postal_code"] != 'undefined') ? trim($_POST["postal_code"]) : '';
$birth_address = isset($_POST["birth_address"])&&($_POST["birth_address"] != 'undefined') ? trim($_POST["birth_address"]) : '';
$birth_date = isset($_POST["birth_date"])&&($_POST["birth_date"] != 'undefined') ? trim($_POST["birth_date"]) : '';

try{
    $params = array();
    $params['country'] = $country;
    $params['first_name'] = $first_name;
    $params['last_name'] = $last_name;
    $params['city'] = $city;
    $params['resident_address'] = $resident_address;
    $params['postal_code'] = $postal_code;
    $params['birth_address'] = $birth_address;
    $params['birth_date'] = $birth_date;

    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/tier01', 'put', $params, 30, $header));
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