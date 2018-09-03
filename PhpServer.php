<?php

$textPost = $_REQUEST["textPost"];
var_dump($_FILES);

$myFile = $_FILES["filePictures"];

for ($i=0; $i < count($myFile["name"]); $i++) {
  echo count($myFile["name"]);
  echo $myFile["name"][$i];
}



/*foreach ($_FILES["filePictures"] as $fileName) {
  var_dump($fileName);
  echo $fileName["name"];
  echo $fileName["error"];

}*/
//echo $textPost;
var_dump(phpinfo());
//$filesGet = $_FILES["filePictures"]["name"];

?>
