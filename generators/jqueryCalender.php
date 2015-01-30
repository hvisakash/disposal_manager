<?php
//including initial file
include("../init.php");
//object for generators class
    $generators = Generators::getInstance();
    //display last login date
    $result=$generators->lastdate();
    //object for profile pic
    $profile_pic=$generators->profile_pic();
    //object for session class
    $session = $init->getSession();
    //object for redirect class
    $redirect = $init->getRedirect();
    if(!$session->__get("roll")==2)
    {
      $redirect->redirect("../admin_signin.php");
    }
      elseif($session->__get("roll")==1)
    {
      $redirect->redirect("../admin");
    }
    elseif($session->__get("roll")==3)
    {
      $redirect->redirect("../vendors");
    }
  // Calling Function Select Manifest 
   $manif=$generators->select_manifest();
	//$by_date="";
	//$data="";
   //Manifests  search-by -date-function -calling
  if(isset($_POST['search'])){
    if($_POST['start'] and $_POST['end']){
      $array=array("startdate"=>$_POST['start'],"enddate"=>$_POST['end']);
      $by_date=$generators->search_by_upload_date($array);
      }
    elseif($_POST['mnumber']){
      $by_date=$generators->search_by_manifest_number($_POST['mnumber']);  
    }
    elseif($_POST['selectsite']){
     $by_date=$generators->search_by_sitename($_POST['selectsite']);
    }
  }

include("../include/header.php");
include("../include/header_menu.php");
?>
	<div class="banner bannerwithnoimg">
	    <div class="container">
		<div class="bannertxt col-lg-12">
		    <span class="page_heading">Manifest Search Page</span>
		    <span class="page_txt">Aliqat volutpasac tupis. Integer rutrum ante eu lacuestibulum libero nisl porta vel sceleris que eget</span>
		</div>
	    </div>
  	</div>
    <div class="main_div">
	<div class="rightshade"></div>
   	<div class="container">
	    <div class="row">
        	<div class="col-lg-12">
        	    <div class="">
                	<div class="profile_pic"><img src="<?php echo BASE_URL;?>/<?php echo $profile_pic['image_src'];?>" alt="profile pic" width="87" height="87"></div>
                    <span class="name"><?php echo $result['firstname'];?></span><br/>
                    <span class="last_login">Last login:</span><span class="date"><?php echo $result['date'];?></span>
	    		</div>
            </div>
		<div class="options">
                    <div class="profile_options">
			   
		    </div>
                </div>
	    </div>
	     <div class="clearfix"></div>
		<div class="col-lg-12">
		    
		       <form method="post" class="last_login" style="text-align:center">
	      <div id="date">
			  <br/><br/><?php echo "Search By Date";?><br/><br/>
              			Start Date: <input type="text" name="start" id="datepicker"/>                
                		&nbsp;&nbsp;&nbsp;&nbsp;
              			Last Date: <input type="text" name="end" id="datepi"/>
                        <br/><br/><?php echo "OR";?><br/>
                
                <?php echo "Search By Manifests Number";?><br/><br/>
                
              	<input type="text" name="mnumber" placeholder="Manifests Number"/>
                
                <br/><br/><?php echo "OR";?><br/>
                
                <?php echo "Search By Site Name";?><br/><br/>
                
                <select class="select site" name="selectsite">
                	<option>Select Site</option>
                    <?php foreach($manif as $ma){ ?>
                    <option id="<?php echo $ma['site_id'];?>" name="<?php echo $ma['site_name'];?>"><?php echo $ma['site_name'];?></option>
                    <?php }?>
                </select>
                </div><br/>
                <!---<a href="search_manifest_ajax.php?id=<?php echo'demo';?>" class="btb btn-success">SEARCH</a> -->
                <input type="submit" name="search" class="btn btn-success" value="Search"/>
                <br/><br/>
               
   		   </form> 
		 
		</div>
		<div class="col-lg-12">
		  
		  <table align="center" border="1" id="showdata" class="table table-bordered" vspace="50" hspace="50">
	    <thead >
	      <tr class="last_login">
               <td>Site Name</td>
               <td>Manifest Number</td>
               <td>Image</td>
               <td>Date</td>
               <td>Download</a>
                   </td>
               </tr>
               </thead>
               <tbody class="last_login">
               <?php
	       //	if(!isset($by_date) && ! is_array($by_date)) continue;
 if(isset($_POST['search'])){
			   foreach($by_date as $data){
				?>
			   <tr>
               <td><?php echo $data['site_name']?></td>
               <td><?php echo $data['manifestsnumber']?></td>
               <td><?php echo $data['uploadfile']?></td>
               <td><?php echo $data['upload_date']?></td>
               <td>
                <a href="download_pdf.php?id=<?php echo $data['id'];?>" >
                   <input type="submit" name="getPDF" value="Download" class="btn btn-success"/>
                   </a>
               </td>
               </tr>
               <?php }
 }?>
               </tbody>
               </table>
	   <?php include("../include/footer.php");?>
    <!-- /container -->
    <div>
      
    
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    
    <!-- Load jQuery JS -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- Load jQuery UI Main JS  -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    
    <!-- Load SCRIPT.JS which will create datepicker for input field  -->
    <script src="script.js"></script>
    
    <link rel="stylesheet" href="runnable.css" />
    <script>
			$(document).ready(
		  /* This is the function that will get executed after the DOM is fully loaded */
		  function () {
			$("#datepicker").datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true //this option for allowing user to select from year range
			});
			
			$("#datepi").datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true //this option for allowing user to select from year range
			});
		  });
			</script>
