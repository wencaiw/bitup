<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/11
 * Time: 下午4:54
 */
require_once "common/data/include.php";

$index = array(
    'en' => array(
//        '1001' => 'INTELLIGENT DIGITAL<br/>ASSET MANAGEMENT',
//        '1002' => 'Open the Door to Digital Wealth',
        '1003' => 'VOTING FOR BUT  LISTING ON HUOBI',
        '1004' => 'HADAX EXCHANGE',
        '1005' => 'Logging on HUOBI HADAX platform, voting for BUT, you <br/>can get <span class="color-f6">2.5</span> BUT reward for each vote!',
        '1006' => 'Go to Vote',
        '1007' => 'BITUP CANDY DELIVERY',
        '1008' => 'Register now, you\'ll get <span class="color-f6">20</span> BUT(BitUP token), <br/>There are <span class="color-f6">3,000,000</span> BUT in the candy jar.',
        '1009' => 'Hello, BitUP',
//        '1010' => 'Asset security is our top priority, together with a networking security team from University of California, we will guarantee the asset security of investors.',
//        '1011' => 'We help crypto currency holders (individual or corporation, e.g., crypto fund) manage their digital assets, reducing asset risk.',
//        '1012' => 'We provide Active/Passive Digital Asset Combination(DAC), managed by professional portfolio managers, for BitUP investors to buy/sell in <br/>one click.',
//        '1013' => 'We collaborate with professional quant trading team from Silicon Valley and Wall Street, with Mathematical Modeling and Machine Learning, AI program will help BitUP investors gain big profit.',
        '1014' => 'Benefits of DAC',
        '1015' => 'Non-stop assets investment',
        '1016' => 'Globally 7/24/365 investing<br/>&nbsp;',
        '1017' => 'Super-easy to invest',
        '1018' => 'Integrated smart contract, anyone can invest<br/>&nbsp;',
        '1019' => 'Secure & Fair',
        '1020' => 'Decentralized bolckchain tech, protect your assets and privacy',
        '1021' => 'Advisors',
        '1022' => 'Feng Li',
        '1023' => 'Founding partner of <br/>FREES Fund',
        '1024' => 'Former IDG partner',
        '1025' => 'Early investor of Ripple,<br/>Coinbase',
        '1026' => 'Tao Jiang',
        '1027' => 'Founder of CSDN',
        '1028' => 'Founding partner of <br/>GeekFounders',
        '1029' => 'Early investor of OKCoin',
        '1030' => 'Bo Shen',
        '1031' => 'Founder of Fenbushi<br/>Capital',
        '1032' => 'Zhenlin Zhai',
        '1033' => 'Founder and chairman<br/>of Yisanban',
        '1034' => 'Former member of PBC <br/>School of Finance, <br/>Tsinghua University',
        '1035' => 'Dawei Yuan',
        '1036' => 'Founder of Coldlar',
        '1037' => 'Former co-founder of Huobi',
        '1038' => 'Chenhui Tan',
        '1039' => 'Founder of BiShiJie',
        '1040' => 'Xiaopeng Shang',
        '1041' => 'Chairman of BTC123',
        '1042' => 'Investor',
//        '1043' => 'Register/Login',
        '1044' => 'Register',
    ),
    'cn' => array(
//        '1001' => '智能数字资产管理',
//        '1002' => '立足数字世界  探索财富秘籍',
        '1003' => 'BUT上线火币',
        '1004' => 'HADAX投票',
        '1005' => '登录火币HADAX平台 为BUT投票 每投一票可获得 <span class="color-f6">2.5</span> BUT超额奖励',
        '1006' => '去投票',
        '1007' => 'BUT糖果大派送',
        '1008' => '立即注册BitUP平台 注册成功可获得<span class="color-f6">20</span>枚BUT奖励共计<span class="color-f6">300万枚</span> 送完即止',
        '1009' => '初识BitUP',
//        '1010' => '资产安全是我们的第一优先级，我们将会与加州大学网络安全团队合作，共同保障投资者的资产安全。',
//        '1011' => '我们帮助加密货币的持有者（个人或基金机构，例如加密货币基金）管理数字资产，降低资产风险。',
//        '1012' => '我们将提供专业投资经理管理的主动型/被动型数字资产组合（DAC）以供BitUP投资人一键买卖。<br/>&nbsp;',
//        '1013' => '我们与来自硅谷与华尔街的专业量化基金团队合作，通过数学建模和机器学习，AI程序将会帮助BitUP投资人获得丰厚利润。',
        '1014' => 'DAC的优势',
        '1015' => '全天无休 提升操作空间',
        '1016' => '全球范围7×24h不间断操作',
        '1017' => '超低投资门槛',
        '1018' => '基于智能合约技术，人人均可参与',
        '1019' => '公平公正',
        '1020' => '分布式账本技术，保障资产安全和隐私',
        '1021' => '项目顾问',
        '1022' => '李丰',
        '1023' => '峰瑞资本创始合伙人',
        '1024' => '前IDG合伙人',
        '1025' => 'Ripple，Coinbase早期投<br/>资人',
        '1026' => '蒋涛',
        '1027' => 'CSDN创始人',
        '1028' => '极客帮创投创始合伙人',
        '1029' => 'OKCoin早期投资人',
        '1030' => '沈波',
        '1031' => '分布式资本创始人',
        '1032' => '翟振林',
        '1033' => '易三板创始人兼董事长',
        '1034' => '原清华大学五道口金融学院<br/>成员',
        '1035' => '袁大伟',
        '1036' => '北京库神信息技术有限公<br/>司创始人',
        '1037' => '原火币网联合创始人',
        '1038' => '谭晨辉',
        '1039' => '币世界创始人',
        '1040' => '尚小朋',
        '1041' => '成都链一网络科技有限公司<br/>（BTC123）董事长',
        '1042' => '投资机构',
//        '1043' => '注册/登录',
        '1044' => '马上注册',
    )
);
$l = $_COOKIE['BT_LANG'];
$_Index = $index[$l];

