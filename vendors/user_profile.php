<?php
//including initial file
include("../init.php");
    //creating object of session class  
    $session = $init->getSession();
    //creating object of redirect class
    $redirect = $init->getRedirect();
    //creating object of vender class
    $vendor = Vendor::getInstance();
    $result=$vendor->lastdate();
     /* if(!$session->__get("roll")==2)
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
      }
      */
     //argument for profile pic class
$profile_pic=$vendor->profile_pic();
if(isset($_REQUEST['update_pic'])){
	move_uploaded_file($_FILES['file']['tmp_name'],BASE_PATH."uploads/" .$_SESSION['user_id']. $_FILES["file"]["name"]);
	chmod(BASE_PATH."uploads/" .$_SESSION['user_id']. $_FILES["file"]["name"],0777);
	$res=$vendor->update_profile_pic("uploads/" .$_SESSION['user_id']. $_FILES["file"]["name"],$_SESSION['user_id']);
	$redirect->redirect("");
    }
include("../include/header.php");
include("../include/header_menu.php");
?>
    <link href="<?php echo BASE_URL;?>/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
    <script src="<?php echo BASE_URL;?>/js/bootstrap.min.js"></script>
 
	<div class="banner bannerwithnoimg">
        <div class="container">
            <div class="bannertxt col-lg-12">
                <span class="page_heading">User Profile</span>
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
                    <a href="<?php echo BASE_URL?>/vendors/update">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 optionbox">
                    	<div class="options">
                            <img src="../images/profile.png" alt="profile">
                            <span class="profile_options">Edit User Information</span>
                        </div>
                    </div>
                    </a>
                    <a href="<?php echo BASE_URL?>/vendors/Billing_and_Payment">
		    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 optionbox">
                    	<div class="options">
                            <img src="../images/profile.png" alt="profile">
                    <span class="profile_options">Billing & Payment Information</span>
                        </div>
                    </div>
		   </a>
		   <a href="<?php echo BASE_URL;?>/vendors/change_password">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 optionbox">
                    	<div class="options">
                            <img src="../images/setting.png" alt="setting">
                            <span class="profile_options">Password Change</span>
                        </div>
                    </div>
		    </a>
		   <a href="#profile_pic" role="button" data-toggle="modal"  data-toggle="modal" values ="" >
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 optionbox">
                          	<div class="options">
                            <img src="../images/setting.png" alt="setting">
                            <span class="profile_options">Profile Picture Change</span>
                        </div>
                    </div>
                    </a>
           <div class="clearfix"></div>
		  
    </div>
        </div>
        
    </div>
   </div>
  <?php include("../include/footer.php");?>
    </div> <!-- /container -->
   
<div id="profile_pic" class="modal fade">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-header" headerBGstyle="height: 150px;" > <center>Update Profile Pic</center>
		<button type="reset" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<form action="" method="POST" name="frm" id="frm" enctype="multipart/form-data">
		    <center style="margin-top: 20px;"><input type="file" name="file" id="file"></center>
		    <center style="margin-top: 20px;"><input type="submit" name="update_pic" id="update_pic" value="Update"></center>
		</form>
	    </div>
	</div>
   </div>
</div>
</body>
</html>


  
