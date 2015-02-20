<?php
class Generators
{
	private $dbh;
	private $redirect;
	private static $instance=NULL;
	function __construct()
	{
		$dbObject = DatabaseConnection::getInstance();
		$this->_dbh = $dbObject->getConnection();
		$this->_redirect = URLRedirect::getInstance();
		$this->_session = Session::getInstance();
	}
	//get object of current class...
	public static function getInstance()
	{ 
	    if( self::$instance === NULL )
	    { 
		   self::$instance = new self();
	    }
	    return self::$instance;
	}
	
	//show genrator list
	public function show_genrator($id){
		try{
			$order=$this->_session->__get("order");
			if($order==Null)
			{
				$sql = "select * from users where roll='2' and add_by='$id'";
				$res=$this->_dbh->query($sql);
				$value= $res->fetchall();
				return($value);	
			}
			elseif($order=='desc')
			{	$sql="SELECT * FROM `users` where roll='2' and add_by='$id' ORDER BY `account_no` DESC" ;	
				$res=$this->_dbh->query($sql);
				$value= $res->fetchall();
				return($value);
				
			}elseif($order=='asc')
			{
				$sql="SELECT * FROM `users` where roll='2' and add_by='$id' ORDER BY `account_no` ASC" ;
				$res=$this->_dbh->query($sql);
				$value= $res->fetchall();
				return($value);
			}
			
			
		
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
	}
	//show genrator suspend acount list
	public function show_suspend_genrator(){
		try{
			
			$sql = "select * from users where roll='2'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetchall();
			return($value);
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
	}
	//add more address functionality
	public function add_more_address($address,$id){
		try{
			$count = $this->_dbh->exec("insert into address (address,user_id)values('$address','$id')");
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
		
	}
	
	// add genrator 	
	public function add_genrator($array){
		try{
			$email=$array['email'];
			$session= Session::getInstance();
			$session_id=$session->__get("user_id");
			//checking email in admin table already exist or not
			$sql="select * from admin where email = '$email'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();
			if($value['email']==$array['email'])
			{
			      return "email";
			}
			
			//checking email in user table already exist or not
			$sql = "select * from users where email = '$email' ";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();
			if($value['email']==$array['email'])
			{
			      return "email";
			}
			
			//if no email matches the current email then registered
			else
			{
				$sql = "select * from users where roll='2'";
				$res=$this->_dbh->query($sql);
				$value= $res->fetchall();
				if($value==Null)
				{
				$count = $this->_dbh->exec("INSERT INTO users(register_date,companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,account_no,add_by) VALUES ('".date('M-d-Y')."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','2','".$array['date']."','".'1'."','".'10000001'."','$session_id')"); 
				$id=$this->_dbh->lastInsertId();
				return $id;
				}
				else{
					$sql="SELECT MAX(account_no) as account from users where roll='2'";
					$res=$this->_dbh->query($sql);
					$value= $res->fetch();
					$value=$value['account']+1;
					$count = $this->_dbh->exec("INSERT INTO users(register_date,companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,account_no,add_by) VALUES ('".date('M-d-Y')."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','2','".$array['date']."','".'1'."','".$value."','$session_id')"); 
					$id=$this->_dbh->lastInsertId();
					return $id;
				}
				
					
			}
			
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
		
	}
	//show  rejoin record functionality by admin
	public function rejoin($id)
	{
		try{
			$sql = "select * from suspendtb where suspend_id='$id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			return($value);
		}catch( PDOException $e)
		{
			echo $e->getInstance();
		}
		
		
	}
	//permanent remove  argument..
	public function remove_account($id)
	{
	    try{
		$sql = "delete from users where id='".$id."'";
		$result=$this->_dbh->query($sql);
		$sql = "delete from suspendtb where suspend_id='".$id."'";
		$result=$this->_dbh->query($sql);
		
		return true;
		}
		catch(PDOException $e)
		{
		    echo $e->getMessage();
		}
	}
	//suspend  argument..
	public function suspend_id($id)
	{
		
	    try{
		if($id)
		{
			$session= Session::getInstance();
			$username=$session->__get("firstname");
			$sql = "select * from users where id='$id'";
			$res=$this->_dbh->query($sql);
			$array= $res->fetch(PDO::FETCH_ASSOC);
			$this->_dbh->exec("INSERT INTO suspendtb(suspend_id,suspend_by,firstname,lastname,email,suspend_date) VALUES ('".$id."','".$username."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".date('d-M-Y')."')");
		}
		$sql="UPDATE users SET account='"."0"."' WHERE id='".$id."'";
		$result=$this->_dbh->query($sql);
	    return true;
	    }
	    catch(PDOException $e)
	    {
		echo $e->getMessage();
	    }
	}
	//join or rejoin  argument..
	public function join($id)
	{
	    try{
			
			$user_id=$this->_session->__get("user_id");
			//die("aa");
			$sql = "delete from suspendtb where suspend_id='".$id."'";
			$result=$this->_dbh->query($sql);
			$sql="UPDATE users SET account='"."1"."' ,add_by='".$user_id."'  WHERE id='".$id."'";
			$result=$this->_dbh->query($sql);
			return true;
	    }
	    catch(PDOException $e)
	    {
		echo $e->getMessage();
	    }
	}
	
	
	//show genrator on the basis of where clause
	public function show_genrator_where($where,$arg){
		try{
			$sql = "select * from users where roll='2' and $where='".$arg."'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetchall();
			return($value);
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
		
	}
	
	//show_edit_generator
	public function show_edit_generator($id)
	{
	    try{
			$sql = "select * from users where id='$id'";
			$res=$this->_dbh->query($sql);
			$array= $res->fetch(PDO::FETCH_ASSOC);
			return $array;
	    }
	    catch(PDOException $e)
	    {
		echo $e->getMessage();
	    }
	}
	//update generator records by admin
	public function update_generator($array,$id){
		try{
		$sql="UPDATE users SET companyname='".$array['companyname']."',department='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',email='".$array['email']."',password='".md5($array['password'])."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contact='".$array['contact']."',fax='".$array['fax']."' WHERE id='".$id."'";
		$result=$this->_dbh->query($sql);
		$this->_redirect->redirect("".BASE_URL."/admin/generators.php");
		//header('Location:generators.php');
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//update generator records by generator
	public function update_user_generator($array,$id){
		try{
		$sql="UPDATE users SET companyname='".$array['companyname']."',department='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',password='".md5($array['password'])."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contact='".$array['contact']."',fax='".$array['fax']."' WHERE id='".$id."'";
		$result=$this->_dbh->query($sql);
		return true;		
		//$this->_redirect->redirect("".BASE_URL."/generators/userprofile");
		//header('Location:generators.php');
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//show login last date in generator
	public function lastdate(){
		try{
			$session= Session::getInstance();
			$id=$session->__get("user_id");
			$sql = "select * from users where id='$id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			return($value);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
		
	}
	//check
	
	// manage profile pic functionality......
	public function profile_pic() {
		try {
			$sql = "select image_src from profile_images where user_id = '".$_SESSION['user_id']."'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();	
			if($value==Null)
			{
				$value['image_src']="images/profile_pic.png";
				
				return $value;
			}
			
			else{
				return $value;
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	//Updating profile pic on basis of user id
	public function update_profile_pic($url,$user_id) {
		try {
			$sql = "select image_src from profile_images where user_id = '".$user_id."'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();	
			if($value==NULL)
			{
				$this->_dbh->exec("INSERT INTO profile_images (image_src,user_id) VALUES ('".$url."','".$user_id."')");
			}
			else{
				$sql="UPDATE profile_images SET image_src='".$url."' WHERE user_id='".$user_id."'";
				$result=$this->_dbh->query($sql);
			}	
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	//Change Old password ACCORDING thier Roll/ID  
	public function change_password($array){	
		$id=$array['id'];
		$password=md5($array['password']);
		$npassword=md5($array['npassword']);
		$cpassword=md5($array['cpassword']);
		
		if($id>1){
			if($npassword!=$cpassword){
			$this->_redirect->redirect("".BASE_URL."/generators/change_password");}
			else{
				$query="update users set password='$npassword' where id= '". $array['id'] ."' and password='$password'";
				$count=$this->_dbh->query($query);
				return true;
				//$this->_redirect->redirect("".BASE_URL."/generators/userprofile");				
			}
		}
  
	}
	//add new site in generator/sites section
	public function add_new_sites($array,$id,$add_by){
		try{
			$sql = "select * from settingtb where user_id='$id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			//default setting
			if($value==Null)
			{
				$sql = "select * from settingtb where user_id='$add_by' and account_type='free'";
				$res=$this->_dbh->query($sql);
				$result= $res->fetch(PDO::FETCH_ASSOC);
				if($result['account_type']=='free')
				{
					$query="SELECT COUNT(add_user_id) AS count FROM sites WHERE add_user_id='$id'";
					$res=$this->_dbh->query($query);
					$value= $res->fetch();
					if($value['count']<$result['no_site'])
					{
						$query="insert into sites(sitename,companyname,departmentname,firstname,lastname,email,address1,address2,city,state,zipcode,epa_id,contactnumber,fax,add_user_id) values('".$array['sitename']."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','$id')";
						$result=$this->_dbh->exec($query);
						return $result;
						//$this->_redirect->redirect("".BASE_URL."/generators/sites");
					}
					else{
						return false;
					}
				}
			}else{
				//if account is elite type
				if($value['account_type']=='elite')
				{
					$query="SELECT COUNT(add_user_id) AS count FROM sites WHERE add_user_id='$id'";
					$res=$this->_dbh->query($query);
					$result= $res->fetch();
					if($result['count']<$value['no_site'])
					{
						
						$query="insert into sites(sitename,companyname,departmentname,firstname,lastname,email,address1,address2,city,state,zipcode,epa_id,contactnumber,fax,add_user_id) values('".$array['sitename']."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','$id')";
						$result=$this->_dbh->exec($query);
						//$this->_redirect->redirect("".BASE_URL."/generators/sites");
						return $result;
					}
					else{
						return false;
					}
					
				}else{
					$query="SELECT COUNT(add_user_id) AS count FROM sites WHERE add_user_id='$id'";
					$res=$this->_dbh->query($query);
					$result= $res->fetch();
					if($result['count']<$value['no_site'])
					{
						$query="insert into sites(sitename,companyname,departmentname,firstname,lastname,email,address1,address2,city,state,zipcode,epa_id,contactnumber,fax,add_user_id) values('".$array['sitename']."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','$id')";
						$result=$this->_dbh->exec($query);
						//$this->_redirect->redirect("".BASE_URL."/generators/sites");
						return $result;
					}
					else{
						return false;
					}
				}
			}	
		}
		catch(PDOException $e){
		  echo $e->getMessage();
		  }
	}
	
	//Select Site  
	public function select_sites($user_id){
	try{
		$query="select * from sites where add_user_id='$user_id'";
		$res=$this->_dbh->query($query);
		$value= $res->fetchall();
		return($value);
			}
		catch(PDOException $e){
		echo $e->getMessage();
		}
       }
       //ajax calling argument in select field
        public function select_edit_sites($id){
	try{
		$sql = "select * from sites where id='$id'";
		$res=$this->_dbh->query($sql);
		$value= $res->fetch(PDO::FETCH_ASSOC);
		return($value);
		}
		catch(PDOException $e){
		  echo $e->getMessage();
		}
	}
	//Edit Existing Site In generator/site section
	public function edit_existing_sites($array){
	try{ //print_r($array);die();
		$query="update sites set sitename='".$array['sitename']."',companyname='".$array['companyname']."',departmentname='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',email='".$array['email']."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contactnumber='".$array['contact']."',fax='".$array['fax']."' where id='".$array['site_id']."' ";
	        $this->_dbh->query($query);
	        $this->_redirect->redirect("".BASE_URL."/generators/sites");
	        }
	        catch(PDOException $e){
	        echo $e->getMessage();
	        }
	}
	//manifests upload file
	public function manifests_upload($url,$array){
	try{
		$sql="insert into manifests_tb(site_id,site_name,manifestsnumber,uploadfile,upload_date) values('".$array['siteid']."','".$array['sitename']."','".$array['manifestnumber']."','".$url."','".$array['date']."')";
		$this->_dbh->query($sql);
		$this->_redirect->redirect("".BASE_URL."/generators/manifests");
		}
		catch(PDOException $e){
		echo $e->getMessage();
		}
	}
	//show show sites in generator
	public function show_sites($id){
		try{
			$sql = "select * from sites where id='$id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			return($value);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
		
	}
	//search sites in generator add New profiel
	public function search_site($user_id){
		try{
			//echo $user_id;
			//die("a");
			$sql = "select * from sites where add_user_id='$user_id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetchall();
			return($value);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
		
	}
	 //select manifests_tb all records
	public function select_manifest(){
		try{
			
			$sql="select * from manifests_tb";
			$result=$this->_dbh->query($sql);
			$row=$result->fetchall();
			return $row;
			}
		catch(PDOException $e){
			$e->getMessage();
			} 
	}
	// Manifests Search BY-UPLOAD-DATE
	public function search_by_upload_date($array){
		
		try{
			
			$sql="SELECT * FROM manifests_tb WHERE upload_date BETWEEN '" . $array['startdate'] . "' AND '" . $array['enddate'] . "' ORDER by id "; 
			//$sql="select * from manifests_tb where upload_date='".$array['startdate']."' or '".$array['enddate']."'";
			$result=$this->_dbh->query($sql);
			$row=$result->fetchall();
			return $row;
		}
		catch(PDOException $e){
				$e->getMessage();
		}
	}
	//Manifests Search BY-MANIFEST-NUMBER
	public function search_by_manifest_number($mnuber){
		try{
			$sql="select * from manifests_tb where manifestsnumber='".$mnuber."'";
			$result=$this->_dbh->query($sql);
			$row=$result->fetchall();
			return $row;
		}
			catch(PDOException $e){
				$e->getMessage();
		}
	}
	//Manifests Search BY-SITE NAME
	public function search_by_sitename($sitename){
		
		try{
			$sql="select * from manifests_tb where site_name='".$sitename."'";
			$result=$this->_dbh->query($sql);
			$row=$result->fetchall();
			return $row;
		}
		catch(PDOException $e){
		     	$e->getMessage();
		}
		
	} 
		
	//Download-Manifest-Upload-File From Manifests_tb
	public function download_upload_file($id){
		try{
			$sql="select uploadfile from manifests_tb where id=$id";
			$result=$this->_dbh->query($sql);
			$row=$result->fetch();
			return $row;
			}
		catch(PDOException $e){
				$e->getMessage();
			}
		}
	//argument for free globle setting recode for specific generator
	public function show_global_setting_free_record($id,$user_id){
		try{
			$sql = "select * from settingtb where user_id='$id' and account_type='free'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value==NULL)
			{
				$sql = "select * from settingtb where user_id='$user_id' and account_type='free'";
				$res=$this->_dbh->query($sql);
				$value= $res->fetch(PDO::FETCH_ASSOC);
				return($value);
			}
			return($value);
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//argument for elite  globle setting recode for specific generator 
	public function show_global_setting_elite_record($id,$user_id){
		try{
			$sql = "select * from settingtb where user_id='$id' and account_type='elite'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value==NULL)
			{
			$sql = "select * from settingtb where user_id='$user_id' and account_type='elite'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			return($value);
			}
			return($value);
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	//update generator global setting records by admin
	public function update_global_setting_free_record($array,$id){
		try{
			$sql = "select * from settingtb where user_id='$id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value==NULL)
			{
				$this->_dbh->exec("INSERT INTO settingtb(no_vendor,profile_allow,no_site,account_type,user_id) VALUES ('".$array['no_vendor']."','".$array['profile_allow']."','".$array['no_site']."','".$array['account_type']."','".$id."')");
			}
			else{
			$sql="UPDATE settingtb SET price='".""."',no_vendor='".$array['no_vendor']."',profile_allow='".$array['profile_allow']."',no_site='".$array['no_site']."' ,account_type='".$array['account_type']."' where id='".$value['id']."'";
			$result=$this->_dbh->query($sql);
			
			
		}
		$this->_redirect->redirect("".BASE_URL."/admin");
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	public function help($array){
		try{ //echo"<pre>";print_r($array);die("HEY");
			$session= Session::getInstance();
			$session_username=$session->__get("user_id");
			$count = $this->_dbh->exec("INSERT INTO helptb(firstname,contact,email,problem,message_by) VALUES ('".$array['firstname']."','".$array['contact']."','".$array['email']."','".$array['problem']."','".$session_username."')");
			if($count){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//update generator global setting records by admin
	public function update_global_setting_elite_record($array,$id){
		try{
			$sql = "select * from settingtb where user_id='$id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value==NULL)
			{
				$this->_dbh->exec("INSERT INTO settingtb(no_vendor,profile_allow,no_site,account_type,user_id,price) VALUES ('".$array['no_vendor']."','".$array['profile_allow']."','".$array['no_site']."','".$array['account_type']."','".$id."','".$array['price']."')");
			}
			else{
				
			$sql="UPDATE settingtb SET price='".$array['price']."',no_vendor='".$array['no_vendor']."',profile_allow='".$array['profile_allow']."',account_type='".$array['account_type']."',no_site='".$array['no_site']."' where user_id='".$id."'";
			$result=$this->_dbh->query($sql);
		}
		$this->_redirect->redirect("".BASE_URL."/admin");
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	
	//Fetch Data from users table according thiere ROLL==3 " VENDORS "	
	public function select_vendors_past(){
		try{
			 $sql="select * from users u inner join vendors_tb vt 
			 		on u.id=vt.vendors_id 
					where vt.ban='0' and u.roll='3'";
			 $result=$this->_dbh->query($sql);
			  
			 $row=$result->fetchall();
			
			 return $row;
			}
			catch(PDOException $e){
				$e->getMessage();
			}
	}
	//Global password reset by all generator by admin  
	public function global_password_reset($user_id,$password){	
		try{
			$password=md5($password);
			$query="update users set password='$password' where add_by= '". $user_id ."' and roll='2'";
				$count=$this->_dbh->query($query);
				return true;
				}
			catch(PDOException $e){
				$e->getMessage();
			}
	}
	//Display All Vendors From Users AND Vendors_Tb  TO ALL - VENDORS 
	public function select_all_vendors(){
		try{
			//$sql="select * from users";
             $sql="select * from users where roll='3'";
			 //echo"<pre>";print_r($sql);die("RR");
			 
			 
			 $result=$this->_dbh->query($sql);
			 
			 $row=$result->fetchall();
			
			 return $row;
			 
		   }
		catch(PDOException $e){
				$e->getMessage();
		   }
	}

	// FAVOURITE BUTTON FUNCTION AT ALL - VENDORS
	public function favourite_vendors($v_fav,$g_id){
		try{ 
			//$date=date();
			$sql_count="select count(*) from vendors_tb 
						where vendors_id='".$v_fav."'
						and ban='0'";
			$result_count=$this->_dbh->query($sql_count);
			$row=$result_count->fetch();
			if($row[0]==0){
				$sql="insert into    vendors_tb(vendors_id,generators_id,ban,ban_date) values('$v_fav','$g_id','0','".$date."')";
			    $result=$this->_dbh->query($sql);
			}else{
					echo "false";die;
				}
		 //}
		 //$this->_redirect->redirect("".BASE_URL."/generators/all_vendors");
		 }
		 
		catch(PDOException $e){
				$e->getMessage();
			}
	}
 	//add wests gnenerator functionality
	public function wests($user_id,$service_type,$dispose,$array){
		
		try{
			$sql="insert into waste_tb (waste,process_generating,profile_no,source,sample_available,user_id,dispose,service_type) values('".$array['waste']."','".$array['process_generating']."','".$array['profile_no']."','".$array['source']."','".$array['sample_available']."','".$user_id."','".$dispose."','".$service_type."')";
			$result=$this->_dbh->exec($sql);
			return $result;		
		}
		catch(PDOException $e){
				$e->getMessage();
		}
	}
	//VENDORS BAN FUNCTION AT VENDORS- HISTORY
	public function vendors_ban($v_id){
		try{
			echo $v_id;
				//$sql_update="update vendors_tb set ban='1',ban_date='". date("M-d-Y")."' 
				$sql_update="update vendors_tb set ban='1',ban_date='".date('M-d-Y')."' 

							where id='".$v_id."'";
			    $result=$this->_dbh->query($sql_update);
				//$this->_redirect->redirect("".BASE_URL."/generators/vendors-history");				
		 }
		catch(PDOException $e){
				$e->getMessage();
			}
	}
	//Select Banned Vendors From Vendors_ban_tb FOR VENDORS - BANNED
	public function select_ban_vendors(){
		try{
			
			 $sql="select * from users join vendors_tb ON users.id=vendors_tb.vendors_id where vendors_tb.ban='1'";
			$result=$this->_dbh->query($sql);
			$row=$result->fetchall();
			return $row;
			}
		catch(PDOException $e){
			$e->getMessage();
			}
		
	}
	//VENDORS HISTORY SEARCH BY-UPLOAD-DATE
	public function search_by_date_range($array){
	try{
		$sdate=$array['startdate'];
		$edate=$array['enddate'];
		$sql="select * from users u inner join vendors_tb vt on u.id=vt.vendors_id where vt.ban='0' and u.register_date BETWEEN '$sdate' AND '$edate' and u.roll='3'";
		$result=$this->_dbh->query($sql);
		$row=$result->fetchall();
		return $row;
		}
		catch(PDOException $e){
			$e->getMessage();
		}
	}

//RESUME BAN VENDOR'S FUNCTION CALLING
    public function resume_ban_vendors($v_unban){
		
	try{ 
		   $sql_update="update vendors_tb set ban='0',ban_date='".date('M-d-Y')."' 

							where id='".$v_unban."'";
			    $result=$this->_dbh->query($sql_update);
		}
		catch(PDOEception $e){
				 $e->getMesaage();
		}
		
	}
	//Inserting random number to database for reseting password	
	public function insert_rand_no($rand_no,$user_id){
		$this->_dbh->exec("INSERT INTO password_reset set random_no='".$rand_no."',user_id='".$user_id."'");
	}
	
	//check service type in generator
	public function service_type($service){
		try{
			$sql = "select * from material_tb where  mat_id='$service'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			return($value);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
		
	}
	public function save_return()
	{
		try{
			$session= Session::getInstance();
			$userinfo=$session->__get("save_return");
			echo sizeof($userinfo);
echo "<pre>";
print_r($userinfo);
die("aa");
	if(sizeof($userinfo)==4)
	{
		foreach($userinfo as $key => $value)
		{
			if($value == "Save & Return"){
				continue;
			}else{
			$this->_dbh->exec("INSERT into material_type set mat_id='".$session->__get("service_id")."',user_id='".$session->__get("user_id")."',mate_label='".$key."',mate_value='".$value."'");
			}
		}
    	}
	else if(sizeof($userinfo)==2)
	{
		foreach($userinfo as $keys => $val)
		{
			foreach($val as $key => $value)
			{
				if($value == "Save & Return"){
				continue;
				}else if ($value == "Next"){
				continue;
				}else{
				$this->_dbh->exec("INSERT into material_type set mat_id='".$session->__get("service_id")."',user_id='".$session->__get("user_id")."',mate_label='".$key."',mate_value='".$value."'");
				}
			}
		}
    	}


		}catch(PDOException $e){
			echo $e->getMessage();
		}
		
	}
	
}	
