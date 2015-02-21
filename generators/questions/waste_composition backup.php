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
	    $redirect->redirect("".BASE_URL."/generators/characteristics");
	}
    }
//get a array value in session
$metals=$session->__get("metals");
if($session->__get("component"))
{
    $component_key=array();
    $cas_key=array();
    $minimum_key=array();
    $min_unit_key=array();
    $maximum_key=array();
    $max_unit_key=array();
    for($row=0; $row < sizeof($session->__get("component")); $row++)
	{
	    $component_key[$row]="component";
	    
	}
    $component_value=$session->__get("component");
    $component[] = array_combine($component_value,$component_key);

    for($row=0; $row < sizeof($session->__get("cas")); $row++)
	{
	    $cas_key[$row]="cas";
	    
	}    
    
    $cas_value=$session->__get("cas");
    $cas = array_combine($cas_value,$cas_key);

    for($row=0; $row < sizeof($session->__get("minimum")); $row++)
	{
	    $minimum_key[$row]="minimum";
	    
	}    
    
    $minimum_value=$session->__get("minimum");
    $minimum = array_combine($minimum_value,$minimum_key);

    for($row=0; $row < sizeof($session->__get("min_unit")); $row++)
    {
	$min_unit_key[$row]="min_unit";
	
    }    

    $min_unit_value=$session->__get("min_unit");
    $min_unit = array_combine($min_unit_value,$min_unit_key);
    
    for($row=0; $row < sizeof($session->__get("maximum")); $row++)
	{
	    $maximum_key[$row]="maximum";
	    
	}    
    
    $maximum_value=$session->__get("maximum");
    $maximum = array_combine($maximum_value,$maximum_key);

    for($row=0; $row < sizeof($session->__get("max_unit")); $row++)
    {
	$max_unit_key[$row]="max_unit";
	
    }    

    $max_unit_value=$session->__get("max_unit");
    $max_unit = array_combine($max_unit_value,$max_unit_key);
    array_push($component,$cas,$minimum,$min_unit,$maximum,$max_unit);

}

// includding header portion
    include("../../include/header.php");
    include("../../include/header_menu.php");
?>
<!DOCTYPE html>
<html>				
<link href="<?php echo BASE_URL;?>/css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="<?php echo BASE_URL;?>/js/bootstrap.min.js"></script>
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
			    <h4><b>GENERAL WASTE COMPONENT</b></h4>
			    <br><br>
			    <table class="table table-striped add_new" >
				<thead>
				    <tr>
					<th>Component</th>
					<th>CAS#</th>
					<th>Minimum</th>
					<th>Unit (%, ppm)</th>
					<th>Maximum</th>
					<th>Unit (%, ppm)</th>
				    </tr>
				    <tr>
					<td><a href="javascript:void(0);" class='anc_add'><font size="+1"><b>+</b></font></a></td>
				    </tr>
				</thead>
				<tbody>
				    <?php
				    if($session->__get("component"))
				    {
					
//echo "<pre>"; var_dump($component);//die("jere");
					foreach($component as $key=>$value)
					{
					    //echo $key;die;
					    foreach($value as $keys=>$val )
					    {

//					    echo ."<br>";
//					    echo $val;
					    //echo $component[0][1];
					    }
				   echo "<br>";
					}
				   
//check 				   
					foreach($component as $key=>$value)
					{
					    echo "<tr>";
					    foreach($value as $keys=>$val )
					    {
	
						echo "<td><input name='".$val."[]' type='' value=".$keys."></td>";
	
					    }
					    echo "</tr>";
					}
				    }else{?>
				<tr>
				    <td><input name="component[]" type="text"></td>
				    <td><input name="cas[]" type="text"></td>
				    <td><input type="text" name="minimum[]"></td>
				    <td><input type="text" name="min_unit[]"></td>
				    <td><input type="text" name="maximum[]"></td>
				    <td><input type="text" name="max_unit[]"></td>
				</tr>
					
					
				    <?php }
				?>
				</tbody>
				</table>
			    <h4><b>DOCUMENTATION (MSDS, Analysis, Etc.)</b></h4>
			    <table width="100%" class="table table-striped">
				    <tr>
					<td>Type of document</td>
					<td><input type="file" name="documentation" value="<?php echo $session->__get("documentation");?>"></td>
				    </tr>
			    <tr>
				<td>METALS PRESENT (Check Boxes: Yes or No)</td>
				<td>
				    
					    <?php
					    if (is_array($metals) && in_array("METALS PRESENT", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="METALS PRESENT" checked="checked" class="check1"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="METALS PRESENT" class="check1"> &nbsp;&nbsp;';						
						}    
					    ?>

				</td>
			    </table>
			    
			    
				<table width="100%" class="table table-striped matals_show" style="display:none">
				    <tr>
					<td>Aluminium</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Aluminium", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Aluminium" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Aluminium" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Cadmium</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Cadmium", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Cadmium" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Cadmium" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Lead</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Lead", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Lead" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Lead" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Selenium</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Selenium", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Selenium" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Selenium" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
				    </tr>
				    <tr>
					<td>Antimony</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Antimony", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Antimony" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Antimony" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Chromium</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Chromium", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Chromium" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Chromium" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Manganese</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Manganese", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Manganese" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Manganese" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Silver</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Silver", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Silver" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Silver" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
				    </tr>
				    
				    <tr>
					<td>Arsenic</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Arsenic", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Arsenic" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Arsenic" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Cobalt</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Cobalt", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Cobalt" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Cobalt" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Mercury</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Mercury", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Mercury" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Mercury" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Thallium</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Beryllium", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Thallium" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Thallium" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
				    </tr>
				     <tr>
					<td>Barium</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Barium", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Barium" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Barium" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Copper</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Copper", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Copper" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Copper" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Nickel</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Nickel", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Nickel" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Nickel" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
					<td>Zinc</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Zinc", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Zinc" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Zinc" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
				    </tr>
				    <tr>
					<td>
					    Beryllium
					</td>
					<td>
					    <?php
					    if (is_array($metals) && in_array("Beryllium", $metals))
					    {
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Beryllium" checked="checked"> &nbsp;&nbsp;';						
					    }else{
						echo '&nbsp;&nbsp;<input name="metals[]" type="checkbox" value="Beryllium" class=""> &nbsp;&nbsp;';						
						}    
					    ?>
					</td>
				    </tr> 
				</table>
			    </br>
			    </br>
			    
			    <div>
				<a href="<?php echo BASE_URL;?>/generators/waste_information" class="btn btn-success">Previous</a>
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

$(document).ready(function(){
var cnt = 2;
$(".anc_add").click(function(){
$('.add_new tr').last().after('<tr><td><input name="component[]" type="text"></td><td><input name="cas[]" type="text"></td><td><input type="text" name="minimum[]"></td><td><input type="text" name="min_unit[]"></td><td><input type="text" name="maximum[]"></td><td><input type="text" name="max_unit[]"></td></tr>');
//$('.tab1').last().after('.t1');
cnt++;
//alert(cnt);
});
});
</script>