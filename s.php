<?php
header("Content-type: text/html; charset=utf-8");
/**
 *
 * <p>对传入的内容进行分词utf-8编码</p>
 * @author yichen
 * @version 1.0 2010-11-09
 *
 */
$search=$_GET["search"];
$kindId=$_GET["kindId"];
$sear=Detach::dualDecom($search);

$con=mysql_connect("localhost","furui","1013");
mysql_select_db("upload");
mysql_query("SET NAMES 'utf8'");

$sql="SELECT * FROM upload.upload_table WHERE kindId ='".$kindId."' AND title LIKE '%".$sear[0]."%'";
$list=mysql_query($sql,$con);
while($result=mysql_fetch_array($list)){
    $title=$result["title"];
    $id=$result["id"];

    echo '<div class="div2"><div class="row">'.$title.'</div>
    <div class="btn2"><a href="">删除</a></div>
    <div class="btn1" onclick="location.href=\'revise.php?id='.$id.'\'"><a href="revise.php?id='.$id.'" target="_blank">更改</a></div>
    <br /><br /><hr></div>';
}


class Detach{
    public static function dualDecom($str)
    {
        preg_match_all("/[a-zA-z0-9]+/",$str,$eg);//英文单独分离出来
        //所有汉字后添加ASCII的0字符,此法是为了排除特殊中文拆分错误的问题
        $str = preg_replace("/[\x80-\xff]{3}/","\\0".chr(0x00),$str);
        //拆分的分割符
        $search = array(",", "/", "\\", ".", ";", ":", "\"", "!", "~", "`", "^", "(", ")", "?", "-", "\t", "\n", "'", "<", ">", "\r", "\r\n","$", "&", "%", "#", "@", "+", "=", "{", "}", "[", "]", "：", "）", "（", "．", "。", "，", "！", "；", "“", "”", "‘", "’", "［", "］", "、", "—", "　", "《", "》", "－", "…", "【", "】",);
        //替换所有的分割符为空格
        $str = str_replace($search,' ',$str);
        //用正则匹配半角单个字符或者全角单个字符,存入数组$ar
        preg_match_all("/[\x80-\xff]+?\\x00/",$str,$ar);
        $ar = $ar[0];
        //去掉$ar中ASCII为0字符的项目
        for ( $i = 0; $i < count($ar); $i++ )
            if ($ar[$i] != chr(0x00)) $ar_new[]=$ar[$i];
        $ar = $ar_new;
        unset($ar_new);
        $oldsw = 0;
        //把连续的半角存成一个数组下标,或者全角的每2个字符存成一个数组的下标
        for ( $ar_str = '', $i = 0; $i < count($ar); $i++)
        {
            $sw=strlen($ar[$i]);
            if ( $i > 0 and $sw != $oldsw) $ar_str.=" ";
            if ( $sw == 1 ){
                $ar_str.= $ar[$i];
            }else{
                if ( strlen($ar[$i+1]) >= 2 ){
                    $ar_str.= $ar[$i].$ar[$i+1].' ';
//                    if(strlen($ar[$i+2]) >= 2){
//                        $ar_str.= $ar[$i].$ar[$i+1].$ar[$i+2].' ';
//                        if(strlen($ar[$i+3]) >= 2){
//                            $ar_str.= $ar[$i].$ar[$i+1].$ar[$i+2].$ar[$i+3].' ';
//                            if(strlen($ar[$i+4]) >= 2){
//                                $ar_str.= $ar[$i].$ar[$i+1].$ar[$i+2].$ar[$i+3].$ar[$i+4].' ';
//                                if(strlen($ar[$i+5]) >= 2){
//                                    $ar_str.= $ar[$i].$ar[$i+1].$ar[$i+2].$ar[$i+3].$ar[$i+4].$ar[$i+5].' ';
//                                    if(strlen($ar[$i+6]) >= 2){$ar_str.= $ar[$i].$ar[$i+1].$ar[$i+2].$ar[$i+3].$ar[$i+4].$ar[$i+5].$ar[$i+6].' ';}
//                                }
//                            }
//                        }
//                    }
                }elseif ( $oldsw == 1 OR $oldsw == 0 ){
                    $ar_str.= $ar[$i];
                }
                $oldsw=$sw;
            }


        }
        //去掉连续的空格
        $ar_str = trim(preg_replace("# {1,}#i"," ",$ar_str));
        $ar_str = preg_replace("/[^\s\x{4e00}-\x{9fa5}]/u",'',$ar_str);
        $rst =  explode(' ',$ar_str);
        if(!empty($eg)){
            foreach($eg[0] as $val){$rst[count($rst)] = $val;}
        }
        return $rst;
    }
}



?>