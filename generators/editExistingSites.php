<?php
//Including initial file
require_once("../init.php");
//Creating object of generator class
$generator = Generators::getInstance();
//Display last login date
$result=$generator->lastdate();
//Create session class object
$session = $init->getSession();
//Create redirect class object
$redirect = $init->getRedirect();
//Check session functionality    
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
  //Display profile pic 
   $profile_pic=$generator->profile_pic();
//Show sites for generator   
$row=$generator->select_sites($session->__get("user_id"));
//Update generator function call with two arg
if(isset($_POST['update']))
{
$array = array(
   "site_id"=>$_POST['site_id'],
  "sitename"=>$_POST['sitename'],
  "companyname" => $_POST['companyname'],
  "department" => $_POST['departmentname'],
  "firstname" => $_POST['firstname'],
  "lastname" => $_POST['laststname'],
  "email" => $_POST['email'],
  "address1" => $_POST['address1'],
  "address2" => $_POST['address2'],
  "city" => $_POST['city'],
  "state" => $_POST['state'],
  "zipcode" => $_POST['zipcode'],
  "epa_id" => $_POST['epaid'],
  "contact" => $_POST['contactnumber'],
  "fax" => $_POST['fax'],
  );
//Edit the specific sites
$generator->edit_existing_sites($array);
}
// includding header portion
include("../include/header.php");
include("../include/header_menu.php");?>
<html>
 <body>
<div class="banner bannerwithnoimg">
			<div class="container">
                        <div class="bannertxt col-lg-12">
                            <span class="page_heading">Edit Existing Site</span>
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
                        <span class="last_login">Last login:</span>
                        <span class="date"><?php echo $result['date'];?></span>
		    </div>
                </div>
                        <div class="options">
                                    <div class="profile_options">
            
                                    </div>.
                                    
                                    <div class="options">
                    <div class="profile_options">
			   <!-- <a href="../generators/addNewsites" title="Add New Generator" class="link" data-toggle="modal">Add New Sites</a>-->
		    </div>
                </div>
	    </div>
	    <!--SITES LIST SHOW BELOW -->		    
	    <table class="table table-bordered" id="show" vspace="50" hspace="50">
		<thead>
		    <tr class="last_login">
                    <th>Site Name</th>
		    <th>City</th>
		    <th>State</th>
                    <th>Edit</th>
            </tr>
		</thead>
		<tbody class="last_login">
		    <?php foreach($row as $site_name)
		    {
		    ?>
		    <tr>
	    <td><a href="<?php echo BASE_URL;?>/generators/View_sites/<?php echo $site_name['id'];?>" ><?php echo $site_name['sitename']?></a></td>
            <td><?php echo $site_name['city'];?></td>
	    <td><?php echo $site_name['state'];?></td>
	    
	    <td><a href="#link1" id="<?php echo $site_name['id'];?>" title="Edit" class="link select_id btn btn-success" data-toggle="modal">Edit</a></td>
		    <?php
		    }
		    ?>
		</tbody>
	    </table>
                        </div><br/><br/><br/>
                    
<?php include("../include/footer.php");?>
            
   </body>
</html>

<!-- popup is start-->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../js/bootstrap.min.js"></script>
<!--end of popup-->

<script>
$(document).ready(function(){
  $(".select_id").click(function(e)
  { 
    select_id=this.id;
    var info = 'site_id=' + select_id;
    $.ajax({
	  type: "POST",
	  url: "ajaxcalling.php",
	  data: info,
	  dataType: 'json',
	  success: function(data)
	  {
	    if (data)
	    {
	    $('.two tr').html('<tr><input name="site_id" type="hidden" value="'+data.id+'"/><td>Site Name </td><td><input name="sitename" type="text" value="'+data.sitename+'" /></td></tr><tr><td>Company Name</td><td><input name="companyname" type="text" value="'+data.companyname+'" /></td></tr><tr><td>Department Name </td><td><input name="departmentname" type="text" value="'+data.departmentname+'" /></td></tr><tr><td>First Name </td><td><input name="firstname" type="text" value="'+data.firstname+'" /></td></tr><tr><td>Last Name </td><td><input name="laststname" type="text" value="'+data.lastname+'" /></td></tr><tr><td>Email </td><td><input name="email" type="text" value="'+data.email+'" /></td></tr><tr><td>Address1 </td><td><input name="address1" type="text" value="'+data.address1+'" /></td></tr><tr><td>Address2 </td><td><input name="address2" type="text" value="'+data.address2+'" /></td></tr><tr><td>City </td><td><input name="city" type="text" value="'+data.city+'" /></td></tr><tr><td>State </td><td><input name="state" type="text" value="'+data.state+'" /></td></tr><tr><td>Zip Code </td><td><input name="zipcode" type="text" value="'+data.zipcode+'" /></td></tr><tr><td>EPA ID#</td><td><input name="epaid" type="text" value="'+data.epa_id+'" /></td></tr><tr><td>Phone Number</td><td><input name="contactnumber" type="text" value="'+data.contactnumber+'" /></td></tr><tr><td>Fax Number</td><td><input name="fax" type="text" value="'+data.fax+'" /></td></tr><tr><td><input name="add_user_id" type="hidden" value="'+data.add_user_id+'" /></td><td><input type="submit" name="update" class="btn btn-success" value="Update"></td></tr>');
	    }
	  }
	});
  });
});                    
</script>
<!--poup -->
<a href="#link1" class="link" data-toggle="modal"></a>
<div id="link1" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header headerBG">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title text-left">
	<form method='post' >
	<table cellspacing="15" cellpadding="15" id='show' align="center"  class="table two">
	<tr>
	</tr>
	</table>
	</form> 
      </div>
    </div>
  </div>
</div>   
