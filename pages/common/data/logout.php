<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/9
 * Time: 上午9:39
 */
require_once "../../sdkv2/BTSession.class.php";
BTSession::open();

$ret = array("resultCode"=>1);

if (!BTSession::isValid()) {
    BTSession::open();
    BTSession::close();
    $ret['resultCode'] = 2;
    $ret['logout'] = true;
    $ret['errMsg'] = 'No logon or session timeout';
    print json_encode($ret);
    exit();
}

try{
    $account = $_SESSION["email"];
    BTSession::close();
    $ret["resultCode"] = 0;
}catch(Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
print json_encode($ret);