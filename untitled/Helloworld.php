<!DOCTYPE html>
<html>
<head>
    <script src="jquery-1.12.3.min.js">

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
    </script>
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
        div
        {
            font-size:20px;
            color:black;
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
    </style>
</head>
<body>
    <div class="panel">
        <p>Hello world!</p>
    </div>
    <p class="flip">Click here!</p>
    <br>
    <span>line1</span><span class="line1"></span>
    <br><br>
    <span>line2</span><span class="line2"></span>
    <br><br>
    <span>line3</span><span class="line3"></span>
</body>
</html>