<?php

$textPost = $_REQUEST["textPost"];
//var_dump($_FILES);

$myFile = $_FILES["filePictures"];

for ($i=0; $i < count($myFile["name"]); $i++) {

  echo $myFile["name"][$i];
  
}



//echo $textPost;
var_dump(phpinfo());
//$filesGet = $_FILES["filePictures"]["name"];

?>
