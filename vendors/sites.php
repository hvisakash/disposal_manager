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
include("../include/header.php");
include("../include/header_menu.php");
?>
	<div class="banner bannerwithnoimg">
        <div class="container">
            <div class="bannertxt col-lg-12">
                <span class="page_heading">SITES</span>
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
                        <span class="last_login">Last login:</span><span class="date"><?php echo $result['date'];?></span></div>
                    </div>
                    <div class="clearfix"></div>
		    <div class="clearfix"></div>
                    <a href="<?php echo BASE_URL?>/vendors/addNewsites">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 optionbox">
                    	<div class="options">
                            <img src="../images/profile.png" alt="profile">
                            <span class="profile_options">Add New Site</span>
                        </div>
                    </div>
                    </a>
		   <a href="<?php echo BASE_URL?>/vendors/editExistingSites">
                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 optionbox">
                    	<div class="options">
                            <img src="../images/profile.png" alt="profile">
                    <span class="profile_options">Edit Existing Site</span>
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
</body>
</html>
