<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/2/8
 * Time: 下午3:14
 */
require_once "../sdkv2/BTSession.class.php";
require_once "../sdkv2/BTRequest.class.php";
require_once "../sdkv2/config.php";
//require_once "../common/data/function.php";

$timestamp = time()*1000;
$hash = md5(TEMP_TOKEN. $timestamp. TEMP_SECRET);

$params = array();
$header = array('token:'. TEMP_TOKEN, 'timestamp:'. $timestamp, 'hash:'. $hash);
$result = json_decode(BTHttp::request('http://128.199.239.140:8080/referral/analysis', 'get', $params, 120, $header));

if(isset($result->result_code)){
    if($result->result_code == 0){
        $data = $result->data;
    }else{
        echo $result->err_detail;
    }
}else{
    echo 'Timeout or no record';
}

?>
<!DOCTYPE html>
<html lang="en" ng-app="butCandy" ng-controller="butCandyCtrl">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>candy analysis</title>
    <style>
        html,body{
            text-align: center;
        }
        .analysis{
            width: 800px;
            margin: 0 auto;
        }
        .analysis .top{
            text-align: left;
            padding: 20px 0;
        }
        .analysis span{
            padding-right: 20px;
        }
    </style>
</head>
<body>
<div class="analysis">
    <div class="top"><span>total_reward: <?php echo $data->total_reward; ?></span><span>valid_user_count: <?php echo $data->valid_user_count; ?></span><span>reward_user_count: <?php echo $data->reward_user_count; ?></span></div>
    <table>
        <tr>
            <th>NO.</th>
            <th>ETH Address</th>
            <th>reward</th>
        </tr>
        <?php foreach($data->top_users as $k=>$v){ ?>
            <tr>
                <td><?php echo $k+1; ?></td>
                <td><?php echo $v->eth_address; ?></td>
                <td><?php echo $v->reward; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
