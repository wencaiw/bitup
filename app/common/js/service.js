/**
 * Created by Hajay on 2018/4/13.
 */

var module = angular.module('BitUP');

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

/**
 * 复制功能
 */
module.directive('ngCopyable', function($document) {
    return {
        restrict: 'A',
        scope: {
            copyText: '=',
            g: '='
        },
        link: function(scope, element, attrs){
            //点击事件
            element.bind('click', function(){
                //创建将被复制的内容
                $document.find('body').eq(0).append('<div id="ngCopyableId">' + scope.copyText + '</div>');
                var newElem = angular.element(document.getElementById('ngCopyableId'))[0];

                var range = document.createRange();
                range.selectNode(newElem);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                var successful = document.execCommand('copy');

                //执行完毕删除
                var oldElem = document.getElementById('ngCopyableId');
                oldElem.parentNode.removeChild(oldElem);
                window.getSelection().removeAllRanges();

                //提示
                if (successful) {
                    //alert('已成功复制：' + scope.copyText);
                    if(scope.g){
                        scope.g.tip("message","Copy success");
                    }
                } else {
                    if(scope.g){
                        scope.g.tip("message","Browsers do not support");
                    }
                }

            });
        }

    };
});

/**
 * @params
 *   loding: 加载1:共用g.loading 加载2:info.loading
 *   method: GET POST
 *   url: 请求地址
 *   data: 请求数据{}
 * @scope
 *   $scope.g
 */
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
        });
        //    .catch(function () {
        //    loading(false);
        //    scope.g.tip("message", "network failure");
        //});

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

/**
 * 获取用户页面共享信息
 */
module.factory("userInfo", ['$http', '$timeout', '$q', '$state', '$', function ($http, $timeout, $q, $state, $) {
    var userInfo = {
        data: null,
        defer: null,
        lastUpdate: null,
        refresh: function (params) {
            var defer = $q.defer();
            var that = this;
            this.defer = $http.post('app/common/data/get.user.info.php', params).then(function (res) {
                if (res.data.resultCode != 0) {
                    if(res.data.logout){
                        window.location.href = '/login/?return_url=' + encodeURIComponent(window.location.href);
                        return;
                    }else{
                        //$scope.g.tip("message",res.data.errMsg);
                        defer.reject();
                    }
                } else {
                    that.data = angular.copy(res.data.data);
                    defer.resolve(that);
                }
            }).catch(function () {
                defer.reject();
            });
            this.lastUpdate = defer.promise;
            return defer.promise;
        },
        get: function () {
            return this.lastUpdate;
        }
    };
    userInfo.refresh();
    return userInfo;
}]);

/**
 * 获取币费率 usd
 */
module.factory("usdRatio", ['$http', '$timeout', '$q', '$state', '$', function ($http, $timeout, $q, $state, $) {
    var userInfo = {
        data: null,
        defer: null,
        lastUpdate: null,
        refresh: function (params) {
            var defer = $q.defer();
            var that = this;
            this.defer = $http.post('app/common/data/get.coin.ratio.php', params).then(function (res) {
                if (res.data.resultCode != 0) {
                    defer.reject();
                } else {
                    that.data = angular.copy(res.data.data);
                    defer.resolve(that);
                }
            }).catch(function () {
                defer.reject();
            });
            this.lastUpdate = defer.promise;
            return defer.promise;
        },
        get: function () {
            return this.lastUpdate;
        }
    };
    userInfo.refresh();
    return userInfo;
}]);

module.service('ZipImage', function($q) {
    var dataURItoBlob = function(dataURI) {
        // convert base64/URLEncoded data component to raw binary data held in a string
        var byteString;
        if (dataURI.split(',')[0].indexOf('base64') >= 0)
            byteString = atob(dataURI.split(',')[1]);
        else
            byteString = unescape(dataURI.split(',')[1]);

        // separate out the mime component
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

        // write the bytes of the string to a typed array
        var ia = new Uint8Array(byteString.length);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }

        return new Blob([ia], {
            type: mimeString
        });
    };

    var resizeFile = function(file) {
        console.log(12);
        console.log(file);
        var deferred = $q.defer();
        var img = document.createElement("img");
        try {
            var reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;

                //resize the image using canvas
                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0);
                var MAX_WIDTH = 800;
                var MAX_HEIGHT = 800;
                var width = img.width;
                var height = img.height;
                if (width > height) {
                    if (width > MAX_WIDTH) {
                        height *= MAX_WIDTH / width;
                        width = MAX_WIDTH;
                    }
                } else {
                    if (height > MAX_HEIGHT) {
                        width *= MAX_HEIGHT / height;
                        height = MAX_HEIGHT;
                    }
                }
                canvas.width = width;
                canvas.height = height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, width, height);

                //change the dataUrl to blob data for uploading to server
                var dataURL = canvas.toDataURL('image/jpeg');
                var blob = dataURItoBlob(dataURL);

                deferred.resolve(blob);
            };
            reader.readAsDataURL(file);
        } catch (e) {
            deferred.resolve(e);
        }
        return deferred.promise;

    };
    return {
        resizeFile: resizeFile
    };

});

