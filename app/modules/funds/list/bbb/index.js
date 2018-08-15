/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/bbb/:type',  ////定期:fixed    活期:flexible
    views: {
        'list': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$stateParams', '$interval', 'simpleLine', function($scope, $location, $http, $cookies, $state, $, $stateParams, $interval, simpleLine){

                var self_ = $scope.info;
                self_.dataType = 'bbb';
                self_.bbbType = ($stateParams.type == 'flexible' ? 2 : 1);
                self_.pageConfig.currentPage = 1;
                if(self_.bbbType==1){
                    self_.searchList = [
                        {'key': 0, 'value': 120098 },
                        {'key': 1, 'value': 120126 }, 
                        {'key': 2, 'value': 120127 },
                        {'key': 3, 'value': 120128 },
                        {'key': 4, 'value': 120129 },
                        {'key': 5, 'value': 120132 }
                    ];
                }else{
                    self_.searchList = [
                        {'key': 0, 'value':120098 },
                        {'key': 1, 'value':120126 }, 
                        {'key': 2, 'value':120127 },
                        {'key': 6, 'value':120130 },
                        {'key': 5, 'value':120132 }
                    ];
                }
                
                self_.searchItem = 0;
                self_.pageConfig.itemsPerPage = 12;
                self_.pageConfig.func = function(){//选择页数
                    self_.dataList= {};//币币宝列表
                    self_.loading = true;
                    self_.getDataList();
                };
                self_.selectCallBack = null;
                self_.getDataList();

                $scope.countdown_data = function(k, item){ //获取列表

                    // 未开始
                    if($scope.fundInfo.nowDate < item.dac_trade_limit.buy_start_time){
                        $scope.info.time[k] = {
                            class_: 'coming',
                            times: $scope.info.bbbType == 1 ? item.dac_trade_limit.buy_start_time - $scope.fundInfo.nowDate : '',
                            inner: 120126
                        };
                    }
                    // 开始
                    if($scope.fundInfo.nowDate >= item.dac_trade_limit.buy_start_time){
                        var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                        $scope.info.time[k] = {
                            class_: remaining_amount > 0 ? 'being' : 'coming',
                            times: remaining_amount > 0 ? (item.dac_trade_limit.buy_end_time - $scope.fundInfo.nowDate || '') : '',
                            inner: remaining_amount > 0 ? 130110 : 130012
                        };
                    }
                    //定期 计息中
                    if($scope.fundInfo.nowDate >= item.start_time){
                        if($scope.info.bbbType == 2){//活期 开放中
                            var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                            $scope.info.time[k] = {
                                class_: remaining_amount > 0 ? 'being' : 'coming',
                                times: remaining_amount > 0 ? (item.dac_trade_limit.buy_end_time - $scope.fundInfo.nowDate || '') : '',
                                inner: remaining_amount > 0 ? 130110 : 130012
                            };
                        }else{//定期 计息中
                            $scope.info.time[k] = {
                                class_: 'coming',
                                times: '',
                                inner: 130110
                            };
                        }
                    }
                    // 结束
                    if(!!item.end_time && $scope.fundInfo.nowDate >= item.end_time){
                        $scope.info.time[k] = {
                            class_: 'coming',
                            times: '',
                            inner: 130109
                        };
                    }





                    //if($scope.fundInfo.nowDate < item.dac_trade_limit.buy_start_time){// 未开始
                    //    $scope.info.time[k] = {
                    //        class_: 'coming',
                    //        times: item.dac_trade_limit.buy_start_time - $scope.fundInfo.nowDate,
                    //        inner: 130110
                    //    };
                    //    if($scope.info.bbbType == 2){//活期
                    //        $scope.info.time[k].times = '';
                    //        $scope.info.time[k].inner = 120126;
                    //    }
                    //
                    //}else if($scope.fundInfo.nowDate >=item.dac_trade_limit.buy_start_time && $scope.fundInfo.nowDate < item.dac_trade_limit.buy_end_time){// 开始
                    //    var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                    //    $scope.info.time[k] = {
                    //        class_: remaining_amount > 0 ? 'being' : 'coming',
                    //        times: remaining_amount > 0 ? (item.dac_trade_limit.buy_end_time - $scope.fundInfo.nowDate || '') : '',
                    //        inner: remaining_amount > 0 ? 130110 : 130012
                    //    };
                    //}else if($scope.fundInfo.nowDate > item.end_time){// 结束
                    //    $scope.info.time[k] = {
                    //        class_: 'coming',
                    //        times: '',
                    //        inner: 130109
                    //    };
                    //}else if($scope.fundInfo.nowDate >= item.start_time && $scope.fundInfo.nowDate < item.end_time){
                    //    if($scope.info.bbbType == 2){//活期 开放中
                    //        var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                    //        $scope.info.time[k] = {
                    //            class_: remaining_amount > 0 ? 'being' : 'coming',
                    //            times: remaining_amount > 0 ? (item.dac_trade_limit.buy_end_time - $scope.fundInfo.nowDate || '') : '',
                    //            inner: remaining_amount > 0 ? 130110 : 130012
                    //        };
                    //    }else{//定期 计息中
                    //        $scope.info.time[k] = {
                    //            class_: 'coming',
                    //            times: '',
                    //            inner: 130110
                    //        };
                    //    }
                    //}
                }

            }]
        }
    }
};