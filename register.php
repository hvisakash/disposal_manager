<?php
include("init.php");
if(isset($_POST["submit"]))
{
	$array = array(
        "firstname" => $_POST['firstname'],
        "lastname" => $_POST['lastname'],
	//"username" => $_POST['username'],
	"email" => $_POST['email'],
        "password" => $_POST['password']
    );
print_r($array);

//	$user=User::getInstance();
//	$user->register($array);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disposal Manager</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    </head>
	    
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery.validate.js"></script>
    	<script src="js/MyVal.js"></script>
    	<style>
    	label.error
    	{
    	    color:#900;	
    	}
    	</style>
    <body>
<div class="container">
    <div class="form-signin">
     <div class="brand-logo"><img src="images/disposal_logo.png" alt="brand logo"></div>		
     <div class="loginform">
	<form class="form-signin-container" role="form" name="frm" method='post' id="frm">
            <h2 class="form-signin-heading">Register</h2>
            <div class="placeholders">
                <input type="text" name="firstname" class="form-control" placeholder="First Name" id="firstname">
            </div>
            <div class="placeholders">
                <input type="text" name="lastname" class="form-control" placeholder="Last Name">
            </div>
	    <div class="placeholders">
                <input type="text" name="username" class="form-control" placeholder="User Name">
            </div>
                    
		<div class="placeholders">
            
                <input type="text" name="email" class="form-control" placeholder="Email Address" id="email">
            </div>
            <div class="placeholders">
                <input type="password" name="password" class="form-control" placeholder="Password" id="password">
            </div>
            <div class="placeholders">
                <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" id="cpassword">
            </div>
            <input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Register"/>
      	</form>
      </div>
   </div>
</div>
</html>
