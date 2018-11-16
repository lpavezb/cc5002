<?php
session_start();
require_once('db_config.php');
require_once('consultas.php');
$db = DbConfig::getConnection();
$regiones = getRegion($db);
$esps = getPesos($db);
$kilos = getKilos($db);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Viajes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
            h1{
                background-color: white;
                font-weight: bold;
                font: 50px arial, sans-serif;
            }
            body{
                background-image: url("viaje.jpeg");
                background-repeat: no-repeat;
                background-size: cover;
            }

            label{
                background-color: white;
                font-weight: bold;
                font: 20px arial, sans-serif;
            }

            select{
                font: 15px arial, sans-serif;
                font-weight: bold;
            }input{
                font: 15px arial, sans-serif;
                font-weight: bold;
                width: auto;
                height: auto;
                padding: 5px;  
                color: black;
            }
        </style>
    </head>
    <body>
        <form name="viajes" onsubmit="return validateForm()" action="v-action.php" method="post">
            <label>Region Origen:</label><br>
            <select id="region-origen" name="region-origen" onchange="getComunas('origen')">
                <option value="select">Seleccione Región</option>
                <?php foreach ($regiones as $region) {?>
                <option value="<?php echo $region["id"] ?>"><?php echo $region["nombre"] ?></option>
                <?php }?>
            </select><br>
            <br>
            <label>Comuna Origen:</label><br>
            <select id="comuna-origen" name="comuna-origen">
                <option value="select">Seleccione Comuna</option>
            </select>
            <br>
            <br>
            <label>Region Destino:</label><br>
            <select id="region-destino" name="region-destino" onchange="getComunas('destino')">
                <option value="select">Seleccione Región</option>
                <?php foreach ($regiones as $region) {?>
                    <option value="<?php echo $region["id"] ?>"><?php echo $region["nombre"] ?></option>
                <?php }?>
            </select><br>
            <br>
            <label>Comuna Destino:</label><br>
            <select id="comuna-destino" name="comuna-destino">
                <option value="select">Seleccione Comuna</option>
            </select>
            <br>
            <br>
            <label>Fecha Viaje Ida(yyyy-mm-dd):</label>
            <input type="text" name="fecha-ida" value="" size="10">
            <br>
            <br>
            <label>Fecha Viaje Vuelta(yyyy-mm-dd):</label>
            <input type="text" name="fecha-regreso" value="" size="10">
            <br>
            <br>
            <label>Espacio Disponible:</label><br>
            <select name="espacio-disponible">
                <option value="select">Seleccione Espacio</option>
                <?php foreach ($esps as $esp) {?>
                    <option value="<?php echo $esp["id"] ?>"><?php echo $esp["valor"] ?></option>
                <?php }?>
            </select>
            <br>
            <br>
            <label>Kilos Disponibles:</label><br>
            <select name="kilos-disponibles">
                <option value="select">Seleccione Kilos</option>
                <?php foreach ($kilos as $kilo) {?>
                    <option value="<?php echo $kilo["id"] ?>"><?php echo $kilo["valor"] ?></option>
                <?php }?>
            </select>
            <br>
            <br>
            <label>Email viajero:</label>
            <input type="text" name="email" maxlength="30" size="30">
            <br>
            <br>
            <label>Número celular viajero:</label>
            <input type="text" value="" name="celular" size="15">
            <br>
            <?php if(isset($_POST)){
                if (isset($_SESSION["errorDate"]) and $_SESSION["errorDate"] === 1){
                    echo "<h1> FECHA DE IDA DEBE SER ANTES QUE LA FECHA DE REGRESO </h1>";
                }
                if (isset($_SESSION["errorCo"]) and $_SESSION["errorCo"] === 1){
                    echo "<h1> COMUNA DE ORIGEN DEBE SER DIFERENTE A COMUNA DE DESTINO </h1>";
                }
                if (isset($_SESSION["errorUpload"]) and $_SESSION["errorUpload"] === 1){
                    echo "<h1> ERROR CARGANDO INFORMACION A LA BASE DE DATOS </h1>";
                }
            }?>
            <br>
            <input type="submit" name="agregar-viaje" value="Agregar Viaje">
            <br>
            <br>
            <br>
            <input type="button" onclick="location.href='index.php';" value="Inicio"/>
            <input type="button" onclick="location.href='ver_viajes.php';" value="Ver Viajes"/>
        </form>

        <script>
            function getComunas(mod) {
                var com = document.getElementById('comuna-'+mod);
                for (var i = com.options.length - 1; i > 0; i--) {
                    com.remove(i);
                }
                var val=document.getElementById('region-'+mod).value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("comuna-"+mod).innerHTML =
                            this.responseText;
                    }
                };
                xhttp.open("GET", "comunas.php?reg_id="+val, true);
                xhttp.send();
            }


            function validateNum(number){
                if(number.length != 8){
                    return false;
                }
                for (var i = 0; i < 8; i++) {
                    if(isNaN(parseInt(number.charAt(i)))){
                        return false;
                    }
                }
                return true
            }

            function validateEmail(email){
                // se valida que el formato sea text@text.text
                var textBeforeDot = false;
                var textAfterDot = false;
                var textBeforeAt = false;
                var textAfterAt = false;
                var at = false;
                var dot = false;
                for (var i = 0; i < email.length; i++) {
                    if(email.charAt(i)=='@'){
                        if(at)
                            return false;
                        at = true;
                    }else{
                        if(!at){
                            textBeforeAt = true;
                        }else{
                            textAfterAt = true;
                        }
                    }
                    if(at){
                        if(email.charAt(i)=='.'){
                            if (dot) {
                                return false;
                            }
                            dot = true;
                        }else{
                            if (!dot) {
                                textBeforeDot = true;
                            }else{
                                textAfterDot = true;
                            }
                        }
                    }
                }
                return textBeforeAt && at && textAfterAt && textBeforeDot && dot && textAfterDot;

            }

            function validateForm(){
                var x = document.forms["viajes"];
                var sel = [x["region-origen"], x["comuna-origen"], x["region-destino"], x["comuna-destino"], x["espacio-disponible"], x["kilos-disponibles"]];
                for (var i = 0; i < sel.length; i++) {
                    if (sel[i].value === "select") {
                        alert("Debe llenar el campo " + sel[i].name.replace("-"," "));
                        return false;
                    }
                }
                var fecha = new Date(x["fecha-viaje"].value);
                if(fecha.toString()==="Invalid Date"){
                    alert("Formato de fecha incorrecto");
                    return false;
                }
                var e = x["email"].value;
                if(!validateEmail(e)){
                    alert("Email no valido");
                    return false;
                }
                var num = x["celular"].value;
                if(num !== ""){
                    if(!validateNum(num)){
                        alert("Numero de telefono debe ser de 8 dígitos");
                        return false;
                    }
                }
                return true;
            }
            </script>
    </body>
</html>
