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

  var_dump(connectToDb());




}

function connectToDb()
{
  static $dbb = null;

  if ($dbb === null)
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
    return $dbb;


  }

}


function getMessageFromDb()
{
  


}



//echo $textPost;
//var_dump(phpinfo());
//$filesGet = $_FILES["filePictures"]["name"];




?>
