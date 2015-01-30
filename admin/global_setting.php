<?php
//including initial file
require_once("../init.php");
    //creating object of Admin class
    $admin = Admin::getInstance();
    //creating object of generator class
    //$generator = Generators::getInstance();
    //object create for last date
    $result=$admin->lastdate();
    //object create for profile pic
    $profile_pic=$admin->profile_pic();
    //object create for session
    $session = $init->getSession();
    //object create for redirect class
    $redirect = $init->getRedirect();
    // manage session functionality
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
    //show globle setting record for free account
    $list=$admin->show_globle_setting_free_record($_REQUEST['id']);
   //show globle setting record for elite account
    $elite_list=$admin->show_globle_setting_elite_record($_REQUEST['id']);
    
    if(isset($_POST['free']))
	{
	$array = array(
	    "account_type" => $_POST['account_type'],
	    "profile_allow" => $_POST['profile_allow'],
	    "no_site" => $_POST['no_site'],
	    "no_vendor" => $_POST['no_vendor'],
	    "sites_vendor" => $_POST['sites_vendor'],
	    );
	    $admin->update_globle_setting_free_record($array,$_REQUEST['id']);
	}
	if(isset($_POST['elite']))
	{
	$array = array(
	    "account_type" => $_POST['account_type'],
	    "no_site" => $_POST['no_site'],
	    "profile_allow" => $_POST['profile_allow'],
	    "no_site" => $_POST['no_site'],
	    "no_vendor" => $_POST['no_vendor'],
	    "price" => $_POST['price'],
	    "elite_vendor_price" => $_POST['elite_vendor_price'],
	    "elite_sites_vendor" => $_POST['elite_sites_vendor'],
    
	    );
	    $admin->update_globle_setting_elite_record($array,$_REQUEST['id']);
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
	    
            <table cellspacing="15" cellpadding="15" id='tableid' align="center"  class="table table-bordered">
		<tr>
		    <td>Account Type</td>
		    <td>
			Free :<input name='account_type' type='radio' id="free" value='free' class="global_free" required autofocus/>
			Elite :<input name='account_type' type='radio' id="elite" value='elite' class="global_elite"  required autofocus/>
		    </td>
		</tr>
		<tr>
		    <td>Global Password Reset For All generator</td>
		    <td><button onclick="myFunction(this.value)" class= "btn btn-success" role="button">Reset Password</button></td>
		    
		</tr>
	    </table>
	    <form method='post' >
	    <table cellspacing="15" cellpadding="15"   style="display: none;" align="center"  class="table table-bordered table_global_free"  >
		<tr>
		    <td>Account Type</td>
		    <td>
			Free <input name='account_type' type='hiddn' value='free' style="display: none;"/>
			
		    </td>
		</tr>
		<tr>
		    <td>Profile Allow</td>
		    <td><input name='profile_allow' type='text' value='<?php echo $list['profile_allow']?>' required autofocus/></td>
                </tr>
		<tr>
		    <td>Sites Allowed Per Generator</td>
		    <td><input name='no_site' type='text' value='<?php echo $list['no_site']?>' required autofocus/></td>
                </tr>
		<tr>
		    <td>Vendors Allowed Per Generator</td>
		    <td><input name='no_vendor' type='text' value='<?php echo $list['no_vendor']?>' /></td>
		</tr>
		<tr>
		    <td>Sites Allowed per Vendor</td>
		    <td><input name='sites_vendor' type='text' value='<?php echo $list['sites_vendor']?>' /></td>
		</tr>
		<tr>
		    <td><input name="free" type='submit' value='Update' class='btn btn-success' style="margin-left: 150px; margin-top:10px;"/></td>
		</tr>
            </table>
	    </form>
	    <form method='post' >
	    <table cellspacing="15" cellpadding="15" align="center"  class="table table-bordered table_global_elite"  style="display: none;" >
		 <td>Account Type</td>
		    <td>
			Elite <input name='account_type' type='hiddn' value='elite' style="display: none;"/>
		    </td>
		<tr >
		    <td>Default Elite For Generator Price</td>
		    <td><input name='price' type='text' value='<?php echo $elite_list['price']?>'/></td>
		</tr>
		<tr >
		    <td>Profile Allow</td>
		    <td><input name='profile_allow' type='text' value='<?php echo $elite_list['profile_allow']?>' required autofocus/></td>
                </tr>
		<tr>
		    <td>Sites Allowed Per Generator</td>
		    <td><input name='no_site' type='text' value='<?php echo $elite_list['no_site']?>' required autofocus/></td>
                </tr>
		<tr>
		    <td>Vendors Allowed per Generator</td>
		    <td><input name='no_vendor' type='text' value='<?php echo $elite_list['no_vendor']?>' /></td>
		</tr>
		<tr >
		    <td>Default Elite Price For Vendor</td>
		    <td><input name='elite_vendor_price' type='text' value='<?php echo $elite_list['elite_vendor_price']?>'/></td>
		</tr>
		
		<tr>
		    <td>Sites Allowed Per Vendor</td>
		    <td><input name='elite_sites_vendor' type='text' value='<?php echo $elite_list['elite_sites_vendor']?>' /></td>
		</tr>
		<tr>
		    <td><input name="elite" type='submit' value='Update' class='btn btn-success' style="margin-left: 150px; margin-top:10px;"/></td>
		</tr>
            </table>
	    </form>
	</div>
	<!-- /container -->
    </div>
  <?php include("../include/footer.php");?>
  
</body>
</html>
<script>
function myFunction() {
    if (confirm("Are you Sure ?") == true) {
    var password = prompt("Please Enter New Password");
    if (password) {
    var info = 'global_password=' + password;
    $.ajax({
	   type: "POST",
	    url: "<?php echo BASE_URL;?>/admin/ajaxcalling.php",
	    data: info,
	    dataType: 'json',
	    success: function(data)
		{
		    if(data==1)
		    {
			alert("Password is Changed For All Generator");
		    }
    		}
    	    });
    }
}}
</script>
