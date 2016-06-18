<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>citywalk</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5doOBpnqfkYzGUuFwrOnftldguOmDiMC"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="lang/zh-cn/zh-cn.js"></script>

    <link rel="stylesheet" href="css/upload_style.css" type="text/css">
    <style type="text/css">
        body{
            margin: 0;
        }
        #addCity{
            width: 50%;
            margin-left: 25%;
            top: 200px;
            height: auto;
            display: none;
            position: fixed;
            z-index: 2001;
            background-color: #f5f5f5;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,.26);
            text-align: center;
        }
        #addCity form{
            width: 90%;
            margin-left: 5%;
            margin-top: 100px;
            margin-bottom: 100px;
        }
        .addBtn{

            padding: 5px 15px;
            background-color: #335aa8;
            border-radius: 5px;
            color: white;

        }
        #black{
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            bottom: 0;
            display: none;
            z-index: 2000;
            background-color: gray;
            opacity: 0.6;
        }
    </style>
</head>
<body>
<div class="head"><div style="margin-left: 30px;">完善活动细节</div></div>
<br /><br />

<div id="addCity" style="">
    <form id="addForm">
        城市名字<input type="text" value="" name="addCity" id="cityName" width="70%"> 
        <br>
        <br>
        <br>
        城市介绍<input type="text" value="" name="cityNote" id="cityNote" width="70%">
        <br>
        <br>
        <br>
        <span class="addBtn" id="cityBtn">添加</span> 
        <br>
        <br>
        <br>
        <br>
        <span class="addBtn" onclick="hiddenAdd()">关闭</span>
    </form>
</div>
<div id="black">
</div>
<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?kindId='.$_GET["kindId"];?>" method="post" class="information" enctype="multipart/form-data">
    <br>
    <select name="city" id="city">
        <option value="">请选择城市</option>
        <?php
            error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
            $con=mysql_connect("localhost","furui","1013");
            mysql_select_db("shujuku");
            mysql_query("SET NAMES 'utf8'");

            $sql="select * from city";

            $list=mysql_query($sql,$con);
            while($result=mysql_fetch_array($list)){
                $cityname=$result["cityName"];
                $id=$result["cityId"];
                echo '<option value="'.$id.'">'.$cityname.'</option>';
            }
        ?>
        
    </select>
    <span onclick="showAdd()" class="addBtn">添加城市</span>
    <br>
    <br>
    <br>
    活动是否显示
    <input type="radio" name="show_state" id="show" value="显示" checked/>显示
    <input type="radio" name="show_state" id="unshow" value="不显示"/>不显示
    <br>
    <br>标题<br><input id="title"  name="title" class="box" value="" />
    <br />
    <br>活动时间（几月几日）<br><input id="activity_time"  name="activity_time" class="box" value="" />
    <br />
    <br>活动时长<br><input id="time"  name="time" class="box" value="" />
    <br>费用（单位：元，只填写数字）<br><input id="price"  name="price" class="box" value="" />
    <br>费用包含<br><input type="price_include" name="price_include" id="price_include" class="box" value="领队费,组织费,策划费">
    <br>支付链接<br><input id="pay_link"  name="pay_link" class="box" value="" />
    <br />
    <br>活动亮点<br><textarea id="activity_text1"  class="text_area"></textarea>
    <br>报名须知<br><textarea id="activity_text2"  class="text_area" value="1.低于活动最低人数活动取消，全额退款。<br>2.活动组队成功后费用不予退还。<br>3.报名成功后及时与与活动发起人取得联系">1.低于活动最低人数活动取消，全额退款<br>2.活动组队成功后费用不予退还<br>3.报名成功后及时与活动发起人取得联系</textarea>
    <br>参加人数(只填写阿拉伯数字)<br>最少<input type="text" name="minNum" id="minNum" width="30px">最多<input type="text" name="maxNum" id="maxNum" width="30px">
    <div style="width:100%;">
        <h1>活动详情</h1>
        <script id="editor" type="text/plain" style="width:100%;height:500px;"><?php $con=mysql_connect("localhost","furui","1013");
    mysql_select_db("shujuku");
    mysql_query("SET NAMES 'utf8'");

    $id=$_GET["id"];
    if($_GET["id"]){
    	$sql="select * from shujuku.citywalk WHERE id='".$id."'";

    	$details=mysql_query($sql,$con);while($result=mysql_fetch_array($details)){if($result{"text_info"})echo $result["text_info"];}
    }
    ?></script>
    </div>
