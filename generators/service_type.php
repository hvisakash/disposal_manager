<?php
if(isset($_GET["service"]))
{
  $service_type=$_GET["service"];
}
//including initial file
include("../init.php");
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
	$array = array(
        "waste" => $_POST['waste'],
        "process_generating" => $_POST['process_generating'],
	"profile_no" => $_POST['profile_no'],
        "source" => $_POST['source'],
	"sample_available" => $_POST['sample_available']
	);
	$value=$generators->wasts($session->__get('user_id'),$array);
	if($value==1)
	{
	    $redirect->redirect("".BASE_URL."/generators/Texas");
	}
    }
    // includding header portion
    include("../include/header.php");
    include("../include/header_menu.php");
?>
<div class="banner bannerwithnoimg">
    <div class="container">
	<div class="bannertxt col-lg-12">
	    <span class="page_heading">
		<?php if('paint_wast'==$service_type)
			{
			    echo "Paint Wast Page";
			}
			elseif('hazardous_waste'==$service_type || 'non_hazardous_waste'==$service_type || 'universal_waste'== $service_type || 'not_sure'== $service_type)
			{
			    echo "Regular Waste Page";
			}
			elseif('used_Oil'==$service_type)
			{
			    echo "Used Ole Page";
			}elseif('cylinders'==$service_type)
			{
			    echo " Cylinders Page";
			}
			elseif('lab_pack'==$service_type)
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
		<div class=" ">
		    <div >
			
		    </div>
		</div>
		</br>
		</br>
		<div class="col-lg-12">
		   
		    <div class="col-lg-12">
			
			<h2></h2></br>
		    </div>
		    </br>
		    </br>
		    <div>
			 <form name="frm" method='post'>
			</br></br>
			<table>
			<tr>
			    <td>Name of Waste:</td>
			    <td><input name="waste" type="" value="<?php echo $session->__get('waste')?>" required autofocus/></td>
			</tr>
			<tr>
			    <td>Process Generating Waste: &nbsp;&nbsp;&nbsp;&nbsp;</td>
			    <td><input name="process_generating" type="text" value="" required autofocus/></td>
			</tr>
			<tr>
			    <td>Profile Number:</td>
			    <td><input name="profile_no" type="text" value="" required autofocus/></td>
			</tr>
			<tr>
			    <td>Source:</td>
			    <td><input name="source" type="text" value="" required autofocus/></td>
			</tr>
			<tr>
			    <td>Sample Available: </td>
			    <td><input name="sample_available" type="text" value="" required autofocus/></td>
			</tr>
			</table>
			</br></br>
			<div>
			     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    <button class="btn btn-success pre" id="Previous">Previous</button>
			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    <input name="Next" type="submit" value='Next' class="btn btn-success"/ >
			     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			     <input name="save" type="submit" value='Save & Return' class="btn btn-success"/ > 
			</div>
		   </div>
		   </form>
		 </div>
		
	    
	</div>
    </div>
    <?php include("../include/footer.php");?>
</div>
</body>
</html>
<script>
//redirect start profile page
$(document).ready(function(){
  $("#Previous").click(function(){
 window.location.replace("'.BASE_URL.'/generators/profiles-page");
  });
});
</script>
