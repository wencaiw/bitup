<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 上午10:08
 */
require_once "../common/data/include.php";
$detail = array(
    'en' => array(
        '1001' => 'H',
        '1002' => 'W',
        '1003' => 'M',
        '1004' => ' Return',
        '1005' => '24H Trend',
        '1006' => 'Last 7d trend',
        '1007' => 'Last 30d trend',
        '1008' => 'My Asset',
        '1009' => 'Digital Assets In DAC',
        '10010' => 'NO.',
        '10011' => 'Name of Digital Asset',
        '10012' => 'Initial Index Weight',
        '10013' => 'Rebalancing Index Weight',
        '10014' => 'Fee',
        '10015' => 'Management Fee',
        '10016' => 'Entry Fee',
        '10017' => 'Exit Fee',
        '10018' => 'About DAC',
        '10019' => 'BPP is a steady type of BitUP DAC. We analyze the price data from different crypto currency exchanges, and choose the currencies with relatively stable value. Investors are able to get steady profits through a low risk digital assets allocation pattern.',
        '10020' => 'About DAC Manager',
        '10021' => 'BitUP Ltd is an investment management company focusing only on blockchain-based digital assets. We bridge the gap between traditional investment management and the newest digital assets on the market. Based on traditional investment management experiences and artificial inteligence technologies, we provide creative digital assets allocation models to effectively manage blockchain-based digital assets.',
        '10022' => '',
    ),
    'cn' => array(
        '1001' => '小时',
        '1002' => '周',
        '1003' => '个月',
        '1004' => '收益率',
        '1005' => '24小时趋势',
        '1006' => '近7天趋势',
        '1007' => '近30天趋势',
        '1008' => '我的资产',
        '1009' => '组合内的数字资产',
        '10010' => '序号',
        '10011' => '数字资产名称',
        '10012' => '初始组合比例',
        '10013' => '当前调整后比例',
        '10014' => '费用',
        '10015' => '管理费（年化）',
        '10016' => '买入手续费',
        '10017' => '卖出手续费',
        '10018' => '数字资产组合介绍',
        '10019' => 'BPP是BitUP提供的稳健型产品组合。我们调取了不同交易市场上数字货币的价格走向，选择那些价值较为稳定的数字货币，财富管理者将能够从非常低风险的资产配置中获取相对稳定的回报。',
        '10020' => '数字资产组合设计专家',
        '10021' => '数字资产组合专家：BitUP Ltd是一家专注区块链资产的财富管理公司，我们链接了传统的资产管理标准和最新型数字资产市场，基于传统资产配置经验与AI技术，推出了创新的数字资产配置模型，对区块链上的数字资产进行有效管理。',
        '10022' => '',
    )
);
$l = $_COOKIE['BT_LANG'];
$_Detail = $detail[$l];
$curr_page_id = 3;
$title = 'BitUP Quotation Detail';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
    <!--    <script type="text/javascript" src="./bower_components/angular/angular.js"></script>-->
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
    <div class="common-container">
        <div class="page-title trade-detail-section increase-section">
            <h3><span>BitUP Prime (BPP)</span>&emsp;<span class="color-base">$5.35</span><i class="common-icon icon-up"></i></h3>
            <ul class="top-symbol-list">
                <li><span>24<?php echo $_Detail['1001']; ?><?php echo $_Detail['1004']; ?></span><span class="sym-change down">－31.21%</span></li>
                <li><span>1<?php echo $_Detail['1002']; ?><?php echo $_Detail['1004']; ?></span><span class="sym-change up">＋31.21%</span></li>
                <li><span>1<?php echo $_Detail['1003']; ?><?php echo $_Detail['1004']; ?></span><span class="sym-change up">＋31.21%</span></li>
                <li><span>3<?php echo $_Detail['1003']; ?><?php echo $_Detail['1004']; ?></span><span class="sym-change up">＋51.21%</span></li>
                <li><span>6<?php echo $_Detail['1003']; ?><?php echo $_Detail['1004']; ?></span><span class="sym-change up">＋151.21%</span></li>
            </ul>
        </div>
        <div class="clearfix">
            <div class="trade-detail-section chart-panel-section fl">
                <ul class="tab-list clearfix">
                    <li class="on"><?php echo $_Detail['1005']; ?></li>
                    <li><?php echo $_Detail['1006']; ?></li>
                    <li><?php echo $_Detail['1007']; ?></li>
                </ul>
                <div class="chart-con">
                    <highchart style="height: 200px;display: block;" config="info.line.chartConfig"></highchart>
                </div>
            </div>
            <div class="trade-detail-section asset-section">
                <ul class="tab-list clearfix">
                    <li class="on"><?php echo $_Detail['1008']; ?></li>
                </ul>
                <div class="btn-box" style="margin-top: 60px;">
                    <a href="/dashboard/#/trade/order/buy" style="width: 270px;height: 50px;line-height: 50px;font-size: 18px;margin-bottom: 24px;" class="btn ok" type="button"><?php echo $_Lang['100177']; ?></a>
                    <a href="/dashboard/#/trade/order/sold" style="width: 270px;height: 50px;line-height: 50px;font-size: 18px;" class="btn" type="button"><?php echo $_Lang['100178']; ?></a>
                </div>
            </div>
        </div>
        <div class="trade-detail-section statistic-section clearfix">
            <div class="panel fl">
                <h3 class="color-base"><?php echo $_Detail['1009']; ?></h3>
                <table class="common-table">
                    <thead>
                    <tr>
                        <th style="width: 10%"><?php echo $_Detail['10010']; ?></th>
                        <th><?php echo $_Detail['10011']; ?></th>
                        <th style="width: 25%;"><?php echo $_Detail['10012']; ?></th>
                        <th style="width: 33%;"><?php echo $_Detail['10013']; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td><?php echo $_Lang['100179']; ?>(USDT)</td>
                        <td>50.00%</td>
                        <td>47.78%</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><?php echo $_Lang['100180']; ?>(ETC)</td>
                        <td>20.00%</td>
                        <td>20.72%</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><?php echo $_Lang['100165']; ?>(ETH)</td>
                        <td>20.00%</td>
                        <td>21.02%</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><?php echo $_Lang['100181']; ?>(LTC)</td>
                        <td>10.00%</td>
                        <td>10.48%</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel fr">
                <h3 class="color-base"><span style="display: inline-block;border-bottom: 1px solid #D92A24;"><?php echo $_Detail['10014']; ?></span></h3>
                <div class="content">
                    <ul class="fee-list">
                        <li>
                            <p class="fz-14 color-base">3%</p>
                            <p><?php echo $_Detail['10015']; ?></p>
                        </li>
                        <li>
                            <p class="fz-14 color-base">0%</p>
                            <p><?php echo $_Detail['10016']; ?></p>
                        </li>
                        <li>
                            <p class="fz-14 color-base">0.5%</p>
                            <p><?php echo $_Detail['10017']; ?></p>
                        </li>
                    </ul>
                    <h4 class="color-base"><?php echo $_Detail['10018']; ?></h4>
                    <p><?php echo $_Detail['10019']; ?></p>
                    <h4 class="color-base"><?php echo $_Detail['10020']; ?></h4>
                    <p><?php echo $_Detail['10021']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>

<!--<script type="text/javascript" src="./common/js/index.js"></script>-->
</body>
</html>