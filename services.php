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
                <span class="page_heading">Services</span>
                <span class="page_txt">Benefits of Our System</span>
            </div>
        </div>
  	</div>
   
   <div class="main_div">
   <div class="leftshade"><img src="images/leftshade.png" alt="left shade"></div>
   <div class="rightshade"><img src="images/rightshade.png" alt="left shade"></div>
   	<div class="container">
    	<div class="row">
        	<div class="col-lg-12">
            	<h2 class="heading_bg">Ease of Use</h2>
                <div class="content">
                    <div class="aboutusimg col-lg-5 col-md-5 col-sm-5 col-xs-5"><img src="images/aboutus.png" alt="aboutus"></div>
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 fl_right text">
                        <p>Generators, our system is designed to work with a single location or multiple locations.  First, our interactive profiling guide walks the user step-by-step through the profiling process.  These variables are saved into your own encrypted user interface.  Once complete, simply search for and select a Vendor.  Our system populates the required forms and submits to the Vendor for approval and pricing.  Future orders can be sent the same disposal company if desired.  Also, all of your regulatory paperwork can be stored in your user interface granting you access to your disposal documents anywhere you have access to a computer.</p>
                        <p>Vendors, imagine a website that custom matches generators with the services your organization provides.  The profiling process is the most tedious part of accepting waste; and, missing information results in loss time revenue and delays.  Improve your sales cycle and increase  your efficiencies by using our system.</p>
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