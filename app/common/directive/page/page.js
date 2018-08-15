
angular.module("BitUP")
    .directive("page", function() {
        return {
            restrict: 'E',
            template : '<p class="page-wrap" ng-show="config.totalItems > 0 && config.totalItems > config.itemsPerPage">'+
            '<span class="page start" ng-click="startPage()" ng-show="pageList && pageList.length > 1 && config.currentPage != 1"></span>'+
            '<span class="page prev" ng-click="prevPage()" ng-show="pageList && pageList.length > 1 && config.currentPage != 1"></span>'+
            '<span class="page" ng-repeat="item in pageList track by $index" ng-class="{on: item == config.currentPage, break: item == \'...\'}" ng-click="changeCurrentPage(item)">{{item}}</span>'+
            '<span class="page next" ng-click="nextPage()" ng-show="pageList && pageList.length > 1 && config.currentPage != pageList.length"></span>'+
            '<span class="page end" ng-click="endPage()" ng-show="pageList && pageList.length > 1 && config.currentPage != pageList.length"></span>'+
            '</p>',
            replace:true,
            scope: {
                config: '='
            },
            link:function(scope, element, attrs){
                /**
                 * config 分页属性对象
                 *     currentPage    当前显示的页数
                 *     itemsPerPage   每一页显示几条数据
                 *     totalItems     总共几条数据
                 *     pagesLength    分页控件最大显示几个页数tab
                 *     numberOfPages  总共多少页数
                 */
                //console.log(scope.config);
                // 定义分页的长度必须为奇数 (default:9)
                scope.config.pagesLength = parseInt(scope.config.pagesLength) ? parseInt(scope.config.pagesLength) : 9 ;
                if(scope.config.pagesLength % 2 === 0){
                    // 如果不是奇数的时候处理一下
                    scope.config.pagesLength = scope.config.pagesLength -1;
                }

                // 变更当前页
                scope.changeCurrentPage = function(item){
                    if(item == '...'){
                        return;
                    }else if(scope.config.currentPage != item){
                        scope.config.currentPage = item;
                        scope.config.func();
                    }
                };

                // prevPage
                scope.prevPage = function(){
                    if(scope.config.currentPage > 1){
                        scope.config.currentPage--;
                    }
                    scope.config.func();
                };
                // nextPage
                scope.nextPage = function(){
                    if(scope.config.currentPage < scope.config.numberOfPages){
                        scope.config.currentPage++;
                    }
                    scope.config.func();
                };
                // startPage
                scope.startPage = function(){
                    scope.config.currentPage = 1;
                    scope.config.func();
                };
                // endPage
                scope.endPage = function(){
                    scope.config.currentPage = scope.config.numberOfPages;
                    scope.config.func();
                };

                //分页计算器
                function getPagination(){
                    // config.currentPage 如果没有定义currentPage则默认为1
                    scope.config.currentPage = parseInt(scope.config.currentPage) ? parseInt(scope.config.currentPage) : 1;
                    // config.totalItems 转为整数,防止传的是字符串
                    scope.config.totalItems = parseInt(scope.config.totalItems);
                    // config.itemsPerPage 如果没有定义itemsPerPage则默认为15
                    scope.config.itemsPerPage = parseInt(scope.config.itemsPerPage) ? parseInt(scope.config.itemsPerPage) : 15;
                    // numberOfPages
                    scope.config.numberOfPages = Math.ceil(scope.config.totalItems/scope.config.itemsPerPage);

                    // judge currentPage > scope.numberOfPages
                    if(scope.config.currentPage < 1){
                        scope.config.currentPage = 1;
                    }

                    if(scope.config.currentPage > scope.config.numberOfPages){
                        scope.config.currentPage = scope.config.numberOfPages;
                    }

                    if(isNaN(scope.config.numberOfPages)){
                        return false;
                    }

                    //显示的页数集合
                    scope.pageList = [];
                    // 判断总页数是否小于等于分页的长度，若是则直接显示
                    if(scope.config.numberOfPages <= scope.config.pagesLength){
                        for(var i =1; i <= scope.config.numberOfPages; i++){
                            scope.pageList.push(i);
                        }
                    }
                    else {
                        // 总页数大于分页长度（此时分为三种情况：1.左边没有...2.右边没有...3.左右都有...）
                        // 计算中心偏移量
                        var offset = (scope.config.pagesLength - 1)/2;
                        if(scope.config.currentPage <= offset){
                            // 左边没有...
                            for(var i =1; i <= offset +1; i++){
                                scope.pageList.push(i);
                            }
                            scope.pageList.push('...');
                            //默认显示出最后两位页数
                            scope.pageList.push(scope.config.numberOfPages -1);
                            scope.pageList.push(scope.config.numberOfPages);
                        }
                        else if(scope.config.currentPage > scope.config.numberOfPages - offset){
                            // 右边没有...
                            //默认显示出1,2前两位页数
                            scope.pageList.push(1);
                            scope.pageList.push(2);
                            scope.pageList.push('...');
                            for(var i = offset + 1; i >= 1; i--){
                                scope.pageList.push(scope.config.numberOfPages - i);
                            }
                            scope.pageList.push(scope.config.numberOfPages);
                        }else {
                            // 最后一种情况，两边都有...
                            scope.pageList.push(1);
                            scope.pageList.push(2);
                            scope.pageList.push('...');

                            for(i = Math.ceil(offset/2) - 1 ; i >= 1; i--){
                                scope.pageList.push(scope.config.currentPage - i);
                            }
                            scope.pageList.push(scope.config.currentPage);
                            for(i = 1; i <= offset/2 - 1; i++){
                                scope.pageList.push(scope.config.currentPage + i);
                            }

                            scope.pageList.push('...');
                            scope.pageList.push(scope.config.numberOfPages - 1);
                            scope.pageList.push(scope.config.numberOfPages);
                        }
                    }
                    //改变页数时执行的事件
                    if(scope.config.onChange){
                        scope.config.onChange();
                    }
                    scope.$parent.config = scope.config;
                }
                scope.$watch(function(){
                    var newValue = scope.config.currentPage + ' ' + scope.config.totalItems + ' ' + scope.config.itemsPerPage;
                    return newValue;
                }, getPagination);
            }
        };
    });


