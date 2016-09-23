<?php

class Error extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function pagedefault() {
		$this->view->msg = 'This page doesnt exist';
		$this->view->renderError('error/index');
	}

}