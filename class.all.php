<?php
	error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
	class ConnectDb{
		private $conn;
		private $queryid;
		public function __construct($host,$dbusername,$dbpassword,$dbname,$coding){
			$this->conn=mysql_connect($host,$dbusername,$dbpassword)or die("链接不成功");
			mysql_select_db($dbname,$this->conn)or die("数据库不存在");
			mysql_query("SET NAMES $coding");
		}
		public function search($sql){
			$this->queryid=mysql_query($sql,$this->conn);
		}
		public function fetch_array(){
			return mysql_fetch_array($this->queryid);
		}
	}
	class EchoList{
		public function __construct($citywalkid,$pic1,$title,$price,$place){
			echo '<div class="activity" onclick="location.href=\'activity.php?id='.$citywalkid.'\'">
                    <div class="activityImg">
                        <img src="'.$pic1.'">
                    </div>
                    <div class="activityNote" >
                        <div class="activityNoteLeft">
                            <p class="activityTitle">'.$title.'</p><span class="price">￥'.$price.'</span>
                            <br><span class="subNote">'.$place.'</span>
                        </div>
                    </div>
                 </div>';
		}
	}
?>