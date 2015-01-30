<?php
//including initial file
require_once("../init.php");
    //creating object of Admin class
    $admin = Admin::getInstance();
    //creating object of generator class
    $result=$admin->lastdate();
    // object for profile pic
    $profile_pic=$admin->profile_pic();
    //object for session class
    $session = $init->getSession();
    //object for redirect class
    $redirect = $init->getRedirect();
    //check session functionality
    if(!$session->__get("roll")==1)
    {
	$redirect->redirect("../signin");
    }
    elseif($session->__get("roll")==2)
    {
	$redirect->redirect("../generators");
    }
    elseif($session->__get("roll")==3)
    {
	$redirect->redirect("../vendors");
    }
    //show globle setting 
    $list=$admin->show_globle_setting_record();
    if(isset($_POST['btnsubmit']))
	{
	$array = array(
	    "free_profile_allow" => $_POST['free_profile_allow'],
	    "free_sites_allow" => $_POST['free_sites_allow'],
	    "price" => $_POST['price'],
	    "sites_allow" => $_POST['sites_allow'],
	    "profile_allow" => $_POST['profile_allow'],
	    "no_vendor" => $_POST['no_vendor'],
	    );
	    $admin->update_globle_setting_for_all($array);
	}
// includding header portion
  include("../include/header.php");
  include("../include/header_menu.php");?>


	<div class="banner bannerwithnoimg">
	    <div class="container">
		<div class="bannertxt col-lg-12">
		    <span class="page_heading">Global Settings</span>
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
            </div>
            <!-- list shoew -->
	    <form method='post' >
            <table cellspacing="15" cellpadding="15" id='tableid1' align="center"  class="table table-bordered">
		<tr>
		    <td>Free Profile Allowed</td>
		    <td><input name='free_profile_allow' type='text' value='<?php echo $list['free_profile_allow']?>' /></td>
		</tr>
		<tr>
		    <td>Free Sites Allowed</td>
		    <td><input name='free_sites_allow' type='text' value='<?php echo $list['free_sites_allow']?>' /></td>
		</tr>
		
		<tr>
		    <td>Default Elite Price</td>
		    <td><input name='price' type='text' value='<?php echo $list['price']?>'/></td>
		</tr>
		
		<tr>
		    <td>Elite Sites Allows</td>
		    <td><input name='sites_allow' type='text' value='<?php echo $list['sites_allow']?>' /></td>
		</tr>
		<tr>
		    <td>Elite Profiles Allow</td>
		    <td><input name='profile_allow' type='text' value='<?php echo $list['profile_allow']?>' /></td>
		</tr>
		
		<tr>
		    <td>Elite Vendors Allowed Per Generator</td>
		    <td><input name='no_vendor' type='text' value='<?php echo $list['no_vendor']?>' /></td>
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
</body>
</html>
