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

/*
//add waste in data base
if(isset($_POST['save']))
{
  die("here");
  //save post value in session 
  $session->__set("save_return",$_POST);
  //save generator functionality
  $values=$generators->save_and_return();
  //check a value true or false
    if($values){
    $redirect->redirect("".BASE_URL."/generators/New_Profile");
    }else{
    //echo "Data is Not Save";
    }
  }
*/
//redirect to next page
  if(isset($_POST["Next"]))
  {
  //save post value in session 
  $session->__set("save_return",$_POST);
  //save post value in session 
  foreach($_POST as $key => $value){
    $session->__set($key,$value);
  }
  //nextpage generator functionality
  $redirect->redirect("".BASE_URL."/generators/Texas");
  }
$profile_no = substr(number_format(time() * rand(),0,'',''),0,16);
// includding header portion
    include("../include/header.php");
    include("../include/header_menu.php");
?>
<div class="banner bannerwithnoimg">
    <div class="container">
      <div class="bannertxt col-lg-12">
	<span class="page_heading">
	  <?php if($session->__get("service_id")==1)
	    {
		echo "Used Oil Page";
	    }
	    elseif($session->__get("service_id")==2)
	    {
		echo "Paint Waste State Page";
	    }
	    elseif($session->__get("service_id")==3 || $session->__get("service_id")==4 || $session->__get("service_id")==5|| $session->__get("service_id")==8)
	    {
		echo "Regular Waste Page";
	    }
	    elseif($session->__get("service_id")==6)
	    {
		echo "Cylinder Page";
	    }
	    elseif($session->__get("service_id")==7)
	    {
	       echo "Lab Pack Page";
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
	      if((isset($_REQUEST['service'])) && ($session->__get("service_id")==1))
		include("questions/used_oil.php");
	      else if((isset($_REQUEST['service'])) && ($session->__get("service_id")==2))
		include("questions/paint_waste.php");
	      else if((isset($_REQUEST['service'])) && ($session->__get("service_id")==3))
		include("questions/hazardous_waste.php");
	      else if((isset($_REQUEST['service'])) && ($session->__get("service_id")==4))
		include("questions/non_hazardous_waste.php");
	      else if((isset($_REQUEST['service'])) && ($session->__get("service_id")==5))
		include("questions/universal_waste.php");
	      else if((isset($_REQUEST['service'])) && ($session->__get("service_id")==6))
		include("questions/cylinders.php");
	      else if((isset($_REQUEST['service'])) && ($session->__get("service_id")==7))
		include("questions/lab_pack.php");
	      else if((isset($_REQUEST['service'])) && ($session->__get("service_id")==8))
		include("questions/not_sure.php");
	    ?>
	  <br><br><br>
	</div>
    </div>
  </div>
  <?php include("../include/footer.php");?>
</div>
<script>
jQuery(document).ready(function()
{
    $(".save").click(function(e){
	if (confirm("Are you sure you want to Save and Return")) {
	    $(".wast").submit(function(e){
	    var count = $("form .error:visible").length;
	    if (count==0) {
	    e.preventDefault();
	    var _this = $(e.target);
	    var formData = $(this).serialize();
	    var formdata= formData+"&action=action";
	    $.ajax
		({
		type: "POST",
		 url: "<?php echo BASE_URL;?>/generators/save_wast.php",
		data: formdata,
		dataType: 'json',
		success: function(data)
		    {
			if (data==1){
			    window.location = "<?php echo BASE_URL;?>/generators/New_Profile";
			}
		    }
		});
	    }
	  });
	}
    });
});
</script>