/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/withdraw/:coin',
    views: {
        'finance': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state' , '$', '$stateParams', 'userInfo' , '$interval' , function($scope, $http, $cookies, $state, $ , $stateParams , userInfo , $interval){
                $scope.g.currPage = 'finance';

                console.log($stateParams.coin);


                $scope.info = {
                    currCoin: {
                        coin: $stateParams.coin,
                        price: $stateParams.coin
                    },
                    currCoinInfo: {},  //当前币余额信息
                    user:{},
                    quota:function () {
                        if($scope.info.user.tier_level == 0){
                            return 0.00
                        }else if($scope.info.user.tier_level == 1){
                            return 1000.00
                        }else if($scope.info.user.tier_level == 2){
                            return '无限制'
                        }
                    },
                    coin:'',
                    balance:'',//当前币种余额
                    show2FA:true,//是否激活2fa
                    code:'',//2fa验证码
                    currentBi:$stateParams,
                    ConfirmCodeErr:false,//短信验证码错误提示
                    emailCodeErr:false,//邮箱验证码错误提示
                    cost:0.001,//手续费
                    userGetNumber:0.000,//默认到账数量
                    showPhoneConfim:false,//弹窗
                    currencyAddress:'',//地址
                    address:false,//地址错误提示
                    //phone:'',//手机号
                    v_code:'',//手机验证码
                    e_code:'',//邮箱验证码
                    codeError:false,//2fa验证
                    phone_v_code:'send',
                    email_v_code:'send',
                    time:60,//发送验证码时间
                    time2:60,//发送邮箱验证码时间
                    lock_time:false,//锁定验证码按钮
                    lock_time2:false,//锁定邮箱验证码按钮
                    biList:{
                        'BTC': {
                            key: 'BTC',
                            name: '比特币',
                            num: 0.019156,
                            price: 10000
                        },
                        'ETH': {
                            key: 'ETH',
                            name: '以太坊',
                            num: 0.349624,
                            price: 1000
                        }
                    },
                    previewOrder: function(){
                        this.showPopup = true;
                    },
                    subOrder: function(){
                        this.showPopup = false;
                        this.show2FA = true;
                    },
                    toIndex:function () {
                        $state.go('finance.index');
                    },
                    nextStep: function(){
                        this.currencyNum = parseFloat(this.currencyNum);//提现数量字符串转数字
                        //this.v_code = parseFloat(this.v_code);
                        // this.code = parseFloat(this.code);

                        if(!this.currencyAddress){//地址
                            $scope.info.address = true;
                            return false;
                        }
                        if(this.currencyNum < this.list[$stateParams.coin.toUpperCase()] || !$scope.info.currencyNum){//提现数量
                            $scope.info.numError = true;
                            return false;
                        }
                        if(!this.user.mobile){//手机是否验证
                            $scope.g.tip('Error','Your mobile phone is not verified');
                            return false;
                        }
                        if(this.v_code === ''){//手机验证码
                            this.ConfirmCodeErr = true;
                            return false;
                        }
                        if(!this.user.account){//邮箱是否验证
                            $scope.g.tip('Error','Your Email is not verified');
                            return false;
                        }
                        if(this.e_code === ''){//邮箱验证码
                            this.emailCodeErr = true;
                            return false;
                        }
                        if(this.user.tfa_enabled == 0){//未激活2fa
                            this.codeError = true;
                            $scope.g.tip('Error','Your 2FA is not verified');
                            return false;
                        }else {//激活了2fa
                            if(this.code===''){
                                this.codeError = true;
                                return false;
                            }else{
                                //发送提现请求
                                $.ajax({
                                    loading: 1,
                                    method: 'post',
                                    data: {
                                        coin:this.currentBi.coin,//币种
                                        coin_address:this.currencyAddress,//提币地址
                                        amount:this.userGetNumber,//数量currencyNum
                                        sms_id:this.sms_id,
                                        mail_code_id:this.mail_code_id,
                                        sms_code:this.v_code,//短信验证码
                                        mail_code:this.e_code,//短信验证码
                                        tfa_code:this.code//2fa验证码
                                    },
                                    url: '/app/modules/dashboard/finance/data/coin.withdraw.php',
                                    success: function(res){
                                        //this.recharge_address = res.data.data.address;
                                        $.sessionStore.set("depositDetail",{
                                            'coin':$scope.info.currentBi.coin,//币种
                                            'address':$scope.info.currencyAddress,//提币地址
                                            'amount':$scope.info.currencyNum,//数量
                                            'orderId':res.data.orderId,//订单ID
                                            'createdAt':new Date().getTime(),//订单提交时间
                                            'syncBalance': 0 //订单状态
                                        });
                                        $state.go('dashboard.finance.index');
                                        return false;
                                    }
                                },$scope);
                            }
                        }

                    },
                    closePopup: function(){
                        this.showPopup = false;
                    },
                    goBack: function(){
                        window.history.back();
                    },
                    sendCode:function () {
                        //ajax
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                national_code: $scope.info.user.mobile_national_code,
                                mobile: $scope.info.user.mobile
                            },
                            url: 'app/common/data/get.sms.code.php',
                            success: function(res){
                                $scope.info.sms_id = res.data.data.id;
                                //倒计时

                                if(!$scope.info.lock_time){
                                    $scope.info.lock_time = true;

                                    $interval(function () {
                                        if($scope.info.time>0){
                                            $scope.info.time--;
                                            $scope.info.phone_v_code = $scope.info.time + 's';
                                            // console.log($scope.info.phone_v_code);
                                        }else{
                                            $scope.info.phone_v_code = 'send';
                                            $scope.info.lock_time = false;
                                            $scope.info.time = 60;
                                        }
                                    }, 1000,61);
                                }

                            }
                        },$scope);

                    },
                    sendEmailCode:function () {
                        //ajax
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/dashboard/finance/data/get.email.code.php',
                            success: function(res){
                                $scope.info.mail_code_id = res.data.data.mail_code_id;
                                //倒计时

                                if(!$scope.info.lock_time2){
                                    $scope.info.lock_time2 = true;

                                    $interval(function () {
                                        if($scope.info.time2>0){
                                            $scope.info.time2--;
                                            $scope.info.email_v_code = $scope.info.time2 + 's';
                                            // console.log($scope.info.phone_v_code);
                                        }else{
                                            $scope.info.email_v_code = 'send';
                                            $scope.info.lock_time2 = false;
                                            $scope.info.time2 = 60;
                                        }
                                    }, 1000,61);
                                }
                            }
                        },$scope);
                    },
                    list: {//最小提现额度
                        BTC: 0.01,
                        BUT: 100,
                        ETH: 0.015
                    }

                };
                //拿到userinfo
                userInfo.get().then(function(res){
                    //res.data.tfa_enabled == 1 ? $scope.info.show2FA = true : $scope.info.show2FA = false;
                    $scope.info.user = res.data;
                    $scope.info.balance = $scope.g.info.coin_list[$stateParams.coin.toUpperCase()].free;
                    if($stateParams.coin.toUpperCase() === 'BUT'){
                        $scope.info.cost = 50;
                        $scope.info.coin = 'BUT';
                        $scope.info.minNum = '100';
                    }
                    else if ($stateParams.coin.toUpperCase() === 'BTC'){
                        //默认  0.001
                        $scope.info.coin = 'BTC';
                        $scope.info.minNum = '0.01';
                    }
                    else if ($stateParams.coin.toUpperCase() === 'ETH'){
                        $scope.info.cost = 0.005;
                        $scope.info.coin = 'ETH';
                        $scope.info.minNum = '0.015';
                    }
                    else if ($stateParams.coin.toUpperCase() === 'USDT'){
                        $scope.info.cost = 5;
                        $scope.info.coin = 'USDT';
                        $scope.info.minNum = '100';
                    }
                    // userInfo.data.balances 或 $scope.g.info.balances
                    // 提现成功需要修改$scope.g.info.balances对应余额的值 无需刷页面
                    //for(var i in $scope.g.info.balances){
                    //    if($stateParams.coin.toLowerCase() == $scope.g.info.balances[i].symbol){
                    //        //console.log($scope.g.info.balances[i]);
                    //        $scope.info.balance = $scope.g.info.balances[i].free;
                    //    }
                    //}
                });

                $scope.$watch("info.code",function(){//2FA验证码
                    if(!$scope.info.code && $scope.info.code != ''){
                        $scope.info.codeError = true;
                    }
                    else {
                        $scope.info.codeError = false;
                    }
                });
                $scope.$watch("info.v_code",function(){//短信验证码
                    if(!$scope.info.v_code && $scope.info.v_code != ''){
                        $scope.info.ConfirmCodeErr = true;
                    }
                    else {
                        $scope.info.ConfirmCodeErr = false;
                    }
                });
                $scope.$watch("info.currencyAddress",function(){//地址
                    if(!$scope.info.currencyAddress && $scope.info.currencyAddress!==''){
                        $scope.info.address = true;
                    }
                    else {
                        $scope.info.address = false;
                    }
                });
                $scope.$watch("info.currencyNum",function(){//数量
                    if($scope.info.currencyNum && !($scope.info.currencyNum > 0)){
                        $scope.info.numError = true;
                        return false;
                    }else if($scope.info.currencyNum < $scope.info.minNum){
                        $scope.info.numError = true;
                        return false;
                    }else if($scope.info.currentBi && $scope.info.currencyNum > $scope.info.balance){
                        $scope.info.numError = true;
                    }else {
                        $scope.info.numError = false;
                        $scope.info.userGetNumber = ($scope.info.currencyNum - $scope.info.cost) <= 0 ? 0 : $scope.info.coin == 'BUT' ? ($scope.info.currencyNum - $scope.info.cost).toFixed(4) : ($scope.info.currencyNum - $scope.info.cost).toFixed(8);
                    }
                });
            }]
        }
    }
};