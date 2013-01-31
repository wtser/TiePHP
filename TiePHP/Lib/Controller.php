<?php
class Controller{
	

	private $data = array();

	//实例化view类
	public function display(){
		$view = new View();
		//遍历获得所有assgin参数
		foreach ($this->data as $variable=>$value){
			$view->assign($variable , $value);
		}
		$view->display();
	}
	//调用view类中的assign方法
	public function assign($variable , $value){
		$this->data[$variable] = $value;

	}

	//操作数据库模型类
	public function M($table){
		$model = new Model();
		$obj=$model->M($table);
		//返回派生类对象到控制器派生类
		return $obj;
	}


}