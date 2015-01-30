<?php
//including initial file
require_once("../init.php");
$generator = Generators::getInstance();
//creat object for session class
$session = $init->getSession();
//Call function to select all record for selected sites to be updated
if(isset($_POST['site_id']))
{
    $id=$_POST['site_id'];
    $update=$generator->select_edit_sites($id);
    echo json_encode($update);
}
//calling function for ban vendor
if(isset($_POST['v_id']))
{
		$update=$generator->vendors_ban($_POST['v_id']);
		echo json_encode($update);

}
//calling function for favourite vendor
if(isset($_POST['v_fav']))
{
 $update=$generator->favourite_vendors($_POST['v_fav'],$session->__get("user_id"));
		echo json_encode($update);

}
//calling function for resume ban vendor
if(isset($_POST['v_unban']))
{
 $update=$generator->resume_ban_vendors($_POST['v_unban']);
		echo json_encode($update);

}
if(isset($_POST['old_sites_id']))
{
    $value=$generator->select_edit_sites($_POST['old_sites_id']);
 echo json_encode($value);

}
?>
