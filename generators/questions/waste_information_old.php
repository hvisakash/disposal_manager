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
    echo $key."\t";
    echo $value."\t";
	$session->__set($key,$value);
//    $session->__set("label_","Sample Available");
    }
    echo "<pre>";print_r($_POST);die;
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	    
	
	
/*	$session->__set("stream_name",$_POST["stream_name"]);
	$session->__set("process_generating",$_POST["process_generating"]);
	$session->__set("determination_testing",$_POST["determination_testing"]);
	$session->__set("determination_generator",$_POST["determination_generator"]);
	$session->__set("determination_knowledge",$_POST["determination_knowledge"]);
	$session->__set("determination_msds",$_POST["determination_msds"]);
	$session->__set("determination_sample",$_POST["determination_sample"]);
	$session->__set("unused",$_POST["unused"]);
	$session->__set("restrictions_no_landfill",$_POST["restrictions_no_landfill"]);
	$session->__set("restrictions_no_canada",$_POST["restrictions_no_canada"]);
	$session->__set("restrictions_destruction_required",$_POST["restrictions_destruction_required"]);
	$session->__set("restrictions_must_be_rendered_unusable",$_POST["restrictions_must_be_rendered_unusable"]);
	$session->__set("restrictions_waste_to_energy_required",$_POST["restrictions_waste_to_energy_required"]);
	$session->__set("restrictions_recycling_preferred",$_POST["restrictions_recycling_preferred"]);
	$session->__set("rcra",$_POST["rcra"]);
	
	$session->__set("specific_hazards_flammable",$_POST["specific_hazards_flammable"]);
	$session->__set("specific_hazards_explosive",$_POST["specific_hazards_explosive"]);
	$session->__set("specific_hazards_air_reactive",$_POST["specific_hazards_air_reactive"]);
	$session->__set("specific_hazards_infectious",$_POST["specific_hazards_infectious"]);
	
	$session->__set("specific_hazards_corrosive",$_POST["specific_hazards_corrosive"]);
	$session->__set("specific_hazards_explosive",$_POST["specific_hazards_explosive"]);
	$session->__set("specific_hazards_air_reactive",$_POST["specific_hazards_air_reactive"]);
	$session->__set("specific_hazards_infectious",$_POST["specific_hazards_infectious"]);
	
	$session->__set("specific_hazards_poison",$_POST["specific_hazards_poison"]);
	$session->__set("specific_hazards_organic_peroxide",$_POST["specific_hazards_organic_peroxide"]);
	$session->__set("specific_hazards_reactive_cyanides",$_POST["specific_hazards_reactive_cyanides"]);
	$session->__set("specific_hazards_radioactive",$_POST["specific_hazards_radioactive"]);
	
	$session->__set("specific_hazards_oxidizer",$_POST["specific_hazards_oxidizer"]);
	$session->__set("specific_hazards_polymerizer",$_POST["specific_hazards_polymerizer"]);
	$session->__set("specific_hazards_reactive_sulfides",$_POST["specific_hazards_reactive_sulfides"]);
	$session->__set("specific_hazards_lachrymator",$_POST["specific_hazards_lachrymator"]);
	
	$session->__set("specific_hazards_aerosol",$_POST["specific_hazards_aerosol"]);
	$session->__set("specific_hazards_pcbs",$_POST["specific_hazards_pcbs"]);
	$session->__set("specific_hazards_shock_sensitive",$_POST["specific_hazards_shock_sensitive"]);
	$session->__set("specific_hazards_inhakation_hazard",$_POST["specific_hazards_inhakation_hazard"]);

	$session->__set("specific_hazards_compressed_gas",$_POST["specific_hazards_compressed_gas"]);
	$session->__set("specific_hazards_benzene",$_POST["specific_hazards_benzene"]);
	$session->__set("specific_hazards_temperature_sensitive",$_POST["specific_hazards_temperature_sensitive"]);

/*/	
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
					&nbsp;&nbsp;<input name="determination_testing" type="checkbox" class="check1"> &nbsp;&nbsp; Testing
					&nbsp;&nbsp;<input name="determination_generator" type="checkbox">&nbsp;&nbsp;Generator Knowledge
					&nbsp;&nbsp;<input name="determination_msds" type="checkbox" class="check2" value="">&nbsp;&nbsp;MSDS
					&nbsp;&nbsp;<input name="determination_sample" type="checkbox">&nbsp;&nbsp;Sample
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
					&nbsp;&nbsp;<input name="restrictions_no_landfill" type="checkbox"> &nbsp;&nbsp; No Landfill
					&nbsp;&nbsp;<input name="restrictions_no_canada" type="checkbox">&nbsp;&nbsp;No Canada Disposal
					&nbsp;&nbsp;<input name="restrictions_destruction_required" type="checkbox">&nbsp;&nbsp;Destruction Required
					<br>
					&nbsp;&nbsp;<input name="restrictions_must_be_rendered_unusable" type="checkbox">&nbsp;&nbsp;Must Be Rendered Unusable
					&nbsp;&nbsp;<input name="restrictions_waste_to_energy_required" type="checkbox">&nbsp;&nbsp;Waste to Energy Required
					&nbsp;&nbsp;<input name="restrictions_recycling_preferred" type="checkbox">&nbsp;&nbsp;Recycling Preferred
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
					    &nbsp;&nbsp;<input name="specific_hazards_flammable" type="checkbox"> &nbsp;&nbsp;	Flammable
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_explosive" type="checkbox">&nbsp;&nbsp;		Explosive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_air_reactive" type="checkbox">&nbsp;&nbsp;		Air Reactive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_infectious" type="checkbox">&nbsp;&nbsp;		Infectious
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards_corrosive" type="checkbox"> &nbsp;&nbsp;	Corrosive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_pyrophoric" type="checkbox">&nbsp;&nbsp;		Pyrophoric
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_water_reactive" type="checkbox">&nbsp;&nbsp;		Water Reactive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_carcinogen" type="checkbox">&nbsp;&nbsp;		Carcinogen
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards_poison" type="checkbox"> &nbsp;&nbsp; Poison
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_organic_peroxide" type="checkbox">&nbsp;&nbsp; Organic Peroxide
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_reactive_cyanides" type="checkbox">&nbsp;&nbsp; Reactive Cyanides (if yes, list PPM)
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_radioactive" type="checkbox">&nbsp;&nbsp; Radioactive
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards_oxidizer" type="checkbox"> &nbsp;&nbsp;	Oxidizer
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_polymerizer" type="checkbox">&nbsp;&nbsp;		Polymerizer
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_reactive_sulfides" type="checkbox">&nbsp;&nbsp;		Reactive Sulfides (if yes, list PPM)
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_lachrymator" type="checkbox">&nbsp;&nbsp;		Lachrymator
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards_aerosol" type="checkbox"> &nbsp;&nbsp; Aerosol
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_pcbs" type="checkbox">&nbsp;&nbsp; PCBs
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_shock_sensitive" type="checkbox">&nbsp;&nbsp; Shock Sensitive
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_inhakation_hazard" type="checkbox">&nbsp;&nbsp; Inhalation Hazard
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="specific_hazards_compressed_gas" type="checkbox"> &nbsp;&nbsp; Compressed Gas
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_benzene" type="checkbox">&nbsp;&nbsp; Benzene
					</td><td>
					    &nbsp;&nbsp;<input name="specific_hazards_temperature_sensitive" type="checkbox">&nbsp;&nbsp; Temperature Sensitive
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
    
    
    
    
    
    
