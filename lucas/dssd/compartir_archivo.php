<?php 
require_once 'Drive.php';
session_start();


$drive= new Drive();
	
$drive->set_redirect('compartir_archivo.php');

if (! isset($_GET['code'])) {
	$drive->get_credentials($_GET['code']);
}
 else {
 	$drive->auth($_GET['code']);
	$drive->create_google_service_api();
	//mandarle el id de un archivo existente en la cuenta
	$drive->shared_file('0B4k2gJOcq6YSV3ZTYTNZMVB1M0U','carmeloperaltaconstrucciones@gmail.com');
	}
?>