<?php
//including initial file
include_once("init.php");

//creating object of session class
$session=$init->getSession();

//creating object of redirect class
$redirect=$init->getRedirect();

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
      <div class="form-signin" style="max-width:500px;">
	 <br>		
	 <div class="loginform">
	 <form method='post'  name='Register' class="form-signin-container Register" role="form">
	    <h2 class="form-signin-heading">Please Register</h2>
	    <div class="placeholders">
	       <input name='companyname' type='text' class="form-control" placeholder="Company Name" required autofocus/>
	    </div>
	    <div class="placeholders">
	       <input name='department' type='text' class="form-control" placeholder="Department" required autofocus/>
	    </div>
	    <div class="placeholders">
	       <input name='firstname' type='text' class="form-control" required autofocus placeholder="First Name"/>
	    </div>
	    <div class="placeholders">
	       <input name='lastname' type='text' class="form-control" required autofocus placeholder="Last Name"/>
	     </div>
	    <div class="placeholders">
	       <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
	     </div>
	    <div class="placeholders">
	       <input name='password' type='password' class="form-control" required autofocus id="password" placeholder="Password"/>
	     </div>
	    <div class="placeholders">
	       <input name='cpassword' type='password' class="form-control" required autofocus placeholder="Confirm Password"/>
	     </div>
	    <div class="placeholders">
	       <input name='address1' type='text' class="form-control" required autofocus placeholder="Address 1"/>
	     </div>
	    <div class="placeholders">
	       <input name='address2' type='text' class="form-control" required autofocus placeholder="Address 2"/>
	     </div>
	    <div class="placeholders">
	       <input name='city' type='text' class="form-control" required autofocus placeholder="City"/>
	     </div>
	    <div class="placeholders">
	       <input name='state' type='text' class="form-control" required autofocus placeholder="State"/>
	     </div>
	    <div class="placeholders">
	       <input name='zipcode' type='text' class="form-control" required autofocus placeholder="Zip Code"/>
	     </div>
	    <div class="placeholders">
	       <input name='epa_id' type='text' class="form-control" required autofocus id="epa" placeholder="EPA ID#"/>
	     </div>
	    <div class="placeholders">
	       <input name='contact' type='text' class="form-control" required autofocus placeholder="Phone Number"/>
	     </div>
	    <div class="placeholders">
	       <input name='fax' type='text' class="form-control" required autofocus placeholder="Fax Number"/>
	     </div>
	    
	       <select name="selectname">
		  <option value="2">Generator</option>
		  <option value="3">Vendor</option>
	       </select>
	
	       <input class="btn btn-lg btn-primary btn-block" name="btnsubmit" id="btnsubmit" type="submit" value="Register"/>	
		
		</form>
	 <br>
      </div>
   </div>
</div> <!-- /container -->

<?php include_once("include/footer.php");?>
</html>
<script>
jQuery(document).ready(function()
    {
    $(".Register").submit(function(e){
	e.preventDefault();
	var _this = $(e.target);
	var formData = $(this).serialize();
	    $.ajax
	    ({
	    type: "POST",
	     url: "ajax.php",
	    data: formData,
	     dataType: 'json',
	    success: function(data)
	       {
			    if (data.email=="false"){
	                alert("The email address entered is already in use.  Please enter a different email.");
	            }
	            else if(data.email=='true'){
					window.location = "signin";
			    }
	       }
	    });
	});
});

</script>
