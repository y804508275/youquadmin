<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>The new Page1</title>
    <script src="js/jquery-1.12.3.min.js">

    </script>
    <script type="text/javascript">
        var length1='30%';
        var length2='80%';
        var length3='50%';
        $(document).ready(function()
        {
            $(".line1").animate(
                    {
                        width:length1
                    }
            );
            $(".line2").animate(
                    {
                        width:length2
                    }
            );
            $(".line3").animate(
                    {
                        width:length3
                    }
            );
        });
        function addkind(){

        }
    </script>
    <?php
    session_start();
    session_unset("id");
    $con=mysql_connect("localhost","furui","1013");
    mysql_select_db("upload");
    mysql_query("SET NAMES 'utf8'");
    $username=$_POST["username"];
    $password=$_POST["password"];
    $sql="select * from upload.root WHERE username='$username'";
    $list=mysql_query($sql,$con);
    while($result=mysql_fetch_array($list)){
        $pass=$result["password"];
        if($pass==$password){
            $_SESSION["id"]=$pass;
        }
    }
    if(empty($_SESSION["id"])){
        echo "<script>alert('密码错误');location.href='adminindex.html';</script>";
//        echo "<script>alert('".$password.$pass."');</script>";
    }
    ?>
    <style type="text/css">
        div.panel,p.flip
        {
            margin:0;
            padding:5px;
            text-align:center;
            background:transparent;
            border:solid 1px black;
        }
        div.panel
        {
            height:120px;
            display:none;
        }
        .line1
        {
            background: red;height:30px;position:absolute;
        }
        .line2
        {
            background: green;height:30px;position:absolute;
        }
        .line3
        {
            background: blue;height:30px;position:absolute;
        }
        a
        {
            text-decoration: none;
            color:white;
        }
        .head
        {
            position:fixed;
            height:50px;
            left:0;
            top:0;
            width:100%;
            background-color: #335aa8;
            color:white;
            font-size:38px;
        }
        .div2
        {
            margin-top:70px;
            left:0;
        }
        .row
        {
            height:30px;
            position:absolute;
            margin-left:40px;
            font-size:22px;
            color:#335aa8;
        }
        #rows{
            margin-top: 200px;
        }
        .btn1
        {
            margin-left:280px;
            padding: 5px;
            width:80px;
            background-color: #335aa8;
            border-radius:3px;
            text-align: center;
            color:white;
            position:absolute;
        }
        .btn2
        {
            margin-left:380px;
            padding: 5px;
            width:80px;
            background-color: #335aa8;
            border-radius:3px;
            text-align: center;
            color:white;
            position:absolute;
        }
        #add{
            margin-left: 120px;
            padding: 10px 15px;
            margin-top: 50px;


        }
    </style>
</head>
<body>
    <div class="head"><div style="margin-left:30px;">活动列表</div></div>
    <div class="div2">
        <?php
            header("Content-type: text/html; charset=utf-8");
            /**
             * Created by PhpStorm.
             * User: Administrator
             * Date: 2016/4/11
             * Time: 18:08
             */

            $con=mysql_connect("localhost","furui","1013");
            mysql_select_db("upload");
            mysql_query("SET NAMES 'utf8'");


            $sql="select * from admin";


            $list=mysql_query($sql,$con);
            while($result=mysql_fetch_array($list)){
                $kind=$result["kinds"];
                $id=$result["id"];
                echo '<div class="row">'.$kind.'</div>
                    <div class="btn1"><a href="adminList.php?id='.$id.'" target="_blank">管理</a></div>
                    <br><br>
                    <div id="add">
                        <form id="" action="add.php?kindId='.$id.'" method="post">
                            <input type="text" name="kind" >
                            <input type="submit" name="submit" value="重命名">
                        </form>
                    </div>
                    <br /><br />';
            }
        ?>


    </div>
    <div id="add">
        <form id="" action="add.php" method="post">
            <input type="text" name="kind" >
            <input type="submit" name="submit" value="增加类别">
        </form>


    </div>
    <br><br><br>
    <div id="rows">
        <span>line1</span><span class="line1"></span>
        <br><br>
        <span>line2</span><span class="line2"></span>
        <br><br>
        <span>line3</span><span class="line3"></span>
    </div>

</body>
</html>