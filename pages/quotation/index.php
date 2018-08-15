<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 上午9:57
 */
require_once "../common/data/include.php";
$quotation = array(
    'en' => array(
        '1001' => 'About DAC'
    ),
    'cn' => array(
        '1001' => '数字资产组合介绍'
    )
);
$l = $_COOKIE['BT_LANG'];
$_Quotation = $quotation[$l];
$curr_page_id = 3;
$title = 'BitUP Quotation';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
</head>
<body>

<div class="header">
    <div class="fast-enter" style="text-align: right;">
        <div class="common-container clearfix">
            <div class="fl">
                <span style="margin-right: 15px;">你好，欢迎来到bitup!</span>
                <a href="/login/login.php">[<span class="color-base">登录</span>]</a>&emsp;
                <a href="">[<span class="color-base">免费注册</span>]</a>
            </div>
            <ul class="dib">
                <li><a href="/guide/">新手指导</a></li>
                <li><a href="">常见问题</a></li>
                <li><a style="cursor: pointer;" ng-click="g.switching()">简体中文</a><i class="common-icon icon-arrow-right"></i></li>
                <li><i class="common-icon icon-phone"></i><a href="">下载APP</a></li>
            </ul>
        </div>
    </div>
    <div class="logo-container common-container clearfix">
        <a href="/login/login.php" class="logo-coral">
            <img style="height: 40px;" src="/common/images/logo.png">
        </a>
        <div class="home-menu">
            <a href="">首页</a>
            <a href="/quotation/" class="current">交易中心</a>
        </div>
        <div class="my-account"><i class="common-icon icon-account"></i><span>我的账户</span></div>
    </div>
</div>

<div class="quotation-wrap">
    <div class="quotation-banner <?php echo $l; ?>"><div class="common-container"></div></div>
    <div class="quotation-main common-container">
        <div class="quotation-sum-con clearfix">
            <span class="name">BitUP Prime (BPP)</span>
            <ul class="sum-list">
                <li>
                    <p class="num">$ 3.2180</p>
                    <p>当月最高</p>
                </li>
                <li>
                    <p class="num">$ 3.0768</p>
                    <p>当月最低</p>
                </li>
                <li>
                    <p class="num up">＋ 3.68%</p>
                    <p>24小时回报率</p>
                </li>
                <li>
                    <p class="num up"><span class="middle">$ 3.1289</span> <i class="common-icon icon-up middle"></i></p>
                    <p>最新成交价</p>
                </li>
            </ul>
        </div>
        <div class="clearfix">
            <div class="fl">
                <div style="height: 200px;width: 770px;">
                    <!--图表-->
                </div>
            </div>
            <div class="quotation-base-info fr">
                <p><b>产品设计：</b><span>姓名或名称</span></p>
                <p><b><?php echo $_Quotation['1001']; ?>：</b><span>本BPP是BitUP提供的稳健型产品组合。我们调取了不同交易市场上数字货币的价格走向......</span></p>
                <p style="margin-top: 16px;"><a href="detail.php">点击查看详情</a></p>
                <div class="btn-box">
                    <a href="/dashboard/#/trade/order/buy" class="common-btn ok" type="button"><?php echo $_Lang['100177']; ?></a>
                    <a href="/dashboard/#/trade/order/sold" class="common-btn" type="button"><?php echo $_Lang['100178']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>

</body>
</html>