<?php 
require_once 'Drive.php';
session_start();
$drive= new Drive();
$drive->set_redirect('listar_archivos.php');
if (! isset($_GET['code'])) {
	$drive->get_credentials($_GET['code']);
}
 else {
 	$drive->auth($_GET['code']);
	$drive->create_google_service_api();
	$a=$drive->get_list_files();
	require_once 'listado.php';
	#print_r($a);
}
?>
	