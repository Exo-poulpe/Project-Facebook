<?php
include 'DbFunction.php';

$idMsg = $_POST["idM"];
$message = $_POST["text"];
$idCheck = $_POST["chkDeleteImage"];
date_default_timezone_set('Europe/Zurich');

//var_dump($idCheck);

try {
  $connect = connectToDb();
  $connect->beginTransaction();
  UpdatePostMessage($idMsg,$message);
  foreach ($idCheck as $idImg) {
    delImageOnDiskFromId($idImg);
    delImageFromIdImage($idImg);
  }

  $connect->commit();
} catch (\Exception $e) {
  $connect->rollback();
}

header('Location: index.php');
 ?>
