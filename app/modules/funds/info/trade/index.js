/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/trade/:tradeType',
    views: {
        'passive': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$translate', '$stateParams', '$interval', '$filter', 'usdRatio', function($scope, $location, $http, $cookies, $state, $, $translate, $stateParams, $interval, $filter, usdRatio){

                $scope.info = {
                    islogin  : $scope.g.isLogin, //是否登录
                    type:$stateParams.tradeType,//0=申购，1=赎回
                    sucTip:false,//弹窗
                    choice:'BTC',//选择币种
                    fee:'BTC',//扣除手续费币种
                    switchControl:false,//是否开启BUT支付管理费
                    disabled:true,
                    buyDataDone:false,//数据是否已经加载完毕
                    sellDataDone:false,//数据是否已经加载完毕
                    buyNum:'',//申购数量
                    sellNum:'',//赎回数量
                    save:0,//节省手续费数量
                    minBuy:0,//起投金额
                    minSell:0,//最小赎回份额
                    init:function () {
                        this.getFundInfo();
                        usdRatio.get().then(function(usdRatio){//汇率
                            if(!!$scope.publicData.fundInfo){
                                $scope.info.minBuy = $scope.publicData.fundInfo.dac_trade_limit.min_buy_amount / usdRatio.data[($scope.info.choice).toLocaleUpperCase()].usd_ratio;//起投额度（USDT数量 / 当前币种对USDT汇率）
                                $scope.info.minSell = $scope.publicData.fundInfo.dac_trade_limit.min_sell_amount;
                                /*if(!!$scope.publicData.fundInfo.dac_trade_limit.min_sell_amount){
                                 $scope.info.minSell = $scope.publicData.fundInfo.dac_trade_limit.min_sell_amount / usdRatio.data[($scope.info.choice).toLocaleUpperCase()].usd_ratio;
                                 }*/
                            }
                            if(!!$scope.publicData.userFunds){
                                $scope.info.buyDataDone = true;
                            }
                        });
                    },
                    goBack:function () {
                        window.history.back();
                    },
                    switch:function (n) {
                        this.choice = n;
                        this.minBuy = $scope.publicData.fundInfo.dac_trade_limit.min_buy_amount / usdRatio.data[(this.choice).toLocaleUpperCase()].usd_ratio;//起投额度（USDT数量 / 当前币种对USDT汇率）
                    },
                    allSell:function () {
                        this.sellNum = this.data.user_sellable_amount;
                    },
                    allBuy:function () {
                        this.buyNum = $scope.publicData.userFunds.balances[(this.choice).toLocaleLowerCase()].free;
                    },
                    getFundInfo:function () {
                        var _this = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data:{
                                dac_id: $scope.publicData.currDacId
                            },
                            url: 'app/modules/funds/info/data/get.trade.pre.info.php',
                            success: function(res){
                                if(res.data.resultCode==0){
                                    _this.data = res.data.data;
                                    $scope.info.sellDataDone = true;
                                }
                            }
                        },$scope);
                    },
                    send:function () {
                        if(this.type == 0){//申购请求
                            this.buy();
                        }
                        else if (this.type == 1){//赎回请求
                            this.sell();
                        }
                    },
                    buy:function () {
                        if(this.buyNum<=0){//不能低于0
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300012')+'0');
                            return false;
                        }
                        if(this.buyNum<this.minBuy){//不能低与起投金额
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300012') + $filter('coinNum')(this.minBuy,this.choice) + this.choice);
                            return false;
                        }
                        if(this.buyNum>$scope.publicData.userFunds.balances[(this.choice).toLocaleLowerCase()].free){//不能高于对应币种余额
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300014'));
                            return false;
                        }
                        if(this.buyNum>this.data.dac_left_on_usdt){//不能高于可投额度
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300016'));
                            return false;
                        }

                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data:{
                                dac_id: $scope.publicData.currDacId,//dac_id
                                amount: $scope.info.buyNum,
                                currency: $scope.info.choice
                            },
                            url: 'app/modules/funds/info/data/unfixed.fund.buy.php',
                            success: function(res){
                                if(res.data.resultCode==0){
                                    $scope.publicData.getUserInfo();//更新用户余额信息
                                    $scope.info.getFundInfo();
                                    $scope.info.sucTip=true;//成功弹窗
                                    $scope.info.buyNum='';
                                    $scope.info.sellNum='';
                                }
                            }
                        },$scope);
                    },
                    sell:function () {
                        if(this.sellNum<=0.00000001){//不能低于0
                            $scope.g.tip($translate.instant('300017'), $translate.instant('300018'));
                            return false;
                        }
                        if(!!this.minSell && this.sellNum<this.minSell){//不能小于最小赎回份额
                            $scope.g.tip($translate.instant('300017'), $translate.instant('300018'));
                            return false;
                        }
                        if(!!this.data.user_sellable_amount && this.sellNum>this.data.user_sellable_amount){//不能大于可赎回份额
                            $scope.g.tip($translate.instant('300017'), $translate.instant('300018'));
                            return false;
                        }
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data:{
                                dac_id: $scope.publicData.currDacId,//dac_id
                                amount: $scope.info.sellNum,
                                sell_currency: $scope.info.choice,
                                fee_currency: $scope.info.choice
                            },
                            url: 'app/modules/funds/info/data/unfixed.fund.sell.php',
                            success: function(res){
                                if(res.data.resultCode==0){
                                    $scope.publicData.getUserInfo();
                                    $scope.info.getFundInfo();
                                    $scope.info.sucTip=true;
                                    $scope.info.buyNum='';
                                    $scope.info.sellNum='';
                                }
                            }
                        },$scope);
                    }
                };

                $scope.$watch('info.sellNum',function (newVal) {//监听赎回数量
                    if($scope.info.data){
                        $scope.info.save = newVal * 0.014 * $scope.info.data.dac_price_on_usdt;
                    }else {
                        $scope.info.save = 0;
                    }

                });
                /*$scope.$watch('info.switchControl',function (newVal) {//监听手续费使用BUT支付开关
                 if(newVal===false){
                 $scope.info.fee = $scope.info.choice;
                 }else{
                 $scope.info.fee = 'but';
                 }
                 },true);*/

                $scope.info.init();//页面初始化

                $scope.interval = $interval(function () {//轮询
                    $scope.info.getFundInfo();
                },1000*60*2);

                $scope.$on("$destroy", function() {//销毁定时器
                    if (angular.isDefined($scope.interval)) {
                        $interval.cancel($scope.interval);
                        $scope.interval = undefined;
                    }
                });

            }]
        }
    },
    resolve: {
        "trade": ['$ocLazyLoad', function ($ocLazyLoad) {
            // you can lazy load files for an existing module
            return $ocLazyLoad.load({
                name: 'trade',
                serie: true,
                files: [
                    '/app/modules/funds/info/trade/index.css?v=2018063001',
                ]
            });
        }]
    }
};