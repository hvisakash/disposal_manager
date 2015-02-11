<?php
include_once(dirname(__DIR__)."/init.php");
//Initializing session and redirect method
    $session = $init->getSession();
    $redirect = $init->getRedirect();
?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disposal Manager</title>
    <!-- css for bootstrap-->
    <link href="<?php echo BASE_URL;?>/css/bootstrap.min.css" rel="stylesheet"/>
    <!--custom css-->
    <link href="<?php echo BASE_URL;?>/css/custom.css" rel="stylesheet" />
    <!-- Style for validation error -->
   
    <script>
	var generators_url="<?php echo BASE_URL;?>/admin/ajaxcalling.php";
    </script>
    <script src="<?php echo BASE_URL;?>/js/jquery-1.10.2.js"></script>
    <script src="<?php echo BASE_URL;?>/js/jquery.validate.js"></script>
    <script src="<?php echo BASE_URL;?>/js/MyVal.js"></script>
    <script>
	//redirect start profile page if user click a button in generator section
	$(document).ready(function(){
	$(".previous").click(function(){
	    var url = "<?php echo BASE_URL;?>/generators/profiles-page";
	    $(location).attr("href", url);
	    alert(" ");
	});
	//show table for elite or free in admin section
	$("#elite").click(function(){
	  $("#price").show();
	});
	$("#free").click(function(){
	  $("#price").hide();
	});
	
	$(".global_free").click(function(){
	  $(".table_global_free").show();
	  $(".table_global_elite").hide();
	});
	$(".global_elite").click(function(){
	  $(".table_global_elite").show();
	  $(".table_global_free").hide();
	});
    });
    </script>

    <script>
	$(document).ready(function(){
	$("#yes").click(function(){
	     $(".tab_show").show();
	});
	$("#no").click(function(){
	     $(".tab_show").hide();
	});

   });
    </script>
    <style>
    label.error
    {
	color:#900;	
    }
    </style>
</head>
<body>
<div class="header_top">
    <div class="container ">
      	<ul class="col-lg-4 pull-right social">
	    <?php
	    //check if user logged in or not
		if($session->__get("firstname"))
		{?>
		<li><a class="login" href="<?php echo BASE_URL;?>/logout.php">Logout</a></li>
		<?php }
		else{ ?>
		    <li><a class="login" href="signin">Login</a></li>    
		<?php } ?>
	<!--Social Links-->
	    <li><a id="fb" href="#">Facebook</a></li>
            <li><a id="twi" href="#">Twitter</a></li>
            <li><a id="link" href="#">Linkdin</a></li>
         </ul>
    </div>
</div>
</body>
</html>