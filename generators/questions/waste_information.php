<?php

//including initial file
include("../../init.php");
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
if((isset($_POST["Next"])) OR isset($_POST['save']))
{
//create array and store in previous value in array variable 
$userinfo=$session->__get("save_return");
//set current post value in session
$session->__set("save_return1",$_POST);
//get current post value in session
$userinfo1=$session->__get("save_return1");
//push previou and current value stored in array
array_push($userinfo,$userinfo1);
//again set a value in session
$session->__set("save_return",$userinfo);
foreach($_POST as $key => $value){
    $session->__set($key,$value);
    }
//data is save in database
	if(isset($_POST['save']))
	{
	    $data=$generators->save_return();
	    if($data){
		echo "Data is Save";
	    }else{
		echo "Data is Not Save";
	    }
	}
//redirect to next page
	if(isset($_POST['Next']))
	{
	    $redirect->redirect("".BASE_URL."/generators/waste_composition");
	}
    }
//get a array value in session
$specific_hazards=$session->__get("specific_hazards");
$disposal_restriction=$session->__get("disposal_restriction");
$waste_determination=$session->__get("waste_determination");

// includding header portion
    include("../../include/header.php");
    include("../../include/header_menu.php");
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
	    elseif($session->__get("service_id")==3 || $session->__get("service_id")==5 || $session->__get("service_id")==8|| $session->__get("service_id")==4)
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
	    </br>
	    </br>
		<div class="col-lg-12">
		    </br>
		    <div>
			<form name="frm" method='post' class="general_waste_information">
			    <h4><b>GENERAL WASTE INFORMATION</b></h4>
			    <br>
			    <table class="table table-bordered general_waste_information_table" vspace="50" hspace="50">
				<tr>
				    <td>Waste Stream Name:</td>
				    <td><input name="waste_stream_name" type="text" required autofocus value="<?php echo $session->__get('waste_stream_name'); ?>"></td>
				</tr>
				<tr>
				    <td>Process Generating the Waste:</td>
				    <td><input name="process_generating_waste" type="text" required autofocus value="<?php echo $session->__get('process_generating_waste'); ?>"></td>
				</tr>
				<tr>
				    <td>Waste Determination (check all that apply):</td>
				    <td>
					<?php
					    if (is_array($waste_determination) && in_array("Testing", $waste_determination))
					    {
						echo '&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Testing" checked="checked" class="check1"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Testing" class="check1"> &nbsp;&nbsp;';						
						}    
					echo "Testing";
					    if (is_array($waste_determination) && in_array("Generator Knowledge", $waste_determination))
					    {
						echo '&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Generator Knowledge" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Generator Knowledge" class=""> &nbsp;&nbsp;';						
						}    
					echo "Generator Knowledge";
					    if (is_array($waste_determination) && in_array("MSDS", $waste_determination))
					    {
						echo '&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="MSDS" checked="checked" class="check2"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="MSDS" class="check2"> &nbsp;&nbsp;';						
						}    
					echo "MSDS";
					    if (is_array($waste_determination) && in_array("Sample", $waste_determination))
					    {
						echo '&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Sample" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Sample" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Sample
				    </td>
				</tr>
				<tr style="display: none;" class="click">
				    <td ></td>
				    <td><input type="file" name="file_name" required autofocus value="<?php echo $session->__get("file_name");?>"></td>
				</tr>
				<tr>
				    <td>Unused or Virgin Material?</td>
				    <?php if(($session->__get("unused"))=='yes') { ?>
				    
				    <td><input name="unused" type="radio" value="yes" checked="checked">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="unused" type="radio" value="no">&nbsp;&nbsp; No</td>
				    
				    <?php }else if(($session->__get("unused"))=='no') {?>
				    <td><input name="unused" type="radio" value="yes">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="unused" type="radio" value="no" checked="checked">&nbsp;&nbsp; No</td>
				    
				    <?}else{?>
				    
				    <td><input name="unused" type="radio" value="yes">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="unused" type="radio" value="no">&nbsp;&nbsp; No</td>
				    
				    <?php }?>
				    
				    
				    
				</tr>
				<tr>
				    <td>Disposal Restrictions?  (Check all that apply)</td>
				    <td>
					    <?php
					    if (is_array($disposal_restriction) && in_array("No Landfill", $disposal_restriction))
					    {
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="No Landfill" checked="checked"> &nbsp;&nbsp;No Landfill';						
					    }else{
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="No Landfill"> &nbsp;&nbsp;No Landfill';						
					    }    

					    if (is_array($disposal_restriction) && in_array("No Canada Disposal", $disposal_restriction))
					    {
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="No Canada Disposal" checked="checked"> &nbsp;&nbsp;No Canada Disposal';						
					    }else{
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="No Canada Disposal"> &nbsp;&nbsp;No Canada Disposal';						
					    }    
					    if (is_array($disposal_restriction) && in_array("Destruction Required", $disposal_restriction))
					    {
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Destruction Required" checked="checked"> &nbsp;&nbsp;Destruction Required';						
					    }else{
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Destruction Required"> &nbsp;&nbsp;Destruction Required';						
					    }
					    echo "<br>";					    
					    if (is_array($disposal_restriction) && in_array("Must Be Rendered Unusable", $disposal_restriction))
					    {
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Must Be Rendered Unusable" checked="checked"> &nbsp;&nbsp;Must Be Rendered Unusable';						
					    }else{
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Must Be Rendered Unusable"> &nbsp;&nbsp;Must Be Rendered Unusable';						
						}    
					    if (is_array($disposal_restriction) && in_array("Waste to Energy Required", $disposal_restriction))
					    {
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Waste to Energy Required" checked="checked"> &nbsp;&nbsp;Waste to Energy Required';						
					    }else{
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Waste to Energy Required"> &nbsp;&nbsp;Waste to Energy Required';						
						}    
					    if (is_array($disposal_restriction) && in_array("Recycling Preferred", $disposal_restriction))
					    {
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Recycling Preferred" checked="checked"> &nbsp;&nbsp;Recycling Preferred';						
					    }else{
						echo '&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Recycling Preferred"> &nbsp;&nbsp;Recycling Preferred';						
						}    

					    ?>
					<br>
				    </td>
				</tr>
				<tr>
				    <td>Is the Waste Exempt from RCRA Regulations:</td>
				    <?php if(($session->__get("unused"))=='yes') { ?>
				    <td><input name="rcra_regulations" type="radio" value="yes" required autofocus checked="checked">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="rcra_regulations" type="radio" value="no">&nbsp;&nbsp; No</td>
				    <?php }else if(($session->__get("unused"))=='no') {?>
				    <td><input name="rcra_regulations" type="radio" value="yes" required autofocus >&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="rcra_regulations" type="radio" value="no" checked="checked">&nbsp;&nbsp; No</td>
				    <?}else{?>
				    <td><input name="rcra_regulations" type="radio" value="yes" required autofocus>&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="rcra_regulations" type="radio" value="no">&nbsp;&nbsp; No</td>

				    <?php }?>
				    
				</tr>
			    </table>
			   
			    <h4><b>SPECIFIC HAZARDS (check boxes: allow user to select all that apply)</b></h4>
				<table width="100%" class="table specific_hazards" >
				    <tr>
					<td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Flammable", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Flammable" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Flammable" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Flammable
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Explosive", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Explosive" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Explosive" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Explosive
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Air Reactive", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Air Reactive" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Air Reactive" class=""> &nbsp;&nbsp;';						
						}    
					    ?>

					Air Reactive
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Infectious", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Infectious" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Infectious" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Infectious
					</td>
				    </tr>
				    <tr>
					<td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Corrosive", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Corrosive" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Corrosive" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Corrosive
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Pyrophoric", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Pyrophoric" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Pyrophoric" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Pyrophoric
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Water Reactive", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Water Reactive" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Water Reactive" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Water Reactive
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Carcinogen", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Carcinogen" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Carcinogen" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Carcinogen
					</td>
				    </tr>
				    <tr>
					<td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Poison", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Poison" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Poison" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Poison
					</td>
					<td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Organic Peroxide", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Organic Peroxide" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Organic Peroxide" class=""> &nbsp;&nbsp;';						
						}    
					    ?>

					    Organic Peroxide
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Reactive Cyanides", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Reactive Cyanides" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Reactive Cyanides" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Reactive Cyanides (if yes, list PPM)
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Radioactive", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Radioactive" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Radioactive" class=""> &nbsp;&nbsp;';						
						}    
					    ?>

					    Radioactive
					</td>
				    </tr>
				    <tr>
					<td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Oxidizer", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Oxidizer" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Oxidizer" class=""> &nbsp;&nbsp;';						
						}    
					    ?>

					    Oxidizer
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Polymerizer", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Polymerizer" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Polymerizer" class=""> &nbsp;&nbsp;';						
						}    
					    ?>

					   Polymerizer
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Reactive Sulfides", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Reactive Sulfides" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Reactive Sulfides" class=""> &nbsp;&nbsp;';						
						}    
					    ?>

					    Reactive Sulfides (if yes, list PPM)
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Lachrymator", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Lachrymator" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Lachrymator" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Lachrymator
					</td>
				    </tr>
				    <tr>
					<td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Aerosol", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Aerosol" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Aerosol" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Aerosol
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("PCBs", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="PCBs" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="PCBs" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    PCBs
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Shock Sensitive", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Shock Sensitive" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Shock Sensitive" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Shock Sensitive
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Inhalation Hazard", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Inhalation Hazard" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Inhalation Hazard" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Inhalation Hazard
					</td>
				    </tr>
				    <tr>
					<td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Compressed Gas", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Compressed Gas" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Compressed Gas" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Compressed Gas
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Benzene", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Benzene" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Benzene" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Benzene
					</td><td>
					    <?php
					    if (is_array($specific_hazards) && in_array("Temperature Sensitive", $specific_hazards))
					    {
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Temperature Sensitive" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Temperature Sensitive" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					    Temperature Sensitive
					</td>
				    </tr>
				</table>
			    </br>
			    </br>
			    <div>
				<a href="<?php echo BASE_URL;?>/generators/Texas" class="btn btn-success">Previous</a>
				&nbsp;&nbsp;<input name="Next" type="submit" value='Next' class="btn btn-success next" />
				&nbsp;&nbsp;<input name="save" type="submit" value='Save & Return' class="btn btn-success"/> 
			    </div>
			</form>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
  <?php include("../../include/footer.php");?>
<script>
$( ".check1,.check2" ).change(function() {
    
    var $input = $(this);
    if(($input.is( ":checked" ))==true){
     $(".click").show();
    }else{
	 $(".click").hide();
    }
}).change();
</script>
    
    
    
    
    
    
