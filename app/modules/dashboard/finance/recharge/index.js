/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/recharge/:coin',
    views: {
        'finance': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$stateParams', '$', 'userInfo', function ($scope, $http, $cookies, $state, $stateParams, $, userInfo) {
                $scope.g.currPage = 'finance';

                $scope.info = {
                    currentBi: $stateParams,
                    user: {},
                    coinMinNumObj: {'BTC': 0.001, 'BUT':100, 'USDT':0.1, 'ETH': 0.015},//充值最低的值
                    coinMinNum: [],//洗数据
                    coin: $stateParams.coin,
                    minNum: 1,
                    init: function(){
                        for(var item in this.coinMinNumObj){
                            this.coinMinNum[item] = this.coinMinNumObj[item];
                        }
                        this.minNum = this.coinMinNum[this.coin.toUpperCase()];
                    },
                    goBack: function () {
                        window.history.back();
                    }
                };
                $scope.info.init();
                console.log($stateParams.coin);
                userInfo.get().then(function (res) {
                    $scope.info.user = res.data;
                    /* console.log($stateParams.coin.toUpperCase()==='BUT');
                     if($stateParams.coin.toUpperCase() === 'BUT'){
                         $scope.info.coin = 'BUT';
                     }else{
                         $scope.info.coin = 'BTC';
                     }*/
                });

                //拿到充币地址
                $.ajax({
                    loading: 1,
                    method: 'post',
                    data: {coin: $stateParams.coin},
                    url: '/app/modules/dashboard/finance/data/get.coin.address.php',
                    success: function(res){
                        $scope.info.recharge_address = res.data.data.address;
                    }
                },$scope);

            }]
        }
    },
    resolve: {
        'recharge': ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'recharge',
                serie: true,
                files: [
                    '../bower_components/qrcode-generator/js/qrcode.js',
                    '../bower_components/qrcode-generator/js/qrcode_UTF8.js',
                    '../bower_components/angular-qrcode/angular-qrcode.js'
                ]
            })
        }]
    }
};