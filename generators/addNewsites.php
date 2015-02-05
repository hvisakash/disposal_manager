<?php
//including initial file
include("../init.php");
if(isset($_GET["sitename"]))
{
  $sitename=$_GET["sitename"];
}
else{
$sitename="";
}    //object for generator class
    $generators = Generators::getInstance();
    //display last login date
    $result=$generators->lastdate();
    //object for profile pic
    $profile_pic=$generators->profile_pic();
    //object for session class
    $session = $init->getSession();
    // object for redirect class
    $redirect = $init->getRedirect();
    //session functionality
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
    //add new site argument
    if(isset($_POST['add'])){
    $name=$session->__get("firstname");
    $array = array("sitename"=>$_POST['sitename'],
    "companyname" => $_POST['companyname'],
    "department" => $_POST['department'],
    "firstname" => $_POST['firstname'],
    "lastname" => $_POST['lastname'],
    "email" => $_POST['email'],
    "address1" => $_POST['address1'],
    "address2" => $_POST['address2'],
    "city" => $_POST['city'],
    "state" => $_POST['state'],
    "zipcode" => $_POST['zipcode'],
    "epa_id" => $_POST['epa_id'],
    "contact" => $_POST['contact'],
    "fax" => $_POST['fax'],
    );
    $res=$generators->add_new_sites($array,$_SESSION['user_id'],$result['add_by']);
    if($res==1)
    {
      if(isset($_GET["sitename"]))
      {
	//redirect service page 
 	$redirect->redirect("".BASE_URL."/generators/Services");
      }else{
	
	$redirect->redirect("".BASE_URL."/generators/sites");
      }
      
    }
    
    else if($res==false)
    {
      ?><script>
	alert("Your Sites Limit Is Complit");
      </script>
      <?php
     }
    
    }
    if(isset($_POST['Cancel']))
    {
      $redirect->redirect("".BASE_URL."/generators/profiles-page");
    }
include("../include/header.php");
include("../include/header_menu.php");
?>

<div class="banner bannerwithnoimg">
  
  <div class="container">
    
    <div class="bannertxt col-lg-12">
        <span class="page_heading">Add New Site</span>
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
          <div class="profile_pic">
            <img src="<?php echo BASE_URL;?>/<?php echo $profile_pic['image_src'];?>" alt="profile pic" width="87" height="87">
          </div>
          <span class="name"><?php echo $result['firstname'];?></span><br/>
          <span class="last_login">Last login:</span><span class="date"><?php echo $result['date'];?></span>
        </div>
      </div>
      
      <div class="clearfix"></div>
                  	
      <div class="form-signin" style="max-width:500px;">
     		<div class="loginform">
          <form class="form-signin-container" role="form" name="new_sites" method='post' id="new_sites">
            <h2 class="form-signin-heading">Add New Site</h2>
              <div class="placeholders">
                <input type="text" name="sitename" value="<?php echo $sitename ?>" class="form-control" placeholder="New Site Name" id="addnewsite" required autofocus>
            	</div>

              <div class="placeholders">
                <input type="text" name="companyname" class="form-control" placeholder="Company Name" id="companyname" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="department" class="form-control" placeholder="Department Name" >
              </div>

              <div class="placeholders">
                <input type="text" name="firstname" class="form-control" placeholder="First Name" id="firstname" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="lastname" class="form-control" placeholder="Last Name" id="lastname" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="email" class="form-control" placeholder="Email" id="email" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="address1" class="form-control" placeholder="Address1" id="address1" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="address2" class="form-control" placeholder="Address2" >
              </div>

              <div class="placeholders">
                <input type="text" name="city" class="form-control" placeholder="City" id="city" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="state" class="form-control" placeholder="State" id="state" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="zipcode" class="form-control" placeholder="Zipcode" id="zipcode" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="epa_id" class="form-control" placeholder="EPA ID#" id="epa_id" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="contact" class="form-control" placeholder="Phone Number" id="contact" required autofocus>
              </div>

              <div class="placeholders">
                <input type="text" name="fax" class="form-control" placeholder="Fax" id="fax" required autofocus>
              </div>
              
              <input class="btn btn-lg btn-primary btn-block" name="add" type="submit" value="Save"/>
	      <?php
	      if(isset($_GET["sitename"]))
		{ ?>
		<input class="btn btn-lg btn-primary btn-block" name="Cancel" type="button" value="Cancel" id="cancel"/>
		<?php }
	      ?>
      	</form>
      </div>
   </div>
</div>

                    <div class="options">
                    </div>
                    </div>
		  
                   
		   <div class="clearfix"></div>
	    </div>
        </div>
        
    </div>
   </div>
  <?php include("../include/footer.php");?>
    </div> <!-- /container -->
</body>
</html>
<script>
   $(function() {
    $("#cancel").click(function(){
      window.location.replace('<?php echo BASE_URL?>/generators/profiles-page');
      });
    
    }); 
</script>