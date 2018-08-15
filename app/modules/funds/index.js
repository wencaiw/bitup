/**
 * Created by Hajay on 2018/7/30.
 */
module.exports = {
    url: '/funds',
    //abstract: true,
    views: {
        '': {
            template: '<div ui-view="funds"></div>',
            controller: ['$scope', '$location', '$http', '$interval', '$cookies', '$state', function($scope, $location, $http, $interval, $cookies, $state){

                if($location.$$path == '/funds'){
                    $state.go('funds.index');
                    //$location.path('/funds/index');
                }
                $scope.fundInfo = {
                    nowDate: new Date().getTime(),
                    interval: $interval(function(){
                        $scope.fundInfo.nowDate += 1000;
                    }, 1000)
                };

                $scope.$on("$destroy", function() {
                    if (angular.isDefined($scope.fundInfo.interval)) {
                        $interval.cancel($scope.fundInfo.interval);
                        $scope.fundInfo.interval = undefined;
                    }
                });

            }]
        }
    }
};
