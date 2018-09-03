<script>
document.title = "Server";
</script>

<?php

$textPost = $_REQUEST["textPost"];

foreach ($_FILES as $fileName) {
  echo $fileName["name"];
}
//echo $textPost;
var_dump(phpinfo());
//$filesGet = $_FILES["filePictures"]["name"];

?>
