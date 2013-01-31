<?php
/**
 * 该页面用于接受url参数，并执行对应的控制器派生类及其方法
 */
//定义App路径
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');
//定义app的url路径
$pageURL='http://'. $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
//定义url尾缀为.html
//解码，解决中文乱码问题
$pageURL=urldecode($pageURL);
$pageURL=rtrim($pageURL,'.html');

$n=strpos($pageURL,'index.php');//寻找位置
if ($n) $strAfter=substr($pageURL,0,$n);//删除后面
defined('APP_URL') or define('APP_URL', @$strAfter);

// 系统目录定义
defined('Tie_PATH') or define('Tie_PATH', dirname(__FILE__).'/');

//载入基础类库
require_once(Tie_PATH.'lib/Controller.php');
require_once(Tie_PATH.'lib/Model.php');
require_once(Tie_PATH.'lib/View.php');
require_once(Tie_PATH.'Common/function.php');


session_start();

//将当前的url分隔为数组，以index.php为界限
$pageURL=explode("index.php",$pageURL) ;

//parse the page request and other GET variables
//字符串分割为数组 获取index.php后面 的字符串
$parsed = explode('/' , @$pageURL[1]);

foreach ($parsed as $key=>$value){
	
	define("URL_P$key",$value);
	
}

//判断控制器存在与否，不存在则载入默认index
//定义全局控制器变量CTR
if(@$parsed[1]){
	define('CTR', @$parsed[1]);
}
else{define('CTR', "index");}

//定义控制器全名
$controllerName =CTR.'Controller';


//默认不带参数 执行 index模块的index方法
if(@$parsed[2]==null){
	
	$parsed[2]="index";
}
//定义全局变量FUN：方法
define('FUN', $parsed[2]);




//获取控制器派生类类的路径
$ControllerDir = APP_PATH . 'Controller/' . $controllerName . '.php';

//检查控制器派生类是否可用
if (file_exists($ControllerDir))
{
	require_once($ControllerDir);
	//i判断控制器类中是否定义了类名
	if (class_exists($controllerName))
	{
		//判断控制器类中是否存在某一个方法
		if(method_exists($controllerName,FUN)){
			//初始化app的控制器类
			//执行了某控制器类的某方法
			$App = new $controllerName();
			$App->$parsed[2]();		
		}
		else{
			die("$ControllerDir 中<span style='color:red;'>方法 ".FUN."</span> 未定义！");
		}
	}
	else
	{
		//控制器类中没有定义类名
		die("$ControllerDir 中 <span style='color:red;'> $Controller 类</span> 未定义！");
	}
}
else
{
	//控制器文件不存在
	die("控制器文件 <span style='color:red;'>$ControllerDir</span> 不存在！");
}