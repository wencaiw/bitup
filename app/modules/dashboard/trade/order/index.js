/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/order/:type',
    views: {
        'trade': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$stateParams', '$', '$interval', '$translate', 'T', function($scope, $http, $cookies, $state, $stateParams, $, $interval, $translate, T){
                $scope.g.currPage = 'tradeCenter';
                console.log($stateParams);
                $scope.info = {
                    //showCurrencyList: false //显示支付/收款货币列表
                    orderType:$stateParams.type,
                    currencyList:{
                        'BTC':{
                            key: 'BTC',
                            name: $scope.g.biList.BTC.name + '(BTC)',
                            ratio: 0.000767829369081
                        },
                        'ETH':{
                            key: 'ETH',
                            name: '以太坊(ETH)',
                            ratio: 0.0111619639765
                        }
                    },
                    currentCurrency:{},      //当前所选的货币
                    showCurrencyNum: false,  //显示买入卖出货币数量
                    error: false,            //是否报错
                    toggleCurrency: function(event){     //显示隐藏货币类型列表
                        event = event || window.event;
                        event.stopPropagation();
                        //$scope.info.showCurrencyList = !$scope.info.showCurrencyList;
                        if($scope.g.panelStatus.currencyList == 'hide'){
                            $scope.g.panelStatus.currencyList = 'show';
                        }
                        else {
                            $scope.g.panelStatus.currencyList = 'hide';
                        }
                    },
                    chooseCurrency: function(item,event){    //选择货币类型
                        event = event || window.event;
                        event.stopPropagation();
                        $scope.info.currentCurrency = item;
                        $scope.info.currencyLg = {
                            currency: $scope.info.currentCurrency.key
                        };
                        $scope.g.panelStatus.currencyList = 'hide';
                        $scope.info.showCurrencyNum = true;
                        $scope.info.bppNum = '';
                    },
                    showPopup: false,         //默认不显示预览提交框
                    showTradeOperate: true,
                    closePopup: function(){
                        $scope.info.showPopup = false;
                        $interval.cancel($scope.info.countDownFun);
                    },
                    goPreview: function(){
                        $scope.info.subCountDown = 30;
                        $scope.info.showPopup = true;
                        $scope.info.countDownFun = $interval(function(){
                            $scope.info.subCountDown--;
                            if($scope.info.subCountDown <= 0){
                                //$scope.info.error = false;
                                $interval.cancel($scope.info.countDownFun);
                            }
                        }, 1000, $scope.info.subCountDown)
                    },
                    subOrder: function(){
                        $scope.info.showPopup = false;
                        $scope.info.showDetail = true;
                        $scope.info.showTradeOperate = false;
                    }
                };

                if($stateParams.type == 'buy'){
                    $scope.info.type = '买入';
                }else if($stateParams.type == 'sold'){
                    $scope.info.type = '卖出';
                }else if($stateParams.type == 'detail'){
                    $scope.g.currPage = 'tradeRecord';
                    $scope.info.type = '详情';
                    $scope.info.showDetail = true;
                    $scope.info.orderDetail = JSON.parse(sessionStorage.getItem('orderDetail'));
                    $scope.info.currencyLgDetail = {
                        currency: 'ETH'
                    };
                }else {
                    $state.go('trade.center');
                }
                $scope.$watch('info.bppNum',function(newV, oldV, scope){
                    if(newV != oldV){
                        scope.info.currencyNum = (!!scope.info.bppNum ? (scope.info.bppNum * scope.info.currentCurrency.ratio * 0.995) : '');
                        scope.info.currencyNum2 = !!scope.info.bppNum ? (scope.info.bppNum * scope.info.currentCurrency.ratio) : '';
                        if(scope.info.currencyNum2 != ''){
                            scope.info.currencyNum2 = scope.info.currencyNum2.toFixed(6);
                        }
                        if($stateParams.type == 'buy'){
                            scope.info.error = (scope.info.currencyNum > $scope.g.userInfo[scope.info.currentCurrency.key]);
                        }else if($stateParams.type == 'sold'){
                            scope.info.error = (scope.info.bppNum > $scope.g.userInfo.bppList['BPP'].num);
                        }
                    }
                });

                //$scope.$watch('info.currencyNum',function(newV, oldV, scope){
                //    if(newV != oldV){
                //        scope.info.bppNum = (!!scope.info.currencyNum ? (scope.info.currencyNum / scope.info.currentCurrency.ratio) : '');
                //        if($stateParams.type == 'buy'){
                //            scope.info.error = (scope.info.currencyNum > $scope.g.userInfo[scope.info.currentCurrency.key]);
                //        }else if($stateParams.type == 'sold'){
                //            scope.info.error = (scope.info.bppNum > $scope.g.userInfo.bppList['BPP']);
                //        }
                //    }
                //});
                $scope.$watch('g.biList.BTC.name',function(){
                    $scope.info.currencyList.BTC.name = $scope.g.biList.BTC.name + '(BTC)';
                    $scope.info.currencyList.ETH.name = $scope.g.biList.ETH.name + '(ETH)';
                });

                $scope.g.orderingType = {
                    type: $stateParams.type == 'buy'?$scope.g.buying:$scope.g.solding
                };
                $scope.g.orderType = {
                    type: $stateParams.type == 'buy'?$scope.g.buy:$scope.g.sold
                };
                if($stateParams.type == 'detail'){
                    $scope.g.orderingType = {
                        type: $scope.info.orderDetail.type == 'buy'?$scope.g.buying:$scope.g.solding
                    };
                    $scope.g.orderType = {
                        type: $scope.info.orderDetail.type == 'buy'?$scope.g.buy:$scope.g.sold
                    };
                }
                $scope.g.orderInfo = {
                    type: $stateParams.type == 'buy'?$translate.instant('100104'):$translate.instant('100105'),
                };
                $scope.g.orderMethod = {
                    type: $stateParams.type == 'buy'?$translate.instant('100107'):$translate.instant('100108')
                };
                $scope.g.orderMethodTips = {
                    type: $stateParams.type == 'buy'?$translate.instant('100109'):$translate.instant('100110')
                };
                $scope.g.orderAmount = {
                    type: $stateParams.type == 'buy'?$translate.instant('100112'):$translate.instant('100113')
                };
                $scope.info.currencyLg = {
                    currency: $scope.info.currentCurrency.key
                };

                $scope.info.equityValue = {
                    'BTC':{
                        num:0.019156,
                        price:256.88
                    },
                    'ETH':{
                        num:0.349624,
                        price:420.35
                    }
                }
            }]
        }
    },
    resolve: {
        'order': ['$ocLazyLoad', function($ocLazyLoad){
            return $ocLazyLoad.load({
                name: 'order',
                serie: true,
                files: [
                    'modules/trade/order/index.js'
                ]
            })
        }]
    }
};