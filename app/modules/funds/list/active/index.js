/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/active',
    views: {
        'list': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$stateParams', '$interval', 'simpleLine', function($scope, $location, $http, $cookies, $state, $, $stateParams, $interval, simpleLine){

                var self_ = $scope.info;
                self_.dataType = 'active';
                self_.pageConfig.currentPage = 1;
                self_.searchList = [
                    {'key': 0, 'value': 120118 },
                    {'key': 1, 'value': 120119 }, 
                    {'key': 2, 'value': 120120 },
                    {'key': 3, 'value': 120121 },
                    {'key': 4, 'value': 120122 }
                ];
                self_.searchItem = 0;
                self_.pageConfig.itemsPerPage = 3;
                self_.pageConfig.func = function(){//选择页数
                    self_.dataList= {};//币币宝列表
                    self_.loading = true;
                    self_.getDataList();
                };
                self_.selectCallBack = null;
                self_.getDataList();

            }]
        }
    }
};