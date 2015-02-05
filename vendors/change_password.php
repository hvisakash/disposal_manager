<?php
//including initial file
include("../init.php");
  //creating object for vendor class
  $vendor = Vendor::getInstance();
  //creating object of session class
  $session = $init->getSession();
  //creating object of redirect class
  $redirect = $init->getRedirect();
  //argument of profile pic
  $profile_pic=$vendor->profile_pic();
  //display last login date
  $result=$vendor->lastdate();
    //user class object
  $user = User::getInstance();

  /*if(!$session->__get("roll")==2)
	{
	  $redirect->redirect("../admin_signin.php");
	}
	  elseif($session->__get("roll")==1)
	{
	  $redirect->redirect("../admin");
	}
	elseif($session->__get("roll")==3)
	{
	  $redirect->redirect("../vendors");
	}*/
if(isset($_POST['submit']))
{
	$id=$session->__get("user_id");
	$email=$result['email'];

  	$array=array("id"=>"$id","password"=>$_POST['password'],"npassword"=>$_POST['npassword'],"cpassword"=>$_POST['cpassword']);
	//checking previous two password
	$res=$user->check_password($array);
	$result=0;
	if(!$res)
	    $result=$vendor->change_password($array);
	else
	    echo "<script>alert('For security purposes you cannot use your last two passwords.')</script>";

	if($result==1)
	{
	    $mail = Mail::getInstance();
	    $mail->reset_password_vendor($email);
	    $redirect->redirect("".BASE_URL."/logout.php");
	}
}include("../include/header.php");
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
	      <span class="last_login">Last login:</span><span class="date"><?php echo $result['date'];?></span>
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
  </div>
</div>
  <?php include("../include/footer.php");?>
</body>
</html>