$curr_page_id = 1;
$title = 'BitUP';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'common/tpl/meta.php'; ?>
    <link rel="stylesheet" href="/common/css/index.css?v=22" />
</head>

<body style="background-color: #fff;">
<div class="header header_index">
    <div class="fast-enter" style="text-align: right;">
        <div class="common-container clearfix">
            <div class="fl">
                <!--                <span style="margin-right: 15px;">--><?php //echo $_Lang['100023']; ?><!--,</span>-->
                <?php if(!BTSession::isValid()){ ?>
                    <a href="/login/"><span class="color-f6">[<?php echo $_Lang['100001']; ?>]</span></a>&emsp;&emsp;&emsp;
                    <a href="/register/"><span class="color-f6">[<?php echo $_Lang['100002']; ?>]</span></a>
                <?php }else{
                    echo $_Lang['100023']; ?>,
                    <a href="/dashboard/" class="color-f6"><?php echo $_SESSION["account"]; ?></a>&emsp;&emsp;
                    <a id="logout" href="javascript:;"><span class="color-f6">[<?php echo $_Lang['100024']; ?>]</span></a>
                <?php } ?>
            </div>
            <ul class="dib">
                <li><i class="common-icon icon-home"></i><a href="/"><?php echo $_Lang['100016']; ?></a></li>
                <li class="soon" text="<?php echo $_Lang['100198']; ?>"><i class="common-icon icon-guide"></i><a href="javascript:;" data-href="/guide/"><?php echo $_Lang['100017']; ?></a></li>
                <li class="soon" text="<?php echo $_Lang['100198']; ?>"><i class="common-icon icon-faq"></i><a href="javascript:;" data-href="/guide/#6-1"><?php echo $_Lang['100018']; ?></a></li>
                <li id="lang"><a style="cursor: pointer;"><?php echo $_Lang['100019']; ?></a><i class="common-icon icon-arrow-right"></i></li>
                <li class="soon" text="<?php echo $_Lang['100198']; ?>"><i class="common-icon icon-phone"></i><a href="" class="color-f6"><?php echo $_Lang['100020']; ?></a></li>
            </ul>
        </div>
    </div>
    <div class="logo-nav">
        <div class="logo-container common-container clearfix">
            <a href="/" class="logo-coral">
                <img style="height: 40px;" src="/common/images/logo-w.png">
            </a>
            <div class="home-menu">
                <a href="/" class="<?php echo $curr_page_id == 1 ? 'current' : ''; ?>"><?php echo $_Lang['100016']; ?></a>
                <!--            <a href="javascript:;" data-href="/about" class="soon --><?php //echo $curr_page_id == 2 ? 'current' : ''; ?><!--" text="--><?php //echo $_Lang['100198']; ?><!--">--><?php //echo $_Lang['100025']; ?><!--</a>-->
                <a href="/download/<?php echo $l=='en' ? 'bitup_whitepaper_en' : 'bitup_whitepaper_cn'; ?>.pdf" target="_blank" class="<?php echo $curr_page_id == 3 ? 'current' : ''; ?>"><?php echo $_Lang['100183']; ?></a>
                <a href="javascript:;" data-href="/dac" class="soon <?php echo $curr_page_id == 4 ? 'current' : ''; ?>" text="<?php echo $_Lang['100198']; ?>"><?php echo $_Lang['100026']; ?></a>
            </div>
            <?php if(!BTSession::isValid()){ ?>
                <a href="/login/" class="my-account"><span><?php echo $_Lang['100205']; ?></span></a>
            <?php }else{ ?>
                <a href="/dashboard/" class="my-account"><i class="common-icon icon-account"></i><span><?php echo $_Lang['100184']; ?></span></a>
            <?php } ?>
        </div>
    </div>

