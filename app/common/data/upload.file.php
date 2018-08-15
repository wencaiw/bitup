<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/15
 * Time: 下午5:42
 */
$file_name = isset($_POST["filename"])&&($_POST["filename"] != 'undefined') ? trim($_POST["filename"]) : '';
$type = isset($_POST["type"])&&($_POST["type"] != 'undefined') ? trim($_POST["type"]) : '';
$account = isset($_POST["account"])&&($_POST["account"] != 'undefined') ? trim($_POST["account"]) : '';

if(empty($_FILES)){
    $ret["errMsg"] = 'No upload files';
    print json_encode($ret);
    exit();
}
if(empty($type)){
    $ret["errMsg"] = 'file type not exist';
    print json_encode($ret);
    exit();
}
if(empty($account)){
    $ret["errMsg"] = 'Email does not exist';
    print json_encode($ret);
    exit();
}

//$filename = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];

//$img_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename;
//$img_path = '/Users/Hajay/project/hajay/CoralWallet/www/uploads/';
//$img_path = '/var/www/test/CoralWallet/www/uploads/';
//$img_path = '/var/www/pic/' . '/' . $_POST['account'] . '/';    //测试服务器
$img_path = '/data/app/pic/' . $_POST['account'] . '/';
if(!file_exists($img_path)){
    $old = umask(0);
    mkdir($img_path, 0777, true);
    umask($old);
}
try{
    if(move_uploaded_file($tmp_name, $img_path . $file_name)) {
        echo json_encode(array('msg' => 'success', 'status' => 1, 'resultCode' => 0));
    } else {
        echo json_encode(array('msg' => json_encode($_FILES), 'status' => 0, 'resultCode' => 1, 'errMsg' => '上传失败'));
    }
}catch(Exception $e){
    echo json_encode(array('msg' => json_encode($_FILES), 'status' => 0, 'resultCode' => 1, 'errMsg' => $e->getMessage()));
}