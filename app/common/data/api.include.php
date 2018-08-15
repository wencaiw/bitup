<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/24
 * Time: 上午11:58
 */
define('API_INCLUDE_PATH', str_replace('\\', '/', realpath(dirname(__FILE__).'/../../../')));
require_once API_INCLUDE_PATH . "/common/data/common.php";

$ret = array("resultCode"=>1);
BTSession::open();