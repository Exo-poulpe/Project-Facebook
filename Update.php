<?php include 'DbFunction.php';
$idMsg = $_GET["idMsg"];
?>
<!DOCTYPE html>
<!-- style="background-color: #29487d;" bleu-->
<!-- style="background-color: #e9ebee    <form><input type="submit" name="id" value= print("{$Image['$idImage']}");  /></form> -->
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="BootStrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="CssPhp.css" rel="stylesheet" type="text/css"/>
  <title>Modificate</title>
</head>

<body  style="background-color: #e9ebee;">

  <form action="UpdateDb.php" method="post">
    <div class="border border-dark col-sm-10 offset-sm-1 text-center">
    <?php $msg = getMessageFromDb($idMsg);?>
    <textarea rows="5" cols="50" class="mt-3 form-control rounded-0" name="text"><?php print($msg[0]["message"]); ?></textarea>
    <br>
    <?php
    $listMsg = getMessageFromDb($idMsg);
    $images = getImagesIdFromIdMsg($idMsg);
      foreach ($listMsg as $row) {
        $listImages = getImagesByMessageId($row["idMessage"]);
        $i = 0;
        foreach ($listImages as $Image)
        {
          ?>
          <div>
          <img class="col-sm-2 img-fluid mt-2 mb-2 w-25 h-25" src=<?php print("{$Image['path']}"); ?> alt="error" id=<?php print($images[$i]['idImage']); ?> >
          <input class="btn img-fluid" name="idImg" value=<?php print($images[$i]['idImage']); ?> style="position: absolute;background:url('.\\images\\Trash.png');width: 30px;height:30px;color: transparent;background-repeat: no-repeat;" />
        </div>

          <?php
          $i++;

        }
      }

     ?>
     <br>
     <input type="file" accept="image/*" multiple name="filePictures[]"/>
     <br>
     <input type="hidden"  value=<?php print("{$idMsg}"); ?> name="idM" />
     <input type="hidden" value=<?php print("{$images[0]['idImage']}");?> name="idImg"/>
    <input type="submit" value="Valider" class="btn btn-success rounded mt-5 mb-2"/>
  </div>
</form>


</body>
</html>
