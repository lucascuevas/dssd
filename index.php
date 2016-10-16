<?php 
session_start();
require_once 'Drive.php';

$drive= new Drive();

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $drive->client()->setAccessToken($_SESSION['access_token']);
  $drive->create_google_service_api();
  $a=$drive->get_list_files();
  require_once 'listado.php';

}
else {

	$drive->set_redirect('index.php');

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
}























?>
	