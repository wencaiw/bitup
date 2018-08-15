/**
 * Created by Hajay on 2018/1/2.
 */
require('/app/common/directive/page/page.js');
module.exports = {
    url: '/index',
    views: {
        'finance': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', 'math', function($scope, $http, $cookies, $state, $ , userInfo, math){
                $scope.g.currPage = 'finance';

                $scope.info = {
                    user: $scope.g.info,
                    dataList:'',
                    coinList:['', 'BTC', 'ETH', 'BUT', 'USDT'],//币种类型
                    typeList:['',130075,130076,120097],//类型列表
                    goState: function(url,item){
                        /*if($scope.g.info.tier_level>0){//phone
                            if(url=='withdraw' && $scope.g.info.tier_level<=1){
                                $state.go('user.auth');//去验证身份
                                return false;
                            }
                            if($scope.g.info.tfa_enabled!=0){//2fa
                                sessionStorage.setItem('depositDetail',JSON.stringify(item));
                                console.log(item);
                                $state.go('finance.' + url, {coin: item});
                                return false;
                            }else {
                                $state.go('user.2fa');//去2fa验证
                                return false;
                            }
                        }else {
                            $state.go('user.auth');//去验证身份
                            return false;
                        }*/
                        sessionStorage.setItem('depositDetail',JSON.stringify(item));
                        $state.go('finance.' + url, {coin: item});

                    },
                    pageConfig: {
                        currentPage: 1,//当前显示的页数
                        itemsPerPage: 10,//每一页显示几条数据
                        currentCoin: '',//当前选中的币种
                        currentType: '',//选择的类型
                        func: function(){
                            $scope.info.getAllList();
                        }
                    },
                    selectCoin: function(coinName){//选择币种
                        var info = this;
                        info.pageConfig.currentCoin = coinName;
                        info.pageConfig.currentPage = 1;//重置
                        $scope.info.getAllList();
                    },
                    selectType: function(typeIndex){//选择类型
                        var info = this;
                        info.pageConfig.currentType = typeIndex==0 ? '' : (typeIndex - 1);
                        info.pageConfig.currentPage = 1;//重置
                        $scope.info.getAllList();
                    },
                    getAllList: function(){
                        var info = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                skip: (info.pageConfig.currentPage - 1) * info.pageConfig.itemsPerPage,
                                limit: info.pageConfig.itemsPerPage,
                                coin: info.pageConfig.currentCoin,
                                type: info.pageConfig.currentType
                            },
                            url: '/app/modules/dashboard/finance/data/order.list.php',
                            success: function(res){
                                if(res.data.resultCode != 0) return;
                                info.dataList = res.data.data;
                            }
                        },$scope);

                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                coin: info.pageConfig.currentCoin,
                                type: info.pageConfig.currentType
                            },
                            url: '/app/modules/dashboard/finance/data/get.order.count.php',
                            success: function(res){
                                if(res.data.resultCode != 0) return;
                                $scope.info.pageConfig.totalItems = res.data.data.count;
                            }
                        },$scope);
                    },
                    withdrawNum: function(a, b){
                        return math.f(a, b, '+');
                    }
                };

                $scope.info.getAllList();

                //拿到userinfo
                userInfo.get().then(function(res){
                    $scope.info.user = res.data;
                });

            }]
        }
    }
};