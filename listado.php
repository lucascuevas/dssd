<!DOCTYPE html>
<html>
<head>
	<title>Archivos Drive</title>
</head>
<body>
    <h1>Listado Drive</h1>
    <?php
    foreach ($a as $file) { ?>
   <a href=""> <?php echo $file['name']." --> ".$file['id'].'<br>'; } ?> </a>
   
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