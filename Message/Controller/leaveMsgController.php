<?php
class leaveMsgController extends Controller {
	
    public function index() {
    	$department=$this->M('department');
    	$department=$department->getAll();
    	$this->assign('department', $department);
    	//$this->assign('test', "aaa");
    	//var_dump($department);
        $this->display();
    }
    public function submit(){
    	$message = $this->M('message');
    	$message->leaveMsg();
    }
    
    
   
}
