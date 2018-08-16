/**
 * Created by Hajay on 2018/4/22.
 */

var module = angular.module('BTCFund', ['pascalprecht.translate', 'highcharts-ng']);  //, 'monospaced.qrcode' 二维码


/**
 * 各种语言
 */
module.config(['$translateProvider',function($translateProvider){
    var lang = window.localStorage.lang || 'en';
    $translateProvider.preferredLanguage(lang);
    //$translateProvider.useStaticFilesLoader({
    //    prefix: '../common/i18n/',
    //    suffix: '.json'
    //});
    $translateProvider.translations('en',en);
    $translateProvider.translations('cn',cn);
}]);

module.factory('T', ['$translate', function($translate) {
    var T = {
        T:function(key) {
            if(key){
                return $translate.instant(key);
            }
            return key;
        }
    };
    return T;
}]);

/**
 *  对数据进行处理 urlencode
 */
module.config(function ($httpProvider) {
    //对php的post处理
    $httpProvider.defaults.transformRequest = function (request) {
        if (typeof (request) != 'object') {
            return request;
        }
        var str = [];
        for (var k in request) {
            if (k.charAt(0) == '$') {
                delete request[k];
                continue;
            }
            var v = 'object' == typeof (request[k]) ? JSON.stringify(request[k]) : request[k];
            str.push(encodeURIComponent(k) + "=" + encodeURIComponent(v));
        }
        return str.join("&");
    };
    $httpProvider.defaults.timeout = 20000;
    $httpProvider.defaults.headers.post = {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
    };
});
module.factory("$", function($http, $timeout, $q){
    this.ajax = function(params, scope){  //params, scope
        loading(true);
        var data = {
            method: params.method,
            url: params.url
        };
        if(params.method == 'GET' || params.method == 'get'){
            data.params = params.data;
        }else {
            data.data = params.data;
        }
        $http(data).then(function(res){
            loading(false);
            if (res.data.logout) {
                window.location.href = '/login/?return_url=' + encodeURIComponent(window.location.href);
                return;
            }
            if(res.data.resultCode == 0){
                params.success(res);
            }else{
                if(params.error){
                    params.error(res);
                }else{
                    scope.g.tip("message", res.data.errMsg);
                }
            }
        }).catch(function () {
            loading(false);
            scope.g.tip("message", "network failure");
        });

        function loading(b){
            if (params.loading == 1) {
                scope.g.loading = b;
            }else if(params.loading == 2){
                scope.info.loading = b;
            }else{

            }
        }
    };

    this.sessionStore = (function(){
        return {
            set:function(name,data){
                if(typeof(data)==='object'){
                    sessionStorage.setItem(name,JSON.stringify(data));
                }else{
                    sessionStorage.setItem(name,data);
                }
            },
            get:function(name){
                try{
                    return JSON.parse(sessionStorage.getItem(name));
                }catch(e){
                    return sessionStorage.getItem(name);
                }
            }
        }
    })();
    return this;
});
module.service("column", function(){
    var that = this;
    that.chart = function () {
        this.chartConfig = {
            chart: {
                type: 'column',
                margin: [20, 0, 40, 70]
            },
            title: {
                text: '',
                style:{
                    fontSize: '14px'
                }
            },
            colors: ['#727AC9'],
            tooltip: {
                //enabled: false
                headerFormat: '<span style="color: {point.color}">{point.key}</span>：',
                pointFormat: '{point.y:.2f} BTC'
            },
            //plotOptions: {
            //    series: {
            //        borderWidth: 0,
            //        dataLabels: {
            //            enabled: true,
            //            format: '{point.y}',
            //            style:{
            //                color:"#979797",
            //                textShadow:"0 0 0px rgba(0,0,0,0), 0 0 0px rgba(0,0,0,0)",
            //                fontWeight:"normal"
            //            },
            //            inside:false
            //        }
            //        //pointWidth:80
            //    }
            //},
            xAxis: {
                type: 'category',
                //type: 'datetime',
                //dateTimeLabelFormats: {
                //    //second: '%Y-%m-%d<br/>%H:%M:%S',
                //    //minute: '%Y-%m-%d<br/>%H:%M',
                //    //hour: '%H:%M',
                //    //day: '%m月%d日',
                //    //week: '%Y-%m-%d',
                //    //month: '%Y-%m',
                //    //year: '%Y'
                //},
                lineColor: '#E6E6E6',
                lineWidth: 2,
                //categories: [1,2,3,4,5,6],
                gridLineWidth: 0, //纵向网格线宽度
                labels: {
                    align: 'center',
                    enabled: true, //是否显示x轴标签
                    style: {
                        //color:"#979797"
                    }
                },
                tickWidth: 1,
                //tickInterval: 3600000*24*3,
                //tickPixelInterval: 150,
                tickColor: '#E6E6E6',
                tickLength: 5,
                //allowDecimals: false, //是否允许小数
                //endOnTick: true
            },
            yAxis: {
                //min: 0,
                //tickPositions: [],
                title: {
                    text: '' //y轴
                },
                gridLineDashStyle: 'Dash',
                gridLineColor: '#E6E6E6', //纵向网格线颜色
                gridLineWidth: 1, //纵向网格线宽度
                labels:{
                    format: '{value}',
                    style: {
                        color:"#979797"
                    }
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                //lineWidth: 0,
                colorByPoint: true,
                //negativeColor: '#F6A623', //设置负值的颜色
                data: [],
                //dataLabels:{
                //    style:{
                //        textShadow:"0 0 3px #fff",
                //        color:'#6f6969'
                //    }
                //    //y:-20
                //}
            }],
            loading: false,
            useHighStocks: false,
            credits: {
                enabled: false
            }
        };
        that.chart.prototype.xList = function (arr) {
            if (typeof (arr) == "undefined") {
                return this.chartConfig.xAxis.categories;
            } else {
                this.chartConfig.xAxis.categories = arr;
            }
        };
        that.chart.prototype.colors = function (colors) {
            if (typeof (colors) == "undefined") {
                return this.chartConfig.colors;
            } else {
                this.chartConfig.colors = colors;
            }
        };
        that.chart.prototype.data = function (data) {
            if (typeof (data) == "undefined") {
                return this.chartConfig.series[0].data;
            } else {
                this.chartConfig.series[0].data = data;
            }
        };
        that.chart.prototype.unit = function(unit) {
            if (typeof (unit) == "undefined") {
                return this.chartConfig.yAxis.title.text;
            } else {
                this.chartConfig.yAxis.title.text = unit;
            }
        };
        that.chart.prototype.startDate = function (date) {
            if (typeof (date) == "undefined") {
                return this.chartConfig.series[0].pointStart;
            } else {
                this.chartConfig.series[0].pointStart = date;
            }
        };
        that.chart.prototype.tickInterval = function (num) {
            if (typeof (num) == "undefined") {
                return this.chartConfig.xAxis.tickInterval;
            } else {
                this.chartConfig.xAxis.tickInterval = num;
            }
        };
    };
    Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    })
});

