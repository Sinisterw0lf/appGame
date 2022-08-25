<?php
//nom des variables
$files_name = $_FILES["url_img"]["name"];
$files_size = $_FILES["url_img"]["size"];
$files_tmp = $_FILES["url_img"]["tmp_name"];
$files_type = $_FILES["url_img"]["type"];
// Vérifier la taille de l'image
$sizeMax = 2000000; //2mo
if ($files_size <= $sizeMax){
    $fileInfo = pathinfo($files_name); //exemple : tomate.jpeg
    $extension = $fileInfo["extension"];
    $allowed_extension = ["jpg", "jpeg", "png"];
    if(in_array($extension, $allowed_extension )){
        $new_img_name = uniqid('IMG-',true).".".$extension;
        // $GLOBALS = ;
        $img_upload_path = "uploads/".$new_img_name;
        move_uploaded_file($files_tmp, $img_upload_path);
    } else {
        $error["url_img"] = "<span class=text-red-500>* Extension de fichier incorrect</span>";
    }
} else {
    $error["url_img"] = "<span class=text-red-500>* Fichier trop gros (max 2 Mo)</span>";
}
?>