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
      $redirect->redirect("".BASE_URL."/generators/characteristics");
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
			    <table class="table table-striped" >
				<thead>
				    <tr>
					<th>Component</th>
					<th>CAS#</th>
					<th>Minimum</th>
					<th>Unit (%, ppm)</th>
					<th>Maximum</th>
					<th>Unit (%, ppm)</th>
				    </tr>
				</thead>
				<tbody>
				    <td><input name="component" type="text"></td>
				    <td><input name="cas" type="text"></td>
				    <td><input name="minimum" type="text"></td>
				    <td><input name="min_unit" type="text"></td>
				    <td><input name="maximum" type="text"></td>
				    <td><input name="max_unit" type="text"></td>
				</tbody>
			    </table>
			    <h4><b>DOCUMENTATION (MSDS, Analysis, Etc.)</b></h4>
			    <table width="100%" class="table table-striped">
				    <tr>
					<td>Type of document</td>
					<td><input type="file" name="documentation" value=""></td>
				    </tr>
			    <tr>
				<td>METALS PRESENT (Check Boxes: Yes or No)</td>
				<td>
				    <input name="metals" type="checkbox" class="check1">
				</td>
			    </table>
			    
			    
				<table width="100%" class="table table-striped matals_show" style="display:none">
				    <tr>
					<td>Aluminium</td>
					<td>
					    <input name="metals_aluminium" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_aluminium" type="radio" value="no"> No
					</td>
					<td>Cadmium</td>
					<td><input name="metals_cadmium" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_cadmium" type="radio" value="no"> No
					</td>
					<td>Lead</td>
					<td>
					     	<input name="metals_lead" type="radio" value="yes">Yes &nbsp;
						<input name="metals_lead" type="radio" value="no"> No
					</td>
					<td>Selenium</td>
					<td>
					    <input name="metals_" type="radio" value="yes">Yes &nbsp;
					    <input name="metals_" type="radio" value="no"> No
					</td>
				    </tr>
				    <tr>
					<td>Antimony</td>
					<td>
					    <input name="metals_antimony" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_antimony" type="radio" value="no"> No
					</td>
					<td>Chromium</td>
					<td><input name="metals_chromium" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_chromium" type="radio" value="no">No
					</td>
					<td>Manganese</td>
					<td>
					     	<input name="metals_manganese" type="radio" value="yes">Yes &nbsp;
						<input name="metals_manganese" type="radio" value="no"> No
					</td>
					<td>Silver</td>
					<td>
					    <input name="metals_silver" type="radio" value="yes">Yes &nbsp;
					    <input name="metals_silver" type="radio" value="no"> No
					</td>
				    </tr>
				    
				    <tr>
					<td>Arsenic</td>
					<td>
					    <input name="metals_arsenic" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_arsenic" type="radio" value="no"> No
					</td>
					<td>Cobalt</td>
					<td><input name="metals_cobalt" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_cobalt" type="radio" value="no">No
					</td>
					<td>Mercury</td>
					<td>
					    <input name="metals_mercury" type="radio" value="yes">Yes &nbsp;
					    <input name="metals_mercury" type="radio" value="no"> No
					</td>
					<td>Thallium</td>
					<td>
					    <input name="metals_thallium" type="radio" value="yes">Yes &nbsp;
					    <input name="metals_thallium" type="radio" value="no"> No
					</td>
				    </tr>
				     <tr>
					<td>Barium</td>
					<td>
					    <input name="metals_barium" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_barium" type="radio" value="no"> No
					</td>
					<td>Copper</td>
					<td><input name="metals_copper" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_copper" type="radio" value="no">No
					</td>
					<td>Nickel</td>
					<td>
					     	<input name="metals_nickel" type="radio" value="yes">Yes &nbsp;
						<input name="metals_nickel" type="radio" value="no"> No
					</td>
					<td>Zinc</td>
					<td>
					    <input name="metals_zinc" type="radio" value="yes">Yes &nbsp;
					    <input name="metals_zinc" type="radio" value="no"> No
					</td>
				    </tr>
				    <tr>
					<td>
					    Beryllium
					</td>
					<td><input name="metals_beryllium" type="radio" value="yes"> Yes &nbsp;
					    <input name="metals_beryllium" type="radio" value="no"> No
					</td>
				    </tr> 
				</table>
			    </br>
			    </br>
			    
			    <div>
				&nbsp;&nbsp;<button class="btn btn-success previous" id="">Previous</button>
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
//alert("if");
    $(".matals_show").show();
    }else{
//alert("else");
	 $(".matals_show").hide();
    }
}).change();
</script>
