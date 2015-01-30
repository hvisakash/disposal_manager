<?php
class Admin
{
	private $dbh;
	private $redirect;
	private static $instance=NULL;
	function __construct()
	{
		$dbObject = DatabaseConnection::getInstance();
		$this->_dbh = $dbObject->getConnection();
		$this->_redirect = URLRedirect::getInstance();
		$session= Session::getInstance();
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
	// manage login functionality......
	public function login($array) {
		try {
			
			$email=$array['email'];
			$sql = "select * from admin where email = '$email'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();
			if($value==Null)
			{
				$sql = "select * from users where email = '$email'";
				$res=$this->_dbh->query($sql);
				$value= $res->fetch();
			}
			if(isset($array['paticular_role'])){
			   if($value['roll']==$array['paticular_role']){
				if(($array['email']==$value['email']) and  (md5($array['password'])==($value['password'])))
				{
					return $value;
						
				}
				else{
					return false;
				}
			   }
			   
			   else{
				if(@$array['paticular_role']==2)
					echo "<script>alert('Invalid Generator')</script>";
				else if(@$array['paticular_role']==3)
					echo "<script>alert('Invalid Provider')</script>";
			   }
			}
			else{
				if(($array['email']==$value['email']) and  (md5($array['password'])==($value['password'])))
				{
					return $value;
						
				}
				else{
					return false;
				}
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	//show login date
	public function lastdate(){
		try{
			$session= Session::getInstance();
			$id=$session->__get("user_id");
			$sql = "select * from admin where id='$id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value==Null)
			{
				$sql = "select * from users where id='$id'";
				$res=$this->_dbh->query($sql);
				$value= $res->fetch(PDO::FETCH_ASSOC);
			}
			return($value);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	// logout functionality
	public function logout($id){
		try{
			$sql = "select * from users WHERE id='".$id."'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value)
			{
				$sql="UPDATE users SET date='".date('M-d-Y')." ". date("H:i", time())."' WHERE id='".$id."'";
			}else{
				$sql="UPDATE admin SET date='".date('M-d-Y')." ". date("H:i", time())."' WHERE id='".$id."'";
			}
		
		$result=$this->_dbh->query($sql);
		
		$session= Session::getInstance();
		$session->destroy();
		$this->_redirect->redirect("home");
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	
	//Showing the list of all administrator
	public function show_admin(){
		try{
			$sql = "select * from users where roll='1'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetchall();
			return($value);
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
		
	}
	
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
		//$roll=$array['roll'];
		$password=md5($array['password']);
		$npassword=md5($array['npassword']);
		$cpassword=md5($array['cpassword']);
		//change ADMIN password which have ID==1 Always
		if($id==1){
			
			if($npassword!=$cpassword){
			$this->_redirect->redirect("".BASE_URL."/admin/change_password");
			
			}
		else{
			$query="update admin set password='$npassword' where id= '". $array['id'] ."' and password='$password'";
			$count=$this->_dbh->query($query);
				$this->_redirect->redirect("".BASE_URL."/logout.php");
			}
		}
		//change USER[Administrator] password which have roll>1 Always
		else if($id>1){
			if($npassword!=$cpassword){
			$this->_redirect->redirect("".BASE_URL."/admin/change_password");}
			else{
				$query="update users set password='$npassword' where id= '". $array['id'] ."' and password='$password'";
				$count=$this->_dbh->query($query);
				return true;
				//$this->_redirect->redirect("".BASE_URL."/logout.php");				
			}
		}
  
	}
	//Show the primary  administrator
	public function show_primary_administrator(){
		try{
			$sql = "select * from admin where roll='1'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			return($value);
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
		
	}

	
	
	//help  functionality
	public function help($array){
		try{
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
	// add administrator 	
	public function add_administrator($array){
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
			
			$sql = "select * from users where email = '$email' ";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();
			if($value['email']==$array['email'])
			{
			      return "email";
			}
			else
			{
				$count = $this->_dbh->exec("INSERT INTO users(companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,add_by) VALUES ('".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','1','".$array['date']."','".'1'."','$session_id')"); 
				$id=$this->_dbh->lastInsertId();
				return $id;
			}
			
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//administrator remove  argument..
	public function remove_account($id)
	{
	    try{
		$sql = "delete from users where id='".$id."'";
		$result=$this->_dbh->query($sql);
		return true;
		}
		catch(PDOException $e)
		{
		    echo $e->getMessage();
		}
	}
	//update adminisrartor records 
	public function update_admin_record($array,$id,$firstname){
		try{
			$sql = "select * from admin where id='$id' and firstname='$firstname'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value != NULL)
			{
				$query="UPDATE admin SET companyname='".$array['companyname']."',department='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',email='".$array['email']."',password='".md5($array['password'])."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contact='".$array['contact']."',fax='".$array['fax']."' WHERE id='".$id."'";
			}else{
				$query="UPDATE users SET companyname='".$array['companyname']."',department='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',email='".$array['email']."',password='".md5($array['password'])."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contact='".$array['contact']."',fax='".$array['fax']."' WHERE id='".$id."'";
			}
			$result=$this->_dbh->query($query);
			return true;
			}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//All Site show in admin panel 
	public function select_sites(){
	try{
		$query="select * from sites";
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
	try{
		$query="update sites set sitename='".$array['sitename']."',companyname='".$array['companyname']."',departmentname='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',email='".$array['email']."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contactnumber='".$array['contact']."',fax='".$array['fax']."' WHERE id='".$array["site_id"]."'";
	        $this->_dbh->query($query);
	        $this->_redirect->redirect("".BASE_URL."/admin/editSites.php");
	        }
	        catch(PDOException $e){
	        echo $e->getMessage();
	        }
	}
	//show  view sites
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
	//update generator globle setting records by admin
	public function update_globle_setting_for_all($array){
		try{
			$sql = "select * from global_setting";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();	
			if($value==NULL)
			{
				$this->_dbh->exec("INSERT INTO global_setting (free_sites_allow,free_profile_allow,price,sites_allow,profile_allow,no_vendor) VALUES ('".$array['free_sites_allow']."','".$array['free_profile_allow']."','".$array['price']."','".$array['sites_allow']."','".$array['profile_allow']."','".$array['no_vendor']."')");
			}
			else{
			$sql="UPDATE global_setting SET free_sites_allow='".$array['free_sites_allow']."',free_profile_allow='".$array['free_profile_allow']."',price='".$array['price']."',sites_allow='".$array['sites_allow']."',profile_allow='".$array['profile_allow']."',no_vendor='".$array['no_vendor']."'";
			$result=$this->_dbh->query($sql);
			
		}
		$this->_redirect->redirect("".BASE_URL."/admin/Global_setting");
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	
	//insert and update globle setting records by admin in free account
	public function update_globle_setting_free_record($array,$id){
		try{
			$sql = "select * from settingtb where user_id='$id' and account_type='$array[account_type]'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value==NULL)
			{
				$this->_dbh->exec("INSERT INTO settingtb(no_vendor,profile_allow,no_site,account_type,sites_vendor,user_id) VALUES ('".$array['no_vendor']."','".$array['profile_allow']."','".$array['no_site']."','".$array['account_type']."','".$array['sites_vendor']."','".$id."')");
			}
			else{
			$sql="UPDATE settingtb SET no_vendor='".$array['no_vendor']."',sites_vendor='".$array['sites_vendor']."',profile_allow='".$array['profile_allow']."',no_site='".$array['no_site']."' where id='".$value['id']."'";
			$result=$this->_dbh->query($sql);
			
			
		}
		$this->_redirect->redirect("".BASE_URL."/admin");
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//insert and update globle setting records by admin in  Elite account
	public function update_globle_setting_elite_record($array,$id){
		try{
			$sql = "select * from settingtb where user_id='$id' and account_type='$array[account_type]'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			if($value==NULL)
			{
			
	$this->_dbh->exec("INSERT INTO settingtb(no_vendor,profile_allow,no_site,account_type,price,elite_vendor_price,elite_sites_vendor,user_id) VALUES ('".$array['no_vendor']."','".$array['profile_allow']."','".$array['no_site']."','".$array['account_type']."','".$array['price']."','".$array['elite_vendor_price']."','".$array['elite_sites_vendor']."','".$id."')");
			}

			else{
//			echo "<pre>";
//			print_r($array);
//			die("hreh");
			$sql="UPDATE settingtb SET price='".$array['price']."',elite_vendor_price='".$array['elite_vendor_price']."',elite_sites_vendor='".$array['elite_sites_vendor']."',no_vendor='".$array['no_vendor']."',profile_allow='".$array['profile_allow']."',no_site='".$array['no_site']."' where id='".$value['id']."'";
			$result=$this->_dbh->query($sql);
			
			
		}
		$this->_redirect->redirect("".BASE_URL."/admin");
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//show globle setting recode
	public function show_globle_setting_free_record($id){
		try{
			$sql = "select * from settingtb where user_id='$id' and account_type='free'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			return($value);
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//show globle setting recode
	public function show_globle_setting_elite_record($id){
		try{
			$sql = "select * from settingtb where user_id='$id' and account_type='elite'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
			return($value);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
}
