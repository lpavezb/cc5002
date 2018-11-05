<?php session_start();
    require_once('db_config.php');
    require_once('consultas.php');
    require_once('diccionarios.php');
    $db = DbConfig::getConnection();

    $stmt = $db->prepare("INSERT INTO viaje (id,fecha_ida,fecha_regreso,origen,destino,kilos_disponible,espacio_disponible,email_viajero,celular_viajero) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiiiiss", $id, $fecha_ida, $fecha_regreso, $origen, $destino, $kilos_disponible, $espacio_disponible, $email_viajero, $celular_viajero);


    $sql ="SELECT id FROM viaje order by id desc limit 1;";
    $res = $db->query($sql);
    if($res->num_rows == 0)
        $id = 0;
    else
        $id = $res->fetch_row()[0]+1;

    $fecha_ida = htmlspecialchars($db->real_escape_string($_POST["fecha-ida"]));
    $fecha_regreso = htmlspecialchars($db->real_escape_string($_POST["fecha-regreso"]));
    $origen	= htmlspecialchars($db->real_escape_string($_POST["comuna-origen"]));
    $destino = htmlspecialchars($db->real_escape_string($_POST["comuna-destino"]));
    $kilos_disponible = htmlspecialchars($db->real_escape_string($_POST["kilos-disponibles"]));
    $espacio_disponible	= htmlspecialchars($db->real_escape_string($_POST["espacio-disponible"]));
    $email_viajero = htmlspecialchars($db->real_escape_string($_POST["email"]));
    $celular_viajero = htmlspecialchars($db->real_escape_string($_POST["celular"]));


    if ($stmt->execute()){
        header("Location: index.php");
    }

?>
