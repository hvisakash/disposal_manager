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
    if(isset($_POST["Next"]))
    {
    $session->__set("waste",$_POST["waste"]);
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
		<div class=" ">
		    <div >
		    </div>
		</div>
		</br>
		</br>
		<div class="col-lg-12">
		    <div class="col-lg-12">
			 <form name="frm" method='post'>
			    <h2>What best describes what you are trying to dispose of ?</h2>
			    <input name="waste" type="text" value="" required autofocus>
			    <br><br>
			    <h4>What is the material to be profiled ?</h4></br>
		    </div>
		    </br>
		    </br>
		    <div>
			<input type="radio" name="radio" value="used_Oil" required autofocus>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Used Oil   
		    </div>
		    </br>
		    <div>
			<input type="radio" name="radio" value="paint_wast" required autofocus>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Paint Waste    
		    </div>
		    </br>
		    <div>
			<input type="radio" name="radio" value="hazardous_waste">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Hazardous Waste
		    </div>
		    </br>
		    <div>
			<input type="radio" name="radio" value="non_hazardous_waste">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Non-Hazardous Waste	    
		    </div>
		    </br>
		    <div>
			<input type="radio" name="radio" value="universal_waste">
			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Universal Waste   
		    </div>
		    </br>
		    <div>
			<input type="radio" name="radio" value="cylinders">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Cylinders    
		    </div>
		    </br>
		    <div>
			<input type="radio" name="radio" value="lab_pack">
		       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Lab Pack    
		    </div>
		    </br>
		    <div>
			<input type="radio" name="radio" value="not_sure" class="btn btn-primary btn-lg">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			I'm Not Sure    
		    </div>
		    </br></br>
		    <div>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-success pre" id="Previous">Previous</button>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="Next" type="submit" value='Next' class="btn btn-success"/>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    </div>
		</div>
		    </form>
	    </div> 
	</div>
    </div>
    <?php include("../include/footer.php");?>
</div>
</body>
</html>
<script>
//redirect start profile page
$(document).ready(function(){
  $("#Previous").click(function(){
 window.location.replace("'.BASE_URL.'/generators/profiles-page");
  });
});
</script>
