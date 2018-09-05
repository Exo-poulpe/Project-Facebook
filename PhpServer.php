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

/***********************************/

var_dump(setMessageOnDb($_REQUEST["textPost"]));
//echo "Message post : " . $_REQUEST["textPost"];

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
  $request = $connect->prepare("INSERT INTO (messages) VALUES (:msg)");
  $request->bindParam(':msg',$Message,PDO::PARAM_STR);
  $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
  return $resultat;


}



//echo $textPost;
//var_dump(phpinfo());
//$filesGet = $_FILES["filePictures"]["name"];




?>
