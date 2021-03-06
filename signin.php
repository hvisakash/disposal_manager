<?php
//including initial file
include("init.php");
if(isset($_POST['submit']))
{
   $array = array(
        "email" => $_POST['email'],
        "password" => $_POST['password']
    );
    $user = User::getInstance();
    $result=$user->login($array);
    if($result)
    {
        header('Location:userprofile.php');
    }
    else{?>
    //alert when username/email or password is incorrect
	<script>
	  alert("Invalid user name and/or password");
	</script>
	<?php	
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disposal Manager</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery.validate.js"></script>
    	<script src="js/MyVal.js"></script>
    	<style>
    	label.error
    	{
    	    color:#900;	
    	}
    	</style>
    
    </head>
    <body>
    <div class="container">
    <div class="form-signin">
    <div class="brand-logo"><img src="images/disposal_logo.png" alt="brand logo"></div>		
     <div class="loginform">
	<form class="form-signin-container" role="form" name="frm" method='post' id="frm">
     	<h2 class="form-signin-heading">Please sign in</h2>
        <div class="placeholders">
	<input type="text" name="email" class="form-control" placeholder="Username" required autofocus> <i class="fa fa-user"></i></div>
        <a href="#">Forgot login?</a>
        <div class="placeholders"><input type="password" name="password" class="form-control" placeholder="Password" required><i class="fa fa-lock"></i></div>
        <a href="#">Forgot password?</a>
	<input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Sign in"/>
`        <div class="newuser">New user? <a href="register.php">Create An Account</a></div>
      	</form>
      </div>
   </div>

    </div> <!-- /container -->
</html>