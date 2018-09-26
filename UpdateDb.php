<?php
include 'DbFunction.php';

$idMsg = $_GET["update"];
UpdatePostMessage($idMsg);

function UpdatePostMessage($idMessage)
{
  $connect = connectToDb();
  $request = $connect->prepare("SELECT message FROM messages WHERE idMessage = :id");
  $request->bindParam(":id",$idMessage,PDO::PARAM_INT);
  //var_dump($request);
  $request->execute();
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  


  /*$connect = connectToDb();
  $request = $connect->prepare("UPDATE messages SET message = :msg WHERE idMessage = idMsg");
  $request->bindParam(":idMessage",$idMsg,PDO::PARAM_STR);
  $request->bindParam(":message",$msg,PARAM_STR);
  $request->execute();*/

}


 ?>
