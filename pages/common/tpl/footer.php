<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/29
 * Time: 下午1:49
 */
?>
<div class="footer">
    <div class="common-container">
        <div class="nav">
            <ul>
                <li>
                    <h4><?php echo $_Lang['100025']; ?></h4>
                    <ul>
                        <li><a href="/about/"><?php echo $_Lang['130049']; ?></a></li>
                        <!--<li><a>{{'130050' | translate}}</a></li>-->
                        <li><a href="/about/but.php">BitUP Token(BUT)</a></li>
                    </ul>
                </li>
                <!--<li>
                    <h4>{{'130051' | translate}}</h4>
                    <ul>
                        <li><a>{{'100020' | translate}}</a></li>
                        <li><a>{{'100018' | translate}}</a></li>
                        <li><a>{{'130052' | translate}}</a></li>
                    </ul>
                </li>-->
                <li>
                    <h4><?php echo $_Lang['130053']; ?></h4>
                    <ul>
                        <li><a href="/funds/index"><?php echo $_Lang['100399']; ?></a></li>
                        <li><a href="/88btc/"><?php echo $_Lang['100249']; ?></a></li>
                        <!--<li><a>{{'130054' | translate}}</a></li>-->
                    </ul>
                </li>
                <li>
                    <h4><?php echo $_Lang['130055']; ?></h4>
                    <ul>
                        <li><a href="/tos/"><?php echo $_Lang['100027']; ?></a></li>
                        <li><a href="/disclaimer/"><?php echo $_Lang['100028']; ?></a></li>
                        <li><a href="/notice/"><?php echo $_Lang['100215']; ?></a></li>
                    </ul>
                </li>
                <li class="footer_share_main">
                    <h4><?php echo $_Lang['100029']; ?></h4>
                    <ul class="share_list">
                        <li class="item">
                            <a href="https://t.me/bitupofficial" target="_blank">
                                <img src="/common/images/share/telegram.png" class="icon" alt="">
                            </a>
                        </li>
                        <li class="item">
                            <a href="https://twitter.com/bitupofficial" target="_blank">
                                <img src="/common/images/share/twitter.png" class="icon" alt="">
                            </a>
                        </li>
                        <li class="item">
                            <a href="https://www.facebook.com/bitupofficial" target="_blank">
                                <img src="/common/images/share/facebook.png" class="icon" alt="">
                            </a>
                        </li>
                        <li class="item">
                            <img src="/common/images/share/wechat.png" class="icon" alt="">
                            <div class="other_box"><p class="ng-binding"><?php echo $_Lang['100357']; ?></p></div>
                        </li>
                        <li class="item">
                            <img src="/common/images/share/gongzhonghao.png" class="icon" alt="">
                            <div class="other_box">
                                <img src="/common/images/wx-group.jpg" width="100%">
                                <p class="ng-binding"><?php echo $_Lang['100358']; ?></p>
                            </div>
                        </li>
                        <li class="item">
                            <a href="//shang.qq.com/wpa/qunwpa?idkey=299396b5d0a6ef5a3496e184361c7aa5ed335d2bfae51c0d3764ced5f68047ab" target="_blank">
                                <img src="/common/images/share/qq.png" class="icon" alt="">
                            </a>
                        </li>
                    </ul>
                    <a href="mailto:support@bitup.com" class="email" target="_blank"><?php echo $_Lang['130056']; ?>: support@bitup.com</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="copyright-box">
        <span>©2018 BitUP <?php echo $_Lang['100030']; ?></span>
    </div>

</div>

<!--<div class="footer">-->
<!--    <div class="common-container">-->
<!--        <div class="nav">-->
<!--            <a href="/about/" target="_blank">--><?php //echo $_Lang['100025']; ?><!--</a>-->
<!--            <a href="/dac/" target="_blank">--><?php //echo $_Lang['100026']; ?><!--</a>-->
<!--            <a href="/tos/" target="_blank">--><?php //echo $_Lang['100027']; ?><!--</a>-->
<!--            <a href="/disclaimer/" target="_blank">--><?php //echo $_Lang['100028']; ?><!--</a>-->
<!--</div>-->
<!--<p>--><?php //echo $_Lang['100029']; ?><!--：support@bitup.com</p>-->
<!--<div class="copyright-box clearfix">-->
<!--    <span class="fl">©BitUP --><?php //echo $_Lang['100030']; ?><!--</span>-->
<!--    <span class="fr">--><?php //echo $_Lang['100031']; ?><!--</span>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        //退出
        $('#logout, #logout2').click(function(){
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
        //展开、收起
        $('.footer .nav li h4').click(function(){
            var isHave = $(this).parent().hasClass('open');
            $(this).parent().toggleClass('open', !isHave);
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

        //移动端菜单
        $(".menu-icon").click(function(){
            $(".home-menu").slideToggle();
            $(".home-menu-wrap").slideToggle();
        });
        $(".home-menu-wrap").click(function(){
            $(".home-menu").slideToggle();
            $(".home-menu-wrap").slideToggle();
        });
    });
</script>
<!--<div style=" display:none;"><script src="https://s22.cnzz.com/z_stat.php?id=1273493484&web_id=1273493484" language="JavaScript"></script><div>-->