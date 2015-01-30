<?php
class Vendor
{
	private $dbh;
	private $redirect;
	private static $instance=NULL;
	function __construct()
	{
		$dbObject = DatabaseConnection::getInstance();
		$this->_dbh = $dbObject->getConnection();
		$this->_redirect = URLRedirect::getInstance();
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
	public function show_vendor($id){
		try{
			$sql = "select * from users where roll='3' and add_by='$id'";
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
	// add vendor 	
	public function add_vendor($array){
		try{
			//die("hree");
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
				$sql = "select * from users where roll='3'";
				$res=$this->_dbh->query($sql);
				$value= $res->fetchall();
				if($value==Null)
				{
				$count = $this->_dbh->exec("INSERT INTO users(register_date,companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,account_no,add_by) VALUES ('".date('M-d-Y')."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','3','".$array['date']."','".'1'."','".'90000001'."','$session_id')"); 
				$id=$this->_dbh->lastInsertId();
				return $id;
				}
				else{
					$sql="SELECT MAX(account_no) as account from users where roll='3'";
					$res=$this->_dbh->query($sql);
					$value= $res->fetch();
					$value=$value['account']+1;
					//echo date('M-d-Y');
					//die("hree");
					$count = $this->_dbh->exec("INSERT INTO users(register_date,companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,account_no,add_by) VALUES ('".date('M-d-Y')."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','3','".$array['date']."','".'1'."','".$value."','$session_id')"); 
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
	//show genrator on the basis of where clause
	public function show_vendor_where($where,$arg){
		try{
			$sql = "select * from users where roll='3' and $where='".$arg."'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetchall();
			return($value);
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
		
	}
	//show_edit_vendor
	public function show_edit_vendor($id)
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
	//update vendor records by admin
	public function update_vendor($array,$id){
		try{
		$sql="UPDATE users SET companyname='".$array['companyname']."',department='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',email='".$array['email']."',password='".md5($array['password'])."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contact='".$array['contact']."',fax='".$array['fax']."' WHERE id='".$id."'";
		$result=$this->_dbh->query($sql);
		$this->_redirect->redirect("".BASE_URL."/admin/vendors.php");
		}catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//join or rejoin  argument..
	public function join($id)
	{
	    try{
			$sql = "delete from suspendtb where suspend_id='".$id."'";
			$result=$this->_dbh->query($sql);
			$sql="UPDATE users SET account='"."1"."' WHERE id='".$id."'";
			$result=$this->_dbh->query($sql);
			return true;
	    }
	    catch(PDOException $e)
	    {
		echo $e->getMessage();
	    }
	}
	
	//show login last date in vendor
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
	//Change Old password ACCORDING thier ID  
	public function change_password($array){	
		$id=$array['id'];
		$password=md5($array['password']);
		$npassword=md5($array['npassword']);
		$cpassword=md5($array['cpassword']);
		
		if($id>1){
			if($npassword!=$cpassword){
			$this->_redirect->redirect("".BASE_URL."/vendors/change_password");}
			else{
				$query="update users set password='$npassword' where id= '". $array['id'] ."' and password='$password'";
				$count=$this->_dbh->query($query);
				return true;
			}
		}
  
	}
	//update generator records by generator
	public function update_user_vendor($array,$id){
		try{
		$sql="UPDATE users SET companyname='".$array['companyname']."',department='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',password='".md5($array['password'])."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contact='".$array['contact']."',fax='".$array['fax']."' WHERE id='".$id."'";
		$this->_dbh->query($sql);
		return(true);
		}catch(PDOException $e){
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
	//add new site in vendors/sites section
	public function add_new_sites($array,$id,$add_by){
		try{
			$sql = "select * from settingtb where user_id='$id'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch(PDO::FETCH_ASSOC);
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
						$result=$this->_dbh->query($query);
						$this->_redirect->redirect("".BASE_URL."/vendors/Sites");
					}
					else{
						return false;
					}
				}
			}else{
			
				if($value['account_type']=='elite')
				{
			
					$query="SELECT COUNT(add_user_id) AS count FROM sites WHERE add_user_id='$id'";
					$res=$this->_dbh->query($query);
					$result= $res->fetch();
					if($result['count'] < $value['elite_sites_vendor'])
					{
						$query="insert into sites(sitename,companyname,departmentname,firstname,lastname,email,address1,address2,city,state,zipcode,epa_id,contactnumber,fax,add_user_id) values('".$array['sitename']."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','$id')";
						$result=$this->_dbh->query($query);
						$this->_redirect->redirect("".BASE_URL."/vendors/Sites");
					}
					else{
						return false;
					}
					
				}else{
					$query="SELECT COUNT(add_user_id) AS count FROM sites WHERE add_user_id='$id'";
					$res=$this->_dbh->query($query);
					$result= $res->fetch();
					if($result['count'] < $value['elite_sites_vendor'])
					{
						$query="insert into sites(sitename,companyname,departmentname,firstname,lastname,email,address1,address2,city,state,zipcode,epa_id,contactnumber,fax,add_user_id) values('".$array['sitename']."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','$id')";
						$result=$this->_dbh->query($query);
						$this->_redirect->redirect("".BASE_URL."/vendors/Sites");
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
		
		
		
		try{ 
		$query="insert into sites(sitename,companyname,departmentname,firstname,lastname,email,address1,address2,city,state,zipcode,epa_id,contactnumber,fax,add_user_id) values('".$array['sitename']."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','$id')";
		$result=$this->_dbh->query($query);
		
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
       //Edit Existing Site In generator/site section
	public function edit_existing_sites($array){
	try{ //print_r($array);die();
		$query="update sites set sitename='".$array['sitename']."',companyname='".$array['companyname']."',departmentname='".$array['department']."',firstname='".$array['firstname']."',lastname='".$array['lastname']."',email='".$array['email']."',address1='".$array['address1']."',address2='".$array['address2']."',city='".$array['city']."',state='".$array['state']."',zipcode='".$array['zipcode']."',epa_id='".$array['epa_id']."',contactnumber='".$array['contact']."',fax='".$array['fax']."' where id='".$array['site_id']."' ";
	        $this->_dbh->query($query);
	        $this->_redirect->redirect("".BASE_URL."/vendors/Sites");
	        }
	        catch(PDOException $e){
	        echo $e->getMessage();
	        }
	}
	//argument for free globle setting recode for specific vendors
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
			//echo "<pre>";
			//print_r($value);
			//die("here");
			
			}
			return($value);
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
	//argument for elite  globle setting recode for specific vendors 
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
	//			echo "<pre>";
	//			print_r($array);
	//			die("hree");
				$this->_dbh->exec("INSERT INTO settingtb(account_type,sites_vendor,user_id) VALUES ('".$array['account_type']."','".$array['sites_vendor']."','".$id."')");
			}
			else{
			$sql="UPDATE settingtb SET sites_vendor='".$array['sites_vendor']."' ,account_type='".$array['account_type']."' where id='".$value['id']."'";
			$result=$this->_dbh->query($sql);
			
			
		}
		$this->_redirect->redirect("".BASE_URL."/admin");
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
			$this->_dbh->exec("INSERT INTO settingtb(account_type,elite_sites_vendor,elite_vendor_price,user_id) VALUES ('".$array['account_type']."','".$array['elite_sites_vendor']."','".$array['elite_vendor_price']."','".$id."')");
			}
			else{
			$sql="UPDATE settingtb SET account_type='".$array['account_type']."',elite_sites_vendor='".$array['elite_sites_vendor']."',elite_vendor_price='".$array['elite_vendor_price']."' where user_id='".$id."'";
			$result=$this->_dbh->query($sql);
		}
		$this->_redirect->redirect("".BASE_URL."/admin");
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
	
	
}
