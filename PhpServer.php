<?php
/**************constant*************/
$target_dir = "C:\\Users\\Administrateur\\Documents\\Download_php\\";

$textPost = $_REQUEST["textPost"];
//var_dump($_FILES);

$myFile = $_FILES["filePictures"];

/***********************************/

for ($i=0; $i < count($myFile["name"]); $i++) {



  if ($myFile["size"][$i] > 3000000)
  {
    echo "Image is too big";
  }
  else
  {
    //echo $myFile["name"][$i];
    echo "Chemin temp : " . $myFile["tmp_name"][$i];
    echo " ";
    $target_dir .= $myFile["name"][$i];
    echo "Chemin upload : " . $target_dir;
    echo " ";

  }




}



//echo $textPost;
var_dump(phpinfo());
//$filesGet = $_FILES["filePictures"]["name"];




?>
