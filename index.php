<?php 
require_once 'Twig.php';

if (!isset($_SESSION['access_token']) {
 TwigController::render_index('index.html');
}
else {
	 header('Location: ' . filter_var('http://' . $_SERVER['HTTP_HOST']. '/listado.php', FILTER_SANITIZE_URL));
}


 ?>