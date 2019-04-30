$(function () {
    header();

    /*-----------------------------------------------选择工作介绍还是自主创业--------------------------------------------------------*/
    // var oProduct = parseInt(getQueryString('product'));
    var oProduct = getRequest().product
    console.log("oProduct="+oProduct);
    if(oProduct == 'true'){
       $("#chartContainer").hide();
       $("#searchText1").val("");

       $(".choice1").find("ul").each(function (i, item) {
           $(item).find("li").each(function (i, item) {
               $(item).find("a").each(function (i, item) {
                       $(this).siblings('.one').removeClass('one');
                       $(".b").addClass('one');
               })
           })
       })

       $(".hot-farm").css('display', 'block');
       $(".form1").css('display', 'block');
       $(".hot-job").css('display', 'none');
       $(".form").css('display', 'none');
       

       $(".choice1").css('display', 'block');
       $(".farm").css('display', 'block');
       $(".choice").css('display', 'none');
       $(".paixu").css('display', 'none');
       $(".job").css('display', 'none');
       $(".jieshao").css("color", 'black');
       $(".chuangye").css("color", '#e28f2f');
       $(".chuangye").find('i').removeClass("fa-angle-right").addClass("fa-angle-down");
       $(".jieshao").find('i').removeClass("fa-angle-down").addClass("fa-angle-right");


       let oSearchText1 = getRequest().do; 
       if(oSearchText1 != undefined){
            $("#searchText1").val(oSearchText1);
            console.log("oSearchText1="+oSearchText1);
            $(".choice1").find("ul").each(function (i, item) {
                $(item).find("li").each(function (i, item) {
                    $(item).find("a").each(function (i, item) {
                        if($(item).text() == oSearchText1){
                            $(this).addClass('one')
                        }else{
                            $(this).removeClass('one');
                        }
                    })
                })
            })
            proAjax("", oSearchText1, 1);
       }else{
            proAjax("", "", 1);
       }
    }else{
        var oDo = getRequest().do;
        console.log("odo=" + oDo);
        sousuo(oDo);        
        chuanzhi();
    }

    //农产品
    $(".chuangye").click(function(){
        $("#chartContainer").hide();
        $("#searchText1").val("");

        $(".choice1").find("ul").each(function (i, item) {
            $(item).find("li").each(function (i, item) {
                $(item).find("a").each(function (i, item) {
                        $(this).siblings('.one').removeClass('one');
                        $(".b").addClass('one');
                })
            })
        })

        $(".hot-farm").css('display', 'block');
        $(".form1").css('display', 'block');
        $(".hot-job").css('display', 'none');
        $(".form").css('display', 'none');
        

        $(".choice1").css('display', 'block');
        $(".farm").css('display', 'block');
        $(".choice").css('display', 'none');
        $(".paixu").css('display', 'none');
        $(".job").css('display', 'none');
        $(".jieshao").css("color", 'black');
        $(".chuangye").css("color", '#e28f2f');
        $(".chuangye").find('i').removeClass("fa-angle-right").addClass("fa-angle-down");
        $(".jieshao").find('i').removeClass("fa-angle-down").addClass("fa-angle-right");

        $("#searchText1").val();
        // console.log("oSearchText1="+oSearchText1);
        proAjax("", "", 1);
    });
    //工作职位
    $(".jieshao").click(function () {

        $("#searchText").val("");

        $('.choice ul').find('li').each(function () {
            $(this).find('a').each(function () {
                $(this).siblings('.one').removeClass('one');                                
                $('.c').each(function (i,item) {
                   $(item).addClass('one'); 
                })
            })
        })

        $("#chartContainer").hide();
        fenye("", "", "");

        $(".page").css('display', 'block');
        $(".tcdPageCode").css('display', 'none');

        $(".form1").css('display', 'none');
        $(".form").css('display', 'block');
        $(".hot-farm").css('display', 'none');
        $(".hot-job").css('display', 'block');

        $(".choice1").css('display', 'none');
        $(".farm").css('display', 'none');
        $(".choice").css('display', 'block');
        $(".paixu").css('display', 'block');
        $(".job").css('display', 'block');
        $(".jieshao").css("color", '#e28f2f');
        $(".chuangye").css("color", 'black');
        $(".jieshao").find('i').removeClass("fa-angle-right").addClass("fa-angle-down");
        $(".chuangye").find('i').removeClass("fa-angle-down").addClass("fa-angle-right");
    })

    function getRequest() {
        var url = window.location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for (var i = 0; i < strs.length; i++) {
                theRequest[strs[i].split("=")[0]] = decodeURI(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    }

    function sousuo(text) {
        console.log("text=" + text);
        $("#searchText").val(text);
        if (text != undefined) {
            fenye("", "", text);
        } else {
            return false;
        }

    }

    $(".cha .hot-job").find("span").each(function (i, item) {
        $(item).find("a").click(function () {
            var oA = $(this).text();
            sousuo(oA);
        })
    })

    //接受URL地址参数 
    function getQueryString(name) { //name为传入参数
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);

        return null;
    }

    // chuanzhi();

    function chuanzhi() {
        var oType = parseInt(getQueryString('type'));
        console.log(oType);
        $(".choice ul li:eq(1)").find("a").each(function (i, item) {
            if (i == oType) {
                $(".choice ul li:eq(1)").find(".one").removeClass("one");
                $(item).addClass("one");

                var oOne0 = $(".choice li:eq(0)").find('.one').text();
                var oOne1 = $(".choice li:eq(1)").find('.one').text();

                if (oOne0 == '全国') {
                    oOne0 = "";
                }
                if (oOne1 == "不限") {
                    oOne1 = "";
                }
                console.log(12);
                fenye(oOne0, oOne1, "");

            }
        })
    }
    // --------------------------------------------------搜索----------------------------------------------
    $(document).keyup(function(event){
        if(event.keyCode ==13){
            onClick();
        }
    });
    $("#search").click(function onClick () {
        var oSearchText = $("#searchText").val();

        fenye("", "", oSearchText);
    })

    // -----------------------------------------切换--------------------------------------------------
    $('.choice ul').find('li').each(function () {
        $(this).find('a').each(function () {
            $(this).click(function () {
                $("#searchText").val("");
                $(this).siblings('.one').removeClass('one');
                $(this).addClass("one");

                var oOne0 = $(".choice li:eq(0)").find('.one').text();
                var oOne1 = $(".choice li:eq(1)").find('.one').text();
                if (oOne0 == '全国') {
                    oOne0 = "";
                }
                if (oOne1 == "不限") {
                    oOne1 = "";
                }

                fenye(oOne0, oOne1, "");
            })

        })
    });
    $('.choice1 ul').find('li').each(function () {
        $(this).find('a').each(function () {
            $(this).click(function () {
                $('.choice1 ul').find('a').removeClass('one');
                $(this).addClass("one");


            })

        })
    });


    // ---------------------------------------------点击收藏-----------------------------------------------
    function shoucang(obj, j) {
        // 当前对象的点击事件
        $(obj).click(function () {
            $.ajax({
                url: 'php/out_info/first_page.php',
                type: 'get',
                success: function (talk) {
                    // 获取当前对象的ID值
                    var oLid = talk[j].id;
                    console.log(talk[j].collect);
                    //对是否已经收藏进行判断
                    if (talk[j].collect == "false") {
                        $.ajax({
                            url: 'php/collect.php',
                            type: 'get',
                            data: {
                                l_id: oLid
                            },
                            success: function (talk) {
                                // console.log(talk);
                                if (talk == "warning") {
                                    alert("请先登录")
                                } else if (talk = 'up success') {
                                    $(obj).find('i').removeClass('fa-star-o').addClass('fa-star');
                                    $(obj).removeClass('a').addClass('love-a');
                                    // alert("收藏成功！")
                                }
                            },
                            error: function (ll) {
                                alert(ll);
                            }
                        })
                    } else if (talk[j].collect == "true") {
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
                                    $(obj).find('i').removeClass('fa-star').addClass('fa-star-o');
                                    $(obj).removeClass('love-a').addClass('a');
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

    // ---------------------------------------------------------职业分页-------------------------------------------------------
    function fenye(oOne0, oOne1, oSearch) {
        $.ajax({
            url: 'php/out_info/first_page.php',
            type: 'get',
            data: {
                search: oSearch,
                require: oOne0,
                require2: oOne1
            },
            dataType: 'JSON',
            success: function (talk) {
                console.log(talk);
                if (talk.length != 0) {
                    $(".wu1").css("display","none");
                    $('.total').text(talk[0].rows);
                    $(".job").empty();
                    for (let j = 0; j < talk.length; j++) {
                        
                        let html =
                            `
                        <div class="job-box">
                        <ul class="box-main">   
                            <li>
                                <a class="job-name" href="search-main.html?code_id=${talk[j].id}">${talk[j].jobName}</a>
                            </li>
                            <li>
                                <div class="job-txt">学历：${talk[j].eduReq}
                                    <span>|</span>经验：${talk[j].expReq}
                                    <span>|</span>工作类型 ：${talk[j].type}
                                    <span>|</span>人数：${talk[j].nedPeo}
                                    <span>|</span>地点：${talk[j].place1}/${talk[j].place2}/${talk[j].place3}</div>
                            </li>
                            <li>
                                <div class="money">${talk[j].monMoy}</div>
                            </li>
                            <li>
                                <div class="weal">
                                    <div class="dl">${talk[j].weal}</div>
                                </div>
                            </li>
                        </ul>
                        <div class="job-right">
                            <p class="company">${talk[j].thePlace}</p>
                            <a class="company-main" href="search-main.html?code_id=${talk[j].id}">查看详情</a>
                            <div class="love">
                                <a class="a" code="${talk[j].id}" href="javascript:void(0);">
                                    <i class="fa fa-star-o fa-lg"></i>收藏</a>
                            </div>
                        </div>
                    </div>
                                                
                        `
                        $('.job').append(html);

                        // -----------------------------------------是否已经收藏----------------------------------------
                        if (talk[j].collect == "true") {
                            $($(".love a")[j]).find('i').removeClass('fa-star-o').addClass('fa-star');
                            $($(".love a")[j]).removeClass('a').addClass('love-a');
                        } else {
                            $($(".love a")[j]).find('i').removeClass('fa-star').addClass('fa-star-o');
                            $($(".love a")[j]).removeClass('love-a').addClass('a');

                        }
                        // ---------------------------------------------点击收藏-----------------------------------------------
                        shoucang($(".love a")[j], j);

                    }

                    $('.total').text(talk[0].rows);
                    $(".pagination").empty();
                    // -------------------------------页脚设置-------------------------

                    pages(talk[0].page);

                } else {
                    $('.total').text(0);
                    $(".pagination").empty();
                    $(".job").empty();

                    let html = 
                    `
                    <p class="wu1">暂无数据</p>
                    `
                    $('.job').append(html);
                    $(".wu1").css("display","block");
                    
                }
                // ------------------------------------------------------点击分页-------------------------------------
                $('.pagination li').find('a').each(function () {
                    $(this).click(function () {
                        // console.log(page);
                        // ------------------------------------页脚点击-----------------------
                        fenyechang(this, $(this).attr("data"), talk[0].page)
                        var nub = $(".active").attr("data");
                        var oOne0 = $(".choice li:eq(0)").find('.one').text();
                        var oOne1 = $(".choice li:eq(1)").find('.one').text();
                        var oSearchText = $("#searchText").val();
                        console.log(oSearchText)

                        if ($(".choice1").css('display') == "none") {
                            $.ajax({
                                url: 'php/out_info/first_page.php',
                                type: 'get',
                                data: {
                                    search: oSearchText,
                                    page: nub,
                                },
                                dataType: 'JSON',
                                success: function (talk) {
                                    console.log(talk);
                                    $(".job").empty();
                                    for (let j = 0; j < talk.length; j++) {
                                        let html =
                                            `
                                        <div class="job-box">
                                        <ul class="box-main">   
                                            <li>
                                                <a class="job-name" href="search-main.html?code_id=${talk[j].id}">${talk[j].jobName}</a>
                                            </li>
                                            <li>
                                                <div class="job-txt">学历：${talk[j].eduReq}
                                                    <span>|</span>经验：${talk[j].expReq}
                                                    <span>|</span>工作类型 ：${talk[j].type}
                                                    <span>|</span>人数：${talk[j].nedPeo}
                                                    <span>|</span>地点：${talk[j].place1}/${talk[j].place2}/${talk[j].place3}</div>
                                            </li>
                                            <li>
                                                <div class="money">${talk[j].monMoy}</div>
                                            </li>
                                            <li>
                                                <div class="weal">
                                                    <div class="dl">${talk[j].weal}</div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="job-right">
                                            <p class="company">${talk[j].thePlace}</p>
                                            <a class="company-main" href="search-main.html?code_id=${talk[j].id}">查看详情</a>
                                            <div class="love">
                                                <a class="a" href="javascript:void(0);">
                                                    <i class="fa fa-star-o fa-lg"></i>收藏</a>
                                            </div>
                                        </div>
                                    </div>
    
                                        `
                                        $('.job').append(html);

                                        // -----------------------------------------是否已经收藏----------------------------------------
                                        if (talk[j].collect == "true") {
                                            $($(".love a")[j]).find('i').removeClass('fa-star-o').addClass('fa-star');
                                            $($(".love a")[j]).removeClass('a').addClass('love-a');
                                        } else {
                                            $($(".love a")[j]).find('i').removeClass('fa-star').addClass('fa-star-o');
                                            $($(".love a")[j]).removeClass('love-a').addClass('a');

                                        }
                                        // ---------------------------------------------点击收藏-----------------------------------------------
                                        shoucang($(".love a")[j], j);

                                    }
                                }
                            })
                        }
                    });

                });
            },
            error: function (aaa) {
                console.log(aaa.responseText);
            }

        });

    }
    // -------------------------------页脚设置函数-------------------------
    function pages(obj) {
        $(".pagination").empty();
        if (obj <= 9) {
            if (obj == 1 || obj == 0) {
                let html =
                    `
                <li>
                    <a class="active first" href="javascript:void(0);"  data="1">1</a>
                </li>
                `
                $('.pagination').append(html);
            } else {
                let html =
                    `
            <li>
            <a class="active first" href="javascript:void(0);"  data="1"> 1</a>
            </li>
            `
                $('.pagination').append(html);
                for (let i = 2; i <= obj; i++) {

                    let html2 =
                        `
                <li>
                <a href="javascript:void(0);"  data=" ${i}"> ${i}</a>
                </li>
                 `
                    $('.pagination').append(html2);
                }
            }

        } else {

            var html =
                `
        <li>
        <a  class="active first" href="javascript:void(0);"  data="1">1</a>
    </li>
    <li>
        <a class="none1" href="javascript:void(0);"  data="2">2</a>
        <a class="look1" href="javascript:void(0);" data="...">...</a>
    </li>
    <li>
    <a class="toptop" href="javascript:void(0);"  data="3">3</a>
    </li>
    <li>
        <a  class="top" href="javascript:void(0);"  data="4">4</a>
    </li>
    <li>
        <a class= "light" href="javascript:void(0);"  data="5">5</a>
    </li>
    <li>
        <a class="down" href="javascript:void(0);"  data="6">6</a>
    </li>
     <li>
         <a class="downdown" href="javascript:void(0);"  data="7">7</a>
    </li>
    <li>
        <a class="look2" href="javascript:void(0);"  data="...">...</a>
        <a class="none2" href="javascript:void(0);"  data="8">8</a>
    </li>
    <li>
        <a class="end" href="javascript:void(0);"  data="${obj}">${obj}</a>
    </li>
        `

        }
        $('.pagination').append(html);

    }

    // ------------------------页脚点击--------------------------------------
    function fenyechang(now, obj, pageAll) {
        if (obj <= 5) {
            $('.pagination li').find('.active').removeClass('active');

            $('.look1').css('display', 'none');
            $('.none1').css('display', 'block');
            $('.first').attr({
                "data": '1'
            })
            $('.first').text($('.first').attr("data"));
            $('.none1').attr({
                "data": '2'
            })
            $('.none1').text($('.none1').attr("data"));
            $('.toptop').attr({
                "data": '3'
            })
            $('.toptop').text($('.toptop').attr("data"));
            $('.top').attr({
                "data": '4'
            })
            $('.top').text($('.top').attr("data"));
            $('.light').attr({
                "data": '5'
            })
            $('.light').text($('.light').attr("data"));
            $('.down').attr({
                "data": '6'
            })
            $('.down').text($('.down').attr("data"));
            $('.downdown').attr({
                "data": '7'
            })
            $('.downdown').text($('.downdown').attr("data"));
            if (obj == 5) {
                $(".light").addClass('active');
            } else if (obj == 4) {
                $(".top").addClass('active');
            } else {
                $(now).addClass('active');
            }
        }
        if (obj >= 6 && obj <= pageAll - 5) {

            $('.pagination li').find('.active').removeClass('active');
            $('.light').addClass('active');

            $('.look1').css('display', 'block');
            $('.none1').css('display', 'none');
            $('.look2').css('display', 'block');
            $('.none2').css('display', 'none');


            $('.active').text($(now).attr("data"));
            $('.active').attr({
                "data": $(now).attr("data")
            });

            $('.toptop').attr({
                "data": $('.active').attr("data") - 2
            });
            $('.toptop').text($('.toptop').attr("data"));

            $('.top').attr({
                "data": $('.active').attr("data") - 1
            });
            $('.top').text($('.top').attr("data"));

            $('.down').attr({
                "data": parseInt($('.active').attr("data")) + 1
            });
            $('.down').text($('.down').attr("data"));

            $('.downdown').attr({
                "data": parseInt($('.active').attr("data")) + 2
            });
            $('.downdown').text($('.downdown').attr("data"));
        } else if (obj >= pageAll - 4 && obj <= pageAll) {
            $('.look2').css('display', 'none');
            $('.none2').css('display', 'block');

            $('.look1').css('display', 'block');
            $('.none1').css('display', 'none');

            $('.pagination li').find('.active').removeClass('active');
            if (obj == parseInt($(".end").attr("data")) - 4) {
                $(".light").addClass('active');
            } else if (obj == parseInt($(".end").attr("data")) - 3) {
                $(".down").addClass('active');
            } else {
                $(now).addClass('active');
            }

            $('.toptop').attr({
                "data": parseInt($(".end").attr("data")) - 6
            })
            $('.toptop').text($('.toptop').attr("data"));

            $('.top').attr({
                "data": parseInt($(".end").attr("data")) - 5
            })
            $('.top').text($('.top').attr("data"));

            $('.light').attr({
                "data": parseInt($(".end").attr("data")) - 4
            })
            $('.light').text($('.light').attr("data"));

            $('.down').attr({
                "data": parseInt($(".end").attr("data")) - 3
            })
            $('.down').text($('.down').attr("data"));

            $('.downdown').attr({
                "data": parseInt($(".end").attr("data")) - 2
            })
            $('.downdown').text($('.downdown').attr("data"));

            $('.none2').attr({
                "data": parseInt($(".end").attr("data")) - 1
            })
            $('.none2').text($('.none2').attr("data"));
        }
    }

    $(document).scroll(function () {
        // console.log($('#banner').offset().top)
        if ($('#header').offset().top > 0) {
            // --------------------------------search.html-----------------------------------------
            $('.address').css({
                'line-height': '70px',
                'transition-duration': '0.5s'
            });
            $('#content').css({
                'margin-top': '70px',
                'transition-duration': '0.5s'
            });
        } else {
            // --------------------------------search.html-----------------------------------------
            $('.address').css({
                'line-height': '80px',
                'transition-duration': '0.5s'
            });
            $('#content').css({
                'margin-top': '80px',
                'transition-duration': '0.5s'
            });
        }
    });

    // ---------------------------------------------排序切换---------------------------------------------------------
    $('.paixu').find('button').each(function () {
        $(this).click(function () {
            if ($(this).hasClass('moren')) {
                return $(this);
            } else {
                $('.paixu').find('button').removeClass('moren');
                $(this).addClass('moren');
            }
        })
    });



    // -----------------------------------农产品部分-------------------------------------------------------

    // ---------------------------热门农产品---------------------------------------
    $(".cha .hot-farm").find("span").each(function (i, item) {
        $(item).find("a").click(function () {
            var nameProduct  = $(this).text();
            $("#searchText1").val(nameProduct);
            $(".choice1").find("ul").each(function (i, item) {
                $(item).find("li").each(function (i, item) {
                    $(item).find("a").each(function (i, item) {
                        if($(item).text() == nameProduct){
                            $(this).addClass('one')
                        }else{
                            $(this).removeClass('one');
                        }
                    })
                })
            })
            proAjax("", nameProduct, 1);
            
        })
    })

    // ---------------------------筛选-------------------------------
    $(".choice1").find("ul").each(function (i, item) {
        $(item).find("li").each(function (i, item) {
            $(item).find("a").each(function (i, item) {
                $(item).click(function () {
                    $(this).siblings('.one').removeClass('one');
                    $(this).addClass("one");

                    var nameProduct = $(this).text();

                    proAjax("", nameProduct, 1);
                                  
                })
            })
        })
    })


    function proAjax(oSearch, oRequire, oPage) {
        $.ajax({
            url: 'php/out_info/farm_products/list.php',
            type: 'get',
            data: {
                search: oSearch,
                require: oRequire,
                page: oPage,
            },
            success: function (talk) {
                console.log(talk);
                $(".farm").empty();
                let html1 =
                    `
            <ul class="farm-nav">
            <li class="f1">产地行情</li>
            <li class="f2">产品/品种</li>
            <li class="f3">所在产地</li>
            <li class="f4">价格</li>
            <li class="f5">走势图</li>   
        </ul>
            `
                $('.farm').append(html1);
                // var pages = talk[0].page;
                if(talk.length > 0){
                    $(".wu1").css("display","none");                    
                    for (i = 0; i < talk.length; i++) {
                        let html =
                            `
                <ul class="farm-product a" data-id=${talk[i].maintype}>
                    <li class="f1">${talk[i].time}</li>
                    <li class="f2">${talk[i].type} </li>
                    <li class="f3">${talk[i].place}</li>
                    <li class="f4">${talk[i].price}</li>
                    <li class="f5">
                        <button>走势图</button>
                    </li>
                </ul>
                `
                        $('.farm').append(html);
    
                    }
                    // console.log($(".farm-product"));
                    $(".farm .farm-product").each(function (index, element) {
                        // console.log($($(".farm .farm-product")[index]).data("id"));
                        $($(".farm .farm-product button")[index]).click(function (e) {
                            e = e || window.event;
                            __xx = e.pageX || e.clientX + document.body.scroolLeft;
                            __yy = e.pageY || e.clientY + document.body.scrollTop;
                            console.log(__xx);
                            $.ajax({
                                url: "php/out_info/farm_products/main_type.php",
                                type: "get",
                                data: {
                                    maintype: $($(".farm .farm-product")[index]).data("id"),
                                    type: $($(".farm .farm-product .f2")[index]).html()
                                },
                                dataType: "json",
                                success: function (obj) {
                                    $("#chartContainer").show();
                                    $("#chartContainer").css({
                                        "top": __yy - 60,
                                        "left": __xx - 500
                                    });
                                    var sum = [];
                                    console.log(obj.place);
                                    console.log(obj);
                                    // type.x=obj.place;
                                    // type.y=obj.price;
                                    for (var i = 0; i < obj.place.length; i++) {
                                        var type = {};
                                        type.label = obj.place[i];
                                        type.y = obj.price[i];
                                        sum.push(type);
                                        // console.log(type.y);                
                                    }
                                    console.log(sum);
                                    var chart = new CanvasJS.Chart("chartContainer", {
                                        animationEnabled: true,
                                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                                        title: {
                                            text: $($(".farm .farm-product .f2")[index]).html() + "走势图"
                                        },
                                        axisY: {
                                            title: ""
                                        },
                                        data: [{
                                            type: "column",
                                            showInLegend: true,
                                            legendMarkerColor: "grey",
                                            legendText: "单位：斤/元",
                                            dataPoints: sum
                                        }]
                                    });
                                    chart.render();
                                },
                                error: function (arr) {
                                    console.log(arr);
                                }
                            })
                        })
                    })
    
                    $("#chartContainer").mouseout(function () {
                        $("#chartContainer").slideUp();
                    })
                    // ------------------------------------------隔行变色---------------------------------------------------------
                    $('.farm-product:even').css('background', 'white');
                    $('.farm-product:odd').css('background', '#f1f5f8');
    
                    $('.farm-product').each(function () {
                        $(this).mouseover(function () {
                            $(this).css('background', '#57bc90');
                        })
                        $(this).mouseout(function () {
                            $('.farm-product:even').css('background', 'white');
                            $('.farm-product:odd').css('background', '#f1f5f8');
                        })
                    });
                    // -------------------------设置页数------------------------------
                    pages(talk[0].page);
                    
                    // ------------------------------------页脚点击-----------------------
                    $('.pagination li').find('a').each(function () {
                        $(this).click(function () {
                            let pages = $(this).attr("data");
                            // console.log(pages);
                            // ------------------------------------页脚点击-----------------------
                            fenyechang(this, pages, talk[0].page);
                            
                            if ($(".choice1").css('display') == "block") {
                                $.ajax({
                                    url: 'php/out_info/farm_products/list.php',
                                    type: 'get',
                                    data: {
                                        search: oSearch,
                                        require: oRequire,
                                        page: pages,
                                    },
                                    success: function (talk) {
                                        console.log("pages=" + pages);
                                        console.log(talk)
                                        $(".farm").empty();
                                        let html1 =
                                            `
                                    <ul class="farm-nav" >
                                    <li class="f1">产地行情</li>
                                    <li class="f2">产品/品种</li>
                                    <li class="f3">所在产地</li>
                                    <li class="f4">价格</li>
                                    <li class="f5">走势图</li>   
                                </ul>
                                    `
                                        $('.farm').append(html1);
                                        // var pages = talk[0].page;
                                        for (i = 0; i < talk.length; i++) {
                                            let html =
                                                `
                                    <ul class="farm-product a" data-id=${talk[i].maintype}>
                                        <li class="f1">${talk[i].time}</li>
                                        <li class="f2">${talk[i].type} </li>
                                        <li class="f3">${talk[i].place}</li>
                                        <li class="f4">${talk[i].price}</li>
                                        <li class="f5">
                                            <button>走势图</button>
                                        </li>
                                    </ul>
                                    `
                                            $('.farm').append(html);
    
                                        }
                                        console.log($(".farm-product"));
                                        $(".farm .farm-product").each(function (index, element) {
                                            console.log($($(".farm .farm-product")[index]).data("id"));
                                            $($(".farm .farm-product button")[index]).click(function (e) {
                                                e = e || window.event;
                                                __xx = e.pageX || e.clientX + document.body.scroolLeft;
                                                __yy = e.pageY || e.clientY + document.body.scrollTop;
                                                console.log(__xx);
                                                $.ajax({
                                                    url: "php/out_info/farm_products/main_type.php",
                                                    type: "get",
                                                    data: {
                                                        maintype: $($(".farm .farm-product")[index]).data("id"),
                                                        type: $($(".farm .farm-product .f2")[index]).html()
                                                    },
                                                    dataType: "json",
                                                    success: function (obj) {
                                                        $("#chartContainer").show();
                                                        $("#chartContainer").css({
                                                            "top": __yy - 60,
                                                            "left": __xx - 500
                                                        });
                                                        var sum = [];
                                                        console.log(obj.place);
                                                        console.log(obj);
                                                        // type.x=obj.place;
                                                        // type.y=obj.price;
                                                        for (var i = 0; i < obj.place.length; i++) {
                                                            var type = {};
                                                            type.label = obj.place[i];
                                                            type.y = obj.price[i];
                                                            sum.push(type);
                                                            // console.log(type.y);                
                                                        }
                                                        console.log(sum);
                                                        var chart = new CanvasJS.Chart("chartContainer", {
                                                            animationEnabled: true,
                                                            theme: "light2", // "light1", "light2", "dark1", "dark2"
                                                            title: {
                                                                text: $($(".farm .farm-product .f2")[index]).html() + "走势图"
                                                            },
                                                            axisY: {
                                                                title: ""
                                                            },
                                                            data: [{
                                                                type: "column",
                                                                showInLegend: true,
                                                                legendMarkerColor: "grey",
                                                                legendText: "单位：斤/元",
                                                                dataPoints: sum
                                                            }]
                                                        });
                                                        chart.render();
                                                    },
                                                    error: function (arr) {
                                                        console.log(arr);
                                                    }
                                                })
                                            })
                                        })
    
                                        $("#chartContainer").mouseout(function () {
                                            $("#chartContainer").slideUp();
                                        })
                                        // ------------------------------------------隔行变色---------------------------------------------------------
                                        $('.farm-product:even').css('background', 'white');
                                        $('.farm-product:odd').css('background', '#f1f5f8');
    
                                        $('.farm-product').each(function () {
                                            $(this).mouseover(function () {
                                                $(this).css('background', '#57bc90');
                                            })
                                            $(this).mouseout(function () {
                                                $('.farm-product:even').css('background', 'white');
                                                $('.farm-product:odd').css('background', '#f1f5f8');
                                            })
                                        });
                                    },
                                    error: function (aa) {
                                        console.log(aa.responseText);
    
                                    }
                                })
    
                            }
                        })
                    })
                }else{
                    $(".pagination").empty();
                    let html = 
                    `
                    <p class="wu1">暂无数据</p>
                    `
                    $('.farm').append(html);
                    $(".wu1").css("display","block");
                }
                
            },
            error: function (aa) {
                console.log(aa.responseText);

            }
        });

    }
    // -----------------------------------搜索-------------------------------
    $("#search1").click(function () {
        var oSearchText1 = $("#searchText1").val();

        console.log(oSearchText1);
        proAjax(oSearchText1, "", 1);
        
    })
})
