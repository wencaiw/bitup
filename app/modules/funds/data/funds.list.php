<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/7/18
 * Time: 下午4:58
 */

require_once '../../../common/data/api.include.php';

$fund_type = isset($_POST["fund_type"])&&($_POST["fund_type"] != 'undefined') ? trim($_POST["fund_type"]) : '';  //类型，bbb:币币宝，passive:被动基金，active:主动基金
$offset = isset($_POST["offset"])&&($_POST["offset"] != 'undefined') ? trim($_POST["offset"]) : '0';             //起始位置
$limit = isset($_POST["limit"])&&($_POST["limit"] != 'undefined') ? trim($_POST["limit"]) : '12';                //查询记录数
//币币宝
$status = isset($_POST["status"])&&($_POST["status"] != 'undefined') ? trim($_POST["status"]) : '0';             //看下面
$type = isset($_POST["type"])&&($_POST["type"] != 'undefined') ? trim($_POST["type"]) : '';                      //币币宝下才有 1：固定 2:活期
//
$currency = isset($_POST["currency"])&&($_POST["currency"] != 'undefined') ? trim($_POST["currency"]) : 'usdt';  //预留:不需要传

try{
    $params = array();
    $params['offset'] = (int)$offset;
    $params['limit'] = (int)$limit;
    switch($fund_type){
        case 'bbb':
            if(!in_array($type, array('1', '2'))){
                $ret["errMsg"] = 'Coin box type not exist';
                print json_encode($ret);
                exit();
            }
            $params['type'] = (int)$type;
            /*
             * 筛选方式:status
             * 币币宝定期: 0:全部 1:尚未开始 2:认购中 3:已售罄 4:记息中 5:已结束
             * 币币宝活期: 0:全部 1:尚未开始 2:认购中 6:开放中 5:已结束
             */
            $params['status'] = (int)$status;
            break;
        case 'passive':
        case 'active':
            $params['currency'] = $currency;
            /*
             * 筛选方式:status
             * 0：默认值，24小时收益 1：7天收益 2：30天收益 3.历史总收益
             */
            $params['order'] = (int)$status;
            break;
        default:
            $ret["errMsg"] = 'fund type not exist';
            print json_encode($ret);
            exit();
    }

    $result = json_decode(BTHttp::request(BT_BACKEND_URL . '/v1/rest/dacinfo/' . $fund_type . '/pagination', 'new_get', $params, 30));
    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
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