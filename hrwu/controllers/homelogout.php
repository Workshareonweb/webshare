<?php

class Homelogout extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();
	}
	
	public function logout()
	{
		Session::destroy();
		header('location: ' . URL );
		exit;
	}
}