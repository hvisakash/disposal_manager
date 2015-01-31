<?php
if(isset($_GET["service"]))
{
  $service_type=$_GET["service"];
}
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
    //add waste in data base
    if(isset($_POST["Next"]))
    {
	$array = array(
        "waste" => $_POST['waste'],
        "process_generating" => $_POST['process_generating'],
	"profile_no" => $_POST['profile_no'],
        "source" => $_POST['source'],
	"sample_available" => $_POST['sample_available']
	);
	$value=$generators->wasts($session->__get('user_id'),$array);
	if($value==1)
	{
	    $redirect->redirect("".BASE_URL."/generators/Texas");
	}
    }
    // includding header portion
    include("../include/header.php");
    include("../include/header_menu.php");
?>
<div class="banner bannerwithnoimg">
    <div class="container">
		<div class="bannertxt col-lg-12">
	    	<span class="page_heading">
				<?php if($service_type=='paint_wast')
					{
					    echo "Paint Waste";
					}
					elseif($service_type=='hazardous_waste' || $service_type=='non_hazardous_waste' || $service_type=='universal_waste' || $service_type=='not_sure')
					{
					    echo "Regular Waste";
					}
					elseif($service_type=='used_Oil')
					{
					    echo "Used Oil";
					}elseif($service_type=='cylinders')
					{
					    echo " Cylinders";
					}
					elseif($service_type=='lab_pack')
					{
					    echo "Lab Pack";
					}
				?>
			</span>
	   		<span class="page_txt">Aliqat volutpasac tupis. Integer rutrum ante eu lacuestibulum libero nisl porta vel sceleris que eget</span>
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
						<h2></h2><br>
		    		</div>
		    	</div>
			    
			    <br>
			    <br>
		    <?php 
		    	if((isset($_REQUEST['service'])) && ($_REQUEST['service']=='used_oil'))
		    		include("questions/used_oil.php");
		    	else if((isset($_REQUEST['service'])) && ($_REQUEST['service']=='paint_waste'))
		    		include("questions/paint_waste.php");
		    	else if((isset($_REQUEST['service'])) && ($_REQUEST['service']=='hazardous_waste'))
		    		include("questions/hazardous_waste.php");
		    	else if((isset($_REQUEST['service'])) && ($_REQUEST['service']=='non_hazardous_waste'))
		    		include("questions/non_hazardous_waste.php");
		    	else if((isset($_REQUEST['service'])) && ($_REQUEST['service']=='universal_waste'))
		    		include("questions/universal_waste.php");
		    	else if((isset($_REQUEST['service'])) && ($_REQUEST['service']=='cylinders'))
		    		include("questions/cylinders.php");
		    	else if((isset($_REQUEST['service'])) && ($_REQUEST['service']=='lab_pack'))
		    		include("questions/lab_pack.php");
		    	else if((isset($_REQUEST['service'])) && ($_REQUEST['service']=='not_sure'))
		    		include("questions/not_sure.php");
		    ?>
			
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
