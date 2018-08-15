/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/index',
    views: {
        'funds': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$stateParams', '$interval', 'simpleLine', function($scope, $location, $http, $cookies, $state, $, $stateParams, $interval, simpleLine){

                $scope.g.currPage = 'funds';
                $scope.info = {
                    lang: $scope.g.currLang,
                    dataList: {},//币币宝列表
                    dataPassiveList: {},//被动基金列表
                    dataActiveList: {},//主动基金列表
                    time:[],
                    loading: false,//列表加载
                    bbb_loading: true,
                    passive_loading: true,
                    Active_loading: true,
                    percent:{},
                    init: function(){
                        var self_ = this;
                        self_.getList();
                        self_.getPassiveList();
                        self_.getActiveList();
                    },
                    pageLink: function(page, obj){
                        obj ? $state.go(page, obj) : $state.go(page);
                    },
                    goLink: function(type, id){
                        window.location.href = '/funds/'+ type +'/'+ id +'/detail';
                    },
                    getList: function(){ //获取列表
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/funds/data/funds.recommend.php',
                            data: {
                                fund_type: 'bbb'
                            },
                            success: function(res){
                                self_.bbb_loading = false;
                                self_.dataList = res.data.data;
                            }
                        },$scope);
                    },
                    getPassiveList: function(){ //获取被动基金列表(推荐)
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/funds/data/funds.recommend.php',
                            data: {
                                fund_type: 'passive'
                            },
                            success: function(res){
                                self_.passive_loading = false;
                                self_.dataPassiveList = res.data.data;
                                for(var i in self_.dataPassiveList){
                                    self_.dataPassiveList[i].priceData = [];
                                    self_.dataPassiveList[i].simpleLine = new simpleLine.chart();
                                    for(var j in self_.dataPassiveList[i].trends){
                                        self_.dataPassiveList[i].priceData.push({
                                            x: self_.dataPassiveList[i].trends[j].evaluate_time,
                                            y: self_.dataPassiveList[i].trends[j].exchange_ratio
                                        })
                                    }
                                    self_.dataPassiveList[i].simpleLine.data(self_.dataPassiveList[i].priceData);
                                }
                            }
                        },$scope);
                    },
                    getActiveList: function(){ //获取主动基金列表
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/funds/data/funds.recommend.php',
                            data: {
                                fund_type: 'active'
                            },
                            success: function(res){
                                self_.Active_loading = false;
                                self_.dataActiveList = res.data.data;
                            }
                        },$scope);
                    },
                    getinfo: function(k, item){ //获取列表
                        var self_ = this;

                        if($scope.fundInfo.nowDate < item.dac_trade_limit.buy_start_time){// 未开始
                            $scope.info.time[k] = {
                                class_: 'coming',
                                times: item.dac_trade_limit.buy_start_time - $scope.fundInfo.nowDate,
                                inner: 130110
                            };
                        }else if($scope.fundInfo.nowDate >=item.dac_trade_limit.buy_start_time && $scope.fundInfo.nowDate < item.dac_trade_limit.buy_end_time){// 开始
                            var remaining_amount = item.dac_trade_limit.capacity - item.dac_sold_amount;
                            $scope.info.time[k] = {
                                class_: remaining_amount > 0 ? 'being' : 'coming',
                                times: remaining_amount > 0 ? (item.dac_trade_limit.buy_end_time - $scope.fundInfo.nowDate || '') : '',
                                inner: remaining_amount > 0 ? 130110 : 130012
                            };
                        }else if($scope.fundInfo.nowDate > item.end_time){// 结束
                            $scope.info.time[k] = {
                                class_: 'coming',
                                times: '',
                                inner: 130109
                            };
                        }else if($scope.fundInfo.nowDate >= item.start_time && $scope.fundInfo.nowDate < item.end_time){
                            $scope.info.time[k] = {
                                class_: 'coming',
                                times: '',
                                inner: 130110
                            };
                        }

                    }

                };
                $scope.info.init();

                $scope.info.simpleLine = new simpleLine.chart()

            }]
        }
    },
    resolve: {
        "index": ['$ocLazyLoad', function ($ocLazyLoad) {
            // you can lazy load files for an existing module
            return $ocLazyLoad.load({
                name: 'index',
                serie: true,
                files: [
                    '/app/modules/funds/index.css',
                    '../bower_components/highcharts/highcharts.js',
                    //'../bower_components/highcharts/highstock.src.js',
                    '../bower_components/highcharts/highcharts-more.js',
                    '../bower_components/highcharts-ng/dist/highcharts-ng.js',
                ]
            });
        }]
    }
};