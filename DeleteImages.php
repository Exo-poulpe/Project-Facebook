<?php
include 'DbFunction.php';

$idMsg = $_GET["id"];

var_dump($_GET["id"]);

delImagesFromId($idMsg);
delMessageFromId($idMsg);

header('Location: index.php');



 ?>
