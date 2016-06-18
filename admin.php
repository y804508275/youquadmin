<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>The new Page1</title>
    <script src="js/jquery-1.12.3.min.js"></script>
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
    $username=$_POST["username"];
    $password=$_POST["password"];
    include('class.all.php');
    $db=new ConnectDb('localhost','furui','1013','shujuku','utf8');
    $db->search("select * from shujuku.root WHERE username='$username'");
    while($result=$db->fetch_array()){
        $pass=$result["password"];
        if($pass==$password){
            $_SESSION["id"]=$pass;
        }
    }
    if(empty($_SESSION["id"])){
        echo "<script>alert('密码错误');location.href='index.html';</script>";
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
            z-index:100;
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
            margin-left: 400px;
            padding: 10px 15px;
        }
    </style>
</head>
<body>
    <div class="head"><div style="margin-left:30px;">活动列表</div></div>
    <div class="div2">
        <?php
            header("Content-type: text/html; charset=utf-8");
            $db=new ConnectDb('localhost','furui','1013','shujuku','utf8');
            $db->search("select * from admin");
            while($result=$db->fetch_array()){
                $kind=$result["kinds"];
                $id=$result["id"];
                echo '<div class="row" id="kindname'.$id.'">'.$kind.'</div>
                    <div class="btn1"><a href="adminList.php?id='.$id.'" target="_blank">管理</a></div>
                    <div id="add">
                            <input type="text" name="kind" value="" id="name'.$id.'">
                            <input type="submit" name="'.$id.'" value="重命名" onclick="rename(this)">
                    </div>
                    <br /><br />';
            }
        ?>
    <div id="result"></div>
    </div>
    <div id="add">
            <input type="text" name="kind" id="kind">
            <input type="submit" name="submit" id="addKinds" value="增加类别">
    </div>
    <br><br><br>
    <div id="rows">
        <span>line1</span><span class="line1"></span>
        <br><br>
        <span>line2</span><span class="line2"></span>
        <br><br>
        <span>line3</span><span class="line3"></span>
    </div>
<script>
    document.getElementById("addKinds").onclick=function(){
    	if (document.getElementById("kind").value) {
    		var request=new XMLHttpRequest();
	        request.open("GET","add.php?addKinds="+document.getElementById("kind").value);
	        request.send();
	        request.onreadystatechange=function(){
	            if(request.readyState==4){
	                if(request.status===200){
	                    document.getElementById("result").innerHTML+=request.responseText;
	                    document.getElementById("kind").value="";
	                }else{
	                    alert("失败");
	                }
	            }
        	}
    	}else{
    		alert("请输入名称");
    	}
        
    };
    function rename(obj){
    	if (document.getElementById("name"+obj.name).value) {
	        var request=new XMLHttpRequest();
	        request.open("GET","add.php?name="+document.getElementById("name"+obj.name).value+"&id="+obj.name);
	        request.send();
	        request.onreadystatechange=function(){
	            if(request.readyState==4){
	                if(request.status===200){
	                    document.getElementById("kindname"+obj.name).innerHTML=request.responseText;
	                    document.getElementById("name"+obj.name).value="";
	                }else{
	                    alert("失败");
	                }
	            }
	        }
	    }else{
	    	alert("请输入名称");
	    }
    }
</script>
</body>
</html>