<?php
    error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
    if($_GET["addKinds"]){
        $kind=$_GET["addKinds"];
        $key="";
        $pattern='1234567890abcdefghijklmnopqrstuvwxyz';
        for($i=0;$i<8;$i++){
            $key.=$pattern[rand(0,35)];
        }
        $id=$key;
        include 'autoload.php';
        $db=new ConnectDb('localhost','furui','1013','shujuku','utf8');
        $sql="insert into admin(kinds,id)VALUES('$kind','$id')";
        $db->search($sql);
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
        include 'autoload.php';
        $db=new ConnectDb('localhost','furui','1013','shujuku','utf8');
        $sql="UPDATE admin SET kinds='$kind' WHERE id='$id'";
        $db->search($sql);
        echo $kind;
    }
?>