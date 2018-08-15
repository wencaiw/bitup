<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 下午3:26
 */

?>
<div class="header">
    <div class="fast-enter" style="text-align: right;">
        <div class="common-container clearfix">
            <div class="fl">
                <!--                <span style="margin-right: 15px;">--><?php //echo $_Lang['100023']; ?><!--,</span>-->
                <?php if(!BTSession::isValid()){ ?>
                    <a href="/login/"><span class="color-base">[<?php echo $_Lang['100001']; ?>]</span></a>&emsp;&emsp;&emsp;
                    <a href="/register/"><span class="color-base">[<?php echo $_Lang['100002']; ?>]</span></a>
                <?php }else{
                    echo $_Lang['100023']; ?>,
                    <a href="/dashboard/" class="color-base"><?php echo $_SESSION["account"]; ?></a>&emsp;&emsp;
                    <a id="logout" href="javascript:;"><span class="color-base">[<?php echo $_Lang['100024']; ?>]</span></a>
                <?php } ?>
            </div>
            <ul class="dib">
                <!-- <li><i class="common-icon icon-home"></i><a href="/"><?php echo $_Lang['100016']; ?></a></li> -->
<!--                <li class="coming-soon" text="--><?php //echo $_Lang['100198']; ?><!--"><i class="common-icon icon-guide"></i><a href="javascript:;" data-href="/guide/">--><?php //echo $_Lang['100017']; ?><!--</a></li>-->
                <li><i class="common-icon icon-faq"></i><a href="https://bitup.zendesk.com/hc/zh-cn" target="_blank"><?php echo $_Lang['100018']; ?></a></li>
                <li id="lang"><a style="cursor: pointer;"><?php echo $_Lang['100019']; ?></a><i class="common-icon icon-arrow-right"></i></li>
                <li class="coming-soon" text="<?php echo $_Lang['100198']; ?>"><i class="common-icon icon-phone"></i><a href="javascript:;" class="download_link"><?php echo $_Lang['100020']; ?></a></li>
            </ul>
        </div>
    </div>
    <div class="logo-container common-container clearfix">
        <a href="/" class="logo-coral">
            <img style="height: 40px;" src="/common/images/logo-g.png?v=2">
        </a>
        <div class="home-menu-wrap" style="display: none;"></div>
        <div class="home-menu mobile_hide">
            <a href="/" class="<?php echo $curr_page_id == 1 ? 'current' : ''; ?>"><?php echo $_Lang['100016']; ?></a>
            <a href="/funds/index"><?php echo $_Lang['100208'] ?></a>
            <a href="/index/bp10"><?php echo $_Lang['100209']; ?></a>
<!--            <a href="/88btc/">--><?php //echo $_Lang['100207']; ?><!--</a>-->
<!--            <a href="javascript:;" data-href="/about" class="soon --><?php //echo $curr_page_id == 2 ? 'current' : ''; ?><!--" text="--><?php //echo $_Lang['100198']; ?><!--">--><?php //echo $_Lang['100025']; ?><!--</a>-->
            <!-- <a href="/download/<?php echo $l=='en' ? 'bitup_whitepaper_en' : 'bitup_whitepaper_cn'; ?>.pdf" target="_blank" class="<?php echo $curr_page_id == 3 ? 'current' : ''; ?>"><?php echo $_Lang['100183']; ?></a> -->
            <!-- <a href="javascript:;" data-href="/dac" class="coming-soon <?php echo $curr_page_id == 4 ? 'current' : ''; ?>" text="<?php echo $_Lang['100198']; ?>"><?php echo $_Lang['100026']; ?></a> -->
            <?php if(!BTSession::isValid()){ ?>
                <a href="/login" class="mobile"><?php echo $_Lang['100001']; ?></a>
                <a href="/register" class="mobile"><?php echo $_Lang['100002']; ?></a>
                <a href="/login/" class="my-account islogin-mobile"><span><?php echo $_Lang['100205']; ?></span></a>
            <?php }else{ ?>
                <!-- <span class="mobile"><?php echo $_Lang["100023"]; ?>,</span> -->
                <a href="/dashboard/" class="mobile"><?php echo $_SESSION["account"]; ?></a>
                <a id="logout2" href="javascript:;" class="mobile"><span class="color-base"><?php echo $_Lang['100024']; ?></span></a>
                <a class="my-account islogin-mobile islogin">
                    <i class="common-icon icon-account"></i><span><?php echo $_SESSION["account"]; ?></span>
                    <object class="nav-top-list">
                        <ul>
                            <li><a href="/dashboard/assets"><?php echo $_Lang['130057']; ?></a></li>
                            <li><a href="/dashboard/user/candy"><?php echo $_Lang['130058']; ?></a></li>
                            <li><a href="/dashboard/user/auth"><?php echo $_Lang['130059']; ?></a></li>
                            <li><a href="/dashboard/user/pwd"><?php echo $_Lang['130060']; ?></a></li>
                            <li><a href="/dashboard/user/2fa"><?php echo $_Lang['130061']; ?></a></li>
                            <li><a id="logout" href="javascript:;"><?php echo $_Lang['100024']; ?></a></li>
                        </ul>
                    </object>
                </a>
            <?php } ?>
        </div>
<!--        <div class="home-menu">-->
<!--            --><?php //if(!BTSession::isValid()){ ?>
<!--                <a href="/login/" class="my-account"><span>--><?php //echo $_Lang['100205']; ?><!--</span></a>-->
<!--            --><?php //}else{ ?>
<!--                <a href="/dashboard/" class="my-account islogin-mobile islogin">-->
<!--                    <i class="common-icon icon-account"></i><span>--><?php //echo $_SESSION["account"]; ?><!--</span>-->
<!--                    <object class="nav-top-list">-->
<!--                        <ul>-->
<!--                            <li><a href="/dashboard/#/assets">--><?php //echo $_Lang['130057']; ?><!--</a></li>-->
<!--                            <li><a href="/dashboard/#/user/candy">--><?php //echo $_Lang['130058']; ?><!--</a></li>-->
<!--                            <li><a href="/dashboard/#/user/auth">--><?php //echo $_Lang['130059']; ?><!--</a></li>-->
<!--                            <li><a href="/dashboard/#/user/pwd">--><?php //echo $_Lang['130060']; ?><!--</a></li>-->
<!--                            <li><a href="/dashboard/#/user/2fa">--><?php //echo $_Lang['130061']; ?><!--</a></li>-->
<!--                            <li><a href="javascript:;" ng-click="g.logout()">--><?php //echo $_Lang['130062']; ?><!--</a></li>-->
<!--                        </ul>-->
<!--                    </object>-->
<!--                </a>-->
<!--            --><?php //} ?>
<!--        </div>-->
        <button class="menu-icon"><i></i><i></i><i></i></button>
        
    </div>
</div>