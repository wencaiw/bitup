/**
 * Created by Hajay on 2018/3/11.
 */
$(function(){
    var banner_slide_on = 0,
        banner_slide_max = 2,
        banner_slide_time = 500,
        timer = null;
    function move(id, cls, index, banner_on){
        $(cls + " .b_con").eq(index).css({"opacity": 1, "display": "block"});
        $(cls + " .b_con").eq(banner_on).animate({"opacity": 0}, banner_slide_time);
        $(id + " i").eq(banner_on).removeClass("on");
        $(id + " i").eq(banner_on).animate({"opacity": 0.3}, banner_slide_time);
        $(id + " i").eq(index).addClass("on").animate({"opacity": 1}, banner_slide_time);
        setTimeout(function(){
            $(cls + " .b_con").eq(banner_on).css({"z-index": 10});
            $(cls + " .b_con").eq(index).css({"z-index": 11});
            //banner_on = index;
        }, banner_slide_time);
    }

    //banner slide
    $("#banner_slide i").each(function(index){
        $(this).click(function(){
            if(index != banner_slide_on){
                move("#banner_slide", ".banner", index, banner_slide_on);
                setTimeout(function(){
                    banner_slide_on = index;
                }, banner_slide_time);
            }
        })
    });
    auto_move("#banner_slide", ".banner");
    $(".banner").hover(function(){
        clearInterval(timer);
    },function(){
        auto_move("#banner_slide", ".banner");
    });

    function auto_move(id, cls){
        timer = setInterval(function(){
            var curr_banner = banner_slide_on;
            if((banner_slide_on+1) == banner_slide_max){
                curr_banner = 0;
            }else{
                curr_banner = banner_slide_on+1;
            }
            //console.log(curr_banner);
            move(id, cls, curr_banner, banner_slide_on);
            setTimeout(function(){
                banner_slide_on = curr_banner;
            }, banner_slide_time);
        }, 5000);
    }

});
