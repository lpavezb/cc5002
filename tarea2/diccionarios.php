<?php
require_once('db_config.php');
require_once('consultas.php');

function getComunaById($id){
    $db = DbConfig::getConnection();
    $res = '';
    $sql ="SELECT nombre, region_id FROM comuna where id = ".$id;
    $com = $db->query($sql);

    $row = $com->fetch_row();
    $cnom = $row[0];
    $rid  = $row[1];
    $sql ="SELECT nombre FROM region where id = ".$rid;
    $reg = $db->query($sql);
    $rnom = $reg->fetch_row()[0];
	return $res . $cnom . ", ". $rnom;
}

function getEspacioById($id){
    $db = DbConfig::getConnection();
    $sql ="SELECT valor FROM espacio_encargo where id = ".$id;
    $result = $db->query($sql);

    return $result->fetch_row()[0];
}

function getKilosById($id){
    $db = DbConfig::getConnection();
    $sql ="SELECT valor FROM kilos_encargo where id = ".$id;
    $result = $db->query($sql);

    return $result->fetch_row()[0];
}
?>
