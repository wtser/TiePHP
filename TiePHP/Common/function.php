<?php
function include_css($css){
	$cssDir=APP_URL.'public/css/'.$css;
	echo '<link rel="stylesheet" type="text/css" href="'.$cssDir.'">';
	
}

function include_js($js){
	$jsDir=APP_URL.'public/js/'.$js;
	echo '<script type="text/javascript" language="javascript" src="'.$jsDir.'"></script>';
	
}

function include_tpl($tpl){
	$tplDir=APP_URL.'View//'.$tpl;
	
	
}

//頁面跳轉函數
function urlJump($url){
	$url='<script type="text/javascript">
window.location.href="'.$url.'";

</script>';
	echo $url ;
	
}