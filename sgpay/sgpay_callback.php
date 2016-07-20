<?php
$txt_string = "Checking callback \n";
if($_POST) {

	$txt_string .= " \nPOST : " . json_encode($_POST);   
}

if($_GET) {
	$txt_string .= " \nGET : " . json_encode($_GET);	
}

$myfile = fopen("sagepayFile.txt", "w") or die("Unable to open file!");

fwrite($myfile, $txt_string);
fclose($myfile);


die($txt_string);
?>