$(function(){
    $(".mainbox button").click(function(){
        $.ajax({
            url:"php/person_job.php",
            type:"post",
            data:{
                job_type:$(".mainbox input:eq(0)").val(),
                work_place:$(".mainbox input:eq(1)").val(),
                want_money:$(".mainbox input:eq(2)").val(),
                name:$(".mainbox input:eq(3)").val(),
                sex:$('.mainbox input:radio[name="sex"]:checked').val(),
                birthday:$(".mainbox input:eq(6)").val(),
                phone_number:$(".mainbox input:eq(7)").val()
            },
            success:function(arr){
                if(arr=="success"){
                    window.location.href = "index.html";
                }
            }
        })
    })

    $(".mainBox1 button").click(function(){
        // $(".mainBox1").hide();
        $(".mainBox2").show();
        $("#bg").show();        
    })//不同框的显示

    $(".mainBox2 button").click(function(){
        $(".mainBox2").hide();
        $("#bg").hide(); 
        $(".mainBox1").hide();
        $(".mainBox3").show();
        $(".mainBox3 input[name='type']").val($(".mainBox2 input[name='type']").val());
        $(".mainBox3 input[name='location']").val($(".mainBox2 input[name='location']").val());        
        $(".mainBox3 input[name='price']").val($(".mainBox2 input[name='price']").val());        
        $(".mainBox3 input[name='name']").val($(".mainBox2 input[name='name']").val());        
        $(".mainBox3 input[name='sex']").val($('.right .mainBox2 input:radio[name="sex"]:checked').val());        
        $(".mainBox3 input[name='date']").val($(".mainBox2 input[name='date']").val());
        $(".mainBox3 input[name='number']").val($(".mainBox2 input[name='number']").val());
        $("footer").css("top", $(document).height());                                  
    })//发布后框内内容清空

    $(".mainBox3 button").click(function(){
        $(".mainBox2").show();
        $("#bg").show();                
    })//框的显示

    $(".right .mainBox2 button").click(function(){
        $.ajax({
            url:"php/person_job.php",
            type:"post",
            data:{
                job_type:$(".right .mainBox2 input:eq(0)").val(),
                work_place:$(".right .mainBox2 input:eq(1)").val(),
                want_money:$(".right .mainBox2  input:eq(2)").val(),
                name:$(".right .mainBox2 input:eq(3)").val(),
                sex:$('.right .mainBox2 input:radio[name="sex"]:checked').val(),
                birthday:$(".right .mainBox2 input:eq(6)").val(),
                phone_number:$(".right .mainBox2 input:eq(7)").val()
            },
            success:function(arr){
                if(arr=="success"){
                    alert("发布成功");
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
    })//存储个人简历信息

    $.ajax({
        url:"php/out_info/person_jobout.php",
        type:"post",
        success:function(obj){
            if(obj!=""){
                $(".right .mainBox1").hide();
                $(".right .mainBox3").show();
                $(".right .mainBox3 input:eq(0)").val(obj[0].jobType);
                $(".right .mainBox3 input:eq(1)").val(obj[0].work_plcae);
                $(".right .mainBox3 input:eq(2)").val(obj[0].want_money);
                $(".right .mainBox3 input:eq(3)").val(obj[0].name);
                $(".right .mainBox3 input:eq(4)").val(obj[0].sex);
                var data=obj[0].birth.split(' ');
                $(".right .mainBox3 input:eq(5)").val(data[0]);
                $(".right .mainBox3 input:eq(6)").val(obj[0].phone_number);
            }
            $(".right .mainBox3").click(function(){
                $(".right .mainBox2 input:eq(0)").val($(".right .mainBox3 input:eq(0)").val());
                $(".right .mainBox2 input:eq(1)").val($(".right .mainBox3 input:eq(1)").val());
                $(".right .mainBox2 input:eq(2)").val($(".right .mainBox3 input:eq(2)").val());
                $(".right .mainBox2 input:eq(3)").val($(".right .mainBox3 input:eq(3)").val());
                if($(".right .mainBox3 input:eq(4)").val()=="女"){
                    $(".right .mainBox2 input:eq(5)").attr("checked","true");
                }
                $(".right .mainBox2 input:eq(6)").val($(".right .mainBox3 input:eq(5)").val());
                $(".right .mainBox2 input:eq(7)").val($(".right .mainBox3 input:eq(6)").val());
            })            
        }
    })
})