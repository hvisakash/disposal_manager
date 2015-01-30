<?php
//require_once '../init.php';
class User
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
	
	//function for forgot password
	public function forgot_password($array){
		$email=$array['email'];
		$sql="select * from users where email='".$email."'";
		$a=$this->_dbh->query($sql);
		$value= $a->fetch();
		//echo "<pre>";print_r($value);die;
		return $value;
	}

	//Inserting random number to database for reseting password	
	public function insert_rand_no($rand_no,$user_id){
		$this->_dbh->exec("INSERT INTO password_reset set random_no='".$rand_no."',user_id='".$user_id."'");
	}

	//checking if redirect random number exist in database or not
	public function check_rand_no($rand_no){
		$sql="select * from password_reset where random_no='".$rand_no."'";
		$a=$this->_dbh->query($sql);
		$value= $a->fetch();
		//echo "<pre>";print_r($value);die;
		return $value;
	}

	//Function to reset password
	public function update_password($user_id,$new_password){
		$new=md5($new_password);
		$sql="UPDATE users SET password='".$new."' WHERE id='".$user_id."'";
		$sql1="DELETE from password_reset where user_id='".$user_id."'";
		$result=$this->_dbh->query($sql);
		$result=$this->_dbh->query($sql1);
	}
	// add Register 	
	public function register($array){
		try{
			
			$email=$array['email'];
			//checking email in admin table already exist or not
			$sql="select * from admin where email = '$email'";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();
			if($value['email']==$array['email'])
			{
			      return "email";
			}
			//echo date("M-d-Y");
			//die("here");
			//checking email in user table already exist or not
			$sql = "select * from users where email = '$email' ";
			$res=$this->_dbh->query($sql);
			$value= $res->fetch();
			if($value['email']==$array['email'])
			{
			      return "email";
			}
			if($array["roll"]==2)
			{
				$sql = "select * from users where roll='2'";
				$res=$this->_dbh->query($sql);
				$value= $res->fetchall();
				if($value==Null)
				{
				$count = $this->_dbh->exec("INSERT INTO users(register_date,companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,account_no) VALUES ('".date('M-d-Y')."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','2','".$array['date']."','".'0'."','".'10000001'."')"); 
				$id=$this->_dbh->lastInsertId();
				$count1 = $this->_dbh->exec("INSERT INTO user_password(password,user_id) VALUES ('".md5($array['password'])."','".$id."')");
				return $id;
				}
				else{
					$sql="SELECT MAX(account_no) as account from users where roll='2'";
					$res=$this->_dbh->query($sql);
					$value= $res->fetch();
					$value=$value['account']+1;
					$count = $this->_dbh->exec("INSERT INTO users(register_date,companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,account_no) VALUES ('".date('M-d-Y')."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','2','".$array['date']."','".'0'."','".$value."')"); 
					$id=$this->_dbh->lastInsertId();
					$count1 = $this->_dbh->exec("INSERT INTO user_password(password,user_id) VALUES ('".md5($array['password'])."','".$id."')");
					return $id;
				}
			}
			else
			{
				$sql = "select * from users where roll='3'";
				$res=$this->_dbh->query($sql);
				$value= $res->fetchall();
				if($value==Null)
				{
				$count = $this->_dbh->exec("INSERT INTO users(register_date,companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,account_no) VALUES ('".date('M-d-Y')."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','3','".$array['date']."','".'0'."','".'90000001'."')"); 
				$id=$this->_dbh->lastInsertId();
				return $id;
				}
				else{
					$sql="SELECT MAX(account_no) as account from users where roll='3'";
					$res=$this->_dbh->query($sql);
					$value= $res->fetch();
					$value=$value['account']+1;
					$count = $this->_dbh->exec("INSERT INTO users(register_date,companyname,department,firstname,lastname,email,password,address1,address2,city,state,zipcode,epa_id,contact,fax,roll,date,account,account_no) VALUES ('".date('M-d-Y')."','".$array['companyname']."','".$array['department']."','".$array['firstname']."','".$array['lastname']."','".$array['email']."','".md5($array['password'])."','".$array['address1']."','".$array['address2']."','".$array['city']."','".$array['state']."','".$array['zipcode']."','".$array['epa_id']."','".$array['contact']."','".$array['fax']."','3','".$array['date']."','".'0'."','".$value."')"); 
					$id=$this->_dbh->lastInsertId();
					return $id;
				}
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			}
		
		
	}

	//Function to insert last password used
	public function insert_last_password($array){
		$password=md5($array['password']);
		//checking if number of previous password is not greater than 2
		$sql="select count(*) from user_password where user_id='".$array['user_id']."'";
		$a=$this->_dbh->query($sql);
		$value= $a->fetch();
		if($value[0]==2){
			$sql1="select * from user_password where user_id='".$array['user_id']."'";
			$a=$this->_dbh->query($sql1);
			$value= $a->fetch();

			$sql2="UPDATE user_password SET password='".$password."' 
			WHERE user_id='".$array['user_id']."' and id='".$value['id']."'";
			//echo $sql2;die;
			$result=$this->_dbh->query($sql2);
		}
		else{
			$this->_dbh->exec("INSERT INTO user_password set password='".$password."',user_id='".$array['user_id']."'");
		}
	}

	//Function to check previous two password
	public function check_password($array){
		$sql1="select * from user_password where user_id='".$array['id']."' and 
				password='".md5($array['npassword'])."'";
		//echo $sql1;die;
		$a=$this->_dbh->query($sql1);
		$value= $a->fetch();
		if($value)
			return true;
		else
			return false;		
	}

}