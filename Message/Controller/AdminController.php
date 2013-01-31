<?php
class AdminController extends Controller {
	
	
    public function index() {
    //判断是否登陆
    	
		if (@$_SESSION['name']) {
			$message=$this->M('admin');
			
			urlJump(APP_URL.'index.php/admin/getDepartment/');
		} else {
		    //显示一个登陆界面
		    //echo '跳轉到登陸界面';  
		    urlJump(APP_URL.'index.php/admin/login.html');
		   
		}
    }
    
    public function login(){
    	
    	if (@$_SESSION['name']) {
    		urlJump(APP_URL.'index.php/admin/getDepartment/');
    	}else{
    		$this->display();
    	}
    	
    }
    
    //登錄檢查
    public function loginCheck(){
    	$admin=$this->M('admin');
    	$admin->loginCheck();
    }
    
    //刪除留言
    public function delMsg(){
    	$id=URL_P3;
    	
    	$admin=$this->M('admin');
    	$admin->delMsg($id);
    }
    
    //回復留言
    public function reply(){
    	$id=URL_P3;
    	$admin=$this->M('admin');
    	$admin->reply($id);
    }
    
    public function getDepartment(){
    	$department=URL_P3;
    	//echo $department;
    	$message=$this->M('message');
    	$message=$message->getDepartment($department);
    	$this->assign('message', $message);
    	
    	//var_dump($message['result']) ;
    	$this->display();
    	//echo $message['replyerResult'];
    	 
    }
   

}
