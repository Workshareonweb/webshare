<?php

class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function run()
	{
		$sth = $this->db->prepare("SELECT * FROM tb_users WHERE ustatus = 1 AND
				s_email = :login AND su_pass = :password");
		$sth->execute(array(
			':login' => $_POST['username'],
			':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
			//':password' => $_POST['password']
		));
		
		$data = $sth->fetch();
		
		$count =  $sth->rowCount();
		if ($count > 0) {
			// login
			Session::init();
            Session::set('user_id', $data['user_id']);
			Session::set('s_roleid_insys', $data['s_roleid_insys']);
			Session::set('loggedIn', true);
			//Session::set('s_id', $data['s_id']);
			Session::set('s_nameEn', $data['s_nameEn']);
			Session::set('s_photo', $data['s_photo']);
            echo "admin";
		} else {
			//header('location: ../login');
			//header('location: ../login/error');
		}
		
	}
	
}