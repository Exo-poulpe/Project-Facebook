<?php
/**************Variable*************/
include 'DbFunction.php';

$target_dir = "./images/uploads/";



$textPost = $_REQUEST["textPost"];
//var_dump($_FILES);




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
    $tmpName = $myFile["tmp_name"][$i];
    $fileName = $myFile["name"][$i]; // recupere l'extension du fichier
    if (checkExtensionName($fileName))  // regarde si l'extension est dans la liste
    {
      if (checkFileType($tmpName))
      {
        setImagesPathOnDb(moveFile($tmpName,$fileName),$lastIdMessage);
      }
    }

  }
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
  echo $UUID;
  $newName = $target_dir . $UUID . "_" . substr(strrchr($fileName, "."), 0);
  $target_dir .= substr(strrchr($tmpPath, "\\"), 1);
  //$target_dir .= substr(strrchr(substr(strrchr($tmpPath, "."), 1), "\\"), 1) . ".png";
  echo $newName = str_replace(" ","_",$newName);;
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
  echo $target_dir;
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

function AddPathToList($listOfImage,$Path)
{
  array_push($listOfImage,$Path);
  return $listOfImage;
}

function AddMessageToList($listMessage,$message)
{
  array_push($listMessage,$message);
  return $listMessage;
}

//var_dump($_SESSION["image"]);
//session_destroy();
header('Location: index.php');

?>
