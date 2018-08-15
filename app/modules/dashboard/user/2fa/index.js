/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/2fa',
    views: {
        'user': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', '$interval', '$translate', function($scope, $http, $cookies, $state, $, userInfo, $interval, $translate){
                $scope.g.currPage = 'user';
                $scope.userInfo.menu = "2fa";
                $scope.userInfo.openSubMenu.securitySettings = false;

                $scope.info = {
                    url:'',
                    user:{},
                    untie:false,//解绑2fa
                    phoneCodeError:false,
                    emailCodeError:false,
                    twoFaCodeError:false,
                    phoneCode:'',
                    emailCode:'',
                    twoFACode:'',
                    phoneTime:60,//发送手机验证码时间
                    emailTime:60,//发送邮箱验证码时间
                    lockPhoneTime:false,//锁定验证码按钮
                    lockEmailTime:false,//锁定邮箱验证码按钮
                    // phone_v_code:'send',
                    // email_v_code:'send',
                    tfa: function(){
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/dashboard/user/data/2fa.php',
                            success: function(res){
                                $scope.info.url = res.data.data.otp_uri;
                                $scope.info.secret = res.data.data.secret;
                            },
                            error: function(res){
                                if(res.data.errMsg == '2FA already enabled'){
                                    $scope.info.showSuccess = true;
                                }else{
                                    $scope.g.tip($translate.instant('300008'), res.data.errMsg);
                                }
                            }
                        },$scope);
                    },
                    goActivate: function(){
                        if($scope.info.loading){
                            return false;
                        }
                        if(!$scope.info.code){
                            $scope.g.tip($translate.instant('300008'), $translate.instant('100210'));
                            return false;
                        }

                        $.ajax({
                            loading: 2,
                            method: 'post',
                            data: {
                                code: $scope.info.code
                            },
                            url: 'app/modules/dashboard/user/data/2fa.activate.php',
                            success: function(res){
                                $scope.info.showSuccess = true;
                                $scope.g.info.tfa_enabled = 1;
                            }
                        },$scope);
                    },
                    unActive:function () {//解绑2fa
                        if(!$scope.info.phoneCode){
                            $scope.info.phoneCodeError = true;
                            return false;
                        }
                        if(!$scope.info.emailCode){
                            $scope.info.emailCodeError = true;
                            return false;
                        }
                        if(!$scope.info.twoFACode){
                            $scope.info.twoFaCodeError = true;
                            return false;
                        }
                        //ajax
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data:{
                                sms_code:$scope.info.phoneCode,
                                mail_code:$scope.info.emailCode,
                                tfa_code:$scope.info.twoFACode,
                                sms_id:$scope.info.sms_id,
                                mail_code_id:$scope.info.mail_code_id
                            },
                            url: 'app/modules/dashboard/user/data/cancel.2fa.php',
                            success: function(res){
                                $scope.info.showSuccess = false;
                                $scope.info.untie = false;
                                $scope.info.tfa();
                            }
                        },$scope);
                        /*$http.post("modules/user/data/cancel.2fa.php",{
                            sms_code:$scope.info.phoneCode,
                            mail_code:$scope.info.emailCode,
                            tfa_code:$scope.info.twoFACode,
                            sms_id:$scope.info.sms_id,
                            mail_code_id:$scope.info.mail_code_id
                        }).then(function (res) {
                            if(res.data.resultCode === 0){
                                $scope.info.showSuccess = false;
                                $scope.info.untie = false;
                                $scope.info.tfa();
                            }else{
                                $scope.g.tip($translate.instant('300017'),res.data.errMsg);
                                return false;
                            }
                        },function () {
                            $scope.g.tip($translate.instant('300017'),$translate.instant('300017'));
                        });*/
                    },
                    sendPhoneCode:function () {
                        if(!$scope.info.lockPhoneTime){
                            $scope.info.lockPhoneTime = true;//锁定按钮

                            $http.post("app/common/data/get.sms.code.php",{
                                national_code: $scope.info.user.mobile_national_code,
                                mobile: $scope.info.user.mobile
                            }).then(function (res) {
                                if(res.data.resultCode == 0){
                                    $scope.info.sms_id = res.data.data.id;
                                    //倒计时
                                    var time1 = $interval(function () {
                                        if($scope.info.phoneTime>0){
                                            clearInterval(time1);
                                            $scope.info.phoneTime--;
                                            $scope.info.phone_v_code = $scope.info.phoneTime + 's';
                                        }else{
                                            $scope.g.currLang === 'cn' ? $scope.info.phone_v_code = '重新获取' : $scope.info.phone_v_code = 'send';
                                            $scope.info.lockPhoneTime = false;
                                            $scope.info.phoneTime = 60;
                                        }
                                    }, 1000,61);
                                }else{
                                    $scope.g.tip('Err:resultCode '+res.data.resultCode,res.data.errMsg);
                                    return false;
                                }

                            },function () {
                                $scope.info.lockPhoneTime = false;//解锁按钮
                                $scope.g.tip('Err','server error');
                            });
                        }
                    },
                    sendEmailCode:function () {
                        if(!$scope.info.lockEmailTime){
                            $scope.info.lockEmailTime = true;

                            $http.post("app/common/data/get.email.code.php").then(function (res) {
                                if(res.data.resultCode == 0){
                                    $scope.info.mail_code_id = res.data.data.mail_code_id;
                                    //倒计时
                                    var time2 = $interval(function () {
                                        if($scope.info.emailTime>0){
                                            clearInterval(time2);
                                            $scope.info.emailTime--;
                                            $scope.info.email_v_code = $scope.info.emailTime + 's';
                                            // console.log($scope.info.phone_v_code);
                                        }else{
                                            $scope.g.currLang === 'cn' ? $scope.info.email_v_code = '重新获取' : $scope.info.email_v_code = 'send';
                                            $scope.info.lockEmailTime = false;
                                            $scope.info.emailTime = 60;
                                        }
                                    }, 1000,61);
                                }else{
                                    $scope.info.lockEmailTime = false;
                                    $scope.g.tip('Err:resultCode '+res.data.resultCode,res.data.errMsg);
                                    return false;
                                }

                            },function () {
                                $scope.info.lockEmailTime = false;
                                $scope.g.tip('Err','server error');
                            });
                        }

                    }
                };

                /*if($scope.g.currLang === 'cn'){
                    $scope.info.phone_v_code = '获取验证码';
                    $scope.info.email_v_code = '获取验证码';
                }else {
                    $scope.info.phone_v_code = 'send';
                    $scope.info.email_v_code = 'send';
                }*/
                userInfo.get().then(function(userInfo){
                    $scope.info.user = userInfo.data;
                    if($scope.g.info.tfa_enabled == 1){
                        $scope.info.showSuccess = true;
                    }else{
                        $scope.info.tfa();
                    }
                });

                $scope.$watch("info.phoneCode",function(){//手机验证码
                    if(!$scope.info.phoneCode && $scope.info.phoneCode!==''){
                        $scope.info.phoneCodeError = true;
                    }
                    else {
                        $scope.info.phoneCodeError = false;
                    }
                });
                $scope.$watch("info.emailCode",function(){//邮箱验证码
                    if(!$scope.info.emailCode && $scope.info.emailCode!==''){
                        $scope.info.emailCodeError = true;
                    }
                    else {
                        $scope.info.emailCodeError = false;
                    }
                });
                $scope.$watch("info.twoFACode",function(){//2FA验证码
                    if(!$scope.info.twoFACode && $scope.info.twoFACode!==''){
                        $scope.info.twoFaCodeError = true;
                    }
                    else {
                        $scope.info.twoFaCodeError = false;
                    }
                });
            }]
        }
    },
    resolve: {
        '2fa': ['$ocLazyLoad', function($ocLazyLoad){
            return $ocLazyLoad.load({
                name: '2fa',
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