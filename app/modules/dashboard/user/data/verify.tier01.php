<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/4/21
 * Time: 下午2:56
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$country = isset($_POST["country"])&&($_POST["country"] != 'undefined') ? trim($_POST["country"]) : '';
//$id_name = isset($_POST["id_name"])&&($_POST["id_name"] != 'undefined') ? trim($_POST["id_name"]) : '';
$first_name = isset($_POST["first_name"])&&($_POST["first_name"] != 'undefined') ? trim($_POST["first_name"]) : '';
$last_name = isset($_POST["last_name"])&&($_POST["last_name"] != 'undefined') ? trim($_POST["last_name"]) : '';
$city = isset($_POST["city"])&&($_POST["city"] != 'undefined') ? trim($_POST["city"]) : '';
$resident_address = isset($_POST["resident_address"])&&($_POST["resident_address"] != 'undefined') ? trim($_POST["resident_address"]) : '';
$postal_code = isset($_POST["postal_code"])&&($_POST["postal_code"] != 'undefined') ? trim($_POST["postal_code"]) : '';
$mobile_national_code = isset($_POST["mobile_national_code"])&&($_POST["mobile_national_code"] != 'undefined') ? trim('00'.$_POST["mobile_national_code"]) : '';
$mobile = isset($_POST["mobile"])&&($_POST["mobile"] != 'undefined') ? trim($_POST["mobile"]) : '';
$birth_address = isset($_POST["birth_address"])&&($_POST["birth_address"] != 'undefined') ? trim($_POST["birth_address"]) : '';
$birth_date = isset($_POST["birth_date"])&&($_POST["birth_date"] != 'undefined') ? trim($_POST["birth_date"]) : '';
$sms_id = isset($_POST["sms_id"])&&($_POST["sms_id"] != 'undefined') ? trim($_POST["sms_id"]) : '';
$sms_code = isset($_POST["sms_code"])&&($_POST["sms_code"] != 'undefined') ? trim($_POST["sms_code"]) : '';

//if(empty($code_id)){
//    $ret["errMsg"] = 'code_id cannot be empty';
//    print json_encode($ret);
//    exit();
//}
//if(empty($national_code)){
//    $ret["errMsg"] = 'Please choose the phone international area code';
//    print json_encode($ret);
//    exit();
//}
//if(empty($mobile)){
//    $ret["errMsg"] = 'Please enter the phone number';
//    print json_encode($ret);
//    exit();
//}
//if(empty($code)){
//    $ret["errMsg"] = 'Please enter the phone verification code';
//    print json_encode($ret);
//    exit();
//}

try{
    $params = array();
    $params['country'] = $country;
//    $params['id_name'] = $id_name;
    $params['first_name'] = $first_name;
    $params['last_name'] = $last_name;
    $params['city'] = $city;
    $params['resident_address'] = $resident_address;
    $params['postal_code'] = $postal_code;
    $params['mobile_national_code'] = $mobile_national_code;
    $params['mobile'] = $mobile;
    $params['birth_address'] = $birth_address;
    $params['birth_date'] = $birth_date;
    $params['sms_id'] = (int)$sms_id;
    $params['sms_code'] = $sms_code;

    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/tier01', 'post', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            // if($result->data->verify_result == 1){
            //     $ret['resultCode'] = 0;
            // }else{
            //     $ret['errMsg'] = $result->data->verify_msg;
            // }
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