<?php
require_once('db_config.php');
require_once('diccionarios.php');
require_once('consultas.php');
$db = DbConfig::getConnection();
if(isset($_GET['in'])) {
    $in = $_GET["in"];
    $viajes = getViajes($db);
    ?>
    <tr>
        <th>Origen</th>
        <th>Destino</th>
        <th>Fecha ida</th>
        <th>Fecha regreso</th>
        <th>Espacio</th>
        <th>Kilos</th>
        <th>email</th>
    </tr>

    <?php for ($i = 0; $i < 5; $i++) {
        if ($i+$in < count($viajes)){?>
            <tr id="tab" onclick="display(<?php echo $viajes[$i+$in]["id"]?>)" onload="loadTable()">
                <th><?php echo getComunaById($viajes[$i+$in]["origen"]);?></th>
                <th><?php echo getComunaById($viajes[$i+$in]["destino"]);?></th>
                <th><?php echo $viajes[$i+$in]["fecha_ida"]?></th>
                <th><?php echo $viajes[$i+$in]["fecha_regreso"]?></th>
                <th><?php echo getEspacioById($viajes[$i+$in]["espacio_disponible"]);?></th>
                <th><?php echo getKilosById($viajes[$i+$in]["kilos_disponible"]);?></th>
                <th><?php echo $viajes[$i+$in]["email_viajero"]?></th>
            </tr>
        <?php }}?>
    <?php
}
?>
