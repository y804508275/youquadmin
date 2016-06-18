<?php

error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
$a="addKinds";
    $b="name";
    $c="id";
    if($_GET["addKinds"]){
        $kind=$_GET["addKinds"];

        $key="";
        $pattern='1234567890abcdefghijklmnopqrstuvwxyz';
        for($i=0;$i<8;$i++){
            $key.=$pattern[rand(0,35)];
        }
        $id=$key;
        $con=mysql_connect("localhost","furui","1013");
        mysql_select_db("shujuku");
        mysql_query("SET NAMES 'utf8'");

        $sql="insert into admin(kinds,id)VALUES('$kind','$id')";
        $res=mysql_query($sql);
        echo '<div class="row">'.$kind.'</div>
                    <div class="btn1"><a href="adminList.php?id='.$id.'" target="_blank">管理</a></div>
                    <div id="add">

                            <input type="text" name="kind" value="" id="name'.$id.'">
                            <input type="submit" name="'.$id.'" value="重命名" onclick="rename(this)">


                    </div>
                    <br /><br />';
    }
    if($_GET["name"]){
        $id=$_GET["id"];
        $kind=$_GET["name"];
        $con=mysql_connect("localhost","furui","1013");
        mysql_select_db("shujuku");
        mysql_query("SET NAMES 'utf8'");
        $sql="UPDATE admin SET kinds='$kind' WHERE id='$id'";
        $res=mysql_query($sql);
        echo $kind;
    }


?>