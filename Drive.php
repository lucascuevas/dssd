<?php 
 require_once 'vendor/autoload.php';

class Drive 
{	

	private $client = null;
	private $drive_service = null;

	function __construct()
	{
		$this->client = new Google_Client();		
		$this->client->setIncludeGrantedScopes(true);
		//solicitar acceso 
		$this->client->addScope('https://www.googleapis.com/auth/drive');
		$this->client->addScope('https://www.googleapis.com/auth/drive.metadata');
		$this->client->addScope('https://www.googleapis.com/auth/drive.appdata');
		$this->client->setAuthConfigFile('client_secrets_local.json');
	}


	//Creamos un service object de la api que vamos a utilizar 
	public function create_google_service_api ()
	{
		  $this->drive_service = new Google_Service_Drive($this->client);
	}

	public function client(){
		return $this->client;
	}
	
	// Autenticacion en OAuth 2.0 de googles
	public function get_credentials(){
		 // 3) Generar una URL para solicitar el acceso desde el servidor de OAuth 2.0 de Google:
		if ( !isset($_GET['code']) && !isset($_GET['error']) ) {
  			$auth_url = $this->client->createAuthUrl();
  			header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
  		}

	}

	// Establecemos la pagina de redireccion luego de la autenticacion
	public function set_redirect($arch){
		$this->client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/dssd2016/'.$arch);

	}

	
	public function Auth($code){
		if (!isset($_SESSION['access_token'])) {
 			// Dado el código de autorización a un  token de acceso
	   		$this->client->authenticate($code);
	   		// Guardamos el codigo de acceso en la session
	  		$_SESSION['access_token'] = $this->client->getAccessToken();
		}
			$this->client->setAccessToken($_SESSION['access_token']);
		
	}


	/* Se realiza la peticion a la api: listamos los archivos
	de google drive */
	public function get_list_files(){
		
		$sharedWithMe=$this->files_sharedWithMe();
		
		 $optParams = array(
			'fields' => 'nextPageToken, files(id, name,mimeType)');
		$files_list=$this->drive_service->files->listFiles($optParams);
		
		$result= array();
		if (count($files_list->getFiles()) == 0) {
  		return array_push($result,"No files fount");
 		} 
 		else {

	 		foreach ($files_list->getFiles() as $file) {
	 			
	 			$shared=in_array($file->getId(),$sharedWithMe);	 			
	  			array_push($result,
	  				['name'=>$file->getName(),
	  				'id'=> $file->getId(),
	  				'type' => $file->getMimeType(),
	  				'shared' =>$shared
	  				]);

	  		}
  		}
  		return $result;
  		
	}


  

	/*Crea un google doc vacio */
	public function create_doc($title,$mail){
		$file = new Google_Service_Drive_DriveFile();
		$file->setName($title);
		$file->setMimeType('application/vnd.google-apps.document');
		$result = $this->drive_service->files->create($file, array());
		$this->create_google_service_api();
		$this->shared_file($result['id'],$mail);
		

	}

	/* Otorga permisos de escritura al archivo con id -> fieldId
	al usuarios con el mail proporcionado*/
	public function shared_file($fileId,$mail){


		$this->drive_service->getClient()->setUseBatch(true);
		try {
		  $batch = $this->drive_service->createBatch();

		  $userPermission = new Google_Service_Drive_Permission(array(
		    'type' => 'user',
		    'role' => 'writer',
		    'emailAddress' => $mail
		  ));

		   $request = $this->drive_service->permissions->create(
		   $fileId, $userPermission, array('fields' => 'id'));
		   $batch->add($request, 'user');

 		  $results = $batch->execute();

		  foreach ($results as $result) {
		    if ($result instanceof Google_Service_Exception) {
		      // Handle error
		      printf($result);
		    } else {
		      printf("Permission ID: %s\n", $result->id);
		    }
		  }
		}
	     finally {
		  $this->drive_service->getClient()->setUseBatch(false);
		}

	}



		/* Retorna en  un array los id de aquellos archivos 
		que me compartieron a mi */
		public function files_sharedWithMe(){

		  $response = $this->drive_service->files->listFiles(array(
		    'q' => "sharedWithMe ",
		    'spaces' => 'drive',
		    'fields' => 'nextPageToken, files(id, name)',
		  ));
		  $result=array();
		  foreach ($response->files as $file) {
		     array_push($result,$file->getId());
		  }
		return $result;

	}

	
}


 ?>