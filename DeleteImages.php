<?php
include 'DbFunction.php';

$idMsg = $_GET["id"];
//$idCheck = $_POST["chkDeleteImage"];

//var_dump($idMsg);
delImagesOnDiskFromIdMsg($idMsg);
delImagesFromId($idMsg);
delMessageFromId($idMsg);

header('Location: index.php');



 ?>
