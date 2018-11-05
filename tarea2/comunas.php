<?php
require_once('db_config.php');
$db = DbConfig::getConnection();
if(!empty($_GET['reg_id']) and $_GET['reg_id'] != 'select') {
    $reg_id = $_GET["reg_id"];
    $query ="SELECT * FROM comuna WHERE region_id = $reg_id";
    $comunas = $db->query($query);
    ?>
    <option value="select">Seleccione Comuna</option>
    <?php
    foreach($comunas as $comuna) {
        ?>
        <option value="<?php echo $comuna["id"]; ?>"><?php echo $comuna["nombre"]; ?></option>
        <?php
    }
}
?>