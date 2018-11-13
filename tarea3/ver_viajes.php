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
            button{
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
    <body id="body" onload="loadTable(0)">

        <h2>Viajes</h2>
        <table id="t_viajes" >

        </table>
        <br>
        <button onclick="decrement()" > &lt;&lt;-- </button>
        <button onclick="increment()" > --&gt;&gt; </button>
        <br>
        <table id="show">

        </table>
        <input type="button" onclick="location.href='index.php';" value="Inicio"/>
        <script>
            var indx = 0;
            function increment() {
                indx+=5;
                <?php $v = count($viajes);?>
                if (indx > <?php echo $v?>)
                    indx = <?php echo ($v-2)>0?($v-2):0?>;
                    loadTable(indx);
            }
            function decrement() {
                indx-=5;
                if (indx < 0)
                    indx = 0;
                loadTable(indx);
            }
            function loadTable(ind) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("t_viajes").innerHTML =
                            this.responseText;
                    }
                };
                xhttp.open("GET", "display_v2.php?in="+ind, true);
                xhttp.send();
            }
            function display(id){
                var t = document.getElementById("show");
                if (t.rows.length > 1)
                    t.deleteRow(-1);

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("show").innerHTML =
                            this.responseText;
                    }
                };
                xhttp.open("GET", "display_v.php?id="+id, true);
                xhttp.send();
            }
        </script>
    </body>
</html>
