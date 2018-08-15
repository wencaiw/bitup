/**
 * Created by Hajay on 2018/2/2.
 */
var module = angular.module('butCandy', ['pascalprecht.translate']);
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

module.controller('butCandyCtrl', ['$scope', '$http', '$window', '$translate', '$timeout', function($scope, $http, $window, $translate, $timeout)  {

    $scope.info = {
        step: 1,
        pop: false,
        currLang: window.localStorage.lang || 'en',
        switching: function(){
            var lang = ($scope.info.currLang == 'en' ? 'cn' : 'en');
            $translate.use(lang);
            window.localStorage.lang = $scope.info.currLang = lang;
        },
        address: '',  //0x348091A8d09c4E48ABd083cF44D4FC7632aEEaE4
        //code: window.code,
        message: '',
        loading: false,
        enter: function (event) {
            if (event.keyCode == 13){
                $scope.info.submit();
            }
        },
        getVCode: function(){
            $http.get('data/get.verify.code.php', {
                params: {}
            }).then(function(res) {
                console.log(res.data);
                //console.log(window.location.href);
                var data = res.data;
                $scope.info.loading = false;
                if (data.resultCode == 0) {
                    //$scope.info.message = "地址生成成功";
                } else {
                    $scope.info.message = data.errMsg;
                }
            }).catch(function(res) {
                $scope.info.loading = false;
                $scope.info.message = "Network failure, please try again!";
            });
        },
        submit: function(){
            //$scope.info.pop = true;
            //$scope.info.message = 'Loading...';
            //if ($scope.info.loading){
            //    $scope.info.message = "还在中,请耐心等待!";
            //    return false;
            //}
            if (!ethMatch($scope.info.address)) {
                $scope.info.popTimeout('Please enter the correct ETH wallet address！');
                //$scope.info.message = "请输入正确ETH地址";
                return false;
            }
            $http.get('data/get.code.php', {
                params: {
                    address: $scope.info.address,
                    recaptcha: $scope.info.recaptcha,
                    code: window.code
                }
            }).then(function(res) {
                console.log(res.data);
                //console.log(window.location.href);
                var data = res.data;
                if (data.resultCode == 0) {
                    //$scope.info.message = "地址生成成功";
                    $scope.info.step = 2;
                    $scope.info.child_count = data.data.child_count;
                    $scope.info.reward = data.data.reward;
                    $scope.info.shareCode = '/' + data.data.code;
                    $scope.info.shareUrl = 'http://'+location.host + location.pathname +  '?code=' + data.data.code
                    console.log($scope.info.shareUrl);
                } else {
                    $scope.info.popTimeout(data.errMsg);
                    $scope.info.vcode();
                }
            }).catch(function(res) {
                var data = res.data;
                $scope.info.loading = false;
                $scope.info.popTimeout(data.errMsg);
            });
        },
        popTimeout: function(errInfo){
            $scope.info.pop = true;
            $scope.info.message = errInfo;
            $timeout(function(){
                //$scope.$apply(function(){
                    $scope.info.pop = false;
                    $scope.info.message = '';
                //})
            },2000)
        },
        rule: function(type){
            if(type == 'open'){
                $scope.info.pop = true;
                $scope.info.message = '';
            }else{
                $scope.info.pop = false;
            }
        }
    };
    //$scope.info.getVCode();
    //$scope.info.vcode = function(){
    //    $scope.info.vcodeImg = 'data/get.verify.code.php?a=' + Math.random();
    //};
    //$scope.info.vcode();

    window.verifyCallback = function(gId){
        console.log(gId);
        $scope.info.recaptcha = gId;
    }
}]);

function ethMatch(address) {
    address = address.toLocaleLowerCase();
    if (!/^(0x)?[0-9a-f]{40}$/i.test(address)) {
        // check if it has the basic requirements of an address
        return false;
    } else if (/^(0x)?[0-9a-f]{40}$/.test(address) || /^(0x)?[0-9A-F]{40}$/.test(address)) {
        // If it's all small caps or all all caps, return true
        return true;
    } else {
        // Otherwise check each case
        return false;
    }
}
