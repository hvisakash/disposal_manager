<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disposal Manager</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
      </head>

  <body>
<?php
include("include/header.php");
include("include/header_menu.php");
?>
	<div class="banner bannerwithnoimg">
        <div class="container">
            <div class="bannertxt col-lg-12 ">
                <span class="page_heading">About Us</span>
                <span class="page_txt">Who We Are</span>
            </div>
        </div>
  	</div>
   
   <div class="main_div">
   <div class="leftshade"><img src="images/leftshade.png" alt="left shade"></div>
   <div class="rightshade"><img src="images/rightshade.png" alt="left shade"></div>
   	<div class="container">
    	<div class="row">
        	<div class="col-lg-12">
            	<h2 class="heading_bg">Environmental Solutions for Everyone</h2>
                <div class="content">
                    <div class="aboutusimg col-lg-5 col-md-5 col-sm-5 col-xs-5"><img src="images/aboutus.png" alt="aboutus"></div>
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 fl_right text">
                        <p>Our teams consists of environmental professionals with a total of 60 years in the environmental industry.  Disposing of waste is a tedious process made so my the rules and regulations of several governing authorities.  Most companies are scared to ask questions believing they might expose their organizations to adverse legal action.  We believe we have found a way to help.</p>
                        <p>Disposal Manager is more than just a website.  It is an interactive guide that helps you create profiles, track regulatory documents and keep your disposal paperwork in order.  And, we match your needs with qualified vendors within your geographic proximity.  And once you are setup, our application saves the waste information so you can submit for additional pick-ups in the future.  Did we mention our service is free?</p>
                    </div>
                </div>
            </div>
        </div>
	<div class="row">
        	<div class="col-md-6 col-sm-6 btns r_align">
            	<a class="blue_btn" href="<?php echo BASE_URL;?>/signin/2">Generator</a>
            </div>
            <div class="col-md-6 col-sm-6 btns">
            	<a class="green_btn" href="<?php echo BASE_URL;?>/signin/3">Vendor</a>
            </div>
        </div>
        
    </div>
   </div>
   
   
      

 <?php include("include/footer.php");?>
    </div> <!-- /container -->
</body>
</html>