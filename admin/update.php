<?php
//including initial file
require_once("../init.php");
    //creating object of Admin class
    $admin = Admin::getInstance();
    $result=$admin->lastdate();
    $profile_pic=$admin->profile_pic();
    //creating object of generator class
    $generator = Generators::getInstance();
    //creating object of generator class
    $vendor = Vendor::getInstance();
    //creating object of user class
    $user = User::getInstance();
    //show generator list 
    if(isset($_REQUEST['id']) and ($_REQUEST['roll']==2))
    {
        $list=$generator->show_edit_generator($_REQUEST['id']);    
    }
    else
    {
	$list=$vendor->show_edit_vendor($_REQUEST['id']);
    }
    $session = $init->getSession();
    $redirect = $init->getRedirect();
    if(!$session->__get("roll")==1)
    {
	$redirect->redirect("../admin_signin.php");
    }
    elseif($session->__get("roll")==2)
    {
	$redirect->redirect("../generators");
    }
    elseif($session->__get("roll")==3)
    {
	$redirect->redirect("../vendors");
    }

	if(isset($_POST['submit']))
	    {
		if($_REQUEST['roll']==2)
		{
			$generator->add_more_address($_POST['address'],$_REQUEST['id']);
		}
		else{
			$vendor->add_more_address($_POST['address'],$_REQUEST['id']);
		}
	}    
	if(isset($_POST['btnsubmit']))
    {
    $array = array(
        "companyname" => $_POST['companyname'],
        "department" => $_POST['department'],
        "firstname" => $_POST['firstname'],
        "lastname" => $_POST['lastname'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "address1" => $_POST['address1'],
        "address2" => $_POST['address2'],
        "city" => $_POST['city'],
        "state" => $_POST['state'],
        "zipcode" => $_POST['zipcode'],
        "epa_id" => $_POST['epa_id'],
        "contact" => $_POST['contact'],
        "fax" => $_POST['fax'],
        );
	if($_REQUEST['roll']==2)
	{
		$a=array('user_id' => $_REQUEST['id'],'password' => $_POST['password']);
	    $user->insert_last_password($a);
	    $generator->update_generator($array,$_REQUEST['id']);
	}else
	{
	    
	    $vendor->update_vendor($array,$_REQUEST['id']);
	}
	
    }
 ?>   <!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disposal Manager</title>
    <link href="<?php echo BASE_URL;?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/css/custom.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
    <script src="<?php echo BASE_URL;?>/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
<?php
// includding header portion
  include("../include/header.php");
  include("../include/header_menu.php");?>


	<div class="banner bannerwithnoimg">
	    <div class="container">
		<div class="bannertxt col-lg-12">
		    <span class="page_heading">Account Information</span>
		    <span class="page_txt">Aliqat volutpasac tupis. Integer rutrum ante eu lacuestibulum libero nisl porta vel sceleris que eget</span>
		</div>
	    </div>
  	</div>
    <div class="main_div">
        <div class="container">
            <div class="row">
        	<div class="col-lg-12">
            	    <div class="">
                    	<div class="profile_pic"><img src="<?php echo BASE_URL;?>/<?php echo $profile_pic['image_src'];?>" alt="profile pic" width="87" height="87"></div>
                        <span class="name"><?php echo $result['firstname'];?></span><br/>
                        <span class="last_login">Last login:</span><span class="date"><?php echo $result['date'];?></span>
		    </div>
                </div>
		<div class="options">
                    <div class="profile_options">
		    </div>
                </div>
<div class="options">
                    <div class="profile_options">
			    <a href="#address_popup" title="Add Address" class="link" data-toggle="modal">Add Address</a>
		    </div>
                </div>
            </div>
            <!-- list shoew -->
	    <form method='post' >
            <table cellspacing="15" cellpadding="15" id='tableid1' align="center"  class="table table-bordered">
		<tr>
                    <td>Account Number</td>
                    <td><input name='' type='text' value='<?php echo $list['account_no']?>' readonly="readonly"/></td>
                </tr>
                <tr>
		    <td>Company Name</td>
		    <td><input name='companyname' type='text' value='<?php echo $list['companyname']?>'/></td>
		</tr>       
		<tr>
		    <td>Department</td>
		    <td><input name='department' type='text' value='<?php echo $list['department']?>'/></td>
		</tr>       
		<tr>
		    <td>First Name</td>
		    <td><input name='firstname' type='text' value='<?php echo $list['firstname']?>'/></td>
		</tr>       
		<tr>
		    <td>Last Name</td>
		    <td><input name='lastname' type='text' value='<?php echo $list['lastname']?>' /></td>
		</tr>       
		<tr>
		    <td>Email</td>
		    <td><input name='email' type='text' value='<?php echo $list['email']?>' /></td>
		</tr>       
		<tr>
		    <td>Password</td>
		    <td><input name='password' type='password' value='<?php echo $list['password']?>'/></td>
		</tr>       
		<tr>
		    <td>Address 1</td>
		    <td><input name='address1' type='text' value='<?php echo $list['address1']?>' /></td>
		</tr>       
		<tr>
		    <td>Address 2</td>
		    <td><input name='address2' type='text' value='<?php echo $list['address2']?>'/></td>
		</tr>       
		<tr>
		    <td>City</td>
		    <td><input name='city' type='text' value='<?php echo $list['city']?>'/></td>
		</tr>       
		
		<tr>
		    <td>State</td>
		    <td><input name='state' type='text' value='<?php echo $list['state']?>'/></td>
		</tr>       
		<tr>
		    <td>Zip Code</td>
		    <td><input name='zipcode' type='text' value='<?php echo $list['zipcode']?>' /></td>
		</tr>       
		<tr>
		    <td>EPA ID</td>
		    <td><input name='epa_id' type='text' value='<?php echo $list['epa_id']?>'/></td>
		</tr>
		<tr>
		    <td>Phone Number</td>
		    <td><input name='contact' type='text' value='<?php echo $list['contact']?>' /></td>
		</tr>
		<tr>
		    <td>Fax Number</td>
		    <td><input name='fax' type='text' value='<?php echo $list['fax']?>' /></td>
		</tr>
		
		<tr>
		    <td><input name="btnsubmit" type='submit' value='Update' class='btn btn-success' style="margin-left: 150px; margin-top:10px;"/></td>
		</tr>
            </table>
	    </form> 
	</div>
	<!-- /container -->
    </div>
  <?php include("../include/footer.php");?>
<!--start add genrator address popup code -->
<div id="address_popup" class="modal fade">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-header" headerBGstyle="height: 150px;" > <center>Add More  Address</center>
		<button type="reset" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		    <h4 class="modal-title text-left">
			<form method='post' name='address_form'>
			    <table cellspacing="15" cellpadding="15" id='rejoin'   align="center" >
				<tr>
					<td>Address:</td>
					<td><textarea name="address" style="margin-left: 50px;margin-top:10px;"></textarea></td>
				</tr>	
			    </table>
			    <input name="submit" type="submit" value="Add" style="margin-left: 200px; margin-top:5px;" class="btn-success"/>
			</form>
	    </div>

	</div>
   </div>
</div>
    <!--end of rejoin genrator popup code -->    



</body>
</html>
