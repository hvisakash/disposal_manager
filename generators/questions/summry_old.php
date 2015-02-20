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
		    <div style="float:left;width:48%;">
				<table class="table table-bordered">
					<tr>
						<td>Material to be profiled : </td>
						<td><?php echo $session->__get("service_material");?></td>
					</tr>
						
				<?php if($session->__get("service_id")==1){?>
					<tr>
						<td>Name of Waste: </td>
						<td><?php echo $session->__get("waste_name");?></td>
					</tr>

					<tr>
						<td>Process Generating Waste : </td>
						<td><?php echo $session->__get("process_generating");?></td>
					</tr>

					<tr>
						<td>Profile Number : </td>
						<td><?php echo $session->__get("profile_no");?></td>
					</tr>

					<tr>
						<td>Source: </td>
						<td><?php echo $session->__get("source");?></td>
					</tr>

					<tr>
						<td>Sample Available : </td>
						<td><?php echo $session->__get("sample_available");?></td>
					</tr>
				<?php }?>

					<tr>
						<td>Is the site located within the state of Texas ?</td>
						<td><?php echo $session->__get("state_of_texas");?></td>
					</tr>
				</table>
		    </div>
		    <div style="width:48%;float:left; margin-left:10px;">
				<table class="table table-bordered">
					<tr>
						<td>Waste Stream Name:</td>
						<td><?php echo $session->__get("state_of_texas");?></td>
					</tr>

					<tr>
						<td>Process Generating the Waste:</td>
						<td><?php echo $session->__get("process_generating_waste");?></td>
					</tr>

					<tr>
						<td>Waste Determination : </td>
						<td>
							<?php
								$str="";
								$i=0;
								foreach ($session->__get("waste_determination") as $key => $value) {
									if($i==(sizeof($session->__get("waste_determination"))-1))
										$str .=$value;
									else
										$str .= $value. ",";
								$i++;
								}
								echo $str;
							?>
							<?php echo $session->__get("determination_testing");?>
						</td>
					</tr>

					<tr>
						<td>Unused or Virgin Material? : </td>
						<td><?php echo $session->__get("unused");?></td>
					</tr>

					<tr>
						<td>Disposal Restrictions? : </td>
						<td>
							<?php
								$str="";
								$i=0;
								foreach ($session->__get("disposal_restriction") as $key => $value) {
									if($i==(sizeof($session->__get("disposal_restriction"))-1))
										$str .=$value;
									else
										$str .= $value. ",";
								$i++;
								}
								echo $str;
							?>
							<?php echo $session->__get("determination_testing");?>
						</td>
					</tr>

					<tr>
						<td>Is the Waste Exempt from RCRA Regulations: </td>
						<td><?php echo $session->__get("rcra_regulations");?></td>
					</tr>

				</table>
		    </div>
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

