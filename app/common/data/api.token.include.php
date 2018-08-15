<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/24
 * Time: 下午12:28
 */

define('API_INCLUDE_PATH', str_replace('\\', '/', realpath(dirname(__FILE__).'/../../../')));
require_once API_INCLUDE_PATH . "/common/data/common.php";

BTSession::openWithoutWrite();
$ret = array("resultCode"=>1);
if(!isset($_SESSION['session_id']) || (time() - $_SESSION['start_time']) > BT_SESSION_LIFE){
    BTSession::open();
    BTSession::close();
    $ret['resultCode'] = 2;
    $ret['logout'] = true;
    $ret['errMsg'] = 'No logon or session timeout';
    print json_encode($ret);
    exit();
}
BTSession::updateTime();