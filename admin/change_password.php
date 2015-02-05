<?php
//including initial file
include("../init.php");
	//object for admin class
	$admin = Admin::getInstance();
	$result=$admin->lastdate();
        $session = $init->getSession();
        $profile_pic=$admin->profile_pic();
	//object for redirect class
    	$redirect = $init->getRedirect();
	//user class object
	$user = User::getInstance();
	//create object for mail class 	
	$mail = Mail::getInstance();
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
	$roll=$result['roll'];
	$email=$result['email'];
	$id=$result['id'];
	$array=array("id"=>"$id","roll"=>"$roll","password"=>$_POST['password'],"npassword"=>$_POST['npassword'],"cpassword"=>$_POST['cpassword']);
	//checking previous two password
	$res=$user->check_password($array);
	$result=0;
	if(!$res)
	    $password_result=$admin->change_password($array);
	else
	    echo "<script>alert('For security purposes you cannot use your last two passwords.')</script>";
	if($password_result==1)
	{
		$primary=$admin->show_primary_administrator();
	    	$mail->reset_password_admin($email,$primary["email"]);
		$redirect->redirect("".BASE_URL."/logout.php");
	}

	//$admin->change_password($array);
}
include("../include/header.php");
include("../include/header_menu.php");
?>
<div class="banner bannerwithnoimg">
    <div class="container">
	<div class="bannertxt col-lg-12">
	    <span class="page_heading">Change Password</span>
	    <span class="page_txt">Aliqat volutpasac tupis. Integer rutrum ante eu lacuestibulum libero nisl porta vel sceleris que eget</span>
	</div>
    </div>
</div>
<div class="main_div">
    <div class="rightshade"></div>
    <div class="container">
        <div class="row">
	    <div class="col-lg-12">
		<div class="">
		    <div class="profile_pic"><img src="<?php echo BASE_URL;?>/<?php echo $profile_pic['image_src'];?>" alt="profile pic" width="87" height="87"></div>
		    <span class="name"><?php echo $result['firstname'];?></span><br/>
		    <span class="last_login">Last login:</span>
		    <span class="date"><?php echo $result['date'];?></span>
		</div>
	    </div>
	    <div class="clearfix"></div>
	    <div class="form-signin">
		<div class="loginform">
		    <form class="form-signin-container ChangePassword" role="form" name="frm" method='post' id="frm">
		    <h2 class="form-signin-heading">Change Password</h2>
			<div class="placeholders">
			    <input type="password" name="password" class="form-control" placeholder="Old Password" id="opassword">
			</div>
			<div class="placeholders">
			    <input type="password" name="npassword" class="form-control" placeholder="New Password" id="npassword">
			</div>
			<div class="placeholders">
			    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" id="cpassword">
			</div> 
			<input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Update"/>
		    </form>
		</div>
	    </div>
	</div>
    <div class="options">
    </div>
    </div> <!-- /container -->
    <div class="clearfix"></div>
    <?php include("../include/footer.php");?>
</div>
</body>
</html>

