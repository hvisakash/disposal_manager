<?php
//including initial file
include("../init.php");
  //creating object of session class  
  $session = $init->getSession();
  //creating object of redirect class
  $redirect = $init->getRedirect();
  //creating object of vender class
  $vendor = Vendor::getInstance();
  //object for last login date
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
  // add new site for vendor
  if(isset($_POST['add'])){
  $array = array(
    "sitename"=>$_POST['sitename'],
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
    $res=$vendor->add_new_sites($array,$_SESSION['user_id'],$result['add_by']);
 if($res==false)
    {
      ?><script>
	alert("Your Sites Limit Is Complit");
      </script>
      <?php
     }
}
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
          <div class="profile_pic">
            <img src="<?php echo BASE_URL;?>/<?php echo $profile_pic['image_src'];?>" alt="profile pic" width="87" height="87">
          </div>
          <span class="name"><?php echo $result['firstname'];?></span><br/>
          <span class="last_login">Last Login :</span><span class="date"><?php echo $result['date'];?></span>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-signin" style="max-width:500px;">
     	<div class="loginform">
          <form class="form-signin-container" role="form" name="new_sites" method='post' id="new_sites">
	      <h2 class="form-signin-heading">Add New Site</h2>
              <div class="placeholders">
                <input type="text" name="sitename" class="form-control" placeholder="New Site Name" id="addnewsite" required autofocus>
            	</div>
              <div class="placeholders">
                <input type="text" name="companyname" class="form-control" placeholder="Company Name" id="companyname" required autofocus>
              </div>
              <div class="placeholders">
                <input type="text" name="department" class="form-control" placeholder="Department Name" id="department" required autofocus>
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
                <input type="text" name="address2" class="form-control" placeholder="Address2" id="address2"  autofocus>
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
              <input class="btn btn-lg btn-primary btn-block" name="add" type="submit" value="ADD"/>
      	</form>
	</div>
      </div>
    </div>
  </div>
</div>
<?php include("../include/footer.php");?>