<?php
include 'DbFunction.php';

$idMsg = $_POST["idM"];
$message = $_POST["text"];
$idCheck = $_POST["chkDeleteImage"];
$imagesToAdd = $_FILES["files"];
date_default_timezone_set('Europe/Zurich');

//var_dump($imagesToAdd["name"]);
var_dump($idCheck);

try {
  $connect = connectToDb();
  $connect->beginTransaction();
  UpdatePostMessage($idMsg,$message);

  for ($i = 0;$i < count($idCheck);$i++) {
    delImageOnDiskFromId($idCheck[$i]);
    delImageFromIdImage($idCheck[$i]);
  }

  if(isset($imagesToAdd))
  {
    for($i = 0;$i < count($imagesToAdd["name"]);$i++) {
      $tmpName = $imagesToAdd["tmp_name"][$i];
      $fileName = $imagesToAdd["name"][$i]; // recupere l'extension du fichier
      $fileNewName = moveFile($tmpName,$fileName);
      $listFiles[] = $fileNewName;
      setImagesPathOnDb($fileNewName,$idMsg);
    }
  }

  $connect->commit();
} catch (\Exception $e) {
  $connect->rollback();
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
  $target_dir = "./images/uploads/";
  $UUID = uniqid('',true);
  //echo $UUID;
  $newName = $target_dir . $UUID . "_" . substr(strrchr($fileName, "."), 0);
  $target_dir .= substr(strrchr($tmpPath, "\\"), 1);
  //$target_dir .= substr(strrchr(substr(strrchr($tmpPath, "."), 1), "\\"), 1) . ".png";
  //echo $newName = str_replace(" ","_",$newName);;
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
  //echo $target_dir;
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
