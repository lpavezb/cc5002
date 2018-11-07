<?php
require_once('db_config.php');
require_once('diccionarios.php');
$db = DbConfig::getConnection();
if(isset($_GET['id'])) {
    $id = $_GET["id"];
    $query ="SELECT * FROM viaje where id = $id;";
    $result = $db->query($query);
    $row = $result->fetch_row();
    ?>
    <br>
    <tr>
        <th>Origen</th>
        <th>Destino</th>
        <th>Fecha ida</th>
        <th>Fecha regreso</th>
        <th>Espacio</th>
        <th>Kilos</th>
        <th>email</th>
        <th>Celular</th>
    </tr>
    <tr>
        <th><?php echo getComunaById($row[3]);?></th>
        <th><?php echo getComunaById($row[4]);?></th>
        <th><?php echo $row[1]?></th>
        <th><?php echo $row[2]?></th>
        <th><?php echo getEspacioById($row[6]);?></th>
        <th><?php echo getKilosById($row[5]);?></th>
        <th><?php echo $row[7]?></th>
        <th><?php echo $row[8]?></th>
    </tr>
    <?php
}
?>
<br>
