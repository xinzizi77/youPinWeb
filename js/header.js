
function header() {

    $.ajax({
        url: 'php/out_info/username.php',
        type: 'post',
        success: function (talk) {
            $("#name").text(talk);
            console.log(talk);
            if($("#name").text()!=''){
                $(".less").css("display",'none');
                $(".more").css("display",'block');
                $("#name").css("color","#57bc90");
            }else{
                $(".less").css("display",'block');
                $(".more").css("display",'none');
            }

            $('.exit').click(function (){
                $.ajax({
                    url: 'php/LoginAbout/loginout.php',
                    type: 'post',
                    success: function (talk) {
                        
                        $("#name").text('');
                        $('.more').css({
                            'display':'none'
                        })
                        $('.less').css({
                            'display':'block'
                        })
                        alert(talk);
                    }

                });
            });
            
        },
        error: function (a) {
            console.log(a);
            
        }
    });

    $('.fu').click(function () {
        $('#fabu').css({
            'display':'block'
        });
        $('.fu').removeClass('more-a').addClass('more-a-color');
    });
    $('.fabu-bg i').click(function () {
        $('#fabu').css({
            'display':'none'
        });
        $('.fu').removeClass('more-a-color').addClass('more-a');
    });
    // --------------------------
    $('.exit').click(function(){
        $('.more').css({
            'display':'none'
        })
        $('.less').css({
            'display':'block'
        })

    });

    $(document).scroll(function() {
        // console.log($("#header").offset().top);
        if( $("#header").offset().top > 0){
            $('#header').css({
                'height':'70px',
                'background-color': 'rgba(225,225,225,0.9)',
                'box-shadow': '0 0 5px #888888',
                'transition-duration': '0.5s'
            });
            $('.head img').css({
                'margin-top': '10px',
                'transition-duration': '0.5s'
            });
            $('.head p').css({
                'line-height': '70px',
                'transition-duration': '0.5s'
            });
            $('.head ul li').css({
                'margin-top': '20px',
                'transition-duration': '0.5s'
            });
            $('#top').css({
                'margin-top':'-10px',
                'transition-duration': '0.5s'
            });
            $('#banner').css({
                'margin-top':'-10px',
                'transition-duration': '0.5s'
            });
            $('.concent').css({
                'margin-top':'-10px',
                'transition-duration': '0.5s'
            });
            // --------------------------------search.html-----------------------------------------
            $('.address').css({
                'line-height': '70px',
                'transition-duration': '0.5s'
            });
        }else {
            $('#header').css({
                'height':"80px",
                'background-color': ' rgba(100%,100%,100%,1)',
                'transition-duration': '0.5s'
            });
            $('.head img').css({
                'margin-top': '15px',
                'transition-duration': '0.5s'
            });
            $('.head p').css({
                'line-height': '80px',
                'transition-duration': '0.5s'
            });
            $('.head ul li').css({
                'margin-top': '25px',
                'transition-duration': '0.5s'
            });
            $('#banner').css({
                'margin-top':'0',
                'transition-duration': '0.5s'
            });
            $('#top').css({
                'margin-top':'0',
                'transition-duration': '0.5s'
            });
            $('.concent').css({
                'margin-top':'0',
                'transition-duration': '0.5s'
            });
            // --------------------------------search.html-----------------------------------------
            $('.address').css({
                'line-height': '80px',
                'transition-duration': '0.5s'
            });
        }
    });


}

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
});