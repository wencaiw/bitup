/**
 * Created by Hajay on 2018/3/5.
 */
$(function(){
    var token = '',
        user_id = '',
        account = '';

    //登录
    $('#login-sub').click(function(){
        //正在执行
        if(!$(this).find(".icon-loading").is(":hidden")){
            return false;
        }
        loginSub(false);
    });
    $('#account,#pwd').keyup(function(event){
        if(event.keyCode ==13){
            loginSub(false);
        }
    });
    $('#tfa_code').bind('input propertychange',function(){
        if ($(this).val().length == 6 ) {
            loginSub(true);
        }
    });
    function loginSub(tfa){
        var pwd = $('#pwd').val(),
        account = $('#account').val().toLowerCase();
        if(!pwd || !account){
            $('#login p.error').html("Please enter your email or password");
            return false;
        }
        if(tfa){
            var tfa_code = $('#tfa_code').val();
            if(!tfa_code){
                $('#login-2fa p.error').html("Please enter 2FA code");
                return false;
            }
            $("#confirm > span").hide();
            $("#confirm > .icon-loading").show();
        }else{
            $("#login-sub > span").hide();
            $("#login-sub > .icon-loading").show();
        }
        $.ajax({
            type: "get",
            url: "/common/data/login.php",
            data: {
                account: account,
                pwd: hex_hmac_md5(account, pwd),
                tfa_code: tfa_code
            },
            success: function(data){
                console.log(data);
                if(tfa){
                    $("#confirm > span").show();
                    $("#confirm > .icon-loading").hide();
                }else{
                    $("#login-sub > span").show();
                    $("#login-sub > .icon-loading").hide();
                }

                if(data.resultCode == 0){
                    if(data.data.token){
                        window.location.href = "/dashboard";
                    }else if(data.data.tfa_enabled){
                        $('#login').css({'display': 'none'});
                        $('#login-2fa').css({'display': 'block'});
                        token = data.data.token;
                        user_id = data.data.id;
                    }
                }else{
                    if(tfa){
                        $('#login-2fa p.error').html(data.errMsg);
                    }else{
                        $('#login p.error').html(data.errMsg);
                    }
                }
            }
        });
    }

    //2fa
    $('#confirm').click(function(){
        //正在执行
        if(!$(this).find(".icon-loading").is(":hidden")){
            return false;
        }
        //tfaConfirm();
        loginSub(true);
    });
    $('#tfa_code').keyup(function(event){
        if(event.keyCode ==13){
            loginSub(true);
        }
    });
    function tfaConfirm(){
        var code = $('#code').val();
        if(!code){
            $('#login-2fa p.error').html("Please enter your code");
            return false;
        }
        $.ajax({
            type: "post",
            url: "common/data/2fa.verify.php",
            data: {
                token: token,
                user_id: user_id,
                account: account,
                code: code
            },
            success: function(data){
                console.log(data);
                if(data.resultCode == 0){
                    window.location.href = "/dashboard";
                }else{
                    $('#login-2fa .error').html(data.errMsg);
                }
            }
        });
    }

    //取消
    $('#cancel').click(function(){
        $('#login').css({'display': 'block'});
        $('#login-2fa').css({'display': 'none'});
        $('#login-2fa p.error').html('');
        $('#tfa_code').val('');
    });

    //文本框获得焦点后取消报错信息
    $(".login-main .input-text").focus(function(){
        $('.login-main .error').html("");
    });

    //登录成功后的退出账号按钮
    $("#logoutBtn").click(function(){
        $("#logout")[0].click();
    });
});
