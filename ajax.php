<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/8
 * Time: 14:49
 */
header("Content-type: text/html; charset=utf-8");
$staff=array(
    array("name"=>"洪七","number"=>"101","sex"=>"男","job"=>"总经理"),
    array("name"=>"郭靖","number"=>"102","sex"=>"男","job"=>"开发工程师"),
    array("name"=>"黄蓉","number"=>"103","sex"=>"女","job"=>"产品经理")
);
if($_SERVER["REQUEST_METHOD"]=="GET"){
    search();
}elseif($_SERVER["REQUEST_METHOD"]=="POST"){
    create();
}

function search(){
    if(!isset($_GET["number"])||empty($_GET["number"])){
        echo "参数错误";
        return;
    }

    global $staff;
    $number=$_GET["number"];
    $result="没有找到员工";

    foreach($staff as $value){
        if($value["number"]==$number){
            $result=$value["number"].$value["name"].$value["sex"].$value["sex"].$value["job"];
            break;
        }
    }
    echo $result;
}
function create(){
    ;
}
?>