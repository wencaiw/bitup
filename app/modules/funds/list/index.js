/**
 * Created by Hajay on 2018/7/26.
 */
module.exports = {
    url: '/list',
    views: {
        'funds': {
            template: __inline('index.html'),
            controller: ['$scope', '$location', '$http', '$cookies', '$state', '$', '$stateParams', '$interval', function($scope, $location, $http, $cookies, $state, $, $stateParams, $interval){

                $scope.g.currPage = 'funds';
                $scope.info = {
                    dataType: '',//数据类型
                    bbbType: '1', //币币宝定期:fixed  活期:flexible
                    isshow: false,
                    loading: true,
                    dataList: {},//币币宝列表
                    time:[],
                    searchItem: 0,
                    searchList: [],//筛选条件
                    pageConfig: {
                        currentPage: 1,//当前显示的页数
                        itemsPerPage: 12,//每一页显示几条数据
                    },
                    selectCallBack: null,
                    pageLink: function(name, obj){ //跳转详情页
                        $state.go(name, obj);
                    },
                    goLink: function(type, id){ //跳转详情页
                        //$state.go('funds.passive.detail', {dac_id: id});
                        window.location.href = 'funds/'+ type +'/'+ id  +'/detail';
                    },
                    tabClick: function(typename, page, type){ //tab切换
                        var self_ = this;
                        if(self_.dataType != 'bbb' && self_.dataType == typename) return;
                        if(self_.dataType == 'bbb' && self_.bbbType == type) return;
                           
                        type ? $state.go(page, {type: (type == 1 ? 'fixed' : 'flexible')}) : $state.go(page);
                        self_.bbbType = type;
                        self_.dataList= {},//币币宝列表
                        self_.pageConfig.totalItems = 0;//请求数据前 页数不呈现
                        self_.loading = true;
                        self_.isshow = false;
                    },
                    selectType: function(k, fun){//选择筛选项
                        var self_ = this;
                        self_.loading = true;
                        self_.isshow = false;
                        self_.dataList= {};//币币宝列表
                        self_.pageConfig.totalItems = 0;
                        self_.pageConfig.currentPage = 1;
                        self_.searchItem = k;
                        self_.getDataList(fun);
                    },
                    getDataList: function(fun){ //获取数据
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/funds/data/funds.list.php',
                            data: {
                                fund_type: self_.dataType,
                                limit: self_.pageConfig.itemsPerPage,
                                offset: (self_.pageConfig.currentPage-1) * self_.pageConfig.itemsPerPage,
                                status: self_.searchItem,
                                type: self_.bbbType
                            },
                            success: function(res){
                                self_.loading = false;
                                if(res.data.data == null){
                                    self_.isshow = true;
                                    self_.dataList = {};
                                    self_.pageConfig.totalItems = 0;
                                }else{
                                    self_.isshow = false;

                                    self_.dataList = res.data.data.list;
                                    self_.pageConfig.totalItems = res.data.data.total;
                                    if(!!fun) fun();
                                }
                            }
                        },$scope);
                    }
                };

            }]
        }
    },
    resolve: {
        "list": ['$ocLazyLoad', function ($ocLazyLoad) {
            // you can lazy load files for an existing module
            return $ocLazyLoad.load({
                name: 'list',
                serie: true,
                files: [
                    '/app/modules/funds/index.css',
                    '../bower_components/highcharts/highcharts.js',
                    //'../bower_components/highcharts/highstock.src.js',
                    '../bower_components/highcharts/highcharts-more.js',
                    '../bower_components/highcharts-ng/dist/highcharts-ng.js',
                ]
            });
        }]
    }
};