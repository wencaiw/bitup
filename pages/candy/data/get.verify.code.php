<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/2/2
 * Time: 下午6:24
 */
require_once "../../sdkv2/BTSession.class.php";
require_once "vcode.class.php";
session_start();

$vcode = new Vcode(100, 50, 4);            //构造方法
$_SESSION['verify_code'] = $vcode->getcode();    //将验证码放到服务器自己的空间保存一份
$vcode->outimg();
