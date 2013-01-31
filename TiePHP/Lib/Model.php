<?php
class Model{
	public function __construct(){
		
		$tieConfig=require(Tie_PATH.'Conf/config.php');
		$appConfig=include(APP_PATH.'Conf/config.php');
		$config= array_merge ($tieConfig,$appConfig); 

		//var_dump($config);
		$conn = mysql_connect($config['DB_HOST'], $config['DB_USER'], $config['DB_PWD']);
	    if (!$conn) {
	        die('Could not connect: ' . mysql_error());
	    }

	    mysql_select_db($config['DB_NAME'], $conn);
	    mysql_query("SET NAMES 'UTF8'");
	    

	}

	public function M($table){
		include(APP_PATH.'Model/'.$table.'Model.php');
		$modelName=$table.'Model'; 
		$obj= new $modelName($table);
		//返回派生类对象到controller。php中
		return $obj;
		

		//载入表名model派生类，返回一个实例

	}
	
	
}