/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/privilege',
    views: {
        'user': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', function($scope, $http, $cookies, $state, $, userInfo){
                $scope.g.currPage = 'user';
                $scope.userInfo.menu = "privilege";
                $scope.info = {
                    currentLevel: 0
                }
            }]
        }
    }
};