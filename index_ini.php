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
    <button onclick="hideshow()">crear doc</button>
	<button onclick="s.showSettingsDialog()">Share</button>
    
    <form  id="form1" style="display:none" method="GET" action="subir_archivo.php">
        <label>nombre</label>
        <input type="text" name="nombre" size="20">
        <input type="submit" value="enviar">
    </form>

<script>
function hideshow(){
var frm=document.getElementById("form1");
if(frm.style.display=="block"){frm.style.display="none"}
else
if(frm.style.display=="none"){frm.style.display="block"}
}
</script>

</body>

 

</html>