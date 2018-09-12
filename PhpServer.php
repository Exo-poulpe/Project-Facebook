<?php
/**************Variable*************/
$target_dir = "C:\\Users\\Administrateur\\Documents\\Download_php\\";



$textPost = $_REQUEST["textPost"];
//var_dump($_FILES);

DEFINE('DB_HOST','127.0.0.1');
DEFINE('DB_USER','root');
DEFINE('DB_NAME','fb_post');
DEFINE('DB_PASS','');


$myFile = $_FILES["filePictures"];


/***********************************/


$lastIdMessage = setMessageOnDb($_REQUEST["textPost"]);


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

    $tmpName = $myFile["tmp_name"][$i];
    $fileName = $myFile["name"][$i]; // recupere l'extension du fichier
    //checkFileType($tmpName);
    //checkExtensionName($fileName);
    if (checkExtensionName($fileName))  // regarde si l'extension est dans la liste
    {
      if (checkFileType($tmpName))
      {
        //setImagesPathOnDb($myFile["tmp_name"][$i],$lastIdMessage);

        setImagesPathOnDb(moveFile($tmpName,$fileName),$lastIdMessage);
        moveFile($tmpName,$fileName);

      }
    }

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

  if ($request->execute()) {
    return $connect->lastInsertId();
  }else {
    return -1;
  }
}

function setImagesPathOnDb($PathImage,$idMessage)  // Insere dans la base de donnée le chemin de l'image
{
  $PathImage = str_replace("\\","\\\\",$PathImage); // Double les '\' pour que le chemin soit correct dans la requete SQL
  $connect = connectToDb();
  $request = $connect->prepare( "INSERT INTO images (path, idMessage) VALUES (:PathImage,:idMessage)");
  $request->bindParam(":PathImage",$PathImage,PDO::PARAM_STR);
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

function checkFileType($imageName)
{
  //var_dump($imageName);
  $extensionimage = substr(strrchr($imageName, "."), 0);
  if (exif_imagetype($imageName) == IMAGETYPE_JPEG || exif_imagetype($imageName) == IMAGETYPE_PNG || exif_imagetype($imageName) == IMAGETYPE_BMP )
  {
      return true;
  }
  return false;
}

function checkExtensionName($imageName)
{
  $extensionimage = substr(strrchr($imageName, "."), 0);
  $imageExtArray = [".jpeg",".png",".jpg",".JEPG",".PNG",".JPG"];
  for ($i=0; $i < count($imageExtArray) ; $i++) {
    if ($extensionimage == $imageExtArray[$i])
    {
      return true;
    }
  }
  return false;
}

function moveFile($tmpPath,$fileName)
{
  $target_dir = "C:\\Users\\Administrateur\\Documents\\Download_php\\";
  $newName = $target_dir . $fileName;
  $target_dir .= substr(strrchr($tmpPath, "\\"), 1);
  //$target_dir .= substr(strrchr(substr(strrchr($tmpPath, "."), 1), "\\"), 1) . ".png";
  echo "Chemin temp : " . $tmpPath . "    ";
  echo "Chemin dest : " . $newName . "    ";
  ResizeImage($tmpPath,$newName);
  return $newName;
}


function ResizeImage($tmpFileName,$target_dir)
{
  $imageSource = imagecreatefromstring(file_get_contents($tmpFileName));
  $ratio = 1200/imagesx($imageSource);
  $width = imagesx($imageSource)*$ratio;
  $heigth = imagesy($imageSource)*$ratio;
  $imageDest = imagecreatetruecolor($width,$heigth);
  imagecopyresampled($imageDest,$imageSource,0,0,0,0,$width,$heigth,imagesx($imageSource),imagesy($imageSource));
  imagedestroy($imageSource);
  switch (strtolower(substr(strrchr($target_dir, "."), 1))) {
    case 'png':
      imagepng($imageDest,$target_dir);
    break;
    case 'jpeg':
      imagejpeg($imageDest,$target_dir);
    break;
    case 'jpg':
      imagejpeg($imageDest,$target_dir);
    break;
    case 'bmp':
      imagewbmp($imageDest,$target_dir);
    break;
    default:
      echo "Error";
      break;
  }

}


header('Location: index.php');

?>
