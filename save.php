
<?php
header("Content-type: text/html; charset=utf-8");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/7
 * Time: 0:09
 */

$pic_path='upload';
$kindId=$_GET["kindId"];
if(!file_exists($pic_path)){
    mkdir($pic_path);
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

    $key="";
    $pattern='1234567890abcdefghijklmnopqrstuvwxyz';
    for($i=0;$i<8;$i++){
        $key.=$pattern[rand(0,35)];
    }
    $id=$key;



    if($_FILES["file1"]["error"]>0){
        $pic1="0";
    }else{
        $pic1="./".$pic_path."/".$_FILES["file1"]["name"];
        move_uploaded_file($_FILES["file1"]["tmp_name"],
            $pic_path."/" . $_FILES["file1"]["name"]);
    }
    if($_FILES["file2"]["error"]>0){
        $pic2="0";
    }else{
        $pic2="./".$pic_path."/".$_FILES["file2"]["name"];
        move_uploaded_file($_FILES["file2"]["tmp_name"],
            $pic_path."/" . $_FILES["file2"]["name"]);
    }
    if($_FILES["file3"]["error"]>0){
        $pic3="0";
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


    $mysql_insert="insert into upload_table(title,sub_title,activity_time,price,host,activity_info,place,placeX,placeY,place_info,phone,weixin,pic1,pic2,pic3,id,show_state,kindId)
VALUES('$title','$sub_title','$activity_time','$price','$host','$activity_info','$place','$placeX','$placeY','$place_info','$phone','$weixin','$pic1','$pic2','$pic3','$id','$show_state','$kindId') ;";
    $res_insert=mysql_query($mysql_insert);
    echo "<script>alert('发布成功');location.href='adminList.php?id=".$kindId."';</script>";


}



?>

