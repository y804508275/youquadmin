<?php
	header("Content-type: text/html; charset=utf-8");
	error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
	$id=$_GET["id"];

	include 'autoload.php';
	$db=new ConnectDb("localhost",'furui','1013','shujuku','utf8');
	$db->search("select * from shujuku.citywalk WHERE id='".$id."'");

    while($result=$db->fetch_array()){
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
$db->search($sql_insert);
?>