<!--    <button onclick="getContent()">获得内容</button>-->
    <input value="" id="text_info" name="text_info" style="visibility: hidden">
    <input id="activity_info1"  name="activity_info1"/>
    <input id="activity_info2"  name="activity_info2"/>
    <br /><br/>
    活动地点
    <br><input id="mapPlace" class="box" name="place" value="" />

    <a onclick="search_place()">
        <img src="images/position.png" class="icon_position" />
    </a><br>
    <input id="mapPlaceInfo" name="place_info" value="" />
    <input id="mapPlaceX" name="placeX" value="" />
    <input id="mapPlaceY" name="placeY" value="" />
    <div id="container" class="map"></div>

    <br>联系方式（微信）<br><input id="weixin"  name="weixin" class="box" value="" />
    <br />
    <!--
    <div class="btn_upload_pictures">
        <a href="" style="color:#335aa8;" onmouseover="mOver(this)" onmouseout="mOut(this)" onclick="document.getElementById('upload').click()">上传图片</a>
    </div>
    -->

    <input type="file" name="file1" onchange="readfile(this)">
<!--    <img src="" id="pic1" width="500px">-->
    <br>
    <input type="file" name="file2" onchange="readfile(this)">
<!--    <img src="" id="pic2" width="500px">-->
    <br>
    <input type="file" name="file3" onchange="readfile(this)">
<!--    <img src="" id="pic3" width="500px">-->
    <br>
    <br>


    <button id="button" type="button" onclick="submit_click()">
        确认发布
    </button>


    <input id="submit" type="submit" name="submit" value="提交" style="visibility: hidden;">
</form>
<br />






