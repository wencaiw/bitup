var bcLoginControllers = angular.module('indexControllers', []);

function emailMatch(email) {
    var regm = "^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$";
    //验证Mail的正则表达式,^[a-zA-Z0-9_-]:开头必须为字母,下划线,数字,
    if (!email.match(regm)) {
        return false;
    }
    return true;
}

bcLoginControllers.controller('indexCtrl', ['$scope', '$http', '$window', function($scope, $http, $window)  {

    $scope.info = {
        account: '',
        pwd: '',
        message: '',
        loading: false,
        enter: function (event) {
            if (event.keyCode == 13){
                $scope.info.loginSub();
            }
        },
        loginSub: function(){
            if (!$scope.info.account || !$scope.info.pwd) {
                $scope.info.message = "请输入邮箱或密码!";
                return false;
            }
            if ($scope.info.loading){
                $scope.info.message = "还在登录中,请耐心等待!";
                return false;
            }
            if (!emailMatch($scope.info.account)) {
                $scope.info.message = "请输入正确格式的邮箱";
                return false;
            }
            $scope.info.loading = true;
            $scope.message = "登陆中...";
            $http.get('/common/data/login.php', {
                params: {
                    account: $scope.info.account,
                    pwd: $scope.info.pwd
                }
            }).then(function(res) {
                console.log(res.data);
                var data = res.data;
                $scope.info.loading = false;
                if (data.resultCode == 0) {
                    $scope.info.message = "准备跳转了";
                    $window.location.href = "/dashboard";
                } else {
                    $scope.info.message = "您的账号或密码有误！";
                }
            }).catch(function(res) {
                $scope.info.loading = false;
                $scope.info.message = "登陆失败";
            });

        }
    };
}]);
