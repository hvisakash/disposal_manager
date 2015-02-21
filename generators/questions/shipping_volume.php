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
    // put all value in session
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
	$redirect->redirect("".BASE_URL."/generators/rcra_charaterization");
    }
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
			<form name="frm" method='post' class="shipping_volume">
			    <h4><b>SHIPPING VOLUME & FREQUENCY</b></h4>
			    <br>
			    <table class="table table-bordered" vspace="50" hspace="50">
				<tr>
				    <td>Bulk Liquid </td>
				    <td>
					<?php if(($session->__get("bulk_liquid"))=='yes') { ?>
					    <input name="bulk_liquid" type="radio" value="yes" checked="checked"> Yes &nbsp;
					    <input name="bulk_liquid" type="radio" value="no"> No
					<?php }else if(($session->__get("bulk_liquid"))=='no' ){?>    
					    <input name="bulk_liquid" type="radio" value="yes"> Yes &nbsp;
					    <input name="bulk_liquid" type="radio" value="no" checked="checked"> No
					<?php }else{?>
					    <input name="bulk_liquid" type="radio" value="yes"> Yes &nbsp;
					    <input name="bulk_liquid" type="radio" value="no"> No

					<?php }?>					    	
				    </td>
				</tr>
				<tr>
				    <td>Bulk Solids </td>
				    <td>
					<?php if(($session->__get("bulk_solids"))=='yes') { ?>
					    <input name="bulk_solids" type="radio" value="yes" checked="checked"> Yes &nbsp;
					    <input name="bulk_solids" type="radio" value="no"> No
					<?php }else if(($session->__get("bulk_solids"))=='no'){?>    
					    <input name="bulk_solids" type="radio" value="yes"> Yes &nbsp;
					    <input name="bulk_solids" type="radio" value="no" checked="checked"> No
					<?php }else{?>
					    <input name="bulk_solids" type="radio" value="yes"> Yes &nbsp;
					    <input name="bulk_solids" type="radio" value="no"> No
					<?php }?>					    	
				    </td>
				</tr>
				<tr>
				    <td>Drum Size </td>
				    <td>
					<select style="width:175px;" name="drum_size">
					    <?php if($session->__get("drum_size")){?>
        					<option value="<?php echo $session->__get("drum_size");?>"><?php echo $session->__get("drum_size");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="5">5</option>
					    <option value="15">15</option>
					    <option value="30">30</option>
					    <option value="55">55</option>
					    <option value="85">85</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Drum Type</td>
				    <td>
					<select style="width:175px;" name="drum_type">
					    <?php if($session->__get("drum_type")){?>
        					<option value="<?php echo $session->__get("drum_type");?>"><?php echo $session->__get("drum_type");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="DM - metal"> DM - metal </option>
					    <option value="DF - fiber">DF - fiber</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Totes (Size In Gallons)</td>
				    <td>
					    <input name="totes" type="text" value="<?php echo $session->__get("totes");?>"> 
				    </td>
				</tr>
				<tr>
				    <td>Totes types</td>
				    <td>
					<select style="width:175px;" name="totes_types">
					    <?php if($session->__get("totes_types")){?>
        					<option value="<?php echo $session->__get("totes_types");?>"><?php echo $session->__get("totes_types");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="metal">Metal</option>
					    <option value="plastic">Plastic</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Require Return of Tote? </td>
				    <td>
					    <?php if(($session->__get("return_of_tote"))=='yes') { ?>
					    <input name="return_of_tote" type="radio" value="yes" checked="checked"> Yes &nbsp;
					    <input name="return_of_tote" type="radio" value="no"> No
					    <?php }else if(($session->__get("return_of_tote"))=='no'){?>
					    <input name="return_of_tote" type="radio" value="yes"> Yes &nbsp;
					    <input name="return_of_tote" type="radio" value="no" checked="checked"> No
					    <?php }else{?>
					    <input name="return_of_tote" type="radio" value="yes"> Yes &nbsp;
					    <input name="return_of_tote" type="radio" value="no"> No
					    <?php } ?>   
					    
				    </td>
				</tr>
				<tr>
				    <td>Skids or CYB </td>
				    <td>
					    <?php if(($session->__get("skids"))=='yes') { ?>
					    <input name="skids" type="radio" value="yes" checked="checked"> Yes &nbsp;
					    <input name="skids" type="radio" value="no"> No
					    <?php }else if(($session->__get("skids"))=='no'){?>
					    <input name="skids" type="radio" value="yes"> Yes &nbsp;
					    <input name="skids" type="radio" value="no" checked="checked"> No
					    <?php }else{?>
					    <input name="skids" type="radio" value="yes"> Yes &nbsp;
					    <input name="skids" type="radio" value="no"> No
					    <?php } ?>   
				    </td>
				</tr>
				<tr>
				    <td>Frequency  </td>
				    <td>
					<select style="width:175px;" name="frequency">
					    <?php if($session->__get("frequency")){?>
        					<option value="<?php echo $session->__get("frequency");?>"><?php echo $session->__get("frequency");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option  value="One Time">One-Time</option>
					    <option value="Weekly">Weekly</option>
					    <option value="Monthly">Monthly</option>
					    <option  value="Quarterly">Quarterly</option>
					    <option  value="Annually">Annually</option>
					    <option  value="Other">Other</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Quantity to ship </td>
				    <td><input name="quantity_to_ship" type="text" value="<?php echo $session->__get("quantity_to_ship"); ?>"></td>
				</tr>
			    </table>
			    </br>
			    </br>
			    <div>
				<a href="<?php echo BASE_URL;?>/generators/characteristics" class="btn btn-success">Previous</a>
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
