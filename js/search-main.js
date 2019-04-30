$(function () {
    header();

    //接受URL地址参数 
    function getQueryString(name) {  //name为传入参数
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
    var codeId = parseInt(getQueryString('code_id'));

    $.ajax({
        url: 'php/out_info/main_info.php',
        type: 'get',
        data:{
            id : codeId,
        },
        success: function (talk) {
            let html =
            `
            <p><span class="zhiye">${talk.jobName}</span> / <span class="qian">${talk.monthMoney}</span></p>
            <div class="collect">收藏</div>
            <div class="push"><a href="${talk.href}">投放简历</a></div>
            `
            $(".flex").append(html);

            let html1=
            `
            <div class="job-box">
            <ul class="box-main">
                <li>
                    <a class="job-name" href="javascript:void(0);">${talk.jobName}</a>
                </li>
                <li>
                    <div class="job-txt">学历：${talk.eduRequire}
                        <span>|</span>经验：${talk.expRequire}
                        <span>|</span>工作类型 ：${talk.type}
                        <span>|</span>人数：${talk.needPeople}
                        <span>|</span>地点：${talk.area_a}/${talk.area_b}/${talk.area_c}
                    </div>
                </li>
                <li>
                    <div class="money">${talk.monthMoney}</div>
                </li>
                <li>
                    <div class="weal">
                    ${talk.conditions}
                    </div>
                </li>
            </ul>
            <div class="job-right">
                <p class="company">${talk.company_name}</p>
                <div class="company-main"><a href="${talk.href}"> <i class="fa fa-paper-plane fa-1x"></i>投放简历</a></div>
                <div class="love">
                    <a class="a" code="${talk.id}" href="javascript:void(0);">
                        <i class="fa fa-star-o fa-lg"></i>收藏</a>
            </div>
            </div>
        </div>
            `
            $("#main-bg").append(html1);



            let html2 = 
            `
            <div class="position-details">
                <h1>职位详情</h1>
                <article>
               ${talk.main}
                </article>
            </div>
            <div class="boss">
                <h1>职位发布者</h1>
                <div class="picture"></div>
                <span class="boss-name"> ${talk.manager_name}</span>
                <p class="phone">联系电话：<span>无</span></p>
            </div>

            `
            $(".left").append(html2);


            let html3 = 
            `
            <div class="gongsi">
            <h1>${talk.company_name}</h1>
            <p><i class="fa fa-home fa"></i><a href="http://qy.58.com/51343431263504/?entinfo=32267944798012_3">http://qy.58.com/51343431263504/?entinfo=32267944798012_3</a></p>
        </div>
        <div class="company-profile">
            <h1>公司简介</h1>
            <article>
                ${talk.info_main}
            </article>
        </div>
            `
            $(".right").append(html3);

            // -----------------------------是否已经收藏-------------------------------------
            if (talk.collect == "true") {
                $(".love a").find('i').removeClass('fa-star-o').addClass('fa-star');
                $(".love a").removeClass('a').addClass('love-a');
                $(".collect").css({
                    "background":"#017c73",
                    "color":"#ffffff"
                });
            } else {
                $(".love a").find('i').removeClass('fa-star').addClass('fa-star-o');
                $(".love a").removeClass('love-a').addClass('a');
                $(".collect").css({
                    "background":"#ffffff",
                    "color":"#017c73"
                });
            }
            // -----------------------------点击收藏或取消收藏------------------------------------------------
            shoucang(".love a");
            shoucang(".collect");
            function shoucang(obj) {
                $(obj).click(function  () {
                    var oLid = talk.id;
                    console.log(oLid);
                    $.ajax({
                        url: 'php/out_info/main_info.php',
                        type: 'get',
                        data: {
                            id: oLid,
                        },
                        success: function (talk) {
                            console.log(talk);
                            // console.log(talk[j].collect);

                            if (talk.collect == "false") {
                                $.ajax({
                                    url: 'php/collect.php',
                                    type: 'get',
                                    data: {
                                        l_id: oLid
                                    },
                                    success: function (talk) {
                                        console.log(talk)
                                        if (talk == "warning") {
                                            alert("请先登录")
                                        } else if (talk = 'up success') {
                                            $(".love a").find('i').removeClass('fa-star-o').addClass('fa-star');
                                            $(".love a").removeClass('a').addClass('love-a');
                                            $(".collect").css({
                                                "background": "#017c73",
                                                "color": "#ffffff"
                                            });
                                            // alert("收藏成功！")
                                        }
                                    },
                                    error: function (ll) {
                                        alert(ll);
                                    }
                                })
                            } else if (talk.collect == "true") {
                                $.ajax({
                                    url: 'php/collect.php',
                                    type: 'get',
                                    data: {
                                        l_id: oLid
                                    },
                                    success: function (talk) {
                                        console.log(talk);
                                        if (talk == "warning") {
                                            alert("请先登录")
                                        } else if (talk = "del success") {
                                            $(".love a").find('i').removeClass('fa-star').addClass('fa-star-o');
                                            $(".love a").removeClass('love-a').addClass('a');
                                            $(".collect").css({
                                                "background": "#ffffff",
                                                "color": "#017c73"
                                            });
                                            // alert("取消收藏成功！");
                                        }
                                    },
                                    error: function (ll) {
                                        alert(ll);
                                    }
                                })
                            }
                        }
                    })
                })
            }
        },
        error:function (aaa) {
            console.log(aaa.responseText);
        }
    });
    // --------------------------------------发布信息-----------------------------
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
    // -------------------------flex--------------------------------
    $(document).scroll(function() {
        if( $(document).scrollTop() < 190){
            $("#flex").css('display','none');
        }else {
            $("#flex").css('display','block');
        }
        console.log();
    });
});