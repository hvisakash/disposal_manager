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
    if(isset($_POST["Next"]))
    {
	    foreach($_POST as $key => $value){
			$session->__set($key,$value);
    	}
		$redirect->redirect("".BASE_URL."/generators/waste_composition");
   	}
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
			<form name="frm" method='post'>
			    <h4><b>GENERAL WASTE INFORMATION</b></h4>
			    <br>
			    <table class="table table-bordered" vspace="50" hspace="50">
				<tr>
				    <td>Waste Stream Name:</td>
				    <td><input name="waste_stream_name" type="text" required autofocus></td>
				</tr>
				<tr>
				    <td>Process Generating the Waste:</td>
				    <td><input name="process_generating_waste" type="text" required autofocus></td>
				</tr>
				<tr>
				    <td>Waste Determination (check all that apply):</td>
				    <td>
					&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Testing" class="check1" > &nbsp;&nbsp; Testing
					&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Generator Knowledge">&nbsp;&nbsp;Generator Knowledge
					&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="MSDS" class="check2">&nbsp;&nbsp;MSDS
					&nbsp;&nbsp;<input name="waste_determination[]" type="checkbox" value="Sample">&nbsp;&nbsp;Sample
				    </td>
				</tr>
				<tr style="display: none;" class="click">
				    <td ></td>
				    <td><input type="file" name=""></td>
				</tr>
				<tr>
				    <td>Unused or Virgin Material?</td>
				    <td><input name="unused" type="radio" value="yes">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="unused" type="radio" value="no">&nbsp;&nbsp; No</td>
				</tr>
				<tr>
				    <td>Disposal Restrictions?  (Check all that apply)</td>
				    <td>
					&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="No Landfill"> &nbsp;&nbsp;No Landfill
					&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="No Canada Disposal">&nbsp;&nbsp;No Canada Disposal
					&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Destruction Required">&nbsp;&nbsp;Destruction Required
					<br>
					&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Must Be Rendered Unusable">&nbsp;&nbsp;Must Be Rendered Unusable
					&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Waste to Energy Required">&nbsp;&nbsp;Waste to Energy Required
					&nbsp;&nbsp;<input name="disposal_restriction[]" type="checkbox" value="Recycling Preferred">&nbsp;&nbsp;Recycling Preferred
				    </td>
				</tr>
				<tr>
				    <td>Is the Waste Exempt from RCRA Regulations:</td>
				    <td><input name="rcra_regulations" type="radio" value="yes">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="rcra_regulations" type="radio" value="no">&nbsp;&nbsp; No</td>
				</tr>
			    </table>
			   
			    <h4><b>SPECIFIC HAZARDS (check boxes: allow user to select all that apply)</b></h4>
			    
				<table width="100%" class="table">
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Flammable"> &nbsp;&nbsp;Flammable
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Explosive">&nbsp;&nbsp;Explosive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Air Reactive">&nbsp;&nbsp;Air Reactive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Infectious">&nbsp;&nbsp;Infectious
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Corrosive"> &nbsp;&nbsp;Corrosive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Pyrophoric">&nbsp;&nbsp;Pyrophoric
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Water Reactive">&nbsp;&nbsp;Water Reactive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Carcinogen">&nbsp;&nbsp;Carcinogen
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Poison"> &nbsp;&nbsp;Poison
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Organic Peroxide">&nbsp;&nbsp;Organic Peroxide
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Reactive Cyanides">&nbsp;&nbsp;Reactive Cyanides (if yes, list PPM)
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards[]" type="checkbox" value="Radioactive">&nbsp;&nbsp;Radioactive
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards_oxidizer" type="checkbox" value="Oxidizer"> &nbsp;&nbsp;	Oxidizer
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_polymerizer" type="checkbox" value="Polymerizer">&nbsp;&nbsp;Polymerizer
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_reactive_sulfides" type="checkbox" value="Reactive Sulfides">&nbsp;&nbsp;Reactive Sulfides (if yes, list PPM)
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_lachrymator" type="checkbox" value="Lachrymator">&nbsp;&nbsp;Lachrymator
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards_aerosol" type="checkbox" value="Aerosol"> &nbsp;&nbsp; Aerosol
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_pcbs" type="checkbox" value="PCBs">&nbsp;&nbsp; PCBs
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_shock_sensitive" type="checkbox" value="Shock Sensitive">&nbsp;&nbsp; Shock Sensitive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_inhakation_hazard" type="checkbox" value="Inhalation Hazard">&nbsp;&nbsp; Inhalation Hazard
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards_compressed_gas" type="checkbox" value="Compressed Gas"> &nbsp;&nbsp; Compressed Gas
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_benzene" type="checkbox" value="Benzene">&nbsp;&nbsp; Benzene
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_temperature_sensitive" type="checkbox" value="Temperature Sensitive">&nbsp;&nbsp; Temperature Sensitive
					</td>
				    </tr>
				</table>
			    </br>
			    </br>
			    <div>
				&nbsp;&nbsp;<button class="btn btn-success previous">Previous</button>
				&nbsp;&nbsp;<input name="Next" type="submit" value='Next' class="btn btn-success" />
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
    var $input = $( this );
    if(($input.is( ":checked" ))==true){
     $(".click").show();
    }else{
	 $(".click").hide();
    }
}).change();
</script>
    
    
    
    
    
    
