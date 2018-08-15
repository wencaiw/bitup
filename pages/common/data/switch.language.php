<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/26
 * Time: 下午4:18
 */
$ret = array("resultCode"=>1);

try{
    if($_COOKIE['BT_LANG'] == 'cn'){
        setcookie('BT_LANG', 'en', time()+3600*24*30, '/');
        $_COOKIE['BT_LANG'] = 'en';
    }else{
        setcookie('BT_LANG', 'cn', time()+3600*24*30, '/');
        $_COOKIE['BT_LANG'] = 'cn';
    }
    $ret["resultCode"] = 0;
}catch(Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
print json_encode($ret);