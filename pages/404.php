<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/2
 * Time: 下午2:58
 */
require_once "common/data/include.php";

$error = array(
    'en' => array(
        '1001' => 'Page Not Found!',
        '1002' => 'you may have mistyped the address or the page may have moved.',
        '1003' => 'Refresh',
        '1004' => 'Back'
    ),
    'cn' => array(
        '1001' => '哎呀！出错了！',
        '1002' => '您可能输入了错误的地址或网页可能已不存在。',
        '1003' => '刷新',
        '1004' => '返回'
    )
);
$l = $_COOKIE['BT_LANG'];
$_Error = $error[$l];

$curr_page_id = 1;
$title = 'BitUP Index';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BitUP</title>
    <style>
        html{height: 100%;min-height: 460px;}
        body{height: 100%;position: relative;}
        body,p,ul{margin:0;font-family: "PingFang SC", Helvetica, "Microsoft Yahei", Arial, sans-serif;font-weight:200;}
        .main{
            width: 980px;margin:0 auto;text-align: center;
            position: absolute;top:50%;left:50%; margin:-180px 0 0 -490px;
        }
        .top{
            height:221px;
            background: url("/common/images/img-404.png") center bottom no-repeat;
            border-bottom: 1px solid #ccc;
            position: relative;font-size: 39px;color: #000;padding-bottom: 20px;
            margin-bottom: 32px;
        }
        .top .text{
            position: absolute;
            bottom: 20px;
            left: 0;
            text-align: center;
            font-family: PingFangSC-Semibold;
            font-size: 39px;
            color: #000000;
            right: 0;
        }
        .p1{
            margin-top: 40px;
            font-size: 18px;
        }
        .p1 .icon{
            width: 24px;
            height: 24px;
            -webkit-background-size:100% 100%;
            background-size:100% 100%;
        }
        .p1 .icon.refresh{
            background: url("/common/images/icon-refresh-404.png") 0 0 no-repeat;
        }
        .p1 .icon.back{
            background: url("/common/images/icon-back-404.png") 0 0 no-repeat;
        }
        .p1 img{
            width: 24px;
        }
        .p1 *{vertical-align: middle;}
        .p1 span{margin-left: 8px;}
        a{text-decoration: none;color: #888888}
    </style>
</head>
<body>
    <div class="main">
        <div class="top">
            <p class="text"><?php echo $_Error['1001']; ?></p>
        </div>
        <p style="font-size: 16px;color:#888;text-align: center;"><?php echo $_Error['1002']; ?></p>
        <p class="p1">
            <a href="javascript:history.back(-1);" style="margin-right: 70px;color:#FF6C2B;"><img src="/common/images/icon-refresh-404.png" alt=""><span><?php echo $_Error['1003']; ?></span></a>
            <a href="javascript:history.back(-1);"><img src="/common/images/icon-back-404.png" alt=""><span><?php echo $_Error['1004']; ?></span></a>
        </p>
    </div>
<script type="text/javascript">
    setTimeout(function(){
        window.location.href = "/";
    },5000);
</script>
</body>
</html>