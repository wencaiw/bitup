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
        '13001' => ''
    ),
    'cn' => array(
        '13001' => ''
    )
);
$l = $_COOKIE['BT_LANG'];
$_news = $news[$l];

$curr_page_id = 2;
$title = 'BitUP首支固收基金「币币宝」抢购指南';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
    <link rel="stylesheet" type="text/css" href="news.less?__inline">
</head>
<body>

<?php include_once '../common/tpl/header.php'; ?>

<div class="news-main-body zhinan-page">
   <div class="new-page title">BitUP首支固收基金「币币宝」抢购指南</div>
   <div class="new-page" style="margin-top: 15px;">
        <img src="/common/images/news/img-banner-news-01.png" />
        <p>大家期待已久的BitUP“币币宝”固收产品今晚9点将正式上线，为了方便大家抢购，现在小编把购买的具体流程发给大家。</p>
        <div class="title">第一步，登陆BitUP官网（官网地址：www.bitup.com  ），另外，注意科学上网哟。</div>
        <img src="/common/images/news/img-banner-news-02.png" />
        <div class="title">第二步，进入“充值/提现”页面，进行充值。目前，平台支持BTC和BUT两个币种充值和提现。</div>
        <img src="/common/images/news/img-banner-news-03.png" />
        <div class="title">第三步，点击进入“基金超市”页面，就可以看到本期的两支“币币宝”产品了，分别是“BTC币币保护神001”和“BUT币币保护神101。点击抢购进行购买。</div>
        <img src="/common/images/news/img-banner-news-04.png" />
        <div class="title">第四步，点击抢购进入正式抢购页面，输入购买数量进行抢购。</div>
        <img src="/common/images/news/img-banner-news-05.png" />
        <img src="/common/images/news/img-banner-news-06.png" />
        <div class="title">第五步，查看抢购记录，并在“我的资产”页面可以看到已购买产品</div>
        <img src="/common/images/news/img-banner-news-07.png" />
        <img src="/common/images/news/img-banner-news-08.png" />
        <div class="title">抢购小技巧</div>
        <p>如果您账户中既有BTC还有BUT，建议先抢购“BTC币币保护神001”，因为如果先抢购“BUT币币保护神101”导致账户BUT余额不足（小于2000BUT），则还需要充值BUT（账户BUT余额大于2000）才有资格参与“BTC币币保护神001”哟。</p>
        <div class="center">
            <img style="margin-top:60px;" src="/common/images/wx-group.jpg" />
            <p style="margin-top:8px;">扫描二维码加入微信群</p>
            <p style="margin-top:32px;">以上截图来自测试页面，以正式上线页面为准</p>
        </div>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>
</body>
</html>