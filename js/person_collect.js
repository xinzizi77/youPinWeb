$(function(){
    $.ajax({
        url:"php/out_info/beLikedout.php",
        type:"post",
        success:function(obj){
            console.log(obj);
            if(obj!='nothing'){
                for(var i in obj){
                    console.log(obj[i].jobName);
                    let $html=
                    `<div class="box">
                    <div class="title"><a href="search-main.html?code_id=${obj[i].id}">${obj[i].jobName}</a></div>
                    <div class="price">${obj[i].monthMoney}</div>
                    <div class="company1">${obj[i].company_name}</div>
                    <div class="welfare">${obj[i].conditions}</div>
                    </div>
                    `
                    $(".right .span").after($html);
                }
            }
            $("footer").css("top", $(document).height());
        }
    })
})