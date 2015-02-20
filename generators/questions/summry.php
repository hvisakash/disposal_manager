<?php
//including initial file
include("../../init.php");
    //creating object of session class  
    $session = $init->getSession();
    //echo "<pre>";print_r($session->__get('disposal_restriction'));
    //creating object of redirect class
    $redirect = $init->getRedirect();
    //creating object of vender class
    $generators = Generators::getInstance();
    //object for last login date
    $result=$generators->lastdate();
    //check session functionality
    $sessions=$session->getAllSession();
    //echo "<pre>";print_r($sessions);die;

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
      $redirect->redirect("".BASE_URL."/generators");
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
		  <table>
		      <tr>
			      <td> <h4><strong>Material to be profiled </strong></h4></td>
			      <td>
				  <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <?php  echo $session->__get("service_material");?></h5>
			      </td>
		      </tr>
		    </table>	
		</div>
		<div class="col-lg-6">
		    <table class="table table-bordered">
			<tr>
			    <td>Name of Waste</td>
			    <td><?php echo $session->__get('waste_name') ?></td>
			</tr>
			<tr>
			    <td>Process Generating Waste &nbsp;&nbsp;&nbsp;&nbsp;</td>
			    <td><?php echo $session->__get('process_generating') ?></td>
			</tr>
			<tr>
			    <td>Profile Number</td>
			    <td><?php echo $session->__get('profile_no');?> </td>
			</tr>
			<?php if($session->__get("service_id")==1) { ?>
			<tr>
			    <td>Source</td>
			    <td><?php echo $session->__get('source'); ?></td>
			</tr>
			<tr>
			    <td>Sample Available </td>
			    <td><?php echo $session->__get('sample_available');?></td>
			</tr>
			<?php } ?>
			<tr>
			    <td></td>
			    <td><a href="<?php echo BASE_URL;?>/generator/Services/<?php echo $session->__get("service_id")?>" class="btn btn-success">Edit</a></td>
			</tr>
		    </table>
    		  <table class="table table-bordered">
		      <tr>
			      <td>Is the site located within the state of Texas ?</td> 
			      <td> <?php echo $session->__get('state_of_texas'); ?></td>
		      </tr>
			<tr>
			    <td></td>
			    <td><a href="<?php echo BASE_URL;?>/generators/Texas" class="btn btn-success">Edit</a></td>
			</tr>
		    </table>	
