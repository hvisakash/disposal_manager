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
    
    //add waste in data base
    if(isset($_POST["Next"]))
    {
      $session->__set("waste_name",$_POST["waste_name"]);
      $session->__set("label_waste_name",'Waste Name');
      $session->__set("process_generating",$_POST["process_generating"]);
      $session->__set("label_process_generating","Process Generating Waste");
      $session->__set("profile_no",$_POST["profile_no"]);
      $session->__set("label_profile_no","Profile Number");
      if($session->__get("service_id")==1){
      $session->__set("source",$_POST["source"]);
      $session->__set("label_source","Source");
      $session->__set("sample_available",$_POST["sample_available"]);
      $session->__set("label_sample_available","Sample Available");

      }
      $redirect->redirect("".BASE_URL."/generators/Texas");
    }
    if(isset($_POST['save']))
    {
      
    }
/*	$array = array(
        "waste" => $_POST['waste'],
        "process_generating" => $_POST['process_generating'],
	"profile_no" => $_POST['profile_no'],
        "source" => $_POST['source'],
	"sample_available" => $_POST['sample_available']
	);
	//echo$session->__get('dispose');
	//echo "<pre>"; print_r($array); die("here");
	//echo $service_type;
	//die("h");
	$value=$generators->wests($session->__get('user_id'),$session->__get('dispose'),$service_type,$array);
	if($value==1)
	{
	  die("here");
	    $redirect->redirect("".BASE_URL."/generators/Texas");
	}
  */

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
