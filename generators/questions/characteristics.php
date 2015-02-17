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
//    echo "<pre>";print_r($_POST);die;

      $redirect->redirect("".BASE_URL."/generators/shipping_volume");
   }
//get a value in array session
$layers=$session->__get("layers");
   
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
			<form name="frm" method='post' class="characterstics">
			    <h4><b>CHARACTERISTICS</b></h4>
			    <br>
			    <table class="table table-bordered" vspace="50" hspace="50">
				<tr>
				    <td>Color</td>
				    <td><input name="color" type="text" value="<?php echo $session->__get("color");?>"></td>
				</tr>
				<tr>
				    <td>Odor</td>
				    <td>
					<select style="width:175px;" name="odor">
					    <?php if($session->__get("odor")){?>
        					<option value="<?php echo $session->__get("odor");?>"><?php echo $session->__get("odor");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="none">None</option>
					    <option value="mild">Mild</option>
					    <option value="strong">Strong</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Viscosity with Examples</td>
				    <td>
					<select style="width:175px;" name="viscosity">
					    <?php if($session->__get("viscosity")){?>
        					<option value="<?php echo $session->__get("viscosity");?>"><?php echo $session->__get("viscosity");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="Like Water">Like Water</option>
					    <option value="Like Oil">Like Oil</option>
					    <option value="Like Honey">Like Honey</option>
					    <option value="Like Grease">Like Grease</option>
					    <option value="Like Peanut Butter"> Like Peanut Butter</option>
					    <option value="Like Concrete">Like Concrete</option>
					    
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Layers</td>
				    <td>
					<?php
					
					
					    if (is_array($layers) && in_array("layers1", $layers))
					    {
						echo '&nbsp;&nbsp;<input name="layers[]" type="checkbox" value="layers1" checked="checked"> &nbsp;&nbsp; 1';						
					    }else{
						echo '&nbsp;&nbsp;<input name="layers[]" type="checkbox" value="layers1" class=""> &nbsp;&nbsp; 1';						
					    }
					    if (is_array($layers) && in_array("layers2", $layers))
					    {
						echo '&nbsp;&nbsp;<input name="layers[]" type="checkbox" value="layers2" checked="checked"> &nbsp;&nbsp; 2';						
					    }else{
						echo '&nbsp;&nbsp;<input name="layers[]" type="checkbox" value="layers2" class=""> &nbsp;&nbsp; 2';						
					    }
					    if (is_array($layers) && in_array("layers3", $layers))
					    {
						echo '&nbsp;&nbsp;<input name="layers[]" type="checkbox" value="layers3" checked="checked"> &nbsp;&nbsp; 3';						
					    }else{
						echo '&nbsp;&nbsp;<input name="layers[]" type="checkbox" value="layers3" class=""> &nbsp;&nbsp; 3';						
					    }
					    if (is_array($layers) && in_array("layers4", $layers))
					    {
						echo '&nbsp;&nbsp;<input name="layers[]" type="checkbox" value="layers4" checked="checked"> &nbsp;&nbsp; 4';						
					    }else{
						echo '&nbsp;&nbsp;<input name="layers[]" type="checkbox" value="layers4" class=""> &nbsp;&nbsp; 4';						
					    }
					?>
				    </td>
				</tr>
				<tr>
				    <td>Specific Gravity</td>
				    <td>
					<select style="width:175px;" name="specific_gravity">
					    <?php if($session->__get("specific_gravity")){?>
        					<option value="<?php echo $session->__get("specific_gravity");?>"><?php echo $session->__get("specific_gravity");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="<1 (Floats on Water)"> <1 (Floats on Water)</option>
					    <option value="1 (Water)">1 (Water)</option>
					    <option value="1 Heavier than Water"> >1 Heavier than Water</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Halogens</td>
				    <td>
					<input type="text" name="halogens" value="<?php echo $session->__get("halogens")?>">
				    </td>
				</tr>
				<tr>
				    <td>BTUs</td>
				    <td>
					<select style="width:175px;" name="btus">
					    <?php if($session->__get("btus")){?>
        					<option value="<?php echo $session->__get("btus");?>"><?php echo $session->__get("btus");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="<=3,000"> <=3,000</option>
					    <option value=">=3,000 - <5,000">>=3,000 - <5,000 </option>
					    <option value=">=5,000 - <10,000">>=5,000 - <10,000</option>
					    <option value=">=10,000">>=10,000</option>
					    
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Flashpoint with Ranges or Exact Figure</td>
				    <td>
					<select style="width:175px;" name="flashpoint_with_ranges">
					    <?php if($session->__get("flashpoint_with_ranges")){?>
        					<option value="<?php echo $session->__get("flashpoint_with_ranges");?>"><?php echo $session->__get("flashpoint_with_ranges");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="<73*F"> <73*F </option>
					    <option value=">=73*F - <=99*F"> >=73*F - <=99*F </option>
					    <option value=" >=100*F-<=139*F "> >=100*F-<=139*F </option>
					    <option value=" >=140*F - <=200*F">  >=140*F - <=200*F </option>
					    <option value=">200*F"> >200*F </option>
					    <option value="None"> None </option>
					    
					</select>
				    </td>
				</tr>
				<tr>
				    <td>pH Value with Ranges or Exact Figure</td>
				    <td>
					<select style="width:175px;" name="pH_value_with_ranges">
					    <?php if($session->__get("pH_value_with_ranges")){?>
        					<option value="<?php echo $session->__get("pH_value_with_ranges");?>"><?php echo $session->__get("pH_value_with_ranges");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="<=2"><=2</option>
					    <option value=">2 - <4">>2 - <4</option>
					    <option value=">=4 - <=10">>=4 - <=10</option>
					    <option value=">10 - <12.5">>10 - <12.5</option>
					    <option value=">=12.5">>=12.5</option>
					    
					</select>
				    </td>
				</tr>
			    </table>
			    </br>
			    </br>
			    <div>
				<a href="<?php echo BASE_URL;?>/generators/waste_composition" class="btn btn-success">Previous</a>
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
