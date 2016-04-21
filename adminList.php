<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>The new Page2</title>
    <?php
    session_start();
    if(empty($_SESSION["id"])){
        echo "<script>alert('请先登录');location.href='adminindex.html';</script>";
//        echo "<script>alert('".$password.$pass."');</script>";
    }
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
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/11
 * Time: 18:08
 */


$kindId=$_GET["id"];
echo "<script>document.getElementById('inputId').value='".$kindId."'</script>";
$con=mysql_connect("localhost","furui","1013");
mysql_select_db("upload");
mysql_query("SET NAMES 'utf8'");

$sql="select * from upload.upload_table WHERE kindId='".$kindId."'";


$list=mysql_query($sql,$con);
while($result=mysql_fetch_array($list)){
    $title=$result["title"];
    $id=$result["id"];

    echo '<div class="row">'.$title.'</div>
    <div class="btn2"><a href="">删除</a></div>
    <div class="btn1" onclick="location.href=\'revise.php?id='.$id.'&kindId='.$kindId.'\'"><a href="revise.php?id='.$id.'&kindId='.$kindId.'" target="_blank">更改</a></div>
    <br /><br /><hr>';
    echo '<a href="details.php?id='.$id.'">'.$title.'</a><br>';
}
mysql_free_result($list);
mysql_close($con);


echo  '</div>
<p id="result"> </p>
<div class="btncfm" onclick="location.href=\'upload.php?kindId='.$kindId.'\'"><a href="upload.php?kindId='.$kindId.'" target="_blank">发布新活动</a></div>';
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
</script>
</body>
</html>
