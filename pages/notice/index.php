<?php
/**
 * Created by PhpStorm.
 * User: Wangyao
 * Date: 2018/4/2
 * Time: 上午9:57
 */
require_once "../common/data/include.php";

$notice = array(
    'en' => array(
        '1001' => 'All BUT investors:',
        '1002' => 'The contract address of BUT is 0xb2e260f12406c401874ecc960893c0f74cd6afcd.<br />
The total Team Supply is 20%. And 1/4 of Team Supply will be released after every 6 months. <br />
Please use variables ‘teamSupply6Month’, ‘teamSupply12month’, ‘teamSupply18Month’ and ‘teamSupply24Month’ to trace the Team Supply. The variable ‘teamSupply’ won’t change when Team Supply is released. Please pay attention to this!'
    ),
    'cn' => array(
        '1001' => '各位BUT的投资者敬启：',
        '1002' => 'BUT的智能合约地址为0xb2e260f12406c401874ecc960893c0f74cd6afcd。<br />其中团队(team)的份额为20%，每6个月成熟1/4。<br />请各位投资者使用teamSupply6Month, teamSupply12Month, teamSupply18Month, teamSupply24Month这四个变量来跟踪团队的份额。teamSupply这个变量并不会随着团队份额成熟而更新，敬请知晓！'
    )
);
$l = $_COOKIE['BT_LANG'];
$_Notice = $notice[$l];
$title = 'Notice for Investor';
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
            <a href="/notice/" class="title"><span><?php echo $_Lang['100206']; ?></span></a>
        </li>
    </ul>
    <div class="content-panel">
        <h3 class="title"><?php echo $_Lang['100206']; ?></h3>
        <p><?php echo $_Notice['1001']; ?></p>
        <p style="line-height:2.4;margin-top: 15px;"><?php echo $_Notice['1002']; ?></p>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>
</body>
</html>