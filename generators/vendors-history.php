<script>
function myconfirm(ele) {
	 //$(document).ready(function(){
	id=ele.id;
	//alert();
	var con=confirm("Are you Sure you want to ban this vendor?");
	if ( con== true) {
   
	var info = 'v_id=' + id;
		$.ajax({
            type: "POST",
            data: info,
            url: "ajaxcalling.php",
            success: function(msg) {
                alert(" Vendors Successfully Banned ");
				$("#"+id+"").parent().parent().parent().remove();
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
	
	$row=$generators->select_vendors_past();
     //echo"<pre>";print_r($row);die("HHEE");
	 
// Vendors Search_By_Upload_Date
	
	if(isset($_POST['search'])){
		if(isset($_POST['start'])and($_POST['end'])){
		    $array=array("startdate"=>$_POST['start'],"enddate"=>$_POST['end']);	
						
			$row=$generators->search_by_date_range($array);
				//echo"<pre>";print_r($row);die("BRAJBHOOSHAN");
		}
	}
//echo"<pre>";print_r($row);die("DRAH");
     //includding header portion
    include("../include/header.php");
    include("../include/header_menu.php");
?>
	<div class="banner bannerwithnoimg">
	    <div class="container">
		<div class="bannertxt col-lg-12">
		    <span class="page_heading">Vendors – History</span>
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
	      <div id="date">
			  <br/><br/><?php echo "Search By Date";?><br/><br/>
              			Start Date: <input type="text" name="start" id="datepicker"/>                
                		&nbsp;&nbsp;&nbsp;&nbsp;
              			Last Date: <input type="text" name="end" id="datepi"/>
                        </select>
                </div><br/>
                <input type="submit" name="search" class="btn btn-success" value="Search"/>
                <br/><br/>

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
            <td>Ban</td>
            </tr>
            </thead>
            <tbody >
             <?php foreach($row as $record){?>
             
             <tr class="last_login">
             <td><?php  echo $record['firstname'];?></td>
             <td><?php  echo $record['lastname'];?></td>
             <td><?php  echo $record['address1'];?></td>
             <td><?php  echo $record['address2'];?></td>
            <td></td>
            <td><?php  echo $record['date'];?></td>
            <td>
            <div id="<?php  echo $record['id'];?>" value="<?php  echo $record['id'];?>"  class="vender_id">
            <input type="checkbox" id="<?php  echo $record['id'];?>"  value="<?php  echo $record['id'];?>" onclick="myconfirm(this);" name="ban" class="vender_id" />
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
			  changeYear: true//this option for allowing user to select from year range
			  //dateformate:"M-d-Y"
		  ,dateFormat: 'M-dd-yy'});
			
			$("#datepi").datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true //this option for allowing user to select from year range
			,dateFormat: 'M-dd-yy'});
		  });
			</script>
