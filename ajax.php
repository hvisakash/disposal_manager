<?php
//including initial file
include_once("init.php");

//creating object of session class
$session=$init->getSession();

//creating object of redirect class
$redirect=$init->getRedirect();
//creating object of user class
$user = User::getInstance();
// register account
 
if(isset($_POST['companyname']))
{
  
    $array = array(
        "companyname" => $_POST['companyname'],
        "department" => $_POST['department'],
        "firstname" => $_POST['firstname'],
        "lastname" => $_POST['lastname'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "address1" => $_POST['address1'],
        "address2" => $_POST['address2'],
        "city" => $_POST['city'],
        "state" => $_POST['state'],
        "zipcode" => $_POST['zipcode'],
        "epa_id" => $_POST['epa_id'],
        "contact" => $_POST['contact'],
        "fax" => $_POST['fax'],
        "date" => 'first time login',
	"roll"=>$_POST['selectname']
    );

    $id =$user->register($array);
    if($id=="email"){
        $array['email']="false";
    }
    else{
      
        $array['email'] = "true";
    }
    echo json_encode($array);
}
?>