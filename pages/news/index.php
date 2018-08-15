<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 上午9:57
 */
require_once "../common/data/include.php";
$news = array(
    'en' => array(
        '13001' => 'BitUP will officially launch online the new product Coin Box that can preserve capital and have a fix rate of interest',
        '13002' => 'Are you still worry about digital assets in the wallet, or upset for working for rise or fall of digital assets in price every day? BitUP is the digital asset management platform, and will soon launch a Coin Box, a fixed-rate financial management fund, to preserve your capital and let you enjoy a fix rate of interest. It also can help you activate your assets in the wallet and make more digital assets.',
        '13003' => 'What is Coin Box?',
        '13004' => 'Coin Box is a type of fixed-income fund management product launched by BitUP. The Through the idea of quantitative hedging, BitUP team designed a stable return investment strategy that has a short term and low risk, so that users can obtain fixed income and bear no risks during the investment period.',
        '13005' => 'Official launch time',
        '13006' => 'Launch Time From 21:00, May 23, 2018 – Finish time To 24:00, May 24, 2018 (It will launch at the product page around 8 pm on May 23, and you can log in earlier to ask for information about the product)',
        '13007' => 'The classification for the first phase of fix-income products',
        '13008' => 'BTC fixed-income fund is expected to have a fixed income at the annual rate of 10% for the first phase of preferential buying activities, and BUT annual meeting of fixed fund is expected to have a fixed income at the rate of 14%. The fixed income rate in the later period will be adjusted in accordance with market conditions. Both fixed-income fund returns will be calculated in accordance with base currency.Besides, those two types of fixed-income funds have purchase qualifications for participants. If you purchase a BTC fund, you must hold 2000 BUT in your BitUP account. If you purchase a BUT fund, you must hold 1000 BUT in your BitUP account. ',
        '13009' => '(Note: the purchase qualifications are only required at the time of purchases, and are no longer required during the entire investment period.)', 
        '13010' => 'The first phase of Coin Box has a high rate of interest and limited number, please log in our website and recharge in advance to prepare for purchasing!Purchasing website: bitup.com (open to purchaser from 21:00 tonight)!',   
        '13011' => 'May 23, 2018.',
        '13012' => 'Contact Information',
        '13013' => 'WeChat Official Account',
        '13014' => 'WeChat group:bitupofficial'
    ),
    'cn' => array(
        '13001' => 'BitUP将正式上线保本保息产品「币币宝」今晚21点限量抢购',
        '13002' => '还在为数字资产躺在钱包里面发愁吗？还在为每天追涨杀跌心烦吗？数字资产管理平台BitUP今晚即将推出「币币宝」固收理财基金，保本保息，帮助您激活钱包资产，以币生币！',
        '13003' => '「币币宝」是什么',
        '13004' => '币币宝是由BitUP推出的一类固定收益基金理财产品，由BitUP团队使用量化对冲的思路，设计的短期低风险稳定回报投资策略，用户在投资期间无风险获得固定收益。',
        '13005' => '正式上线时间',
        '13006' => '上线时间 2018年5月23日21:00 - 结束时间 2018年5月24日24:00（产品页面大约在23日20点左右上线，您可以提前登陆了解）',
        '13007' => '第一期固收产品分类',
        '13008' => '在首期优惠抢购活动中，BTC固收基金预期年化固定收益达到10%，BUT固收基金年会预期收益将达到14%，后期的固定收益率将根据市场情况进行调整。两支固收基金收益都将是以币本位计算。另外，两种固收基金，对于参与者有参与资格要求。您购买BTC基金时，您的BitUP账户须持有2000BUT，购买BUT基金时，您的BitUP账户须持有1000BUT。',
        '13009' => '（ 注：只要求购买当时持有，并不要求整个投资期间持有。）',
        '13010' => '首期币币宝，高息理财，容量有限，请提前登录充值做好抢购准备！ 抢购地址：bitup.com （今晚21点准时开抢）！',
        '13011' => '2018年5月23日',
        '13012' => '产品讨论',
        '13013' => '微信公众号',
        '13014' => '官方客服微信：bitupofficial（可以通过添加微信客服拉入群）'
    )
);
$l = $_COOKIE['BT_LANG'];
$_news = $news[$l];

$curr_page_id = 2;
$title = $_news['13001'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
    <link rel="stylesheet" type="text/css" href="news.less?__inline">
</head>
<body>

<?php include_once '../common/tpl/header.php'; ?>

<div class="news-main-body">
   <div class="new-page title"><?php echo $_news['13001']; ?></div>
   <div class="new-page" style="margin-top: 15px;">
        <?php echo $_news['13002']; ?>
        <p class="title"><?php echo $_news['13003']; ?></p>
        <?php echo $_news['13004']; ?>
        <p class="title"><?php echo $_news['13005']; ?></p>
        <?php echo $_news['13006']; ?>
        <p class="title"><?php echo $_news['13007']; ?></p>

        <img style="width: 100%;margin-bottom: 15px; max-width: 860px;" src="/common/images/news-tabe-<?php echo $l; ?>.png" /><br/>
        <!-- <div class="tab">
            <table>
                <tr>
                    <td>产品名称</td>
                    <td>产品期限</td>
                    <td>产品收益（预期年化）</td>
                    <td>产品额度</td>
                    <td>起投额度</td>
                    <td>最高限额</td>
                    <td>参与资格</td>
                </tr>
                <tr>
                    <td>BTC币币保护神001</td>
                    <td>30天</td>
                    <td>10%</td>
                    <td>10 BTC</td>
                    <td>0.01 BTC</td>
                    <td>1 BTC</td>
                    <td>须持有2000BUT</td>
                </tr>
                <tr>
                    <td>BUT币币保护神101</td>
                    <td>30天</td>
                    <td>14%</td>
                    <td>200万 BUT</td>
                    <td>1000 BUT</td>
                    <td>20万 BTC</td>
                    <td>须持有1000BUT</td>
                </tr>
            </table>
        </div> -->
        <?php echo $_news['13008']; ?><br/>
        <?php echo $_news['13009']; ?><br/>
        <?php echo $_news['13010']; ?>
      
        <p class="title"><?php echo $_news['13012']; ?></p>
        <div class="share-box">
            <ul class="share-list reset">
                <li><a href="https://t.me/bitupofficial" target="_blank"><img src="/common/images/share/telegram.png" width="20"></a></li>
                <li><a href="https://twitter.com/bitupofficial" target="_blank"><img src="/common/images/share/twitter.png" width="20"></a></li>
                <li><a href="https://www.facebook.com/bitupofficial" target="_blank"><img src="/common/images/share/facebook.png" width="20"></a></li>
                <li><img src="/common/images/share/wechat.png" width="20"><div><p class="ng-binding"><?php echo $_news['13014']; ?></p></div></li>
                <li><img src="/common/images/share/gongzhonghao.png" width="20"><div><img src="/common/images/wx-group.jpg" width="100%"><p class="ng-binding"><?php echo $_news['13013']; ?></p></div></li>
                <li><a href="//shang.qq.com/wpa/qunwpa?idkey=299396b5d0a6ef5a3496e184361c7aa5ed335d2bfae51c0d3764ced5f68047ab" target="_blank"><img src="/common/images/share/qq.png" width="20"></a></li>
            </ul>
        </div>
        <p class="title" style="color: #4F6475;margin-top: 30px;"><?php echo $_news['13011']; ?></p>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>
</body>
</html>