/**
 * chart
 * line (折线图)
 * column (矩形图)
 * pie (饼图)
 */
module.service("line", function(){
    var that = this;
    that.chart = function () {
        this.chartConfig = {
            chart: {
                type: 'line', //spline line areaspline
                margin: [20, 0, 40, 70],
                paddingTop: 100
            },
            colors: ['#F16358'],
            legend: { //方块部分
                enabled: false,
                //layout: 'default', // default  horizontal  vertical
                // width: 100,
                // itemWidth: 100,
                //symbolHeight: 10,
                //symbolWidth: 100,
                // symbolRadius: 0,
                // lineHeight: 54,
                padding: 10,
                // symbolPadding: 10,
                // floating: false,
                align: 'right',
                verticalAlign: 'top'
            },
            xAxis: {
                type: 'datetime',
                //dateTimeLabelFormats: {
                //    //second: '%Y-%m-%d<br/>%H:%M:%S',
                //    //minute: '%Y-%m-%d<br/>%H:%M',
                //    hour: '%H:%M',
                //    //day: '%m月%d日',
                //    //week: '%Y-%m-%d',
                //    //month: '%Y-%m',
                //    //year: '%Y'
                //},
                //type: 'category',
                //categories: [1, 2, 3],
                //gridLineWidth: 0, //纵向网格线宽度
                lineColor: '#E6E6E6',
                lineWidth: 2,
                labels: {
                    align: 'center',
                    //enabled: true, //是否显示x轴标签
                    style: {
                        //color:"#979797"
                    },
                    overflow: 'justify'
                    //formatter: function () {
                    //    return Highcharts.dateFormat('%Y-%m-%d',this.value);
                    //},
                    //rotation:30,//倾斜30度，防止数量过多显示不全
                },
                tickWidth: 1,
                tickInterval: 3600000*24,
                //tickPixelInterval: 150,
                tickColor: '#E6E6E6',
                tickLength: 5,
                crosshair: {
                    color: '#cccccc',
                    dashStyle: 'Solid', //Solid ShortDash ShortDot ShortDashDot ShortDashDotDot Dot Dash LongDash DashDot LongDashDot LongDashDotDot
                    width: 1
                },
                allowDecimals: false, //是否允许小数
                //endOnTick: true,
                //showLastLabel: true,
            },
            yAxis: {
                min: 0,
                //tickPositions: [],
                title: {
                    text: '' //y轴
                },
                gridLineDashStyle: 'Dash',
                gridLineColor: '#E6E6E6', //纵向网格线颜色
                gridLineWidth: 1, //纵向网格线宽度
                labels:{
                    format: '${value}',
                    style: {
                        //color:"#979797"
                    }
                }
            },
            //tooltip: {
            //    shared: true,
            //    valueSuffix: ' 元'  //单位
            //},
            plotOptions:{
                line:{
                    marker: {
                        radius: 0
                    }
                }
            },
            series: [{
                name: 'BPP',
                lineWidth: 1,
                pointInterval: 3600000,  //一个小时一个点
                pointStart: Date.UTC(2014,6,10,0),
                //pointEnd: Date.UTC(2014,6,10,23),
                data: [21, 12, 13, 17, 32, 21, 77, 52, 41,66,101,45,51, 34, 65, 90,231, 111, 120, 55, 23, 21, 14, 11]
            }],
            title: {
                text: ''
            },
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
        that.chart.prototype.yList = function (data) {
            if (typeof (data) == "undefined") {
                return this.chartConfig.series[0].data;
            } else {
                this.chartConfig.series[0].data = data;
            }
        };
        that.chart.prototype.startDate = function (date) {
            if (typeof (date) == "undefined") {
                return this.chartConfig.series[0].pointStart;
            } else {
                this.chartConfig.series[0].pointStart = date;
            }
        };
        that.chart.prototype.pointInterval = function (date) {
            if (typeof (date) == "undefined") {
                return this.chartConfig.series[0].pointInterval;
            } else {
                this.chartConfig.series[0].pointInterval = date;
            }
        };
        that.chart.prototype.tickInterval = function (num) {
            if (typeof (num) == "undefined") {
                return this.chartConfig.xAxis.tickInterval;
            } else {
                this.chartConfig.xAxis.tickInterval = num;
            }
        };
        that.chart.prototype.yMin = function (num) {
            if (typeof (num) == "undefined") {
                return this.chartConfig.yAxis.min;
            } else {
                this.chartConfig.yAxis.min = num;
            }
        };
    };
    Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    })
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
module.service("pie", function(){
    var that = this;
    that.chart = function () {
        this.chartConfig = {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                margin: [0, 0, 35, 0]
            },
            title: {
                text: ''
            },
            colors: ['#F5B35D', '#8CCE6F', '#5FCEFA', '#ED694D', '#ED694D'],
            tooltip: {
                headerFormat: '<span style="color: {point.color}">{point.key}</span><br>',
                pointFormat: '$ {point.y} <br>{point.percentage:.2f}%'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false,
                        //format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        //style: {
                        //    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        //}
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                //name: '浏览器占比',
                data: [
                    ['ETH', 1000],
                    ['BPP1', 589],
                    //{
                    //    name: 'Chrome',
                    //    y: 12.8,
                    //    sliced: true,
                    //    selected: true
                    //},
                    ['BPP2', 900],
                    ['BTC', 156]
                ]
            }],
            loading: false,
            useHighStocks: false,
            credits: {
                enabled: false
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
    };
    Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    })
});
module.service("area", function(){
    var that = this;
    that.activeLastPointToolip = function(chart){
        var points = chart.series[0].points;
        chart.tooltip.refresh(points[points.length -1]);
    };
    that.chart = function () {
        this.chartConfig = {
            chart: {
                type: 'area', //spline line areaspline
                margin: [10, 0, 40, 0],
                marginRight: 80,
                paddingTop: 100,
                events: {
                    //load:
                },
                zoomType: 'x'
            },
            mapNavigation: {
                enabled: true,
                enableButtons: false
            },
            colors: ['#03BCC0'],
            legend: { //方块部分
                enabled: false,
                //layout: 'default', // default  horizontal  vertical
                // width: 100,
                // itemWidth: 100,
                //symbolHeight: 10,
                //symbolWidth: 100,
                // symbolRadius: 0,
                // lineHeight: 54,
                padding: 10,
                // symbolPadding: 10,
                // floating: false,
                align: 'right',
                verticalAlign: 'top'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    millisecond: '%H:%M:%S.%L',
                    second: '%H:%M:%S',
                    minute: '%H:%M',
                    hour: '%H:%M',
                    day: '%m-%d',
                    week: '%m-%d',
                    month: '%Y-%m',
                    year: '%Y'
                },
                //type: 'category',
                //categories: [1, 2, 3],
                gridLineDashStyle: 'Solid',
                gridLineColor: 'rgba(242, 243, 248, 0.7)', //纵向网格线颜色
                gridLineWidth: 2, //纵向网格线宽度
                lineColor: 'rgba(242, 243, 248, 0.7)',
                lineWidth: 2,
                labels: {
                    align: 'center',
                    //enabled: true, //是否显示x轴标签
                    style: {
                        //color:"#979797"
                    },
                    overflow: 'justify'
                    //formatter: function () {
                    //    return Highcharts.dateFormat('%Y-%m-%d',this.value);
                    //},
                    //rotation:30,//倾斜30度，防止数量过多显示不全
                },
                tickWidth: 0,
                tickInterval: 3600000*3,
//                tickInterval: 5000,
                //tickPixelInterval: 150,
//                tickColor: '#E6E6E6',
//                tickLength: 5,
                crosshair: {
                    color: 'rgba(79, 100, 117, 0.7)',
                    dashStyle: 'Dash', //Solid ShortDash ShortDot ShortDashDot ShortDashDotDot Dot Dash LongDash DashDot LongDashDot LongDashDotDot
                    width: 1
                },
                allowDecimals: false, //是否允许小数
                //endOnTick: true,
                //showLastLabel: true,
            },
            yAxis: {
//                lineWidth: 1,
//                floor: 50,   //下限 极端值处理
//                ceiling: 100,  //上限
                opposite: true,
//                min: 0,  //最小值
//                max: 100,  //最大值
                //tickPositions: [],
                title: {
                    text: '' //y轴
                },
                gridLineDashStyle: 'Solid',
                gridLineColor: 'rgba(242, 243, 248, 0.7)', //纵向网格线颜色
                gridLineWidth: 2, //纵向网格线宽度
                labels:{
                    format: '{value}',
                    style: {
                        //color:"#979797"
                    }
                },
                crosshair: {
                    color: 'rgba(79, 100, 117, 0.7)',
                    dashStyle: 'Dash', //Solid ShortDash ShortDot ShortDashDot ShortDashDotDot Dot Dash LongDash DashDot LongDashDot LongDashDotDot
                    width: 1
                }
            },
            tooltip: {
                enabled: false
                //shared: true,
                //valueSuffix: ' 元'  //单位
            },
            plotOptions:{
                line:{
                    marker: {
                        radius: 0
                    }
                },
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, 'rgba(3,188,192,0.49)'],
                            [1, 'rgba(3,188,192,0.00)']
                        ]
                    },
                    marker: {
                        radius: 0
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
            series: [{
                turboThreshold: 27000,  //显示点数量上限
                name: ' ',
//                lineWidth: 1,
                pointInterval: 3600000,  //一个小时一个点
                pointStart: Date.UTC(2014,6,10,0),
//                threshold: 100,  //设置原点
                //pointEnd: Date.UTC(2014,6,10,23),
//                data: [21, 12, 13, 17, 32, 21, 77, 52, 41,66,101,45,51, 34, 65, 90,231, 111, 120, 55, 23, 21, 14, 11]
                data: [{}]
            }],
            title: {
                text: ''
            },
            loading: false,
            useHighStocks: false,
            credits: {
                enabled: false
            }
        };
        that.chart.prototype.tickInterval = function (num) {
            if (typeof (num) == "undefined") {
                return this.chartConfig.xAxis.tickInterval;
            } else {
                this.chartConfig.xAxis.tickInterval = num;
            }
        };
        that.chart.prototype.name = function (data) {
            if (typeof (data) == "undefined") {
                return this.chartConfig.series[0].name;
            } else {
                this.chartConfig.series[0].name = data;
            }
        };
        that.chart.prototype.data = function (data) {
            if (typeof (data) == "undefined") {
                return this.chartConfig.series[0].data;
            } else {
                this.chartConfig.series[0].data = data;
                this.chartConfig.tooltip.enabled = true;
            }
        };
        that.chart.prototype.pointsData = function (data) {
            if (typeof (data) == "undefined") {
                return this.chartConfig.chart.events.load;
            } else {
                this.chartConfig.chart.events.load = data;
            }
        };
    };
    Highcharts.setOptions({
        global: {
            useUTC: false
        }
    })
});
module.service("simpleLine", function(){
    var that = this;
    that.chart = function () {
        this.chartConfig = {
            chart: {
                type: 'line', //spline line area areaspline
                margin: [20, 0, 20, 0],
                //marginRight: 80,
                //paddingTop: 100,
            },
            colors: ['#03BCC0'],
            legend: { //方块部分
                enabled: false,
                padding: 10,
                align: 'right',
                verticalAlign: 'top'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    millisecond: '%H:%M:%S.%L',
                    second: '%H:%M:%S',
                    minute: '%H:%M',
                    hour: '%H:%M',
                    day: '%m-%d',
                    week: '%m-%d',
                    month: '%Y-%m',
                    year: '%Y'
                },
                gridLineWidth: 0, //纵向网格线宽度
                lineWidth: 1,
                lineColor: '#eee',
                labels: {
                    align: 'center',
                    enabled: true, //是否显示x轴标签
                    style: {
                        color:"#83929F"
                    },
                    overflow: 'justify'
                },
                tickWidth: 1,
                tickInterval: 3600000*24,
                tickColor: '#ddd',
                tickLength: 6,
                allowDecimals: false, //是否允许小数
            },
            yAxis: {
                opposite: true,
                title: {
                    text: '' //y轴
                },
                gridLineWidth: 0, //纵向网格线宽度
                labels:{
                    enabled: false //是否显示y轴标签
                }
            },
            tooltip: {
                enabled: false
            },
            plotOptions:{
                line:{
                    lineWidth: 1,
                    enableMouseTracking: false,
                    marker: {
                        radius: 0,
                        states: {
                            hover: {
                                enabled: false,
                                lineWidth: 1
                            }
                        }
                    }
                }
            },
            series: [{
                turboThreshold: 5000,
                pointStart: Date.UTC(2014,6,10,0),
                data: (function () {
                    // 生成随机值
                    var data = [],
                        time = (new Date()).getTime(),
                        i;
                    for (i = -50; i <= 0; i ++) {
                        data.push({
                            x: time + i * 1000,
                            y: 1 + Math.random()
                        });
                    }
                    return data;
                }())
            }],
            title: {
                text: ''
            },
            loading: false,
            useHighStocks: false,
            credits: {
                enabled: false
            }
        };
        that.chart.prototype.tickInterval = function (num) {
            if (typeof (num) == "undefined") {
                return this.chartConfig.xAxis.tickInterval;
            } else {
                this.chartConfig.xAxis.tickInterval = num;
            }
        };
        that.chart.prototype.data = function (data) {
            if (typeof (data) == "undefined") {
                return this.chartConfig.series[0].data;
            } else {
                this.chartConfig.series[0].data = data;
            }
        };
    };
});
/**
 * 浮点精度计算
 */
