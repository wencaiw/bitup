/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/detail',
    views: {
        'passive': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$stateParams', '$interval', 'area', 'usdRatio', function($scope, $location, $http, $cookies, $state, $, $stateParams, $interval, area, usdRatio){

                $scope.info = {
                    islogin  : $scope.g.isLogin, //是否登录
                    currTime : 0,
                    tabActive: 0,
                    //allPrice : 0,
                    user     : {},
                    area     : new area.chart(),
                    dac_id   : $scope.publicData.currDacId,
                    cny_ratio: 0,//汇率
                    init:function () {
                        var self = this;
                        usdRatio.get().then(function(usdRatio){
                            self.cny_ratio = usdRatio.data['USDT'].cny_ratio;
                        });
                        self.getFirstData();
                        self.getReportData();
                        self.getCombination();
                        self.switchTime(0);
                        $scope.g.isLogin ? self.getDKList() : '';//我的记录
                    },
                    tabClick: function(index){
                        var self = this;
                        this.tabActive = index;
                        if(index == 3){
                            self.getDKList();
                        }
                    },
                    go:function (type) {
                        if(this.islogin){
                            $state.go('funds.info.trade', {tradeType: type});
                        }else{
                            window.location.href = '/login';
                        }
                    },
                    pageLink: function(docUrl){
                        window.open('http://doc.bitup.com/' + docUrl);
                    },
                    switchTime: function(time){
                        $scope.info.currTime = time;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/funds/info/data/get.price.list.php',
                            data: {
                                dac_id: $scope.info.dac_id,
                                currency: 'usdt',
                                mode: time
                            },
                            success: function(res){
                                if(!res.data.data) return;
                                var priceData = [],
                                    fundsStart = false;
                                for(var i in res.data.data.trends){
                                    priceData.push({
                                        x: res.data.data.trends[i].evaluate_time,
                                        y: res.data.data.trends[i].exchange_ratio
                                    });
                                    if(
                                        $scope.publicData.currFundType == 'active' &&
                                        !fundsStart &&
                                        !!$scope.publicData.fundInfo &&
                                        $scope.publicData.fundInfo.start_time >= res.data.data.trends[0].evaluate_time &&
                                        res.data.data.trends[i].evaluate_time >= $scope.publicData.fundInfo.start_time
                                    ){
                                        priceData[i].marker = {};
                                        priceData[i].marker.symbol = 'url(/common/images/app/fund-start-en.png)';
                                        priceData[i].marker.width = 80;
                                        priceData[i].marker.height = 80;
                                        fundsStart = true;
                                    }
                                }

                                $scope.info.priceData = priceData;
                                if(!!$scope.publicData.fundInfo){
                                    $scope.info.area.tickInterval(3600000 * (time==0 ? 3 : (time==1 ? 24 : 10*24)));
                                    $scope.info.area.data(priceData);
                                    $scope.info.area.name($scope.publicData.fundInfo.symbol.toLocaleUpperCase());
                                }
                                $scope.info.totalPrice();
                            }
                        },$scope);

                        if($scope.publicData.currFundType != 'active'){
                            $scope.info.area.pointsData($scope.info.getPoints);
                        }
                    },
                    getPoints: function (){
                        var series = this.series[0],
                            chart = this;
                        area.activeLastPointToolip(chart);
                        $scope.interval = $interval(function () {
                            $http.post('app/modules/funds/info/data/get.price.latest.php', {
                                dac_id: $scope.info.dac_id,
                                currency: 'usdt',
                                start_time: $scope.info.priceData[$scope.info.priceData.length-1].x
                            }).then(function (res) {
                                if(!res.data.data) return;
                                if (res.data.resultCode != 0) {
                                    alert(res.data.errMsg);
                                } else {
                                    if(!!res.data.data.trends && res.data.data.trends.length > 0){
                                        for(var i in res.data.data.trends){
                                            var x = res.data.data.trends[i].evaluate_time,
                                                y = res.data.data.trends[i].exchange_ratio;
                                            $scope.info.priceData.splice(0, 1);
                                            $scope.info.priceData.push({
                                                x: x,
                                                y: y
                                            });
                                            series.addPoint([x, y], true, true);
                                            area.activeLastPointToolip(chart);
                                        }
                                        $scope.info.bppData = res.data.data;
                                        $scope.info.totalPrice();
                                    }
                                }

                            });
                        }, 1000 * 60 * 5);

                    },
                    totalPrice: function(){//计算价格
                        var self = this;
                        if(!!self.priceData && !!$scope.publicData.fundInfo){
                            self.onePrice = self.priceData[self.priceData.length-1].y;
                            self.fundPrice = $scope.publicData.fundInfo.dac_sold_amount * self.priceData[self.priceData.length-1].y;
                            if($scope.g.isLogin && !!$scope.publicData.userFunds){
                                self.allPrice = self.priceData[self.priceData.length-1].y * $scope.publicData.userFunds.user_possess_amount;
                            }
                        }
                    },
                    getFirstData: function(){//指数
                        var self = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                dac_id: self.dac_id,
                                currency: 'usdt'
                            },
                            url: 'app/modules/funds/info/data/get.price.latest.php',
                            success: function(res){
                                if(!res.data.data) return;
                                self.bppData = res.data.data;
                            }
                        },$scope);
                    },
                    getReportData: function(){//基金报告
                        var self = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                dac_id: self.dac_id,
                                language: $scope.g.currLang == 'cn' ? 'zh-cn' :'en-us'
                            },
                            url: 'app/modules/funds/info/data/get.fund.report.php',
                            success: function(res){
                                self.reportData = res.data.data;
                            }
                        },$scope);
                    },
                    getCombination: function(){//基金持仓组合
                        var self = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                dac_id: self.dac_id,
                            },
                            url: 'app/modules/funds/info/data/get.fund.combination.php',
                            success: function(res){
                                self.combinationData = res.data.data;
                                console.log(self.combinationData);
                            }
                        },$scope);
                    },
                    getDKList: function(){//我的记录
                        var self = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                dac_id: self.dac_id
                            },
                            url: 'app/modules/funds/data/user.fund.buy.list.php',
                            success: function(res){
                                self.dkList = res.data.data;
                            }
                        },$scope);
                    },
                    setCancel: function(id, index){//撤销
                        var self = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                dac_order_id: id
                            },
                            url: 'app/modules/funds/info/data/unfixed.fund.cancel.php',
                            success: function(res){
                                self.dkList[index].status = -1;
                            }
                        },$scope);
                    }
                };
                $scope.info.init();

                $scope.$on("$destroy", function() {
                    if (angular.isDefined($scope.interval)) {
                        $interval.cancel($scope.interval);
                        $interval.cancel($scope.addTime);
                        $scope.interval = undefined;
                        $scope.addTime = undefined;
                    }
                });

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
                    '../bower_components/highcharts/highcharts.js',
                    //'../bower_components/highcharts/highstock.src.js',
                    '../bower_components/highcharts/highcharts-more.js',
                    '../bower_components/highcharts-ng/dist/highcharts-ng.js',
                    '/app/modules/funds/info/detail/detail.css',
                ]
            });
        }]
    }
};