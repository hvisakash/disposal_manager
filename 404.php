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
<?php include_once("".BASE_PATH."include/header.php");
include_once("".BASE_PATH."include/header_menu.php");?>

   
   <div class="container">
	 <br>
	    <h1>Page Not Found</h1>   
	 
</div> <!-- /container -->
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include_once("include/footer.php");?>
</html>
