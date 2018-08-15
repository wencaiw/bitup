
$(function(){
    //菜单导航
    setMenu();
    function setMenu(){
        if($(".menu-slide-long").height()>0){
            var swiper = new Swiper('.menu-slide-long', {
                slidesPerView: 'auto',
                spaceBetween: 0
            });
        }
    }
    window.onresize = function(){
        window.location.reload();
    }
    $(".menu-slide > li > .title").click(function(){
        //if($(".menu-slide-long").height()>0){
        //    console.log($(".menu-slide-long").height());
        //    var left = $(this).offset().left;
        //    var width = this.clientWidth;
        //    console.log(left);
        //    console.log(width);
        //    $(this).next(".sub-menu").css({
        //        left:left+"px"
        //    }).appendTo($(".menu-slide-long"));
        //}
        $(this).parent().toggleClass("current").siblings("li").removeClass("current");
        if(!$(this).parent().hasClass("current")){
            //$(".menu-slide-long > .sub-menu").appendTo($(this).parent());
        }
    });
    $(".menu-slide .sub-menu > a").click(function(){
        $(this).addClass("current").siblings("a").removeClass("current");
        var _index = $(".menu-slide .sub-menu > a").index($(this));
        $(".guide-main .content-panel").hide();
        $(".guide-main .content-panel").eq(_index).show();
    });

    var contentId = window.location.hash.substr(1).replace("?","");
    if(!contentId || $(".guide-main .content-panel#" + contentId).length == 0){
        $(".guide-main .content-panel:eq(0)").show();
        $(".menu-slide > li:eq(0)").addClass("current").find(".sub-menu a:eq(0)").addClass("current");
    }
    else {
        var oneMenu = contentId.split("-")[0] - 1;
        var subMenu = contentId.split("-")[1] - 1;
        $(".guide-main .content-panel#" + contentId).show();
        $(".menu-slide > li").eq(oneMenu).addClass("current").find(".sub-menu a").eq(subMenu).addClass("current");
    }

});