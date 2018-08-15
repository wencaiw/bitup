/**
 * Created by Hajay on 2018/4/12.
 * BitUP 路由
 */

'use strict';

//各模块根目录
var router = function(u){
    return {
        url: '/' + u,
        template: '<div ui-view="' + u + '"></div>'
    }
};

//dashboard 控制台
var dashboard = {
    router: function(u){
        return {
            url: '/' + u,
            views: {
                'dashboard': {
                    template: '<div ui-view="' + u + '"></div>'
                }
            }
        }
    },
    index: require('modules/dashboard/index'),
    analysis: {
        index: require('modules/dashboard/analysis/index')
    },
    assets: {
        index: require('modules/dashboard/assets/index')
    },
    trade: {
        center: require('modules/dashboard/trade/center/index'),
        detail: require('modules/dashboard/trade/detail/index'),
        order: require('modules/dashboard/trade/order/index'),
        record: require('modules/dashboard/trade/record/index'),
    },
    finance: {
        index: require('modules/dashboard/finance/index'),
        detail: require('modules/dashboard/finance/detail/index'),
        recharge: require('modules/dashboard/finance/recharge/index'),
        withdraw: require('modules/dashboard/finance/withdraw/index')
    },
    user: {
        index: require('modules/dashboard/user/index'),
        twoFa: require('modules/dashboard/user/2fa/index'),
        auth: require('modules/dashboard/user/auth/index'),
        candy: require('modules/dashboard/user/candy/index'),
        privilege: require('modules/dashboard/user/privilege/index'),
        pwd: require('modules/dashboard/user/pwd/index'),
        hongbao: require('modules/dashboard/user/hongbao/index')
    },
    btcFund: {
        index: require('modules/dashboard/88btc/index'),
        list: require('modules/dashboard/88btc/list/index'),
    }
};
//Index 指数
var index = {
    index: require('modules/index/index')
};
//funds 基金
var funds = {
    idx: require('modules/funds/index'),
    index: require('modules/funds/index/index'),
    list: {
        index: require('modules/funds/list/index'),
        bbb: require('modules/funds/list/bbb/index'),
        passive: require('modules/funds/list/passive/index'),
        active: require('modules/funds/list/active/index')
    },
    detail: require('modules/funds/detail/index'),
    //passive: {
    //    index: require('modules/funds/passive/index'),
    //    detail: require('modules/funds/passive/detail/index'),
    //    detail2: require('modules/funds/passive/detail2/index'),
    //    trade: require('modules/funds/passive/trade/index')
    //},
    info: {
        index: require('modules/funds/info/index'),
        detail: require('modules/funds/info/detail/index'),
        trade: require('modules/funds/info/trade/index')
    }
};

angular.module('BitUP').config(function($stateProvider, $urlRouterProvider, $locationProvider){
    $locationProvider.hashPrefix('');  //去掉1.6.* 默认的"!"
    $urlRouterProvider.otherwise("/dashboard/user/hongbao");

    $stateProvider
        //dashboard 控制台
        .state('dashboard', dashboard.index)
        .state('dashboard.analysis', dashboard.analysis.index)
        .state('dashboard.assets', dashboard.assets.index)
        .state('dashboard.trade', dashboard.router('trade'))
        .state('dashboard.trade.center', dashboard.trade.center)
        .state('dashboard.trade.detail', dashboard.trade.detail)
        .state('dashboard.trade.order', dashboard.trade.order)
        .state('dashboard.trade.record', dashboard.trade.record)
        .state('dashboard.finance', dashboard.router('finance'))
        .state('dashboard.finance.index', dashboard.finance.index)
        .state('dashboard.finance.detail', dashboard.finance.detail)
        .state('dashboard.finance.recharge', dashboard.finance.recharge)
        .state('dashboard.finance.withdraw', dashboard.finance.withdraw)
        .state('dashboard.user', dashboard.user.index)
        .state('dashboard.user.2fa', dashboard.user.twoFa)
        .state('dashboard.user.auth', dashboard.user.auth)
        .state('dashboard.user.candy', dashboard.user.candy)
        .state('dashboard.user.privilege', dashboard.user.privilege)
        .state('dashboard.user.pwd', dashboard.user.pwd)
        .state('dashboard.user.hongbao', dashboard.user.hongbao)
        .state('dashboard.88btc', dashboard.router('88btc'))
        .state('dashboard.88btc.index', dashboard.btcFund.index)
        .state('dashboard.88btc.list', dashboard.btcFund.list)
        //Index 指数
        .state('index', index.index)
        //Funds 基金
        .state('funds', funds.idx)
        .state('funds.index', funds.index)
        .state('funds.list', funds.list.index)
        .state('funds.list.bbb', funds.list.bbb)
        .state('funds.list.passive', funds.list.passive)
        .state('funds.detail', funds.detail)

        //.state('funds.passive', funds.passive.index)
        //.state('funds.passive.detail', funds.passive.detail)
        //.state('funds.passive.detail2', funds.passive.detail2)
        //.state('funds.passive.trade', funds.passive.trade)

        .state('funds.list.active', funds.list.active)

        .state('funds.info', funds.info.index)
        .state('funds.info.detail', funds.info.detail)
        .state('funds.info.trade', funds.info.trade);

    //$locationProvider.html5Mode('true');
    if(window.history && window.history.pushState){
        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
    }
});
