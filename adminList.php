<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>The new Page2</title>
    <?php
    error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
    include 'autoload.php';
    $ifLogin=new IfLogin;
    ?>
    <style type="text/css">
        a
        {
            text-decoration: none;
            color:white;
        }
        .search
        {
            margin-left:20px;
            height:34px;
            font-size:30px;
            color:#335aa8;
        }
        .box
        {
            position:absolute;
            top:30px;
            height:35px;
            width:50%;
            margin-left: 25%;
            font-size:20px;
            color:gray;
        }
        .box2
        {
            position:absolute;
            left: 75%;
            top:10px;
            height:41px;
            width:41px;
            background-color: #335aa8;
        }
        .div2
        {
            width: 80%;
            margin-left: 10%;
            margin-top:30px;
            left:0;
        }
        .row
        {
            height:30px;
            position:absolute;
            margin-left:40px;
            font-size:22px;
            color:#335aa8;
        }
        .btn1
        {
            padding: 5px;
            width:80px;
            background-color: #335aa8;
            border-radius:3px;
            text-align: center;
            color:white;
           float: right;
        }
        .btn2
        {
            padding: 5px;
            width:80px;
            background-color: #ff1323;
            border-radius:3px;
            text-align: center;
            color:white;
            float: right;
        }
        .btncfm
        {
            top:230px;
            width:50%;
            margin-left: 25%;
            left:160px;
            height:40px;
            background-color: #335aa8;
            text-align: center;
            color:white;
            font-size: 30px;
            border-radius: 3px;
        }
        #title{
            width: 100%;
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>
<input id="inputId" style="visibility: hidden;" value="">
<div class="search">
    <input style="margin-top:-20px" id="search" onfocus="isClear(this)" onblur="isRecord(this)" class="box" value="" />
</div>
<div class="box2"><a href=""><img src="images/002.jpg" width="41" height="41"/></a></div>
<div class="div2" id="div2">

<?php
    header("Content-type: text/html; charset=utf-8");
    $kindId=$_GET["id"];
    echo "<script>document.getElementById('inputId').value='".$kindId."'</script>";
    $db=new ConnectDb('localhost','furui','1013','shujuku','utf8');
    $db->search("select * from shujuku.citywalk WHERE kindId='".$kindId."'");
    while($result=$db->fetch_array()){
        $title=$result["title"];
        $id=$result["id"];
        $ifTop=$result["ifTop"];
        echo '<div class="row">'.$title.'</div>
        <div class="btn2"><a href="">删除</a></div>
        <div class="btn1" onclick="location.href=\'citywalk.php?id='.$id.'&kindId='.$kindId.'&action=change\'">更改</div>';
        if($ifTop=="1"){
            echo'<div class="btn1" id="'.$id.'" onclick="onTop(this)">取消置顶</div>
            <br /><br /><hr>';
        }else{
            echo'<div class="btn1" id="'.$id.'" onclick="onTop(this)">置顶</div>
            <br /><br /><hr>';
        }          
    }
    echo  '</div>
        <p id="result"> </p>
        <div class="btncfm" onclick="location.href=\'citywalk.php?kindId='.$kindId.'\'">发布新活动</div>';
?>
<script>
    document.getElementById("search").oninput=function(){
        var request=new XMLHttpRequest();
        request.open("GET","s.php?search="+document.getElementById("search").value+"&kindId="+document.getElementById('inputId').value);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4){
                if(request.status===200){
                    document.getElementById("result").innerHTML=request.responseText;
                    document.getElementById("div2").style.display="none";
                }else{
                    alert("失败");
                }
            }
        }
    }
    function onTop(obj){
       
        var request=new XMLHttpRequest();
        request.open("GET","ontop.php?id="+obj.id);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4){
                if(request.status===200){
                    if (obj.innerHTML=='置顶') {
                        obj.innerHTML="取消置顶";
                    }else{
                        obj.innerHTML="置顶";
                    }                    
                }else{
                    alert("失败");
                }
            }
        }
    }
</script>
</body>
</html>
