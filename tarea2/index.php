<?php session_start();
if(!isset($_SESSION["new"])){
    $_SESSION["new"] = true;
    require_once('db_config.php');
    require_once('consultas.php');
    require_once('reset_tmp.php');
    $db = DbConfig::getConnection();
    resetDB($db);

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Tarea 2</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
    input{
        position: relative;
        left: 45%;
        top: 50%;
        width: auto;
        height: auto;
        padding: 20px;  
        color: black;
    }
</style>
</head>
<body>
<form>
<br>
<input type="button" onclick="location.href='viajes.php';" value="Agregar Viaje"/>
<br>
<br>
<input type="button" onclick="location.href='encargos.php';" value="Agregar Encargo"/>
<br>
<br>
<input type="button" onclick="location.href='ver_viajes.php';" value="Ver Viajes"/>
<br>
<br>
<input type="button" onclick="location.href='ver_encargos.php';" value="Ver Encargos"/>

</form>

</body>
</html>
