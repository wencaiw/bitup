/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/user',
    views: {
        'dashboard': {
            template: __inline('index.html?v=2'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', function($scope, $http, $cookies, $state, $, userInfo){
                $scope.g.currPage = 'user';

                $scope.userInfo = {
                    authLevel: 0,
                    menu:'',
                    goState: function(type){
                        if(type == 'auth'){
                            $scope.userInfo.authLevel = 0;
                        }
                        $state.go("user." + type);
                    },
                    showSubMenu: {
                        securitySettings: false //安全设置二级菜单是否显示,默认不显示
                    },
                    openSubMenu: function(menu){
                        $scope.userInfo.showSubMenu[menu] = !$scope.userInfo.showSubMenu[menu];
                    }
                };
                $scope.info = {};

                userInfo.get().then(function(userInfo){
                    $scope.info.user = userInfo.data;
                });
            }]
        }
    }
};