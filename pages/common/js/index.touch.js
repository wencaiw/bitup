/**
 * Created by Hajay on 2018/3/21.
 */

$(function(){
    var T = {
        pageWidth: $(document.body).width(),
        maxPage: $('.banner_list .b_con').length, //最大banner数
        currPage: 1,
        moveWidth: 0,
        //moveObj: document.querySelector('#move_obj'),   //动画对象
        moveObj: $('#move_obj'),                      //JQ下动画对象
        pointList: $('#banner_slide i'),                //对应点列表
        touchEvent: function(){
            var _this = this;
            var startX,startY;
            var isMove = false; //是否发生左右滑动
            var direction = 'left';

            _this.moveObj.on("touchstart",function(e){
                //e.preventDefault();

                var touch = e.touches[0];
                isMove = false;
                startX = touch.pageX;
                startY = touch.pageY;
                clearInterval(_this.timer);
            });

            _this.moveObj.on("touchmove",function(e){
                //e.preventDefault();

                var touch = e.touches[0];
                var deltaX = touch.pageX - startX;
                var deltaY = touch.pageY - startY;
                if (Math.abs(deltaX) - Math.abs(deltaY) > 30){
                    isMove = true;
                    e.preventDefault();
                }
                direction = (deltaX>0 ? 'right' : 'left');

            });

            _this.moveObj.on("touchend",function(e){
                if(isMove){
                    e.preventDefault();
                }
                if(isMove){
                    if(direction == 'right'){
                        if(_this.currPage > 1){
                            _this.currPage --;
                            _this.moveWidth -= _this.pageWidth;
                        }
                    }else{
                        if(_this.currPage < _this.maxPage){
                            _this.currPage ++;
                            _this.moveWidth += _this.pageWidth;
                        }
                    }
                    _this.choosePage();
                    _this.timerFun();
                }
            });
        },
        choosePage: function(){
            this.moveObj.css({
                'transform': 'translate3d(-' + this.moveWidth + 'px,0,0)',
                '-webkit-transform': 'translate3d(-' + this.moveWidth + 'px,0,0)',
                '-moz-transform': 'translate3d(-' + this.moveWidth + 'px,0,0)',
                '-ms-transform': 'translate3d(-' + this.moveWidth + 'px,0,0)',
                '-o-transform': 'translate3d(-' + this.moveWidth + 'px,0,0)'
            });
            this.pointList.removeClass('on');
            this.pointList.eq(this.currPage-1).addClass('on');
        },
        timerFun: function(){
            var _this = this;
            _this.timer = setInterval(function(){
                if(_this.currPage >= _this.maxPage){
                    _this.currPage = 1;
                    _this.moveWidth = 0;
                }else{
                    _this.currPage ++;
                    _this.moveWidth += _this.pageWidth;
                }
                _this.choosePage();
            }, 5000);
        },
        init: function(){
            var _this = this;
            _this.touchEvent();

            //自动播放
            _this.timerFun();

            //鼠标悬停
            _this.moveObj.hover(function(){
                clearInterval(_this.timer);
            },function(){
                _this.timerFun();
            });
            _this.pointList.each(function(index){
                $(this).click(function () {
                    clearInterval(_this.timer);
                    _this.currPage = index + 1;
                    _this.moveWidth = _this.pageWidth * index;
                    _this.choosePage();
                    _this.timerFun();
                })
            });
        }
    };

   T.init();
});
