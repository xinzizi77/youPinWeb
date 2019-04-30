

$(function() {


    $.ajax({
        url: 'php/out_info/ip.php',
        type: 'post',
        success: function (talk) {
            $("#chengshi").val(talk);
            console.log(talk);
        }

    });


    $('.city').find('p').click(function() {
            if($('.cities').css('display') == 'block') {
                $('.cities').css('display', 'none')
            } else {
                $('.cities').css('display' ,'block')
            }
        });
       header();
    // ------------------------------------------
    $(".work-box").each(function(){
        $(this).mouseover(function() {
            $(this).find('.yinying').css({
                'background-color': 'rgba(0,0,0,0)',
                'transition-duration':"0.5"
            });
            $(this).find('h2').css({
                'color': '#ffffff',
                'transition-duration':"0.5"
            })

        });
        $(this).mouseout(function() {
            $(this).find('.yinying').css({
                'background-color':'rgba(0,0,0,0.2)',
                'transition-duration':"0.5"
            });
            $(this).find('h2').css({
                'color': '#ffffff',
                'transition-duration':"0.5"
            })
        })
    });
    $.ajax({
        url: 'php/jobAutoFind.php',
        type: 'post',
        success: function (talk) {
            console.log(talk);
        },
        error:function(a){
            console.log(a);
        }

    });

})