<script type="text/javascript">
    var ue = UE.getEditor('editor');
    document.getElementById("cityBtn").onclick=function(){
        var request=new XMLHttpRequest();
        request.open("GET","addCity.php?cityName="+document.getElementById("cityName").value+"&cityNote="+document.getElementById("cityNote").value);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4){
                if(request.status===200){
                    
                    var city=request.responseText;
                    var obj=document.getElementById("city");
                    
                    city=new Function("return" + city)();
                    obj.options[obj.length]=new Option(city.cityname,city.cityid);
                    document.getElementById("cityName").value="";
                    hiddenAdd();
                    // obj.add(new Option(city.cityname,city.cityname);
                }else{
                    alert("失败");
                }
            }
        }
    };
    function hiddenAdd(){
        document.getElementById("addCity").style.display="none";
        document.getElementById("black").style.display="none";
    }
    function showAdd(){
        document.getElementById("addCity").style.display="block";
        document.getElementById("black").style.display="block";
    }
    function getContent() {
        document.getElementById("text_info").value=UE.getEditor('editor').getContent();
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
    	
        document.getElementById("activity_info1").value=document.getElementById("activity_text1").value;
        document.getElementById("activity_info2").value=document.getElementById("activity_text2").value;
        document.getElementById("text_info").value=UE.getEditor('editor').getContent();
        var input=document.getElementsByTagName("input");
        var err=document.createElement("p");
        var errtext=document.createTextNode("请输入信息");
        err.setAttribute("id","error_text");
        err.appendChild(errtext);
        if(document.getElementById("city").value==""){
            alert("请选择城市");
        }
        else{
            var arr=["","","","","","","","","","","","","","",];

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
//        document.getElementById("submit").click();
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
<?php
error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
session_start();
$kindId=$_GET["kindId"];
if(empty($_SESSION["id"])){
    echo "<script>alert('请先登录');location.href='index.html';</script>";
//        echo "<script>alert('".$password.$pass."');</script>";
}
if($_GET["action"]&&$_GET["action"]=='change'){

    $con=mysql_connect("localhost","furui","1013");
    mysql_select_db("shujuku");
    mysql_query("SET NAMES 'utf8'");

    $id=$_GET["id"];
    $sql="select * from shujuku.citywalk WHERE id='".$id."'";

    $details=mysql_query($sql,$con);

    while($result=mysql_fetch_array($details)){
        $title=$result["title"];
        $activity_time=$result["activity_time"];
        $price=$result["price"];
        $activity_info1=$result["activity_info1"];
        $activity_info2=$result["activity_info2"];
        $place=$result["place"];
        $placeX=$result["placeX"];
        $placeY=$result["placeY"];
        $place_info=$result["place_info"];
        $weixin=$result["weixin"];
        $show_state=$result["show_state"];
        $kindId=$result["kindId"];
        $howlong=$result["howlong"];
        $pic1=$result["pic1"];
        $pic2=$result["pic2"];
        $pic3=$result["pic3"];
        $pay_link=$result["pay_link"];
        $text_info=$result["text_info"];
        $city=$result["city"];
        $minNum=$result["minNum"];
        $maxNum=$result["maxNum"];
        $price_include=$result["price_include"];
    }
    echo "<script> document.getElementById('title').value='".$title."';".
        "document.getElementById('activity_time').value='".$activity_time."';".
        "document.getElementById('activity_text1').value='".$activity_info1."';".
        "document.getElementById('activity_text2').value='".$activity_info2."';".
        "document.getElementById('price').value='".$price."';".
        "document.getElementById('mapPlace').value='".$place."';".
        "document.getElementById('mapPlaceX').value='".$placeX."';".
        "document.getElementById('mapPlaceY').value='".$placeY."';".
        "document.getElementById('mapPlaceInfo').value='".$place_info."';".
        "document.getElementById('time').value='".$howlong."';".
        "document.getElementById('weixin').value='".$weixin."';".
        "document.getElementById('pay_link').value='".$pay_link."';".
        "document.getElementById('text_info').value='".$text_info."';".
        "document.getElementById('minNum').value='".$minNum."';".
        "document.getElementById('maxNum').value='".$maxNum."';".
        "document.getElementById('form').action='".htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id."&kindId=".$kindId."&action=change"."';".
        "document.getElementById('price_include').value='".$price_include."';".
        "</script>";
    // echo "<script>function setContent(){
    //     var arr = [];
    //     arr.push('使用editor.setContent(\"欢迎使用ueditor\")方法可以设置编辑器的内容');
    //     UE.getEditor('editor').setContent('".$text_info."', true);
    // }window.onload=setContent;
    // </script>";

//    if($pic1!="0"){
//        echo "<script>document.getElementById('pic1').setAttribute('src','".$pic1."');</script>";
//    }else{
//        echo "<script>document.getElementById('pic1').style.display='none';</script>";
//    }
//    if($pic2!="0"){
//        echo "<script>document.getElementById('pic2').setAttribute('src','".$pic2."');</script>";
//    }else{
//        echo "<script>document.getElementById('pic2').style.display='none';</script>";
//    }
//    if($pic3!="0") {
//        echo "<script>document.getElementById('pic3').setAttribute('src','" . $pic3 . "');</script>";
//    }else{
//        echo "<script>document.getElementById('pic3').style.display='none';</script>";
//    }

    if($show_state=="不显示"){
        echo "<script>document.getElementById('show').checked=false;document.getElementById('unshow').checked=true;</script>";
    }
    echo '<script>var objText="'.$city.'"
for(var i=0;i<document.getElementById("city").options.length;i++) {
        if(document.getElementById("city").options[i].value == objText) {
            document.getElementById("city").options[i].selected = true;
                break;
            }
        }</script>'; 

}
?>
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

$pic_path='upload';

if(!file_exists($pic_path)){
    mkdir($pic_path);
}

if(isset($_POST["submit"])&&$_POST["submit"]=="提交"){
    $kindId=$_GET["kindId"];
    $title=$_POST["title"];
    $activity_time=$_POST["activity_time"];
    $time=$_POST["time"];
    $price=$_POST["price"];
    $pay_link=$_POST["pay_link"];
    $activity_info1=$_POST["activity_info1"];
    $activity_info2=$_POST["activity_info2"];
    $place=$_POST["place"];
    $placeX=$_POST["placeX"];
    $placeY=$_POST["placeY"];
    $place_info=$_POST["place_info"];
    $weixin=$_POST["weixin"];
    $show_state=$_POST["show_state"];
    $text_info=$_POST["text_info"];
    $city=$_POST["city"];
    $minNum=$_POST["minNum"];
    $maxNum=$_POST["maxNum"];
    $price_include=$_POST["price_include"];
    $key="";
    $pattern='1234567890abcdefghijklmnopqrstuvwxyz';
    for($i=0;$i<8;$i++){
        $key.=$pattern[rand(0,35)];
    }
    $id=$key;

    $newpic1="0";
    $newpic2="0";
    $newpic3="0";

    if($_GET["action"]&&$_GET["action"]=='change'){
        $con=mysql_connect("localhost","furui","1013");

        mysql_select_db("shujuku");
        mysql_query("SET NAMES 'utf8'");
        $i=$_GET["id"];
        $sql="select * from citywalk WHERE id='".$i."'";

        $details=mysql_query($sql,$con);

        while($result=mysql_fetch_array($details)){
            $newpic1=$result["pic1"];
            $newpic2=$result["pic2"];
            $newpic3=$result["pic3"];
        }
    }


    if($_FILES["file1"]["error"]>0){
        $pic1=$newpic1;
    }else{
        $pic1="./youquadmin/".$pic_path."/".$_FILES["file1"]["name"];
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
    $add_time=time();
    $test1 = addslashes($pic1);
    $test2 = addslashes($pic2);
    $test3 = addslashes($pic3);

    $server_name="localhost";
    $user_name="furui";
    $password="1013";
    $con=mysql_connect("localhost","furui","1013");

    mysql_select_db("shujuku");
    mysql_query("SET NAMES 'utf8'");

if($_GET["action"]&&$_GET["action"]=='change'){
    $id=$_GET["id"];
    $sql_insert="UPDATE citywalk SET title ='$title',activity_time='$activity_time',howlong='$time',price='$price',activity_info1='$activity_info1',activity_info2='$activity_info2',place='$place',placeX='$placeX',placeY='$placeY',place_info='$place_info',pay_link='$pay_link',weixin='$weixin',pic1='$pic1',pic2='$pic2',pic3='$pic3',show_state='$show_state',text_info='$text_info',city='$city',minNum='$minNum',maxNum='$maxNum',add_time='$add_time',price_include='$price_include',kindId='$kindId' WHERE id='$id'";
    $res_insert=mysql_query($sql_insert);
}else{
    $mysql_insert="insert into citywalk(title,activity_time,howlong,price,activity_info1,activity_info2,place,placeX,placeY,place_info,weixin,pic1,pic2,pic3,id,show_state,kindId,pay_link,text_info,city,minNum,maxNum,add_time,price_include)
VALUES('$title','$activity_time','$time','$price','$activity_info1','$activity_info2','$place','$placeX','$placeY','$place_info','$weixin','$pic1','$pic2','$pic3','$id','$show_state','$kindId','$pay_link','$text_info','$city','$minNum','$maxNum','$time','$price_include') ;";
    $res_insert=mysql_query($mysql_insert);
}


    echo "<script>alert('发布成功');location.href='adminList.php?id=".$kindId."';</script>";


}



?>