</div>
<div class="banner" style="background-color: #f2f2f2;">
    <div class="con con3">
        <div class="index_center">
            <p class="fz-56" style="padding-top: 170px;"><?php echo $_Index['1007']?></p>
            <p class="fz-24" style="line-height: 33px;"><?php echo $_Index['1008']?></p>
            <a href="/register" class="fz-24" style="margin-top: 36px;"><?php echo $_Index['1044']?></a>
        </div>
    </div>
    <div class="con con1">
        <div class="index_center">
            <p class="fz-50" style="padding-top: 160px; line-height: 60px;"><?php echo $_Lang['100203']?></p>
            <p class="fz-24"><?php echo $_Lang['100204']?></p>
        </div>
    </div>
<!--    <div class="con con2">-->
<!--        <div class="index_center">-->
<!--            <p class="fz-30" style="padding-top: 120px;">--><?php //echo $_Index['1003']?><!--</p>-->
<!--            <p class="fz-70" style="line-height: 70px;">--><?php //echo $_Index['1004']?><!--</p>-->
<!--            <p class="fz-24" style="line-height: 33px; padding-top: 22px;">--><?php //echo $_Index['1005']?><!--</p>-->
<!--            <a href="https://www.hadax.com/--><?php //echo $l=='en' ? 'en-us' : 'zh-cn' ?><!--/vote/" target="_blank" class="fz-24" style="margin-top: 22px;">--><?php //echo $_Index['1006']?><!--</a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="con con3">-->
<!--        <div class="index_center">-->
<!--            <p class="fz-56" style="padding-top: 195px;">--><?php //echo $_Index['1007']?><!--</p>-->
<!--            <p class="fz-24" style="line-height: 33px;">--><?php //echo $_Index['1008']?><!--</p>-->
<!--        </div>-->
<!--    </div>-->
    <div class="banner_index" id="banner_slide"><i class="on"></i><i></i></div>
</div>

