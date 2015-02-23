<?php
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
    //search site argument
    $value=$generators->search_site($session->__get('user_id'));
    
    //create session and store site id
    //echo $value["id"];
    //$session->__set("site_id",$value['id']);
//echo $session->__get("site_id");
// die;
    
  //  echo "<pre>";
   // print_r($value);
   // die;

    if(isset($_POST['next']))
    {
	$redirect->redirect("".BASE_URL."/generators/Services");
    }
    if(isset($_POST['cancel']))
    {
	$redirect->redirect("".BASE_URL."/generators/profiles-page");
    }
    // includding header portion
    include("../include/header.php");
    include("../include/header_menu.php");

?>
<div class="banner bannerwithnoimg">
    <div class="container">
	<div class="bannertxt col-lg-12">
	    <span class="page_heading">Profiles Page</span>
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
		    <div class="options">
			<h4 class="name">Please Select The Site To Be Used</h4>
			</br></br>
			<input list="items" id="item"  type='text' required autofocus style="width: 500px; height: 35px; ">
			<datalist id="items">
			      <?php foreach($value as $row) { ?>
			    <option value="<?php echo $row['sitename'];?>"
						 data-xyz = "<?php echo $row['id']?>" selected="true">
			   <?php } ?>	
			</datalist>
			</br></br>
			<input name="submit" value="Search" type="button" id="submit" class="btn btn-success"/>
			
			</form>
		    </div>
		    </br>
		    </br>
		    <form name="frm" method="POST">
		    <table  align='center' class="table table-bordered review">
			<tr class="last_login">
			</tr>
			
		    </table>
		    <br>
		    <div class="showbutton" style='display: none;'><center>
			
			<input type="submit" value="Cancel" name="cancel" class= "btn btn-success "/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" value="Next" name="next" class= "btn btn-success"/>
			</center>
		    </div>
		    </form>
		</div>
	    </div>
	</div>
    </div>
</div>
    <?php include("../include/footer.php");?>
<script>
    
    //$('#browsers option').each(function(index) {
    //var id = $(this).val();
    //alert(id);
//});
    $(function() {

    $("#submit").click(function() {
        var val = $('#item').val()
        var xyz = $('#items option').filter(function() {
            return this.value == val;
        }).data('xyz');
        var msg = xyz ? 'old_sites_id=' + xyz : 'No Match';
	var text=$("input:text").val();
	if (msg=='No Match') {
	   window.location.replace('<?php echo BASE_URL?>/generators/Addsite/'+text);
	}else{
	$.ajax({
	    type: "POST",
	    url: "ajaxcalling.php",
	    data: msg,
	    dataType: 'json',
	    success: function(data)
		{
//		$('#rejoin').html('<tr><td>Suspend By</td><td>'+data.suspend_by+'</td></tr><tr><td>First Name</td><td>'+data.firstname+'</td></tr><tr><td>Last Name</td><td>'+data.lastname+'</td></tr><tr><td>Email Id</td><td>'+data.email+'</td></tr><tr><td>Suspend Date</td><td>'+data.suspend_date+'</td></tr>');
$('.review').html('<tr><td>Site Name </td><td>'+data.sitename+'</td><tr><td>Company Name</td><td>'+data.companyname+'</td></tr><tr><td>Department Name</td><td>'+data.companyname+'</td></tr><tr><td>First Name</td><td>'+data.firstname+'</td></tr><tr><td>Last Name</td><td>'+data.lastname+'</td></tr><tr><td>Email Id</td><td>'+data.email+'</td></tr><tr><td>Address 1</td><td>'+data.address1+'</td></tr><tr><td>Address 2</td><td>'+data.address2+'</td></tr><tr><td>City</td><td>'+data.city+'</td></tr><tr><td>State</td><td>'+data.state+'</td></tr><tr><td>Zip Code</td><td>'+data.zipcode+'</td></tr><tr><td>EPA ID</td><td>'+data.epa_id+'</td></tr><tr><td>Contact Number</td><td>'+data.contactnumber+'</td></tr><tr><td>Fax</td><td>'+data.fax+'</td></tr><tr>');		
	    $(".showbutton").show();

		}
	    });
	
	}
    })

})
    
</script>