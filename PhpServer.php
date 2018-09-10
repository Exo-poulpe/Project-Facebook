<?php
/**************constant*************/
$target_dir = "C:\\Users\\Administrateur\\Documents\\Download_php\\";

$textPost = $_REQUEST["textPost"];
//var_dump($_FILES);

DEFINE('DB_HOST','127.0.0.1');
DEFINE('DB_USER','root');
DEFINE('DB_NAME','fb_post');
DEFINE('DB_PASS','');


$myFile = $_FILES["filePictures"];

$lastIdMessage = 1;

/***********************************/


setMessageOnDb($_REQUEST["textPost"]);


for ($i=0; $i < count($myFile["name"]); $i++) {



  if ($myFile["size"][$i] > 3000000)
  {
    echo "Image is too big";
  }
  else
  {
    //echo $myFile["name"][$i];
    //echo "Chemin temp : " . $myFile["tmp_name"][$i];
    //echo " ";
    $target_dir .= $myFile["name"][$i];
    setImagesPathOnDb($myFile["tmp_name"][$i],$lastIdMessage);
    //setImagesPathOnDb($target_dir);
    //echo "Chemin upload : " . $target_dir;
    //echo " ";

  }

  //var_dump(getMessageFromDb(1));




}

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
  $request = $connect->prepare("SELECT * FROM messages WHERE idMessage = :id"); // prepare la requete SQL
  $request->bindParam(':id',$idMessage,PDO::PARAM_INT);
  $request->execute();
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  return $resultat;
}

function setMessageOnDb($Message) // Insere le message taper dans la base de donnée
{
  $connect = connectToDb();
  $request = $connect->prepare("INSERT INTO messages (message) VALUES (\"" . $Message . "\")"); // prepare la requete SQL pour envoyer le texte
  $request->execute();
}

function setImagesPathOnDb($PathImage)  // Insere dans la base de donnée le chemin de l'image
{

  $PathImage = str_replace("\\","\\\\",$PathImage); // Double les '\' pour que le chemin soit correct dans la requete SQL
  $idMessage = getLastIdMessage();  // recupere le dernier idMessage pour le liés a l'image
  $connect = connectToDb();
  $request = $connect->prepare( "INSERT INTO images (path, idMessage) VALUES ( \"{$PathImage}\" , {$idMessage} )" );
  $request->execute();

}

function getLastIdMessage() // recupere le dernier idMessage du dernier message posté
{
  $connect = connectToDb();
  $request = $connect->prepare( "SELECT * FROM `messages` ORDER BY `messages`.`idMessage` DESC Limit 1 " );
  $request->execute();
  return $request->fetch()["idMessage"];
}



?>
