/**
 * Created by Hajay on 2018/4/20.
 */

module.exports = {
    url: '/list',
    views: {
        '88btc': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', function($scope, $http, $cookies, $state, $){
                $scope.g.currPage = '88btc';
                $scope.info = {
                    getAllList:function(){
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {},
                            url: '/app/modules/dashboard/88btc/data/user.order.list.php',
                            success: function(res){
                                $scope.info.orderList = res.data.data.reverse();
                            }
                        },$scope);
                    }
                };
                $scope.info.getAllList();
            }]
        }
    }
};
