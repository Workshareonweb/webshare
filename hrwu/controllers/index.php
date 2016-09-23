<?php

class Index extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();
	}
	
	public function pagedefault() {
		//echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
		//$this->view->usermemberafterlogin = $this->model->usermemberafterlogin();
		$this->view->render('index/index');
	}
	
	public function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	public function dept()
	{
		$this->view->render('index/dept');
	}
}