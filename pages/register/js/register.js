/**
 * Created by Hajay on 2018/3/5.
 */
$(function(){
    //注册
    $('#register-verify-sub').click(function(){
        //正在执行
        if(!$(this).find(".icon-loading").is(":hidden")){
            return false;
        }
        registerVerify();
    });
    $('#account').keyup(function(event){
        if(event.keyCode ==13){
            registerVerify();
        }
    });
    function registerVerify(){
        var account = $('#account').val(),
            agree = $('#register-verify input[type=checkbox]').prop('checked');
        //输入框不能为空
        if(!account){
            $('#register-verify .temp-box .error').html('email cannot be empty');
            return false;
        }
        //验证格式
        var regEmail = "^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$";
        //验证Mail的正则表达式,^[a-zA-Z0-9_-]:开头必须为字母,下划线,数字,
        if (!account.match(regEmail)) {
            $('#register-verify .temp-box .error').html('Incorrect email format');
            return false;
        }
        if(!window.recaptcha_code){
            $('#register-verify .temp-box .error').html('RECAPTCHA error, if Google RECAPTCHA cannot be displayed, please switch to a network in which it can be shown');
            return false;
        }
        if(!agree){
            $('#register-verify .temp-box .error').html('Please check the Terms Of Service');
            return false;
        }
        $("#register-verify-sub > span").hide();
        $("#register-verify-sub > .icon-loading").show();
        $.ajax({
            type: "post",
            url: "data/get.verify.code.php",
            data: {
                account: account,
                recaptcha: window.recaptcha_code
            },
            success: function(data){
                console.log(data);
                $("#register-verify-sub > span").show();
                $("#register-verify-sub > .icon-loading").hide();
                if(data.resultCode == 0){
                    $('#register-set .temp-box .error').html('Email verification code has been sent');
                    $('#register-verify').css({'display': 'none'});
                    $('#register-set').css({'display': 'block'});
                }else{
                    $('#register-verify .temp-box .error').html(data.errMsg);
                }
            }
        });
    }

    //注册
    $('#register-set-sub').click(function(){
        //正在执行
        if(!$(this).find(".icon-loading").is(":hidden")){
            return false;
        }
        verifySet();
    });
    $('#code,#pwd,#re-pwd').keyup(function(event){
        if(event.keyCode ==13){
            verifySet();
        }
    });
    function verifySet(){
        var account = $('#account').val().toLowerCase(),
            code = $('#code').val(),
            pwd = $('#pwd').val(),
            rePwd = $('#re-pwd').val();

        //code不能为空
        if(!code){
            $('#register-set .temp-box .error').html('code cannot be empty');
            return false;
        }
        if(!/[a-zA-Z]+/.test(pwd) || !/\d+/.test(pwd) || !/^\S{8,20}$/.test(pwd)){
            $('#register-set .temp-box .error').html('Incorrect password format');
            return false;
        }
        //两次密码不一致
        if(pwd != rePwd){
            $('#register-set .temp-box .error').html('Entered passwords differ');
            return false;
        }
        $("#register-set-sub > span").hide();
        $("#register-set-sub > .icon-loading").show();
        $.ajax({
            type: "post",
            url: "data/register.php",
            data: {
                account: account,
                code: code,
                pwd: hex_hmac_md5(account, pwd),
                referral: window.referral
            },
            success: function(data){
                console.log(data);
                $("#register-set-sub > span").show();
                $("#register-set-sub > .icon-loading").hide();
                if(data.resultCode == 0){
                    //window.location.href = "/dashboard";
                    window.location.href = "/login/";
                }else{
                    $('#register-set .temp-box .error').html(data.errMsg);
                }
            }
        });
    }

    $('#again-try').click(function(){
        //window.verifyCallback();
        $('#register-verify').css({'display': 'block'});
        $('#register-set').css({'display': 'none'});
        $('#code,#pwd,#re-pwd').val("");
    });

    //文本框获得焦点后取消报错信息
    $(".login-main .input-text").focus(function(){
        $('.login-main .error').html("");
    });
    //点击身份验证清空报错信息
    $("#g_verify_code").click(function(){
        $('.login-main .error').html("");
    });

    //注册输入密码获得焦点后显示提示浮框
    $("#pwd").focus(function(){
        $(this).siblings(".tips").show();
    });
    $("#pwd").blur(function(){
        $(this).siblings(".tips").hide();
    });
});
