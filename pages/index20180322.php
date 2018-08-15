<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/3/15
 * Time: 上午10:45
 */
require_once "common/data/include.php";
$index = array(
    'en' => array(
        '1001' => '简体中文',
        '1002' => 'White Paper',
        '1003' => 'Reward Voting',
        '1004' => '注册／登录',
        '1005' => 'Welcome to Digital Asset Investment 3.0',
        '1006' => 'Sign up now',
        '1007' => 'Prior to 2015',
        '1008' => 'Coin accumulation',
        '1009' => 'Investors driven mainly by personal belief',
        '1010' => 'Investors driven mainly by short-term speculation',
        '1011' => '2018-Future',
        '1012' => 'Asset Management',
        '1013' => 'Combination of asset allocation, investment strategies and quantitative hedging',
        '1014' => 'Problems and Solutions',
        '1015' => 'Problems',
        '1016' => 'For disorganized traders lacking a coherent strategy, risk is extremely high.<br />&nbsp;',
        '1017' => 'Manual trading is inefficient and inevitably leads to human-error.<br />&nbsp;',
        '1018' => 'Regularly reorganizing your portfolio across multiple currencies results in high trading fees.',
        '1019' => 'It\'s impossible to constantly monitor the market. Opportunities are inevitably missed.',
        '1020' => 'Solutions',
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
        '1033' => 'Founder and CEO of Yisanban',
        '1034' => 'Former director of Weiyang Network at Tsinghua University\'s Wudaokou Institute of Finance.',
        '1035' => 'Dawei Yuan',
        '1036' => 'Founder of Coldlar',
        '1037' => 'Former co-founder of Huobi',
        '1038' => 'Chenhui Tan',
        '1039' => 'Founder of BiShiJie',
        '1040' => 'Xiaopeng Shang',
        '1041' => 'Chairman of BTC123',
        '1042' => 'Investors',
        '1043' => 'Your assets are managed by professional investors from Wall Street and Silicon Valley who focus on achieving long-term, stable returns.',
        '1044' => 'Automatic trading handled by an advanced AI system. Highly efficient and accurate.<br />&nbsp;<br />&nbsp;',
        '1045' => 'Only a very small management fee is charged. We only take a cut when profits are achieved.<br />&nbsp;<br />&nbsp;',
        '1046' => 'Combined efforts of experts and AI means round-the-clock monitoring and no opportunity is missed.<br />&nbsp;<br />&nbsp;',
        '1047' => 'Product Introduction',
        '1048' => 'Passive Index Fund - BitUP Prime (BPP)',
        '1049' => 'Strategy',
        '1050' => 'Only those currencies with solid long-term prospects can enter the fund. We favor technologies with the potential to shake-up the market and leave a mark. There is no short-term speculation on derivative currencies that don\'t bring added value relative to the competition. The weighting of each asset in the fund is based on complex modeling and adjusts dynamically according to the market.',
        '1051' => 'Fund Manager',
        '1052' => 'The fund is managed by Laurent, who has extensive experience in all kinds of trading and investment, including traditional internet stocks and digital assets. He is also a renowned expert in market research.',
        '1053' => 'Active Index Fund - BitUP Challenger (BPC)',
        '1054' => 'Using advanced algorithms and quantitative trading strategies we are able to evaluate and predict trends and adjust our portfolio accordingly. The model adapts in real-time to keep up with the fast-changing nature of the market and will always maximize every opportunity that arises.<br />&nbsp;',
        '1055' => 'This fund is managed by Macaulay, an expert in quantitative trading with a PhD from MIT. He has 6 years of experience working in Wall Street and has a broad knowledge of the most effective trading strategies. ',
        '1056' => 'Passive Index',
        '1057' => 'Macro Hedging',
        '1058' => 'Quantitative Arbitrage',
        '1059' => 'Active Alpha',
        '1060' => 'More',
        '1061' => 'Platform Technology',
        '1062' => 'Blockchain technology allows for all our trades to be recorded and made available for users to check and copy for themselves. This transparency solidifies trust, as the exact performance of the fund at any given time is always open knowledge.',
        '1063' => 'Advanced mathematical modelling and machine learning AI carries out quantitative trading with perfect precision and optimal strategies.<br/>&nbsp;',
        '1064' => 'We use well-established, reputable third-party asset storage providers and provide highly secure cold wallet storage plans. Everything is completely transparent and investors can access details of their stored assets at any time.',
        '1065' => 'We have a multi-layered risk management engine that covers the entire platform. This automatically detects any abnormal operations performed by fund managers and takes action to safeguard investors\' rights and assets. ',
        '1066' => 'Road Map',
        '1067' => 'The BitUP team forms and extensive market research is carried out',
        '1068' => 'BitUP foundation and operating company established in Singapore',
        '1069' => 'BitUP completes fundraising from invited investment agencies',
        '1070' => 'BitUP starts accepting registrations',
        '1071' => 'BPP, the first passive index fund, goes live',
        '1072' => 'BitUP launches iOS and Android mobile apps, and our first active index fund, BPC, becomes available',
        '1073' => 'The total number of index funds reaches 20, and launches strategy subscription system',
        '1074' => 'The total number of funds reaches 100, with more than $1B of assets under management',
        '1075' => 'How to start using BitUP?',
        '1076' => 'After registering, make a deposit of Bitcoin, Ethereum or BitUP Tokens to your BitUP wallet. You can then use this deposit to buy into your preferred fund. In future, the BitUP platform will offer investment strategy subscriptions, which will allow investors to automatically follow the trades of chosen professional investors.',
        '1077' => 'Can I buy or sell BitUP funds at any time?',
        '1078' => 'Yes, you can make transactions 24/7. ',
        '1079' => 'How do I make a withdrawal from BitUP?',
        '1080' => 'You can make withdrawals in Bitcoin, Ethereum or BitUP Tokens. The process is very similar across different cryptocurrency exchanges.',
        '1081' => 'What is the level of risk?',
        '1082' => 'In the current market, any investment in cryptocurrency should be seen as high-risk. Joining BitUP allows you to minimize that risk as much as possible while still exposing yourself to this exciting market.',
        '1083' => 'When will BitUP go live?',
        '1084' => 'We will launch in Q2 2018. Stay tuned for specific dates.',
        '1085' => 'What is BitUP Token?',
        '1086' => 'BitUP Token (BUT) is issued by BitUP and is mainly used on the BitUP platform make deposits, withdrawals and pay platform fees. BUT will also be used to reward customers and high-performing fund managers, encouraging the creation of a successful investment ecosystem.',
        '1087' => '11/2017',
        '1088' => '01/2018',
        '1089' => '02/2018',
        '1090' => '03/2018',
        '1091' => '05/2018',
        '1092' => '06/2018',
        '1093' => '12/2018',
        '1094' => 'BUT listed on Huobi',
        '1095' => 'HADAX Voting',
        '1096' => 'Login HUOBI HADAX. Vote for BUT now! You get <span class="color_f6">3</span> BUT reward for each vote',
        '1097' => 'Vote for BUT',
    ),
    'cn' => array(
        '1001' => '简体中文',
        '1002' => '白皮书',
        '1003' => '投票领糖果',
        '1004' => '注册／登录',
        '1005' => '带你走进数字资产投资3.0',
        '1006' => '立即注册',
        '1007' => '2015年以前',
        '1008' => '屯币',
        '1009' => '个人信仰驱动',
        '1010' => '短期炒作投机驱动',
        '1011' => '2018-未来',
        '1012' => '资产管理',
        '1013' => '资产配置+投资策略与哲学+量化对冲',
        '1014' => '市场痛点与解决方案',
        '1015' => '市场痛点',
        '1016' => '没有专业的交易策略<br />资产风险极高',
        '1017' => '手工交易效率低<br />且容易出错',
        '1018' => '做不同币种的资产配置与调仓<br />手续费高',
        '1019' => '无法长时间持续盯盘<br />错过机会',
        '1020' => '解决方案',
        '1021' => '顾问',
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
        '1043' => '由来自华尔街和硅谷的专业投资人帮助管理资产，长期稳定权益',
        '1044' => '基于AI的程序自动化交易<br />高效且无差错',
        '1045' => '只收取较少的管理费，以及根据基金收益率动态决定的利润分成',
        '1046' => '7/24人工与计算机程序盯盘<br/>不会错过任何机会',
        '1047' => '产品简介',
        '1048' => '被动型指数基金——BitUP Prime (BPP)',
        '1049' => '策略',
        '1050' => '选取全球最具前瞻性及变革性，拥有长期持有价值的币种阵列，经过系统性建模评估得出权重组合；并根据市场行情波动动态调仓。',
        '1051' => '基金经理',
        '1052' => 'Laurent，拥有传统互联网与区块链一级市场丰富的投资经验，行业研究专家',
        '1053' => '主动型指数基金——BitUP Challenger (BPC)',
        '1054' => '通过人工智能算法与量化交易策略结合，对行情做出趋势判断与预测，选择优质币种阵列进行程序化交易，并且根据行情实时调整模型，最大程度适应市场的飞速变化，在不断演化的市场持续实现利润最大化。',
        '1055' => 'Macaulay，MIT博士，量化交易专家，6年华尔街操盘经验',
        '1056' => '被动指数',
        '1057' => '宏观对冲',
        '1058' => '量化套利',
        '1059' => '主动Alpha',
        '1060' => '更多',
        '1061' => '技术平台',
        '1062' => '通过区块链技术实现投资决策的信号追随，让交易与获利在投资者与基金经理之间公开透明，让投资的策略追随简单便捷',
        '1063' => '通过数学建模与机器学习训练AI程序实现最优策略的量化交易<br/>&nbsp;',
        '1064' => '公开透明，并且专业安全的第三方的资管方案，会与有信誉的资管方共同打造冷钱包存储方案与安全严格的操作流，并随时向投资者披露资金的存储细节',
        '1065' => '覆盖全平台的多级的风控引擎，自动识别基金经理的任何不正常操作，7/24我们的风控团队会随时待命，在第一时间采取措施，避免任何损害投资人利益的行为',
        '1066' => '项目路线图',
        '1067' => 'BitUP团队成立，并进行了详细的市场调研',
        '1068' => 'BitUP在新加坡成立基金会与运营公司',
        '1069' => 'BitUP完成了针对定向邀约的投资机构的募资',
        '1070' => 'BitUP开始开放潜在投资者注册',
        '1071' => 'BitUP平台正式上线第一支被动型指数基金BPP',
        '1072' => 'BitUP推出iOS与Android版，并上线第一支主动型指数基金BPC',
        '1073' => '平台基金达到20支，并上线策略订阅系统',
        '1074' => '平台基金增加到100支，管理规模10亿美金+',
        '1075' => '如何开始使用BitUP?',
        '1076' => '注册账号后，将BTC/ETH/BUT充值到BitUP平台钱包内，选择自己看好的基金一键认购即可。未来BitUP平台还会支持策略订阅，选择专业的投资人订阅策略，即可实现自动购买。',
        '1077' => 'BitUP平台的基金是否可以随时买卖？',
        '1078' => '是的，7/24实时交易。',
        '1079' => '使用BitUP平台后如何提现？',
        '1080' => 'BitUP支持BTC/ETH/BUT提现，步骤与各大数字交易所提现步骤类似。',
        '1081' => 'BitUP投资风险如何？',
        '1082' => '现阶段，数字货币投资在任何时候都应该被认为是高风险投资。如果通过BitUP平台投资，专业的投资经理将会通过多种策略提高投资收益，降低资产风险。',
        '1083' => 'BitUP 预计何时上线？',
        '1084' => '我们将在2018年Q2正式上线产品，敬请关注。',
        '1085' => 'BUT token是什么？有什么作用？',
        '1086' => 'BitUP Token (BUT) 是BitUP基金会发行的代币，主要用于BitUP平台充值，提现，平台费用的支付。BUT还会被用来奖励用户与优秀的基金经理，构建一个关注区块链投资市场的生态圈。',
        '1087' => '2017.11',
        '1088' => '2018.01',
        '1089' => '2018.02',
        '1090' => '2018.03',
        '1091' => '2018.05',
        '1092' => '2018.06',
        '1093' => '2018.12',
        '1094' => 'BUT上线火币',
        '1095' => 'HADAX投票',
        '1096' => '登录火币HADAX平台，为BUT投票，每投一票可获得 <span class="color_f6">3</span> BUT超额奖励',
        '1097' => '去投票',
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
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="http://www.bitup.com/common/images/favicon_g.ico" media="screen">
    <link rel="stylesheet" href="/common/css/index2.css?v23" />
</head>
<body>
<header>
    <div class="c_container">
        <a href="/" class="logo">
            <img src="/common/images/logo-w.png">
        </a>
        <ul>
            <li><a id="lang"><?php echo $_Lang['100019']; ?></a></li>
            <li><a href="/download/<?php echo $l=='en' ? 'bitup_whitepaper_en' : 'bitup_whitepaper_cn'; ?>.pdf" target="_blank"><?php echo $_Index['1002']; ?></a></li>
            <li><a target="_blank" href="https://www.hadax.com/<?php echo $l=='en' ? 'en-us' : 'zh-cn'; ?>/vote/item/?p=103"><?php echo $_Index['1003']; ?></a></li>
            <li>
                <?php if(!BTSession::isValid()){ ?>
                    <a href="/login/" class="my_account"><span><?php echo $_Lang['100205']; ?></span></a>
                <?php }else{ ?>
                    <a href="/dashboard/" class="my_account"><i class="common-icon icon-account"></i><span><?php echo $_Lang['100184']; ?></span></a>
                <?php } ?>
            </li>
        </ul>
        <div class="c_clear"></div>
        <button class="menu_icon"><i></i><i></i><i></i></button>
    </div>
    <div class="header_menu_wrap"></div>
</header>
<div class="banner c_center c_whiter">
    <div class="b_con b_con1">
        <p class="fz_80">BitUP</p>
        <p class="fz_32"><?php echo $_Index['1005']; ?></p>
        <a href="/register/"><?php echo $_Index['1006']; ?></a>
        <div class="ascent">
            <div class="c_container">
                <div class="item">
                    <div class="box">
                        <span class="version">1.0</span>
                        <p class="time"><?php echo $_Index['1007']; ?></p>
                    </div>
                    <p class="info"><i><?php echo $_Index['1008']; ?></i><br /><?php echo $_Index['1009']; ?></p>
                </div>
                <div class="item">
                    <div class="box">
                        <span class="version">2.0</span>
                        <p class="time">2016-2017</p>
                    </div>
                    <p class="info"><i>ICO Era</i><br /><?php echo $_Index['1010']; ?></p>
                </div>
                <div class="item">
                    <div class="box">
                        <span class="version">3.0</span>
                        <p class="time"><?php echo $_Index['1011']; ?></p>
                    </div>
                    <p class="info"><i><?php echo $_Index['1012']; ?></i><br /><?php echo $_Index['1013']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="b_con b_con2">
        <p class="fz_40"><?php echo $_Index['1094']; ?></p>
        <p class="fz_80"><?php echo $_Index['1095']; ?></p>
        <p class="fz_20"><?php echo $_Index['1096']; ?></p>
        <a target="_blank" href="https://www.hadax.com/<?php echo $l=='en' ? 'en-us' : 'zh-cn'; ?>/vote/item/?p=103"><?php echo $_Index['1097']; ?></a>
    </div>
    <div class="banner_index" id="banner_slide"><i class="on"></i><i></i></div>
</div>
<div class="pb_st c_container c_center">
    <div class="module_top_bg"><?php echo $_Index['1014']; ?></div>
    <div class="ps_con clearfix">
        <dl class="ps_box problem">
            <dt><?php echo $_Index['1015']; ?></dt>
            <dd><?php echo $_Index['1016']; ?></dd>
            <dd><?php echo $_Index['1017']; ?></dd>
            <dd><?php echo $_Index['1018']; ?></dd>
            <dd><?php echo $_Index['1019']; ?></dd>
        </dl>
        <img src="/common/images/index2/icon-down.png" alt="" class="icon_down">
        <dl class="ps_box solutions">
            <dt><?php echo $_Index['1020']; ?></dt>
            <dd><?php echo $_Index['1043']; ?></dd>
            <dd><?php echo $_Index['1044']; ?></dd>
            <dd><?php echo $_Index['1045']; ?></dd>
            <dd><?php echo $_Index['1046']; ?></dd>
        </dl>
    </div>
</div>
<div class="pro_int">
    <div class="c_container clearfix">
        <div class="module_top_bg c_center"><i></i><?php echo $_Index['1047']; ?></div>
        <div class="clearfix">
            <dl>
                <dt class="c_center"><?php echo $_Index['1048']; ?></dt>
                <dd><img src="/common/images/index2/intro-bpp.png" width="100%" alt=""></dd>
                <dd>
                    <b><?php echo $_Index['1049']; ?></b>
                    <p><?php echo $_Index['1050']; ?></p>
                </dd>
                <dd>
                    <b><?php echo $_Index['1051']; ?></b>
                    <p><?php echo $_Index['1052']; ?></p>
                </dd>
<!--                <dd>-->
<!--                    <b>预期收益率</b>-->
<!--                    <p>80%</p>-->
<!--                </dd>-->
            </dl>
            <dl>
                <dt class="c_center"><?php echo $_Index['1053']; ?></dt>
                <dd><img src="/common/images/index2/intro-bpc.png" width="100%" alt=""></dd>
                <dd>
                    <b><?php echo $_Index['1049']; ?></b>
                    <p><?php echo $_Index['1054']; ?></p>
                </dd>
                <dd>
                    <b><?php echo $_Index['1051']; ?></b>
                    <p><?php echo $_Index['1055']; ?></p>
                </dd>
<!--                <dd>-->
<!--                    <b>预期收益率</b>-->
<!--                    <p>80%</p>-->
<!--                </dd>-->
            </dl>
        </div>
        <div class="flag_box clearfix">
            <a><img src="/common/images/index2/icon-bd.png" alt="" class="icon"><span><?php echo $_Index['1056']; ?></span></a>
            <a><img src="/common/images/index2/icon-hg.png" alt="" class="icon"><span><?php echo $_Index['1057']; ?></span></a>
            <a><img src="/common/images/index2/icon-lh.png" alt="" class="icon"><span><?php echo $_Index['1058']; ?></span></a>
            <a><img src="/common/images/index2/icon-zd.png" alt="" class="icon"><span><?php echo $_Index['1059']; ?></span></a>
            <a class="more">
                <span><?php echo $_Index['1060']; ?></span>
                <span>⋯</span>
            </a>
        </div>
    </div>
</div>
<div class="tech_pf c_container c_center">
    <div class="module_top_bg"><?php echo $_Index['1061']; ?></div>
    <dl>
        <dt></dt>
        <dd><?php echo $_Index['1062']; ?></dd>
    </dl>
    <dl>
        <dt></dt>
        <dd><?php echo $_Index['1063']; ?></dd>
    </dl>
    <dl>
        <dt></dt>
        <dd><?php echo $_Index['1064']; ?></dd>
    </dl>
    <dl>
        <dt></dt>
        <dd><?php echo $_Index['1065']; ?></dd>
    </dl>
</div>
<div class="advisors">
    <div class="c_container c_center clearfix">
        <div class="module_top_bg module_top_bg2 c_center" style="color: #BAE4FF;"><i></i><?php echo $_Index['1021']?></div>
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
    </div>
</div>
<div class="investor c_container c_center">
    <div class="module_top_bg"><?php echo $_Index['1042']?></div>
    <div class="clearfix">
        <img src="/common/images/index2/img-huobi.png">
        <img src="/common/images/index2/img-node.png">
        <img src="/common/images/index2/img-frees.png">
        <img src="/common/images/index2/img-geek.png">
        <img src="/common/images/index2/img-genesis.png">
        <img src="/common/images/index2/img-8DECIMAL.png">
        <img src="/common/images/index2/img-TOP.png">
    </div>
</div>
<div class="c_container c_center road_map">
    <div class="module_top_bg"><?php echo $_Index['1066']; ?></div> 
    <ul class="c_whiter">
        <li> 
            <span><?php echo $_Index['1087']; ?></span> 
            <p><?php echo $_Index['1067']; ?></p> 
        </li> 
        <li> 
            <p><?php echo $_Index['1068']; ?></p> 
            <span><?php echo $_Index['1088']; ?></span> 
        </li> 
        <li> 
            <span><?php echo $_Index['1089']; ?></span> 
            <p><?php echo $_Index['1069']; ?></p> 
        </li> 
        <li> 
            <p><?php echo $_Index['1070']; ?></p> 
            <span><?php echo $_Index['1090']; ?></span> 
        </li> 
        <li> 
            <span><?php echo $_Index['1091']; ?></span> 
            <p><?php echo $_Index['1071']; ?></p> 
        </li> 
        <li> 
            <p><?php echo $_Index['1072']; ?></p> 
            <span><?php echo $_Index['1092']; ?></span> 
        </li> 
        <li> 
            <span><?php echo $_Index['1093']; ?></span> 
            <p><?php echo $_Index['1073']; ?></p> 
        </li> 
        <li> 
            <p><?php echo $_Index['1074']; ?></p> 
            <span>2019</span> 
        </li> 
        <div class="c_clear"></div> 
    </ul> 
</div>
<div class="faq">
    <div class="c_container clearfix">
        <div class="module_top_bg module_top_bg2 c_center" style="color: #BAE4FF;"><i></i>FAQ</div>
        <dl>
            <dt><?php echo $_Index['1075']; ?></dt>
            <dd><?php echo $_Index['1076']; ?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1077']; ?></dt>
            <dd><?php echo $_Index['1078']; ?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1079']; ?></dt>
            <dd><?php echo $_Index['1080']; ?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1081']; ?></dt>
            <dd><?php echo $_Index['1082']; ?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1083']; ?></dt>
            <dd><?php echo $_Index['1084']; ?></dd>
        </dl>
        <dl>
            <dt><?php echo $_Index['1085']; ?></dt>
            <dd><?php echo $_Index['1086']; ?></dd>
        </dl>
    </div>
</div>


<div class="contact_bar">
    <div class="item">
        <a href="https://t.me/<?php echo $l=='en' ? 'bitupofficial' : 'bitupcn'; ?>" target="_blank" class="box">
            <img src="common/images/index2/icon-telegram.png" width="46%" alt="">
        </a>
    </div>
    <div class="item" id="go_email">
        <a class="box">
            <img src="common/images/index2/icon-mail.png" width="46%" alt="">
        </a>
        <em>support@bitup.com</em>
    </div>
    <div class="item">
        <a href="https://www.facebook.com/bitupofficial" target="_blank" class="box">
            <img src="common/images/index2/icon-facebook.png" width="58%" alt="">
        </a>
    </div>
    <div class="item">
        <a href="https://twitter.com/bitupofficial" target="_blank" class="box">
            <img src="common/images/index2/icon-twitter.png" width="46%" alt="">
        </a>
    </div>
</div>

<footer>
    <div class="c_container">
        <div class="nav">
            <a href="javascript:;" target="_blank" class="coming_soon top" text="<?php echo $_Lang['100198']; ?>"><?php echo $_Lang['100026']; ?></a>
            <a href="/tos/" target="_blank"><?php echo $_Lang['100027']; ?></a>
            <a href="/disclaimer/" target="_blank"><?php echo $_Lang['100028']; ?></a>
            <span>|</span>
            <i class="email"></i><a href="mailto:support@bitup.com" target="_blank">support@bitup.com</a>
        </div>
        <div class="copyright_box">
            <span class="fl">©2018 BitUP <?php echo $_Lang['100030']; ?></span>
        </div>
    </div>
</footer>
<script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="common/js/index2.js?v=2"></script>
<script type="text/javascript">
    $(function(){
        //退出
        $('#logout').click(function(){
            $.ajax({
                type: "get",
                url: "/common/data/logout.php",
                data: {},
                success: function(data){
                    var data = JSON.parse(data);
                    if(data.resultCode == 0 || data.logout){
                        window.location.href = '/';
                    }
                }
            });
        });

        //切换语言
        $('#lang').click(function(){
            $.ajax({
                type: 'get',
                url: '/common/data/switch.language.php',
                data: {},
                dataType:"json",
                success:function(res){
                    if (res.resultCode == 0) {
//                        window.location.href = 'http://'+location.host + location.pathname;
                        window.location.href = window.location.href;
                    }else {
                        alert(2);
                    }
                },
                error:function(responseText,statusText){

                }
            })
        })
    });

    $(".menu_icon").click(function(){
        $("header ul").slideToggle();
        $(".header_menu_wrap").slideToggle();
    });
    $(".header_menu_wrap").click(function(){
        $("header ul").slideToggle();
        $(".header_menu_wrap").slideToggle();
    });
    $('#go_email a').click(function(){
        $("#go_email em").slideToggle();
    })
</script>
</body>
</html>
