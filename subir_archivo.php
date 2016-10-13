<?php 
require_once 'Drive.php';
session_start();


$drive= new Drive();
$drive->set_redirect('subir_archivo.php');

if (! isset($_GET['code'])) {
	$drive->get_credentials($_GET['code']);
}
 else {
 	$drive->auth($_GET['code']); 	
	$drive->create_google_service_api();
	$drive->create_file('holamundp.pdf');
	
}


 ?>