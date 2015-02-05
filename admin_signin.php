<?php
//including initial file
include_once("init.php");

//creating object of session class
$session=$init->getSession();

//creating object of redirect class
$redirect=$init->getRedirect();

   
//Checking email and password on submit   
if(isset($_POST['submit']))
{
   $array = array(
        "email" => $_POST['email'],
        "password" => $_POST['password']
    );
   //for paticular role
   if(isset($_REQUEST['paticular_role'])){
      $array['paticular_role']=$_REQUEST['paticular_role'];
   }
    $admin = Admin::getInstance();
    $result=$admin->login($array);
    
    //setting session if user is available in database
    if($result){
      
	    //Redirect page according to there role
	    if($result['roll']==1)
	    {
	       $session->__set("firstname",$result['firstname']);
	       $session->__set("roll",$result['roll']);
	       $session->__set("user_id",$result['id']);
	       $redirect->redirect("admin/");
	    }
	    else if($result['roll']==2)
	    {
	       //check valid or not valid functionality
	       if($result['account']==1)
	       {
	       $session->__set("firstname",$result['firstname']);
	       $session->__set("roll",$result['roll']);
	       $session->__set("user_id",$result['id']);
	       $redirect->redirect(BASE_URL."/generators/");
	       }
	       else{
		  ?>
		  <script>
		     alert("Your Account is Currently Not Active.");
		  </script>
		  <?php
	       }
	       
	    }
	    else if($result['roll']==3)
	    {
	       //check valid or not valid functionality
	       if($result['account']==1)
	       {
	       $session->__set("roll",$result['roll']);
	       $session->__set("firstname",$result['firstname']);
	       $session->__set("user_id",$result['id']);
	       $redirect->redirect(BASE_URL."/vendors/");
	       }
	       else{
		  ?>
		  <script>
		     alert("Your Account is Currently Not Active.");
		  </script>
		  <?php
	       }
	    }
	    else if($result['roll']==4)
	    {
	       $session->__set("roll",$result['roll']);
	       $session->__set("firstname",$result['firstname']);
	       $session->__set("user_id",$result['id']);
	       $redirect->redirect("administratorsr/");   
	    }   
   }
   else{
      ?>
      <script>
	 alert("Invalid Email or password");
      </script>
      <?php
   }
}
//Redirecting to home page if user is not logged in
   if($session->__get("roll")==1)
   {
      $redirect->redirect("admin/");
   }
   elseif($session->__get("roll")==2)
   {
     $redirect->redirect(BASE_URL."/generators/");
   }
   elseif($session->__get("roll")==3)
   {
      $redirect->redirect(BASE_URL."/vendors/");
   }

?>
<body>
<?php include_once("".BASE_PATH."include/header.php"); include_once("".BASE_PATH."include/header_menu.php");?>

   
   <div class="container">
      <div class="form-signin">
	 <br>		
	 <div class="loginform">
	 <form class="form-signin-container" role="form" name="login" method='post' id="login">
	    <h2 class="form-signin-heading">Please sign in</h2>
	    
	    <div class="placeholders">
	       <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
	       <i class="fa fa-user"></i>
	    </div>
	       
	    <a href="<?php echo BASE_URL?>/forgotLogin">I forgot login</a>
	    
	    <div class="placeholders">
	       <input type="password" name="password" class="form-control" placeholder="Password" required>
		  <i class="fa fa-lock"></i>
	    </div>
	    
	    <a href="<?php echo BASE_URL?>/forgotPassword">I forgot password</a>
	
	    <input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Sign in"/>

	    <div class="newuser">New user? <a href="<?php echo BASE_URL?>/New_Users">Create An Account</a></div>
      	</form><br>
      </div>
   </div>
</div> <!-- /container -->

<?php include_once("include/footer.php");?>
</html>
