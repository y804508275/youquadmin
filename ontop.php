<?php
header("Content-type: text/html; charset=utf-8");
/**
 *
 * <p>对传入的内容进行分词utf-8编码</p>
 * @author yichen
 * @version 1.0 2010-11-09
 *
 */
error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
$id=$_GET["id"];


$con=mysql_connect("localhost","furui","1013");
mysql_select_db("shujuku");
mysql_query("SET NAMES 'utf8'");

$sql="select * from shujuku.citywalk WHERE id='".$id."'";
$list=mysql_query($sql,$con);
    while($result=mysql_fetch_array($list)){
        $ifTop=$result["ifTop"];
        
    }
if($ifTop=="1"){
	$ifTop=0;
	$sql_insert="UPDATE citywalk SET ifTop ='$ifTop',top_time='0' WHERE id='$id'";
}
else{
	$ifTop=1;
	$top_time=time();
	$sql_insert="UPDATE citywalk SET ifTop ='$ifTop',top_time='$top_time' WHERE id='$id'";
}


$res_insert=mysql_query($sql_insert);



?>