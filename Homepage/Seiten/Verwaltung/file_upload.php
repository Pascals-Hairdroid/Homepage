<?php
include("../../include_DBA.php");

$target_dir = "../../Bilder/Werbung/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
file_upload($target_file);
?>