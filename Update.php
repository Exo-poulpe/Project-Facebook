<?php include 'DbFunction.php';
$idMsg = $_GET["idMsg"];
?>
<!DOCTYPE html>
<!-- style="background-color: #29487d;" bleu-->
<!-- style="background-color: #e9ebee -->
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="BootStrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="CssPhp.css" rel="stylesheet" type="text/css"/>
  <title>Modificate</title>
</head>

<body  style="background-color: #e9ebee;">

  <div class="border border-dark col-sm-10 offset-sm-1 text-center">
    <?php $msg = getMessageFromDb($idMsg);?>
    <textarea rows="5" cols="50" class="mt-3"><?php print($msg[0]["message"]); ?></textarea>
    <br>
    <?php
    $listMsg = getMessageFromDb($idMsg);
      foreach ($listMsg as $row) {
        $listImages = getImagesByMessageId($row["idMessage"]);
        foreach ($listImages as $Image) {
          print("<img src=\"{$Image['path']}\" alt=\"error\" class=\"col-sm-5 img-fluid mt-3 mb-3 img-thumbnail w-25 h-25\" >");
        }
      }
     ?>
     <br>
    <input type="submit" value="Valider" name="Post" class="btn btn-success rounded mt-2 mb-2"/>
  </div>


</body>
</html>
