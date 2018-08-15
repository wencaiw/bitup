<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/5/19
 * Time: 下午1:40
 */
require_once '../../../common/data/api.include.php';

$user_id = $_SESSION['user_id']; //用户标识
$token = $_SESSION['session_id'];
$dac_id = isset($_POST["dac_id"])&&($_POST["dac_id"] != 'undefined') ? trim($_POST["dac_id"]) : '';
$type = isset($_POST["type"])&&($_POST["type"] != 'undefined') ? trim($_POST["type"]) : 0;
if($dac_id == ''){
    $ret["errMsg"] = 'dac_id not exist';
    print json_encode($ret);
    exit();
}
if($type <= 0){
    $ret["errMsg"] = 'fund type not exist';
    print json_encode($ret);
    exit();
}

try{
    $params = array();
    $params['type'] = (int)$type;

//    $timestamp = time() * 1000;
//    $sign = md5(TEMP_TOKEN . $timestamp . $dac_id . TEMP_SECRET);
//    $header = array('timestamp:'. $timestamp, 'sign:'. $sign);
    $result = json_decode(BTHttp::request(BT_BACKEND_URL.'/v1/rest/dacinfo/' . $dac_id, 'new_get', $params, 30));

    if(isset($result->result_code)){
        if($result->result_code == 0){
            $ret['resultCode'] = 0;
            $ret['data'] = $result->data;
            /*
             * type	int	类型，1表示定期固定收益，2表示活期固定收益，10表示ETF指数基金，20表示主动量化基金
             * status	int	基金状态，1:开放中 2:暂停申购
             * end_time	long	基金结束时间
             * dac_info_tl:  map
             *     + en-us:
             *         + name	string	DAC名称
             *         + admin	string	基金经理
             *         + short_name	float	DAC简称
             *     + zh-cn:
             * dac_trade_limit:  map
             *     + trade_currency	string	支持申购的币种，币种小写，多个逗号分隔，默认为all，表示支持全部
             *     + capacity	float	基金可购买总额度
             *     + dac_sold_amount	float	出售额度    (最新规模:dac_sold_amount*当前usdt汇率)
             *     + min_buy_amount	float	首次单笔最小申购金额，不限制设置为0
             *     + max_buy_amount	float	首次单笔最大申购金额，不限制设置为0
             *     + min_sell_amount	float	单笔最小赎回金额，不限制设置为0
             *     + max_sell_amount	float	单笔最大赎回金额，不限制设置为0
             *     + min_append_amount	float	单笔最小追加金额，不限制设置为0
             *     + min_append_amount	float	单笔最小追加金额，不限制设置为0
             *     + max_amount_per_buyer	float	每人限购份数，不限制设置为0
             *     + but_balance_limit	long	账户but余额达到多少才能购买，不限制设置为0 created_at
             * dac_fee:  map
             *     + shown_management_ratio	float	管理费率
             *     + shown_entry_ratio	float	买入费率
             *     + shown_exit_ratio	float	赎回费率
             *     + real_management_ratio	float	实收管理费率
             *     + real_entry_ratio	float	实收买入费率
             *     + real_exit_ratio	float	实收赎回费率
             *     + but_management_discount	float	使用but支付管理手续费的折扣，1表示没有折扣，0.7表示7折优惠，默认1
             *     + but_entry_discount	float	使用but支付申购手续费的折扣，1表示没有折扣，0.7表示7折优惠，默认1
             *     + but_exit_discount	使用but支付赎回手续费的折扣，1表示没有折扣，0.7表示7折优惠，默认1
             * descriptions: map
             *     + 基金说明
             */
        }else{
            if(result_logout($result)){
                BTSession::open();
                BTSession::close();
                $ret['resultCode'] = 2;
                $ret['logout'] = true;
                $ret['errMsg'] = 'No logon or session timeout';
            }else{
                $ret['errMsg'] = $result->err_detail;
            }
        }
    }else{
        $ret["errMsg"] = 'Timeout or no record';
    }

}catch (Exception $e){
    $ret['errMsg'] = $e->getMessage();
}
echo json_encode($ret);