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
    $errorFile = uploadFile($id);
    $errorCo = $co === $cd;
    if ($errorFile){
        echo "<script>
                alert('No se puede subir la imagen al servidor :(');
                window.location.href='encargos.php';
              </script>";
    }

    if ($errorCo){
        echo "<script>
                alert('Comuna de origen tiene que ser diferente a la comuna de destino :(');
                window.location.href='encargos.php';
              </script>";
    }



    $error = $errorFile + $errorCo;

    //upload
    if ($error==0) {
        if ($stmt->execute())
            header("Location: index.php");
        else {
            echo "<script>
                alert('No se puede cargar la informacion a la base de datos :(');
                window.location.href='encargos.php';
              </script>";
        }
    }
?>
