<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/9
 * Time: 上午10:31
 */
define('COMMON_PATH', str_replace( '\\', '/', realpath(dirname(__FILE__).'/../../')));
include_once COMMON_PATH."/sdkv2/BTSession.class.php";
include_once COMMON_PATH."/common/i18n/lang.php";
BTSession::openWithoutWrite();

//初始化lang
if(!$_COOKIE['BT_LANG']){
    setcookie('BT_LANG', 'en', time()+3600*24*30, '/');
    $_COOKIE['BT_LANG'] = 'en';
}
$_Lang = $lang[$_COOKIE['BT_LANG']];