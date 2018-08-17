/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/assets',
    views: {
        'dashboard': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', 'userInfo', 'usdRatio', function($scope, $location, $http, $cookies, $state, $, userInfo, usdRatio){
                $scope.g.currPage = 'assets';
                $scope.info = {
                    fund:'',
                    fundData:'',
                    activeClass:'fixed1',//默认样式为fixed1
                    goState: function(type, coin){  //buy:买入 sold:卖出 detail:详情
                        switch (type){
                            case 'buy':
                            case 'sold':
                                $state.go('dashboard.trade.order', {type: type,link:'assets'});
                                break;
                            case 'recharge':
                            case 'withdraw':
                                if($scope.g.info.tier_level > 0){
                                    if($scope.g.info.tfa_enabled > 0){
                                        $state.go('dashboard.finance.'+type, {coin: coin});
                                    }else{
                                        $state.go('dashboard.user.2fa');//去2fa验证
                                    }
                                }else{
                                    $state.go('dashboard.user.auth');
                                }
                                break;
                            default:
                                break;
                        }

                    },
                    goFinance: function(){
                        $state.go('dashboard.finance.index');
                    },
                    switch:function (v) {
                        if($scope.info.fundData[v].length==0 || !$scope.info.fundData[v]){
                            $scope.info.fund = '';
                        }else {
                            $scope.info.fund = $scope.info.fundData[v];
                        }
                        $scope.info.activeClass = v;
                    },
                    goFundsDetails:function (id, type) {
                        if (typeof(type) != 'undefined') {
                            $state.go('funds.detail', {dac_id: id, type: type});
                        }else{
                            $state.go('funds.detail', {dac_id: id});
                        }

                    },
                    goFunds:function (id, fundType, tradeType) {
                        if(typeof(tradeType) != 'undefined'){
                            $state.go('funds.info.trade', {dac_id: id, type: fundType, tradeType: tradeType});
                        }else{
                            $state.go('funds.info.detail', {type: fundType, dac_id: id});
                        }
                    },
                    goActiveFunds:function (id, type) {
                        if(typeof(type) != 'undefined'){
                            $state.go('funds.active.trade', {dac_id: id, tradeType: type});
                        }else{
                            $state.go('funds.active.detail', {dac_id: id});
                        }
                    }
                };

                userInfo.get().then(function(userInfo){//获取用户信息
                    $scope.info.user = userInfo.data;

                    usdRatio.get().then(function(usdRatio){//获取汇率
                        $scope.info.usdRatio = usdRatio.data;

                        //用户币资产
                        $scope.info.allCoin = (
                            ($scope.info.user.coin_list['BTC'].free + $scope.info.user.coin_list['BTC'].frozen) * $scope.info.usdRatio['BTC'].fiat_ratio) +
                            (($scope.info.user.coin_list['BUT'].free + $scope.info.user.coin_list['BUT'].frozen) * $scope.info.usdRatio['BUT'].fiat_ratio) +
                            (($scope.info.user.coin_list['ETH'].free + $scope.info.user.coin_list['ETH'].frozen) * $scope.info.usdRatio['ETH'].fiat_ratio) +
                            (($scope.info.user.coin_list['USDT'].free + $scope.info.user.coin_list['USDT'].frozen) * $scope.info.usdRatio['USDT'].fiat_ratio);
                        // console.log($scope.info.usdRatio); //汇率
                        // console.log($scope.info.user);//用户信息
                    });

                    //基金收益信息
                    $.ajax({
                        loading: 1,
                        method: 'post',
                        data: {},
                        url: 'app/modules/dashboard/assets/data/get.dac.profit.php',
                        success: function(res){
                            if(res.data.resultCode == 0){
                                $scope.info.fundData = res.data.data;
                                $scope.info.fund = $scope.info.fundData.fixed1;//默认数据为fixed1(币币宝定期)

                                //用户基金资产
                                $scope.info.fundTotal = 0;
                                if($scope.info.fundData.etf && $scope.info.fundData.etf.length!==0){//etf
                                    console.log('指数基金');
                                    for(var a in $scope.info.fundData.etf){
                                        $scope.info.fundTotal += $scope.info.fundData.etf[a].possess_amount * $scope.info.fundData.etf[a].dac_price_on_usdt;
                                    }
                                }
                                if($scope.info.fundData.active && $scope.info.fundData.active.length!==0){//active
                                    console.log('主动基金');
                                    for(var d in $scope.info.fundData.active){
                                        $scope.info.fundTotal += $scope.info.fundData.active[d].possess_amount * $scope.info.fundData.active[d].dac_price_on_usdt;
                                    }
                                }
                                console.log('etf+active：'+$scope.info.fundTotal);
                                if($scope.info.fundData.fixed1 && $scope.info.fundData.fixed1.length!==0){//币币宝定期
                                    console.log('币币宝定期');
                                    for(var b in $scope.info.fundData.fixed1){
                                        if($scope.info.fundData.fixed1[b].pay_profit != 1){
                                            $scope.info.fundTotal += $scope.info.fundData.fixed1[b].trade_amount * $scope.info.usdRatio[$scope.info.fundData.fixed1[b].trade_currency.toUpperCase()].fiat_ratio;
                                            /*if($scope.info.fundData.fixed1[b].trade_currency === 'but'){
                                                $scope.info.fundTotal += $scope.info.fundData.fixed1[b].trade_amount * $scope.info.usdRatio['BUT'].fiat_ratio
                                            }else if($scope.info.fundData.fixed1[b].trade_currency === 'btc'){
                                                $scope.info.fundTotal += $scope.info.fundData.fixed1[b].trade_amount * $scope.info.usdRatio['BTC'].fiat_ratio
                                            }else if($scope.info.fundData.fixed1[b].trade_currency === 'eth'){
                                                $scope.info.fundTotal += $scope.info.fundData.fixed1[b].trade_amount * $scope.info.usdRatio['ETH'].fiat_ratio
                                            }else if($scope.info.fundData.fixed1[b].trade_currency === 'usdt'){
                                                $scope.info.fundTotal += $scope.info.fundData.fixed1[b].trade_amount * $scope.info.usdRatio['USDT'].fiat_ratio
                                            }*/
                                        }
                                    }
                                }
                                if($scope.info.fundData.fixed2 && $scope.info.fundData.fixed2.length!==0){//币币宝活期
                                    console.log('币币宝活期');
                                    for(var c in $scope.info.fundData.fixed2){
                                        $scope.info.fundTotal += $scope.info.fundData.fixed2[c].possess_amount * $scope.info.usdRatio[$scope.info.fundData.fixed2[c].trade_currency.toUpperCase()].fiat_ratio;
                                    }
                                }
                                console.log($scope.info.fundTotal);
                                $scope.info.total = $scope.info.allCoin + $scope.info.fundTotal;
                            }else{

                            }
                        }
                    },$scope);
                });



            }]
        }
    }
};