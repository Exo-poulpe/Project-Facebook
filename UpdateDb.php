<?php
include 'DbFunction.php';

$idMsg = $_POST["idM"];
$message = $_POST["text"];
$pathImage = $_POST["path"];

UpdatePostMessage($idMsg,$message);
$idImage = getIdFromPathImage($pathImage);

function UpdatePostMessage($idMessage,$msg)
{
  $connect = connectToDb();
  $request = $connect->prepare("UPDATE messages SET message = ? WHERE idMessage = ?");
  $request->execute([$msg,$idMessage]);

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
