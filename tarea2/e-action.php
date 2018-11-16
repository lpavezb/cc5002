<?php session_start();
    require_once('db_config.php');
    require_once('consultas.php');
    require_once('diccionarios.php');
    require_once('uploadFile.php');
    $db = DbConfig::getConnection();

    // prepare
    $stmt = $db->prepare("INSERT INTO encargo VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiiisss", $id, $desc, $origen, $destino, $espacio, $kilos, $foto, $email, $celular);

    $sql ="SELECT id FROM encargo order by id desc limit 1;";
    $res = $db->query($sql);
    if($res->num_rows == 0)
        $id = 0;
    else
        $id = $res->fetch_row()[0]+1;


    $target_dir = "tmp/";
    $image_name = $id. basename($_FILES["foto-encargo"]["name"]);
    $target_file = $target_dir . $image_name;

    $co = $_POST["comuna-origen"];
    $cd = $_POST["comuna-destino"];
    $desc = htmlspecialchars($db->real_escape_string($_POST["descripcion"]));
    $origen	= htmlspecialchars($db->real_escape_string($co));
    $destino = htmlspecialchars($db->real_escape_string($cd));
    $espacio = htmlspecialchars($db->real_escape_string($_POST["espacio-solicitado"]));
    $kilos = htmlspecialchars($db->real_escape_string($_POST["kilos-solicitados"]));
    $foto = htmlspecialchars($db->real_escape_string($target_file));
    $email = htmlspecialchars($db->real_escape_string($_POST["email"]));
    $celular = htmlspecialchars($db->real_escape_string($_POST["celular"]));


    //validate
    $_SESSION["errorFile"] = 0;
    $_SESSION["errorCo"] = 0;
    $_SESSION["errorUpload"] = 0;

    $errorCo = $co === $cd;


    if ($errorCo){
        $_SESSION["errorCo"] = 1;
        header("Location: encargos.php");
    }
    else{

        $errorFile = uploadFile($id);

        if ($errorFile)
            $_SESSION["errorFile"] = 1;

        $error = $errorFile + $errorCo;

        //upload
        if ($error==0) {
            if ($stmt->execute())
                header("Location: index.php");
            else {
                $_SESSION["errorUpload"] = 1;
                header("Location: encargos.php");
            }
        }else
            header("Location: encargos.php");
    }

?>
