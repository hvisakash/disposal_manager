<?php

//including initial file
include("../init.php");
//create object in generator class
$generators=Generators::getInstance();
//create object in vender class
$vendor=Vendor::getInstance();
//create object in admin class
$admin=Admin::getInstance();
//object create for session
$session = $init->getSession();
//create object for user class
$user=User::getInstance();
//create object for mail class
$mail = Mail::getInstance();
// add generator by admin
if(isset($_POST['btnsubmit_generators']))
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
    );
    

//    $user = User::getInstance();
//    $id =$user->register($array);

    $id = $generators->add_genrator($array);
    $a=array('user_id' => $id,'password' => $_POST['password']);
    
    if($id=="email"){
        $array['email']="false";
    }
    else{
        $array['id'] = $id;
        //inserting password in table for checking recent used
        $user->insert_last_password($a);
    }
    echo json_encode($array);
 
}
//generator global password reset functionality by admin
if(isset($_POST['global_password']))
{
        $res=$generators->global_password_reset($session->__get("user_id"),$_POST['global_password']);
        //$rand_no=mt_rand();
    	//$link=BASE_URL."/resetPassword/".$rand_no;
    	//$reset_password_result=$generators->insert_rand_no($rand_no,$session->__get("user_id"));
        $list=$generators->show_genrator($session->__get("user_id"));
       // echo "<pre>";print_r($list);
       // die("here");
        foreach($list as $result){
        $mail_result=$mail->send_forgot_password_for_all_generator_mail($session->__get("firstname"),$result['email']);            
        }
        

    
    die("here");
    
    
    
   echo $res;
}
//account parmanently remove functionality
if(isset($_POST['remove_id']))
{
    $ids = $_POST['remove_id'];
    $res=$generators->remove_account($ids);
    echo $res;
}

//account suspend  functionality
if(isset($_POST['suspend_id']))
{
    $ids = $_POST['suspend_id'];
    $res=$generators->suspend_id($ids);
    echo $res;
}
//show genrator edit record in popup
if(isset($_POST["edit_id"]))
{
    $edit_id=$_POST["edit_id"];
    $value=$generators->show_edit_generator($edit_id);
    echo json_encode($value);
}

//account join generator functionality
if(isset($_POST['join']))
{
    $ids = $_POST['join'];
    $res=$generators->join($ids);
    echo $res;
}

                                //vendor functionality 

//show genrator rejoin record in popup
if(isset($_POST["rejoin_id"]))
{
    $rejoin_id=$_POST["rejoin_id"];
    $value=$generators->rejoin($rejoin_id);
    echo json_encode($value);
}

//show vender rejoin record in popup
if(isset($_POST["vrejoin_id"]))
{
    
    $rejoin_id=$_POST["vrejoin_id"];
    $value=$vendor->rejoin($rejoin_id);
    echo json_encode($value);
}
//account parmanently remove functionality
if(isset($_POST['vremove_id']))
{
    echo $ids = $_POST['vremove_id'];
    $res=$vendor->remove_account($ids);
    echo $res;
}
//account suspend vendor functionality
if(isset($_POST['vsuspend_id']))
{
    $ids = $_POST['vsuspend_id'];
    $res=$vendor->suspend_id($ids);
    echo $res;
}

//account join vendor functionality
if(isset($_POST['venjoin']))
{
    $ids = $_POST['venjoin'];
    $res=$vendor->join($ids);
    echo $res;
}

//Administrator account remove functionality
if(isset($_POST['administrator_remove_id']))
{
    echo $ids = $_POST['administrator_remove_id'];
    $res=$admin->remove_account($ids);
    echo $res;
}


if(isset($_POST['btnsubmit_vendor']))
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
        );
    $vendor=Vendor::getInstance();
    $id = $vendor->add_vendor($array);
    if($id=="email"){
        $array['email']="false";
    }
    else{
        $array['id'] = $id;
        //inserting password in table for checking recent used
        $a=array('user_id' => $id,'password' => $_POST['password']);
        $user->insert_last_password($a);
    }
      
  
    echo json_encode($array);

}

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
        "date" => 'first time login',
        );
    $id = $admin->add_administrator($array);
    if($id=="email"){
        $array['email']="false";
    }
    else{
        $array['id'] = $id;
        //inserting password in table for checking recent used
        $a=array('user_id' => $id,'password' => $_POST['password']);
        $user->insert_last_password($a);
    }
    echo json_encode($array);

}

//show ajax allsites  in popup
if(isset($_POST['select_site_id']))
{
    $id=$_POST['select_site_id'];
    $edit=$admin->select_edit_sites($id);
    echo json_encode($edit);
}



?>