<?php
//including initial file
include("../init.php");
    $generators = Generators::getInstance();
    $result=$generators->lastdate();
    $profile_pic=$generators->profile_pic();
    $session = $init->getSession();
    $redirect = $init->getRedirect();
        $session = $init->getSession();
    $redirect = $init->getRedirect();
    $generators = Generators::getInstance();
    $result=$generators->lastdate();
    if(!$session->__get("roll")==2)
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
    $profile_pic=$generators->profile_pic();
    if(isset($_REQUEST['update_pic'])){
	move_uploaded_file($_FILES['file']['tmp_name'],BASE_PATH."uploads/" .$_SESSION['user_id']. $_FILES["file"]["name"]);
    chmod(BASE_PATH."/uploads/" .$_SESSION['user_id']. $_FILES["file"]["name"],0777);
	$res=$generators->update_profile_pic("uploads/" .$_SESSION['user_id']. $_FILES["file"]["name"],$_SESSION['user_id']);
	$redirect->redirect("");
    }

?>
    <link href="<?php echo BASE_URL;?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/css/custom.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
    <script src="<?php echo BASE_URL;?>/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
  <?php

include("../include/header.php");
include("../include/header_menu.php");
?>

	<div class="banner bannerwithnoimg">
        <div class="container">
            <div class="bannertxt col-lg-12">
                <span class="page_heading">Current Payment Method</span>
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
                 <!---
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 optionbox">
                    	<div class="options">
                            <img src="../images/profile.png" alt="profile">
                            <span class="profile_options">current-payment-method</span>
                        </div>
                    </div>
                 --->
            
		    
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 optionbox">
                    	<div class="options">
                           <!-- <img src="../images/profile.png" alt="profile">
                    <!---<span class="profile_options">Billing & Payment Information</span>
                        
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="braj020290@gmail.com">
                        <input type="hidden" name="lc" value="US">
                        <input type="hidden" name="item_name" value="samsung toys">
                        <input type="hidden" name="item_number" value="ST02">
                        <input type="hidden" name="amount" value="2999.99">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="button_subtype" value="services">
                        <input type="hidden" name="no_note" value="0">
                        <input type="hidden" name="tax_rate" value="0.990">
                        <input type="hidden" name="shipping" value="2.99">
                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
 <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
       <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
             <span class="profile_options">Make Payment</span>
              </form>--->
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="KENZG4ZBETVSS">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


                        </div>
                    </div>
                    
		   <!---
		   <a href="<?php echo BASE_URL;?>/generators/change_password">
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
                    </a>  --->
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


  
