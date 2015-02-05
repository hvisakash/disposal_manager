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
            <div class="bannertxt col-lg-12">
                <span class="page_heading">Contact Us</span>
            </div>
        </div>
  	</div>
   
   <div class="main_div">
   <div class="leftshade"><img src="images/leftshade.png" alt="left shade"></div>
   <div class="rightshade"><img src="images/rightshade.png" alt="left shade"></div>
   	<div class="container">
    	<div class="row">
        	<div class="col-lg-12">
            	<h2 class="heading_bg">Send Us A Message</h2>
                <div class="content">
                    <div class="contactus col-lg-6 col-md-6 col-sm-7 col-xs-8">
                    	<form role="form">
                          <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" placeholder="">
                          </div>
                          <div class="form-group">
                            <label>Address1:</label>
                            <input type="text" class="form-control" placeholder="">
                          </div>
                          <div class="form-group">
                            <label>Address2:</label>
                            <input type="text" class="form-control" placeholder="">
                          </div>
                          <div class="form-group">
                            <label>City:</label>
                            <input type="text" class="form-control" placeholder="">
                          </div>
                          <div class="form-group">
                            <label>State:</label>
                            <input type="text" class="form-control" placeholder="">
                          </div>
                          <div class="form-group">
                            <label>Zip:</label>
                            <input type="text" class="form-control" placeholder="">
                          </div>
                          <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" class="form-control" placeholder="">
                          </div>
                          <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" placeholder="">
                          </div>
                          <div class="form-group">
                            <label>Describe <br/>Question:</label>
                            <textarea class="form-control" rows="3"></textarea>
                           <!-- <input type="text" class="form-control" placeholder="">-->
                          </div>
                          <div class="clearfix"></div>
                          <div class="">
                          	<button type="submit" class="btn btn-default submit">Submit</button>
                          </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-4 address">
                        <p>
                            One of our representatives will </br>
                            respond to your message as quickly</br>
                            as possible.</br>
                            Email:   <a href="mailto:support@disposalmanager.com">support@disposalmanager.com</a>
                        </p>
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