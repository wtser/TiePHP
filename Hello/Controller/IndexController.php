<?php
class IndexController extends Controller {

	public function index() {


		$this->assign('hello','Hello,TiePHP');
		$this->assign('sorce','这是我的第一次');

		$this->display();


	}

}
