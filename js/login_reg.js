$(function () {


        //接受URL地址参数 
        function getQueryString(name) {                                       //name为传入参数
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]);
            
            return null;
        }
        var oReg = parseInt(getQueryString('reg'));
        console.log(oReg);
        if(oReg == 2){
            $(".mainBox .login").hide();
            $(".mainBox .register").show();
        }
        else{
            $(".mainBox .login").show();
            $(".mainBox .register").hide();
        }


    var wait = 60;
    $(".login .buttom span:nth-child(1)").click(function () {
        $(".login").hide();
        $(".register").show();
    })
    $(".register .buttom a").click(function () {
        $(".login").show();
        $(".register").hide();
    })

    $(".register input:eq(0)").on("input", function () {
        if (isChinese($(".register input:eq(0)").val())) {
            $(".register span:eq(0)").show();
        } else {
            $(".register span:eq(0)").hide();
        }
    })

    $(".register input:eq(1)").on("input", function () {
        if (isEmail($(".register input:eq(1)").val())) {
            $(".register span:eq(1)").show();
            $(".register span:eq(2)").hide();
        } else {
            $(".register span:eq(1)").hide();
            $.ajax({
                url: "php/LoginAbout/is_email.php",
                type: "post",
                data: {
                    email: $(".register input:eq(1)").val()
                },
                success: function (arr) {
                    if (arr == "false") {
                        $(".register span:eq(2)").hide();
                    } else {
                        $(".register span:eq(2)").show();
                    }
                }
            })
        }
    })

    $(".register input:eq(2)").on("input", function () {
        if (isPassword($(".register input:eq(2)").val())) {
            $(".register span:eq(3)").show();
        } else {
            $(".register span:eq(3)").hide();
        }
    })

    $(".register input:eq(3)").on("input", function () {
        if ($(".register input:eq(3)").val() == $(".register input:eq(2)").val()) {
            $(".register span:eq(4)").hide();
        } else {
            $(".register span:eq(4)").show();
        }
    })

    $(".login input:eq(0)").on("blur", function () {
        $.ajax({
            url: "php/LoginAbout/is_email.php",
            type: "post",
            data: {
                email: $(".login input:eq(0)").val()
            },
            success: function (arr) {
                console.log(arr);
                if (arr == "false") {
                    $(".login span:eq(0)").show();
                    $(".login input:eq(0)").val("");
                } else {
                    $(".login span:eq(0)").hide();
                }
            }
        })
    })

    $(".login input[type=submit]").click(function () {
        // alert("bb");
        $.ajax({
            url: "php/LoginAbout/loginin.php",
            type: "post",
            data: {
                email: $(".login input:eq(0)").val(),
                password: $(".login input:eq(1)").val()
            },
            success: function (arr) {
                if (arr == '1') {
                    $(".login span:eq(1)").hide();
                    // alert("登录成功！");
                    $(".login input:eq(0)").val("");
                    $(".login input:eq(1)").val("");
                    window.location.href = "index.html";
                } else {
                    $(".login span:eq(1)").show();
                }
            }
        })
    })

    $(".login input:eq(1)").keyup(function(event){
        if(event.keyCode ==13){
            $(".login input[type=submit]").trigger("click");
        }
      })
      
    $(".register input[type=submit]").attr("disabled", "disabled");
    $(".register .yanzhen button").click(function () {
        if ($(".register input:eq(1)").val() != "") {
            $.ajax({
                url: "php/LoginAbout/yzmmail.php",
                type: "post",
                data: {
                    email: $(".register input:eq(1)").val()
                },
                success: function (arr) {
                    console.log(arr);
                    if (arr == "发送成功") {
                        time($(".register .yanzhen button"));
                        $(".register input[type=submit]").removeAttr("disabled");
                        $(".register input[type=submit]").click(function () {
                            $.ajax({
                                url: "php/LoginAbout/yzm_email.php",
                                type: "post",
                                data: {
                                    captcha: $(".register .yanzhen input").val()
                                },
                                success: function (arr) {
                                    console.log(arr);
                                    if(arr=="true"){
                                        $.ajax({
                                            url: "php/LoginAbout/regist.php",
                                            type: "post",
                                            data: {
                                                email: $(".register input:eq(1)").val(),
                                                username: $(".register input:eq(0)").val(),
                                                password: $(".register input:eq(2)").val(),
                                                pw_check: $(".register input:eq(3)").val()
                                            },
                                            success: function (arr) {
                                                if (arr == "true") {
                                                    // alert("注册成功");
                                                    $(".register input:eq(0)").val("");
                                                    $(".register input:eq(1)").val("");
                                                    $(".register input:eq(2)").val("");
                                                    $(".register input:eq(3)").val("");
                                                    window.location.href = "regin_info.html";
                                                } else {
                                                    alert(arr);
                                                }
                                            }
                                        })
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

    function time(o) {
        console.log(o);
        if (wait == 0) {
            o.removeAttr("disabled");
            o.html("获取验证码");
            wait = 60;
        } else {
            o.attr("disabled", "disabled");
            o.html(wait + "秒后再获取");
            wait--;
            setTimeout(function () {
                time(o)
            }, 1000)
        }
    }

    //判断是否为4到16位（汉字、数字、字母、下划线）,^ 为匹配输入字符串的开始位置，$ 为匹配输入字符串的结束位置
    function isChinese(x) {
        var reg = /^[a-zA-Z0-9_\u4e00-\u9fa5]{4,16}$/;
        if (x != " " && !reg.test(x)) {
            return 1;
        } else {
            return 0;
        }
    }

    //判断是否为正确的邮箱地址格式
    function isEmail(x) {
        var reg = /^([a-zA-Z0-9]+[-|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[-|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if (x != " " && !reg.test(x)) {
            return 1;
        } else {
            return 0;
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