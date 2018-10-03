<?php
include 'DbFunction.php';

$idMsg = $_GET["id"];
//$idCheck = $_POST["chkDeleteImage"];

//var_dump($idMsg);

try {
  $connect = connectToDb();
  $connect->beginTransaction();
  delImagesOnDiskFromIdMsg($idMsg);
  delImagesFromId($idMsg);
  delMessageFromId($idMsg);
  $connect->commit();
}
catch (Exception $e) {
  $connect->rollback();
}

header('Location: index.php');



 ?>
