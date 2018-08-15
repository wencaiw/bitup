<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/5
 * Time: 上午10:19
 */

header('Content-type: application/json');
define('COMMON_PATH', str_replace('\\', '/', realpath(dirname(__FILE__).'/../../')));
require_once COMMON_PATH . "/sdkv2/BTSession.class.php";
require_once COMMON_PATH . "/sdkv2/BTRequest.class.php";
require_once COMMON_PATH . "/sdkv2/config.php";
require_once COMMON_PATH . "/common/data/function.php";