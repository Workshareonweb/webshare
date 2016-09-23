<?php

class Pagemanager extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();
	}
	
	public function pagedefault() 
	{
		$this->view->selectUserlogin = $this->model->selectUserlogin();
		$this->view->renderadmin('pagemanager/index');
	}
	public function pagemenu()
	{
		
	}
	
}