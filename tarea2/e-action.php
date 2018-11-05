<?php session_start();
    require_once('db_config.php');
    require_once('consultas.php');
    require_once('diccionarios.php');
    $db = DbConfig::getConnection();

    $stmt = $db->prepare("INSERT INTO encargo VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiiisss", $id, $desc, $origen, $destino, $espacio, $kilos, $foto, $email, $celular);


    $sql ="SELECT id FROM encargo order by id desc limit 1;";
    $res = $db->query($sql);
    if($res->num_rows == 0)
        $id = 0;
    else
        $id = $res->fetch_row()[0]+1;


    $desc = htmlspecialchars($db->real_escape_string($_POST["descripcion"]));
    $origen	= htmlspecialchars($db->real_escape_string($_POST["comuna-origen"]));
    $destino = htmlspecialchars($db->real_escape_string($_POST["comuna-destino"]));
    $espacio = htmlspecialchars($db->real_escape_string($_POST["espacio-solicitado"]));
    $kilos = htmlspecialchars($db->real_escape_string($_POST["kilos-solicitados"]));
    $foto = htmlspecialchars($db->real_escape_string($_POST["foto-encargo"]));
    $email = htmlspecialchars($db->real_escape_string($_POST["email"]));
    $celular = htmlspecialchars($db->real_escape_string($_POST["celular"]));


    if ($stmt->execute()){
        header("Location: index.php");
    }

?>
