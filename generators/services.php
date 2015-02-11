<?php
//including initial file
include("../init.php");
    //creating object of session class  
    $session = $init->getSession();
    //creating object of redirect class
    $redirect = $init->getRedirect();
    //creating object of vender class
    $generators = Generators::getInstance();
    //object for last login date
    $result=$generators->lastdate();
    //check session functionality
    if(!$session->__get("roll")==2)
    {
	$redirect->redirect("../signin");
    }
        elseif($session->__get("roll")==1)
    {
        $redirect->redirect("../admin");
    }
    elseif($session->__get("roll")==3)
    {
        $redirect->redirect("../vendors");
    }
  //argument for profile pic class
    $profile_pic=$generators->profile_pic();
    //
    if(isset($_POST["next"]))
    {
	$service=$generators->service_type($_POST['radio']);
	$session->__set("service_id",$service['mat_id']);
	$session->__set("service_material",$service['material']);
	$redirect->redirect("".BASE_URL."/generator/Services/".$_POST['radio']."");
    }
    
    // includding header portion
    include("../include/header.php");
    include("../include/header_menu.php");
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
    <div class="container">
	<div class="row">
	    <div class="col-lg-12">
		<div class="">
		    <div class="profile_pic"><img src="<?php echo BASE_URL;?>/<?php echo $profile_pic['image_src'];?>" alt="profile pic" width="87" height="87"></div>
		    <span class="name"><?php echo $result['firstname'];?></span><br/>
		    <span class="last_login">Last login:</span><span class="date"><?php echo $result['date'];?></span>
		</div>
		<br>
		<br>
		<div class="col-lg-12">
		    <div class="col-lg-12">
			<form name="frm" method='post'>
			<h4>What is the material to be profiled ?</h4>
			<br>
			    <div>
					<input type="radio" name="radio" value="1" required autofocus>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Used Oil   
			    </div>
			    <br>
			    <div>
					<input type="radio" name="radio" value="2">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Paint Waste    
			    </div>
			    <br>
			    <div>
					<input type="radio" name="radio" value="3">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Hazardous Waste
			    </div>
			    <br>
			    <div>
					<input type="radio" name="radio" value="4">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Non-Hazardous Waste	    
			    </div>
			    <br>
			    <div>
					<input type="radio" name="radio" value="5">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Universal Waste   
			    </div>
			    <br>
			    <div>
					<input type="radio" name="radio" value="6">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Cylinders    
			    </div>
			    <br>
			    <div>
					<input type="radio" name="radio" value="7">
				       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Lab Pack    
			    </div>
			    <br>
			    <div>
					<input type="radio" name="radio" value="8" class="btn btn-primary btn-lg">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					I'm Not Sure    
			    </div>
			    <br><br>
			    <div>
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button class="btn btn-success previous">Previous</button>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="next" type="submit" value='Next' class="btn btn-success"/>
			    </div>
			</form>
		    </div>	
		</div> 
	    </div>
	<?php include("../include/footer.php");?>
    </div>
</div>



