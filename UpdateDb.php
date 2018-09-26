<?php
include 'DbFunction.php';

$idMsg = $_POST["id"];
$message = $_POST["text"];

UpdatePostMessage($idMsg,$message);

function UpdatePostMessage($idMessage,$msg)
{
  /*$connect = connectToDb();
  $request = $connect->prepare("SELECT message FROM messages WHERE idMessage = :id");
  $request->bindParam(":id",$idMessage,PDO::PARAM_INT);
  //var_dump($request);
  $request->execute();
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);*/


  $connect = connectToDb();
  $request = $connect->prepare("UPDATE messages SET message = ? WHERE idMessage = ?");
  $request->execute([$msg,$idMessage]);

}

header('Location: index.php');
 ?>
