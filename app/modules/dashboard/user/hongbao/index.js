/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/hongbao',
    views: {
        'user': {
            template: __inline('index.html?v=1'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', function($scope, $http, $cookies, $state, $, userInfo){
                $scope.g.currPage = 'user';
                $scope.userInfo.menu = "hongbao";
                $scope.userInfo.openSubMenu.securitySettings = false;
                $scope.info = {
                    currentLevel: null, //当前等级
                    redInfo: {},
                    init: function(){
                        var self_ = this;
                        self_.getCandyInfo();
                    },
                    getCandyInfo: function(){
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/dashboard/user/data/get.hongbao.reward.php',
                            success: function(res){
                                console.log(res);
                                self_.redInfo = res.data.data;
                            }
                        },$scope);
                    },
                    copySuccess: function(){
                        $scope.g.tip("message","Copy success");
                    }
                };
                $scope.info.init();
                
            }]
        }
    }
};