<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/6/6
 * Time: 上午10:58
 */
require_once '../../../../common/data/api.include.php';

//$user_id = $_SESSION['user_id']; //用户标识
//$token = $_SESSION['session_id'];

$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '';
$language = isset($_POST["language"])&&($_POST["language"] != 'undefined') ? trim($_POST["language"]) : 'en-us';  //zh-cn简体中文，en-us英语美国
if($dac_id == ''){
    $ret["errMsg"] = 'dac_id not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['dac_id'] = (int)$dac_id;
    $params['language'] = strtolower($language);

    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dac/report', 'new_get', $params, 30));
//    print_r($result);die();
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
            /* data下数据结构
             * id	long	dac_report唯一标记
             * dac_id	long	dac_info唯一标记
             * language	string	语言，zh-cn简体中文，en-us英语美国(此处英语通用）
             * title	string	标题
             * doc_url	string	文档下载链接
             * doc_type	string	文档类型，默认pdf
             */
        }else{
            $ret['errMsg'] = $result->err_detail;
        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);