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
        '13001' => 'Announcement on launching five more fixed income funds',
        '13002' => 'Dear BitUP investors,',
        '13003' => 'Five more fixed income funds will be lunched on 11th, July.',
        '13004' => 'Product Introduction:',
        '13005' => '1. BTC Coin Guardian 002：30 days locked up period, annual return rate 8%, purchasing time from 2018/7/11 16:00:00 to 2018/7/17 0:00:00 （GMT+8）',
        '13006' => '2. BTC Coin Guardian 003：90 days locked up period, annual return rate 10%, purchasing time from 2018/7/11 16:00:00 to 2018/7/19 0:00:00 （GMT+8）',
        '13007' => '3. BUT Coin Guardian 103：30 days locked up period, annual return rate 14%, purchasing time from 2018/7/11 16:00:00 to 2018/7/17 0:00:00 （GMT+8）',
        '13008' => '4. BUT Coin Guardian 104：90 days locked up period, annual return rate 16%, purchasing time from 2018/7/11 16:00:00 to 2018/7/17 0:00:00 （GMT+8）',
        '13009' => '5. BUT Coin Guardian 105：180 days locked up period, annual return rate 18%, purchasing time from 2018/7/11 16:00:00 to 2018/7/17 0:00:00 （GMT+8）', 
        '13010' => 'For product details, please check out our website.',   
        '13011' => 'The Coin Guardian is a kind of fixed income fund financing product launched by BitUP. The BitUP team uses the idea of quantitative hedging, and the short-term and low risk stable return investment strategy is designed, and the user is risk-free to obtain fixed income during the investment.',
        '13012' => 'BitUP will continuously provide sincere service and quality asset-management products.'
    ),
    'cn' => array(
        '13001' => 'BitUP 5支固收基金「币币宝」上线公告',
        '13002' => '亲爱的BitUP投资者您好:',
        '13003' => 'BitUP将于7月11日上线5支固定收益基金理财产品，分别是BTC币币保护神002、BTC币币保护神003、BUT币币保护神103、BUT币币保护神104、BUT币币保护神105。',
        '13004' => '5支基金简介如下：',
        '13005' => '1. BTC币币保护神002：产品期限30天，年化收益8%，认购起止时间：2018/7/11 16:00:00 ~ 2018/7/17 0:00:00 （GMT+8） ；',
        '13006' => '2. BTC币币保护神003：产品期限90天，年化收益10%，认购起止时间：2018/7/11 16:00:00 ~ 2018/7/19 0:00:00 （GMT+8）；',
        '13007' => '3. BUT币币保护神103：产品期限30天，年化收益14%，认购起止时间：2018/7/11 16:00:00 ~ 2018/7/17 0:00:00 （GMT+8）；',
        '13008' => '4. BUT币币保护神104：产品期限90天，年化收益16%，认购起止时间：2018/7/11 16:00:00 ~ 2018/7/17 0:00:00 （GMT+8）；',
        '13009' => '5. BUT币币保护神105：产品期限180天，年化收益18%，认购起止时间：2018/7/11 16:00:00 ~ 2018/7/17 0:00:00 （GMT+8）',
        '13010' => '基金详情请进入官网查看。',
        '13011' => '币币宝是由BitUP推出的一类固定收益基金理财产品，由BitUP团队使用量化对冲的思路，设计的短期低风险稳定回报投资策略，用户在投资期间无风险获得固定收益。',
        '13012' => 'BitUP将持续不断地为您提供优质的服务与高质量的基金理财产品。'
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
        <?php echo $_news['13002']; ?><br/>
        <?php echo $_news['13003']; ?>
        <p class="title"><?php echo $_news['13004']; ?></p>
        <?php echo $_news['13005']; ?><br/>
        <?php echo $_news['13006']; ?><br/>
        <?php echo $_news['13007']; ?><br/>
        <?php echo $_news['13008']; ?><br/>
        <?php echo $_news['13009']; ?><br/>
        <?php echo $_news['13010']; ?><br/>
        <?php echo $_news['13011']; ?><br/><br/>
        <?php echo $_news['13012']; ?>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>
</body>
</html>