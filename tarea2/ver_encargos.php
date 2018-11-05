<?php
session_start();
require_once('db_config.php');
require_once('consultas.php');
require_once('diccionarios.php');
$db = DbConfig::getConnection();
$encargos = getEncargos($db);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ver Encargos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
            h2{
                text-align: center;
                background-color: white; 
            }
            body{
                background-image: url("ver.jpeg");
                
                
            }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 10px solid #000000;
                text-align: center;
                padding: 8px;

                font: 20px arial, sans-serif;
                font-weight: bold;
            }

            tr:nth-child(even) {
                background-color: #aaaaaa;
            }
            tr:nth-child(odd) {
                background-color: #ffffff;
            }
            input{
                font: 15px arial, sans-serif;
                font-weight: bold;
                width: auto;
                height: auto;
                padding: 5px;  
                color: black;
            }
            img{
                width: 80px;
                height: 80px;
            }
        </style>
    </head>
    <body id="body">

        <h2>Encargos</h2>
        <table id="t_encargos">
            <tr>
                <th>Origen</th>
                <th>Destino</th>
                <th>Espacio</th>
                <th>Kilos</th>
                <th>email</th>
                <th>Foto</th>
            </tr>
            <?php foreach ($encargos as $encargo) {?>
                <tr onclick="display(<?php echo $encargo["id"]?>)">
                    <th><?php echo getComunaById($encargo["origen"]);?></th>
                    <th><?php echo getComunaById($encargo["destino"]);?></th>
                    <th><?php echo getEspacioById($encargo["espacio"]);?></th>
                    <th><?php echo getKilosById($encargo["kilos"]);?></th>
                    <th><?php echo $encargo["email_encargador"]?></th>
                    <th><?php echo "<img id= '".$encargo['id'] ."' src= '".$encargo['foto'] ."' alt='hello'"?></th>
                </tr>
            <?php }?>
        </table>
        <br>
        <br>
        <table id="show">

        </table>
        <input type="button" onclick="location.href='index.php';" value="Inicio"/>

        <script src="https://code.jquery.com/jquery-2.1.1.min.js"
                type="text/javascript"></script>
        <script>
            function display(id){
                var t = document.getElementById("show");
                if (t.rows.length > 1)
                    t.deleteRow(-1);

                $.ajax({
                    type: "GET",
                    url: "display_enc.php",
                    data: {id: id},
                    success: function(data){
                        $('#show').html(data);
                    }
                });
            }


        </script>
    </body>
</html>
