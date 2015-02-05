<?php
//including initial file
require_once("../init.php");
//creating object of generator class
    $generator = Generators::getInstance();
    $result=$generator->lastdate();
    $session = $init->getSession();
    $redirect = $init->getRedirect();
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
    $profile_pic=$generator->profile_pic();
    $list=$generator->show_sites($_REQUEST['id']);
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
            </div>
            <!-- list shoew -->         
            <table cellspacing="15" cellpadding="15" id='tableid1' align="center" width="50%" class="table table-bordered">
                <tr>
                    <td>Site Name</td>
                    <td><?php echo $list['sitename']?></td>
                </tr>
                <tr>
                    <td>Company Name</td>
                    <td><?php echo $list['companyname']?></td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td><?php echo $list['departmentname']?></td>
                </tr>       
                <tr>
                    <td>First Name</td>
                    <td><?php echo $list['firstname']?></td>
                </tr>       
                <tr>
                    <td>Last Name</td>
                    <td><?php echo $list['lastname']?></td>
                </tr>       
                <tr>
                    <td>Email</td>
                    <td><?php echo $list['email']?></td>
                </tr>
                <tr>
                    <td>Address 1</td>
                    <td><?php echo $list['address1']?></td>
                </tr>       
                <tr>
                    <td>Address 2</td>
                    <td><?php echo $list['address2']?></td>
                </tr>       
                <tr>
                    <td>City</td>
                    <td><?php echo $list['city']?></td>
                </tr>       
                <tr>
                    <td>State</td>
                    <td><?php echo $list['state']?></td>
                </tr>       
                <tr>
                    <td>Zip Code</td>
                    <td><?php echo $list['zipcode']?></td>
                </tr>       
                <tr>
                    <td>EPA ID</td>
                    <td><?php echo $list['epa_id']?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?php echo $list['contactnumber']?></td>
                </tr>
                
                <tr>
                    <td>Fax Number</td>
                    <td><?php echo $list['fax']?></td>
                </tr>
               
            </table>
        </div>    <!-- /container -->
    </div>

    
  <?php include("../include/footer.php");?>

