<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 下午3:21
 */
?>

<hr>
<!--<a href="/index.php" class="--><?php //echo $curr_page_id==1 ? 'on' : ''; ?><!--">首页</a>-->
<!--<a href="/dac/" class="--><?php //echo $curr_page_id==2 ? 'on' : ''; ?><!--">数字资产组合</a>-->
<!--<a href="/quotation/" class="--><?php //echo $curr_page_id==3 ? 'on' : ''; ?><!--">行情走势</a>-->
<a href="/login/" class="<?php echo $curr_page_id==1 ? 'on' : ''; ?>">首页</a>
<a href="#" class="<?php echo $curr_page_id==2 ? 'on' : ''; ?>">数字资产组合</a>
<a href="#" class="<?php echo $curr_page_id==3 ? 'on' : ''; ?>">行情走势</a>