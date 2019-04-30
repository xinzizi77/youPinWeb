$(function () {

    $.ajax({
        url:"php/head_picture.php",
        type:"post",
        success:function(arr){ 
            if(arr!=""){
                $(".left .pic img").attr("src",arr);
                $(".right .informa .phot #up").attr("src", arr);
            }
            else{
                $(".right .informa .phot #up").attr("src", "./upload/0_version_pictrues.jpg");
            }
        }
    })
    //用户头像对应

    $.ajax({
        url:"php/out_info/username.php",
        type:"post",
        success:function(arr){
            $(".right .user").html(arr+"，你好！");
        }
    })

    $("#logout").click(function(){
        $.ajax({
            url:"php/LoginAbout/loginout.php",
            type:"post",
            success:function(arr){
                alert(arr);
                window.location.href="index.html";
            }
        })
    })
    //退出登录

    $(".left li").mouseover(function () {
        var th = $(this);
        if (!(th.hasClass("on"))) {
            th.addClass("on");
            th.mouseout(function () {
                th.removeClass("on");
            })
        }
    })
    //侧栏导航移入移出效果

    $("footer").css("top", $(document).height());
    //以上是对标签移入移出的效果及footer的位置设置

    
    $(".right .mainBox2 span").click(function () {
        $(".right .mainBox2").hide();
        $("#bg").hide();
    })
    $(".right .mainBox4 span").click(function () {
        $(".right .mainBox4").hide();
        $("#bg").hide();
    })
    //对第二张页面的叉叉处理

    $(".informa input[type='submit']").click(function () {
        var formData = new FormData();
        formData.append("file", $("#file")[0].files[0]);
        $.ajax({
            url: "php/upload_file.php",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            // dataType: "json",
            success: function (arr) {
                $(".right .informa .phot #up").attr("src", arr);
                // $(".left .pic img").attr("src",arr);                
            }
        })
    })
    //以下是对个人信息的处理

    $(".right .box_pass input:eq(2)").on("input", function () {
        if ($(".right .box_pass input:eq(2)").val() == $(".right .box_pass input:eq(1)").val()) {
            $(".right .box_pass span:eq(0)").hide();
        } else {
            $(".right .box_pass span:eq(0)").show();
        }
    })
    //判断新密码的两次输入是否一致

    $(".right .box_pass button").click(function () {
        $.ajax({
            url: "php/ForgetPassword/forgetpassword_2.php",
            type: "post",
            data: {
                oldPw: $(".right .box_pass input:eq(0)").val(),
                newPw: $(".right .box_pass input:eq(1)").val(),
                Pw_check: $(".right .box_pass input:eq(2)").val()
            },
            success: function (arr) {
                if (arr == "success") {
                    alert("修改成功");
                    $(".right .box_pass input:lt(3)").val("");
                } else {
                    alert("原密码错误！");
                }
            }
        })
    })
    //对个人中心的修改密码请求

    $(".right .company button").click(function(){
        $.ajax({
            url:"php/companyinfo.php",
            type:"post",
            data:{
               company_name:$(".right .company input:eq(0)").val(),
               company_type:$(".right .company input:eq(1)").val(),
               company_property:$(".right .company input:eq(2)").val(),
               company_info:$(".right .company textarea").val(),
               charger_man:$(".right .company input:eq(3)").val(),
               company_phone:$(".right .company input:eq(4)").val(),
               company_place_p:$(".right .company input:eq(5)").val(),
               company_place_c:$(".right .company input:eq(6)").val(),
               main_place:$(".right .company input:eq(7)").val()
            },
            success:function(arr){
                if(arr=="successupdate"){
                    alert("保存成功");
                }
            }
        })
    })//公司信息的存储

    $.ajax({
        url:"php/out_info/companyinfoOut.php",
        type:"post",
        success:function(arr){
            console.log(arr);
            $(".right .company input:eq(0)").val(arr.company_name);
            $(".right .company input:eq(1)").val(arr.company_type);
            $(".right .company input:eq(2)").val(arr.company_property);
            $(".right .company textarea").val(arr.company_info);
            $(".right .company input:eq(3)").val(arr.charger_man);
            $(".right .company input:eq(4)").val(arr.company_phone);
            $(".right .company input:eq(5)").val(arr.company_place_p);
            $(".right .company input:eq(6)").val(arr.company_place_c);
            $(".right .company input:eq(7)").val(arr.main_plcae);            
        }
    })//公司信息

    $(".right .informa button").click(function(){
        $.ajax({
            url:"php/person_info.php",
            type:"post",
            data:{
                username:$(".right .informa input:eq(0)").val(),
                sex:$('.right .informa input:radio[name="sex"]:checked').val(),
                birth:$(".right .informa input:eq(5)").val()
            },
            success:function(arr){
                if(arr=="success"){
                    alert("保存成功");
                }
            }
        })
    })//个人资料的baocun

    $.ajax({
        url:"php/out_info/person_infoOut.php",
        type:"get",
        dataType:"json",
        success:function(obj){
            console.log(obj);
            $(".right .informa input:eq(0)").val(obj.username);
            if(obj.sex=="女"){
                $(".right .informa input:eq(4)").attr("checked","true");
            }
            var data=obj.birth;console.log(data);
            var data1=data.split(" ");
            $(".right .informa input:eq(5)").val(data1[0]);
        }
    })

    $("footer .fRight button").click(function(){
        if($("footer .fRight textarea").val()==""){
            alert("请输入反馈意见");
        }
        else{
            $.ajax({
                url:"php/feedback.php",
                type:"post",
                data:{
                    "feedback":$("footer .fRight textarea").val()
                },
                success:function(arr){
                    if(arr=="ture"){
                        alert("反馈成功！");
                        $("footer .fRight textarea").val(" ");
                    }
                }
            })
        }
    })
})