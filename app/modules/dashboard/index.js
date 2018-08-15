/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/dashboard',
    abstract: true,
    views: {
        '': {
            template: __inline('index.html?v=2'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', 'userInfo', function($scope, $location, $http, $cookies, $state, $, userInfo){

                //$scope.dbInfo = {
                //    loading: true
                //};
                userInfo.get().then(function(userInfo){
                    $scope.g.info = userInfo.data;
                    //$scope.dbInfo.loading = false;
                });

            }]
        }
    }
};