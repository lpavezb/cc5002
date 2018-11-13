<?php
function uploadFile($id){
    // https://www.w3schools.com/php/php_file_upload.asp
    $target_dir = "tmp/";
    $image_name = $id. basename($_FILES["foto-encargo"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["foto-encargo"]["tmp_name"]);
    if($check !== false)
        $uploadOk = 1;
    else
        $uploadOk = 0;

    // Check if file already exists
    if (file_exists($target_file))
        $uploadOk = 0;


    // Check file size
    if ($_FILES["foto-encargo"]["size"] > 500000)
        $uploadOk = 0;


    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
        $uploadOk = 0;


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)
        return 1; // return error
    else { // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["foto-encargo"]["tmp_name"], $target_file))
            return 0; // return uploaded
        else
            return 1; // return error
    }
}
?>