<?php
include 'DbFunction.php';

$idMsg = $_POST["idM"];
$message = $_POST["text"];
$pathImage = $_POST["path"];
date_default_timezone_set('Europe/Zurich');


UpdatePostMessage($idMsg,$message);
//$idImage = getIdFromPathImage($pathImage);


function UpdatePostMessage($idMessage,$msg)
{
  $connect = connectToDb();
  $request = $connect->prepare("UPDATE messages SET message = ? , date = ? WHERE idMessage = ?");
  $request->execute([$msg,date('Y-m-d:H:i:s'),$idMessage]);

}

function getIdFromPathImage($pathImage)
{
  $connect = connectToDb();
  $request = $connect->prepare("SELECT id_image FROM images WHERE path = ?");
  $request->execute([$pathImage]);
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  return $resultat["id_image"];

}

header('Location: index.php');
 ?>
