<?php

class Pagemanager_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function selectUserlogin()
	{
		return $this->db->select('SELECT * FROM user_table WHERE user_id = '.@$_SESSION['user_id']);
	}
}