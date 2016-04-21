<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>The 3rd Page3</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5doOBpnqfkYzGUuFwrOnftldguOmDiMC"></script>
    <script src="js/upload_Function.js" type="text/javascript"></script>
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

    <form action="save.php" method="post" class="information" enctype="multipart/form-data" id="form">
        <br>
        <input type="radio" name="show_state" value="显示" checked/>显示
        <input type="radio" name="show_state" value="不显示"/>不显示
        <br>
        <input id=1 onfocus="isClear(this)" onblur="isRecord(this)" name="title" class="box" value=" 标题" />
        <br />
        <input id=2 onfocus="isClear(this)" onblur="isRecord(this)" name="sub_title" class="box" value=" 副标题" />
        <br />
        <input id=3 onfocus="isClear(this)" onblur="isRecord(this)" name="time" class="box" value=" 时间" />
        <br />
        <input id=4 onfocus="isClear(this)" onblur="isRecord(this)" name="price" class="box" value=" 费用" />
        <br />
        <input id=5 onfocus="isClear(this)" onblur="isRecord(this)" name="host" class="box" value=" 团队" />
        <br />
        <textarea id="activity_text" onfocus="isClear(this)" onblur="isRecord(this)" class="text_area"> 活动详情</textarea>
        <input id="activity_info"  name="activity_info"/>
        <br />
        <input id="mapPlace" onfocus="isClear(this)" name="place" class="box" onblur="isRecord(this)" value=" 活动地点" />

        <a onclick="search_place()">
            <img src="images/position.png" class="icon_position" />
        </a>
        <input id="mapPlaceInfo" name="place_info" value="" />
        <input id="mapPlaceX" name="placeX" value="" />
        <input id="mapPlaceY" name="placeY" value="" />
        <div id="container" class="map"></div>
        <input id=8 onfocus="isClear(this)" onblur="isRecord(this)" name="phone" class="box" value=" 联系方式" />
        <br />
        <input id=9 onfocus="isClear(this)" onblur="isRecord(this)" name="weixin" class="box" value=" 联系方式（微信）" />
        <br />
        <!--
        <div class="btn_upload_pictures">
            <a href="" style="color:#335aa8;" onmouseover="mOver(this)" onmouseout="mOut(this)" onclick="document.getElementById('upload').click()">上传图片</a>
        </div>
        -->

        <input type="file" name="file1" onchange="readfile(this)">

        <br>
        <input type="file" name="file2" onchange="readfile(this)">

        <br>
        <input type="file" name="file3" onchange="readfile(this)">
        <br>
        <br>





            <button id="button" type="button" onclick="submit_click()">
                确认发布
            </button>


        <input id="submit"type="submit" name="submit" value="提交" style="visibility: hidden;">
    </form>
    <br />
    <?php
        $kindId=$_GET["kindId"];
        echo "<script>document.getElementById('form').action='save.php?kindId=".$kindId."';</script>";
    ?>

    <script type="text/javascript">
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