module.filter("htmlTag", ['$sce', function($sce) {
    return function(htmlCode){
        return $sce.trustAsHtml(htmlCode);
    };
}]);

module.directive('resize', function ($window) {
    return {
        restrict : 'A',
        scope : {
            mobileW: '='
        },
        link : function(scope, element, attrs) {
            var w = angular.element($window);
            scope.getWindowDimensions = function () {
                return { 'h': w[0].innerHeight, 'w': w[0].innerWidth };
            };
            scope.$watch(scope.getWindowDimensions, function (newValue, oldValue) {

                scope.mobileW = newValue.w;

            }, true);

            w.bind('resize', function () {
                scope.$apply();
            });
        }
    };
});

module.controller('BTCFundCtrl', ['$scope', '$http', '$timeout', '$q', '$', '$translate', 'T', 'column', function($scope, $http, $timeout, $q , $, $translate, T, column){

    $scope.g = {
        isLogin: window.isLogin,
        currLang: window.localStorage.lang || 'en',
        info: {
            account: !!window.account ? window.account : ''
        },
        switching: function(){
            var lang = ($scope.g.currLang == 'en' ? 'cn' : 'en');
            $translate.use(lang);
            window.localStorage.lang = $scope.g.currLang = lang;
            $http.get("../common/data/switch.language.php").then(function (res) {
                if (res.data.resultCode == 0) {
                    console.log(res);
                    $scope.g.mobileNav = false;
                } else {
                    //
                }
            });
        },
        logout: function(){
            $http.get("../common/data/logout.php").then(function (res) {
                if(res.data.resultCode == 0 || res.data.logout){
                    window.location.href = '/';
                } else {
                    //
                }
            });
        },
    };

    $scope.info = {
        column : new column.chart(),
        activityInfo:'',//活动信息
        userButInfo:'',//用户BUT信息
        isLogin:false,//是否登录
        isLogin2: window.isLogin,
        isReal:false,//是否认证
        profit:5,//收益起始
        minProfit:0,
        maxProfit:0,
        profitTab:'',//基金日收益
        myProfitTab:'',//我的日收益
        ranTab:'',//昨日排行
        totalRanTab:'',//历史总排行
        item1:'',//表格1循环的数据
        item2:'',//表格2村换的数据
        tabNum1:'profitTab',
        tabNum2:'ranTab',
        lockNum:250000,
        unLockNum:0,
        tabList1: {
            //'myProfitTab':$translate.instant('100329'),
            'profitTab':$translate.instant('100330')
        },
        tabList2: {
            'ranTab':$translate.instant('100333'),
            'totalRanTab':$translate.instant('100334')
        },
        goLogin:function () {
            window.location.href = this.isLogin2 ? '/dashboard/88btc/index' : '/login/';
        },
        goState: function(url){
            $state.go(url);
        },
        goShare:function () {

        },
        switchData:function (item,val) {
            $scope.info[item] = $scope.info[val];
            if(item == 'item1'){
                $scope.info.tabNum1 = val;
            }else{
                $scope.info.tabNum2 = val;
            }
        }
    };

    //demo
    $scope.info.column.colors(['#03BCC0']);
    //$scope.info.column.xList(['04.07', '04.08', '04.09', '04.10', '04.11', '04.12', '04.13', '04.14', '04.15', '04.16', '04.17', '04.18', '04.19', '04.20']);
    //$scope.info.column.data([20.39, 18.48, {y: 8.77, color: '#F6A623'}, 10.68, 20.39, 18.48, {y: 8.77, color: '#F6A623'}, 10.68, 20.39, 18.48, {y: 8.77, color: '#F6A623'}, 10.68, 2.33, 5.00]);

    //监听拖动条
    $scope.$watch('info.profit',function (newVal) {
        $scope.info.minProfit = 88*0.04*(newVal/3000);
        $scope.info.minProfit = $scope.info.minProfit.toFixed(8);
        $scope.info.maxProfit = 88*0.12*(newVal/3000);
        $scope.info.maxProfit = $scope.info.maxProfit.toFixed(8);

        console.log(newVal);
    });

    //获取活动参与量信息
    $http.post("/app/modules/dashboard/88btc/data/btcfund.info.php",{}).then(function (res) {
        if(res.data.resultCode == 0){
            $scope.info.activityInfo = res.data.data;
            return false;
        }
    },function () {
        $scope.g.tip('','server error');
    });

    //获取基金日收益
    $http.post("/app/modules/dashboard/88btc/data/dac.daily.profit.php",{}).then(function (res) {
        if(res.data.resultCode == 0){
            //$scope.info.profitTab = res.data.data;
            $scope.info.item1 = res.data.data.reverse();
            $scope.info.tabNum1 = 'profitTab';

            $scope.info.column.xList(res.data.x_list);
            var yList = [];
            for(var i in res.data.y_list){
                if(res.data.y_list[i] < 0){
                    yList[i] = {};
                    yList[i]['y'] = -(res.data.y_list[i]);
                    yList[i]['color'] = '#F6A623';
                }else{
                    yList[i] = res.data.y_list[i];
                }
            }
            $scope.info.column.data(yList);
            console.log(yList);
        }
        // $scope.g.tip('Err:resultCode '+res.data.resultCode,res.data.errMsg);
    },function () {
        $scope.g.tip('','server error');
    });

    //获取昨日排行榜
    $http.post("/app/modules/dashboard/88btc/data/yesterday.profit.top10.php",{}).then(function (res) {
        if(res.data.resultCode == 0){
            $scope.info.ranTab = res.data.data;
            $scope.info.item2 = $scope.info.ranTab;
            return false;
        }
    },function () {
        $scope.g.tip('','server error');
    });

    //获取历史总排行榜
    $http.post("/app/modules/dashboard/88btc/data/dac.total.profit.top10.php",{}).then(function (res) {
        if(res.data.resultCode == 0){
            $scope.info.totalRanTab = res.data.data;
            return false;
        }
    },function () {
        $scope.g.tip('','server error');
    });
}]);
