<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/13
 * Time: 20:49
 */
if(isset($_POST["submit"])&&$_POST["submit"]=="增加类别"){
    $kind=$_POST["kind"];

    $key="";
    $pattern='1234567890abcdefghijklmnopqrstuvwxyz';
    for($i=0;$i<8;$i++){
        $key.=$pattern[rand(0,35)];
    }
    $id=$key;

    $con=mysql_connect("localhost","furui","1013");
    mysql_select_db("upload");
    mysql_query("SET NAMES 'utf8'");

    $sql="insert into admin(kinds,id)VALUES('$kind','$id')";
    $res=mysql_query($sql);
    echo "<script>location.href='admin.php';</script>";
}
if(isset($_POST["submit"])&&$_POST["submit"]=="重命名"){
    $id=$_GET["kindId"];

    $kind=$_POST["kind"];
    $con=mysql_connect("localhost","furui","1013");
    mysql_select_db("upload");
    mysql_query("SET NAMES 'utf8'");

    $sql="UPDATE admin SET kinds='$kind' WHERE id='$id'";
    $res=mysql_query($sql);
    echo "<script>location.href='admin.php';</script>";
}
$con=mysql_connect("localhost","furui","1013");
mysql_select_db("upload");
mysql_query("SET NAMES 'utf8'");

$sql="insert into root(username,password)VALUES('voluntour','123')";
$res=mysql_query($sql);
?>