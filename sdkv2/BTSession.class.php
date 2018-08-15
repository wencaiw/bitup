<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/26
 * Time: 下午2:34
 */
ini_set('session.name', 'PHPSESSID_BT');
define("BT_SESSION_LIFE", 172800);
$BTSessionPath = dirname(__FILE__);
set_include_path(get_include_path().PATH_SEPARATOR.$BTSessionPath);
ini_set('session.gc_maxlifetime', 172800); // 秒
ini_set("session.cookie_lifetime", 172800); // 秒

if(isset($_SERVER['SERVER_NAME']) && in_array($_SERVER['SERVER_NAME'], array('bitup.com', 'www.bitup.com'))){
    ini_set('session.cookie_domain', 'bitup.com');
}

class BTSession {
    static public function open() {
        session_start();
    }
    static public function openWithoutWrite() {
        session_start();
        session_write_close();
    }
    static public function unblockWrite() {
        session_write_close();
    }

    static public function close() {
        session_unset();
    }

    static public function isValid() {
        if (isset($_SESSION["user_login_flag"]) && (time() - $_SESSION['start_time']) < BT_SESSION_LIFE) {
            return true;
        }
        return false;
    }

    static public function setSession($objectId, $account, $user_id) {
        $_SESSION["user_login_flag"] = true;
        $_SESSION["session_id"] = $objectId;
        $_SESSION["account"] = $account;
        $_SESSION["user_id"] = $user_id;
    }

    static public function updateTime() {
        $_SESSION['start_time'] = time();
    }
}