<?php
class Pagedefault_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function userlist()
	{
		return $this->db->select('SELECT name, username FROM user_table WHERE user_id = 1');	
	}
	
	public function menucontent()
	{
		$selectedMenu = $this->db->select('SELECT yt_m_id, yt_m_name, yt_m_menu_url
				FROM yt_main_menu WHERE yt_m_status = 1 AND yt_m_lg_id = 1 AND yt_m_id <> 11');
				foreach($selectedMenu as $key => $value){
				$selectedMenu[$key]['submenu'] = $this->db->select("SELECT yt_s_id, yt_s_name, yt_s_status, yt_s_menu_url
												FROM yt_sub_menu
												WHERE yt_s_status = 1 AND yt_s_lg_id = 1 AND yt_s_m_id =". $value['yt_m_id']);	
				}
		return $selectedMenu;
	}
	//page login
	public function run()
	{
		$sth = $this->db->prepare("SELECT yt_userid, yt_mroleid
				FROM yt_users WHERE 
				yt_email = :login AND yt_password = :password AND yt_user_status = 1");
		$sth->execute(array(
			':login' => $_POST['username'],
			':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
		));
		$data = $sth->fetch();
		
		$count =  $sth->rowCount();
		if ($count > 0) {
			// login
			Session::init();
			Session::set('yt_mroleid', $data['yt_mroleid']);
			Session::set('loggedIn', true);
			Session::set('yt_userid', $data['yt_userid']);
			
			if((Session::get('yt_mroleid'))== 1)
			{
				//header('location: ../administrators/');
                echo "Superadmin";
			}
			if((Session::get('yt_mroleid'))== 2)
			{
				//header('location: ../administrators/');
                echo "admin";
			}
			if((Session::get('yt_mroleid'))== 3)
			{
				//header('location: ../home/');
                echo "partner";
			}
			if((Session::get('yt_mroleid'))== 4)
			{
				//header('location: ../home/');
                echo "member";
			}
		} else {
			//header('location: ../pages/trylogin');
		}
	}
	public function userprofile()
	{
		return $this->db->select('');
	}
	public function visionfooter()
	{
		return $this->db->select("SELECT yt_sdescription 
					FROM yt_sub_content WHERE yt_sconid = 2");
	}
	public function adminafterlogin()
	{
		return $this->db->select('SELECT p.yt_pro_userid, p.yt_pro_fnameKh, p.yt_pro_lnameKh, p.yt_pro_fnameEng, p.yt_pro_lnameEng,
                     p.yt_pro_gender, p.yt_pro_contact, p.yt_pro_photo, u.yt_email
					 FROM yt_userprofile p, yt_users u
                     WHERE p.yt_pro_userid = '.@$_SESSION['yt_userid'].' AND p.yt_pro_userid = u.yt_userid');
	}
    public function userpartnerafterlogin()
	{
		return $partner = $this->db->select('SELECT p.yt_pid, p.yt_p_userid, p.yt_p_brandnameKh, p.yt_p_brandnameEng 
					FROM yt_partners p, yt_users u
                    WHERE p.yt_p_userid ='.@$_SESSION['yt_userid'].'AND p.yt_p_userid = u.yt_userid');
	}
	public function usermemberafterlogin()
	{
		return $this->db->select('SELECT m.yt_m_id, u.yt_email, m.yt_m_firstnamekh, m.yt_m_lastnamekh, m.yt_m_firstnameen, m.yt_m_lastnameen, m.yt_m_phone, m.yt_m_gender, m.yt_m_dob, m.yt_m_city_id, c.yt_city_name, m.yt_m_reg_date, m.photos, m.POB, m.Curr_occupation, m.From_company_inst, m.major, m.grade_year, m.school_univer, m.Curr_address, m.type_of_group, m.if_other
FROM yt_members m, yt_users u, yt_city c
WHERE m.yt_m_userid = u.yt_userid AND m.yt_m_city_id = c.yt_city_id AND m.yt_m_userid ='.@$_SESSION['yt_userid']);
					//array('yt_m_userid' => Session::get('yt_userid')));//$_SESSION['yt_userid']));
	}
	public function membersview()
	{
		return $this->db->select('SELECT m.yt_m_id, m.yt_m_userid, u.yt_email, m.yt_m_firstnamekh, m.yt_m_lastnamekh, m.yt_m_firstnameen, m.yt_m_lastnameen, m.yt_m_phone, m.yt_m_gender, m.yt_m_dob, m.yt_m_city_id, c.yt_city_name, m.yt_m_reg_date, m.photos, m.POB, m.Curr_occupation, m.From_company_inst, m.major, m.grade_year, m.school_univer, m.Curr_address, m.type_of_group, m.if_other
FROM yt_members m, yt_users u, yt_city c
WHERE m.yt_m_userid = u.yt_userid AND m.yt_m_city_id = c.yt_city_id AND m.yt_m_userid ='.@$_SESSION['yt_userid']);
					//array('yt_m_userid' => Session::get('yt_userid')));//$_SESSION['yt_userid']));
	}
	public function editprofilesave($data)
	{
		$file_byfiles = $data['photos'];
			if(!empty($file_byfiles['tmp_name'])){
				$name = $file_byfiles['name'];
				$tmpnm = $file_byfiles['tmp_name'];
				$dir = $dir = 'public/members/'.$name;
				$move = move_uploaded_file($tmpnm, $dir);

				$postData1 = array(
                    'yt_email' => strtolower($data['memail'])
                );
                $this->db->update('yt_users', $postData1, 
				"`yt_userid` = '{$data['yt_userid']}'");
				
                if(empty($data['if_other'])){
					$postData = array(
	
						'yt_m_firstnamekh' => $data['firstnamekh'],			
						'yt_m_lastnamekh' => $data['lastnamekh'],
						'yt_m_firstnameen' => $data['firstnameen'],			
						'yt_m_lastnameen' => $data['lastnameen'],
						'yt_m_phone' => $data['phonecontact'],
						'yt_m_gender' => $data['mgender'],
						'yt_m_city_id' => $data['city'],
						'yt_m_dob' => date("Y-m-d",strtotime($data['dob'])),
		
						'POB' => $data['POB'],
						'From_company_inst' => $data['From_company_inst'],
						'Curr_occupation' => $data['Curr_occupation'],
						'major' => $data['major'],
						'grade_year' => $data['grade_year'],
						'school_univer' => $data['school_univer'],
						'Curr_address' => $data['Curr_address'],
						'type_of_group' => $data['type_of_group'],
						//'if_other' => $data['if_other'],
						'photos' => $name
						 );
				$this->db->update('yt_members', $postData, 
					"`yt_m_userid` = '{$data['yt_userid']}'");
				}else{
					$postData = array(
	
						'yt_m_firstnamekh' => $data['firstnamekh'],			
						'yt_m_lastnamekh' => $data['lastnamekh'],
						'yt_m_firstnameen' => $data['firstnameen'],			
						'yt_m_lastnameen' => $data['lastnameen'],
						'yt_m_phone' => $data['phonecontact'],
						'yt_m_gender' => $data['mgender'],
						'yt_m_city_id' => $data['city'],
						'yt_m_dob' => date("Y-m-d",strtotime($data['dob'])),
		
						'POB' => $data['POB'],
						'From_company_inst' => $data['From_company_inst'],
						'Curr_occupation' => $data['Curr_occupation'],
						'major' => $data['major'],
						'grade_year' => $data['grade_year'],
						'school_univer' => $data['school_univer'],
						'Curr_address' => $data['Curr_address'],
						'type_of_group' => $data['type_of_group'],
						'if_other' => $data['if_other'],
						'photos' => $name
						 );
				$this->db->update('yt_members', $postData, 
					"`yt_m_userid` = '{$data['yt_userid']}'");
				}
            
		}else{
			
			$postData1 = array(
                    'yt_email' => strtolower($data['memail'])
                );
                $this->db->update('yt_users', $postData1, 
				"`yt_userid` = '{$data['yt_userid']}'");
				
            if(empty($data['if_other'])){
					$postData = array(
	
						'yt_m_firstnamekh' => $data['firstnamekh'],			
						'yt_m_lastnamekh' => $data['lastnamekh'],
						'yt_m_firstnameen' => $data['firstnameen'],			
						'yt_m_lastnameen' => $data['lastnameen'],
						'yt_m_phone' => $data['phonecontact'],
						'yt_m_gender' => $data['mgender'],
						'yt_m_city_id' => $data['city'],
						'yt_m_dob' => date("Y-m-d",strtotime($data['dob'])),
		
						'POB' => $data['POB'],
						'From_company_inst' => $data['From_company_inst'],
						'Curr_occupation' => $data['Curr_occupation'],
						'major' => $data['major'],
						'grade_year' => $data['grade_year'],
						'school_univer' => $data['school_univer'],
						'Curr_address' => $data['Curr_address'],
						'type_of_group' => $data['type_of_group']
						 );
				$this->db->update('yt_members', $postData, 
					"`yt_m_userid` = '{$data['yt_userid']}'");
				}else{
					$postData = array(
	
						'yt_m_firstnamekh' => $data['firstnamekh'],			
						'yt_m_lastnamekh' => $data['lastnamekh'],
						'yt_m_firstnameen' => $data['firstnameen'],			
						'yt_m_lastnameen' => $data['lastnameen'],
						'yt_m_phone' => $data['phonecontact'],
						'yt_m_gender' => $data['mgender'],
						'yt_m_city_id' => $data['city'],
						'yt_m_dob' => date("Y-m-d",strtotime($data['dob'])),
		
						'POB' => $data['POB'],
						'From_company_inst' => $data['From_company_inst'],
						'Curr_occupation' => $data['Curr_occupation'],
						'major' => $data['major'],
						'grade_year' => $data['grade_year'],
						'school_univer' => $data['school_univer'],
						'Curr_address' => $data['Curr_address'],
						'type_of_group' => $data['type_of_group'],
						'if_other' => $data['if_other']
						 );
				$this->db->update('yt_members', $postData, 
					"`yt_m_userid` = '{$data['yt_userid']}'");
				}
        }
	}
    public function mchangepwdSave($data)
    {
        $postData = array(
	           'yt_password' => Hash::create('sha256', $data['mpassword'], HASH_PASSWORD_KEY)
						 );
				$this->db->update('yt_users', $postData, 
					"`yt_userid` = '{$data['yt_userid']}'");
    }
	public function partnersAnimatelist()
	{
		return $this->db->select('SELECT p.yt_pid, p.yt_p_userid, p.yt_p_location, p.yt_p_contactphone, p.yt_p_brandnameKh, p.yt_p_brandnameEng, p.yt_p_website, 
								p.yt_p_photo_url, p.yt_p_city_id, c.yt_city_name, tp.yt_type_pname, u.yt_user_status
								FROM yt_partners p, yt_city c, yt_typeofpartners tp, yt_users u
                                WHERE p.yt_p_city_id = c.yt_city_id AND p.yt_p_typeof = tp.yt_type_pid AND p.yt_p_userid = u.yt_userid');
	}
	public function FooterMenuList()
	{
		return $this->db->select('SELECT yt_m_id, yt_m_name, yt_m_menu_url
				FROM yt_main_menu WHERE yt_m_status = 1 AND yt_m_lg_id = 1 AND yt_m_id <> 11');
	}
	public function FooterSubmenuList()
	{
		return $this->db->select('SELECT yt_s_id, yt_s_name, yt_s_status, yt_s_menu_url
									FROM yt_sub_menu
									WHERE yt_s_status = 1 AND yt_s_lg_id = 1');
	}
	//pages user view
	public function menuview($yt_m_menu_url)
	{
		return $this->db->select('SELECT yt_m_id, yt_m_name FROM yt_main_menu 
				WHERE yt_m_menu_url = :yt_m_menu_url AND yt_m_id <> 11',
				array('yt_m_menu_url' => $yt_m_menu_url));
	}
	public function contentimageview($yt_m_menu_url)
	{
		return $this->db->select('SELECT c.yt_imgid, c.yt_c_menuid, c.yt_img_url, m.yt_m_menu_url 
					FROM yt_c_image c, yt_main_menu m
					WHERE c.yt_c_menuid = m.yt_m_id AND m.yt_m_menu_url = :yt_m_menu_url ORDER BY c.yt_imgid DESC LIMIT 1',
					array('yt_m_menu_url' => $yt_m_menu_url));
	}
	public function contentview($yt_m_menu_url)
	{
		return $this->db->select('SELECT c.yt_conid, c.yt_c_menuid, m.yt_m_name, c.yt_c_title, c.yt_c_description, c.yt_photo, c.yt_dateadded, up.yt_pro_lnameEng, up.yt_pro_fnameEng
				FROM yt_content c, yt_main_menu m, yt_userprofile up
				WHERE c.yt_c_menuid = m.yt_m_id AND c.yt_c_userid = up.yt_pro_userid AND m.yt_m_menu_url = :yt_m_menu_url',
				array('yt_m_menu_url' => $yt_m_menu_url));
	}
    public function submenuview($yt_s_menu_url)
    {
        return $this->db->select('SELECT yt_s_id, yt_s_name, yt_s_menu_url 
                FROM yt_sub_menu WHERE yt_s_menu_url = :yt_s_menu_url',
                array('yt_s_menu_url' => $yt_s_menu_url));
    }
    public function subcontentimagesview($yt_s_menu_url)
    {
        return $this->db->select('SELECT si.yt_simg_id, si.yt_simg_url 
                FROM yt_s_image si, yt_sub_menu sm 
                WHERE si.yt_sm_id = sm.yt_s_id AND sm.yt_s_menu_url = :yt_s_menu_url',
                array('yt_s_menu_url' => $yt_s_menu_url));
    }
    public function subcontentview($yt_s_menu_url)
    {
        return $this->db->select('SELECT ysc.yt_smenuid, ysc.yt_sdescription, ysc.yt_s_photo, ysc.yt_sdateadded, ysc.yt_sc_title, up.yt_pro_fnameEng, up.yt_pro_lnameEng
                FROM yt_sub_content ysc, yt_sub_menu sm, yt_userprofile up
                WHERE ysc.yt_smenuid = sm.yt_s_id AND ysc.yt_s_userid = up.yt_pro_userid AND sm.yt_s_menu_url = :yt_s_menu_url',
                array('yt_s_menu_url' => $yt_s_menu_url));
    }
	//announcement event job
	public function homeAnnounce()
	{
		return $this->db->select("SELECT id, title, description, date_added, ann_event_date FROM yt_ann_event
								WHERE ann_or_event = 'announce' AND lg_id = 1 AND active = 1 ORDER BY id DESC LIMIT 3");
	}
	public function announcelist()
	{
		return $this->db->select('SELECT ae.id, ae.title, ae.description, ae.date_added, ae.ann_event_date, ae.file_media, ae.ann_or_event, ae.active
					FROM yt_ann_event ae, yt_lang l
					WHERE ae.lg_id = l.yt_lg_id AND ann_or_event = "announce"
					ORDER BY ae.id DESC, ae.ann_or_event ASC');
	}
	public function eventlist()
	{
		return $this->db->select('SELECT ae.id, ae.title, ae.description, ae.date_added, ae.ann_event_date, ae.file_media, ae.ann_or_event, ae.active
					FROM yt_ann_event ae, yt_lang l
					WHERE ae.lg_id = l.yt_lg_id AND ann_or_event = "event"
					ORDER BY ae.id DESC, ae.ann_or_event ASC');
	}
	public function homeEvent()
	{
		return $this->db->select("SELECT id, title, description, date_added, ann_event_date FROM yt_ann_event
								WHERE ann_or_event = 'event' AND lg_id = 1 AND active = 1 ORDER BY id DESC LIMIT 3 ");
	}
	public function homeJob()
	{
		return $this->db->select('SELECT j.yt_j_id, j.yt_j_postdate, j.yt_j_deadline, j.yt_j_userid, j.yt_j_location, j.yt_j_function, j.yt_j_description, j.active, c.yt_city_name
                FROM yt_jobseeker j, yt_city c WHERE j.yt_j_location = c.yt_city_id ORDER BY yt_j_id DESC LIMIT 3');
	}
    public function eventsingle($id)
    {
        return $this->db->select("SELECT id, title, description, date_added, ann_event_date FROM yt_ann_event
								WHERE ann_or_event = 'event' AND lg_id = 1 AND active = 1 AND id=:id",
                array('id' => $id));
    }
    public function announcesingle($id)
    {
        return $this->db->select("SELECT id, title, description, date_added, ann_event_date FROM yt_ann_event
								WHERE ann_or_event = 'announce' AND lg_id = 1 AND active = 1 AND id=:id",
                array('id' => $id));
    }
    public function jobseekerlist()
	{
		return $this->db->select('SELECT j.yt_j_id, j.yt_j_postdate, j.yt_j_deadline, j.yt_j_userid, j.yt_j_location, j.yt_j_function, j.yt_j_description, j.active, c.yt_city_name
                FROM yt_jobseeker j, yt_city c WHERE j.yt_j_location = c.yt_city_id ORDER BY yt_j_id DESC');
	}
    public function jobseekersingle($yt_j_id)
    {
        return $this->db->select("SELECT j.yt_j_id, j.yt_j_postdate, j.yt_j_deadline, j.yt_j_userid, j.yt_j_location, j.yt_j_function, j.yt_j_description, j.active, c.yt_city_name
                FROM yt_jobseeker j, yt_city c WHERE j.yt_j_location = c.yt_city_id AND yt_j_id=:yt_j_id",
                array('yt_j_id' => $yt_j_id));
    }
}
?>