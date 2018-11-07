<?php
require_once('db_config.php');
require_once('diccionarios.php');
require_once('consultas.php');
$db = DbConfig::getConnection();
if(isset($_GET['in'])) {
    $in = $_GET["in"];
    $encargos = getEncargos($db);
    ?>
    <tr>
        <th>Origen</th>
        <th>Destino</th>
        <th>Espacio</th>
        <th>Kilos</th>
        <th>email</th>
        <th>Foto</th>
    </tr>
    <?php for ($i = 0; $i < 5; $i++) {
        if ($i+$in < count($encargos)){?>
            <tr onclick="display(<?php echo $encargos[$i+$in]["id"]?>)">
                <th><?php echo getComunaById($encargos[$i+$in]["origen"]);?></th>
                <th><?php echo getComunaById($encargos[$i+$in]["destino"]);?></th>
                <th><?php echo getEspacioById($encargos[$i+$in]["espacio"]);?></th>
                <th><?php echo getKilosById($encargos[$i+$in]["kilos"]);?></th>
                <th><?php echo $encargos[$i+$in]["email_encargador"]?></th>
                <th><?php echo "<img id= '".$encargos[$i+$in]['id'] ."' src= '".$encargos[$i+$in]['foto'] ."' alt='hello'"?></th>
            </tr>
    <?php }}}?>