module.service("math", function(){
    this.f = function(a, b, type){
        var pow = 1,
            aArr = a.toString().split('.'),
            bArr = b.toString().split('.'),
            aLength = !!aArr[1] ? aArr[1].length : 0,
            bLength = !!bArr[1] ? bArr[1].length : 0;
        if(aLength > bLength){
            pow = Math.pow(10, aLength);
        }else{
            pow = Math.pow(10, bLength);
        }
        switch (type){
            case '+':
                return (a * pow + b * pow) / pow;
                break;
            case '-':
                return (a * pow - b * pow) / pow;
                break;
            case '*':
                return ((a * pow) * (b * pow)) / pow / pow;
                break;
            case '/':
                return ((a * pow) / (b * pow));
                break;
            default:
                return null;
                break;
        }
    };
});

module.filter('trim', function() {
    return function(value) {
    return !value ? '': value.split(" ").join("");
    //return value = value.split(" ").join("");
    }
  });
module.filter('d_hms', function() {
    return function(value) {
        value = parseInt(value/1000);
        //var day = Math.floor((value / 3600) / 24);
        //if(day < 0){
        //    day = 0;
        //}
        //var hour = Math.floor((value / 3600) % 24);
        var hour = Math.floor(value / 3600);
        if(hour < 0){
            hour = 0;
        }
        var minute = Math.floor((value / 60) % 60);
        if(minute < 0){
            minute = 0;
        }
        var second = Math.floor(value % 60);
        if(second < 0){
            second = 0;
        }
        //return (day>0 ? day+'天 ' : '') + (hour<10 ? '0'+hour : hour) + ':' + (minute<10 ? '0'+minute : minute) + ':' + (second<10 ? '0'+second : second);
        return (hour<10 ? '0'+hour : hour) + ':' + (minute<10 ? '0'+minute : minute) + ':' + (second<10 ? '0'+second : second);
    }
});
module.filter("htmlTag", ['$sce', function($sce) {
    return function(htmlCode){
        htmlCode = (!htmlCode ? '': htmlCode.split("\n").join("<br>"));
        return $sce.trustAsHtml(htmlCode);
    };
}]);
/**
 * 币保留位数控制
 */
