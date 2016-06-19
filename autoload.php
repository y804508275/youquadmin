<?php
	function __autoload($class_name){
        $class_path=$class_name.'.class.php';
        if(file_exists($class_path)){
        	include_once($class_path);
        }
    }
?>