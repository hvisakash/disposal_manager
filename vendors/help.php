<?php
//including initial file
include("../init.php");
// create object for session class
    $session = $init->getSession();
// create object for redirect class
    $redirect = $init->getRedirect();
// create object for vendors class
    $vendor = Vendor::getInstance();
// create object for profile pic
    $profile_pic=$vendor->profile_pic();
    //if(!$session->__get("firstname")){
	//$redirect->redirect("../admin_signin.php");
    //}
   /* if(!$session->__get("roll")==1)
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
    }*/
    if(isset($_POST['submit']))
    {
    $array = array(
        "firstname" => $_POST['firstname'],
        "contact" => $_POST['contact'],
	"email" => $_POST['email'],
        "problem" => $_POST['problem']
    );
    $result=$vendor->help($array);
	if($result)
	{
	    $mail = Mail::getInstance();
	    $mail->send($array);
	}
    }
    // includding header portion
    include("../include/header.php");
    include("../include/header_menu.php");
?>
	<div class="banner bannerwithnoimg">
        <div class="container">
            <div class="bannertxt col-lg-8">
                <span class="page_heading">Help Page</span>
                <span class="page_txt">Aliqat volutpasac tupis. Integer rutrum ante eu lacuestibulum libero nisl porta vel sceleris que eget</span>
            </div>
        </div>
  	</div>
   
   <div class="main_div">
   	<div class="container">
    	<div class="row">
        	<div class="col-lg-8">
            	<h2 class="heading_bg">Send us message</h2>
                <div class="content">
                    	<form role="form" method="post">
                          <div class="form-group">
                            <label>Your Name:</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Your Name" required autofocus>
                          </div>
                          
                          <div class="form-group">
                            <label>Phone Number:</label>
                            <input type="text" name="contact" class="form-control" placeholder="Phone Number" required autofocus>
                          </div>
                          <div class="form-group">
                            <label>Email Address:</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
                          </div>
                          <div class="form-group">
                            <label>Description of problem:</label>
                            <textarea class="form-control" rows="3" name="problem" required autofocus></textarea>
                           <!-- <input type="text" class="form-control" placeholder="">-->
                         
			  </div>
			  <div class="clearfix"></div>
                          
                          <div>
                            <input type="submit" name="submit" class="btn btn-default submit" value="Submit"/>
                          </div>	
                          </form>
                    
                    
                </div>
            </div>
        </div>
        
    </div>
   </div>
   <?php include("../include/footer.php");?>
    </div> <!-- /container -->
</body>
</html>
