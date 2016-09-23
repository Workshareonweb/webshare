<?php

class Information extends Controller {

	public function __construct() {
		parent::__construct();
		Auth::handleLogin();
	}
	
	public function pagedefault() {
		//echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);
		//$this->view->usermemberafterlogin = $this->model->usermemberafterlogin();
		$this->view->stafflist = $this->model->stafflist();
		$this->view->render('information/index');
	}
	
	public function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	public function dept()
	{
		$this->view->ListDepartment = $this->model->ListDepartment();
		$this->view->render('information/dept');
	}
	public function addDept()
	{
		$this->model->addDept();
	}
    public function deptEdition($id)
    {        
        $this->view->depttoedit = $this->model->depttoedit($id);
        $this->view->ListDepartment = $this->model->ListDepartment();
        $this->view->render('information/deptEdition');
    }
    public function jobposition()
    {
        $this->view->ListPosition = $this->model->ListPosition();
        $this->view->render('information/jobposition');
    }
    public function addEditPosition()
    {
        $this->model->addEditPosition();
    }
    public function jobposEdition($id)
    {
        $this->view->jobpostoedit = $this->model->jobpostoedit(@$id);
        $this->view->ListPosition = $this->model->ListPosition();
        $this->view->render('information/jobposEdition');
    }
    public function timework()
    {
        $this->view->Listtimework = $this->model->Listtimework();
        $this->view->render('information/timework');
    }
    public function addEditTimework()
    {
        $this->model->addEditTimework();
    }
    public function twEdition($id)
    {
        $this->view->twtoEdit = $this->model->twtoEdit($id);
        $this->view->Listtimework = $this->model->Listtimework();
        $this->view->render('information/twEdition');
    }
    public function jobtype()
    {
        $this->view->Listjobtype = $this->model->Listjobtype();
        $this->view->render('information/jobtype');
    }
    public function addEditjb()
    {
        $this->model->addEditjb();
    }
    public function jobtypeEdition($id)
    {
        $this->view->jbtoEdit = $this->model->jbtoEdit(@$id);
        $this->view->Listjobtype = $this->model->Listjobtype();
        $this->view->render('information/jobtypeEdition');
    }
    public function dayofwork()
    {
        $this->view->ListDayofWork = $this->model->ListDayofWork();
        $this->view->render('information/dayofwork');
    }
    public function addEditdow()
    {
        $this->model->addEditdow();
    }
    public function dowEdition($id)
    {
        $this->view->dowtoEdit = $this->model->dowtoEdit($id);
        $this->view->ListDayofWork = $this->model->ListDayofWork();
        $this->view->render('information/dowEdition');
    }
    public function addstaff()
    {
        $this->view->idcodeSelect = $this->model->idcodeSelect();
        $this->view->daywork = $this->model->daywork();
        $this->view->staff_status = $this->model->staff_status();
        $this->view->pre_staff = $this->model->prefix_staffselected();
        $this->view->render('information/addstaff');
    }
    public function addEditstaff()
    {
        $this->model->addEditstaff();
        //var_dump($_POST);
    }
	public function stafflist()
	{
		
		$this->view->render('information/stafflist');
	}
	public function viewprofiles($id)
	{
		$this->view->SingleStaff = $this->model->SingleStaff($id);
		$this->view->render('information/viewprofiles');
	}
	public function myprofiles()
	{
		$this->view->render('information/myprofiles');
	}
}