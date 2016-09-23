<?php
class Information_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function userlist()
	{
		return $this->db->select('SELECT name, username FROM user_table WHERE user_id = 1');
	}
    public function depttoedit($deptid)
    {
        return $this->db->select('SELECT * FROM tb_dept WHERE deptid = :deptid',
                    array('deptid' => $deptid));
    }
	public function addDept()
	{
		$result = false;
        $message = "error";
        $deptid = '';
        @$deptid = $_POST['deptid'];
        try{
            if($deptid > 0){
                   $postData = array(
                            'deptname' => $_POST['deptname'],
                            'deptdescription' => $_POST['dept_description']); 
                    $this->db->update('tb_dept', $postData, 
                        "`deptid` = '{$deptid}'");
                        $result = true;
                        $message = "&nbsp;  ព័ត៌មានកែប្រែបានជោគជ័យ!";
            }else{
               $sth = $this->db->prepare("SELECT deptname
                    FROM tb_dept WHERE d_status = 1 AND
                    deptname = :deptname ");
                $sth->execute(array(
                    ':deptname' => $_POST['deptname']
                ));
                $check = $sth->fetch();

                $count =  $sth->rowCount();
                if ($count > 0){
                    $message = "&nbsp; ដេប៉ាតេម៉ង់ នេះមានរួចហើយ!!!";
                }else{
                    $data = array(
                        'deptname' => $_POST['deptname'],
                        'deptdescription' => $_POST['dept_description']);

                    $this->db->insert('tb_dept', array(
                        'deptname' => $data['deptname'],
                        'deptdescription' => $data['deptdescription']
						
                    ));
                    $result = true;
                    $message = "&nbsp;  ព័ត៌មានបានរក្សាទុកជោគជ័យ!";
                } 
            }
        }catch (PDOException $e){echo "Error: " . $e->getMessage();}
        echo json_encode(array('result'=>$result,'message'=>$message));
	}
	
	public function ListDepartment()
	{
		return $this->db->select("SELECT * FROM tb_dept WHERE d_status = 1 ORDER BY deptid DESC");
	}
    
    public function addEditPosition()
	{
		$result = false;
        $message = "error";
        $posid = '';
        @$posid = $_POST['posid'];
        try{
            if($posid > 0){
                   $postData = array(
                            'pos_name' => $_POST['posname'],
                            'pos_des' => $_POST['pos_description']); 
                    $this->db->update('tb_position', $postData, 
                        "`pos_id` = '{$posid}'");
                        $result = true;
                        $message = "&nbsp;  ព័ត៌មានកែប្រែបានជោគជ័យ!";
            }else{
               $sth = $this->db->prepare("SELECT pos_name
                    FROM tb_position WHERE p_status = 1 AND
                    pos_name = :posname ");
                $sth->execute(array(
                    ':posname' => $_POST['posname']
                ));
                $check = $sth->fetch();

                $count =  $sth->rowCount();
                if ($count > 0){
                    $message = "&nbsp; មុខតំណែងមួយ នេះមានរួចហើយ!!!";
                }else{
                    $data = array(
                        'pos_name' => $_POST['posname'],
                        'pos_des' => $_POST['pos_description']);

                    $this->db->insert('tb_position', array(
                        'pos_name' => $data['pos_name'],
                        'pos_des' => $data['pos_des']
                    ));
                    $result = true;
                    $message = "&nbsp;  ព័ត៌មានបានរក្សាទុកជោគជ័យ!";
                } 
            }
        }catch (PDOException $e){echo "Error: " . $e->getMessage();}
        echo json_encode(array('result'=>$result,'message'=>$message));
	}
    public function ListPosition()
    {
        return $this->db->select('SELECT * FROM tb_position WHERE p_status = 1 ORDER BY pos_id DESC');
    }
    public function jobpostoedit($pos_id)
    {
        return $this->db->select('SELECT * FROM tb_position WHERE pos_id = :pos_id',
                    array('pos_id' => @$pos_id));
    }
    
    public function Listtimework()
    {
        return $this->db->select('SELECT * FROM tb_timework WHERE tw_status = 1 ORDER BY tw_id DESC');
    }
    public function twtoEdit($tw_id)
    {
        return $this->db->select('SELECT * FROM tb_timework WHERE tw_id = :tw_id',
                    array('tw_id' => @$tw_id));
    }
    public function addEditTimework()
	{
		$result = false;
        $message = "error";
        $tw_id = '';
        @$tw_id = $_POST['twid'];
        try{
            if($tw_id > 0){
                   $postData = array(
                            'tw_time' => $_POST['txttw'],
                            'tw_des' => $_POST['tw_description']); 
                    $this->db->update('tb_timework', $postData, 
                        "`tw_id` = '{$tw_id}'");
                        $result = true;
                        $message = "&nbsp;  ព័ត៌មានកែប្រែបានជោគជ័យ!";
            }else{
               $sth = $this->db->prepare("SELECT tw_time
                    FROM tb_timework WHERE tw_status = 1 AND
                    tw_time = :tw_time ");
                $sth->execute(array(
                    ':tw_time' => $_POST['txttw']
                ));
                $check = $sth->fetch();

                $count =  $sth->rowCount();
                if ($count > 0){
                    $message = "&nbsp; ម៉ោងការងារ នេះមានរួចហើយ!!!";
                }else{
                    $data = array(
                        'tw_time' => $_POST['txttw'],
                        'tw_des' => $_POST['tw_description']);

                    $this->db->insert('tb_timework', array(
                        'tw_time' => $data['tw_time'],
                        'tw_des' => $data['tw_des']
                    ));
                    $result = true;
                    $message = "&nbsp;  ព័ត៌មានបានរក្សាទុកជោគជ័យ!";
                } 
            }
        }catch (PDOException $e){echo "Error: " . $e->getMessage();}
        echo json_encode(array('result'=>$result,'message'=>$message));
	}
    public function Listjobtype()
    {
        return $this->db->select('SELECT * FROM tb_jobtype WHERE jt_status = 1 ORDER BY job_id DESC');
    }
    public function addEditjb()
	{
		$result = false;
        $message = "error";
        $job_id = '';
        @$job_id = $_POST['jobid'];
        try{
            if($job_id > 0){
                   $postData = array(
                            'job_name' => $_POST['jobname'],
                            'job_des' => $_POST['job_description']); 
                    $this->db->update('tb_jobtype', $postData, 
                        "`job_id` = '{$job_id}'");
                        $result = true;
                        $message = "&nbsp;  ព័ត៌មានកែប្រែបានជោគជ័យ!";
            }else{
               $sth = $this->db->prepare("SELECT job_name
                    FROM tb_jobtype WHERE jt_status = 1 AND
                    job_name = :jobname ");
                $sth->execute(array(
                    ':jobname' => $_POST['jobname']
                ));
                $check = $sth->fetch();

                $count =  $sth->rowCount();
                if ($count > 0){
                    $message = "&nbsp; ប្រភេទការងារ នេះមានរួចហើយ!!!";
                }else{
                    $data = array(
                        'job_name' => $_POST['jobname'],
                        'job_des' => $_POST['job_description']);

                    $this->db->insert('tb_jobtype', array(
                        'job_name' => $data['job_name'],
                        'job_des' => $data['job_des']
                    ));
                    $result = true;
                    $message = "&nbsp;  ព័ត៌មានបានរក្សាទុកជោគជ័យ!";
                } 
            }
        }catch (PDOException $e){echo "Error: " . $e->getMessage();}
        echo json_encode(array('result'=>$result,'message'=>$message));
	}
    public function jbtoEdit($job_id)
    {
        return $this->db->select('SELECT * FROM tb_jobtype WHERE job_id = :job_id',
                    array('job_id' => @$job_id));
    }
    public function ListDayofWork()
    {
        return $this->db->select('SELECT * FROM tb_dayofwork WHERE dw_status = 1 ORDER BY dowid DESC');
    }
    public function addEditdow()
	{
		$result = false;
        $message = "error";
        $dow_id = '';
        @$dow_id = $_POST['dowid'];
        try{
            if($dow_id > 0){
                   $postData = array(
                            'dow_name' => $_POST['txtdow'],
                            'dow_des' => $_POST['dow_description']); 
                    $this->db->update('tb_dayofwork', $postData, 
                        "`dowid` = '{$dow_id}'");
                        $result = true;
                        $message = "&nbsp;  ព័ត៌មានកែប្រែបានជោគជ័យ!";
            }else{
               $sth = $this->db->prepare("SELECT dow_name
                    FROM tb_dayofwork WHERE dw_status = 1 AND
                    dow_name = :downame ");
                $sth->execute(array(
                    ':downame' => $_POST['txtdow']
                ));
                $check = $sth->fetch();

                $count =  $sth->rowCount();
                if ($count > 0){
                    $message = "&nbsp; ថ្ងៃបំពេញការងារ នេះមានរួចហើយ!!!";
                }else{
                    $data = array(
                        'dow_name' => $_POST['txtdow'],
                        'dow_des' => $_POST['dow_description']);

                    $this->db->insert('tb_dayofwork', array(
                        'dow_name' => $data['dow_name'],
                        'dow_des' => $data['dow_des']
                    ));
                    $result = true;
                    $message = "&nbsp;  ព័ត៌មានបានរក្សាទុកជោគជ័យ!";
                } 
            }
        }catch (PDOException $e){echo "Error: " . $e->getMessage();}
        echo json_encode(array('result'=>$result,'message'=>$message));
	}
    public function dowtoEdit($dowid)
    {
        return $this->db->select('SELECT * FROM tb_dayofwork WHERE dowid = :dowid',
                    array('dowid' => @$dowid));
    }
    public function staff_status()
    {
        return $this->db->select('SELECT * FROM tb_staff_status WHERE st_status = 1');
    }
    public function prefix_staffselected()
    {
        return $this->db->select('SELECT * FROM tb_prefix WHERE pre_type = "staff" AND pre_status = 1');
    }
    public function prefix_teacherselected()
    {
        return $this->db->select('SELECT * FROM tb_prefix WHERE pre_type = "teacher" AND pre_status = 1');
    }
    public function daywork()
    {
        return $this->db->select('SELECT * FROM tb_dayofwork WHERE dw_status = 1');
    }
    public function idcodeSelect()
    {
        return $this->db->select('SELECT MAX(s_codeid) as codeid FROM tb_staff');
    }
    public function addEditstaff()
    {
        $result = false;
        $message = "error";
        
        $idcode = 0;
        @$idcode = $_POST['idcode'];
        
        @$dobdd = $_POST['dddob'];
        @$dobmm = $_POST['mmdob'];
        @$dobyy = $_POST['yyyydob'];
        @$dob = $dobyy."-".$dobmm."-".$dobdd;
        
        @$workdd = $_POST['ddwork'];
        @$workmm = $_POST['mmwork'];
        @$workyy = $_POST['yyyywork'];
        @$datework = $workyy."-".$workmm."-".$workdd;
        
        $code_url = $_POST['idprefix']."".$_POST['idnum'];
		
		$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
		$path = 'public/staffphotos/'; // upload image to directory
		
		try{
			$data = array(
					's_photo' => $_FILES['s_photo'],
				   
					's_code_prefix' => $_POST['idprefix'],
					's_codeid' => $_POST['idnum'],
					's_namekh' => $_POST['txtnamekh'],
					's_nameEn' => $_POST['txtnameen'],
					's_gender' => $_POST['gender'],
					's_dob' => $dob,
					's_study_level' => $_POST['gradestudy'],
					'skillnoted' => $_POST['qual_description'],
					's_phone' => $_POST['txtphone'],
					's_phone_home' => $_POST['homephone'],
					's_start_work' => $datework,
					's_address' => $_POST['st_address'],
					's_status' => $_POST['staff_status'],
					's_addedby' => $_POST['txtaddedby'],
					's_dayofworkid' => $_POST['txtdow'],
					's_work_as' => $_POST['workas'],
					's_email' => strtolower($_POST['email'])
				);
			if($idcode > 0)
			{
				$result = true;
				$message = "Data ok";
			}else {
				$sth = $this->db->prepare("SELECT s_codeid
                    FROM tb_staff WHERE 
                    s_codeid = :idnum ");
                $sth->execute(array(
                    ':idnum' => $_POST['idnum']
                ));
                $check = $sth->fetch();

                $count =  $sth->rowCount();
                $id = $_POST['idprefix']."-".$_POST['idnum'];
                if ($count > 0){
                    $message = "&nbsp; អត្តលេខ $id នេះមានរួចហើយ!!!";
                }else{
					$sthm = $this->db->prepare("SELECT s_email
						FROM tb_users WHERE 
						s_email = :s_email ");
					$sthm->execute(array(
						':s_email' => $_POST['email']
					));
					$check = $sthm->fetch();
	
					$count1 =  $sthm->rowCount();
					$email = $_POST['email'];
					if($count1 > 0){
						$message = "&nbsp; E-mail: $email នេះមានរួចហើយ!!!";
					}else{
						$data = array(
							's_photo' => $_FILES['s_photo'],
						   
							's_code_prefix' => $_POST['idprefix'],
							's_codeid' => $_POST['idnum'],
							's_namekh' => $_POST['txtnamekh'],
							's_nameEn' => $_POST['txtnameen'],
							's_gender' => $_POST['gender'],
							's_dob' => date("Y-m-d", strtotime($dob)),
							's_study_level' => $_POST['gradestudy'],
							'skillnoted' => $_POST['qual_description'],
							's_phone' => $_POST['txtphone'],
							's_phone_home' => $_POST['homephone'],
							's_start_work' => date("Y-m-d", strtotime($datework)),
							's_address' => $_POST['st_address'],
							's_status' => $_POST['staff_status'],
							's_addedby' => $_POST['txtaddedby'],
							's_dayofworkid' => $_POST['txtdow'],
							's_work_as' => $_POST['workas'],
							's_email' => strtolower($_POST['email'])
						);
						
						$img = $data['s_photo'];
				
						$photo = $img['name'];
						$tmp = $img['tmp_name'];
						if(!empty($img['tmp_name'])){
							
							// get uploaded file's extension
							$ext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
							// can upload same image using rand function
							$final_image = rand(1000,1000000).$photo;
							// check's valid format
							if(in_array($ext, $valid_extensions)) 
							{					
								$path = $path.strtolower($final_image);	
									
								if(move_uploaded_file($tmp,$path)) 
								{
									$last_id = $this->db->insert('tb_users', array(
										's_nameEn' => $data['s_nameEn'],
										's_namekh' => $data['s_namekh'],
										's_email' => strtolower($data['s_email']),
										'created_by' => $data['s_addedby'],
										'date_created' => date('Y-m-d'), // use GMT aka UTC 0:00  H:i:s
										's_photo' => $final_image
										//'su_pass' => Hash::create('sha256', $data['mpassword'], HASH_PASSWORD_KEY),
										));
									$this->db->insert('tb_staff', array(
										's_userid' => $last_id,
										's_codeurl' => Hash::create('sha256', $data['s_codeid'], HASH_PASSWORD_KEY),
										's_code_prefix' => $data['s_code_prefix'],
										's_codeid' => $data['s_codeid'],
										's_namekh' => $data['s_namekh'],
										's_nameEn' => $data['s_nameEn'],
										's_gender' => $data['s_gender'],
										's_dob' => date("Y-m-d", strtotime($data['s_dob'])),
										's_study_level' => $data['s_study_level'],
										'skillnoted' => $data['skillnoted'],
										's_phone' => $data['s_phone'],
										's_phone_home' => $data['s_phone_home'],
										's_start_work' => date("Y-m-d", strtotime($data['s_start_work'])),
										's_address' => $data['s_address'],
										's_status' => $data['s_status'],
										's_added_by' => $data['s_addedby'],
										's_dayofworkid' => $data['s_dayofworkid'],
										's_work_as' => $data['s_work_as'],
										's_dateadded' => date('Y-m-d'), // use GMT aka UTC 0:00  H:i:s
										's_photo' => $final_image
						
										
										));
									$result = true;
									$message = "&nbsp;  ព័ត៌មានបានរក្សាទុកជោគជ័យ!";
								}									
							} else {
								$message = "សូម Upload រូបថត!";
							}
							
						}else{
							$last_id = $this->db->insert('tb_users', array(
								's_nameEn' => $data['s_nameEn'],
								's_namekh' => $data['s_namekh'],
								's_email' => strtolower($data['s_email']),
								'created_by' => $data['s_addedby'],
								'date_created' => date('Y-m-d') // use GMT aka UTC 0:00  H:i:s
								//'su_pass' => Hash::create('sha256', $data['mpassword'], HASH_PASSWORD_KEY),
								));
							$this->db->insert('tb_staff', array(
								's_userid' => $last_id,
								's_codeurl' => Hash::create('sha256', $data['s_codeid'], HASH_PASSWORD_KEY),
								's_code_prefix' => $data['s_code_prefix'],
								's_codeid' => $data['s_codeid'],
								's_namekh' => $data['s_namekh'],
								's_nameEn' => $data['s_nameEn'],
								's_gender' => $data['s_gender'],
								's_dob' => date("Y-m-d", strtotime($data['s_dob'])),
								's_study_level' => $data['s_study_level'],
								'skillnoted' => $data['skillnoted'],
								's_phone' => $data['s_phone'],
								's_phone_home' => $data['s_phone_home'],
								's_start_work' => date("Y-m-d", strtotime($data['s_start_work'])),
								's_address' => $data['s_address'],
								's_status' => $data['s_status'],
								's_added_by' => $data['s_addedby'],
								's_dayofworkid' => $data['s_dayofworkid'],
								's_work_as' => $data['s_work_as'],
								's_dateadded' => date('Y-m-d'), // use GMT aka UTC 0:00  H:i:s					
								
								));
							$result = true;
							$message = "&nbsp;  ព័ត៌មានបានរក្សាទុកជោគជ័យ!";
						}
					}	
				}
			}
            
        }catch(PDOException $e){
			$message = "Error: " . $e->getMessage();
		}
        echo json_encode(array('result'=>$result,'message'=>$message));
    }
	public function stafflist()
	{
		return $this->db->select("SELECT u.user_id, u.s_email, s.s_namekh, s.s_nameEn, s.s_code_prefix, s.s_codeid, s.s_codeurl, s.s_phone, s.s_gender, s.s_dob, s.s_photo, s.s_status, ss.st_title
						FROM tb_users u
						LEFT JOIN tb_staff s
						ON u.user_id = s.s_userid
						LEFT JOIN tb_staff_status ss
						ON s.s_status = ss.st_id
						WHERE u.ustatus != 1 ORDER BY u.user_id ASC");
	}    
    public function SingleStaff($codeurl)
	{
		return $this->db->select("SELECT u.user_id, u.s_email, s.s_namekh, s.s_nameEn, s.s_code_prefix, s.s_codeid, s.s_codeurl, s.s_phone, s.s_gender, s.s_dob, s.s_photo, s.s_status, ss.st_title
						FROM tb_users u
						LEFT JOIN tb_staff s
						ON u.user_id = s.s_userid
						LEFT JOIN tb_staff_status ss
						ON s.s_status = ss.st_id
						WHERE s.s_codeurl = :codeurl",
						array('codeurl' => @$codeurl));
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
}
?>