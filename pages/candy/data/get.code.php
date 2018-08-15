<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/2/2
 * Time: 下午4:48
 */

header('Content-type: application/json');
require_once "../../sdkv2/BTSession.class.php";
require_once "../../sdkv2/BTRequest.class.php";
require_once "../../sdkv2/config.php";
require_once "../../common/data/function.php";
//BTSession::openWithoutWrite();

$ret = array("resultCode"=>1);

$address = isset($_GET['address']) ? trim($_GET['address']) : '';
$code = isset($_GET['code']) ? trim($_GET['code']) : '';
$recaptcha = isset($_GET['recaptcha']) ? trim($_GET['recaptcha']) : '';
//$recaptcha = '03AA7ASh0typhts1talPx4hVJy5M3im6OMlw0Y64G-MgfjeUXYCkPwCPj8ON7Sl4XnvNEb00k7y3LCwEx-5bBbWoeQ68s6kNFVEpez69f5JM4kFdjcpLCJ67Qy9Viydos3x0YJPW0pJ3LPFhmsV6fqlaiostwiIYsEqeXNe5sVkDmG4Kw1pbMC4Q9gywogioxx0qZUO5IzPz_jzIzeADFZP7AV8oKryMK2h4iYPkXIowWbz7VVM35Z2j00wgJTZcrllOJTY5e5mct7ZCCV0jcxnhixb9K7mH9jzAYRZfKPa-R_Ice_Zpuzc-FOmtPh0fuE05QkQ0mhFj-Ef8pYoVsdm3vHAKe_lkESTlfoqbFjj7CDM3uHK_UatA0BEFM-2psX3TPr9Fpn_h8UJFwUEWWv4sVwbFKzuVXSkes-84HMjk1F1wweL3Gusd8';

if(empty($address)){
    $ret['errMsg'] = 'Please enter the correct ETH wallet address！';
    echo json_encode($ret);
    exit;
}
if(empty($recaptcha)){
    $ret['errMsg'] = 'Verification error';
    echo json_encode($ret);
    exit;
}

try{
    $params = array();
    $params['address'] = strtolower($address);
    $params['code'] = $code;
    $params['ip'] = get_client_ip();
    $params['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $params['timestamp'] = time()*1000;
    $params['hash'] = md5(TEMP_TOKEN. $params['address']. $code. $params['ip']. $params['timestamp']. TEMP_SECRET);
    $header = array('recaptcha:'. $recaptcha, 'timestamp:'. $params['timestamp'], 'hash:'. $params['hash']);

    $result = json_decode(BTHttp::request('http://128.199.239.140:8080/airdrop/referral', 'post', $params, 30, $header));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
        }else{
            $ret['errMsg'] = $result->err_detail;
        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);