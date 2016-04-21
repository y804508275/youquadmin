
<?php
header("Content-type: text/html; charset=utf-8");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/11
 * Time: 19:32
 */

$con=mysql_connect("localhost","furui","1013");
mysql_select_db("upload");
mysql_query("SET NAMES 'utf8'");

$id=$_GET["id"];
$sql="select * from upload_table WHERE id='".$id."'";
echo $id;
$details=mysql_query($sql,$con);

while($result=mysql_fetch_array($details)){
    $title=$result["title"];

    echo '<h1>'.$title.'</h1>';
}
?>