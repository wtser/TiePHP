<?php
class IndexController extends Controller {
	
    public function index() {
        $this->display();
    }
    
    public function ajaxData(){
    	$message=$this-> M('message');
        $message->selectByNum(8);
    }
   

}
