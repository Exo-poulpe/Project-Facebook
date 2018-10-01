<?php
include 'DbFunction.php';

$idMsg = $_GET["id"];


delImagesOnDiskFromIdMsg($idMsg);
delImagesFromId($idMsg);
delMessageFromId($idMsg);

header('Location: index.php');



 ?>
