<?php 
session_start();
require_once 'Drive.php';
require_once 'Twig.php';

$drive= new Drive();

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $drive->client()->setAccessToken($_SESSION['access_token']);
  $drive->create_google_service_api();
  $drive->delete('0B8ZKvt5NZ9-EcHJyMTdaa3dLWDdEQVFnRXNzaVJqbXB4bWdj');

   

}
else {

	$drive->set_redirect('eliminar.php');

	if ( !isset($_GET['code']) && !isset($_GET['error']) ) {
		$drive->get_credentials($_GET['code']);
	}
	 else {
	 	$drive->auth($_GET['code']);
		$drive->create_google_service_api();
		  $drive->delete('0B8ZKvt5NZ9-EcHJyMTdaa3dLWDdEQVFnRXNzaVJqbXB4bWdj');
		
	}
}


 ?>