<?php
include("../init.php");
if(isset($_POST['btnsubmit_admin']))
{
//    $unique_str = uniqid();
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
        "date" => 'not_login',
        );
    $admin=Admin::getInstance();
    $id = $admin->add_administrator($array);
    if($id=="email"){
        $array['email']="false";
    }
    else{
        $array['id'] = $id;
    }
    echo json_encode($array);

}
