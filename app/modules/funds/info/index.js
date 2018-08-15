/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/:type/:dac_id',
    views: {
        'funds': {
            template: '<div ui-view="passive"></div>',
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$stateParams', '$interval', function($scope, $location, $http, $cookies, $state, $, $stateParams, $interval){

                $scope.g.currPage = 'funds';
                $scope.publicData = {
                    currDacId: $stateParams.dac_id,
                    currFundType: $stateParams.type,
                    dacDiscount: {
                        discount: 0
                    },
                    init: function(){
                        var self = this;

                        self.getPro();
                        $scope.g.isLogin ? self.getUserInfo() : '';
                    },
                    getPro: function(){ //获取产品信息
                        var self_ = this;
                        var dataParams = angular.copy($stateParams);
                        dataParams.type = ($stateParams.type == 'passive' ? 10 : 20);
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: dataParams,
                            url: 'app/modules/funds/data/fund.info.php',
                            success: function(res){
                                self_.fundInfo = res.data.data;
                                self_.dacDiscount = {
                                    discount: res.data.data.dac_fee.but_exit_discount * 10
                                }
                            }
                        },$scope);
                    },
                    getUserInfo: function(){ //获取用户的信息
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {'dac_id': self_.currDacId},
                            url: 'app/modules/funds/data/user.funds.php',
                            success: function(res){
                                self_.userFunds = res.data.data;
                            }
                        },$scope);
                    }
                };
                $scope.publicData.init();

            }]
        }
    }
};