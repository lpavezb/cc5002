<?php
session_start();
require_once('db_config.php');
require_once('consultas.php');
require_once('diccionarios.php');
$db = DbConfig::getConnection();
$viajes = getViajes($db);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ver Viajes</title>
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
        </style>
    </head>
    <body id="body">

        <h2>Viajes</h2>
        <table id="t_viajes">
            <tr>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha ida</th>
                <th>Fecha regreso</th>
                <th>Espacio</th>
                <th>Kilos</th>
                <th>email</th>
            </tr>
            <?php foreach ($viajes as $viaje) {?>
                <tr onclick="display(<?php echo $viaje["id"]?>)">
                    <th><?php echo getComunaById($viaje["origen"]);?></th>
                    <th><?php echo getComunaById($viaje["destino"]);?></th>
                    <th><?php echo $viaje["fecha_ida"]?></th>
                    <th><?php echo $viaje["fecha_regreso"]?></th>
                    <th><?php echo getEspacioById($viaje["espacio_disponible"]);?></th>
                    <th><?php echo getKilosById($viaje["kilos_disponible"]);?></th>
                    <th><?php echo $viaje["email_viajero"]?></th>
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
                    url: "display_v.php",
                    data: {id: id},
                    success: function(data){
                        $('#show').html(data);
                    }
                });
            }
        </script>
    </body>
</html>
