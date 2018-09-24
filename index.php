<?php include 'DbFunction.php';?>
<!DOCTYPE html>
<!-- style="background-color: #29487d;" bleu-->
<!-- style="background-color: #e9ebee -->
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="BootStrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="CssPhp.css" rel="stylesheet" type="text/css"/>
</head>

<body  style="background-color: #e9ebee;">
  <nav class="navbar navbar-light bg-light" style="background-color: #29487d !important;">
  <a class="navbar-brand" href="#" style="color: rgba(255, 255, 255, 0.9);">
    <img src="/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="" >
    PoulpBook
  </a>
</nav>
<!--
  <div class="col border " style="background-color: #29487d;" >
    <div class="h4 col-1 text-white" style="left: 20%; font-family: 'Consolas';margin-top: 50px;" >
      PoulpBook
    </div>
  </div>-->

  <div class="container" >



    <div class="row" >

      <div class="col-sm-3">
        <img src="images/CFPT_logo.png"  alt="CFPT_logo" class="img-fluid" />
        <div class="h4 text-muted"><b>
          Troller Fabian
          <br>
          Computer Scientist
          <br>
          CFPT Informatique
          <br>
          Rue des Poulpes 456
          <br>
          1212 Terre</b>
        </div>
      </div>

      <div class="col-sm-9" >
        <img src="images/Code_image.jpg"  alt="Code_image" style="width: 100%"/><!-- class=" img-fluid w-75"-->
      </div>


    </div>

    <!--Formulaire-->
    <div class="row" >
      <div class="col-sm-3">
        <b>
          Troller Fabian
          <br>
          Computer Scientist
          <br>
          CFPT Informatique
          <br>
          Rue des Poulpes 456
          <br>
          1212 Terre</b>
        </div>
        <div class="col-sm-6" style="border : 2px solid #4d4d4d; border-radius: 5px;">
          <form method="post" action="PhpServer.php" enctype="multipart/form-data" id="formulaire" class="text-center">
            <br>
            <textarea rows="5" cols="100" form="formulaire" name="textPost" class="img-fluid form-control" placeholder="Exprimez-vous"></textarea>
            <br>
            <br>
            <input type="file" accept="image/*" multiple name="filePictures[]"/>
            <br>
            <br>
            <input type="submit" name="btnEnvoyer" value="Choisir un fichier" class="btn btn-outline-secondary" style="margin-bottom: 10px;"/>
          </form>

        </div>
        <div class="col-sm-3">
          <b>
            Troller Fabian
            <br>
            Computer Scientist
            <br>
            CFPT Informatique
            <br>
            Rue des Poulpes 456
            <br>
            1212 Terre</b>
          </div>
        </div>

        <div class="container">
          <?php
          $listMessages = getMessagesFromDb();
          //SELECT idMessage from messages WHERE 1
          //for ($i=0; $i < count($listMessages); $i++) {
          foreach ($listMessages as $row) {
            // code...
            ?>
            <div class="rows center-block text-center" ><!--center-block text-center border border-dark bg-white mt-5 -->
              <div class="col-sm-8 offset-sm-2 mt-5 center-block text-center" style="border : 2px solid #4d4d4d; border-radius: 5px;">
              <form action="DeleteImages.php" method="get"><input type="submit" class="btn" style="background:url('.\\images\\Trash.png');width: 50px;height:50px;margin-left: 90%;color: transparent;" value=<?php print("{$row['idMessage']}"); ?> name="id"/></form>
              <?php print("<p id={$row["idMessage"]}> {$row["message"]} </p>");
              $listImages = getImagesByMessageId($row["idMessage"]);

              //var_dump($row);
              foreach ($listImages as $rowImage) { ?>
                <?php  print("<img src=\"{$rowImage['path']}\" alt=\"error\" class=\"col-4 img-fluid\" style=\"margin-bottom: 15px;margin-top: 5px;\" >");
              }?>
            </div>
            </div>
          <?php } ?>
        </div>
        <br/>
      </body>

      </html>
