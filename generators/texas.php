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

//Next and add waste in data base functionality
if((isset($_POST["Next"])) OR isset($_POST['save']))
{
  //create array and store in previous value in array variable 
  $userinfo[]=$session->__get("save_return");
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
  if(isset($_POST['save']))
  {
    $check=$generators->save_return();
      //check a value true or false
    if($check){
      echo "Data Is Save";
    }else{
      echo "Data is Not Save";
    }
  }
  if(isset($_POST['Next'])){
    $redirect->redirect("".BASE_URL."/generators/waste_information");
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
		      <h3>Is the site located within the state of Texas ?</h3>
		      </br>
		      </br>
		      <?php if(($session->__get("state_of_texas"))=='yes')
		      { ?>
		      <div>
			<input name="state_of_texas" type="radio" value="yes" checked="checked" required autofocus>&nbsp; &nbsp;Yes
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="state_of_texas" type="radio" value="no"> &nbsp; &nbsp; No    
		      </div>
		      <?php }else if(($session->__get("state_of_texas"))=='no'){  ?>
		      <div>
			<input name="state_of_texas" type="radio" value="yes"  required autofocus>&nbsp; &nbsp;Yes
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="state_of_texas" type="radio" value="no" checked="checked"> &nbsp; &nbsp; No    
		      </div>

		      <?php }else{ ?>
		      <div>
			<input name="state_of_texas" type="radio" value="yes" required autofocus>&nbsp; &nbsp;Yes
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="state_of_texas" type="radio"  value="no"> &nbsp; &nbsp; No    
		      </div>
		      <?php }?>
		      </br>
		      </br>
		      <div>
			&nbsp;&nbsp;
			<a href="<?php echo BASE_URL;?>/generator/Services/<?php echo $session->__get('service_id');?>" class="btn btn-success">Previous</a>
			&nbsp;&nbsp;
			<input name="Next" type="submit" value='Next' class="btn btn-success" />
			&nbsp;&nbsp;
			<input name="save" type="submit" value='Save & Return' class="btn btn-success"/> 
		      </div>
		    </form>
		  </div>
	        </div>
	      </div>
	    </div>
	  </div>
    <?php include("../include/footer.php");?>
</div>
</body>
</html>
