/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/analysis',
    views: {
        'dashboard': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'line', 'column', 'pie', '$filter', function($scope, $http, $cookies, $state, $, line, column, pie, $filter){
                $scope.g.currPage = 'analysis';

                var dataArr = [940.88,950.91,1065.34,1170.56,1030.99,1240.11,1145.78,1167.89,1188.91,1206.76,1244.32,1176.33,1265.42,1288.33,1315.18,1345.96,1450.77,1633.74,1465.77,1560.11,1567.23,1430.93,1522.35,1482.19,1529.02,1478.3,1515.39,1810.01,1765.42,1766.2,1654.33,1542.08,1588.77,1591.3,1603.45,1639.33,1654.11,1678.11,1754.19,1714.1,1798.16,1643.2,1803.54,1856.09,1926.77,1977.82,1745.29,1622.35,1655.03,1420.63,1242.42,1545.59,1669.7,1543.21,1579.5,1600.77,1689.25,1677.53,1611.38,1755.43,1709.32,1777.55,1654.98,1837.65,1839.53,1542.11,1677.83,1765.42,1898.55,1890.05,1845.77,1960.5,1663.14,1845.11,1856.29,1950.37,2056.79,2256.39];
                $scope.info = {
                    line : new line.chart(),
                    pie : new pie.chart(),
                    column : new column.chart(),
                    column2 : new column.chart(),
                    column3 : new column.chart(),
                    currProfitTab: 7,   //当前tab
                    currValuationTab: 7,   //当前tab
                    monthAbrList: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    xArr: [],
                    yArr: [],
                    yMinVal: 0,
                    randNum: function(num){
                        var startDate = new Date();
                        $scope.info.xArr = [];
                        $scope.info.yArrProfit = [];
                        $scope.info.yArr = dataArr.slice(-num);
                        $scope.info.yMinVal = $scope.info.yArr[0];
                        for(var i=0; i<$scope.info.yArr.length; i++){
                            if($scope.info.yMinVal > $scope.info.yArr[i]){
                                $scope.info.yMinVal = $scope.info.yArr[i];
                            }
                        }
                        console.log($scope.info.yArr);
                        console.log($scope.info.yMinVal);
                        switch (num){
                            case 7:
                                //$scope.info.column2.tickInterval(1);
                                for(var i=0; i<num; i++){
                                    var date = new Date(Date.UTC(startDate.getFullYear(), startDate.getMonth(), (startDate.getDate()+i-(num-1))));
                                    if(i==0){
                                        $scope.info.startDate = $filter('date')(date, 'yyyy.MM.dd');
                                    }
                                    if(i==num-1){
                                        $scope.info.endDate = $filter('date')(date, 'yyyy.MM.dd');
                                    }
                                    date = date.getDate() + '.' + $scope.info.monthAbrList[date.getMonth()];
                                    $scope.info.xArr.push(date);
                                    $scope.info.yArrProfit.push((Math.floor(Math.random()*70)) + 20);
                                }
                                break;
                            case 30:
                                //$scope.info.column2.tickInterval(3);
                                for(var i=0; i<num; i++){
                                    var date = new Date(Date.UTC(startDate.getFullYear(), startDate.getMonth(), (startDate.getDate()+i-(num-1))));
                                    if(i==0){
                                        $scope.info.startDate = $filter('date')(date, 'yyyy.MM.dd');
                                    }
                                    if(i==num-1){
                                        $scope.info.endDate = $filter('date')(date, 'yyyy.MM.dd');
                                    }
                                    date = date.getDate() + '.' + $scope.info.monthAbrList[date.getMonth()];
                                    $scope.info.xArr.push(date);
                                    $scope.info.yArrProfit.push((Math.floor(Math.random()*70)) + 20);
                                }
                                break;
                            case 90:
                                //$scope.info.column2.tickInterval(9);
                                for(var i=0; i<num; i++){
                                    var date = new Date(Date.UTC(startDate.getFullYear(), startDate.getMonth(), (startDate.getDate()+i-(num-1))));
                                    if(i==0){
                                        $scope.info.startDate = $filter('date')(date, 'yyyy.MM.dd');
                                    }
                                    if(i==num-1){
                                        $scope.info.endDate = $filter('date')(date, 'yyyy.MM.dd');
                                    }
                                    date = date.getDate() + '.' + $scope.info.monthAbrList[date.getMonth()];
                                    $scope.info.xArr.push(date);
                                    $scope.info.yArrProfit.push((Math.floor(Math.random()*70)) + 20);
                                }
                            default:
                                break;
                        }
                    },
                    getStartDate: function(num){
                        var startDate = new Date();
                        //startDate.setDate(startDate.getDate() - 1);
                        return Date.UTC(startDate.getFullYear(), startDate.getMonth(), startDate.getDate()-num+1);
                    },
                    switchProfitTab: function(num){
                        if(num != $scope.info.currProfitTab){
                            $scope.info.column2.tickInterval((num/10<1) ? 7 : num/10);
                            $scope.info.currProfitTab = num;
                            $scope.info.randNum($scope.info.currProfitTab);
                            //$scope.info.column2.startDate($scope.info.getStartDate(num));
                            $scope.info.column2.xList($scope.info.xArr);
                            $scope.info.column2.data($scope.info.yArrProfit);
                            $scope.info.profitStartDate = $scope.info.startDate;
                            $scope.info.profitEndDate = $scope.info.endDate;
                        }
                    },
                    switchValuationTab: function(num){
                        if(num != $scope.info.currValuationTab){
                            $scope.info.line.tickInterval((num/10<1) ? 7*3600000*24 : (num/10)*3600000*24);
                            $scope.info.currValuationTab = num;
                            $scope.info.randNum($scope.info.currValuationTab);
                            $scope.info.line.startDate($scope.info.getStartDate(num));
                            $scope.info.line.yList($scope.info.yArr);
                            $scope.info.line.yMin(Math.floor($scope.info.yMinVal));
                            $scope.info.valuationStartDate = $scope.info.startDate;
                            $scope.info.valuationEndDate = $scope.info.endDate;
                        }
                    }
                };

                $scope.info.column.colors(['#727AC9', '#5FCEFA', '#8CCE6F', '#F5B35D', '#ED694D']);
                $scope.info.column.xList(['总资产收益', 'BPP收益', 'BTC收益', 'ETH收益']);
                $scope.info.column.data([20.39, 18.48, -8.77, 10.68]);

                $scope.info.randNum($scope.info.currProfitTab);
                $scope.info.column2.tickInterval(1);
                $scope.info.column2.xList($scope.info.xArr);
                $scope.info.column2.data($scope.info.yArrProfit);
                $scope.info.profitStartDate = $scope.info.startDate;
                $scope.info.profitEndDate = $scope.info.endDate;

                //demo
                //$scope.info.randNum(30);
                $scope.info.column3.colors(['#03BCC0']);
                //$scope.info.column3.xList($scope.info.xArr);
                //$scope.info.column3.data($scope.info.yArrProfit);
                $scope.info.column3.xList(['04.07', '04.08', '04.09', '04.10', '04.11', '04.12', '04.13', '04.14', '04.15', '04.16', '04.17', '04.18', '04.19', '04.20']);
                $scope.info.column3.data([20.39, 18.48, {y: 8.77, color: '#F6A623'}, 10.68, 20.39, 18.48, {y: 8.77, color: '#F6A623'}, 10.68, 20.39, 18.48, {y: 8.77, color: '#F6A623'}, 10.68, 2.33, 5.00]);

                $scope.info.line.pointInterval(3600000 * 24);
                $scope.info.line.startDate($scope.info.getStartDate($scope.info.currValuationTab));
                $scope.info.line.yList($scope.info.yArr);
                $scope.info.line.yMin(Math.floor($scope.info.yMinVal));
                $scope.info.valuationStartDate = $scope.info.startDate;
                $scope.info.valuationEndDate = $scope.info.endDate;

                $scope.info.pie.data([['BPP', 1579.16], ['BTC', 256.88], ['ETH', 420.35]])
            }]
        }
    },
    resolve: {
        "analysis": ['$ocLazyLoad', function ($ocLazyLoad) {
            // you can lazy load files for an existing module
            return $ocLazyLoad.load({
                name: 'analysis',
                serie: true,
                files: [
                    '../bower_components/highcharts/highcharts.js',
                    //'../bower_components/highcharts/highstock.src.js',
                    '../bower_components/highcharts/highcharts-more.js',
                    '../bower_components/highcharts-ng/dist/highcharts-ng.js'
                ]
            });
        }]
    }
};