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
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
        <title>Encargos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
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

        <form name="encargos" enctype="multipart/form-data" onsubmit="return validateForm()" action="e-action.php" method="post">
            <label>Descripción Encargo:</label><br>
  			<input type="text" name="descripcion" id="descripcion" value="" size="100" maxlength="300">
  			<br>
  			<br>
  			<label>Espacio:</label><br>
            <select name="espacio-solicitado">
                <option value="select">Seleccione Espacio</option>
                <?php foreach ($esps as $esp) {?>
                    <option value="<?php echo $esp["id"] ?>"><?php echo $esp["valor"] ?></option>
                <?php }?>
            </select>
            <br>
            <br>
            <label>Kilos:</label><br>
            <select name="kilos-solicitados">
                <option value="select">Seleccione Kilos</option>
                <?php foreach ($kilos as $kilo) {?>
                    <option value="<?php echo $kilo["id"] ?>"><?php echo $kilo["valor"] ?></option>
                <?php }?>
            </select>
            <br>
            <br>
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
            <label>Foto Encargo:</label>
            <input type="file" accept="image/*" name="foto-encargo" onchange="loadFile(event)">
            <img src="#" alt="alt" id="preview"  onclick="resize()">
            <br>
            <br>
            <label>Email Encargador:</label>
            <input type="text" name="email" maxlength="30" size="30">
            <br>
            <br>
            <label>Número celular encargador:</label>
            <input type="text" value="" name="celular" size="15">
            <br>
            <br>
            <input type="submit" name="agregar-encargo" value="Agregar Encargo">
            <br>
            <br>
            <br>
            <input type="button" onclick="location.href='index.php';" value="Inicio"/>
            <input type="button" onclick="location.href='ver_encargos.php';" value="Ver Encargos"/>
            
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

            function loadFile(event){
                var reader = new FileReader();
                reader.onload = function(){
                  var output = document.getElementById('preview');
                  output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                resize();
            }
            var size = 1;
            function resize(){
                var im = document.getElementById("preview");
                if (size===1){
                    im.style.width = "320px";
                    im.style.height = "240px";
                    size = 2;
                }else{
                    im.style.width = "800px";
                    im.style.height = "600px";
                    size = 1;
                }                
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
                var x = document.forms["encargos"];
                if (x["descripcion"].value==="") {
                    alert("debe agregar descripcion");
                    return false;
                }
                if (x["descripcion"].value.length > 300) {
                    alert("descripcion muy larga");
                    return false;
                }
                var sel = [x["region-origen"], x["comuna-origen"], x["region-destino"], x["comuna-destino"], x["espacio-solicitado"], x["kilos-solicitados"]];
                for (var i = 0; i < sel.length; i++) {
                    if (sel[i].value === "select") {
                        alert("Debe llenar el campo " + sel[i].name.replace("-"," "));
                        return false;
                    }
                }
                var im = x["foto-encargo"].value;
                if (im==="") {
                	alert("Ingrese una imagen");
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
    <?php $db->close()?>
    </body>
</html>
