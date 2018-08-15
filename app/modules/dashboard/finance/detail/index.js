/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/detail',
    views: {
        'finance': {
            template: __inline('index.html?v=1'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', function($scope, $http, $cookies, $state, $){
                $scope.g.currPage = 'finance';
                $scope.info = {
                    depositDetail: JSON.parse(sessionStorage.getItem('depositDetail')),
                    goBack: function () {
                        window.history.go(-1);
                    },
                    feeList:{
                        'BTC': 0.001,
                        'BUT': 50
                    }
                };

                $scope.info.depositDetail.fee = $scope.info.feeList[$scope.info.depositDetail.coin];
                $scope.info.depositDetail.realAmount = $scope.info.depositDetail.amount - $scope.info.feeList[$scope.info.depositDetail.coin];
                console.log($scope.info.depositDetail);
            }]
        }
    },
    resolve: {
        'detail': ['$ocLazyLoad', function($ocLazyLoad){
            return $ocLazyLoad.load({
                name: 'detail',
                serie: true,
                files: [
                    'modules/finance/detail/index.js'
                ]
            })
        }]
    }
};