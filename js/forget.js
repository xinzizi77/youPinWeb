$(function () {
    var wait = 60;
    $(".forget input[type=submit]").attr("disabled", "disabled");
    $(".forget .yanzhen button").click(function () {
        if ($(".forget input:eq(0)").val() != "") {
            $.ajax({
                url: "php/LoginAbout/yzmmail.php",
                type: "post",
                data: {
                    email: $(".forget input:eq(0)").val()
                },
                success: function (arr) {
                    console.log(arr);
                    if (arr == "发送成功") {
                        time($(".forget .yanzhen button"));
                        $(".forget input[type=submit]").removeAttr("disabled");
                        $(".forget input[type=submit]").click(function () {
                            $.ajax({
                                url: "php/LoginAbout/yzm_email.php",
                                type: "post",
                                data: {
                                    captcha: $(".forget .yanzhen input").val()
                                },
                                success: function (arr) {
                                    console.log(arr);
                                    if(arr=="true"){
                                       $(".forget").hide();
                                       $(".reset").show();
                                    }
                                    else{
                                        alert("验证码错误");
                                    }
                                }
                            })
                        })
                    } else {
                        alert("您的邮箱无效！");
                    }
                }
            })
        }
    })

    $(".reset input:eq(0)").on("input",function(){
        if(isPassword($(".reset input:eq(0)").val())){
            $(".reset p:eq(0)").show();
        }
        else{
            $(".reset p:eq(0)").hide();            
        }
    })
  
    $(".reset input:eq(1)").on("input",function(){
        if($(".reset input:eq(0)").val()==$(".reset input:eq(1)").val())
        {
            $(".reset p:eq(1)").hide();
        }
        else{
            $(".reset p:eq(1)").show();            
        }
    })

    $(".reset input[type=submit]").click(function(){
        $.ajax({
            url:"php/ForgetPassword/forgetpassword_emil.php",
            type:"post",
            data:{
                email:$(".forget input:eq(0)").val(),
                captcha:$(".forget .yanzhen input").val(),
                newpassword:$(".reset input:eq(0)").val(),
                newpw_check:$(".reset input:eq(0)").val()
            },
            success:function(arr){
                if(arr=="修改成功"){
                    alert("修改成功");
                    window.location.href = "login_reg.html";
                }
                else{
                    alert(arr);
                }
            }
        })
    })
    function time(o) {
        console.log(o);
        if (wait == 0) {
            o.removeAttr("disabled");
            o.html("获取验证码");
            wait = 60;
        } else {
            o.attr("disabled", "disabled");
            o.html(wait+"秒后再获取");
            wait--;
            setTimeout(function () {
                time(o)
            }, 1000)
        }
    }

    //6-16位字母数字组合
    function isPassword(x) {
        var reg = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,16}$/;
        if (x != " " && !reg.test(x)) {
            return 1;
        } else {
            return 0;
        }
    }
})