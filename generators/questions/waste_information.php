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
      $redirect->redirect("".BASE_URL."/generators/waste_composition");
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
			    <h4><b>GENERAL WASTE INFORMATION</b></h4>
			    <br>
			    <table class="table table-bordered" vspace="50" hspace="50">
				<tr>
				    <td>Waste Stream Name:</td>
				    <td><input name="" type="text"></td>
				</tr>
				<tr>
				    <td>Process Generating the Waste:</td>
				    <td><input name="" type="text"></td>
				</tr>
				<tr>
				    <td>Waste Determination (check all that apply):</td>
				    <td>
					&nbsp;&nbsp;<input name="" type="checkbox"> &nbsp;&nbsp; Testing
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;Generator
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;Knowledge
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;MSDS
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;Sample
				    </td>
				</tr>
				<tr>
				    <td>Unused or Virgin Material?</td>
				    <td><input name="unused" type="radio">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;<input name="unused" type="radio">&nbsp;&nbsp; No</td>
				</tr>
				<tr>
				    <td>Disposal Restrictions?  (Check all that apply)</td>
				    <td>
					&nbsp;&nbsp;<input name="" type="checkbox"> &nbsp;&nbsp; No Landfill
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;No Canada Disposal
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;Destruction Required
					<br>
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;Must Be Rendered Unusable
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;Waste to Energy Required
					&nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;Recycling Preferred
				    </td>
				</tr>
				<tr>
				    <td>Is the Waste Exempt from RCRA Regulations:</td>
				    <td><input name="rcra" type="radio">&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp;&nbsp;<input name="rcra" type="radio">&nbsp;&nbsp; No</td>
				</tr>
			    </table>
			   
			    <h4><b>SPECIFIC HAZARDS (check boxes: allow user to select all that apply)</b></h4>
			    
				<table width="100%" class="table">
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="" type="checkbox"> &nbsp;&nbsp;	Flammable
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Explosive*
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Air Reactive
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Infectious***
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="" type="checkbox"> &nbsp;&nbsp;	Corrosive
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Pyrophoric
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Water Reactive
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Carcinogen
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="" type="checkbox"> &nbsp;&nbsp;	Poison
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Organic Peroxide*
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Reactive Cyanides (if yes, list PPM)
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Radioactive****
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="" type="checkbox"> &nbsp;&nbsp;	Oxidizer
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Polymerizer
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Reactive Sulfides (if yes, list PPM)
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Lachrymator
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="" type="checkbox"> &nbsp;&nbsp;	Aerosol
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		PCBs*****
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Shock Sensitive
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Inhalation Hazard
					</td>
				    </tr>
				    <tr>
					<td>
					    &nbsp;&nbsp;<input name="" type="checkbox"> &nbsp;&nbsp;	Compressed Gas**
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Benzene^
					</td><td>
					    &nbsp;&nbsp;<input name="" type="checkbox">&nbsp;&nbsp;		Temperature Sensitive
					</td>
				    </tr>
				</table>
			    </br>
			    </br>
			    <div>
				&nbsp;&nbsp;<button class="btn btn-success pre">Previous</button>
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
    //redirect start profile page
    $(document).ready(function(){
    $(".pre").click(function(){
    window.location.replace("'.BASE_URL.'/generators/Services");
    });
});
</script>
