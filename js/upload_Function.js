
function mOver(obj)
{
    obj.innerHTML="为你的活动添加图片";
}
function mOut(obj)
{
    obj.innerHTML="上传图片";
}
function isRecord(obj)
{
    var x;
    if(obj.id==1)x=" 标题";
    if(obj.id==2)x=" 副标题";
    if(obj.id==3)x=" 时间";
    if(obj.id==4)x=" 费用";
    if(obj.id==5)x=" 团队";
    if(obj.id=="activity_text")x=" 活动详情";
    if(obj.id=="mapPlace")x=" 活动地点";
    if(obj.id==8)x=" 联系方式";
    if(obj.id==9)x=" 联系方式（微信）";
    if(obj.value==" " || obj.value=="")
    {
        obj.value=x;
    }else if(obj.id=="activity_text"&&obj.value!=x){
        document.getElementById("activity_info").value=document.getElementById("activity_text").value;
    }
}
function isClear(obj)
{
    var x;
    if(obj.id==1)x=" 标题";
    if(obj.id==2)x=" 副标题";
    if(obj.id==3)x=" 时间";
    if(obj.id==4)x=" 费用";
    if(obj.id==5)x=" 团队";
    if(obj.id=="activity_text")x=" 活动详情";
    if(obj.id=="mapPlace")x=" 活动地点";
    if(obj.id==8)x=" 联系方式";
    if(obj.id==9)x=" 联系方式（微信）";
    if(obj.value==x)obj.value=" ";
}



function readfile(event){

    var file=event.files[0];
    if(!/image\/\w+/.test(file.type)){
        alert("文件必须为图片");
        return false;
    }

    var reader=new FileReader();
    reader.readAsDataURL(file);
    reader.onload=function(evt){
        var img=document.createElement("img");
        img.setAttribute("class","picResult");
        img.src=evt.target.result;





        var del=document.createElement("button");
        var delText=document.createTextNode("删除");
        del.setAttribute("class","delImg");
        del.setAttribute("onclick","delimg(this)");
        del.appendChild(delText);
        var inputPare=event.parentNode;
        inputPare.insertBefore(img,event.nextSibling);
        inputPare.insertBefore(del,event.nextSibling);


    }


}
function delimg(obj){
    var delObj=obj.previousSibling;
    delObj.outerHTML=delObj.outerHTML;
    var pare=obj.parentNode;
    pare.removeChild(obj.nextSibling);
    pare.removeChild(obj);
}

function submit_click(){                             //点击提交按钮进行验证，验证无误进行提交

    var input=document.getElementsByTagName("input");
    var err=document.createElement("p");
    var errtext=document.createTextNode("请输入信息");
    err.setAttribute("id","error_text");
    err.appendChild(errtext);

    var arr=["",""," 标题"," 副标题"," 时间"," 费用"," 团队"," 活动详情"," 活动地点","","",""," 联系方式"," 联系方式（微信）","","",""];

    var n=0;
    var x=0;
    for(n=2;n<input.length-3;n++){
        if(input[n].value==arr[n]||(input[12].value==""&&input[13].value==""&&input[14].value=="")){
            if(input[n].value==arr[n]){
                alert("请补全"+arr[n]);
            }
            else if(n==input.length-3){
                alert("请上传至少一张图片");
            }
            break;
        }
        if(n==input.length-4)
        x=1;
    }
    if(x==1){
        document.getElementById("submit").click();
    }
   /* for(var n=0;n<input.length;n++){
        var inp= input[n];
        switch  (inp.id){
            case 1:
                if(inp.value==" 标题"){
                    alert(0);
                }
                break;
            default :
                ;
        }
    }*/

}


