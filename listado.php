<?php 
session_start();
require_once 'Drive.php';
require_once 'Twig.php';

$drive= new Drive();

 
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $drive->client()->setAccessToken($_SESSION['access_token']);
  $drive->create_google_service_api();
  $files=$drive->get_list_files();
  $token=$_SESSION['access_token']['access_token'];
  TwigController::render_view('listado.html',[$files,$token]);

}
else {

	$drive->set_redirect('listado.php');

	if ( !isset($_GET['code']) && !isset($_GET['error']) ) {
		$drive->get_credentials($_GET['code']);
	}
	 else {
	 	$drive->auth($_GET['code']);
		$drive->create_google_service_api();
		$files=$drive->get_list_files();
		$token=$_SESSION['access_token']['access_token'];
		TwigController::render_view('listado.html',[$files,$token]);
	}
}























?>
	