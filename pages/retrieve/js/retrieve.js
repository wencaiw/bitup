/**
 * Created by Wangyao on 2018/3/19.
 */
$(function(){
    //输入账户
    $('#retrieve-verify-sub').click(function(){
        //正在执行
        if(!$(this).find(".icon-loading").is(":hidden")){
            return false;
        }
        retrieveVerify();
    });
    $('#account').keyup(function(event){
        if(event.keyCode ==13){
            retrieveVerify();
        }
    });
    function retrieveVerify(){
        var account = $('#account').val();
        //输入框不能为空
        if(!account){
            $('#retrieve-verify .temp-box .error').html('email cannot be empty');
            return false;
        }
        //验证格式
        var regEmail = "^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$";
        //验证Mail的正则表达式,^[a-zA-Z0-9_-]:开头必须为字母,下划线,数字,
        if (!account.match(regEmail)) {
            $('#retrieve-verify .temp-box .error').html('Incorrect email format');
            return false;
        }
        $("#retrieve-verify-sub > span").hide();
        $("#retrieve-verify-sub > .icon-loading").show();
        var params ={
            account: account
        };
        $.ajax({
            type: "post",
            url: "data/get.code.php",
            data: params,
            success: function(data){
                console.log(data);
                $("#retrieve-verify-sub > span").show();
                $("#retrieve-verify-sub > .icon-loading").hide();
                if(data.resultCode == 0){
                    $('#retrieve-set .temp-box .error').html('Email verification code has been sent');
                    $('#retrieve-verify').css({'display': 'none'});
                    $('#retrieve-set').css({'display': 'block'});
                }else{
                    $('#retrieve-verify .temp-box .error').html(data.errMsg);
                }
            }
        });
    }

    //修改密码
    $('#retrieve-set-sub').click(function(){
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
            $('#retrieve-set .temp-box .error').html('code cannot be empty');
            return false;
        }
        if(!/[a-zA-Z]+/.test(pwd) || !/\d+/.test(pwd) || !/^\S{8,20}$/.test(pwd)){
            $('#retrieve-set .temp-box .error').html('Incorrect password format');
            return false;
        }
        //两次密码不一致
        if(pwd != rePwd){
            $('#retrieve-set .temp-box .error').html('Entered passwords differ');
            return false;
        }
        $("#retrieve-set-sub > span").hide();
        $("#retrieve-set-sub > .icon-loading").show();
        $.ajax({
            type: "post",
            url: "data/modify.pwd.php",
            data: {
                account: account,
                code: code,
                pwd: hex_hmac_md5(account, pwd)
            },
            success: function(data){
                console.log(data);
                $("#retrieve-set-sub > span").show();
                $("#retrieve-set-sub > .icon-loading").hide();
                if(data.resultCode == 0){
                    //window.location.href = "/dashboard";
                    $('#retrieve-set').hide();
                    $("#retrieve-success").show();
                    var time = 3;
                    $("#retrieve-success-sub > span").text(time);
                    var loginTimer = setInterval(function(){
                        time--;
                        if(time==0){
                            window.location.href = "/login/";
                            clearInterval(loginTimer);
                        }
                        $("#retrieve-success-sub > span").text(time);
                    },1000);
                }else{
                    $('#retrieve-set .temp-box .error').html(data.errMsg);
                }
            }
        });
    }

    $('#again-try').click(function(){
        //location.reload();
        $('#code, #pwd, #re-pwd').val("");
        $('#retrieve-verify').css({'display': 'block'});
        $('#retrieve-set').css({'display': 'none'});
    });

    //文本框获得焦点后取消报错信息
    $(".login-main .input-text").focus(function(){
        $('.login-main .error').html("");
    });

    //注册输入密码获得焦点后显示提示浮框
    $("#pwd").focus(function(){
        $(this).siblings(".tips").show();
    });
    $("#pwd").blur(function(){
        $(this).siblings(".tips").hide();
    });
    // 修改成功点击跳入登录页面
    $("#retrieve-success-sub").click(function(){
        window.location.href = "/login/";
    });
});