<div class="module common-container center">
    <div class="fz-30 title_bg"><?php echo $_Index['1009']?></div>
    <dl>
        <dt></dt>
        <dd><?php echo $_Lang['100199']?></dd>
    </dl>
    <dl>
        <dt></dt>
        <dd><?php echo $_Lang['100200']?></dd>
    </dl>
    <dl>
        <dt></dt>
        <dd><?php echo $_Lang['100201']?></dd>
    </dl>
    <dl>
        <dt></dt>
        <dd><?php echo $_Lang['100202']?></dd>
    </dl>
</div>

<div class="dac common-container center">
    <div class="fz-30 title_bg"><?php echo $_Index['1014']?></div>
    <dl>
        <dt><?php echo $_Index['1015']?></dt>
        <dd><?php echo $_Index['1016']?></dd>
    </dl>
    <dl>
        <dt><?php echo $_Index['1017']?></dt>
        <dd><?php echo $_Index['1018']?></dd>
    </dl>
    <dl>
        <dt><?php echo $_Index['1019']?></dt>
        <dd><?php echo $_Index['1020']?></dd>
    </dl>
</div>
<div class="advisors">
    <div class="common-container center">
        <div class="fz-30 title_bg title_bg2" style="color: #BAE4FF;"><i></i><?php echo $_Index['1021']?></div>
        <dl>
            <dt><?php echo $_Index['1022']?></dt>
            <dd><?php echo $_Index['1023']?></dd>
            <dd><?php echo $_Index['1024']?></dd>
            <dd><?php echo $_Index['1025']?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1026']?></dt>
            <dd><?php echo $_Index['1027']?></dd>
            <dd><?php echo $_Index['1028']?></dd>
            <dd><?php echo $_Index['1029']?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1030']?></dt>
            <dd><?php echo $_Index['1031']?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1032']?></dt>
            <dd><?php echo $_Index['1033']?></dd>
            <dd><?php echo $_Index['1034']?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1035']?></dt>
            <dd><?php echo $_Index['1036']?></dd>
            <dd><?php echo $_Index['1037']?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1038']?></dt>
            <dd><?php echo $_Index['1039']?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1040']?></dt>
            <dd><?php echo $_Index['1041']?></dd>
        </dl>
        <div class="index_clear"></div>
    </div>
</div>
<div class="investor common-container center">
    <div class="fz-30 title_bg"><?php echo $_Index['1042']?></div>
    <div style="padding: 0 10px; width: 1180px;">
        <img src="/common/images/index/img-huobi@2x.png">
        <img src="/common/images/index/img-node@2x.png">
        <img src="/common/images/index/img-frees@2x.png">
        <img src="/common/images/index/img-geek@2x.png">
        <img src="/common/images/index/img-genesis@2x.png">
        <img src="/common/images/index/img-8DECIMAL@2x.png">
        <img src="/common/images/index/img-TOP@2x.png">
        <div class="index_clear"></div>
    </div>
</div>
<div class="contact-bar">
    <div class="item">
        <a class="box">
            <img src="common/images/index/icon-mail28x28@2x.png" width="46%" alt="">
        </a>
        <em>support@bitup.com</em>
    </div>
        <div class="item">
            <a href="https://www.facebook.com/bitupofficial" target="_blank" class="box">
                <img src="common/images/index/icon-facebook28x28@2x.png" width="58%" alt="">
            </a>
        </div>
        <div class="item">
            <a href="https://twitter.com/bitupofficial" target="_blank" class="box">
                <img src="common/images/index/icon-twitter28x28@2x.png" width="46%" alt="">
            </a>
        </div>
    <div class="item">
        <a href="https://t.me/bitupofficial" target="_blank" class="box">
            <img src="common/images/index/icon-telegram28x28@2x.png" width="46%" alt="">
        </a>
    </div>
<!--    <div class="item">-->
<!--        <a href="http://bitup.com/candy/index.php" target="_blank" class="box">-->
<!--            <img src="img/icon-candy2.png" width="58%" alt="">-->
<!--        </a>-->
<!--    </div>-->
</div>

<?php include_once 'common/tpl/footer.php'; ?>
<script type="text/javascript" src="common/js/index.js?v=11"></script>
</body>

</html>