module.constant('coinDecimal', {
    BTC: 8,
    ETH: 8,
    BUT: 4,
    USDT: 4
});
module.filter('coinNum', function(coinDecimal){
    return function(value, coin){
        if((!value && value !=0) || !coin) return;
        var c = {
            list: coinDecimal,
            arr: parseFloat(value).toString().split('.'),
            init: function(){
                var arr = this.arr,
                    num = this.list[coin.toUpperCase()],
                    rtn = parseFloat(value).toFixed(num);

                if(value == 0){
                    return parseFloat(0).toFixed(num);
                }else{
                    if(arr.length == 1){
                        return rtn;
                    }else if(arr.length > 1){
                        if(arr[1].length <= num){
                            return rtn;
                        }else{
                            //if(parseInt(arr[1].substr(num-1, 1)) >= 5){
                                return arr[0] + '.' + arr[1].substr(0, num);
                            //}else{
                            //    return rtn;
                            //}
                        }
                    }else{
                        return '';
                    }
                }
            }
        };
        return c.init();
    };
});

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
module.directive("tip",function(){
    return {
        restrict:"E",
        scope: {
            error: "="
        },
        template: '<div class="form-tip" ng-show="error"><span>{{error}}</span></div>'
    }
});
module.directive("fundsCircle",function($timeout, $interval){
    return {
        restrict : 'E',
        template: '<div class="funds-circle">'+
        '<svg class="c-svg" width="144" height="144" version="1.1" xmlns="http://www.w3.org/2000/svg">'+
        '<circle r="70" cx="72" cy="72" stroke-width="1" stroke="#F1EDE9" fill="none"></circle>'+
        '<circle class="c-bar" ng-style="proCircleStyle" r="70" cx="72" cy="72" stroke-width="3" stroke="#FFAE3A" stroke-dasharray="439.6" stroke-dashoffset="439.6" fill="none"></circle>'+
        '</svg>'+
        '<div class="ball" ng-style="proBallStyle"><div ng-style="proValStyle" ng-bind="progress"></div></div>'+
        '</div>',
        replace:true,
        scope : {
            config: '='
        },
        link : function(scope, element, attrs) {
            /**
             * config 分页属性对象
             *     per:        占比(百分比)
             *     r:          半径
             */
            scope.config.r = 70;                           //半径70
            var _this = scope.config;
            scope.svgWidth = _this.r * 2 + 4;
            scope.svgHeight = _this.r * 2 + 4;
            scope.deg = 360 * _this.per / 100;             //占比换算成角度
            scope.perimeter = Math.PI * (_this.r * 2);     //圆周长

            scope.proCircleStyle = {
                'stroke-dashoffset': scope.perimeter,
                'display': 'block'
            };

            $timeout(function(){
                var pct = ((100 - _this.per) / 100) * scope.perimeter;
                var moveTime = _this.per/100 * 5;

                scope.proBallStyle = {
                    transform: 'rotate('+ 360*_this.per/100 +'deg)',
                    transition: 'transform '+ moveTime +'s linear'
                };
                scope.proValStyle = {
                    transform: 'rotate(-'+ 360*_this.per/100 +'deg)',
                    transition: 'transform '+ moveTime +'s linear'
                };
                scope.proCircleStyle['stroke-dashoffset'] = pct;
                scope.proCircleStyle.transition = 'stroke-dashoffset '+ moveTime +'s linear';

                var o = 0;
                var timer = $interval(function(){
                    scope.progress = o + '%';
                    if(o >= _this.per){
                        $interval.cancel(timer);
                    }
                    o++;
                }, moveTime/_this.per * 1000);
            }, 10)

        }
    };
});
module.directive("btLoading",function(){
    return {
        restrict : 'E',
        template: '<div class="bt-loading"><div class="bt-loading-wrap" ng-style="sty"><div></div><div></div></div></div>',
        replace:true,
        scope : {
            h: '='
        },
        link : function(scope, element, attrs) {
            /**
             *     h:
             */
            //scope.h = !!scope.h ? scope.h : 50;
            scope.sty = {
                width: scope.h + 'px',
                height: scope.h + 'px'
            };
        }
    };
});
module.directive('go', function () {
    return {
        restrict : 'A',
        scope : {},
        link : function(scope, element, attrs) {
            element[0].onclick = function(){
                window.location.href = attrs.go;
                //window.open(attrs.go,'_blank');
            }
        }
    };
});
/**
 * 绑定带angular 指令的html内容
 */
module.directive("compile", ['$compile', function($compile) {
    return {
        scope: {
            compile: '='
        },
        link: function(scope, elem, attrs) {
            scope.$watch('compile', function (newVal,oldVal) {
                elem.html($compile(newVal)(scope));
            });

        }
    };
}]);