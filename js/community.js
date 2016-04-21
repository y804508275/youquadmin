/**
 * Created by Administrator on 2016/4/4.
 */
$(document).ready(function(){
    $("#menuBtn").click(function(){
        if($(".bottom-btn").html()=="查看更多"){
            $("#menu").animate({height:"100%"});
            $(".bottom-btn").html("收起");
        }else
        {
            $("#menu").animate({height:"0"});
            $(".bottom-btn").html("查看更多");
        }
    });
});