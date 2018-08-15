/**
 * Created by Hajay on 2018/4/20.
 */

module.exports = {
    url: '/index',
    views: {
        '88btc': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', 'column' , '$translate' , function($scope, $http, $cookies, $state, $ , userInfo, column, $translate){
                $scope.g.currPage = '88btc';
                $scope.info = {
                    column : new column.chart(),
                    lang:'en',
                    user: $scope.g.info,
                    activityInfo:'',//活动信息
                    userButInfo:'',//用户BUT信息
                    isLogin:true,//是否登录
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
                    tabNum1:'myProfitTab',
                    tabNum2:'totalRanTab',
                    lockNum:50000,
                    unLockNum:0,
                    min:50000,
                    //tabList1: {
                    //    'myProfitTab':$translate.instant('100329'),
                    //    'profitTab':$translate.instant('100330')
                    //},
                    //tabList1_: {
                    //    'profitTab':$translate.instant('100330')
                    //},
                    //tabList2: {
                    //    'ranTab':$translate.instant('100333'),
                    //    'totalRanTab':$translate.instant('100334')
                    //},
                    goLogin:function () {
                        $state.go('dashboard.88btc.index');
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
                    },
                    lock:function () {
                        //<=0或非数字类型
                        if($scope.info.lockNum<=0 || typeof $scope.info.lockNum !== 'number'){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300010'));
                            return false;
                        }
                        //已参与总数+锁定数<250000（变量）
                        if($scope.info.userButInfo.total_amount+$scope.info.lockNum<$scope.info.min){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300001'));
                            return false;
                        }
                        //小于1000
                        if($scope.info.lockNum<1000 && $scope.info.lockNum){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300002'));
                            return false;
                        }
                        //锁定数于大于账户余额
                        if($scope.info.lockNum>$scope.info.coinBalances.but.free){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300000'));
                            return false;
                        }
                        //锁定数>剩余可参与额度
                        if($scope.info.lockNum>$scope.info.userButInfo.available_amount){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300003'));
                            return false;
                        }

                        //锁定
                        $.ajax({
                            loading: 2,
                            method: 'post',
                            data: {
                                amount:$scope.info.lockNum
                            },
                            url: 'app/modules/dashboard/88btc/data/lock.but.php',
                            success: function(res){
                                $scope.info.refreshData('lock');
                                $scope.g.tip($translate.instant('300008'),$translate.instant('300009'),function () {
                                    window.location.reload(true);
                                });
                            },
                            error:function(res){
                                if(res.data.resultCode>=300000){
                                    $scope.g.tip($translate.instant('300008'),$translate.instant(res.data.resultCode));
                                }
                                else {
                                    $scope.g.tip($translate.instant('300008'), res.data.errMsg);
                                }
                            }
                        },$scope);
                    },
                    unLock:function () {
                        //<=0
                        if($scope.info.unLockNum<=0 || typeof $scope.info.unLockNum !== 'number'){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300010'));
                            return false;
                        }
                        //解锁数>可解锁数
                        if($scope.info.unLockNum>$scope.info.userButInfo.free){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300005'));
                            return false;
                        }
                        //可解锁数-解锁数<250000 && 可解锁数<已参与总数(有一部分是冻结状态)
                        if($scope.info.userButInfo.free-$scope.info.unLockNum<$scope.info.min && $scope.info.userButInfo.free < $scope.info.userButInfo.total_amount){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300006'));
                            return false;
                        }
                        //解锁数>已参与总数-250000 && 解锁数!=已参与总数（不是全解锁） && 可解锁数==已参与总数（没有冻结状态）
                        if($scope.info.unLockNum>$scope.info.userButInfo.total_amount-$scope.info.min && $scope.info.unLockNum!=$scope.info.userButInfo.total_amount && $scope.info.userButInfo.free == $scope.info.userButInfo.total_amount){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300006'));
                            return false;
                        }
                        //小于1000
                        if($scope.info.unLockNum<1000){
                            $scope.g.tip($translate.instant('300008'),$translate.instant('300007'));
                            return false;
                        }
                        //解锁
                        $.ajax({
                            loading: 2,
                            method: 'post',
                            data: {
                                amount:$scope.info.unLockNum
                            },
                            url: 'app/modules/dashboard/88btc/data/unlock.but.php',
                            success: function(res){
                                $scope.info.refreshData('unlock');
                                $scope.g.tip($translate.instant('300008'),$translate.instant('300009'),function () {
                                    window.location.reload(true);
                                });
                            },
                            error:function(res){
                                if(res.data.resultCode>=300000){
                                    $scope.g.tip($translate.instant('300008'),$translate.instant(res.data.resultCode));
                                }
                                else {
                                    $scope.g.tip($translate.instant('300008'), res.data.errMsg);
                                }
                            }
                        },$scope);
                    },
                    refreshData:function(type){
                        //刷新数据
                        var info = $scope.info;
                        if(type=='lock'){
                            info.userButInfo.total_amount = info.userButInfo.total_amount + info.lockNum;
                            info.coinBalances.but.free = info.coinBalances.but.free - info.lockNum;
                            info.activityInfo.total_amount = info.activityInfo.total_amount + info.lockNum;
                        }
                        else{
                            info.userButInfo.total_amount = info.userButInfo.total_amount - info.unLockNum;
                            info.coinBalances.but.free = info.coinBalances.but.free + info.unLockNum;
                            info.activityInfo.total_amount = info.activityInfo.total_amount - info.unLockNum;
                        }
                    }
                };

                //获取用户信息
                userInfo.get().then(function(res){
                    $scope.info.user = res.data;
                    var coinBalances = $scope.info.user.balances;
                    // 循环获取用户各类币的数据
                    $scope.info.coinBalances = {};
                    for(key in coinBalances){
                        var coin = coinBalances[key];
                        $scope.info.coinBalances[coin.symbol] = coin;
                    }
                    //是否登录
                    //$scope.info.user.account ? $scope.info.isLogin = true : $scope.info.isLogin = false;
                    //是否1级验证
                    $scope.info.user.tier_level == 0 ? $scope.info.isReal = false : $scope.info.isReal = true;

                });

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
                });

                //获取活动参与量信息
                $http.post("app/modules/dashboard/88btc/data/btcfund.info.php",{}).then(function (res) {
                    if(res.data.resultCode == 0){
                        $scope.info.activityInfo = res.data.data;
                        return false;
                    }
                },function () {
                    $scope.g.tip('','server error');
                });

                //获取用户BUT信息
                $http.post("app/modules/dashboard/88btc/data/user.but.info.php",{}).then(function (res) {
                    if(res.data.resultCode == 0){
                        $scope.info.userButInfo = res.data.data;
                        return false;
                    }
                },function () {
                    $scope.g.tip('','server error');
                });

                //获取基金日收益
                $http.post("app/modules/dashboard/88btc/data/dac.daily.profit.php",{}).then(function (res) {
                    if(res.data.resultCode == 0){
                        $scope.info.profitTab = res.data.data.reverse();

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

                        return false;
                    }
                    // $scope.g.tip('Err:resultCode '+res.data.resultCode,res.data.errMsg);
                },function () {
                    $scope.g.tip('','server error');
                });

                //获取用户基金日收益
                $http.post("app/modules/dashboard/88btc/data/user.daily.profit.php",{}).then(function (res) {
                    if(res.data.resultCode == 0){
                        $scope.info.myProfitTab = res.data.data.reverse();
                        //是否登录
                        /*if($scope.info.user.account){
                            console.log(1);
                            $scope.info.item1 = $scope.info.myProfitTab;
                            console.log($scope.info.item1);
                            $scope.info.tabNum1 = 'myProfitTab';

                        }else {
                            console.log(2);
                            $scope.info.item1 = $scope.info.profitTab;
                            $scope.info.tabNum1 = 'profitTab';
                        }*/
                        $scope.info.item1 = $scope.info.myProfitTab;
                        $scope.info.tabNum1 = 'myProfitTab';
                        return false;
                    }
                    // $scope.g.tip('Err:resultCode '+res.data.resultCode,res.data.errMsg);
                },function () {
                    $scope.g.tip('','server error');
                });

                //获取昨日排行榜
                $http.post("app/modules/dashboard/88btc/data/yesterday.profit.top10.php",{}).then(function (res) {
                    if(res.data.resultCode == 0){
                        $scope.info.ranTab = res.data.data;
                        return false;
                    }
                },function () {
                    $scope.g.tip('','server error');
                });

                //获取历史总排行榜
                $http.post("app/modules/dashboard/88btc/data/dac.total.profit.top10.php",{}).then(function (res) {
                    if(res.data.resultCode == 0){
                        $scope.info.totalRanTab = res.data.data;
                        $scope.info.item2 = $scope.info.totalRanTab;
                        return false;
                    }
                },function () {
                    $scope.g.tip('','server error');
                });

                if($scope.g.currLang === 'cn'){
                    $scope.info.lang = 'cn';
                }else {
                    $scope.info.lang = 'en'
                }




            }]
        }
    },
    resolve: {
        '88btc': ['$ocLazyLoad', function($ocLazyLoad){
            return $ocLazyLoad.load({
                name: '88btc',
                serie: true,
                files: [
                    '../bower_components/highcharts/highcharts.js',
                    //'../bower_components/highcharts/highstock.src.js',
                    '../bower_components/highcharts/highcharts-more.js',
                    '../bower_components/highcharts-ng/dist/highcharts-ng.js',
                    'app/common/css/czj.css',
                    //'http://v3.jiathis.com/code/jia.js'
                ]
            })
        }]
    }
};
