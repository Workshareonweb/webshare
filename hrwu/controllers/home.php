<?php

class Home extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}
	
	public function pagedefault() 
	{
		$this->view->render('home/index');
	}
	public function dept() 
	{
		$this->view->render('home/dept');
	}
	
}