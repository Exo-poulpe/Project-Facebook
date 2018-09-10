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

//echo "Message post : " . $_REQUEST["textPost"] . "  ";

setMessageOnDb($_REQUEST["textPost"]);
setImagesPathOnDb($_FILES["filePictures"]["tmp_name"],$lastIdMessage);


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

function connectToDb()
{
  static $dbb = null;

  if ($dbb == null)
  {
    try
    {
      $connectionString = 'mysql:host=' . DB_HOST . ';dbname='.DB_NAME . '' ;
      $dbb = new PDO($connectionString,DB_USER,DB_PASS);
      $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
  }
  return $dbb;

}


function getMessageFromDb($idMessage)
{
  $connect = connectToDb();
  //var_dump(connectToDb()); die();
  $request = $connect->prepare("SELECT * FROM messages WHERE idMessage = :id");
  $request->bindParam(':id',$idMessage,PDO::PARAM_INT);
  $request->execute();
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  return $resultat;


}

function setMessageOnDb($Message)
{
  $connect = connectToDb();
  $request = $connect->prepare("INSERT INTO messages (message) VALUES (\"" . $Message . "\")");
  //$idMessageForImage++;
  //echo "INSERT INTO messages (message) VALUES (\":msg\")";
  $request->execute();

  //$resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  //return $resultat;


}

function setImagesPathOnDb($PathImage)
{

  //echo "Last id message : " . $idMessage;
  $idMessage = getLastIdMessage();
  var_dump((string)$idMessage);
  $connect = connectToDb();
  $request = $connect->prepare( "INSERT INTO images (path, idMessage) VALUES ( \"{$PathImage}\" , {$idMessage} )" );

  //echo "INSERT INTO images (path,id_message) VALUES ( \"$PathImage\" , $idMessage )";
  //$request->bindParam(':pathFile',$PathImage,PDO::PARAM_STR);
  //$request->bindParam(':lastMsg',$idMessage,PDO::PARAM_INT);
  //$tmp = (string)$lastIdMessage
  //$request = $connect->prepare( "INSERT INTO images (path,id_message) VALUES (\" $PathImage \", \" $tmp \")" );
  //echo "INSERT INTO messages (message) VALUES (\":msg\")";
  $request->execute();

}

function getLastIdMessage()
{
  $connect = connectToDb();
  $request = $connect->prepare( "SELECT * FROM `messages` ORDER BY `messages`.`idMessage` DESC Limit 1 " );
  $request->execute();
  //$lastIdMessage = $request->fetch(PDO::FETCH_ASSOC);
  //$lastIdMessage = $lastIdMessage["id_message"];
  //echo $lastIdMessage;
  //var_dump($request->fetch()["idMessage"]);
  return $request->fetch()["idMessage"];
}

//echo $textPost;
//var_dump(phpinfo());
//$filesGet = $_FILES["filePictures"]["name"];




?>
