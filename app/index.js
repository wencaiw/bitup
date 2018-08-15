/**
 * Created by Hajay on 2018/1/2.
 */

var module = angular.module('BitUP', ['ui.router', 'ngCookies', 'oc.lazyLoad', 'pascalprecht.translate', 'ngclipboard']);  //, 'monospaced.qrcode' 二维码

/**
 * service factory config
 */
require('common/js/service');

/**
 * route 路由
 */
require('common/js/router');

module.controller('DashboardCtrl', ['$scope', '$http', '$timeout', '$q', '$location', '$state', '$stateParams', '$', '$translate', 'T', function($scope, $http, $timeout, $q, $location ,$state, $stateParams, $, $translate, T){

    //$scope.mobileW = 1200;

    $scope.g = {
        account: window.account || '',
        isLogin: window.isLogin,
        currLang: window.localStorage.lang || 'en',
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
        currPage: '',
        panelStatus: {
            currencyList: 'hide'
        },
        togglePanel:function(name, type, e){
            e && e.stopPropagation(); //取消冒泡
            var obj = $scope.g.panelStatus;
            if (type) {
                if (typeof(name) == 'object') {
                    //不要去掉这个setTimeout;营销系统优惠券的模板id窗口,必须使用计时器延迟,其复制功能才会起作用
                    setTimeout(function () {
                        $scope.$apply(function () {
                            for (var i = 0, len = name.length; i < len; i++) {
                                obj[name[i]] = type;
                            }
                        });
                    }, 0)
                } else {
                    obj[name] = type;
                    obj[name] == 'show' ? obj[name] = 'hide' : obj[name] = 'show';
                }
            } else {
                if (typeof(name) == 'object') {
                    for (var i = 0, len = name.length; i < len; i++) {
                        obj[name[i]] = obj[name[i]] == 'show' ? 'hide' : 'show';
                    }
                } else {
                    //收起其他面板
                    for (var i in obj) {
                        if (i != name) {
                            obj[i] = 'hide';
                        }
                    }
                    obj[name] = obj[name] == 'show' ? 'hide' : 'show'
                }
            }
        },
        tipShow: false,//是否显示提示框
        tipTitle: '',//提示框标题,
        tipInfo: '',//提示框文案,
        showTipClose: true,//显示提示框关闭图标
        tip: function (title, text, fun) {
            $timeout(function () {
                $scope.g.tipTitle = title;
                $scope.g.tipInfo = text;
                $scope.g.tipShow = true;
                $scope.g.tipConfirm = function(){
                    if(fun){
                        fun();
                    }
                    $scope.g.tipShow = false;
                }
            }, 0);
        },
        clearTip: function () {
            $scope.g.tipShow = false;
        },
        countDown:function(){
            $scope.g.countBeing = true;
            var time = 60;
            $scope.g.countDownText = time + "s";
            var timer = setInterval(function(){
                $scope.$apply(function(){
                    time --;
                    if(time == 0 || !$scope.g.countDown){
                        clearInterval(timer);
                        $scope.g.countBeing = false;
                        if($scope.g.currLang=='cn'){
                            $scope.g.countDownText = "重新获取";
                        }
                        else {
                            $scope.g.countDownText = "Send";
                        }
                        return;
                    }
                    $scope.g.countDownText = time + "s";
                });
            },1000);
        },
        goState: function(url){
            $scope.g.mobileNav = false;
            //$state.go(url);
            window.location.href = url
        },
        stateGo: function(pageName, obj){//手机端头部导航，点击后隐藏导航模块
            $scope.g.mobileNav = false;//手机端隐藏导航栏
            obj ? $state.go(pageName, obj) : $state.go(pageName);
        }
    };

    //userInfo.get().then(function(userInfo){
    //    $scope.g.info = userInfo.data;
    //});
}]);