<?php

class Pagedefault extends Controller {

	public function __construct() {
		parent::__construct();
	}
	public function pagedefault() {
		//echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
		$this->view->render('index/index');
	}
	
}