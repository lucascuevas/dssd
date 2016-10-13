<!DOCTYPE html>
<html>
<head>
	<title>Ejemplo Google drive api</title>
</head>
<body>
<script type="text/javascript" src="https://apis.google.com/js/api.js"></script>
<script type="text/javascript">
    init = function() {
        s = new gapi.drive.share.ShareClient();
        s.setOAuthToken('<OAUTH_TOKEN>');
        s.setItemIds(['0B4k2gJOcq6YSb09xUjdMYzdkOWM']);
    }
    window.onload = function() {
        gapi.load('drive-share', init);
    }
</script>


	<h1>Google dive API</h1>
	<a href="subir_archivo.php">Subir Archivo</a>
	<a href="listar_archivos.php">Listar archivos</a>
	<button onclick="s.showSettingsDialog()">Share</button>

</body>
</html>