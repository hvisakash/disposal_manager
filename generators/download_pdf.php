<?php
$id=$_GET['id'];
//including initial file
include("../init.php");
    $generators = Generators::getInstance();
    $record=$generators->download_upload_file($id);
	//print_r($record);die("FDP");
	foreach($record as $file){
		 //echo $file_name;die;
		 
		 }

// grab the requested file's name
$file="".BASE_PATH.$file;

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
	//header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
else{
	
	print("FILE NAME DOES NOT EXIST...");exit;
	
	}
	?>