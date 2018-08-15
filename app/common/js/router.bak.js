/**
 * Created by Hajay on 2018/4/13.
 */

module.config(function($stateProvider, $urlRouterProvider, $locationProvider){
    $locationProvider.hashPrefix('');  //去掉1.6.* 默认的"!"
    $urlRouterProvider.otherwise("/user/candy");
    $stateProvider
        .state('trade', {
            url: '/trade',
            template: '<div ui-view="trade"></div>'
        })
        .state('trade.center', {
            url: '/center',
            views: {
                'trade': {
                    templateUrl: 'trade/center/index.html',
                    controller: 'tradeCenterContentCtrl'
                }
            },
            resolve: {
                'center': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'center',
                        serie: true,
                        files: [
                            'trade/center/index.js',
                            '../bower_components/highcharts/highcharts.js',
                            //'../bower_components/highcharts/highstock.src.js',
                            '../bower_components/highcharts/highcharts-more.js',
                            '../bower_components/highcharts-ng/dist/highcharts-ng.js',
                        ]
                    })
                }]
            }
        })
        .state('trade.detail', {
            url: '/detail',
            views: {
                'trade': {
                    templateUrl: 'trade/detail/index.html',
                    controller: 'tradeDetailContentCtrl'
                }
            },
            resolve: {
                'detail': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'detail',
                        serie: true,
                        files: [
                            'trade/detail/index.css',
                            '../bower_components/highcharts/highcharts.js',
                            //'../bower_components/highcharts/highstock.src.js',
                            '../bower_components/highcharts/highcharts-more.js',
                            '../bower_components/highcharts-ng/dist/highcharts-ng.js',
                            'trade/detail/index.js'
                        ]
                    })
                }]
            }
        })
        .state('trade.record', {
            url: '/record',
            views: {
                'trade': {
                    templateUrl: 'trade/record/index.html',
                    controller: 'tradeRecordContentCtrl'
                }
            },
            resolve: {
                'record': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'record',
                        serie: true,
                        files: [
                            'trade/record/index.js'
                        ]
                    })
                }]
            }
        })
        .state('trade.order', {
            url: '/order/:type',
            views: {
                'trade': {
                    templateUrl: 'trade/order/index.html',
                    controller: 'tradeOrderContentCtrl'
                }
            },
            resolve: {
                'order': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'order',
                        serie: true,
                        files: [
                            'trade/order/index.js',
                            'trade/order/index.css'
                        ]
                    })
                }]
            }
        })
        .state('finance', {
            url: '/finance',
            template: '<div ui-view="finance"></div>'
        })
        .state('finance.index', {
            url: '/index',
            views: {
                'finance': {
                    templateUrl: 'finance/index.html',
                    controller: 'financeContentCtrl'
                }
            },
            resolve: {
                'finance': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'finance',
                        serie: true,
                        files: [
                            'finance/index.js',
                            'trade/order/index.css'
                        ]
                    })
                }]
            }
        })
        .state('finance.recharge', {
            url: '/recharge',
            views: {
                'finance': {
                    templateUrl: 'finance/recharge/index.html',
                    controller: 'rechargeContentCtrl'
                }
            },
            resolve: {
                'recharge': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'recharge',
                        serie: true,
                        files: [
                            'finance/recharge/index.js',
                            'trade/order/index.css'
                        ]
                    })
                }]
            }
        })
        .state('finance.withdraw', {
            url: '/withdraw',
            views: {
                'finance': {
                    templateUrl: 'finance/withdraw/index.html',
                    controller: 'withdrawContentCtrl'
                }
            },
            resolve: {
                'withdraw': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'withdraw',
                        serie: true,
                        files: [
                            'finance/withdraw/index.js',
                            'trade/order/index.css'
                        ]
                    })
                }]
            }
        })
        .state('finance.detail', {
            url: '/detail',
            views: {
                'finance': {
                    templateUrl: 'finance/detail/index.html',
                    controller: 'detailContentCtrl'
                }
            },
            resolve: {
                'detail': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'detail',
                        serie: true,
                        files: [
                            'finance/detail/index.js',
                            'trade/order/index.css'
                        ]
                    })
                }]
            }
        })
        .state('withdraw', {
            url: '/withdraw',
            views: {
                '': {
                    templateUrl: 'withdraw/index.html',
                    controller: 'withdrawContentCtrl'
                }
            },
            resolve: {
                'withdraw': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'withdraw',
                        serie: true,
                        files: [
                            'withdraw/index.js'
                        ]
                    })
                }]
            }
        })
        .state('analysis', {
            url: '/analysis',
            views: {
                '': {
                    templateUrl: 'analysis/index.html',
                    controller: 'analysisContentCtrl'
                }
            },
            resolve: {
                'analysis': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'analysis',
                        serie: true,
                        files: [
                            '../bower_components/highcharts/highcharts.js',
                            //'../bower_components/highcharts/highstock.src.js',
                            '../bower_components/highcharts/highcharts-more.js',
                            '../bower_components/highcharts-ng/dist/highcharts-ng.js',
                            'analysis/index.js',
                            'trade/detail/index.css'
                        ]
                    })
                }]
            }
        })
        .state('assets', {
            url: '/assets',
            views: {
                '': {
                    templateUrl: 'assets/index.html',
                    controller: 'assetsContentCtrl'
                }
            },
            resolve: {
                'assets': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'assets',
                        serie: true,
                        files: [
                            'assets/index.js'
                        ]
                    })
                }]
            }
        })
        //.state('user', {
        //    url: '/user',
        //    template: '<div ui-view="user"></div>'
        //})
        .state('user', {
            url: '/user',
            views: {
                '': {
                    templateUrl: 'user/index.html?v=1',
                    controller: 'userContentCtrl'
                }
            },
            resolve: {
                'user': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'user',
                        serie: true,
                        files: [
                            'user/index.js?v=1'
                        ]
                    })
                }]
            }
        })
        .state('user.auth', {
            url: '/auth',
            views: {
                'user': {
                    templateUrl: 'user/auth/index.html',
                    controller: 'authContentCtrl'
                }
            },
            resolve: {
                'auth': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'auth',
                        serie: true,
                        files: [
                            'user/auth/index.js'
                        ]
                    })
                }]
            }
        })
        .state('user.pwd', {
            url: '/pwd',
            views: {
                'user': {
                    templateUrl: 'user/pwd/index.html',
                    controller: 'pwdContentCtrl'
                }
            },
            resolve: {
                'pwd': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'pwd',
                        serie: true,
                        files: [
                            'user/pwd/index.js'
                        ]
                    })
                }]
            }
        })
        .state('user.2fa', {
            url: '/2fa',
            views: {
                'user': {
                    templateUrl: 'user/2fa/index.html',
                    controller: '2faContentCtrl'
                }
            },
            resolve: {
                '2fa': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: '2fa',
                        serie: true,
                        files: [
                            'user/2fa/index.js'
                        ]
                    })
                }]
            }
        })
        .state('user.privilege', {
            url: '/privilege',
            views: {
                'user': {
                    templateUrl: 'user/privilege/index.html',
                    controller: 'privilegeContentCtrl'
                }
            },
            resolve: {
                'privilege': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'privilege',
                        serie: true,
                        files: [
                            'user/privilege/index.js'
                        ]
                    })
                }]
            }
        })
        .state('user.candy', {
            url: '/candy',
            views: {
                'user': {
                    templateUrl: 'user/candy/end.html?v=1',
                    controller: 'candyContentCtrl'
                }
            },
            resolve: {
                'candy': ['$ocLazyLoad', function($ocLazyLoad){
                    return $ocLazyLoad.load({
                        name: 'candy',
                        serie: true,
                        files: [
                            'user/candy/index.js?v=21'
                        ]
                    })
                }]
            }
        })
});
