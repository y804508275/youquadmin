<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL&~(E_WARNING | E_NOTICE));

$cityname=$_GET["cityName"];
$citynote=$_GET["cityNote"];
$key="";
$pattern='1234567890abcdefghijklmnopqrstuvwxyz';
for($i=0;$i<8;$i++){
    $key.=$pattern[rand(0,35)];
}
$id=$key;
include 'autoload.php';
$db=new ConnectDb('localhost','furui','1013','shujuku','utf8');
$sql="insert into city(cityName,cityId,cityNote)VALUES('$cityname','$id','$citynote')";
$db->search($sql);
$array=array(cityname=>$cityname,cityid=>$id,citynote=>$citynote);
echo json_encode($array,JSON_UNESCAPED_UNICODE);

?>