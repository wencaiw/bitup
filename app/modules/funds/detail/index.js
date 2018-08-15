/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/bbb/:type/:dac_id/detail',   //定期:fixed    活期:flexible
    views: {
        'funds': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$translate', '$stateParams', '$interval', 'math', function($scope, $location, $http, $cookies, $state, $, $translate, $stateParams, $interval, math){

                $scope.g.currPage = 'funds';
                $scope.info = {
                    proType  : $stateParams.type,
                    islogin  : $scope.g.isLogin, //是否登录
                    tabActive: 0,    //tab切换
                    dkList   : [],   //抢购数据
                    userFunds: {},   //用户抢购信息
                    dataList : [],
                    isEnd    : false,//没有结束
                    time:[],
                    nowDate  : new Date().getTime(),
                    init: function(){ //加载
                        var self_ = this;
                        self_.getPro();
                        self_.islogin ? self_.getUserInfo() : '';
                        self_.islogin ? self_.getList() : '';
                    },
                    getPro: function(){ //获取产品信息
                        var self_ = this;
                        var dataParams = angular.copy($stateParams);
                        dataParams.type = ($stateParams.type == 'fixed' ? 1 : 2);
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: dataParams,
                            url: 'app/modules/funds/data/fund.info.php',
                            success: function(res){
                                self_.dataList[0] = res.data.data;
                            }
                        },$scope);
                    },
                    getList: function(){//抢购数据
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: $stateParams,
                            url: 'app/modules/funds/data/user.fund.buy.list.php',
                            success: function(res){
                                self_.dkList = res.data.data || [];
                            }
                        },$scope);
                    },
                    getUserInfo: function(){ //获取用户的信息
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: $stateParams,
                            url: 'app/modules/funds/data/user.funds.php',
                            success: function(res){
                                self_.userFunds = res.data.data;
                            }
                        },$scope);
                    },
                    buy: function(){ //购买
                        var self_ = this;
                        if(!self_.islogin) window.location.href = '/login/';
                        var pro = self_.dataList[0].dac_trade_limit;
                        //判断所持有的BUT
                        if((self_.userFunds.balances['but'].free + self_.userFunds.balances['but'].frozen) < pro.but_balance_limit){
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300015') + pro.but_balance_limit);
                            return;
                        }
                        //判断余额
                        if((self_.amount || 0) > self_.userFunds.balances[self_.dataList[0].base_currency].free){
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300014'));
                            return;
                        }
                        //判断 不能超过剩余可参与额度
                        var num = self_.dataList[0].base_currency=='btc' ? 100000000 : 100;
                        if(self_.proType == 'fixed' && (self_.amount || 0) > (pro.capacity*num - self_.dataList[0].dac_sold_amount*num)/num){
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300016'));
                            return;
                        }
                        if((self_.userFunds.user_buy_amount <= 0 && $stateParams.type == "fixed") || $stateParams.type == "flexible"){
                            //最小区间
                            if(pro.min_buy_amount>0 && (self_.amount || 0) < pro.min_buy_amount){
                                $scope.g.tip($translate.instant('300011'), $translate.instant('300012') + pro.min_buy_amount + self_.dataList[0].base_currency);
                                return;
                            }
                            //最大区间
                            if(pro.max_buy_amount>0 && (self_.amount || 0) > pro.max_buy_amount){
                                $scope.g.tip($translate.instant('300011'), $translate.instant('300013') + pro.max_buy_amount + self_.dataList[0].base_currency);
                                return;
                            }
                        }
                        self_.loading = true;
                        $.ajax({
                            loading: 2,
                            method: 'post',
                            data: {
                                fund_type: $stateParams.type,
                                amount: self_.amount,
                                dac_id: $stateParams.dac_id
                            },
                            url: 'app/modules/funds/data/fund.buy.php',
                            success: function(res){
                                var obj_ = {
                                    start_time: self_.timestampToTime(self_.dataList[0].start_time),
                                    end_time  : self_.timestampToTime(self_.dataList[0].end_time)
                                };
                                var date_ = new Date();
                                var status = self_.dataList[0].dac_trade_limit.cancellable_interval == 0 ? 1 : 0;

                                if(self_.proType == 'flexible'){//活期计息时间 当前时间+可撤销时间
                                    obj_.start_time = self_.timestampToTime(math.f(date_.getTime(), self_.dataList[0].dac_trade_limit.cancellable_interval, '+'));
                                }
                                $scope.g.tip($translate.instant('300011'), $translate.instant((self_.proType == 'flexible' ? '300020' : '300019'), obj_));
                                self_.dkList.splice(0, 0, {
                                    type: 0,
                                    id: res.data.data.dac_order_id,
                                    status: status,
                                    created_at: date_.getTime() - 1000,
                                    success_time: date_.getTime(),
                                    trade_currency_amount: self_.amount,
                                    trade_currency: self_.dataList[0].base_currency
                                });
                                //改变数据
                                
                                self_.userFunds.balances[self_.dataList[0].base_currency].free = math.f(self_.userFunds.balances[self_.dataList[0].base_currency].free, self_.amount, '-');
                                self_.dataList[0].dac_sold_amount = math.f(self_.dataList[0].dac_sold_amount, self_.amount, '+');
                                if(self_.proType == 'fixed'){
                                    self_.dataList[0].dac_buyer_number = (self_.userFunds.user_buy_amount > 0 ? self_.dataList[0].dac_buyer_number : self_.dataList[0].dac_buyer_number+1);
                                    self_.userFunds.user_buy_amount = math.f(self_.userFunds.user_buy_amount, self_.amount, '+');
                                    self_.userFunds.user_total_profit = math.f(self_.userFunds.user_total_profit, res.data.data.profit, '+');
                                }
                                if(self_.proType == 'flexible' && self_.dataList[0].dac_trade_limit.cancellable_interval == 0){
                                    self_.userFunds.user_possess_amount = math.f(self_.userFunds.user_possess_amount,self_.amount,'+');
                                }
                                if(!!$scope.g.info){
                                    $scope.g.info.coin_list[self_.dataList[0].base_currency.toUpperCase()].free = self_.userFunds.balances[self_.dataList[0].base_currency].free;
                                }
                                self_.amount = '';
                            }
                        },$scope);
                    },
                    redeemFun: function(){ //赎回
                        var self_ = this;
                        if(!self_.islogin) window.location.href = '/login/';
                        var pro = self_.dataList[0].dac_trade_limit;
                        //最小区间
                        if(pro.min_sell_amount>0 && (self_.redeem || 0) < pro.min_sell_amount){
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300012') + pro.min_sell_amount + self_.dataList[0].base_currency);
                            return;
                        }
                        //最大区间
                        if(pro.max_sell_amount>0 && (self_.redeem || 0) > pro.max_sell_amount){
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300013') + pro.max_sell_amount + self_.dataList[0].base_currency);
                            return;
                        }
                        //判断是否超过可赎回额度
                        if((self_.redeem || 0) > self_.userFunds.user_sellable_amount){
                            $scope.g.tip($translate.instant('300011'), $translate.instant('300013') + self_.userFunds.user_sellable_amount + self_.dataList[0].base_currency);
                            return;
                        }
                        $.ajax({
                            method: 'post',
                            data: {
                                fund_type: $stateParams.type,
                                amount: self_.redeem,
                                dac_id: $stateParams.dac_id
                            },
                            url: 'app/modules/funds/data/fund.sell.php',
                            success: function(res){
                                $scope.g.tip($translate.instant('300011'), $translate.instant('130156'));
                                var date_ = new Date();
                                self_.dkList.splice(0, 0, {
                                    type: 1,
                                    status: 1,
                                    success_time: date_.getTime(),
                                    trade_currency_amount: self_.redeem,
                                    trade_currency: self_.dataList[0].base_currency
                                });
                                //改变数据
                                self_.userFunds.user_possess_amount -= parseFloat(self_.redeem);
                                self_.dataList[0].dac_sold_amount -= parseFloat(self_.redeem);
                                self_.userFunds.balances[self_.dataList[0].base_currency].free += parseFloat(self_.redeem);
                                self_.userFunds.user_sellable_amount -= parseFloat(self_.redeem);
                                self_.redeem = '';
                            }
                        },$scope);
                    },
                    tabClick: function(index_){ //tab切换
                        var self_ = this;
                        self_.tabActive = index_;
                    },
                    timestampToTime: function(timestamp) {
                        var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
                        Y = date.getFullYear() + '-';
                        M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
                        D = date.getDate() + ' ';
                        return Y+M+D;
                    },
                    dataInput: function(type, amount){//申购赎回全部
                        var self_ = this;
                        if(!self_.islogin) return;
                        type == 'apply' ? self_.amount = amount : self_.redeem = amount;
                    },
                    setCancel: function(id, index){//撤销
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                fund_type: $stateParams.type,
                                dac_order_id: id
                            },
                            url: 'app/modules/funds/data/fund.cancel.php',
                            success: function(res){
                                if(self_.proType == 'flexible'){
                                    self_.userFunds.balances[self_.dataList[0].base_currency].free = math.f(self_.userFunds.balances[self_.dataList[0].base_currency].free, self_.dkList[index].trade_currency_amount, '+');
                                    if(self_.dkList[index].status == 1){
                                        self_.userFunds.user_possess_amount = math.f(self_.userFunds.user_possess_amount, self_.dkList[index].trade_currency_amount, '-');
                                    }
                                }
                                self_.dkList[index].status = -1;
                            }
                        },$scope);
                    }
                };
                $scope.info.init();

                $scope.$watch('fundInfo.nowDate', function(newVal, oldVal){
                    if($scope.info.dataList[0]){
                        var item = $scope.info.dataList[0];
                        // 未开始
                        if($scope.fundInfo.nowDate < item.dac_trade_limit.buy_start_time){
                            $scope.info.time[0] = {
                                class_: 'coming',
                                times: $scope.info.proType == 'fixed' ? item.dac_trade_limit.buy_start_time - $scope.fundInfo.nowDate : '',
                                inner: $scope.info.proType == 'flexible' ? 120126 : 130020
                            };
                        }
                        // 开始
                        if($scope.fundInfo.nowDate >= item.dac_trade_limit.buy_start_time){
                            var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                            $scope.info.time[0] = {
                                class_: remaining_amount > 0 ? 'being' : 'coming',
                                times: remaining_amount > 0 ? (item.dac_trade_limit.buy_end_time - $scope.fundInfo.nowDate || '') : '',
                                inner: remaining_amount > 0 ? 130021 : 130012
                            };
                            if($scope.info.proType=='flexible'){//活期
                                $scope.info.time[0].times = '';
                                $scope.info.time[0].inner = $scope.info.time[0].inner == 130021 ? 120139 : $scope.info.time[0].inner;
                            }
                        }
                        if($scope.fundInfo.nowDate >= item.start_time ){

                            if($scope.info.proType=='flexible'){//活期 开放中
                                var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                                $scope.info.time[0] = {
                                    class_: remaining_amount > 0 ? 'being' : 'coming',
                                    times: '',
                                    inner: remaining_amount > 0 ? 120130 : 130012
                                };
                            }else{//定期 计息中
                                $scope.info.time[0] = {
                                    class_: 'coming',
                                    times: '',
                                    inner: 130110
                                };
                            }
                        }
                        // 结束
                        if(!!item.end_time && $scope.fundInfo.nowDate > item.end_time){
                            $scope.info.time[0] = {
                                class_: 'coming',
                                times: '',
                                inner: 130109
                            };
                        }




                        //if($scope.fundInfo.nowDate < item.dac_trade_limit.buy_start_time){// 未开始
                        //    $scope.info.time[0] = {
                        //        class_: 'coming',
                        //        times: item.dac_trade_limit.buy_start_time - $scope.fundInfo.nowDate,
                        //        inner: 130020
                        //    };
                        //    if($scope.info.proType=='flexible'){//活期
                        //        $scope.info.time[0].times = '';
                        //        $scope.info.time[0].inner = 120126;
                        //    }
                        //}else if($scope.fundInfo.nowDate >=item.dac_trade_limit.buy_start_time && $scope.fundInfo.nowDate < item.dac_trade_limit.buy_end_time){// 开始
                        //    var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                        //    $scope.info.time[0] = {
                        //        class_: remaining_amount > 0 ? 'being' : 'coming',
                        //        times: remaining_amount > 0 ? (item.dac_trade_limit.buy_end_time - $scope.fundInfo.nowDate || '') : '',
                        //        inner: remaining_amount > 0 ? 130021 : 130012
                        //    };
                        //    if($scope.info.proType=='flexible'){//活期
                        //        $scope.info.time[0].times = '';
                        //        $scope.info.time[0].inner = $scope.info.time[0].inner == 130021 ? 120139 : $scope.info.time[0].inner;
                        //    }
                        //}else if($scope.fundInfo.nowDate > item.end_time){// 结束
                        //    $scope.info.time[0] = {
                        //        class_: 'coming',
                        //        times: '',
                        //        inner: 130109
                        //    };
                        //}else if($scope.fundInfo.nowDate >= item.start_time && $scope.fundInfo.nowDate < item.end_time){
                        //
                        //    if($scope.info.proType=='flexible'){//活期 开放中
                        //        var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                        //        $scope.info.time[0] = {
                        //            class_: remaining_amount > 0 ? 'being' : 'coming',
                        //            times: '',
                        //            inner: remaining_amount > 0 ? 120130 : 130012
                        //        };
                        //    }else{//定期 计息中
                        //        $scope.info.time[0] = {
                        //            class_: 'coming',
                        //            times: '',
                        //            inner: 130110
                        //        };
                        //    }
                        //}
                    }
                })
            }]
        }
    },
    resolve: {
        "detail": ['$ocLazyLoad', function ($ocLazyLoad) {
            // you can lazy load files for an existing module
            return $ocLazyLoad.load({
                name: 'detail',
                serie: true,
                files: [
                    '/app/modules/funds/detail/info.css'
                ]
            });
        }]
    }
};