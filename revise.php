<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>The 3rd Page3</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5doOBpnqfkYzGUuFwrOnftldguOmDiMC"></script>
    <?php
    session_start();
    if(empty($_SESSION["id"])){
        echo "<script>alert('请先登录');location.href='adminindex.html';</script>";
//        echo "<script>alert('".$password.$pass."');</script>";
    }
    ?>

    <link rel="stylesheet" href="css/upload_style.css" type="text/css">
</head>
<body>
<div class="head"><div style="margin-left: 30px;">完善活动细节</div></div>
<br /><br />

<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>" method="post" class="information" enctype="multipart/form-data">
    <br>
    <input type="radio" name="show_state" id="show" value="显示" checked/>显示
    <input type="radio" name="show_state" id="unshow" value="不显示"/>不显示
    <br>
    <br>标题<br><input id="title"  name="title" class="box" value="" />
    <br />
    <br>副标题<br><input id="sub_title"  name="sub_title" class="box" value="" />
    <br />
    <br>时间<br><input id="activity_time"  name="time" class="box" value="" />
    <br />
    <br>费用<br><input id="price"  name="price" class="box" value="" />
    <br />
    <br>团队<br><input id="host"  name="host" class="box" value="" />
    <br />
    <br>活动详情<br><textarea id="activity_text"  class="text_area"></textarea>
    <input id="activity_info"  name="activity_info"/>
    <br />
    活动地点
    <br><input id="mapPlace" class="box" name="place" value="" />

    <a onclick="search_place()">
        <img src="images/position.png" class="icon_position" />
    </a><br>
    <input id="mapPlaceInfo" name="place_info" value="" />
    <input id="mapPlaceX" name="placeX" value="" />
    <input id="mapPlaceY" name="placeY" value="" />
    <div id="container" class="map"></div>
    <br>联系方式<br><input id="phone"  name="phone" class="box" value="" />
    <br />
    <br>联系方式（微信）<br><input id="weixin"  name="weixin" class="box" value="" />
    <br />
    <!--
    <div class="btn_upload_pictures">
        <a href="" style="color:#335aa8;" onmouseover="mOver(this)" onmouseout="mOut(this)" onclick="document.getElementById('upload').click()">上传图片</a>
    </div>
    -->

    <input type="file" name="file1" onchange="readfile(this)">
    <img src="" id="pic1" width="500px">
    <br>
    <input type="file" name="file2" onchange="readfile(this)">
    <img src="" id="pic2" width="500px">
    <br>
    <input type="file" name="file3" onchange="readfile(this)">
    <img src="" id="pic3" width="500px">
    <br>
    <br>





    <button id="button" type="button" onclick="submit_click()">
        确认发布
    </button>


    <input id="submit" type="submit" name="submit" value="提交" style="visibility: hidden;">
</form>
<br />
<?php
header("Content-type: text/html; charset=utf-8");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/11
 * Time: 19:32
 */

$kindId=$_GET["kindId"];
echo "<script>document.getElementById('form').action='".htmlspecialchars($_SERVER["PHP_SELF"])."?kindId=".$kindId."';</script>";
$con=mysql_connect("localhost","furui","1013");
mysql_select_db("upload");
mysql_query("SET NAMES 'utf8'");

$id=$_GET["id"];
$sql="select * from upload_table WHERE id='".$id."'";

$details=mysql_query($sql,$con);

while($result=mysql_fetch_array($details)){

    $title=$result["title"];
    $sub_title=$result["sub_title"];
    $activity_time=$result["activity_time"];
    $price=$result["price"];
    $host=$result["host"];
    $activity_info=$result["activity_info"];
    $place=$result["place"];
    $placeX=$result["placeX"];
    $placeY=$result["placeY"];
    $place_info=$result["place_info"];
    $phone=$result["phone"];
    $weixin=$result["weixin"];
    $show_state=$result["show_state"];
    $pic1=$result["pic1"];
    $pic2=$result["pic2"];
    $pic3=$result["pic3"];

    echo "<script> document.getElementById('title').value='".$title."';".
        "document.getElementById('sub_title').value='".$sub_title."';".
        "document.getElementById('activity_time').value='".$activity_time."';".
        "document.getElementById('price').value='".$price."';".
        "document.getElementById('host').value='".$host."';".
        "document.getElementById('activity_text').value='".$activity_info."';".
        "document.getElementById('mapPlace').value='".$place."';".
        "document.getElementById('mapPlaceX').value='".$placeX."';".
        "document.getElementById('mapPlaceY').value='".$placeY."';".
        "document.getElementById('mapPlaceInfo').value='".$place_info."';".
        "document.getElementById('phone').value='".$phone."';".
        "document.getElementById('weixin').value='".$weixin."';".
        "document.getElementById('form').action='".htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id."&kindId=".$kindId."';".
        "</script>";


    if($pic1!="0"){
        echo "<script>document.getElementById('pic1').setAttribute('src','".$pic1."');</script>";
    }else{
        echo "<script>document.getElementById('pic1').style.display='none';</script>";
    }
    if($pic2!="0"){
        echo "<script>document.getElementById('pic2').setAttribute('src','".$pic2."');</script>";
    }else{
        echo "<script>document.getElementById('pic2').style.display='none';</script>";
    }
    if($pic3!="0") {
        echo "<script>document.getElementById('pic3').setAttribute('src','" . $pic3 . "');</script>";
    }else{
        echo "<script>document.getElementById('pic3').style.display='none';</script>";
    }

    if($show_state=="不显示"){
        echo "<script>document.getElementById('show').checked=false;document.getElementById('unshow').checked=true;</script>";
    }
}
?>

