<?php

DEFINE('DB_HOST','127.0.0.1');
DEFINE('DB_USER','root');
DEFINE('DB_NAME','fb_post');
DEFINE('DB_PASS','');



function connectToDb()  // Connection a la base de donnée
{
  static $dbb = null;

  if ($dbb == null)  // si elle est null on la créer
  {
    try
    {
      $connectionString = 'mysql:host=' . DB_HOST . ';dbname='.DB_NAME . '' ;
      $dbb = new PDO($connectionString,DB_USER,DB_PASS);  // On se connecte avec de la gestion d'erreur
      $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
  }
  return $dbb;

}


function getMessageFromDb($idMessage) // Recupere le message a partir de l'id
{
  $connect = connectToDb();
  $request = $connect->prepare("SELECT * FROM messages WHERE idMessage = :id "); // prepare la requete SQL
  $request->bindParam(':id',$idMessage,PDO::PARAM_INT);
  $request->execute();
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  return $resultat;
}

function getMessagesFromDb() // Recupere le message a partir de l'id
{
  $connect = connectToDb();
  $request = $connect->prepare("SELECT * FROM messages ORDER BY idMessage DESC"); // prepare la requete SQL
  $request->execute();
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  return $resultat;
}


function getImagesByMessageId($idMessage) // Recupere le message a partir de l'id
{
  $connect = connectToDb();
  $request = $connect->prepare("SELECT path from images WHERE idMessage = :id"); // prepare la requete SQL
  $request->bindParam(':id',$idMessage,PDO::PARAM_INT);
  $request->execute();
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  return $resultat;
}


function setMessageOnDb($message) // Insere le message taper dans la base de donnée
{
  if(strlen($message)>140)
  {
    $message = substr($message,0,140);
  }
  $connect = connectToDb();
  $request = $connect->prepare("INSERT INTO messages (message) VALUES (:message)"); // prepare la requete SQL pour envoyer le texte
  var_dump($message);
  $request->bindParam(':message',$message,PDO::PARAM_STR);
  if ($request->execute()) {
    return $connect->lastInsertId();
  }else {
    return -1;
  }
}

function setImagesPathOnDb($pathImage,$idMessage)  // Insere dans la base de donnée le chemin de l'image
{
  $PathImage = str_replace("\\","\\\\",$pathImage); // Double les '\' pour que le chemin soit correct dans la requete SQL
  $connect = connectToDb();
  $request = $connect->prepare( "INSERT INTO images (path, idMessage) VALUES (:PathImage,:idMessage)");
  $request->bindParam(":PathImage",$pathImage,PDO::PARAM_STR);
  $request->bindParam(":idMessage",$idMessage,PDO::PARAM_INT);
  $request->execute();

}

function getLastIdMessage() // recupere le dernier idMessage du dernier message posté
{
  $connect = connectToDb();
  $request = $connect->prepare( "SELECT * FROM `messages` ORDER BY `messages`.`idMessage` DESC Limit 1 " );
  $request->execute();
  return $request->fetch()["idMessage"];
}

function delImagesFromId($idMsg)
{
  $connect = connectToDb();
  $request = $connect->prepare( "DELETE FROM images WHERE idMessage = {$idMsg}" );
  $request->execute();
}

function delMessageFromId($idMsg)
{
  $connect = connectToDb();
  $request = $connect->prepare( "DELETE FROM messages WHERE idMessage = {$idMsg}" );
  $request->execute();
}

function updateMsgFromMessageId($idMsg,$msg)
{
  $connect = connectToDb();
  $request = $connect->prepare("UPDATE messages SET message = ':msg' WHERE idMessage = :idMsg");
  $request->bindParam(":idMsg",$idMsg,PDO::PARAM_STR);
  $request->bindParam(":msg",$msg,PDO::PARAM_STR);
  $request->execute();
}

/*function UpdatePostMessage($idMsg,$msg)
{
  echo "dswrf";

  $connect = connectToDb();
  $request = $connect->prepare("UPDATE `messages` SET `:idMessage`= 444,`message`= ':message'");
  $request->bindParam(":idMessage",$idMsg,PDO::PARAM_STR);
  $request->bindParam(":message",$msg,PARAM_STR);
  $request->execute();

}*/

 ?>