<!-- GENERAL WASTE COMPONENT Page -->		    
		    <h5><strong>GENERAL WASTE COMPONENT</strong></h5>
		    <table class="table table-bordered">
			<tr>
			    <td>Component</td>
			    <td><?php foreach($session->__get('component') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
			<tr>
			    <td>CAS#</td>
			    <td><?php foreach($session->__get('cas') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
			<tr>
			    <td>Minimum</td>
			    <td><?php foreach($session->__get('minimum') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
			<tr>
			    <td>Unit (%, ppm)</td>
			    <td><?php foreach($session->__get('min_unit') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
			<tr>
			    <td>Maximum</td>
			    <td><?php foreach($session->__get('maximum') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
			<tr>
			    <td>Unit (%, ppm)</td>
			    <td><?php foreach($session->__get('max_unit') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
			<tr>
			    <td>SPECIFIC HAZARDS</td>
			    <td><?php
			    foreach($session->__get('specific_hazards') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
		    </table>
		    <h5>DOCUMENTATION (MSDS, Analysis, Etc.)</h5>
		    <table class="table table-bordered">
			<tr>
			    <td>Type of document</td>
			    <td><?php echo $session->__get("documentation"); ?></td>
			</tr>
			<tr>
			    <td><h4>METALS PRESENT</h4></td>
			    <td><?php
//			    print_r($session->__get("metals"));
			    if (is_array($session->__get("metals")) && in_array("METALS PRESENT", $session->__get("metals")))
				{
				    echo "Yes";
				}else{
				    echo "No";
				}
			    ?></td>
			</tr>
			<?php
			    if (is_array($session->__get("metals")) && in_array("METALS PRESENT", $session->__get("metals")))
			    {
			?>			
			<tr>
			    <td></td>
			    <td><?php
				foreach($session->__get("metals") as $value)
				{
				    if($value=="METALS PRESENT")
				    {}else{
					echo $value.",";
				    }
				}
			    

			    ?></td>
			</tr>
			<?php } ?>
			<tr>
			    <td></td>
			    <td><a href="<?php echo BASE_URL;?>/generators/waste_composition" class="btn btn-success">Edit</a></td>
			</tr>
		    </table>
<!-- SHIPPING VOLUME & FREQUENCY Page -->		    
		    <h4><strong>SHIPPING VOLUME & FREQUENCY</strong></h4>
		    <table class="table table-bordered">
			<tr>
			    <td>Bulk Liquid </td>
			    <td><?php echo $session->__get('bulk_liquid') ?></td>
			</tr>
			<tr>
			    <td>Bulk Solids</td>
			    <td><?php echo $session->__get('bulk_solids') ?></td>
			</tr>
			<tr>
			    <td>Drum Size</td>
			    <td><?php echo $session->__get('drum_size');?> </td>
			</tr>
			<tr>
			    <td>Drum Type</td>
			    <td><?php echo $session->__get('drum_type');?> </td>
			</tr>
			<tr>
			    <td>Totes (Size In Gallons) </td>
			    <td><?php echo $session->__get('totes');?></td>
			</tr>
			<tr>
			    <td>Totes types </td>
			    <td><?php echo $session->__get('totes_types');?></td>
			</tr>
			<tr>
			    <td>Require Return of Tote ?</td>
			    <td><?php echo $session->__get('return_of_tote');?></td>
			</tr>
			<tr>
			    <td>Skids or CYB</td>
			    <td><?php echo $session->__get('skids');?></td>
			</tr>
			<tr>
			    <td>Frequency</td>
			    <td><?php echo $session->__get('frequency');?></td>
			</tr>
			<tr>
			    <td>Quantity to ship</td>
			    <td><?php echo $session->__get('quantity_to_ship');?></td>
			</tr>

			<tr>
			    <td></td>
			    <td><a href="<?php echo BASE_URL;?>/generators/shipping_volume" class="btn btn-success">Edit</a></td>
			</tr>
		    </table>
<!-- DOT SHIPPING INFORMATION Page -->
		    <h4><strong>DOT SHIPPING INFORMATION</strong></h4>
		    <table class="table table-bordered">
			<tr>
			    <td>Is this a USDOT Hazardous Material? </td>
			    <td><?php echo $session->__get('USDOT_hazardous_material'); ?></td>
			</tr>
			<?php if($session->__get('USDOT_hazardous_material')=="yes") { ?>
			<tr>
			    <td>Shipping Name (49 CFR 172.101)</td>
			    <td><?php echo $session->__get('shipping_name') ?></td>
			</tr>
			<tr>
			    <td>Technical Descriptors</td>
			    <td><?php echo $session->__get('technical_descriptors');?> </td>
			</tr>
			<tr>
			    <td>Hazard Class</td>
			    <td><?php echo $session->__get('hazard_class');?> </td>
			</tr>
			<tr>
			    <td>UN/NA Number </td>
			    <td><?php echo $session->__get('un/na_number');?></td>
			</tr>
			<tr>
			    <td>Packing Group </td>
			    <td><?php echo $session->__get('parking_grup');?></td>
			</tr>
			<tr>
			    <td>ERG</td>
			    <td><?php echo $session->__get('erg');?></td>
			</tr>
			<tr>
			    <td>RQ</td>
			    <td><?php echo $session->__get('rq');?></td>
			</tr>
			<tr>
			    <td>Inhalation Hazard: Zone</td>
			    <td><?php echo $session->__get('inhalation_hazard');?></td>
			</tr>
			<?php } ?>
			<tr>
			    <td></td>
			    <td><a href="<?php echo BASE_URL;?>/generators/don_shipping_information" class="btn btn-success">Edit</a></td>
			</tr>
		    </table>
		    
		    
		</div>
<!-- Right tables data -->
		
		<div class="col-lg-6">
<!-- GENERAL WASTE INFORMATION Page -->
		    <h5><strong>GENERAL WASTE INFORMATION</strong></h5>
		    <table class="table table-bordered">
			<tr>
			    <td>Waste Stream Name</td>
			    <td><?php echo $session->__get('waste_stream_name') ?></td>
			</tr>
			<tr>
			    <td>Process Generating the Waste</td>
			    <td><?php echo $session->__get('process_generating_waste') ?></td>
			</tr>
			<tr>
			    <td>Waste Determination (check all that apply)</td>
			    <td><?php
			    foreach($session->__get('waste_determination') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
			    <?php foreach($session->__get('waste_determination') as $value)
			    {
				if(($value=="Testing")OR($value=="MSDS"))
				{
				?>
			<tr>
			    <td></td>
			    <td>
				<?php
				echo $session->__get("file_name");
				break;
				}?>
			    </td>
			</tr>
			  <?php } ?>
			<tr>
			    <td>Unused or Virgin Material?</td>
			    <td><?php echo $session->__get('unused'); ?></td>
			</tr>
			<tr>
			    <td>Disposal Restrictions? </td>
			    <td><?php
			    foreach($session->__get('disposal_restriction') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
			<tr>
			    <td>Is the Waste Exempt from RCRA Regulations</td>
			    <td><?php echo ($session->__get('rcra_regulations'));?></td>
			</tr>
			<tr>
			    <td>SPECIFIC HAZARDS</td>
			    <td><?php
			    foreach($session->__get('specific_hazards') as $value)
			    {
				echo $value.",";
			    }
			    ?></td>
			</tr>
    			<tr>
			    <td></td>
			    <td><a href="<?php echo BASE_URL;?>/generators/waste_information" class="btn btn-success">Edit</a></td>
			</tr>
		    </table>
<!-- CHARACTERISTICS Page -->
		    <h4><strong>CHARACTERISTICS</strong></h4>
		    <table class="table table-bordered">
			<tr>
			    <td>Color</td>
			    <td><?php echo $session->__get('color') ?></td>
			</tr>
			<tr>
			    <td>Odor</td>
			    <td><?php echo $session->__get('odor') ?></td>
			</tr>
			<tr>
			    <td>Viscosity with Examples</td>
			    <td><?php echo $session->__get('viscosity');?> </td>
			</tr>
			<tr>
			    <td>Layers</td>
			    <td><?php
			    foreach($session->__get('layers') as $value)
			    {
				echo $value.",";
			    }
			    ?>
			    </td>
			</tr>
			<tr>
			    <td>Specific Gravity </td>
			    <td><?php echo $session->__get('specific_gravity');?></td>
			</tr>
			<tr>
			    <td>Halogens </td>
			    <td><?php echo $session->__get('halogens');?></td>
			</tr>
			<tr>
			    <td>BTUs </td>
			    <td><?php echo $session->__get('btus');?></td>
			</tr>
			<tr>
			    <td>Flashpoint with Ranges or Exact Figure </td>
			    <td><?php echo $session->__get('flashpoint_with_ranges');?></td>
			</tr>
			<tr>
			    <td>pH Value with Ranges or Exact Figure </td>
			    <td><?php echo $session->__get('pH_value_with_ranges');?></td>
			</tr>

			<tr>
			    <td></td>
			    <td><a href="<?php echo BASE_URL;?>/generators/characteristics" class="btn btn-success">Edit</a></td>
			</tr>
		    </table>
<!--RCRA CHARACTERIZATION Page -->
		    <h4><strong>RCRA CHARACTERIZATION</strong></h4>
		    <table class="table table-bordered">
			<tr>
			    <td>Is stream a USEPA Hazardous Waste (40 CFR 261.3)</td>
			    <td><?php echo $session->__get('USEPA_hazardous') ?></td>
			</tr>
			<tr>
			    <td>Is stream a Universal Waste (40 CFR 273)</td>
			    <td><?php echo $session->__get('universal') ?></td>
			</tr>
			<tr>
			    <td>EPA Waste Codes</td>
			    <td><?php echo $session->__get('EPA_waste_codes');?> </td>
			</tr>
			<tr>
			    <td>Source Code</td>
			    <td><?php echo $session->__get('sorce_code');?> </td>
			</tr>
			<tr>
			    <td>Form Code  </td>
			    <td><?php echo $session->__get('form_code');?></td>
			</tr>
			<tr>
			    <td>Management Method  </td>
			    <td><?php echo $session->__get('management_method');?></td>
			</tr>
			<tr>
			    <td>Texas State Waste Codes (if Generator is in Texas)</td>
			    <td><?php echo $session->__get('texas_state_waste_code');?></td>
			</tr>
			<?php if($session->__get('texas_state_waste_code')=="yes") { ?>
			<tr>
			    <td>Texas State Waste Code</td>
			    <td><?php echo $session->__get('texas_state_waste_code_text');?></td>
			</tr>
			<?php } ?>
			<tr>
			    <td></td>
			    <td><a href="<?php echo BASE_URL;?>/generators/rcra_charaterization" class="btn btn-success">Edit</a></td>
			</tr>
		    </table>

		</div>    
	    </div>
	</div>
    </div>
</div>
  <?php include("../../include/footer.php");?>
<link href="<?php echo BASE_URL;?>/css/datepicker.css" rel="stylesheet" type="text/css">
<!-- Load jQuery and bootstrap datepicker scripts -->
 <script src="<?php echo BASE_URL;?>/js/bootstrap-datepicker.js"></script>
 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                $('.date_pic').datepicker({
                format: "dd/mm/yyyy"
             });
	});  	
</script>

