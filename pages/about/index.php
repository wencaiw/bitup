<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 上午9:57
 */
require_once "../common/data/include.php";

$about = array(
    'en' => array(
        '1001' => 'BitUP Ltd，专业的数字资产管理和投资平台。',
        '1002' => 'BitUP Ltd是专门从事数字资产配置和交易的金融科技企业，我们通过算法和产品搭建数据模型，辅助投资专家提供理财顾问服务。我公司致力于提供专业的数字资产组合产品，采取科学有效的数字资产配置方式，帮助各层次的投资者进入数字资产领域，妥善管理好各种各样的数字资产，一方面分散单个数字资产的投资风险，另一方面提高数字资产的整体收益。',
        '1003' => 'BitUP Ltd的宗旨是，让每个人都成为数字资产的投资专家。',
        '1004' => '本平台涉及的投资产品统称数字资产组合，简称DAC（Digital Assets Combination）。'
    ),
    'cn' => array(
        '1001' => 'BitUP Ltd，专业的数字资产管理和投资平台。',
        '1002' => 'BitUP Ltd是专门从事数字资产配置和交易的金融科技企业，我们通过算法和产品搭建数据模型，辅助投资专家提供理财顾问服务。我公司致力于提供专业的数字资产组合产品，采取科学有效的数字资产配置方式，帮助各层次的投资者进入数字资产领域，妥善管理好各种各样的数字资产，一方面分散单个数字资产的投资风险，另一方面提高数字资产的整体收益。',
        '1003' => 'BitUP Ltd的宗旨是，让每个人都成为数字资产的投资专家。',
        '1004' => '本平台涉及的投资产品统称数字资产组合，简称DAC（Digital Assets Combination）。'
    )
);
$l = $_COOKIE['BT_LANG'];
$_About = $about[$l];

$curr_page_id = 2;
$title = '数字资产管理平台 | Digital Asset Investment Platform | BitUP About';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
</head>
<body>

<?php include_once '../common/tpl/header.php'; ?>

<div class="guide-main common-container other-page-main">
    <ul class="menu-slide">
        <li class="current">
            <a href="/about/" class="title"><span><?php echo $_Lang['100025']; ?></span></a>
        </li>
        <li>
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
        <h3 class="title"><?php echo $_Lang['100025']; ?></h3>
        <p><?php echo $_About['1001']; ?></p>
        <p><?php echo $_About['1002']; ?></p>
        <p><?php echo $_About['1003']; ?></p>
        <p><?php echo $_About['1004']; ?></p>
        <p style="margin-top: 40px;width:100%;max-width: 433px;"><img src="/common/images/aboutUs-pic.png" style="max-width: 100%;" alt=""></p>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>
</body>
</html>