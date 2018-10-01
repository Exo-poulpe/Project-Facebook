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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body  style="background-color: #e9ebee;">
  <title>PoulpBook</title>
  <nav class="navbar navbar-light bg-light" style="background-color: #29487d !important;">
    <a class="navbar-brand" href="#" style="color: rgba(255, 255, 255, 0.9);">
      <img src="/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top " alt="" >
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
      <img src="images/CFPT_logo.png"  alt="CFPT_logo" class="img-fluid" style="margin-top: 15px;" />
      <div class="h4 text-muted">
      </div>
    </div>

    <div class="col-sm-9" >
      <img src="images/Code_image.jpg"  alt="Code_image" style="width: 100%;margin-top: 15px;"/><!-- class=" img-fluid w-75"-->
    </div>


  </div>
  <div class="row ">
    <input class="col-sm-1 offset-sm-4 btn btn-secondary" type="button" value="Post"/>
    <input class="col-sm-1 btn btn-secondary " type="button" value="Profil"/>
    <input class="col-sm-1 btn btn-secondary " type="button" Value="Images" />
  </div>
  <!--Formulaire-->
  <div class="row" >
    <div class="col-sm-2 border">
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

      <div class="col-sm-7 offset-sm-1 bg-white" style="border : 2px solid #4d4d4d; border-radius: 5px;margin-top: 50px;">
        <form method="post" action="PhpServer.php" enctype="multipart/form-data" id="formulaire" class="text-center">
          <br>
          <textarea rows="5" cols="100" form="formulaire" name="textPost" class="img-fluid form-control mt-2 border-dark" placeholder="Exprimez-vous"></textarea>
          <br>
          <br>
          <div class="file-field">
            <div class="btn btn-secondary btn-sm ">
              <span>Browse File</span>
              <input type="file" accept="image/*" multiple name="filePictures[]" class="mt-2"/>
            </div>
            <div class="file-path-wrapper">
            </div>
          </div>
          <br>
          <br>

          <input type="submit" name="btnEnvoyer" value="Envoyer" class="btn btn-outline-secondary mt-2 " style="margin-bottom: 10px;margin-top: 50px;"/>
        </form>
      </div>
      <div class="col-sm-2 border">
        <p><b>A propos</b></p>
        email: alisuhf@gmail.com
        portable: 01234567890

      </div>
    </div>

    <div class="container ">
      <?php
      $listMessages = getMessagesFromDb();
      //SELECT idMessage from messages WHERE 1
      //for ($i=0; $i < count($listMessages); $i++) {
      foreach ($listMessages as $row) {
        ?>
        <div class="rows center-block text-center " ><!--center-block text-center border border-dark bg-white mt-5 -->
          <div class="col-sm-7 offset-sm-3 mt-5 center-block text-center bg-white" style="border : 2px solid #4d4d4d; border-radius: 5px;">
            <?php
            print("<h6 class=\"text-left text-top \" > " . get_current_user() . " </h6>");
            print("<h6 class=\"text-left text-top text-muted\" > " . getDateFromIdMsg($row["idMessage"])[0]["date"] . " </h6>"); ?>
            <!-- style="background:url('.\\images\\Trash.png');width: 50px;height:50px;margin-left: 90%;color: transparent;" !-->
            <form action="DeleteImages.php" method="get"><input type="submit" class="btn " title="Supprimer" style="background:url('.\\images\\Trash.png');width: 30px;height:30px;margin-left: 90%;color: transparent;background-repeat: no-repeat;" name="id" value=<?php print("{$row['idMessage']}");?> /></form>
            <form action="Update.php" method="get"><input type="submit" class="btn " name="idMsg" title="Modifier" style="background:url('.\\images\\Pen.png');width:30px;height:30px;color:transparent;margin-left:90%;background-repeat: no-repeat;" value=<?php print("{$row['idMessage']}");?> /></form>
            <?php

            print("<p id={$row["idMessage"]}> {$row["message"]} </p>");
            print("<hr align='center' width='100%' size=2 class='bg-dark' >");
            $listImages = getImagesByMessageId($row["idMessage"]);

            //var_dump($row);
            foreach ($listImages as $rowImage) { ?>
              <?php  print("<img src=\"{$rowImage['path']}\" alt=\"error\" class=\"col-sm-5 img-fluid img-thumbnail\" style=\"margin-bottom: 15px;margin-top: 5px;\" >");
            }?>
          </div>
        </div>
      <?php }  ?>
    </div>
    <br/>
  </body>

  </html>
