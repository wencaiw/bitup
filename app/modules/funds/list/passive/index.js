/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/passive',
    views: {
        'list': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$stateParams', '$interval', 'simpleLine', function($scope, $location, $http, $cookies, $state, $, $stateParams, $interval, simpleLine){

                var self_ = $scope.info;
                self_.dataType = 'passive';
                self_.pageConfig.currentPage = 1;
                self_.searchList = [
                    {'key': 0, 'value': 120118 },
                    {'key': 1, 'value': 120119 }, 
                    {'key': 2, 'value': 120120 },
                    {'key': 3, 'value': 120121 },
                    {'key': 4, 'value': 120122 }
                ];
                self_.searchItem = 0;
                self_.pageConfig.itemsPerPage = 6;
                self_.pageConfig.func = function(){//选择页数
                    self_.dataList= {};//币币宝列表
                    self_.loading = true;
                    self_.getDataList(self_.selectCallBack);
                };
                self_.selectCallBack = function() {
                    for(var i in self_.dataList){
                        self_.dataList[i].priceData = [];
                        self_.dataList[i].simpleLine = new simpleLine.chart();
                        for(var j in self_.dataList[i].trends){
                            self_.dataList[i].priceData.push({
                                x: self_.dataList[i].trends[j].evaluate_time,
                                y: self_.dataList[i].trends[j].exchange_ratio
                            })
                        }
                        self_.dataList[i].simpleLine.data(self_.dataList[i].priceData);
                    }
                };
                self_.getDataList(self_.selectCallBack);

            }]
        }
    }
};