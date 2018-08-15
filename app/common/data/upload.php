<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/15
 * Time: 下午5:42
 */
require_once 'api.token.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$account = $_SESSION['account'];  //用户email

$type = $_GET['type'];
$tmp_name = $_FILES['file']['tmp_name'];
$file_name = $_FILES['file']['name'];
$file_type = explode('.', $file_name);

if(empty($_FILES)){
    $ret["errMsg"] = 'Please choose to upload files';
    print json_encode($ret);
    exit();
}

//if($_FILES['file']['size'] > 3145728){
//    $ret["errMsg"] = '上传的文件不可超过3M';
//    print json_encode($ret);
//    exit();
//}

switch($_FILES['file']['error']){
    case '1':
        //echo json_encode(array( 'resultCode' => 1, 'errMsg' => '上传的文件超过了php.ini中upload_max_filesize选项限制的值'));
        echo json_encode(array( 'resultCode' => 1, 'errMsg' => '上传的文件不可超过2M'));
        exit();
        break;
    case '2':
        //echo json_encode(array( 'resultCode' => 1, 'errMsg' => '上传文件的大小超过了HTML表单中MAX_FILE_SIZE选项指定的值'));
        echo json_encode(array( 'resultCode' => 1, 'errMsg' => '上传文件的大小超过了HTML表单中的8M'));
        exit();
        break;
    case '3':
        echo json_encode(array( 'resultCode' => 1, 'errMsg' => '文件只有部分被上传'));
        exit();
        break;
    case '4':
        echo json_encode(array( 'resultCode' => 1, 'errMsg' => '没有文件被上传'));
        exit();
        break;
    case '6':
        echo json_encode(array( 'resultCode' => 1, 'errMsg' => '找不到临时文件夹'));
        exit();
        break;
    case '7':
        echo json_encode(array( 'resultCode' => 1, 'errMsg' => '文件写入失败'));
        exit();
        break;
}

$suffix =  strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
if(!in_array($suffix, array('jpg', 'jpeg', 'png', 'bmp', 'gif'))){
    echo json_encode(array( 'resultCode' => 1, 'errMsg' => 'File type error'));
    exit();
}
upload_img_file(array('file' => $tmp_name, 'filename' => $type . '.' . $file_type[count($file_type)-1], 'account' => $account, 'type' => $type));


function upload_img_file($params = array()){
    $url = BT_FILE_PATH . 'upload.file.php';
    $curl = curl_init();
    if (class_exists('CURLFile')) {
        $params['file'] = new CURLFile($params['file']);
        curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
    } else {
        $params['file'] = '@' . $params['file'];
        if (defined('CURLOPT_SAFE_UPLOAD')) {
            curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
        }
    }
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_POST,1);
    curl_setopt($curl,CURLOPT_POSTFIELDS, $params);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $result = curl_exec($curl);  //$result 获取页面信息
    curl_close($curl);
    echo $result ; //输出 页面结果
}