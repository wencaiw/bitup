/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/index/:type',
    views: {
        '': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$stateParams', '$interval', 'area', function($scope, $location, $http, $cookies, $state, $, $stateParams, $interval, area){

                $scope.g.currPage = 'bp';
                $scope.info = {
                    currTime: 0,             //当前查询时间区间 0:24小时 1:7天 2:3个月
                    currPrice: '--',         //当前价格
                    currDate: '',            //当前价格的时间
                    maxPrice: '--',
                    minPrice: '--',
                    fluctuation: '--',
                    dataList: [],
                    indexType: $stateParams.type,
                    area: new area.chart(),
                    switchTime: function(time){
                        if($scope.info.indexType == 'bpp'){
                            $scope.info.indexUrlCn = '/app/modules/index/file/BP_Platform_Index_Methodology_v6_cn.pdf';
                            $scope.info.indexUrlEn = '/app/modules/index/file/BP_Platform_Index_Methodology_v6_en.pdf';
                        }else{
                            $scope.info.indexUrlCn = '/app/modules/index/file/BP10_Index_Methodology_v10_cn.pdf';
                            $scope.info.indexUrlEn = '/app/modules/index/file/BP10_Index_Methodology_v10_en.pdf';
                        }

                        $scope.info.currTime = time;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/index/data/get.bp.list.php',
                            data: {
                                mode: $scope.info.currTime,
                                type: $scope.info.indexType
                            },
                            success: function(res){
                                if(!res.data.data) return;
                                $scope.info.maxPrice = !!res.data.data.max_price ? res.data.data.max_price : '--';
                                $scope.info.minPrice = !!res.data.data.min_price ? res.data.data.min_price : '--';
                                $scope.info.fluctuation = !!res.data.data.fluctuation ? res.data.data.fluctuation : '--';
                                $scope.info.currPrice = res.data.data.trends[res.data.data.trends.length-1].index_value;
                                $scope.info.currDate = res.data.data.trends[res.data.data.trends.length-1].ts;
                                $scope.info.dataList = res.data.data.composition;
                                var bp = [];
                                for(var i in res.data.data.trends){
                                    bp.push({
                                        x: res.data.data.trends[i].ts,
                                        y: res.data.data.trends[i].index_value
                                    })
                                }
                                $scope.info.bpData = bp;
                                $scope.info.area.tickInterval(3600000 * (time==0 ? 2 : (time==1 ? 24 : 10*24)));
                                $scope.info.area.data(bp);
                                $scope.info.area.name($scope.info.indexType == 'bp10' ? 'BP 10' : 'BPP');

                                //$scope.info.chartConfig.xAxis.tickInterval = 3600000 * (time==0 ? 3 : (time==1 ? 24 : 10*24));
                                //$scope.info.chartConfig.series[0].data = bp;
                                //console.log(bp);
                            }
                        },$scope);
                        $scope.info.area.pointsData($scope.info.getPoints)
                    },
                    getPoints: function () {
                        var series = this.series[0],
                            chart = this;
                        area.activeLastPointToolip(chart);
                        $scope.interval = $interval(function () {
                            $http.post('app/modules/index/data/get.bp.latest.php', {
                                //interval: 5,
                                start_time: $scope.info.bpData[$scope.info.bpData.length-1].x,
                                type: $scope.info.indexType
                            }).then(function (res) {
                                if (res.data.resultCode != 0) {
                                    alert(res.data.errMsg);
                                } else {
                                    if(!res.data.data) return;
                                    if(!!res.data.data.trends && res.data.data.trends.length > 0){
                                        for(var i in res.data.data.trends){
                                            var x = res.data.data.trends[i].ts,
                                                y = res.data.data.trends[i].index_value;
                                            $scope.info.bpData.splice(0, 1);
                                            $scope.info.bpData.push({
                                                x: x,
                                                y: y
                                            });
                                            $scope.info.maxPrice = y>$scope.info.maxPrice ? y : $scope.info.maxPrice;
                                            $scope.info.minPrice = y<$scope.info.minPrice ? y : $scope.info.minPrice;
                                            $scope.info.fluctuation = ($scope.info.bpData[$scope.info.bpData.length-1].y - $scope.info.bpData[0].y)/$scope.info.bpData[0].y;
                                            $scope.info.currPrice = res.data.data.trends[res.data.data.trends.length-1].index_value;
                                            $scope.info.currDate = res.data.data.trends[res.data.data.trends.length-1].ts;
                                            $scope.info.dataList = res.data.data.composition;
                                            series.addPoint([x, y], true, true);
                                            area.activeLastPointToolip(chart);
                                        }
                                    }
                                }
                            });
                        }, 1000 * 60 * 5);

                        //$interval.cancel(timer[i]);
                    },
                    switchTab: function(type){
                        if($scope.info.indexType != type){
                            //$state.go('index', {type: type});
                            window.location.href = '/index/' + type;
                        }
                    }
                };

                $scope.info.switchTime(0);

                $scope.$on("$destroy", function() {
                    if (angular.isDefined($scope.interval)) {
                        $interval.cancel($scope.interval);
                        $scope.interval = undefined;
                    }
                });

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
                    '../bower_components/highcharts/highcharts.js',
                    //'../bower_components/highcharts/highstock.src.js',
                    '../bower_components/highcharts/highcharts-more.js',
                    '../bower_components/highcharts-ng/dist/highcharts-ng.js',
                    '/app/modules/index/bpi.css',
                ]
            });
        }]
    }
};