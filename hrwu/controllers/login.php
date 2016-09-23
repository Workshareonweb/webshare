<?php

class Login extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function pagedefault() 
	{
		$this->view->renderlogin('login/index');
	}
	
	function run()
	{
		$this->model->run();
	}
	
	public function error()
	{
		$this->view->renderlogin('login/error');	
	}
}