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

	$session->__set("service_id",$service['mat_id']);
	 $session->__set("service_material",$service['material']);
	//echo $session->__get("service_material");
	//die("a");
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
				<?php if(($session->__get("service_id"))=='1') { ?>
					<input type="radio" name="radio" value="1" required autofocus checked="checked">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Used Oil   
				<?php }else{?>
				    <input type="radio" name="radio" value="1" required autofocus>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Used Oil   
				<?php }?>

			    </div>
			    <br>
			    <div>
				<?php if(($session->__get("service_id"))=='2') { ?>
					<input type="radio" name="radio" value="2" checked="checked">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Paint Waste    
				<?php }else{?>
					<input type="radio" name="radio" value="2">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Paint Waste    
				<?php }?>

			    </div>
			    <br>
			    <div>
				<?php if(($session->__get("service_id"))=='3') { ?>
					<input type="radio" name="radio" value="3" checked="checked">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Hazardous Waste
				<?php }else{?>
					<input type="radio" name="radio" value="3">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Hazardous Waste

				<?php }?>
			    </div>
			    <br>
			    <div>
				<?php if(($session->__get("service_id"))=='4') { ?>
					<input type="radio" name="radio" value="4" checked="checked">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Non-Hazardous Waste	    
				<?php }else{?>
					<input type="radio" name="radio" value="4">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Non-Hazardous Waste	    

				<?php }?>
			    </div>
			    <br>
			    <div>
				<?php if(($session->__get("service_id"))=='5') { ?>
					<input type="radio" name="radio" value="5" checked="checked">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Universal Waste   
				<?php }else{?>
					<input type="radio" name="radio" value="5">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Universal Waste   
				<?php }?>
			    </div>
			    <br>
			    <div>
				<?php if(($session->__get("service_id"))=='6') { ?>
					<input type="radio" name="radio" value="6" checked="checked">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Cylinders    
				<?php }else{?>
					<input type="radio" name="radio" value="6">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Cylinders    
				<?php }?>
			    </div>
			    <br>
			    <div>
				<?php if(($session->__get("service_id"))=='7') { ?>
					<input type="radio" name="radio" value="7" checked="checked">
				       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Lab Pack    
				<?php }else{?>
					<input type="radio" name="radio" value="7">
				       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Lab Pack    
				<?php }?>
			    </div>
			    <br>
			    <div>
				<?php if(($session->__get("service_id"))=='8') { ?>
					<input type="radio" name="radio" value="8" class="btn btn-primary btn-lg" checked="checked">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					I'm Not Sure    
				<?php }else{?>
					<input type="radio" name="radio" value="8" class="btn btn-primary btn-lg">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					I'm Not Sure    

				<?php }?>
			    </div>
			    <br><br>
			    <div>
				<a href="<?php echo BASE_URL;?>/generators/New_Profile" class="btn btn-success">Previous</a>
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



