<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/2
 * Time: 下午9:15
 */
require_once "../common/data/include.php";

$dac = array(
    'en' => array(
        '1001' => '本平台涉及的投资产品统称数字资产组合，简称DAC（Digital Assets Combination）。',
        '1002' => '“数字资产组合”（DAC）是“BitUP Ltd”提供的数字资产基金产品，不同的数字资产可以组合成不同的DAC。举例说明，专家（可能是计算机）可以设计出一款稳健型的DAC，里边包含了增长率比较稳定的各类数字资产；也可以选择那些风险比较高的数字资产组成一款DAC，以期获取最高收益。',
        '1003' => '平台所有的DAC将由行业专家提供，由计算机根据算法模型实时调整。',
        '1004' => '“BitUP Ltd”提供的“数字资产组合”（DAC）可以在本平台内进行交易（买入、卖出），您需要使用比特币或以太坊购买DAC，在合适的时机卖出DAC以换取比特币或以太坊，平台上的这些数字资产全天都可以进行提现。',
        '1005' => 'DAC的目标是：多样化数字资产，分散单一资产风险。'
    ),
    'cn' => array(
        '1001' => '本平台涉及的投资产品统称数字资产组合，简称DAC（Digital Assets Combination）。',
        '1002' => '“数字资产组合”（DAC）是“BitUP Ltd”提供的数字资产基金产品，不同的数字资产可以组合成不同的DAC。举例说明，专家（可能是计算机）可以设计出一款稳健型的DAC，里边包含了增长率比较稳定的各类数字资产；也可以选择那些风险比较高的数字资产组成一款DAC，以期获取最高收益。',
        '1003' => '平台所有的DAC将由行业专家提供，由计算机根据算法模型实时调整。',
        '1004' => '“BitUP Ltd”提供的“数字资产组合”（DAC）可以在本平台内进行交易（买入、卖出），您需要使用比特币或以太坊购买DAC，在合适的时机卖出DAC以换取比特币或以太坊，平台上的这些数字资产全天都可以进行提现。',
        '1005' => 'DAC的目标是：多样化数字资产，分散单一资产风险。'
    )
);
$l = $_COOKIE['BT_LANG'];
$_DAC = $dac[$l];
$title = 'BitUP DAC';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
<!--    <script type="text/javascript" src="./bower_components/angular/angular.js"></script>-->
    <!--    <link rel="stylesheet" href="/common/css/index.css" />-->
</head>
<body>
<?php include_once '../common/tpl/header.php'; ?>

<div class="guide-main common-container other-page-main">
    <ul class="menu-slide">
        <li>
            <a href="/about/" class="title"><span><?php echo $_Lang['100025']; ?></span></a>
        </li>
        <li class="current">
            <a href="/dac/" class="title"><span><?php echo $_Lang['100026']; ?></span></a>
        </li>
        <li>
            <a href="/tos/" class="title"><span><?php echo $_Lang['100027']; ?></span></a>
        </li>
        <li>
            <a href="/disclaimer/" class="title"><span><?php echo $_Lang['100028']; ?></span></a>
        </li>
    </ul>
    <div class="content-panel">
        <h3 class="title"><?php echo $_Lang['100026']; ?></h3>
        <p><?php echo $_DAC['1001']; ?></p>
        <p><?php echo $_DAC['1002']; ?></p>
        <p><?php echo $_DAC['1003']; ?></p>
        <p><?php echo $_DAC['1004']; ?></p>
        <p><?php echo $_DAC['1005']; ?></p>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>

<!--<script type="text/javascript" src="./common/js/index.js"></script>-->
</body>
</html>