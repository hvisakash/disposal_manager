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
      $redirect->redirect("".BASE_URL."/generators/rcra_charaterization");
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
			    <h4><b>SHIPPING VOLUME & FREQUENCY</b></h4>
			    <br>
			    <table class="table table-bordered" vspace="50" hspace="50">
				<tr>
				    <td>Bulk Liquid :</td>
				    <td>
					    <input name="radio1" type="radio"> Yes &nbsp;
					    <input name="radio1" type="radio"> No
				    </td>
				</tr>
				<tr>
				    <td>Bulk Solids :</td>
				    <td>
					    <input name="radio2" type="radio"> Yes &nbsp;
					    <input name="radio2" type="radio"> No
				    </td>
				</tr>
				<tr>
				    <td>Drum Size :</td>
				    <td>
					<select style="width:175px;">
					    <option>Select</option>
					    <option>5</option>
					    <option>15</option>
					    <option>30</option>
					    <option>55</option>
					    <option>85</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Drum Type</td>
				    <td>
					<select style="width:175px;">
					    <option>Select</option>
					    <option> DM - metal </option>
					    <option>DF - fiber</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Totes :</td>
				    <td>
					<select style="width:175px;">
					    <option>Select</option>
					    <option>Size in Gallons</option>
					    <option>Metal or Plastic</option>
					</select>
				    </td>
				</tr>
				<tr>
				    <td>Require Return of Tote? :</td>
				    <td>
					    <input name="radio3" type="radio"> Yes &nbsp;
					    <input name="radio3" type="radio"> No
				    </td>
				</tr>
				<tr>
				    <td>Skids or CYB :</td>
				    <td>
					    <input name="radio4" type="radio"> Yes &nbsp;
					    <input name="radio4" type="radio"> No
				    </td>
				</tr>
				<tr>
				    <td>Frequency  :</td>
				    <td>
					<select style="width:175px;">
					    <option>Select</option>
					    <option>One-Time</option>
					    <option>Weekly</option>
					    <option>Monthly</option>
					    <option>Quarterly</option>
					    <option>Annually</option>
					    <option>Other</option>
					</select>
				    </td>
				</tr>
			    </table>
			    </br>
			    </br>
			    <div>
				&nbsp;&nbsp;<button class="btn btn-success pre" id="Previous">Previous</button>
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
