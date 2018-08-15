<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/16
 * Time: 下午4:37
 */
require_once '../../../../common/data/api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
//$reserved_mobile_national_code = isset($_POST["reserved_mobile_national_code"])&&($_POST["reserved_mobile_national_code"] != 'undefined') ? trim($_POST["reserved_mobile_national_code"]) : '';
//$reserved_mobile = isset($_POST["reserved_mobile"])&&($_POST["reserved_mobile"] != 'undefined') ? trim($_POST["reserved_mobile"]) : '';
$sms_id = isset($_POST["sms_id"])&&($_POST["sms_id"] != 'undefined') ? trim($_POST["sms_id"]) : '';
$sms_code = isset($_POST["sms_code"])&&($_POST["sms_code"] != 'undefined') ? trim($_POST["sms_code"]) : '';
//$bank_number = isset($_POST["bank_number"])&&($_POST["bank_number"] != 'undefined') ? trim($_POST["bank_number"]) : '';
//$bank_name = isset($_POST["bank_name"])&&($_POST["bank_name"] != 'undefined') ? trim($_POST["bank_name"]) : '';
$id_card_number = isset($_POST["id_card_number"])&&($_POST["id_card_number"] != 'undefined') ? trim($_POST["id_card_number"]) : '';
$id_front_photo = isset($_POST["id_front_photo"])&&($_POST["id_front_photo"] != 'undefined') ? trim($_POST["id_front_photo"]) : '';
$id_back_photo = isset($_POST["id_back_photo"])&&($_POST["id_back_photo"] != 'undefined') ? trim($_POST["id_back_photo"]) : '';
$hand_held_card = isset($_POST["hand_held_card"])&&($_POST["hand_held_card"] != 'undefined') ? trim($_POST["hand_held_card"]) : '';
$verify_source = isset($_POST["verify_source"])&&($_POST["verify_source"] != 'undefined') ? trim($_POST["verify_source"]) : 0;  //认证方式（0:身份证 1:护照）

$passport_number = isset($_POST["passport_number"])&&($_POST["passport_number"] != 'undefined') ? trim($_POST["passport_number"]) : '';
$passport_cover = isset($_POST["passport_cover"])&&($_POST["passport_cover"] != 'undefined') ? trim($_POST["passport_cover"]) : '';
$passport_personal_info = isset($_POST["passport_personal_info"])&&($_POST["passport_personal_info"] != 'undefined') ? trim($_POST["passport_personal_info"]) : '';
$hand_held_passport = isset($_POST["hand_held_passport"])&&($_POST["hand_held_passport"] != 'undefined') ? trim($_POST["hand_held_passport"]) : '';

try{
    $params = array();
    switch($verify_source){
        case 0:  //0:身份证
//            $params['reserved_mobile_national_code'] = $reserved_mobile_national_code;
//            $params['reserved_mobile'] = $reserved_mobile;
            $params['sms_id'] = (int)$sms_id;
            $params['sms_code'] = $sms_code;
//            $params['bank_number'] = $bank_number;
//            $params['bank_name'] = $bank_name;
            $params['id_card_number'] = $id_card_number;
            $params['id_front_photo'] = $id_front_photo;
            $params['id_back_photo'] = $id_back_photo;
            $params['hand_held_card'] = $hand_held_card;
            break;
        case 1:  //1:护照
            $params['passport_number'] = $passport_number;
            $params['passport_cover'] = $passport_cover;
            $params['passport_personal_info'] = $passport_personal_info;
            $params['hand_held_passport'] = $hand_held_passport;
            break;
        default:
            $ret["errMsg"] = 'Please choose the authentication type';
            print json_encode($ret);
            exit();
            break;
    }
    $params['verify_source'] = $verify_source;

//    print_r($params);die();

    $header = array('token:'. $token, 'user_id:'. $user_id);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/account/tier02', 'post', $params, 30, $header));
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