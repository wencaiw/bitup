/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/record',
    views: {
        'trade': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$timeout', '$cookies', '$state', '$', '$translate', function($scope, $http, $timeout, $cookies, $state, $, $translate){
                $scope.g.currPage = 'tradeRecord';

                $scope.info = {
                    currTab: '1',
                    tabList: {
                        1: $translate.instant('100076'),
                        7: $translate.instant('100077'),
                        30: $translate.instant('100078'),
                        all: $translate.instant('100079')
                    },
                    switchTab: function(num){
                        $scope.info.currTab = num;
                    },
                    dataList: [
                        {
                            type: 'buy',
                            bpp: 'BitUP Prime（BPP）',
                            designer: 'BitUP',
                            number: 550,
                            fee: 812.79,
                            price: 1.4778,
                            status: true,
                            tradeDate: '2017.12.23 18:26:17'
                        }
                    ],
                    goDetail: function(item){
                        $state.go('trade.order', {type: 'detail'});
                        sessionStorage.setItem('orderDetail',JSON.stringify(item));
                    }
                };
                $scope.$watch('g.currLang', function(n, o, scope){
                    if(n != o){
                        $timeout(function(){
                            $scope.info.tabList = {
                                1: $translate.instant('100076'),
                                7: $translate.instant('100077'),
                                30: $translate.instant('100078'),
                                all: $translate.instant('100079')
                            }
                        },0);
                    }
                });
            }]
        }
    }
};