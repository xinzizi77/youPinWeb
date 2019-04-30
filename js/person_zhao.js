$(function () {
    $(".mainBox1 button").click(function () {
        // $(".mainBox1").hide();
        $(".mainBox2").show();
        $(".mainBox4").hide();        
        $("#bg").show();
    }) //层次显示

    $(".mainBox2 button").click(function () {
        if ($(".mainBox2 input:lt(3)").val()) {
            $(".mainBox2").hide();
            $(".mainBox4").hide();            
            $("#bg").hide();
            $(".mainBox1").hide();
            $(".mainBox3").show();
            let $html =
                `
            <div class="newInfor">
                <p>招聘${$(".mainBox2 input:eq(0)").val()},需要${$(".mainBox2 input:eq(1)").val()}人，福利:${$(".mainBox2 input:eq(2)").val()}</p>
                <div class="del">删除</div>
            </div>
            `
            $(".mainBox3 ").prepend($html);
            $(".mainBox3 .newInfor .del").click(function () {
                $(this).parent('.newInfor').remove();
            })
        }
    }) //从数据库读出条目

    $(".mainBox3 button").click(function () {
        $(".mainBox2").show();
        $(".mainBox4").hide();        
        $("#bg").show();
        $(".mainBox2 input:lt(7)").val("");
        $(".mainBox2 textarea").val("");
    }) //添加时清空数据

    $(".mainBox2 button").click(function () {
        $.ajax({
            url: "php/uploadJob.php",
            type: "post",
            data: {
                jobName: $(".mainBox2 input:eq(0)").val(),
                needPeople: $(".mainBox2 input:eq(1)").val(),
                monthMoney: $(".mainBox2 input:eq(2)").val(),
                type: $(".mainBox2 input:eq(3)").val(),
                manager_name: $(".mainBox2 input:eq(4)").val(),
                area_a: $(".mainBox2 input:eq(5)").val(),
                info_main: $(".mainBox2 textarea").val()
            },
            success: function (arr) {
                if (arr == "success") {
                    alert("发布成功!");
                    $.ajax({
                        url:"php/mail.php",
                        type:"post",
                        success:function(arr){
                            alert("自动匹配提示:"+arr);
                        }
                    })
                }
            }
        })
    }) //我的招聘发布

    $.ajax({
        url: "php/out_info/uploadjobOut.php",
        type: "post",
        success: function (obj) {
            if(obj!="false"){
            $(".mainBox3").show();
            $(".mainBox1").hide();
            for (var x in obj) {
                let $html =
                    `
            <div class="newInfor">
                <p data-id=${obj[x].id}>招聘${obj[x].jobName},需要${obj[x].needPeople}人，福利:${obj[x].manager_man}</p>
                <div class="del"  data-id=${obj[x].id}>删除</div>
            </div>
            `
                $(".mainBox3 ").prepend($html);
            }//发布信息成功

            $(".mainBox3 .newInfor .del").click(function () {
                console.log($(this).attr("data-id"));
                $.ajax({
                    url:"php/uploadJobDel.php",
                    type:"post",
                    data:{
                        id:$(this).attr("data-id")
                    },
                    success:function(arr){
                        if(arr=="delete success"){
                            alert("删除成功");
                        }
                    }
                })
                $(this).parent('.newInfor').remove();
            })//删除信息

            $(".mainBox3 .newInfor p").click(function(){
                var x=$(this).attr("data-id");
                $.ajax({
                    url:"php/out_info/uploadjobOutGet.php",
                    type:"post",
                    data:{
                        id:$(this).attr("data-id")
                    },
                    success:function(obj){
                        console.log(obj);
                        $("#bg").show(); 
                        $(".mainBox4").show();
                        $(".mainBox4 input:eq(0)").val(obj.jobName);
                        $(".mainBox4 input:eq(1)").val(obj.needPeople);
                        $(".mainBox4 input:eq(2)").val(obj.monthMoney);
                        $(".mainBox4 input:eq(3)").val(obj.type);
                        $(".mainBox4 input:eq(4)").val(obj.manager_man);
                        $(".mainBox4 input:eq(5)").val(obj.area_a);
                        $(".mainBox4 textare").val(obj.info_main);
                        $(".mainBox4 button").click(function () {
                            console.log(x);
                            $.ajax({
                                url: "php/uploadJobChang.php",
                                type: "post",
                                data: {
                                    id:x,
                                    jobName: $(".mainBox4 input:eq(0)").val(),
                                    needPeople: $(".mainBox4 input:eq(1)").val(),
                                    monthMoney: $(".mainBox4 input:eq(2)").val(),
                                    type: $(".mainBox4 input:eq(3)").val(),
                                    manager_name: $(".mainBox4 input:eq(4)").val(),
                                    area_a: $(".mainBox4 input:eq(5)").val(),
                                    info_main: $(".mainBox4 textarea").val()
                                },
                                success: function (arr) {
                                    if (arr == "change success") {
                                        alert("修改成功!");
                                        $(".mainBox2").hide();
                                        $(".mainBox3").show();                                        
                                        $(".mainBox4").hide();
                                        $("#bg").hide();
                                        window.location.reload();                                        
                                    }
                                }
                            })
                        })                    
                    }
                })
            })
            }
        }
    })//导入数据

})