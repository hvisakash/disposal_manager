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
 //   echo "<pre>";print_r($_POST);die;

      $redirect->redirect("".BASE_URL."/generators/don_shipping_information");
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
			    <h4><b>RCRA CHARACTERIZATION</b></h4>
			    <br>
			    <table class="table table-bordered" vspace="50" hspace="50">
				<tr>
					<td>Is stream a USEPA Hazardous Waste (40 CFR 261.3)</td>
					<td>
					    <input name="USEPA_hazardous" type="radio" value="yes"> Yes &nbsp;
					    <input name="USEPA_hazardous" type="radio" value="no"> No
					</td>
				</tr>
				<tr>
					<td>Is stream a Universal Waste (40 CFR 273)</td>
					<td>
					    <input name="universal" type="radio" value="yes"> Yes &nbsp;
					    <input name="universal" type="radio" value="no"> No
					</td>
				</tr>
				<tr>
				    <td>EPA Waste Codes</td>
				    <td><input name="EPA_waste_codes" type="text"> </td>
				</tr>
				<tr>
				    <td>Source Code </td>
				    <td>
					<select style="width:175px;" name="sorce_code">
					    <option>Select</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Form Code </td>
				    <td>
					<select style="width:175px;" name="form_code">
					    <option>Select</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Management Method </td>
				    <td>
					<select style="width:175px;" name="management_method">
					    <option>Select</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Texas State Waste Codes (if Generator is in Texas)</td>
				    <td>
					    <input name="texas_state_waste_code" type="radio" value="yes" class="texas_code_yes" value="yes"> Yes &nbsp;
					    <input name="texas_state_waste_code" type="radio" value="no" class="texas_code_no" value="no"> No
				    </td>
				</tr>
			    </table>
			    <table class="table table-bordered texas_code" vspace="50" hspace="50" style="display: none;">
				<tr>
				    <td>Texas State Waste Code</td>
				    <td>
					    <input name="texas_state_waste_code_text" type="text"> 
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


<!-- RCRA CHARACTERIZATION Texas State Waste Codes (if Generator is in Texas)-->
    <script>
	$(".texas_code_yes").click(function(){
	    $(".texas_code").show();
	    });
	$(".texas_code_no").click(function(){
	    $(".texas_code").hide();
	    });

    </script> 
  
  
