$(".farm .farm-product").each(function(index,element){
    $($(".farm .farm-product button")[index]).click(function(e){
        e = e || window.event;
        __xx = e.pageX || e.clientX + document.body.scroolLeft;
        __yy = e.pageY || e.clientY + document.body.scrollTop;
        console.log(__xx);
        $.ajax({
            url:"php/out_info/farm_products/main_type.php",
            type:"get",
            data:{
                maintype:"mangguo",
                type:$($(".farm .farm-product .f2")[index]).html()
            },
            dataType:"json",
            success:function(obj){
                $("#chartContainer").show();
                $("#chartContainer").css({"top":__yy-60,"left":__xx-500});
                var sum=[];
                console.log(obj.place);
                console.log(obj);     
                // type.x=obj.place;
                // type.y=obj.price;
                for(var i=0;i<obj.place.length;i++){
                    var type={};
                   type.label=obj.place[i];
                   type.y=obj.price[i];
                   sum.push(type);
                // console.log(type.y);                
                }
                console.log(sum);
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: $($(".farm .farm-product .f2")[index]).html()+"走势图"
                    },
                    axisY: {
                        title: ""
                    },
                    data: [{        
                        type: "column",  
                        showInLegend: true, 
                        legendMarkerColor: "grey",
                        legendText: "斤/元 = 4元",
                        dataPoints:sum
                    }]
                });
                chart.render();
            },
            error:function(arr){
                console.log(arr);
            }
        })
    })
})

$("#chartContainer").mouseout(function(){
    $("#chartContainer").slideUp();
})