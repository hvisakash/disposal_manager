<?php
class Mail {
    private static $instance=NULL;
    
    public static function getInstance(){ 
        if( self::$instance === NULL ) { 
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function send($array){
        $firstname=$array['firstname'];
        $email=$array['email'];
        $contact=$array['contact'];
        $problem=$array['problem'];
	//$receiver  = "hvis21deepak.l@gmail.com";
        $receiver  = "support@disposalmanager.com";
	$message = "Welcome to Disposal Manager \n";
        $message.="Help Page Details are as below :- \n\n\n Your Name :$firstname  \n\nEmail : $email \n\nPhone Number: : $contact \n\nDescription of problem : $problem\n\n Message : $message";
        $title    = "maIL";
        $headers  = "From: Disposal\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/mixed;\n";
        //$headers .= "\tboundary=\"___$marker==\"";
    
    
        if (mail($receiver,$title,$message,$headers))
        {
           // print "Your message is sent.";
        }
        else
        {
            //print "Your message is not sent.
           //<br>Please go <a href=\"javascript:history.back();\">back</a> and send again.";
        }
    }    

    public function reset_password_generator($email,$array){
    $newpassword=$array['npassword'];
    $receiver  = $email;
    $message = "Welcome to Disposal Manager \n";
    $message.="Your New Password are  \n\n New Password : $newpassword \n\n";
    $title    = "maIL";
    $headers  = "From: Disposal\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/mixed;\n";
    $headers .= "\tboundary=\"___$marker==\"";


    if (mail($receiver,$title,$message,$headers))
    {
        //print "Your message is sent.";
    }
    else
    {
       // print "Your message is not sent.
        //<br>Please go <a href=\"javascript:history.back();\">back</a> and send again.";
    }
       }

     public function send_forgot_password_mail($link,$email){
        
        $receiver  = $email;
	$message = "Welcome to Disposal Manager \n";
        $message .= "Click on the below link to reset your password \n";
        $message.=$link;
	$message="This is testing mail";
        $title    = "Password Reset";
        $headers  = "From: Disposal\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/mixed;\n";
       // $headers .= "\tboundary=\"___$marker==\"";
    
    
        if (mail($receiver,$title,$message,$headers))
        {
           // echo "<script>alert('Please click the link in your email to reset password');</script>";
        }
        else
        {
           // print "Your message is not sent.
            ////<br>Please go <a href=\"javascript:history.back();\">back</a> and send again.";
        }
    }
//profile notification for generator
    public function generator_profile_update($email){
	$receiver  = $email;
      	$message = "Welcome to Disposal Manager \n";
        $message.= " Your Profile  are Updated ";
        $title    = "maIL";
        $headers  = "From: Disposal\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/mixed;\n";
       	$headers .= "\tboundary=\"___$marker==\"";
    
    
        if (mail($receiver,$title,$message,$headers))
        {
           // print "Your message is sent.";
        }
        else
        {
            //print "Your message is not sent.
         }
    }
	//profile notification for admin	
    public function admin_profile_update($email){
	$receiver  = $email;
	$message = "Welcome to Disposal Manager \n";
        $message= " Your Profile  is Updated ";
        $title    = "maIL";
        $headers  = "From: Disposal\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/mixed;\n";
       	$headers .= "\tboundary=\"___$marker==\"";
    
    
        if (mail($receiver,$title,$message,$headers))
        {
           // print "Your message is sent.";
        }
        else
        {
            //print "Your message is not sent.
         }
    }
//send password to admin in email
	public function reset_password_admin($email,$primary_email)
	{
	$receiver  = $email;
	$message = "Welcome to Disposal Manager \n";
	$message .= "Your Password is Changed ";
	$title    = "maIL";
	$headers  = "From: Disposal\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: multipart/mixed;\n";
	$headers .= "\tboundary=\"___$marker==\"";
	    if (mail($receiver,$title,$message,$headers))
	    {
			//print "Your message is sent.";
	    }
	    else
	    {
	       		// print "Your message is not sent.
			//<br>Please go <a href=\"javascript:history.back();\">back</a> and send again.";
	    }
	if($primary_email)
	{
		$receiver  = $primary_email;
		$message = "Welcome to Disposal Manager \n";
		$message .="Password is Changed Bb   : $email ";
		$title    = "maIL";
		$headers  = "From: Disposal\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-Type: multipart/mixed;\n";
		$headers .= "\tboundary=\"___$marker==\"";
	    if (mail($receiver,$title,$message,$headers))
	    {
			//print "Your message is sent.";
	    }
	    else
	    {
	       		// print "Your message is not sent.
			//<br>Please go <a href=\"javascript:history.back();\">back</a> and send again.";
	    }
	
	}	

       }
	//send notification on vender if vendor change the password 
	public function reset_password_vendor($email)
	{
	    $receiver  = $email;
	   $message = "Welcome to Disposal Manager \n";
	    $message.="Your Password is Changed";
	    $title    = "maIL";
	    $headers  = "From: Disposal\n";
	    $headers .= "MIME-Version: 1.0\n";
	    $headers .= "Content-Type: multipart/mixed;\n";
	    $headers .= "\tboundary=\"___$marker==\"";
	if (mail($receiver,$title,$message,$headers))
	    {
		//print "Your message is sent.";
	    }
	    else
	    {
	       // print "Your message is not sent.
		//<br>Please go <a href=\"javascript:history.back();\">back</a> and send again.";
	    }
       }
	//profile notification for vendor if profile is update	
    public function vendor_profile_update($email){
	$receiver  = $email;
	$message = "Welcome to Disposal Manager \n";
        $message.= " Your Profile  is Updated ";
        $title    = "maIL";
        $headers  = "From: Disposal\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/mixed;\n";
       	$headers .= "\tboundary=\"___$marker==\"";
    
    
        if (mail($receiver,$title,$message,$headers))
        {
           // print "Your message is sent.";
        }
        else
        {
            //print "Your message is not sent.
         }
    }
    // reset all generator password
    public function send_forgot_password_for_all_generator_mail($firstname,$email){
        $receiver  = $email;
	$message = "Welcome to Disposal Manager \n";
        $message .= "Your Password has been Reset By  :  $firstname \n\n";
	$title    = "Password Reset";
        $headers  = "From: Disposal\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/mixed;\n";
        $headers .= "\tboundary=\"___$marker==\"";
    
    
        if (mail($receiver,$title,$message,$headers))
        {
            //echo "<script>alert('Please click the link in your email to reset password');</script>";
        }
        else
        {
            //print "Your message is not sent.
            //<br>Please go <a href=\"javascript:history.back();\">back</a> and send again.";
        }
    }
	
    
}



