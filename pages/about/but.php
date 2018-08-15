<?php
/**
 * Created by PhpStorm.
 * User: Wangyao
 * Date: 2018/5/16
 * Time: 上午14:26
 */
require_once "../common/data/include.php";

$about = array(
    'en' => array(
        '1001' => 'About BUT',
        '1002' => 'BUT is the native ERC20-compatible cryptographic token of the BitUP Platform implemented on the public Ethereum blockchain.A fixed supply of 1 billion BUT tokens will be created and no further tokens will be created. BitUP would have some specific functions:',
        '1003' => '1.BitUP Platform will charge asset managers a certain fee in BUT for the creation of DACs.
        <br />2.BUT will be Used for rebates or rewards to users who buy or sell fund products on BitUP platforms.
        <br />3.BUT will be automatically given as incentives to investment managers and other third parties according to rules governed by smart contracts. The asset allocation combinations they created, along with all operations, will be transparent and open to all investors. All performance will be quantitatively evaluated. 
        <br />4.BUT holders would obtain exclusive access to premium services (e.g. market intelligence and research reports) on the BitUP Platform by paying BUT. 
        <br />5.Through DACs created by asset managers, BUT holders would get the opportunity to access opportunities which would otherwise not be available to the general public.',
        '1004' => 'Trade BUT',
        '1005' => 'BUT has been launched by the following exchanges.',
        '1006' => 'Huobi Autonomous Exchange',
        '1007' => 'KEX Main Site',
        '1008' => 'Bitgogo Digital Asset Exchange',
        '1009' => 'More exchanges are coming…'
    ),
    'cn' => array(
        '1001' => '关于BUT',
        '1002' => 'BUT是BitUP平台基于原生ERC20兼容的加密通证，总数共10亿枚，未来不会额外增发。作为平台的流通介质，BUT将具备以下具体功能：',
        '1003' => '第一，BitUP平台将向用户收取一定的BUT，用于创建属于用户的DACs。
        <br />第二，用于对在BitUP平台上买卖基金产品的用户进行返佣或奖励。
        <br />第三，BUT将被用于自动给予投资经理和其他第三方的奖励。
        <br />第四，BUT持有者将通过支付BUT，获得BitUP平台的高级服务(如市场情报和研究报告)的专属享有权。
        <br />第五，BUT的持有者将获得更多BitUP平台上的机会，如优质基金的优先购买权，而一般公众将无法获得这些机会。',
        '1004' => '交易BUT',
        '1005' => 'BitUp Token(BUT)已上线以下交易交易所，投资者可前往交易。',
        '1006' => '火币自主数字资产交易所',
        '1007' => 'KEX国际站',
        '1008' => 'Bitgogo交易平台',
        '1009' => '陆续上线其它平台...'
    )
);
$l = $_COOKIE['BT_LANG'];
$_About = $about[$l];

$curr_page_id = 2;
$title = '数字资产管理平台 | Digital Asset Investment Platform | About BitUP Tokens(BUT)';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
</head>
<body>

<?php include_once '../common/tpl/header.php'; ?>

<div class="common-container">
    <div class="aboutbut_title">BitUP Tokens(BUT)</div>
    <div class="aboutbut_main">
        <h4><?php echo $_About['1001']; ?></h4>
        <p><?php echo $_About['1002']; ?></p>
        <p><?php echo $_About['1003']; ?></p>
        <h4><?php echo $_About['1004']; ?></h4>
        <p><?php echo $_About['1005']; ?></p>
        <div class="trading_list clearfix">
            <a href="https://www.hadax.com/zh-cn/but_btc/exchange/" class="hadax" target="_blank"><?php echo $_About['1006']; ?></a>
            <a href="https://www.kex.com/market/trademarket.html?symbol=79&type=5" class="kex" target="_blank"><?php echo $_About['1007']; ?></a>
            <a href="https://bitgogo.io/exchange/BUT/BTC" class="bitgogo" target="_blank"><?php echo $_About['1008']; ?></a>
            <a href="https://dex.top/trade/ETH_BUT" class="dex" target="_blank">DEx.top</a>
            <a href="https://exchange.fcoin.com/ex/gpm/but-eth" class="fcoin" target="_blank">FCOIN</a>
            <span><?php echo $_About['1009']; ?></span>
        </div>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>
</body>
</html>