<script type="text/javascript">
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

            if(event.name="file1"){
                document.getElementById("pic1").style.display="none";
            }
            if(event.name="file2"){
                document.getElementById("pic2").style.display="none";
            }
            if(event.name="file3"){
                document.getElementById("pic3").style.display="none";
            }
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
        document.getElementById("activity_info").value=document.getElementById("activity_text").value;
        var input=document.getElementsByTagName("input");
        var err=document.createElement("p");
        var errtext=document.createTextNode("请输入信息");
        err.setAttribute("id","error_text");
        err.appendChild(errtext);

        var arr=["","","","","","","","","","","","","","","","",""];

        var n=0;
        var x=0;
        for(n=2;n<input.length-4;n++){
            if(input[n].value==arr[n]){
                if(input[n].value==arr[n]){
                    alert("请补全"+arr[n]);
                }

                break;
            }
            if(n==input.length-5)
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
    var x,y;
    function search_place(){
        var placeInfo=eval(document.getElementById("mapPlace")).value;
        var myGeo = new BMap.Geocoder();

        // 将地址解析结果显示在地图上，并调整地图视野
        myGeo.getPoint(placeInfo, function(point){
            if (point) {
                map.centerAndZoom(point, 16);
                var marker=new BMap.Marker(point);
                map.addOverlay(marker);
                marker.addEventListener("click", function(e){     //监听标注事件
                    myGeo.getLocation(new BMap.Point(e.point.lng, e.point.lat), function(result){
                        if (result){
                            eval(document.getElementById("mapPlaceInfo")).value=result.address;
                            eval(document.getElementById("mapPlaceX")).value=e.point.lng;
                            eval(document.getElementById("mapPlaceY")).value=e.point.lat;
                        }
                    });
                });

                marker.enableDragging();                    //可托拽的标注
                marker.addEventListener("dragend", function(e){
                    myGeo.getLocation(new BMap.Point(e.point.lng, e.point.lat), function(result){
                        if (result){
                            eval(document.getElementById("mapPlaceInfo")).value=result.address;
                            eval(document.getElementById("mapPlaceX")).value=e.point.lng;
                            eval(document.getElementById("mapPlaceY")).value=e.point.lat;
                        }
                    });
                });
            }
        }, "");
    }

    var map = new BMap.Map("container");
    var point = new BMap.Point(116.404, 39.915);
    map.centerAndZoom(point, 15);
    map.addControl(new BMap.NavigationControl());
</script>

</body>
</html>
<?php
header("Content-type: text/html; charset=utf-8");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/7
 * Time: 0:09
 */

$kindId=$_GET["kindId"];
$pic_path='upload';
if(!file_exists($pic_path)){
    mkdir($pic_path);
}
$con=mysql_connect("localhost","furui","1013");

mysql_select_db("upload");
mysql_query("SET NAMES 'utf8'");

$id=$_GET["id"];
$sql="select * from upload_table WHERE id='".$id."'";

$details=mysql_query($sql,$con);

while($result=mysql_fetch_array($details)){
    $newpic1=$result["pic1"];
    $newpic2=$result["pic2"];
    $newpic3=$result["pic3"];
}

if(isset($_POST["submit"])&&$_POST["submit"]=="提交"){
    $title=$_POST["title"];
    $sub_title=$_POST["sub_title"];
    $activity_time=$_POST["time"];
    $price=$_POST["price"];
    $host=$_POST["host"];
    $activity_info=$_POST["activity_info"];
    $place=$_POST["place"];
    $placeX=$_POST["placeX"];
    $placeY=$_POST["placeY"];
    $place_info=$_POST["place_info"];
    $phone=$_POST["phone"];
    $weixin=$_POST["weixin"];
    $show_state=$_POST["show_state"];


    $id=$_GET["id"];



    if($_FILES["file1"]["error"]>0){
        $pic1=$newpic1;
    }else{
        $pic1="./".$pic_path."/".$_FILES["file1"]["name"];
        move_uploaded_file($_FILES["file1"]["tmp_name"],
            $pic_path."/" . $_FILES["file1"]["name"]);
    }
    if($_FILES["file2"]["error"]>0){
        $pic2=$newpic2;
    }else{
        $pic2="./".$pic_path."/".$_FILES["file2"]["name"];
        move_uploaded_file($_FILES["file2"]["tmp_name"],
            $pic_path."/" . $_FILES["file2"]["name"]);
    }
    if($_FILES["file3"]["error"]>0){
        $pic3=$newpic3;
    }else{
        $pic3="./".$pic_path."/".$_FILES["file3"]["name"];
        move_uploaded_file($_FILES["file3"]["tmp_name"],
            $pic_path."/" . $_FILES["file3"]["name"]);
    }


    $test1 = addslashes($pic1);
    $test2 = addslashes($pic2);
    $test3 = addslashes($pic3);

    $server_name="localhost";
    $user_name="furui";
    $password="1013";

    $con=mysql_connect("localhost","furui","1013");

    mysql_select_db("upload");
    mysql_query("SET NAMES 'utf8'");


    $sql_insert="UPDATE upload_table SET title ='$title',sub_title='$sub_title',activity_time='$activity_time',price='$price',host='$host',activity_info='$activity_info',place='$place',placeX='$placeX',placeY='$placeY',place_info='$place_info',phone='$phone',weixin='$weixin',pic1='$pic1',pic2='$pic2',pic3='$pic3',show_state='$show_state' WHERE id='$id'";

    $res_insert=mysql_query($sql_insert);

    echo "<script>alert('".$kindId."');location.href='adminList.php?id=".$kindId."';</script>";


}



?>

