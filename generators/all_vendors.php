<?php
//including initial file
include("../init.php");
    $session = $init->getSession();
	
    $redirect = $init->getRedirect();
    $generators = Generators::getInstance();
    $result=$generators->lastdate();
	//echo"<pre>";print_r($session);die("RRR");
    if(!$session->__get("roll")==2)
    {
      $redirect->redirect(BASE_URL."/signin");
    }
      elseif($session->__get("roll")==1)
    {
      $redirect->redirect("../admin");
    }
    elseif($session->__get("roll")==3)
    {
      $redirect->redirect("../vendors");
    }
    $profile_pic=$generators->profile_pic();

//Select Banned Vendors from Vendors_ban_tb Table	
	$row=$generators->select_all_vendors();

//includding header portion
    include("../include/header.php");
    include("../include/header_menu.php");
?>
	<div class="banner bannerwithnoimg">
	    <div class="container">
		<div class="bannertxt col-lg-12">
		    <span class="page_heading">All - Vendors</span>
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
                        <span class="last_login">Last login:</span>
                        <span class="date"><?php echo $result['date'];?></span>
		    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
		 
		      <form method="post" class="last_login" style="text-align:center">
	      <div id="date"><!---
			  <br/><br/><?php echo "Search By Date";?><br/><br/>
              			Start Date: <input type="text" name="start" id="datepicker"/>                
                		&nbsp;&nbsp;&nbsp;&nbsp;
              			Last Date: <input type="text" name="end" id="datepi"/>
                        </select>
                </div><br/>
                <input type="submit" name="search" class="btn btn-success" value="Search"/>
                <br/><br/>
-->
           </form>
		</div>
		<div class="col-lg-12">
		    <div class="options">
		  <table align="center" border="1" id="showdata" class="table table-bordered" vspace="50" hspace="50">
          	<thead class="last_login">
            <tr>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Address 1</td>
            <td>Address 2</td>
            <td>Profile Name</td>
            <td>Date</td>
            <td>Favourite</td>
            </tr>
            </thead>
            <tbody >
             <?php foreach($row as $record){
			 ?><tr class="last_login">
             <td><?php  echo $record['firstname'];?></td>
             <td><?php  echo $record['lastname'];?></td>
             <td><?php  echo $record['address1'];?></td>
             <td><?php  echo $record['address2'];?></td>
            <td></td>
            <td><?php  echo $record['date'];?></td>
            <td>
            <div class="vender_id"  value="<?php  echo $record['id'];?>"  >
            <input type="submit" id="<?php  echo $record['id'];?>" onclick="myconfirm(this);" value="Make Favourite" />
            </div>
            </td>
            </tr>
            </tbody>
            <?php }?>
            
            
            </table>
            </div>
		</div>
       
	     
	    </div>
        </div>
        
    </div>
   </div>
  <?php include("../include/footer.php");?>
    </div>
</body>
</html>

            
            
<script>
function myconfirm(ele) {
	 //$(document).ready(function(){
    var x;
	var con=confirm("Are You Sure to Make This Vendor Favourite");
	if (con == true){
    	var id;
	    id=ele.id;
		var info = 'v_fav=' + id;
		$.ajax({
            type: "POST",
            data: info,
            url: "ajaxcalling.php",
            success: function(msg) {
				if(msg!="false")
                alert("Vendor Successfully Added as Favourite")
				else
				alert("This Vendor is already there in your favourite list")
                $('#confirmDialog').fadeOut('slow');
            },
            error: function(msg){
                alert(msg)
            }
        });
    } else {
		//window.header('location:vendor-history.php');
        
	   $(this).dialog(close);// = "You pressed Cancel!";
    }
   
	 };
</script>

            
