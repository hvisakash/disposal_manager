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
    
//functionality for next or save data by generator
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
    if(isset($_POST['USDOT_hazardous_material'])=='yes')
    {
	foreach($_POST as $key => $value){
	$session->__set($key,$value);
	}
    }else{
	    $session->__set("USDOT_hazardous_material",$_POST['USDOT_hazardous_material']);
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
      $redirect->redirect("".BASE_URL."/generators/summry");
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
			<form name="frm" method='post' class="don_shipping">
			    <h4><b>DOT SHIPPING INFORMATION</b></h4>
			    <br>
			    <table class="table table-bordered" vspace="50" hspace="50">
				<tr>
					<td>Is this a USDOT Hazardous Material?</td>
					<?php
					
					if($session->__get('USDOT_hazardous_material')=="yes" ){?>
					<td>
					    <input name="USDOT_hazardous_material" type="radio" value="yes" id="yes" required autofocus checked="checked"> Yes &nbsp;
					    <input name="USDOT_hazardous_material" type="radio" value="no" id="no"> No
					</td>
					<?php }else if($session->__get('USDOT_hazardous_material')=="no" ){?>
					<td>
					    <input name="USDOT_hazardous_material" type="radio" value="yes" id="yes" required autofocus> Yes &nbsp;
					    <input name="USDOT_hazardous_material" type="radio" value="no" id="no" checked="checked"> No
					</td>
					<?php }else{?>
					<td>
					    <input name="USDOT_hazardous_material" type="radio" value="yes" id="yes" required autofocus> Yes &nbsp;
					    <input name="USDOT_hazardous_material" type="radio" value="no" id="no"> No
					</td>
					<?php }?>

				</tr>
			    </table>

			    <table class="table table-bordered tab_show"  vspace="50" hspace="50" style="display: none;">
				<tr>
				    <td>Shipping Name (49 CFR 172.101)</td>
				    <td><input name="shipping_name" type="text" value="<?php echo $session->__get('shipping_name')?>"></td>
				</tr>
				<tr>
				    <td>Technical Descriptors</td>
				    <td><input name="technical_descriptors" type="text" value="<?php echo $session->__get('technical_descriptors')?>"></td>
				</tr>
				<tr>
				    <td>Hazard Class</td>
				    <td><input name="hazard_class" type="text" value="<?php echo $session->__get('hazard_class')?>"></td>
				</tr>
				<tr>
				    <td>UN/NA Number</td>
				    <td><input name="un/na_number" type="text" value="<?php echo $session->__get('un/na_number')?>"></td>
				</tr>
				<tr>
				    <td>Packing Group</td>
				    <td>
					<select style="width:175px;" name="parking_grup">
					    <?php if($session->__get("parking_grup")){?>
        					<option value="<?php echo $session->__get("parking_grup");?>"><?php echo $session->__get("parking_grup");?></option>
					    <?php }else{ ?>
						<option value="">Select</option>
					    <?php } ?>
					    <option value="I">I</option>
					    <option value="II">II</option>
					    <option value="III">III</option>
					    <option value="n/a">n/a</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>ERG</td>
				    <td><input name="erg" type="text" value="<?php echo $session->__get('erg')?>"></td>
				</tr>
				<tr>
				    <td>RQ</td>
				    <td><input name="rq" type="text" value="<?php echo $session->__get('rq')?>"></td>
				</tr>
				<tr>
				    <td>Inhalation Hazard</td>
				    <?php if(($session->__get("inhalation_hazard"))=='yes') { ?>
					<td><input name="inhalation_hazard" type="radio" value="yes" checked="checked" class="yes">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
					<input name="inhalation_hazard" type="radio" value="no" class="no">&nbsp;&nbsp; No</td>
				    
				    <?php }else if(($session->__get("inhalation_hazard"))=='no') {?>
				    <td><input name="inhalation_hazard" type="radio" value="yes" class="yes">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="inhalation_hazard" type="radio" value="no" checked="checked" class="no">&nbsp;&nbsp; No</td>
				    
				    <?}else{?>
				    
				    <td><input name="inhalation_hazard" type="radio" value="yes" class="yes">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;
				    <input name="inhalation_hazard" type="radio" value="no" class="no">&nbsp;&nbsp; No</td>
				    
				    <?php }?>
				    </tr>
				</table>
				<table class="table table-bordered display" id="" vspace="50" hspace="50" style="display: none;">
			        <tr>
					<td>Zone</td>
					<td>
					    <select style="width:175px;" name="zone">
						<?php if($session->__get("zone")){?>
						    <option value="<?php echo $session->__get("zone");?>">
						    <?php echo $session->__get("zone");?></option>
						<?php }else{ ?>
						    <option value="">Select</option>
						<?php } ?>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
					    </select>
					</td>
				    </tr>
			    </table>
			    </br>
			    </br>
			    <div>
				<a href="<?php echo BASE_URL;?>/generators/rcra_charaterization" class="btn btn-success">Previous</a>
				&nbsp;&nbsp;<input name="Next" type="submit" value='Next' class="btn btn-success" />
				&nbsp;&nbsp;<input name="save" type="submit" value='Save & Return' class="btn btn-success save"/> 
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
      $(document).ready(function(){
      $(".yes").click(function(){
	   $(".display").show();
      });
      $(".no").click(function(){
	   $(".display").hide();
      });
});
</script>
